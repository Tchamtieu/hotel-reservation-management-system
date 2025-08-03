<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/database.php';

// Check if user is logged in and has guest role
Auth::requireRole('guest');

$user = Auth::getCurrentUser();
$userBookings = array_filter(SampleData::getBookings(), function($booking) use ($user) {
    return $booking['guest_id'] == $user['id'];
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Portal - Hotel Cameroun</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body class="dashboard-body">
    <!-- Sidebar -->
    <div class="sidebar glassmorphism">
        <div class="sidebar-header">
            <h4><i class="fas fa-hotel me-2"></i>Hotel Cameroun</h4>
            <p class="text-muted mb-0">Guest Portal</p>
        </div>
        
        <nav class="sidebar-nav">
            <a href="#dashboard" class="nav-link active" data-section="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="#bookings" class="nav-link" data-section="bookings">
                <i class="fas fa-calendar-check"></i>
                <span>My Bookings</span>
            </a>
            <a href="#services" class="nav-link" data-section="services">
                <i class="fas fa-concierge-bell"></i>
                <span>Hotel Services</span>
            </a>
            <a href="#requests" class="nav-link" data-section="requests">
                <i class="fas fa-bell"></i>
                <span>Service Requests</span>
            </a>
            <a href="#profile" class="nav-link" data-section="profile">
                <i class="fas fa-user"></i>
                <span>My Profile</span>
            </a>
            <a href="#billing" class="nav-link" data-section="billing">
                <i class="fas fa-credit-card"></i>
                <span>Billing & Payments</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo Auth::getInitials(); ?>
                </div>
                <div class="user-details">
                    <h6><?php echo Auth::getFullName(); ?></h6>
                    <small class="text-muted">Guest</small>
                </div>
            </div>
            <a href="../login.php?logout=1" class="btn btn-outline-danger btn-sm mt-2">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="top-nav glassmorphism">
            <div class="nav-left">
                <button class="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="page-title mb-0">Guest Dashboard</h5>
            </div>
            <div class="nav-right">
                <div class="nav-item">
                    <span class="text-white">Welcome, <?php echo $user['first_name']; ?>!</span>
                </div>
                <div class="nav-item">
                    <span class="text-muted small">Current Stay: <?php echo getHotelName($user['hotel_location']); ?></span>
                </div>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Dashboard Overview -->
            <div class="content-section active" id="dashboard">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Welcome to your Guest Portal</h2>
                        <p class="text-muted">Manage your stay and enjoy premium services at Hotel Cameroun</p>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-primary">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-content">
                                <h3><?php echo count($userBookings); ?></h3>
                                <p>Active Bookings</p>
                                <small class="text-info">
                                    <i class="fas fa-clock"></i> Next check-in: Jan 15
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-success">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stat-content">
                                <h3>4.9</h3>
                                <p>Loyalty Rating</p>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up"></i> Premium Guest
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-warning">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="stat-content">
                                <h3><?php echo formatCurrency(array_sum(array_column($userBookings, 'total_amount'))); ?></h3>
                                <p>Total Spent</p>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i> This year
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-info">
                                <i class="fas fa-gift"></i>
                            </div>
                            <div class="stat-content">
                                <h3>3</h3>
                                <p>Rewards Available</p>
                                <small class="text-info">
                                    <i class="fas fa-gift"></i> View rewards
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Stay Info -->
                <?php if (!empty($userBookings)): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0">Current Stay Information</h5>
                            </div>
                            <div class="card-body">
                                <?php $currentBooking = $userBookings[0]; ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-primary">Booking Details</h6>
                                        <p><strong>Hotel:</strong> <?php echo getHotelName($currentBooking['hotel_location']); ?></p>
                                        <p><strong>Room Type:</strong> <?php echo $currentBooking['room_type']; ?></p>
                                        <p><strong>Check-in:</strong> <?php echo date('M j, Y', strtotime($currentBooking['check_in'])); ?></p>
                                        <p><strong>Check-out:</strong> <?php echo date('M j, Y', strtotime($currentBooking['check_out'])); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-primary">Quick Actions</h6>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-concierge-bell me-2"></i>Request Room Service
                                            </button>
                                            <button class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-spa me-2"></i>Book Spa Treatment
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-utensils me-2"></i>Make Restaurant Reservation
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Services Overview -->
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="service-card glassmorphism text-center p-4 h-100">
                            <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                            <h5>Dining Services</h5>
                            <p>Enjoy authentic Cameroonian cuisine and international dishes at our restaurants.</p>
                            <button class="btn btn-primary btn-sm">Explore Dining</button>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-card glassmorphism text-center p-4 h-100">
                            <i class="fas fa-spa fa-3x text-primary mb-3"></i>
                            <h5>Spa & Wellness</h5>
                            <p>Relax and rejuvenate with traditional African healing treatments.</p>
                            <button class="btn btn-primary btn-sm">Book Spa</button>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-card glassmorphism text-center p-4 h-100">
                            <i class="fas fa-car fa-3x text-primary mb-3"></i>
                            <h5>Transportation</h5>
                            <p>Airport transfers and city tours with professional drivers.</p>
                            <button class="btn btn-primary btn-sm">Book Transfer</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Bookings Section -->
            <div class="content-section" id="bookings">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2>My Bookings</h2>
                        <p class="text-muted">View and manage your hotel reservations</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="../booking.php" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>New Booking
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <?php foreach ($userBookings as $booking): ?>
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Booking #<?php echo str_pad($booking['id'], 4, '0', STR_PAD_LEFT); ?></h6>
                                <span class="badge bg-<?php echo getStatusBadge($booking['status']); ?>">
                                    <?php echo ucfirst($booking['status']); ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Hotel</small>
                                        <p class="mb-2"><?php echo getHotelName($booking['hotel_location']); ?></p>
                                        <small class="text-muted">Room Type</small>
                                        <p class="mb-2"><?php echo $booking['room_type']; ?></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Check-in</small>
                                        <p class="mb-2"><?php echo date('M j, Y', strtotime($booking['check_in'])); ?></p>
                                        <small class="text-muted">Check-out</small>
                                        <p class="mb-2"><?php echo date('M j, Y', strtotime($booking['check_out'])); ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-primary"><?php echo formatCurrency($booking['total_amount']); ?></strong>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning" title="Modify">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Cancel">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php if (!empty($booking['special_requests'])): ?>
                                <div class="mt-2">
                                    <small class="text-muted">Special Requests:</small>
                                    <p class="small"><?php echo $booking['special_requests']; ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Hotel Services Section -->
            <div class="content-section" id="services">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Hotel Services</h2>
                        <p class="text-muted">Discover and book premium services during your stay</p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Dining Services -->
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>Dining Services</h5>
                            </div>
                            <div class="card-body">
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Nkomo Restaurant</h6>
                                            <small class="text-muted">Authentic Cameroonian cuisine</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Reserve</button>
                                    </div>
                                </div>
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Sky Lounge</h6>
                                            <small class="text-muted">Rooftop bar with city views</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Reserve</button>
                                    </div>
                                </div>
                                <div class="service-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Room Service</h6>
                                            <small class="text-muted">24/7 in-room dining</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wellness Services -->
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-spa me-2"></i>Wellness & Recreation</h5>
                            </div>
                            <div class="card-body">
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Sankara Spa</h6>
                                            <small class="text-muted">Traditional healing treatments</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Book</button>
                                    </div>
                                </div>
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Fitness Center</h6>
                                            <small class="text-muted">24/7 gym access</small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary">Free</button>
                                    </div>
                                </div>
                                <div class="service-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Swimming Pool</h6>
                                            <small class="text-muted">Infinity pool with views</small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary">Free</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Services -->
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-concierge-bell me-2"></i>Concierge Services</h5>
                            </div>
                            <div class="card-body">
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Airport Transfer</h6>
                                            <small class="text-muted">Luxury car service</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Book</button>
                                    </div>
                                </div>
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>City Tours</h6>
                                            <small class="text-muted">Explore Cameroon</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Book</button>
                                    </div>
                                </div>
                                <div class="service-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Laundry Service</h6>
                                            <small class="text-muted">Express cleaning</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Request</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cultural Experiences -->
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-mask me-2"></i>Cultural Experiences</h5>
                            </div>
                            <div class="card-body">
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Mount Cameroon Trek</h6>
                                            <small class="text-muted">3-day expedition</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Book</button>
                                    </div>
                                </div>
                                <div class="service-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Traditional Dance Show</h6>
                                            <small class="text-muted">Cultural performance</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Book</button>
                                    </div>
                                </div>
                                <div class="service-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6>Artisan Market Tour</h6>
                                            <small class="text-muted">Local crafts shopping</small>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Book</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Requests Section -->
            <div class="content-section" id="requests">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2>Service Requests</h2>
                        <p class="text-muted">Submit and track your service requests</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRequestModal">
                            <i class="fas fa-plus me-2"></i>New Request
                        </button>
                    </div>
                </div>

                <div class="card glassmorphism">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Service Type</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Requested</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#REQ001</td>
                                        <td>Room Service</td>
                                        <td>Extra towels and pillows</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>Jan 10, 2024</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#REQ002</td>
                                        <td>Maintenance</td>
                                        <td>Air conditioning adjustment</td>
                                        <td><span class="badge bg-warning">In Progress</span></td>
                                        <td>Jan 11, 2024</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="content-section" id="profile">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>My Profile</h2>
                        <p class="text-muted">Manage your personal information and preferences</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0">Personal Information</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" value="<?php echo $user['first_name']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo $user['last_name']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="<?php echo $user['email']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" class="form-control" value="<?php echo $user['phone']; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0">Preferences</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                    <label class="form-check-label" for="emailNotifications">
                                        Email Notifications
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="smsNotifications">
                                    <label class="form-check-label" for="smsNotifications">
                                        SMS Notifications
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="specialOffers" checked>
                                    <label class="form-check-label" for="specialOffers">
                                        Special Offers
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Room Preferences</label>
                                    <select class="form-select">
                                        <option>High Floor</option>
                                        <option>Low Floor</option>
                                        <option>No Preference</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Preferences</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Billing Section -->
            <div class="content-section" id="billing">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Billing & Payments</h2>
                        <p class="text-muted">View invoices and manage payment methods</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0">Recent Invoices</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Invoice #</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($userBookings as $booking): ?>
                                            <tr>
                                                <td>#INV<?php echo str_pad($booking['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                                <td><?php echo date('M j, Y', strtotime($booking['check_in'])); ?></td>
                                                <td><?php echo $booking['room_type'] . ' - ' . getHotelName($booking['hotel_location']); ?></td>
                                                <td><?php echo formatCurrency($booking['total_amount']); ?></td>
                                                <td><span class="badge bg-success">Paid</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" title="Download">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0">Payment Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Total Spent (2024)</span>
                                        <strong><?php echo formatCurrency(array_sum(array_column($userBookings, 'total_amount'))); ?></strong>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Loyalty Points</span>
                                        <strong>2,450 pts</strong>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Available Credit</span>
                                        <strong><?php echo formatCurrency(50000); ?></strong>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100">Redeem Points</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Request Modal -->
    <div class="modal fade" id="newRequestModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glassmorphism">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">New Service Request</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Service Type</label>
                            <select class="form-select">
                                <option>Room Service</option>
                                <option>Housekeeping</option>
                                <option>Maintenance</option>
                                <option>Concierge</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Priority</label>
                            <select class="form-select">
                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                                <option>Urgent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Please describe your request..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Submit Request</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="../assets/js/dashboard.js"></script>
</body>
</html>