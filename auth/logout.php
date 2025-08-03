<?php
session_start();
require_once '../includes/functions.php';

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Clear remember me cookie
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/', '', true, true);
}

// Destroy the session
session_destroy();

// Start new session for flash message
session_start();
setFlashMessage('success', 'Vous avez été déconnecté avec succès.');

// Redirect to login page
header('Location: ../index.php?page=login');
exit();
?>