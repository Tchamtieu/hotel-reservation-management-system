<?php
session_start();
require_once '../includes/auth.php';
require_once '../config/database.php';

// Check if user is logged in and has admin role
Auth::requireRole('admin');

$user = Auth::getCurrentUser();
$users = SampleData::getUsers();
$bookings = SampleData::getBookings();
$rooms = SampleData::getRoomInventory();
$activities = SampleData::getRecentActivities();

// Calculate statistics
$totalRevenue = array_sum(array_column($bookings, 'total_amount'));
$totalRooms = array_sum(array_column($rooms, 'total_rooms'));
$availableRooms = array_sum(array_column($rooms, 'available_rooms'));
$occupancyRate = $totalRooms > 0 ? round((($totalRooms - $availableRooms) / $totalRooms) * 100, 1) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hotel Cameroun</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body class="dashboard-body">
    <!-- Sidebar -->
    <div class="sidebar glassmorphism">
        <div class="sidebar-header">
            <h4><i class="fas fa-hotel me-2"></i>Hotel Cameroun</h4>
            <p class="text-muted mb-0">Administrator Panel</p>
        </div>
        
        <nav class="sidebar-nav">
            <a href="#overview" class="nav-link active" data-section="overview">
                <i class="fas fa-tachometer-alt"></i>
                <span>Overview</span>
            </a>
            <a href="#bookings" class="nav-link" data-section="bookings">
                <i class="fas fa-calendar-check"></i>
                <span>Bookings</span>
            </a>
            <a href="#rooms" class="nav-link" data-section="rooms">
                <i class="fas fa-bed"></i>
                <span>Room Management</span>
            </a>
            <a href="#users" class="nav-link" data-section="users">
                <i class="fas fa-users"></i>
                <span>User Management</span>
            </a>
            <a href="#reports" class="nav-link" data-section="reports">
                <i class="fas fa-chart-bar"></i>
                <span>Reports & Analytics</span>
            </a>
            <a href="#settings" class="nav-link" data-section="settings">
                <i class="fas fa-cogs"></i>
                <span>Settings</span>
            </a>
        </nav>
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo Auth::getInitials(); ?>
                </div>
                <div class="user-details">
                    <h6><?php echo Auth::getFullName(); ?></h6>
                    <small class="text-muted">Administrator</small>
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
                <h5 class="page-title mb-0">Dashboard Overview</h5>
            </div>
            <div class="nav-right">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end glassmorphism">
                        <h6 class="dropdown-header">Notifications</h6>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-calendar text-primary me-2"></i>New booking received
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>Room maintenance required
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user text-info me-2"></i>New staff member added
                        </a>
                    </div>
                </div>
                <div class="nav-item">
                    <span class="text-muted small">Last login: <?php echo date('M j, Y g:i A'); ?></span>
                </div>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Overview Section -->
            <div class="content-section active" id="overview">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Welcome back, <?php echo $user['first_name']; ?>!</h2>
                        <p class="text-muted">Here's what's happening at Hotel Cameroun today.</p>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-primary">
                                <i class="fas fa-bed"></i>
                            </div>
                            <div class="stat-content">
                                <h3><?php echo $occupancyRate; ?>%</h3>
                                <p>Occupancy Rate</p>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up"></i> +5.2% from last month
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-success">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="stat-content">
                                <h3><?php echo formatCurrency($totalRevenue); ?></h3>
                                <p>Total Revenue</p>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up"></i> +12.8% from last month
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-warning">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="stat-content">
                                <h3><?php echo count($bookings); ?></h3>
                                <p>Active Bookings</p>
                                <small class="text-info">
                                    <i class="fas fa-info-circle"></i> 2 pending confirmation
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card glassmorphism">
                            <div class="stat-icon bg-info">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <h3><?php echo count($users); ?></h3>
                                <p>Total Users</p>
                                <small class="text-muted">
                                    <i class="fas fa-user-plus"></i> 1 new this week
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="chart-card glassmorphism">
                            <div class="chart-header">
                                <h5>Revenue Analytics</h5>
                                <div class="chart-controls">
                                    <select class="form-select form-select-sm">
                                        <option>Last 30 days</option>
                                        <option>Last 3 months</option>
                                        <option>Last year</option>
                                    </select>
                                </div>
                            </div>
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="chart-card glassmorphism h-100">
                            <div class="chart-header">
                                <h5>Hotel Performance</h5>
                            </div>
                            <canvas id="hotelChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-12">
                        <div class="card glassmorphism">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Recent Activities</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <div class="activity-timeline">
                                    <?php foreach ($activities as $activity): ?>
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="fas fa-<?php echo $activity['type'] === 'booking' ? 'calendar' : ($activity['type'] === 'checkin' ? 'sign-in-alt' : 'tools'); ?>"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h6><?php echo $activity['description']; ?></h6>
                                            <p class="text-muted mb-1">by <?php echo $activity['user']; ?> • <?php echo getHotelName($activity['hotel_location']); ?></p>
                                            <small class="text-muted"><?php echo date('M j, Y g:i A', strtotime($activity['timestamp'])); ?></small>
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
                        <p class="text-muted">Manage all hotel bookings across locations</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>New Booking
                        </button>
                    </div>
                </div>

                <div class="card glassmorphism">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Guest</th>
                                        <th>Hotel</th>
                                        <th>Room Type</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td>#<?php echo str_pad($booking['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                        <td>
                                            <?php
                                            $guest = array_find($users, function($u) use ($booking) {
                                                return $u['id'] == $booking['guest_id'];
                                            });
                                            echo $guest ? $guest['first_name'] . ' ' . $guest['last_name'] : 'Unknown';
                                            ?>
                                        </td>
                                        <td><?php echo getHotelName($booking['hotel_location']); ?></td>
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
                                                <button class="btn btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" title="Cancel">
                                                    <i class="fas fa-times"></i>
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

            <!-- Rooms Section -->
            <div class="content-section" id="rooms">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2>Room Management</h2>
                        <p class="text-muted">Monitor room availability and pricing</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Room Type
                        </button>
                    </div>
                </div>

                <div class="row g-4">
                    <?php foreach ($rooms as $room): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="room-card glassmorphism">
                            <div class="room-header">
                                <h5><?php echo $room['room_type']; ?></h5>
                                <span class="badge bg-primary"><?php echo getHotelName($room['hotel_location']); ?></span>
                            </div>
                            <div class="room-stats">
                                <div class="stat">
                                    <label>Total Rooms</label>
                                    <span><?php echo $room['total_rooms']; ?></span>
                                </div>
                                <div class="stat">
                                    <label>Available</label>
                                    <span class="text-success"><?php echo $room['available_rooms']; ?></span>
                                </div>
                                <div class="stat">
                                    <label>Occupied</label>
                                    <span class="text-warning"><?php echo $room['total_rooms'] - $room['available_rooms']; ?></span>
                                </div>
                            </div>
                            <div class="room-pricing">
                                <h4><?php echo formatCurrency($room['price_per_night']); ?></h4>
                                <small class="text-muted">per night</small>
                            </div>
                            <div class="room-actions">
                                <button class="btn btn-sm btn-outline-primary">Edit Pricing</button>
                                <button class="btn btn-sm btn-outline-info">View Details</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Users Section -->
            <div class="content-section" id="users">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h2>User Management</h2>
                        <p class="text-muted">Manage staff and guest accounts</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Add User
                        </button>
                    </div>
                </div>

                <div class="card glassmorphism">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Hotel</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $userItem): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar-sm me-3">
                                                    <?php echo strtoupper(substr($userItem['first_name'], 0, 1) . substr($userItem['last_name'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0"><?php echo $userItem['first_name'] . ' ' . $userItem['last_name']; ?></h6>
                                                    <small class="text-muted">@<?php echo $userItem['username']; ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $userItem['email']; ?></td>
                                        <td>
                                            <span class="badge bg-info">
                                                <?php echo getUserRole($userItem['role']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo $userItem['hotel_location'] === 'all' ? 'All Hotels' : getHotelName($userItem['hotel_location']); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo getStatusBadge($userItem['status']); ?>">
                                                <?php echo ucfirst($userItem['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
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

            <!-- Reports Section -->
            <div class="content-section" id="reports">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>Reports & Analytics</h2>
                        <p class="text-muted">Detailed insights and performance metrics</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="chart-card glassmorphism">
                            <div class="chart-header">
                                <h5>Occupancy Trends</h5>
                            </div>
                            <canvas id="occupancyChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="chart-card glassmorphism">
                            <div class="chart-header">
                                <h5>Revenue by Hotel</h5>
                            </div>
                            <canvas id="hotelRevenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="content-section" id="settings">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2>System Settings</h2>
                        <p class="text-muted">Configure system preferences and settings</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5>General Settings</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Hotel Chain Name</label>
                                        <input type="text" class="form-control" value="Hotel Cameroun">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Default Currency</label>
                                        <select class="form-select">
                                            <option selected>FCFA (Central African CFA Franc)</option>
                                            <option>USD (US Dollar)</option>
                                            <option>EUR (Euro)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Time Zone</label>
                                        <select class="form-select">
                                            <option selected>Africa/Douala (GMT+1)</option>
                                            <option>UTC</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card glassmorphism">
                            <div class="card-header">
                                <h5>Notification Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                                    <label class="form-check-label" for="emailNotif">
                                        Email Notifications
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="smsNotif">
                                    <label class="form-check-label" for="smsNotif">
                                        SMS Notifications
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="pushNotif" checked>
                                    <label class="form-check-label" for="pushNotif">
                                        Push Notifications
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Preferences</button>
                            </div>
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
    
    <!-- Dashboard Specific JS -->
    <script>
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
        });
        
        function initializeCharts() {
            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenue (FCFA)',
                        data: [1200000, 1900000, 800000, 1500000, 2000000, 1800000],
                        borderColor: 'rgb(46, 139, 87)',
                        backgroundColor: 'rgba(46, 139, 87, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            
            // Hotel Performance Chart
            const hotelCtx = document.getElementById('hotelChart').getContext('2d');
            new Chart(hotelCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Hilton Yaoundé', 'K Hotel Douala', 'Mountain Hotel Buea'],
                    datasets: [{
                        data: [45, 35, 20],
                        backgroundColor: [
                            'rgb(46, 139, 87)',
                            'rgb(255, 215, 0)',
                            'rgb(220, 20, 60)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    </script>
</body>
</html>

<?php
// Helper function for array_find
function array_find($array, $callback) {
    foreach ($array as $item) {
        if ($callback($item)) {
            return $item;
        }
    }
    return null;
}
?>