<?php
$page_title = "Accueil";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="hero-content animate-on-scroll">
                    <h1 class="text-shadow">Bienvenue à l'Hôtel Boutique Cameroun</h1>
                    <p class="lead">
                        Découvrez l'hospitalité camerounaise dans un cadre moderne et élégant. 
                        Votre confort au cœur de Yaoundé.
                    </p>
                    <div class="mt-4">
                        <a href="index.php?page=booking" class="btn btn-primary-custom btn-lg me-3">
                            <i class="bi bi-calendar-check"></i> Réserver Maintenant
                        </a>
                        <a href="index.php?page=gallery" class="btn btn-outline-custom btn-lg">
                            <i class="bi bi-images"></i> Découvrir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="text-white fw-bold">Pourquoi Choisir Notre Hôtel ?</h2>
                <p class="text-light opacity-75">Une expérience unique au cœur du Cameroun</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="service-card animate-on-scroll">
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h4>Emplacement Privilégié</h4>
                    <p>Situé au cœur de Yaoundé, proche des attractions touristiques et du centre d'affaires.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="service-card animate-on-scroll">
                    <div class="icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <h4>Service Premium</h4>
                    <p>Un service personnalisé et attentionné, dans le respect des traditions camerounaises.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="service-card animate-on-scroll">
                    <div class="icon">
                        <i class="bi bi-cup-hot"></i>
                    </div>
                    <h4>Gastronomie Locale</h4>
                    <p>Savourez les saveurs authentiques du Cameroun dans notre restaurant gastronomique.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="service-card animate-on-scroll">
                    <div class="icon">
                        <i class="bi bi-wifi"></i>
                    </div>
                    <h4>Équipements Modernes</h4>
                    <p>WiFi haut débit, climatisation, et tous les équipements pour votre confort.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Room Types Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="text-white fw-bold">Nos Chambres</h2>
                <p class="text-light opacity-75">Choisissez parmi nos différents types de chambres</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php
            // Fetch room types from database
            try {
                $stmt = $db->query("SELECT * FROM room_types ORDER BY base_price ASC");
                $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($roomTypes as $room):
            ?>
            <div class="col-lg-6 col-xl-3">
                <div class="room-card animate-on-scroll">
                    <img src="<?= $room['image'] ?: 'assets/images/rooms/default.jpg' ?>" 
                         alt="<?= htmlspecialchars($room['name']) ?>" 
                         class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($room['description']) ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="room-price"><?= formatCurrency($room['base_price']) ?></span>
                            <small class="text-muted">par nuit</small>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-primary">
                                <i class="bi bi-people"></i> <?= $room['max_occupancy'] ?> pers.
                            </span>
                        </div>
                        <a href="index.php?page=booking&room_type=<?= $room['id'] ?>" 
                           class="btn btn-primary-custom w-100 mt-3">
                            Réserver
                        </a>
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
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="text-white fw-bold">Ce Que Disent Nos Clients</h2>
                <p class="text-light opacity-75">Témoignages authentiques de nos invités</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="glass-card p-4 text-center">
                    <div class="mb-3">
                        <img src="assets/images/avatars/client1.jpg" 
                             alt="Client" 
                             class="rounded-circle" 
                             width="80" height="80"
                             onerror="this.src='assets/images/avatars/default.jpg'">
                    </div>
                    <blockquote class="blockquote">
                        <p class="text-white">"Un séjour exceptionnel ! L'hospitalité camerounaise à son meilleur. Je recommande vivement."</p>
                    </blockquote>
                    <footer class="blockquote-footer text-light">
                        <cite title="Source Title">Marie Dubois, Paris</cite>
                    </footer>
                    <div class="mt-2">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="glass-card p-4 text-center">
                    <div class="mb-3">
                        <img src="assets/images/avatars/client2.jpg" 
                             alt="Client" 
                             class="rounded-circle" 
                             width="80" height="80"
                             onerror="this.src='assets/images/avatars/default.jpg'">
                    </div>
                    <blockquote class="blockquote">
                        <p class="text-white">"Excellent service, chambres confortables et cuisine délicieuse. Une expérience mémorable."</p>
                    </blockquote>
                    <footer class="blockquote-footer text-light">
                        <cite title="Source Title">John Smith, Londres</cite>
                    </footer>
                    <div class="mt-2">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="glass-card p-4 text-center">
                    <div class="mb-3">
                        <img src="assets/images/avatars/client3.jpg" 
                             alt="Client" 
                             class="rounded-circle" 
                             width="80" height="80"
                             onerror="this.src='assets/images/avatars/default.jpg'">
                    </div>
                    <blockquote class="blockquote">
                        <p class="text-white">"L'endroit parfait pour découvrir Yaoundé. Personnel attentionné et installations modernes."</p>
                    </blockquote>
                    <footer class="blockquote-footer text-light">
                        <cite title="Source Title">Fatou Mbarga, Douala</cite>
                    </footer>
                    <div class="mt-2">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="glass-card p-5 text-center">
                    <h2 class="text-white fw-bold mb-3">Prêt à Vivre l'Expérience ?</h2>
                    <p class="text-light opacity-75 mb-4">
                        Réservez dès maintenant et profitez de notre hospitalité légendaire
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="index.php?page=booking" class="btn btn-primary-custom btn-lg w-100">
                                        <i class="bi bi-calendar-check"></i><br>
                                        <small>Réserver</small>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="index.php?page=contact" class="btn btn-outline-custom btn-lg w-100">
                                        <i class="bi bi-telephone"></i><br>
                                        <small>Nous Contacter</small>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="index.php?page=services" class="btn btn-outline-custom btn-lg w-100">
                                        <i class="bi bi-star"></i><br>
                                        <small>Nos Services</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>