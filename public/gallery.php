<?php
$page_title = "Galerie";
include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-5">
            <h1 class="text-white fw-bold">Galerie Photos</h1>
            <p class="text-light opacity-75">Découvrez nos installations et services en images</p>
        </div>
    </div>
    
    <!-- Filter Buttons -->
    <div class="row mb-4">
        <div class="col-lg-12 text-center">
            <div class="btn-group glass-card p-2" role="group">
                <button type="button" class="btn btn-outline-light active" data-filter="all">
                    Tout Voir
                </button>
                <button type="button" class="btn btn-outline-light" data-filter="rooms">
                    Chambres
                </button>
                <button type="button" class="btn btn-outline-light" data-filter="restaurant">
                    Restaurant
                </button>
                <button type="button" class="btn btn-outline-light" data-filter="spa">
                    Spa
                </button>
                <button type="button" class="btn btn-outline-light" data-filter="facilities">
                    Installations
                </button>
                <button type="button" class="btn btn-outline-light" data-filter="exterior">
                    Extérieur
                </button>
            </div>
        </div>
    </div>
    
    <!-- Gallery Grid -->
    <div class="gallery-grid">
        <?php
        try {
            $stmt = $db->query("SELECT * FROM gallery_images ORDER BY display_order, created_at DESC");
            $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($images as $image):
        ?>
        <div class="gallery-item animate-on-scroll" data-category="<?= $image['category'] ?>">
            <img src="<?= htmlspecialchars($image['image_path']) ?>" 
                 alt="<?= htmlspecialchars($image['title']) ?>"
                 onerror="this.src='assets/images/gallery/placeholder.jpg'">
            <div class="gallery-overlay">
                <i class="bi bi-zoom-in"></i>
            </div>
            <div class="position-absolute bottom-0 start-0 p-3 w-100" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                <h6 class="text-white mb-1"><?= htmlspecialchars($image['title']) ?></h6>
                <?php if ($image['description']): ?>
                <small class="text-light opacity-75"><?= htmlspecialchars($image['description']) ?></small>
                <?php endif; ?>
            </div>
        </div>
        <?php 
            endforeach;
        } catch (PDOException $e) {
            // Fallback images if database is not available
            $fallbackImages = [
                [
                    'title' => 'Façade Principale',
                    'description' => 'Vue de la façade principale de l\'hôtel',
                    'image_path' => 'assets/images/gallery/facade.jpg',
                    'category' => 'exterior'
                ],
                [
                    'title' => 'Chambre Deluxe',
                    'description' => 'Intérieur d\'une chambre deluxe',
                    'image_path' => 'assets/images/gallery/room-deluxe.jpg',
                    'category' => 'rooms'
                ],
                [
                    'title' => 'Restaurant Panoramique',
                    'description' => 'Vue du restaurant avec terrasse',
                    'image_path' => 'assets/images/gallery/restaurant.jpg',
                    'category' => 'restaurant'
                ],
                [
                    'title' => 'Spa Wellness',
                    'description' => 'Centre de bien-être et spa',
                    'image_path' => 'assets/images/gallery/spa.jpg',
                    'category' => 'spa'
                ],
                [
                    'title' => 'Piscine Infinity',
                    'description' => 'Piscine à débordement avec vue sur la ville',
                    'image_path' => 'assets/images/gallery/pool.jpg',
                    'category' => 'facilities'
                ],
                [
                    'title' => 'Lobby Principal',
                    'description' => 'Hall d\'accueil avec décoration moderne',
                    'image_path' => 'assets/images/gallery/lobby.jpg',
                    'category' => 'facilities'
                ],
                [
                    'title' => 'Chambre Standard',
                    'description' => 'Chambre confortable avec vue sur la ville',
                    'image_path' => 'assets/images/gallery/room-standard.jpg',
                    'category' => 'rooms'
                ],
                [
                    'title' => 'Terrasse Restaurant',
                    'description' => 'Terrasse extérieure du restaurant',
                    'image_path' => 'assets/images/gallery/terrace.jpg',
                    'category' => 'restaurant'
                ],
                [
                    'title' => 'Salle de Massage',
                    'description' => 'Espace détente pour massages',
                    'image_path' => 'assets/images/gallery/massage.jpg',
                    'category' => 'spa'
                ],
                [
                    'title' => 'Jardin Tropical',
                    'description' => 'Jardin avec végétation tropicale',
                    'image_path' => 'assets/images/gallery/garden.jpg',
                    'category' => 'exterior'
                ],
                [
                    'title' => 'Suite Présidentielle',
                    'description' => 'Notre suite de luxe avec terrasse privée',
                    'image_path' => 'assets/images/gallery/presidential-suite.jpg',
                    'category' => 'rooms'
                ],
                [
                    'title' => 'Centre de Fitness',
                    'description' => 'Salle de sport moderne et équipée',
                    'image_path' => 'assets/images/gallery/fitness.jpg',
                    'category' => 'facilities'
                ]
            ];
            
            foreach ($fallbackImages as $image):
        ?>
        <div class="gallery-item animate-on-scroll" data-category="<?= $image['category'] ?>">
            <img src="<?= htmlspecialchars($image['image_path']) ?>" 
                 alt="<?= htmlspecialchars($image['title']) ?>"
                 onerror="this.src='assets/images/gallery/placeholder.jpg'">
            <div class="gallery-overlay">
                <i class="bi bi-zoom-in"></i>
            </div>
            <div class="position-absolute bottom-0 start-0 p-3 w-100" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                <h6 class="text-white mb-1"><?= htmlspecialchars($image['title']) ?></h6>
                <small class="text-light opacity-75"><?= htmlspecialchars($image['description']) ?></small>
            </div>
        </div>
        <?php 
            endforeach;
        }
        ?>
    </div>
    
    <!-- No Results Message -->
    <div id="noResults" class="text-center py-5" style="display: none;">
        <div class="glass-card p-5">
            <i class="bi bi-search text-white opacity-50" style="font-size: 3rem;"></i>
            <h4 class="text-white mt-3">Aucune image trouvée</h4>
            <p class="text-light opacity-75">Essayez de sélectionner une autre catégorie.</p>
        </div>
    </div>
