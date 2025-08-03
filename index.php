<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Simple routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        include 'public/landing.php';
        break;
    case 'gallery':
        include 'public/gallery.php';
        break;
    case 'services':
        include 'public/services.php';
        break;
    case 'booking':
        include 'public/booking.php';
        break;
    case 'contact':
        include 'public/contact.php';
        break;
    case 'login':
        include 'auth/login.php';
        break;
    case 'logout':
        include 'auth/logout.php';
        break;
    case 'dashboard':
        include 'dashboard/index.php';
        break;
    default:
        include 'public/landing.php';
        break;
}
?>