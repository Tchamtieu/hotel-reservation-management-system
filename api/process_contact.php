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
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');

    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Le nom est obligatoire';
    }
    
    if (empty($email)) {
        $errors[] = 'L\'email est obligatoire';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Adresse email invalide';
    }
    
    if (empty($subject)) {
        $errors[] = 'Le sujet est obligatoire';
    }
    
    if (empty($message)) {
        $errors[] = 'Le message est obligatoire';
    }
    
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode(['error' => implode(', ', $errors)]);
        exit();
    }

    // Insert contact inquiry into database
    $stmt = $db->prepare("
        INSERT INTO contact_inquiries (name, email, phone, subject, message)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$name, $email, $phone, $subject, $message]);
    $inquiry_id = $db->lastInsertId();

    // Send email notification (in a real implementation)
    // This would be where you'd integrate with an email service
    
    // Log the inquiry for admin review
    if (function_exists('error_log')) {
        error_log("New contact inquiry #{$inquiry_id} from {$email}: {$subject}");
    }

    // Send success response
    echo json_encode([
        'success' => true,
        'message' => 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.',
        'inquiry_id' => $inquiry_id
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de l\'enregistrement du message']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur interne du serveur']);
}
?>