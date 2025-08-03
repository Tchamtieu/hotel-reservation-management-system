<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Cameroun - Luxury Boutique Experience</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
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
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Gallery</a>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg">
            <img src="assets/images/hilton-yaounde-hero.jpg" alt="Hilton Yaoundé" class="hero-image">
            <div class="hero-overlay"></div>
        </div>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content glassmorphism p-5">
                        <h1 class="display-4 fw-bold mb-4">Welcome to <span class="text-primary">Cameroun's</span> Finest Hotels</h1>
                        <p class="lead mb-4">Experience luxury and comfort in the heart of Cameroon. From the bustling capital of Yaoundé to the scenic mountains of Buea.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="booking.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-calendar-check me-2"></i>Book Now
                            </a>
                            <a href="gallery.php" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-images me-2"></i>View Gallery
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Hotels -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Our Premium Locations</h2>
                    <p class="lead text-muted">Discover exceptional hospitality across Cameroon</p>
                </div>
            </div>
            <div class="row g-4">
                <!-- Hilton Yaoundé -->
                <div class="col-md-4">
                    <div class="card hotel-card glassmorphism h-100">
                        <img src="assets/images/hilton-yaounde.jpg" class="card-img-top" alt="Hilton Yaoundé">
                        <div class="card-body">
                            <h5 class="card-title">Hilton Yaoundé</h5>
                            <p class="card-text">Luxury in the heart of Cameroon's capital city. Modern amenities with traditional charm.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">From 85,000 FCFA/night</span>
                                <a href="booking.php?hotel=hilton-yaounde" class="btn btn-primary">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- K Hotel Douala -->
                <div class="col-md-4">
                    <div class="card hotel-card glassmorphism h-100">
                        <img src="assets/images/k-hotel-douala.jpg" class="card-img-top" alt="K Hotel Douala">
                        <div class="card-body">
                            <h5 class="card-title">K Hotel Douala</h5>
                            <p class="card-text">Contemporary elegance in Cameroon's economic capital. Perfect for business and leisure.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">From 75,000 FCFA/night</span>
                                <a href="booking.php?hotel=k-hotel-douala" class="btn btn-primary">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mountain Hotel Buea -->
                <div class="col-md-4">
                    <div class="card hotel-card glassmorphism h-100">
                        <img src="assets/images/mountain-hotel-buea.jpg" class="card-img-top" alt="Mountain Hotel Buea">
                        <div class="card-body">
                            <h5 class="card-title">Mountain Hotel Buea</h5>
                            <p class="card-text">Breathtaking mountain views and serene atmosphere. Your perfect retreat destination.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">From 65,000 FCFA/night</span>
                                <a href="booking.php?hotel=mountain-hotel-buea" class="btn btn-primary">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">World-Class Amenities</h2>
                    <p class="lead text-muted">Everything you need for an unforgettable stay</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="service-card glassmorphism text-center p-4 h-100">
                        <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                        <h5>Luxury Spa</h5>
                        <p>Rejuvenate with traditional and modern wellness treatments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="service-card glassmorphism text-center p-4 h-100">
                        <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                        <h5>Fine Dining</h5>
                        <p>Authentic Cameroonian cuisine and international delicacies</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="service-card glassmorphism text-center p-4 h-100">
                        <i class="fas fa-swimming-pool fa-3x text-primary mb-3"></i>
                        <h5>Pool & Recreation</h5>
                        <p>Relax by our infinity pools with stunning city views</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="service-card glassmorphism text-center p-4 h-100">
                        <i class="fas fa-briefcase fa-3x text-primary mb-3"></i>
                        <h5>Business Center</h5>
                        <p>State-of-the-art facilities for meetings and conferences</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content glassmorphism text-center p-5">
                        <h2 class="display-5 fw-bold mb-3">Ready for Your Cameroonian Adventure?</h2>
                        <p class="lead mb-4">Book your stay today and experience the warmth of Cameroonian hospitality</p>
                        <a href="booking.php" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-calendar-check me-2"></i>Book Your Stay
                        </a>
                        <a href="contact.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-phone me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</body>
</html>