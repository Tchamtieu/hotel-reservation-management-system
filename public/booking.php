<?php
$page_title = "Réservation";
include 'includes/header.php';

// Handle room type pre-selection from URL
$selected_room_type = isset($_GET['room_type']) ? (int)$_GET['room_type'] : null;
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-5">
            <h1 class="text-white fw-bold">Réservation</h1>
            <p class="text-light opacity-75">Réservez votre séjour en quelques clics</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Booking Form -->
        <div class="col-lg-8">
            <div class="form-glass">
                <h3 class="text-white mb-4">
                    <i class="bi bi-calendar-check text-primary me-2"></i>
                    Détails de Réservation
                </h3>
                
                <form id="bookingForm" method="POST" action="api/process_booking.php">
                    <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                    
                    <!-- Dates Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="checkIn" class="form-label text-white">
                                <i class="bi bi-calendar-date me-1"></i>Date d'arrivée
                            </label>
                            <input type="date" class="form-control" id="checkIn" name="check_in" required>
                        </div>
                        <div class="col-md-6">
                            <label for="checkOut" class="form-label text-white">
                                <i class="bi bi-calendar-x me-1"></i>Date de départ
                            </label>
                            <input type="date" class="form-control" id="checkOut" name="check_out" required>
                        </div>
                    </div>

                    <!-- Guests Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="adults" class="form-label text-white">
                                <i class="bi bi-people me-1"></i>Adultes
                            </label>
                            <select class="form-control" id="adults" name="adults" required>
                                <option value="1">1 Adulte</option>
                                <option value="2" selected>2 Adultes</option>
                                <option value="3">3 Adultes</option>
                                <option value="4">4 Adultes</option>
                                <option value="5">5 Adultes</option>
                                <option value="6">6 Adultes</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="children" class="form-label text-white">
                                <i class="bi bi-emoji-smile me-1"></i>Enfants
                            </label>
                            <select class="form-control" id="children" name="children">
                                <option value="0" selected>0 Enfant</option>
                                <option value="1">1 Enfant</option>
                                <option value="2">2 Enfants</option>
                                <option value="3">3 Enfants</option>
                                <option value="4">4 Enfants</option>
                            </select>
                        </div>
                    </div>

                    <!-- Room Type Section -->
                    <div class="mb-4">
                        <label for="roomType" class="form-label text-white">
                            <i class="bi bi-door-open me-1"></i>Type de chambre
                        </label>
                        <select class="form-control" id="roomType" name="room_type" required>
                            <option value="">Sélectionnez un type de chambre</option>
                            <?php
                            try {
                                $stmt = $db->query("SELECT * FROM room_types ORDER BY base_price ASC");
                                $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($roomTypes as $room) {
                                    $selected = ($selected_room_type == $room['id']) ? 'selected' : '';
                                    echo "<option value='{$room['id']}' data-price='{$room['base_price']}' {$selected}>";
                                    echo htmlspecialchars($room['name']) . " - " . formatCurrency($room['base_price']) . "/nuit";
                                    echo "</option>";
                                }
                            } catch (PDOException $e) {
                                // Fallback options
                                echo '<option value="1" data-price="45000">Chambre Standard - 45 000 FCFA/nuit</option>';
                                echo '<option value="2" data-price="65000">Chambre Deluxe - 65 000 FCFA/nuit</option>';
                                echo '<option value="3" data-price="95000">Suite Junior - 95 000 FCFA/nuit</option>';
                                echo '<option value="4" data-price="150000">Suite Présidentielle - 150 000 FCFA/nuit</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Availability Check -->
                    <div id="availability" class="mb-4"></div>

                    <!-- Guest Information -->
                    <div class="mb-4">
                        <h4 class="text-white mb-3">
                            <i class="bi bi-person-circle text-primary me-2"></i>
                            Informations Client Principal
                        </h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label text-white">Prénom *</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label text-white">Nom *</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-white">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label text-white">Téléphone *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required 
                                       placeholder="+237 6XX XXX XXX">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="idType" class="form-label text-white">Type de pièce d'identité *</label>
                                <select class="form-control" id="idType" name="id_type" required>
                                    <option value="">Sélectionnez</option>
                                    <option value="passport">Passeport</option>
                                    <option value="national_id">Carte d'identité nationale</option>
                                    <option value="driving_license">Permis de conduire</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="idNumber" class="form-label text-white">Numéro de pièce d'identité *</label>
                                <input type="text" class="form-control" id="idNumber" name="id_number" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nationality" class="form-label text-white">Nationalité</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" 
                                       placeholder="Ex: Camerounaise">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dateOfBirth" class="form-label text-white">Date de naissance</label>
                                <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth">
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div class="mb-4">
                        <label for="specialRequests" class="form-label text-white">
                            <i class="bi bi-chat-text me-1"></i>Demandes spéciales
                        </label>
                        <textarea class="form-control" id="specialRequests" name="special_requests" 
                                  rows="3" placeholder="Toute demande particulière..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                            <i class="bi bi-check-circle me-2"></i>Confirmer la Réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Booking Summary -->
        <div class="col-lg-4">
            <!-- Pricing Summary -->
            <div id="pricing" class="mb-4">
                <div class="glass-card p-4 text-center">
                    <h5 class="text-white mb-3">Sélectionnez un type de chambre</h5>
                    <p class="text-light opacity-75">Pour voir le prix</p>
                </div>
            </div>

            <!-- Hotel Information -->
            <div class="glass-card p-4 mb-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-info-circle text-primary me-2"></i>
                    Informations Importantes
                </h5>
                <ul class="list-unstyled text-light">
                    <li class="mb-2">
                        <i class="bi bi-clock text-success me-2"></i>
                        <strong>Arrivée:</strong> À partir de 14h00
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-clock text-danger me-2"></i>
                        <strong>Départ:</strong> Avant 12h00
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-credit-card text-warning me-2"></i>
                        <strong>Paiement:</strong> Espèces, Carte, Mobile Money
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-x-circle text-info me-2"></i>
                        <strong>Annulation:</strong> Gratuite 24h avant
                    </li>
                </ul>
            </div>

            <!-- Services Included -->
            <div class="glass-card p-4 mb-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Services Inclus
                </h5>
                <ul class="list-unstyled text-light">
                    <li class="mb-2">
                        <i class="bi bi-wifi text-primary me-2"></i>WiFi gratuit
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-car-front text-primary me-2"></i>Parking gratuit
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone text-primary me-2"></i>Réception 24h/24
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-shield-check text-primary me-2"></i>Sécurité 24h/24
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-snow text-primary me-2"></i>Climatisation
                    </li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="glass-card p-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-headset text-primary me-2"></i>
                    Besoin d'aide ?
                </h5>
                <p class="text-light opacity-75 mb-3">
                    Notre équipe est disponible pour vous assister
                </p>
                <div class="d-grid gap-2">
                    <a href="tel:+2376XXXXXXX" class="btn btn-outline-custom">
                        <i class="bi bi-telephone me-2"></i>Appeler
                    </a>
                    <a href="index.php?page=contact" class="btn btn-outline-custom">
                        <i class="bi bi-envelope me-2"></i>Email
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Types Display -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <h3 class="text-white text-center mb-4">Nos Types de Chambres</h3>
            <div class="row g-4">
                <?php
                try {
                    $stmt = $db->query("SELECT * FROM room_types ORDER BY base_price ASC");
                    $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($roomTypes as $room):
                        $amenities = json_decode($room['amenities'], true) ?: [];
                ?>
                <div class="col-lg-6 col-xl-3">
                    <div class="room-card">
                        <img src="<?= $room['image'] ?: 'assets/images/rooms/default.jpg' ?>" 
                             alt="<?= htmlspecialchars($room['name']) ?>" 
                             onerror="this.src='assets/images/rooms/placeholder.jpg'">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($room['description']) ?></p>
                            
                            <div class="amenities mb-3">
                                <?php foreach (array_slice($amenities, 0, 4) as $amenity): ?>
                                <small class="badge bg-secondary me-1 mb-1"><?= htmlspecialchars($amenity) ?></small>
                                <?php endforeach; ?>
                                <?php if (count($amenities) > 4): ?>
                                <small class="text-muted">+<?= count($amenities) - 4 ?> autres</small>
                                <?php endif; ?>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="room-price"><?= formatCurrency($room['base_price']) ?></span>
                                <small class="text-muted">par nuit</small>
                            </div>
                            
                            <div class="mb-3">
                                <span class="badge bg-primary">
                                    <i class="bi bi-people"></i> <?= $room['max_occupancy'] ?> pers.
                                </span>
                            </div>
                            
                            <button type="button" class="btn btn-primary-custom w-100 select-room-btn" 
                                    data-room-id="<?= $room['id'] ?>" 
                                    data-room-name="<?= htmlspecialchars($room['name']) ?>"
                                    data-room-price="<?= $room['base_price'] ?>">
                                Sélectionner
                            </button>
                        </div>
                    </div>
                </div>
                <?php 
                    endforeach;
                } catch (PDOException $e) {
                    echo '<div class="col-12 text-center text-white">Erreur lors du chargement des chambres.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
// Room selection functionality
document.addEventListener('DOMContentLoaded', function() {
    const selectRoomBtns = document.querySelectorAll('.select-room-btn');
    const roomTypeSelect = document.getElementById('roomType');
    
    selectRoomBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const roomId = this.getAttribute('data-room-id');
            roomTypeSelect.value = roomId;
            
            // Trigger change event to update pricing
            roomTypeSelect.dispatchEvent(new Event('change'));
            
            // Scroll to form
            document.getElementById('bookingForm').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
            
            // Highlight selected room temporarily
            document.querySelectorAll('.room-card').forEach(card => {
                card.classList.remove('border-primary');
            });
            this.closest('.room-card').classList.add('border-primary');
            
            setTimeout(() => {
                this.closest('.room-card').classList.remove('border-primary');
            }, 3000);
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>