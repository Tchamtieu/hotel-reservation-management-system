<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Hotel Cameroun</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/services.css">
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
                        <a class="nav-link" href="gallery.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="services.php">Services</a>
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
                    <h1 class="display-4 fw-bold text-white mb-3">Our Services</h1>
                    <p class="lead text-white">Discover world-class amenities and authentic Cameroonian experiences</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.php" class="text-light">Home</a></li>
                            <li class="breadcrumb-item active text-secondary">Services</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Categories -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Experience Excellence</h2>
                    <p class="lead text-muted">From luxury accommodations to cultural adventures</p>
                </div>
            </div>
            
            <!-- Service Filter Tabs -->
            <div class="row mb-4">
                <div class="col-12">
                    <ul class="nav nav-pills service-tabs justify-content-center" id="serviceTabs">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#accommodation" type="button">
                                <i class="fas fa-bed me-2"></i>Accommodation
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#dining" type="button">
                                <i class="fas fa-utensils me-2"></i>Dining
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#wellness" type="button">
                                <i class="fas fa-spa me-2"></i>Wellness
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#business" type="button">
                                <i class="fas fa-briefcase me-2"></i>Business
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#cultural" type="button">
                                <i class="fas fa-mask me-2"></i>Cultural
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Service Content -->
            <div class="tab-content" id="serviceTabContent">
                <!-- Accommodation Services -->
                <div class="tab-pane fade show active" id="accommodation">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100" data-aos="fade-up">
                                <div class="service-icon">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <img src="assets/images/services/presidential-suite.jpg" alt="Presidential Suite" class="service-image">
                                <div class="service-content">
                                    <h5>Presidential Suite</h5>
                                    <p>Ultimate luxury with panoramic city views, private balcony, and personalized butler service.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">300m²</span>
                                        <span class="feature-tag">Butler Service</span>
                                        <span class="feature-tag">City Views</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 250,000 FCFA/night</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="presidential-suite">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100" data-aos="fade-up" data-aos-delay="100">
                                <div class="service-icon">
                                    <i class="fas fa-gem"></i>
                                </div>
                                <img src="assets/images/services/executive-suite.jpg" alt="Executive Suite" class="service-image">
                                <div class="service-content">
                                    <h5>Executive Suite</h5>
                                    <p>Spacious accommodations with separate living area, ideal for business travelers.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">120m²</span>
                                        <span class="feature-tag">Living Area</span>
                                        <span class="feature-tag">Work Desk</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 150,000 FCFA/night</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="executive-suite">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100" data-aos="fade-up" data-aos-delay="200">
                                <div class="service-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <img src="assets/images/services/deluxe-room.jpg" alt="Deluxe Room" class="service-image">
                                <div class="service-content">
                                    <h5>Deluxe Room</h5>
                                    <p>Elegant comfort with modern amenities and beautiful garden or city views.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">45m²</span>
                                        <span class="feature-tag">Garden View</span>
                                        <span class="feature-tag">Free WiFi</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 85,000 FCFA/night</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="deluxe-room">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dining Services -->
                <div class="tab-pane fade" id="dining">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <img src="assets/images/services/fine-dining.jpg" alt="Fine Dining" class="service-image">
                                <div class="service-content">
                                    <h5>Nkomo Restaurant</h5>
                                    <p>Award-winning restaurant featuring authentic Cameroonian cuisine and international dishes.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">Authentic Cuisine</span>
                                        <span class="feature-tag">Chef's Special</span>
                                        <span class="feature-tag">Wine Pairing</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 15,000 FCFA/person</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="nkomo-restaurant">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-cocktail"></i>
                                </div>
                                <img src="assets/images/services/rooftop-bar.jpg" alt="Rooftop Bar" class="service-image">
                                <div class="service-content">
                                    <h5>Sky Lounge</h5>
                                    <p>Panoramic city views with signature cocktails and light bites in an elegant atmosphere.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">City Views</span>
                                        <span class="feature-tag">Signature Cocktails</span>
                                        <span class="feature-tag">Live Music</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 5,000 FCFA/drink</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="sky-lounge">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-coffee"></i>
                                </div>
                                <img src="assets/images/services/coffee-lounge.jpg" alt="Coffee Lounge" class="service-image">
                                <div class="service-content">
                                    <h5>Café Kamerun</h5>
                                    <p>Premium coffee made from locally sourced Cameroonian beans with pastries and light meals.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">Local Coffee</span>
                                        <span class="feature-tag">Fresh Pastries</span>
                                        <span class="feature-tag">Free WiFi</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 2,500 FCFA/coffee</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="cafe-kamerun">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wellness Services -->
                <div class="tab-pane fade" id="wellness">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-spa"></i>
                                </div>
                                <img src="assets/images/services/spa-treatments.jpg" alt="Spa Treatments" class="service-image">
                                <div class="service-content">
                                    <h5>Sankara Spa</h5>
                                    <p>Traditional African healing treatments combined with modern wellness therapies.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">Traditional Healing</span>
                                        <span class="feature-tag">Massage Therapy</span>
                                        <span class="feature-tag">Aromatherapy</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 25,000 FCFA/session</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="sankara-spa">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-swimming-pool"></i>
                                </div>
                                <img src="assets/images/services/infinity-pool.jpg" alt="Infinity Pool" class="service-image">
                                <div class="service-content">
                                    <h5>Infinity Pool</h5>
                                    <p>Spectacular infinity pool with panoramic views and poolside service.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">Infinity Design</span>
                                        <span class="feature-tag">Poolside Service</span>
                                        <span class="feature-tag">City Views</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">Complimentary for guests</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="infinity-pool">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-dumbbell"></i>
                                </div>
                                <img src="assets/images/services/fitness-center.jpg" alt="Fitness Center" class="service-image">
                                <div class="service-content">
                                    <h5>Fitness Center</h5>
                                    <p>State-of-the-art equipment with personal training services available.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">Modern Equipment</span>
                                        <span class="feature-tag">Personal Training</span>
                                        <span class="feature-tag">24/7 Access</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">Complimentary for guests</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="fitness-center">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Services -->
                <div class="tab-pane fade" id="business">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <img src="assets/images/services/conference-hall.jpg" alt="Conference Hall" class="service-image">
                                <div class="service-content">
                                    <h5>Grand Ballroom</h5>
                                    <p>Elegant venue for conferences, weddings, and special events with full catering services.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">500 Capacity</span>
                                        <span class="feature-tag">AV Equipment</span>
                                        <span class="feature-tag">Catering</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 200,000 FCFA/day</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="grand-ballroom">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                <img src="assets/images/services/business-center.jpg" alt="Business Center" class="service-image">
                                <div class="service-content">
                                    <h5>Business Center</h5>
                                    <p>24/7 business services including printing, copying, and high-speed internet access.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">24/7 Access</span>
                                        <span class="feature-tag">High-Speed Internet</span>
                                        <span class="feature-tag">Printing Services</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">Complimentary for guests</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="business-center">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <img src="assets/images/services/meeting-rooms.jpg" alt="Meeting Rooms" class="service-image">
                                <div class="service-content">
                                    <h5>Private Meeting Rooms</h5>
                                    <p>Intimate spaces for small meetings and presentations with modern technology.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">6-20 Capacity</span>
                                        <span class="feature-tag">Video Conferencing</span>
                                        <span class="feature-tag">Refreshments</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 50,000 FCFA/day</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="meeting-rooms">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cultural Services -->
                <div class="tab-pane fade" id="cultural">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-mountain"></i>
                                </div>
                                <img src="assets/images/services/mount-cameroon-tour.jpg" alt="Mount Cameroon Tour" class="service-image">
                                <div class="service-content">
                                    <h5>Mount Cameroon Expedition</h5>
                                    <p>Guided trek to West Africa's highest peak with experienced local guides.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">3-Day Trek</span>
                                        <span class="feature-tag">Local Guides</span>
                                        <span class="feature-tag">Equipment Included</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 150,000 FCFA/person</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="mount-cameroon">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-music"></i>
                                </div>
                                <img src="assets/images/services/cultural-show.jpg" alt="Cultural Show" class="service-image">
                                <div class="service-content">
                                    <h5>Traditional Dance Show</h5>
                                    <p>Authentic Cameroonian cultural performances featuring traditional music and dance.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">Live Performance</span>
                                        <span class="feature-tag">Traditional Music</span>
                                        <span class="feature-tag">Cultural Education</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 10,000 FCFA/person</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="cultural-show">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="service-card glassmorphism h-100">
                                <div class="service-icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <img src="assets/images/services/craft-market.jpg" alt="Craft Market Tour" class="service-image">
                                <div class="service-content">
                                    <h5>Artisan Market Tour</h5>
                                    <p>Guided tour of local craft markets with authentic Cameroonian art and handicrafts.</p>
                                    <div class="service-features">
                                        <span class="feature-tag">Local Markets</span>
                                        <span class="feature-tag">Authentic Crafts</span>
                                        <span class="feature-tag">Cultural Immersion</span>
                                    </div>
                                    <div class="service-price">
                                        <span class="price">From 25,000 FCFA/person</span>
                                    </div>
                                    <button class="btn btn-primary btn-service" data-service="market-tour">
                                        <i class="fas fa-info-circle me-2"></i>Learn More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Services -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Additional Services</h2>
                    <p class="lead text-muted">Making your stay even more comfortable and memorable</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="additional-service glassmorphism text-center p-4 h-100">
                        <i class="fas fa-car fa-3x text-primary mb-3"></i>
                        <h5>Airport Transfer</h5>
                        <p>Luxury transportation to and from the airport with professional drivers.</p>
                        <span class="price-tag">From 15,000 FCFA</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="additional-service glassmorphism text-center p-4 h-100">
                        <i class="fas fa-concierge-bell fa-3x text-primary mb-3"></i>
                        <h5>Concierge Service</h5>
                        <p>24/7 personalized assistance for reservations, tours, and special requests.</p>
                        <span class="price-tag">Complimentary</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="additional-service glassmorphism text-center p-4 h-100">
                        <i class="fas fa-baby fa-3x text-primary mb-3"></i>
                        <h5>Babysitting Service</h5>
                        <p>Professional childcare services so you can enjoy your time worry-free.</p>
                        <span class="price-tag">From 8,000 FCFA/hour</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="additional-service glassmorphism text-center p-4 h-100">
                        <i class="fas fa-tshirt fa-3x text-primary mb-3"></i>
                        <h5>Laundry Service</h5>
                        <p>Express laundry and dry cleaning with same-day service available.</p>
                        <span class="price-tag">From 2,000 FCFA/item</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content glassmorphism">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="serviceModalLabel">Service Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="serviceModalBody">
                    <!-- Dynamic content will be loaded here -->
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
                    <a href="booking.php" class="btn btn-primary">Book Now</a>
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
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/services.js"></script>
</body>
</html>