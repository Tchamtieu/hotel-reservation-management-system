<?php
session_start();
require_once 'includes/auth.php';

// Redirect if already logged in
if (Auth::isLoggedIn()) {
    Auth::redirectToDashboard();
}

$error = '';
$success = '';

// Handle logout message
if (isset($_GET['logout'])) {
    $success = 'You have been successfully logged out.';
}

// Handle session timeout
if (isset($_GET['timeout'])) {
    $error = 'Your session has expired. Please log in again.';
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        if (Auth::login($username, $password)) {
            Auth::redirectToDashboard();
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - Hotel Cameroun</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .login-bg {
            background: linear-gradient(135deg, 
                rgba(46, 139, 87, 0.9) 0%, 
                rgba(220, 20, 60, 0.8) 50%, 
                rgba(255, 215, 0, 0.7) 100%),
                url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3') center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }
        
        .login-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        
        .login-container {
            position: relative;
            z-index: 2;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            padding: 3rem;
            max-width: 450px;
            margin: 0 auto;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header h2 {
            color: white;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0;
        }
        
        .form-floating label {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 15px;
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
            color: white;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-green));
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1.5rem;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, var(--dark-green), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(46, 139, 87, 0.4);
        }
        
        .demo-credentials {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .demo-credentials h6 {
            color: var(--secondary-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .demo-user {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: white;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .demo-user:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .back-to-site {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 3;
        }
        
        .back-to-site a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .back-to-site a:hover {
            color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <div class="login-bg">
        <div class="back-to-site">
            <a href="index.php">
                <i class="fas fa-arrow-left me-2"></i>Back to Hotel Cameroun
            </a>
        </div>
        
        <div class="container login-container">
            <div class="login-card">
                <div class="login-header">
                    <h2>Staff Login</h2>
                    <p>Access your dashboard</p>
                </div>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger glassmorphism">
                        <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success glassmorphism">
                        <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="login.php">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label text-white" for="remember">
                            Remember me
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </form>
                
                <div class="demo-credentials">
                    <h6><i class="fas fa-key me-2"></i>Demo Accounts</h6>
                    <div class="demo-user" onclick="fillCredentials('admin', 'admin123')">
                        <strong>Administrator:</strong> admin / admin123
                    </div>
                    <div class="demo-user" onclick="fillCredentials('receptionist1', 'recep123')">
                        <strong>Receptionist:</strong> receptionist1 / recep123
                    </div>
                    <div class="demo-user" onclick="fillCredentials('housekeeper1', 'house123')">
                        <strong>Housekeeping:</strong> housekeeper1 / house123
                    </div>
                    <div class="demo-user" onclick="fillCredentials('restaurant1', 'resto123')">
                        <strong>Restaurant:</strong> restaurant1 / resto123
                    </div>
                    <div class="demo-user" onclick="fillCredentials('spa1', 'spa123')">
                        <strong>Spa Manager:</strong> spa1 / spa123
                    </div>
                    <div class="demo-user" onclick="fillCredentials('guest1', 'guest123')">
                        <strong>Guest:</strong> guest1 / guest123
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <a href="#" class="text-white-50">
                        <small>Forgot your password?</small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Fill demo credentials
        function fillCredentials(username, password) {
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            
            // Add visual feedback
            const usernameField = document.getElementById('username');
            const passwordField = document.getElementById('password');
            
            usernameField.style.background = 'rgba(255, 215, 0, 0.2)';
            passwordField.style.background = 'rgba(255, 215, 0, 0.2)';
            
            setTimeout(() => {
                usernameField.style.background = '';
                passwordField.style.background = '';
            }, 1000);
        }
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            
            if (!username || !password) {
                e.preventDefault();
                alert('Please fill in all fields');
            }
        });
        
        // Auto-focus username field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
        
        // Enter key handling
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const activeElement = document.activeElement;
                if (activeElement.id === 'username') {
                    document.getElementById('password').focus();
                }
            }
        });
    </script>
</body>
</html>