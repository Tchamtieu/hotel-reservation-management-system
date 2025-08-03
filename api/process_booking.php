<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

// Check CSRF token
if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
    http_response_code(403);
    echo json_encode(['error' => 'Token de sécurité invalide']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit();
}

try {
    // Sanitize and validate input data
    $check_in = sanitizeInput($_POST['check_in'] ?? '');
    $check_out = sanitizeInput($_POST['check_out'] ?? '');
    $adults = (int)($_POST['adults'] ?? 1);
    $children = (int)($_POST['children'] ?? 0);
    $room_type = (int)($_POST['room_type'] ?? 0);
    $first_name = sanitizeInput($_POST['first_name'] ?? '');
    $last_name = sanitizeInput($_POST['last_name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $id_type = sanitizeInput($_POST['id_type'] ?? '');
    $id_number = sanitizeInput($_POST['id_number'] ?? '');
    $nationality = sanitizeInput($_POST['nationality'] ?? '');
    $date_of_birth = sanitizeInput($_POST['date_of_birth'] ?? '');
    $special_requests = sanitizeInput($_POST['special_requests'] ?? '');

    // Validation
    $errors = [];
    
    if (empty($check_in) || empty($check_out)) {
        $errors[] = 'Les dates d\'arrivée et de départ sont obligatoires';
    }
    
    if (strtotime($check_in) >= strtotime($check_out)) {
        $errors[] = 'La date de départ doit être après la date d\'arrivée';
    }
    
    if (strtotime($check_in) < strtotime(date('Y-m-d'))) {
        $errors[] = 'La date d\'arrivée ne peut pas être dans le passé';
    }
    
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
        $errors[] = 'Les informations du client principal sont obligatoires';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Adresse email invalide';
    }
    
    if (empty($id_type) || empty($id_number)) {
        $errors[] = 'Les informations de pièce d\'identité sont obligatoires';
    }
    
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(['error' => implode(', ', $errors)]);
        exit();
    }

    $db->beginTransaction();

    // Check room availability
    $stmt = $db->prepare("
        SELECT r.id, rt.base_price, rt.name as room_type_name
        FROM rooms r
        JOIN room_types rt ON r.room_type_id = rt.id
        WHERE rt.id = ? AND r.status = 'available'
        AND r.id NOT IN (
            SELECT room_id 
            FROM reservations 
            WHERE status IN ('confirmed', 'checked_in')
            AND NOT (check_out_date <= ? OR check_in_date >= ?)
        )
        LIMIT 1
    ");
    $stmt->execute([$room_type, $check_in, $check_out]);
    $available_room = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$available_room) {
        $db->rollBack();
        http_response_code(400);
        echo json_encode(['error' => 'Aucune chambre disponible pour ces dates']);
        exit();
    }

    // Calculate total amount
    $nights = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
    $total_amount = $available_room['base_price'] * $nights;

    // Create or find guest
    $stmt = $db->prepare("SELECT id FROM guests WHERE email = ?");
    $stmt->execute([$email]);
    $existing_guest = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existing_guest) {
        $guest_id = $existing_guest['id'];
        
        // Update guest information
        $stmt = $db->prepare("
            UPDATE guests SET 
                first_name = ?, last_name = ?, phone = ?, 
                id_type = ?, id_number = ?, nationality = ?, 
                date_of_birth = ?, special_requests = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        $stmt->execute([
            $first_name, $last_name, $phone, $id_type, $id_number,
            $nationality, $date_of_birth ?: null, $special_requests, $guest_id
        ]);
    } else {
        // Create new guest
        $stmt = $db->prepare("
            INSERT INTO guests (
                first_name, last_name, email, phone, id_type, id_number,
                nationality, date_of_birth, special_requests
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $first_name, $last_name, $email, $phone, $id_type, $id_number,
            $nationality, $date_of_birth ?: null, $special_requests
        ]);
        $guest_id = $db->lastInsertId();
    }

    // Generate reservation number
    $reservation_number = 'RES' . date('Ymd') . str_pad($guest_id, 4, '0', STR_PAD_LEFT);

    // Create reservation
    $stmt = $db->prepare("
        INSERT INTO reservations (
            reservation_number, guest_id, room_id, check_in_date, check_out_date,
            adults, children, total_amount, special_requests, created_by
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $reservation_number, $guest_id, $available_room['id'], $check_in, $check_out,
        $adults, $children, $total_amount, $special_requests,
        $_SESSION['user_id'] ?? null
    ]);
    $reservation_id = $db->lastInsertId();

    $db->commit();

    // Send success response
    echo json_encode([
        'success' => true,
        'message' => 'Réservation créée avec succès',
        'reservation_number' => $reservation_number,
        'reservation_id' => $reservation_id,
        'total_amount' => $total_amount,
        'room_info' => [
            'room_id' => $available_room['id'],
            'room_type' => $available_room['room_type_name'],
            'price_per_night' => $available_room['base_price'],
            'nights' => $nights
        ]
    ]);

} catch (PDOException $e) {
    $db->rollBack();
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la création de la réservation']);
} catch (Exception $e) {
    if (isset($db)) {
        $db->rollBack();
    }
    http_response_code(500);
    echo json_encode(['error' => 'Erreur interne du serveur']);
}
?>