</div>

<!-- Featured Carousel Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h2 class="text-white fw-bold">Images Vedettes</h2>
                <p class="text-light opacity-75">Les plus belles vues de notre hôtel</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div id="featuredCarousel" class="carousel slide glass-card p-3" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="3"></button>
                    </div>
                    
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="assets/images/gallery/hero-1.jpg" 
                                 class="d-block w-100" 
                                 alt="Vue panoramique de l'hôtel"
                                 style="height: 400px; object-fit: cover;"
                                 onerror="this.src='assets/images/gallery/placeholder.jpg'">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Vue Panoramique</h5>
                                <p>Découvrez notre hôtel dans son environnement exceptionnel.</p>
                            </div>
                        </div>
                        
                        <div class="carousel-item">
                            <img src="assets/images/gallery/hero-2.jpg" 
                                 class="d-block w-100" 
                                 alt="Chambre de luxe"
                                 style="height: 400px; object-fit: cover;"
                                 onerror="this.src='assets/images/gallery/placeholder.jpg'">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Confort Moderne</h5>
                                <p>Des chambres élégantes alliant tradition et modernité.</p>
                            </div>
                        </div>
                        
                        <div class="carousel-item">
                            <img src="assets/images/gallery/hero-3.jpg" 
                                 class="d-block w-100" 
                                 alt="Restaurant gastronomique"
                                 style="height: 400px; object-fit: cover;"
                                 onerror="this.src='assets/images/gallery/placeholder.jpg'">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Gastronomie Raffinée</h5>
                                <p>Savourez une cuisine d'exception dans un cadre unique.</p>
                            </div>
                        </div>
                        
                        <div class="carousel-item">
                            <img src="assets/images/gallery/hero-4.jpg" 
                                 class="d-block w-100" 
                                 alt="Spa et détente"
                                 style="height: 400px; object-fit: cover;"
                                 onerror="this.src='assets/images/gallery/placeholder.jpg'">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Détente Absolue</h5>
                                <p>Relaxez-vous dans notre spa aux soins authentiques.</p>
                            </div>
                        </div>
                    </div>
                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Gallery filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const noResultsMessage = document.getElementById('noResults');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter gallery items
            let visibleCount = 0;
            galleryItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    visibleCount++;
                    // Add animation
                    setTimeout(() => {
                        item.classList.add('fade-in');
                    }, 100);
                } else {
                    item.style.display = 'none';
                    item.classList.remove('fade-in');
                }
            });
            
            // Show/hide no results message
            if (visibleCount === 0) {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>