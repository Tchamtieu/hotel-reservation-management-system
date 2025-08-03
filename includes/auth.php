<?php
// Authentication and Session Management

require_once 'config/database.php';

class Auth {
    private static function getUsers() {
        return SampleData::getUsers();
    }

    public static function login($username, $password) {
        $users = self::getUsers();
        
        foreach ($users as $user) {
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                // Start session and store user data
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['hotel_location'] = $user['hotel_location'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['logged_in'] = true;
                $_SESSION['login_time'] = time();
                
                // Update last login time (in a real app, this would update the database)
                $_SESSION['last_login'] = date('Y-m-d H:i:s');
                
                return true;
            }
        }
        return false;
    }

    public static function logout() {
        session_unset();
        session_destroy();
        return true;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public static function getCurrentUser() {
        if (!self::isLoggedIn()) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'],
            'role' => $_SESSION['role'],
            'first_name' => $_SESSION['first_name'],
            'last_name' => $_SESSION['last_name'],
            'phone' => $_SESSION['phone'],
            'hotel_location' => $_SESSION['hotel_location'],
            'status' => $_SESSION['status'],
            'last_login' => $_SESSION['last_login'] ?? null
        ];
    }

    public static function getUserRole() {
        return $_SESSION['role'] ?? null;
    }

    public static function hasRole($role) {
        return self::getUserRole() === $role;
    }

    public static function hasAnyRole($roles) {
        $userRole = self::getUserRole();
        return in_array($userRole, $roles);
    }

    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: login.php');
            exit();
        }
    }

    public static function requireRole($role) {
        self::requireLogin();
        if (!self::hasRole($role)) {
            header('Location: dashboard.php');
            exit();
        }
    }

    public static function requireAnyRole($roles) {
        self::requireLogin();
        if (!self::hasAnyRole($roles)) {
            header('Location: dashboard.php');
            exit();
        }
    }

    public static function getDashboardUrl($role = null) {
        $role = $role ?? self::getUserRole();
        
        $dashboards = [
            'admin' => 'dashboards/admin.php',
            'receptionist' => 'dashboards/receptionist.php',
            'housekeeping' => 'dashboards/housekeeping.php',
            'restaurant' => 'dashboards/restaurant.php',
            'spa' => 'dashboards/spa.php',
            'guest' => 'dashboards/guest.php'
        ];

        return $dashboards[$role] ?? 'dashboard.php';
    }

    public static function redirectToDashboard() {
        $url = self::getDashboardUrl();
        header("Location: $url");
        exit();
    }

    public static function getFullName() {
        if (!self::isLoggedIn()) {
            return 'Guest';
        }
        return $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
    }

    public static function getInitials() {
        if (!self::isLoggedIn()) {
            return 'G';
        }
        return strtoupper(substr($_SESSION['first_name'], 0, 1) . substr($_SESSION['last_name'], 0, 1));
    }

    public static function getUserPermissions($role = null) {
        $role = $role ?? self::getUserRole();
        
        $permissions = [
            'admin' => [
                'view_all_hotels',
                'manage_users',
                'manage_bookings',
                'view_reports',
                'manage_inventory',
                'manage_finances',
                'system_settings'
            ],
            'receptionist' => [
                'manage_bookings',
                'check_in_out',
                'view_guest_info',
                'manage_rooms',
                'view_inventory'
            ],
            'housekeeping' => [
                'view_room_status',
                'update_room_status',
                'maintenance_requests',
                'inventory_management'
            ],
            'restaurant' => [
                'manage_reservations',
                'view_menu',
                'manage_orders',
                'view_restaurant_reports'
            ],
            'spa' => [
                'manage_spa_bookings',
                'view_treatments',
                'manage_spa_schedule',
                'view_spa_reports'
            ],
            'guest' => [
                'view_bookings',
                'make_requests',
                'view_services',
                'update_profile'
            ]
        ];

        return $permissions[$role] ?? [];
    }

    public static function hasPermission($permission) {
        $userPermissions = self::getUserPermissions();
        return in_array($permission, $userPermissions);
    }
}

// Session timeout check
function checkSessionTimeout() {
    $timeout = 30 * 60; // 30 minutes
    
    if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $timeout) {
        Auth::logout();
        header('Location: login.php?timeout=1');
        exit();
    }
    
    // Update last activity time
    $_SESSION['login_time'] = time();
}

// CSRF Protection
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Input sanitization
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function sanitizeEmail($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Password strength validation
function validatePassword($password) {
    $errors = [];
    
    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long';
    }
    
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must contain at least one uppercase letter';
    }
    
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = 'Password must contain at least one lowercase letter';
    }
    
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password must contain at least one number';
    }
    
    return $errors;
}
?>