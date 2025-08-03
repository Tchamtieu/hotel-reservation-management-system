<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Hotel Cameroun</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gallery.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top glassmorphism">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-hotel me-2"></i>Hotel Cameroun
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="gallery.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking.php">Book Now</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary ms-2 px-3" href="login.php">Staff Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold text-white mb-3">Gallery</h1>
                    <p class="lead text-white">Discover the beauty and elegance of our Cameroonian hotels</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.php" class="text-light">Home</a></li>
                            <li class="breadcrumb-item active text-secondary">Gallery</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Carousel -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Featured Views</h2>
                    <p class="lead text-muted">Experience the stunning beauty of our premium locations</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="featuredCarousel" class="carousel slide glassmorphism p-4" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/images/hilton-yaounde-featured.jpg" class="d-block w-100 carousel-image" alt="Hilton Yaoundé">
                                <div class="carousel-caption d-none d-md-block glassmorphism p-4">
                                    <h5>Hilton Yaoundé</h5>
                                    <p>Luxury accommodation in the heart of Cameroon's capital city with panoramic city views.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="assets/images/k-hotel-douala-featured.jpg" class="d-block w-100 carousel-image" alt="K Hotel Douala">
                                <div class="carousel-caption d-none d-md-block glassmorphism p-4">
                                    <h5>K Hotel Douala</h5>
                                    <p>Contemporary elegance and modern amenities in Cameroon's economic capital.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="assets/images/mountain-hotel-buea-featured.jpg" class="d-block w-100 carousel-image" alt="Mountain Hotel Buea">
                                <div class="carousel-caption d-none d-md-block glassmorphism p-4">
                                    <h5>Mountain Hotel Buea</h5>
                                    <p>Breathtaking mountain views and serene atmosphere at the foot of Mount Cameroon.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Filters -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Explore Our Collection</h2>
                    <div class="gallery-filters">
                        <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="rooms">Rooms</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="restaurants">Restaurants</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="amenities">Amenities</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="exterior">Exterior</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="events">Events</button>
                    </div>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="row g-4 gallery-grid">
                <!-- Rooms -->
                <div class="col-lg-4 col-md-6 gallery-item" data-category="rooms">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/deluxe-suite-hilton.jpg" alt="Deluxe Suite" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Deluxe Suite</h5>
                                <p>Hilton Yaoundé</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/deluxe-suite-hilton.jpg" data-title="Deluxe Suite - Hilton Yaoundé">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="rooms">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/executive-room-khotel.jpg" alt="Executive Room" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Executive Room</h5>
                                <p>K Hotel Douala</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/executive-room-khotel.jpg" data-title="Executive Room - K Hotel Douala">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="rooms">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/mountain-view-room.jpg" alt="Mountain View Room" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Mountain View Room</h5>
                                <p>Mountain Hotel Buea</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/mountain-view-room.jpg" data-title="Mountain View Room - Mountain Hotel Buea">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Restaurants -->
                <div class="col-lg-4 col-md-6 gallery-item" data-category="restaurants">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/fine-dining-restaurant.jpg" alt="Fine Dining Restaurant" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Fine Dining Restaurant</h5>
                                <p>Authentic Cameroonian Cuisine</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/fine-dining-restaurant.jpg" data-title="Fine Dining Restaurant">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="restaurants">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/rooftop-bar.jpg" alt="Rooftop Bar" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Rooftop Bar</h5>
                                <p>Panoramic City Views</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/rooftop-bar.jpg" data-title="Rooftop Bar">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="restaurants">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/lobby-cafe.jpg" alt="Lobby Café" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Lobby Café</h5>
                                <p>Perfect for Business Meetings</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/lobby-cafe.jpg" data-title="Lobby Café">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="col-lg-4 col-md-6 gallery-item" data-category="amenities">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/infinity-pool.jpg" alt="Infinity Pool" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Infinity Pool</h5>
                                <p>Relax with Stunning Views</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/infinity-pool.jpg" data-title="Infinity Pool">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="amenities">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/luxury-spa.jpg" alt="Luxury Spa" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Luxury Spa</h5>
                                <p>Traditional & Modern Treatments</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/luxury-spa.jpg" data-title="Luxury Spa">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="amenities">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/fitness-center.jpg" alt="Fitness Center" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Fitness Center</h5>
                                <p>State-of-the-Art Equipment</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/fitness-center.jpg" data-title="Fitness Center">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exterior -->
                <div class="col-lg-4 col-md-6 gallery-item" data-category="exterior">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/hilton-exterior-night.jpg" alt="Hilton Exterior Night" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Hilton at Night</h5>
                                <p>Stunning Architecture</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/hilton-exterior-night.jpg" data-title="Hilton Yaoundé at Night">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="exterior">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/mountain-hotel-exterior.jpg" alt="Mountain Hotel Exterior" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Mountain Hotel</h5>
                                <p>Natural Beauty of Buea</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/mountain-hotel-exterior.jpg" data-title="Mountain Hotel Buea Exterior">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Events -->
                <div class="col-lg-4 col-md-6 gallery-item" data-category="events">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/conference-hall.jpg" alt="Conference Hall" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Conference Hall</h5>
                                <p>Business Events & Meetings</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/conference-hall.jpg" data-title="Conference Hall">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 gallery-item" data-category="events">
                    <div class="gallery-card glassmorphism">
                        <img src="assets/images/gallery/wedding-venue.jpg" alt="Wedding Venue" class="gallery-image">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <h5>Wedding Venue</h5>
                                <p>Romantic Celebrations</p>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="assets/images/gallery/wedding-venue.jpg" data-title="Wedding Venue">
                                    <i class="fas fa-expand me-2"></i>View
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content glassmorphism">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="imageModalLabel">Image Gallery</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <img src="" alt="" class="img-fluid w-100" id="modalImage">
                </div>
                <div class="modal-footer border-0 justify-content-between">
                    <button type="button" class="btn btn-outline-light" id="prevImage">
                        <i class="fas fa-chevron-left me-2"></i>Previous
                    </button>
                    <button type="button" class="btn btn-outline-light" id="nextImage">
                        Next<i class="fas fa-chevron-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-hotel me-2"></i>Hotel Cameroun</h5>
                    <p>Experience the finest in Cameroonian hospitality with our luxury boutique hotels across the country.</p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-light">Home</a></li>
                        <li><a href="gallery.php" class="text-light">Gallery</a></li>
                        <li><a href="services.php" class="text-light">Services</a></li>
                        <li><a href="booking.php" class="text-light">Booking</a></li>
                        <li><a href="contact.php" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Our Locations</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Yaoundé - Hilton</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Douala - K Hotel</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Buea - Mountain Hotel</li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Contact Info</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i>+237 222 123 456</li>
                        <li><i class="fas fa-envelope me-2"></i>info@hotelcameroun.com</li>
                        <li><i class="fas fa-clock me-2"></i>24/7 Reception</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; 2024 Hotel Cameroun. All rights reserved. | Luxury hospitality across Cameroon</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/gallery.js"></script>
</body>
</html>