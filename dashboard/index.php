<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

// Require user to be logged in
requireLogin();

// Get user role
$user_role = $_SESSION['role'];

// Route to appropriate dashboard based on role
switch ($user_role) {
    case 'admin':
        include 'admin/index.php';
        break;
    case 'receptionist':
        include 'receptionist/index.php';
        break;
    case 'housekeeping':
        include 'housekeeping/index.php';
        break;
    case 'restaurant':
        include 'restaurant/index.php';
        break;
    case 'spa':
        include 'spa/index.php';
        break;
    case 'guest':
        include 'guest/index.php';
        break;
    default:
        // Default dashboard for unknown roles
        include 'default/index.php';
        break;
}
?>