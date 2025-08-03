<?php
$page_title = "Connexion";
include 'includes/header.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: index.php?page=dashboard');
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    if (validateCSRFToken($_POST['csrf_token'] ?? '')) {
        try {
            $stmt = $db->prepare("SELECT id, username, password_hash, first_name, last_name, role, is_active FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password_hash'])) {
                if ($user['is_active']) {
                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['role'] = $user['role'];
                    
                    // Set remember me cookie if requested
                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', true, true);
                        // Store token in database for validation
                    }
                    
                    setFlashMessage('success', 'Connexion réussie! Bienvenue ' . $user['first_name'] . '.');
                    
                    // Redirect based on role
                    $redirect = 'index.php?page=dashboard';
                    if (isset($_GET['redirect'])) {
                        $redirect = $_GET['redirect'];
                    }
                    header('Location: ' . $redirect);
                    exit();
                } else {
                    setFlashMessage('error', 'Votre compte est désactivé. Contactez l\'administrateur.');
                }
            } else {
                setFlashMessage('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
            }
        } catch (PDOException $e) {
            setFlashMessage('error', 'Erreur de connexion. Veuillez réessayer.');
        }
    } else {
        setFlashMessage('error', 'Token de sécurité invalide.');
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="form-glass">
                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="bi bi-building" style="font-size: 3rem; color: var(--primary-color);"></i>
                    </div>
                    <h2 class="text-white fw-bold">Connexion</h2>
                    <p class="text-light opacity-75">Accédez à votre espace personnel</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="">
                    <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label text-white">
                            <i class="bi bi-person me-1"></i>Nom d'utilisateur ou Email
                        </label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">
                            <i class="bi bi-lock me-1"></i>Mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label text-light" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                    
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <hr class="border-light opacity-25 my-4">

                <!-- Additional Links -->
                <div class="text-center">
                    <p class="text-light opacity-75 mb-3">Vous n'avez pas de compte ?</p>
                    <a href="index.php?page=register" class="btn btn-outline-custom">
                        <i class="bi bi-person-plus me-2"></i>Créer un compte
                    </a>
                </div>

                <!-- Demo Accounts -->
                <div class="mt-4 p-3" style="background: rgba(255, 255, 255, 0.05); border-radius: 10px;">
                    <h6 class="text-white mb-2">
                        <i class="bi bi-info-circle me-2"></i>Comptes de démonstration
                    </h6>
                    <div class="row g-2 text-center">
                        <div class="col-6">
                            <button class="btn btn-sm btn-outline-light w-100" onclick="fillDemo('admin')">
                                <small>Admin</small>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-sm btn-outline-light w-100" onclick="fillDemo('receptionist')">
                                <small>Réceptionniste</small>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-sm btn-outline-light w-100" onclick="fillDemo('housekeeping')">
                                <small>Ménage</small>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-sm btn-outline-light w-100" onclick="fillDemo('guest')">
                                <small>Client</small>
                            </button>
                        </div>
                    </div>
                    <small class="text-light opacity-50 d-block mt-2">
                        Utilisez ces comptes pour tester les différents rôles
                    </small>
                </div>
            </div>

            <!-- Help Section -->
            <div class="glass-card p-4 mt-4">
                <h6 class="text-white mb-3">
                    <i class="bi bi-question-circle text-info me-2"></i>
                    Besoin d'aide ?
                </h6>
                <div class="row g-2">
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-info btn-sm w-100" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                            <i class="bi bi-key me-1"></i>Mot de passe oublié
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="index.php?page=contact" class="btn btn-outline-info btn-sm w-100">
                            <i class="bi bi-headset me-1"></i>Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white">
                    <i class="bi bi-key text-warning me-2"></i>
                    Réinitialisation du mot de passe
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm">
                    <div class="mb-3">
                        <label for="resetEmail" class="form-label text-white">Email</label>
                        <input type="email" class="form-control" id="resetEmail" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-send me-2"></i>Envoyer le lien de réinitialisation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        password.type = 'password';
        icon.className = 'bi bi-eye';
    }
});

// Demo account credentials
const demoAccounts = {
    admin: { username: 'admin', password: 'admin123' },
    receptionist: { username: 'reception', password: 'reception123' },
    housekeeping: { username: 'housekeeping', password: 'house123' },
    guest: { username: 'guest', password: 'guest123' }
};

function fillDemo(role) {
    const account = demoAccounts[role];
    if (account) {
        document.getElementById('username').value = account.username;
        document.getElementById('password').value = account.password;
    }
}

// Forgot password form
document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<span class="loading-spinner"></span> Envoi...';
    submitBtn.disabled = true;
    
    setTimeout(() => {
        hotelApp.showNotification('Instructions envoyées par email!', 'success');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal')).hide();
        this.reset();
    }, 2000);
});

// Auto-focus username field
document.getElementById('username').focus();
</script>

<?php include 'includes/footer.php'; ?>