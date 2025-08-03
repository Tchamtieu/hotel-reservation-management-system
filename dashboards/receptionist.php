<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/database.php';

// Check if user is logged in and has receptionist role
Auth::requireRole('receptionist');

$user = Auth::getCurrentUser();
$bookings = SampleData::getBookings();
$rooms = SampleData::getRoomInventory();
$activities = SampleData::getRecentActivities();

// Filter data by user's hotel location
$userBookings = array_filter($bookings, function($booking) use ($user) {
    return $booking['hotel_location'] == $user['hotel_location'];
});

$userRooms = array_filter($rooms, function($room) use ($user) {
    return $room['hotel_location'] == $user['hotel_location'];
});

// Calculate statistics for this hotel
$totalBookings = count($userBookings);
$pendingBookings = count(array_filter($userBookings, function($booking) {
    return $booking['status'] === 'pending';
}));
$totalRooms = array_sum(array_column($userRooms, 'total_rooms'));
$availableRooms = array_sum(array_column($userRooms, 'available_rooms'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Dashboard - Hotel Cameroun</title>
    
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
            <p class="text-muted mb-0">Reception Desk</p>
        </div>
        
        <nav class="sidebar-nav">
            <a href="#dashboard" class="nav-link active" data-section="dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="#bookings" class="nav-link" data-section="bookings">
                <i class="fas fa-calendar-check"></i>
                <span>Bookings</span>
            </a>
            <a href="#checkin" class="nav-link" data-section="checkin">
                <i class="fas fa-sign-in-alt"></i>
                <span>Check-in / Check-out</span>
            </a>
            <a href="#rooms" class="nav-link" data-section="rooms">
                <i class="fas fa-bed"></i>
                <span>Room Status</span>
            </a>
            <a href="#guests" class="nav-link" data-section="guests">
                <i class="fas fa-users"></i>
                <span>Guest Management</span>
            </a>
            <a href="#requests" class="nav-link" data-section="requests">
                <i class="fas fa-bell"></i>
                <span>Guest Requests</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo Auth::getInitials(); ?>
                </div>
                <div class="user-details">
                    <h6><?php echo Auth::getFullName(); ?></h6>
                    <small class="text-muted">Receptionist</small>
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
                <h5 class="page-title mb-0">Reception Dashboard</h5>
            </div>
            <div class="nav-right">
                <div class="nav-item">
                    <span class="text-white"><?php echo getHotelName($user['hotel_location']); ?></span>
                </div>
                <div class="nav-item">
                    <span class="text-muted small"><?php echo date('M j, Y - g:i A'); ?></span>
                </div>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Dashboard Overview -->
            <div class="content-section active" id="dashboard">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Welcome, <?php echo $user['first_name']; ?>!</h2>
                        <p class="text-muted">Front desk operations for <?php echo getHotelName($user['hotel_location']); ?></p>
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
                                <h3><?php echo $totalBookings; ?></h3>
                                <p>Total Bookings</p>
                                <small class="text-warning">
                                    <i class="fas fa-clock"></i> <?php echo $pendingBookings; ?> pending
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-success">
                                <i class="fas fa-bed"></i>
                            </div>
                            <div class="stat-content">
                                <h3><?php echo $availableRooms; ?></h3>
                                <p>Available Rooms</p>
                                <small class="text-success">
                                    <i class="fas fa-check"></i> Out of <?php echo $totalRooms; ?> total
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-warning">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="stat-content">
                                <h3>8</h3>
                                <p>Today's Check-ins</p>
                                <small class="text-info">
                                    <i class="fas fa-clock"></i> 3 completed
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-info">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <div class="stat-content">
                                <h3>5</h3>
                                <p>Today's Check-outs</p>
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> 2 pending
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary w-100 p-3">
                                            <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                            <br>New Booking
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success w-100 p-3">
                                            <i class="fas fa-sign-in-alt fa-2x mb-2"></i>
                                            <br>Quick Check-in
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-warning w-100 p-3">
                                            <i class="fas fa-sign-out-alt fa-2x mb-2"></i>
                                            <br>Process Check-out
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-info w-100 p-3">
                                            <i class="fas fa-bed fa-2x mb-2"></i>
                                            <br>Room Assignment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card glassmorphism h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Today's Priority</h5>
                            </div>
                            <div class="card-body">
                                <div class="priority-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">VIP Arrival</h6>
                                            <small class="text-muted">Presidential Suite - 3:00 PM</small>
                                        </div>
                                        <span class="badge bg-danger">High</span>
                                    </div>
                                </div>
                                <div class="priority-item mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Group Check-in</h6>
                                            <small class="text-muted">15 guests - 2:00 PM</small>
                                        </div>
                                        <span class="badge bg-warning">Medium</span>
                                    </div>
                                </div>
                                <div class="priority-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Late Check-out</h6>
                                            <small class="text-muted">Room 205 - Until 6:00 PM</small>
                                        </div>
                                        <span class="badge bg-info">Normal</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room Status Overview -->
                <div class="row">
                    <div class="col-12">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5 class="mb-0">Room Status Overview</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <?php foreach ($userRooms as $room): ?>
                                    <div class="col-lg-4">
                                        <div class="room-status-card">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0"><?php echo $room['room_type']; ?></h6>
                                                <span class="badge bg-primary"><?php echo formatCurrency($room['price_per_night']); ?></span>
                                            </div>
                                            <div class="progress mb-2" style="height: 10px;">
                                                <?php 
                                                $occupancy = (($room['total_rooms'] - $room['available_rooms']) / $room['total_rooms']) * 100;
                                                $progressColor = $occupancy > 80 ? 'danger' : ($occupancy > 60 ? 'warning' : 'success');
                                                ?>
                                                <div class="progress-bar bg-<?php echo $progressColor; ?>" 
                                                     style="width: <?php echo $occupancy; ?>%"></div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small>Available: <?php echo $room['available_rooms']; ?></small>
                                                <small>Total: <?php echo $room['total_rooms']; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bookings Section -->
            <div class="content-section" id="bookings">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2>Booking Management</h2>
                        <p class="text-muted">Manage reservations for <?php echo getHotelName($user['hotel_location']); ?></p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>New Booking
                        </button>
                    </div>
                </div>

                <div class="card glassmorphism">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="search" class="form-control" placeholder="Search bookings...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>All Status</option>
                                    <option>Confirmed</option>
                                    <option>Pending</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-primary w-100">Filter</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Guest Name</th>
                                        <th>Room Type</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userBookings as $booking): ?>
                                    <tr>
                                        <td>#<?php echo str_pad($booking['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                        <td>John Doe</td>
                                        <td><?php echo $booking['room_type']; ?></td>
                                        <td><?php echo date('M j, Y', strtotime($booking['check_in'])); ?></td>
                                        <td><?php echo date('M j, Y', strtotime($booking['check_out'])); ?></td>
                                        <td><?php echo formatCurrency($booking['total_amount']); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo getStatusBadge($booking['status']); ?>">
                                                <?php echo ucfirst($booking['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-outline-success" title="Check-in">
                                                    <i class="fas fa-sign-in-alt"></i>
                                                </button>
                                                <button class="btn btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Check-in/Check-out Section -->
            <div class="content-section" id="checkin">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Check-in / Check-out</h2>
                        <p class="text-muted">Process guest arrivals and departures</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header bg-success">
                                <h5 class="mb-0 text-white">
                                    <i class="fas fa-sign-in-alt me-2"></i>Today's Check-ins
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="checkin-item mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">John Doe</h6>
                                        <span class="badge bg-warning">Pending</span>
                                    </div>
                                    <p class="text-muted mb-2">Presidential Suite • Expected: 3:00 PM</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-success">Check-in</button>
                                        <button class="btn btn-sm btn-outline-primary">View Details</button>
                                    </div>
                                </div>

                                <div class="checkin-item mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Jane Smith</h6>
                                        <span class="badge bg-success">Completed</span>
                                    </div>
                                    <p class="text-muted mb-2">Executive Suite • Checked in: 2:15 PM</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-info">Room Key</button>
                                        <button class="btn btn-sm btn-outline-primary">View Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header bg-warning">
                                <h5 class="mb-0 text-white">
                                    <i class="fas fa-sign-out-alt me-2"></i>Today's Check-outs
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="checkout-item mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Michael Johnson</h6>
                                        <span class="badge bg-warning">Pending</span>
                                    </div>
                                    <p class="text-muted mb-2">Deluxe Room • Expected: 11:00 AM</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-warning">Process</button>
                                        <button class="btn btn-sm btn-outline-danger">Late Fee</button>
                                    </div>
                                </div>

                                <div class="checkout-item mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Sarah Wilson</h6>
                                        <span class="badge bg-success">Completed</span>
                                    </div>
                                    <p class="text-muted mb-2">Executive Suite • Departed: 10:30 AM</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-success">Feedback</button>
                                        <button class="btn btn-sm btn-outline-primary">Receipt</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Status Section -->
            <div class="content-section" id="rooms">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Room Status</h2>
                        <p class="text-muted">Monitor and update room availability</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="card glassmorphism">
                            <div class="card-body">
                                <div class="room-grid">
                                    <?php for ($i = 101; $i <= 120; $i++): ?>
                                    <?php 
                                    $statuses = ['available', 'occupied', 'cleaning', 'maintenance', 'out-of-order'];
                                    $status = $statuses[array_rand($statuses)];
                                    $statusColors = [
                                        'available' => 'success',
                                        'occupied' => 'danger',
                                        'cleaning' => 'warning',
                                        'maintenance' => 'info',
                                        'out-of-order' => 'secondary'
                                    ];
                                    ?>
                                    <div class="room-tile" data-room="<?php echo $i; ?>" data-status="<?php echo $status; ?>">
                                        <div class="room-number"><?php echo $i; ?></div>
                                        <div class="room-status">
                                            <span class="badge bg-<?php echo $statusColors[$status]; ?>">
                                                <?php echo ucfirst(str_replace('-', ' ', $status)); ?>
                                            </span>
                                        </div>
                                        <div class="room-type">Deluxe</div>
                                    </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room Status Legend -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card glassmorphism">
                            <div class="card-body">
                                <h6 class="mb-3">Room Status Legend</h6>
                                <div class="d-flex flex-wrap gap-3">
                                    <span><span class="badge bg-success me-2">Available</span> Ready for guests</span>
                                    <span><span class="badge bg-danger me-2">Occupied</span> Guest checked in</span>
                                    <span><span class="badge bg-warning me-2">Cleaning</span> Being cleaned</span>
                                    <span><span class="badge bg-info me-2">Maintenance</span> Under maintenance</span>
                                    <span><span class="badge bg-secondary me-2">Out of Order</span> Not available</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guests Section -->
            <div class="content-section" id="guests">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2>Guest Management</h2>
                        <p class="text-muted">View and manage guest information</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Add Guest
                        </button>
                    </div>
                </div>

                <div class="card glassmorphism">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Guest Name</th>
                                        <th>Room</th>
                                        <th>Check-in Date</th>
                                        <th>Check-out Date</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Suite 205</td>
                                        <td>Jan 15, 2024</td>
                                        <td>Jan 18, 2024</td>
                                        <td>+1 555 123 4567</td>
                                        <td><span class="badge bg-success">In House</span></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" title="Profile">
                                                    <i class="fas fa-user"></i>
                                                </button>
                                                <button class="btn btn-outline-info" title="Services">
                                                    <i class="fas fa-concierge-bell"></i>
                                                </button>
                                                <button class="btn btn-outline-warning" title="Bill">
                                                    <i class="fas fa-file-invoice"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Requests Section -->
            <div class="content-section" id="requests">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Guest Requests</h2>
                        <p class="text-muted">Handle guest service requests</p>
                    </div>
                </div>

                <div class="card glassmorphism">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Guest</th>
                                        <th>Room</th>
                                        <th>Service Type</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#REQ001</td>
                                        <td>John Doe</td>
                                        <td>205</td>
                                        <td>Room Service</td>
                                        <td><span class="badge bg-warning">Medium</span></td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>2:30 PM</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-success" title="Assign">
                                                    <i class="fas fa-user-check"></i>
                                                </button>
                                                <button class="btn btn-outline-primary" title="Details">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="../assets/js/dashboard.js"></script>
    
    <style>
        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            padding: 1rem 0;
        }
        
        .room-tile {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .room-tile:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .room-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 0.5rem;
        }
        
        .room-status {
            margin-bottom: 0.5rem;
        }
        
        .room-type {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .room-status-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 1rem;
        }
        
        .priority-item {
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }
        
        .checkin-item, .checkout-item {
            background: rgba(255, 255, 255, 0.05) !important;
        }
    </style>
</body>
</html>