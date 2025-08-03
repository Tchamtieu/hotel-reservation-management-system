<?php
$page_title = "Services";
include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-5">
            <h1 class="text-white fw-bold">Nos Services</h1>
            <p class="text-light opacity-75">Une gamme complète de services pour votre confort</p>
        </div>
    </div>

    <!-- Hero Services Section -->
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="glass-card p-5 text-center">
                <h2 class="text-white fw-bold mb-3">L'Excellence du Service Camerounais</h2>
                <p class="text-light opacity-75 lead">
                    Découvrez nos services personnalisés, conçus pour répondre à tous vos besoins 
                    dans l'esprit de l'hospitalité traditionnelle camerounaise.
                </p>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="row g-4 mb-5">
        <!-- Restaurant Services -->
        <div class="col-lg-6">
            <div class="service-card h-100">
                <div class="icon text-center mb-3">
                    <i class="bi bi-cup-hot" style="color: var(--primary-color);"></i>
                </div>
                <h3 class="text-center mb-3">Restaurant & Bar</h3>
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">🍽️ Restaurant Gastronomique</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Cuisine camerounaise authentique</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Spécialités internationales</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Menu végétarien et vegan</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Service en chambre 24h/24</li>
                        </ul>
                        
                        <h6 class="mt-4 mb-2">🕐 Horaires</h6>
                        <p class="text-muted small">
                            Petit-déjeuner: 6h00 - 11h00<br>
                            Déjeuner: 12h00 - 15h00<br>
                            Dîner: 18h30 - 23h00
                        </p>
                        
                        <div class="text-center mt-3">
                            <span class="badge bg-primary p-2">À partir de 8 500 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spa & Wellness -->
        <div class="col-lg-6">
            <div class="service-card h-100">
                <div class="icon text-center mb-3">
                    <i class="bi bi-flower1" style="color: var(--accent-color);"></i>
                </div>
                <h3 class="text-center mb-3">Spa & Wellness</h3>
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">🌿 Centre de Bien-être</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Massages thérapeutiques</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Soins du visage traditionnels</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Sauna et hammam</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Yoga et méditation</li>
                        </ul>
                        
                        <h6 class="mt-4 mb-2">🕐 Horaires</h6>
                        <p class="text-muted small">
                            Lundi - Dimanche: 9h00 - 21h00<br>
                            Réservation recommandée
                        </p>
                        
                        <div class="text-center mt-3">
                            <span class="badge bg-danger p-2">À partir de 25 000 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Business Services -->
        <div class="col-lg-6">
            <div class="service-card h-100">
                <div class="icon text-center mb-3">
                    <i class="bi bi-briefcase" style="color: var(--secondary-color);"></i>
                </div>
                <h3 class="text-center mb-3">Centre d'Affaires</h3>
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">💼 Services Professionnels</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Salles de réunion équipées</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>WiFi haut débit gratuit</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Services de secrétariat</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Équipements audiovisuels</li>
                        </ul>
                        
                        <h6 class="mt-4 mb-2">📋 Capacités</h6>
                        <p class="text-muted small">
                            Salle de conférence: 50 personnes<br>
                            Salles de réunion: 8-12 personnes<br>
                            Business lounge: 24h/24
                        </p>
                        
                        <div class="text-center mt-3">
                            <span class="badge bg-warning p-2 text-dark">À partir de 15 000 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transport & Concierge -->
        <div class="col-lg-6">
            <div class="service-card h-100">
                <div class="icon text-center mb-3">
                    <i class="bi bi-car-front" style="color: var(--primary-color);"></i>
                </div>
                <h3 class="text-center mb-3">Transport & Conciergerie</h3>
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3">🚗 Services de Transport</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Navette aéroport</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Location de voitures</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Excursions touristiques</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Service de conciergerie 24h</li>
                        </ul>
                        
                        <h6 class="mt-4 mb-2">🎯 Destinations populaires</h6>
                        <p class="text-muted small">
                            Aéroport Nsimalen<br>
                            Centre-ville Yaoundé<br>
                            Sites touristiques régionaux
                        </p>
                        
                        <div class="text-center mt-3">
                            <span class="badge bg-info p-2">À partir de 15 000 FCFA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Services Section -->
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="glass-card p-4">
                <h3 class="text-white text-center mb-4">Services Complémentaires</h3>
                <div class="row g-4">
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            <i class="bi bi-wifi text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-white">WiFi Gratuit</h6>
                        <p class="text-light opacity-75 small">Internet haut débit dans tout l'hôtel</p>
                    </div>
                    
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            <i class="bi bi-shield-check text-success" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-white">Sécurité 24h</h6>
                        <p class="text-light opacity-75 small">Service de sécurité professionnel</p>
                    </div>
                    
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            <i class="bi bi-clock text-warning" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-white">Réception 24h</h6>
                        <p class="text-light opacity-75 small">Personnel disponible en permanence</p>
                    </div>
                    
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            <i class="bi bi-translate text-info" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-white">Personnel Multilingue</h6>
                        <p class="text-light opacity-75 small">Français, Anglais, langues locales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Pricing Table -->
    <div class="row mb-5">
        <div class="col-lg-12">
            <h3 class="text-white text-center mb-4">Tarifs des Services</h3>
            <div class="table-responsive">
                <div class="table-glass">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-white">Service</th>
                                <th class="text-white">Description</th>
                                <th class="text-white">Prix</th>
                                <th class="text-white">Durée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $db->query("SELECT * FROM services WHERE is_active = 1 ORDER BY category, price");
                                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($services as $service):
                            ?>
                            <tr>
                                <td class="text-dark fw-bold"><?= htmlspecialchars($service['name']) ?></td>
                                <td class="text-dark"><?= htmlspecialchars($service['description']) ?></td>
                                <td class="text-dark fw-bold text-success"><?= formatCurrency($service['price']) ?></td>
                                <td class="text-dark">
                                    <?php
                                    switch($service['category']) {
                                        case 'restaurant': echo 'Par portion'; break;
                                        case 'spa': echo '60 min'; break;
                                        case 'transport': echo 'Par trajet'; break;
                                        default: echo 'Variable';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php 
                                endforeach;
                            } catch (PDOException $e) {
                                // Fallback pricing if database is not available
                                $fallbackServices = [
                                    ['name' => 'Petit-déjeuner Continental', 'description' => 'Buffet varié avec spécialités locales', 'price' => 8500, 'duration' => 'Par personne'],
                                    ['name' => 'Massage Relaxant', 'description' => 'Massage thérapeutique aux huiles essentielles', 'price' => 25000, 'duration' => '60 min'],
                                    ['name' => 'Service de Blanchisserie', 'description' => 'Nettoyage et repassage express', 'price' => 5000, 'duration' => '24h'],
                                    ['name' => 'Transport Aéroport', 'description' => 'Navette privée aller-retour', 'price' => 15000, 'duration' => 'Par trajet'],
                                    ['name' => 'Salle de Réunion', 'description' => 'Location salle équipée', 'price' => 20000, 'duration' => 'Par jour'],
                                    ['name' => 'Excursion Ville', 'description' => 'Visite guidée de Yaoundé', 'price' => 35000, 'duration' => 'Demi-journée']
                                ];
                                
                                foreach ($fallbackServices as $service):
                            ?>
                            <tr>
                                <td class="text-dark fw-bold"><?= htmlspecialchars($service['name']) ?></td>
                                <td class="text-dark"><?= htmlspecialchars($service['description']) ?></td>
                                <td class="text-dark fw-bold text-success"><?= formatCurrency($service['price']) ?></td>
                                <td class="text-dark"><?= htmlspecialchars($service['duration']) ?></td>
                            </tr>
                            <?php 
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="glass-card p-5 text-center">
                <h3 class="text-white fw-bold mb-3">Intéressé par nos Services ?</h3>
                <p class="text-light opacity-75 mb-4">
                    Contactez notre équipe pour personnaliser votre séjour selon vos besoins
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="index.php?page=booking" class="btn btn-primary-custom btn-lg w-100">
                                    <i class="bi bi-calendar-check"></i><br>
                                    <small>Réserver</small>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="index.php?page=contact" class="btn btn-outline-custom btn-lg w-100">
                                    <i class="bi bi-telephone"></i><br>
                                    <small>Nous Contacter</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add hover effects to service cards
document.addEventListener('DOMContentLoaded', function() {
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>