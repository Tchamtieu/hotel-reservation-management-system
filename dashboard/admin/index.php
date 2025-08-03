<?php
$page_title = "Dashboard Admin";
include '../../includes/header.php';

requireRole('admin');

// Fetch dashboard statistics
try {
    // Get today's statistics
    $today = date('Y-m-d');
    
    // Total reservations today
    $stmt = $db->prepare("SELECT COUNT(*) FROM reservations WHERE DATE(created_at) = ?");
    $stmt->execute([$today]);
    $reservations_today = $stmt->fetchColumn();
    
    // Total revenue this month
    $stmt = $db->prepare("
        SELECT COALESCE(SUM(amount), 0) 
        FROM payments 
        WHERE status = 'completed' 
        AND MONTH(processed_at) = MONTH(CURRENT_DATE()) 
        AND YEAR(processed_at) = YEAR(CURRENT_DATE())
    ");
    $stmt->execute();
    $revenue_month = $stmt->fetchColumn();
    
    // Room occupancy rate
    $stmt = $db->query("
        SELECT 
            (SELECT COUNT(*) FROM rooms WHERE status = 'occupied') as occupied,
            (SELECT COUNT(*) FROM rooms) as total
    ");
    $occupancy = $stmt->fetch(PDO::FETCH_ASSOC);
    $occupancy_rate = $occupancy['total'] > 0 ? round(($occupancy['occupied'] / $occupancy['total']) * 100, 1) : 0;
    
    // Pending reservations
    $stmt = $db->query("SELECT COUNT(*) FROM reservations WHERE status = 'pending'");
    $pending_reservations = $stmt->fetchColumn();
    
    // Recent reservations
    $stmt = $db->query("
        SELECT r.*, g.first_name, g.last_name, rt.name as room_type, rm.room_number
        FROM reservations r
        JOIN guests g ON r.guest_id = g.id
        JOIN rooms rm ON r.room_id = rm.id
        JOIN room_types rt ON rm.room_type_id = rt.id
        ORDER BY r.created_at DESC
        LIMIT 5
    ");
    $recent_reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $reservations_today = 0;
    $revenue_month = 0;
    $occupancy_rate = 0;
    $pending_reservations = 0;
    $recent_reservations = [];
}
?>

<div class="container-fluid py-4">
    <!-- Mobile Dashboard Toggle -->
    <button class="btn btn-outline-light d-lg-none mb-3" id="sidebarToggle">
        <i class="bi bi-list"></i> Menu
    </button>

    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-lg-3 col-xl-2">
            <div class="dashboard-sidebar">
                <div class="p-3">
                    <div class="text-center mb-4">
                        <div class="avatar-container mb-2">
                            <img src="../../assets/images/avatars/admin.jpg" 
                                 alt="Avatar" 
                                 class="rounded-circle"
                                 width="60" height="60"
                                 onerror="this.src='../../assets/images/avatars/default.jpg'">
                        </div>
                        <h6 class="text-white mb-1"><?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?></h6>
                        <small class="text-light opacity-75">Administrateur</small>
                    </div>
                    
                    <nav class="sidebar-nav">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#dashboard" data-tab="dashboard">
                                    <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#reservations" data-tab="reservations">
                                    <i class="bi bi-calendar-check me-2"></i>Réservations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#rooms" data-tab="rooms">
                                    <i class="bi bi-door-open me-2"></i>Chambres
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#guests" data-tab="guests">
                                    <i class="bi bi-people me-2"></i>Clients
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#staff" data-tab="staff">
                                    <i class="bi bi-person-badge me-2"></i>Personnel
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#housekeeping" data-tab="housekeeping">
                                    <i class="bi bi-house me-2"></i>Ménage
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#services" data-tab="services">
                                    <i class="bi bi-concierge-bell me-2"></i>Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#reports" data-tab="reports">
                                    <i class="bi bi-graph-up me-2"></i>Rapports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#settings" data-tab="settings">
                                    <i class="bi bi-gear me-2"></i>Paramètres
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 col-xl-10">
            <div class="dashboard-content p-4">
                
                <!-- Dashboard Tab -->
                <div class="tab-content" id="dashboard">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-white fw-bold mb-0">Tableau de bord</h2>
                        <div class="text-light opacity-75">
                            <i class="bi bi-calendar-date me-1"></i>
                            <?= date('d/m/Y H:i') ?>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card">
                                <div class="stat-number" data-target="<?= $reservations_today ?>"><?= $reservations_today ?></div>
                                <div class="stat-label">Réservations aujourd'hui</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card">
                                <div class="stat-number" data-target="<?= $occupancy_rate ?>"><?= $occupancy_rate ?>%</div>
                                <div class="stat-label">Taux d'occupation</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card">
                                <div class="stat-number" data-target="<?= intval($revenue_month / 1000) ?>"><?= number_format($revenue_month / 1000, 0) ?>K</div>
                                <div class="stat-label">Revenus ce mois (FCFA)</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stat-card">
                                <div class="stat-number" data-target="<?= $pending_reservations ?>"><?= $pending_reservations ?></div>
                                <div class="stat-label">Réservations en attente</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row g-4 mb-4">
                        <div class="col-lg-8">
                            <div class="dashboard-card">
                                <h5 class="mb-3">
                                    <i class="bi bi-lightning text-warning me-2"></i>
                                    Actions rapides
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <button class="btn btn-primary w-100" onclick="showTab('reservations')">
                                            <i class="bi bi-plus-circle me-1"></i>
                                            Nouvelle réservation
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-success w-100" onclick="showTab('rooms')">
                                            <i class="bi bi-house-check me-1"></i>
                                            Gérer les chambres
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-info w-100" onclick="showTab('reports')">
                                            <i class="bi bi-file-earmark-text me-1"></i>
                                            Voir les rapports
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-card">
                                <h6 class="mb-3">Statut du système</h6>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="badge bg-success me-2">●</div>
                                    <small>Base de données: Connectée</small>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="badge bg-success me-2">●</div>
                                    <small>Serveur: En ligne</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="badge bg-warning me-2">●</div>
                                    <small>Sauvegarde: En cours</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="dashboard-card">
                        <h5 class="mb-3">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            Réservations récentes
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Chambre</th>
                                        <th>Dates</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recent_reservations as $reservation): ?>
                                    <tr>
                                        <td>
                                            <strong><?= htmlspecialchars($reservation['first_name'] . ' ' . $reservation['last_name']) ?></strong>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($reservation['room_number']) ?> - 
                                            <?= htmlspecialchars($reservation['room_type']) ?>
                                        </td>
                                        <td>
                                            <small>
                                                Du <?= formatDate($reservation['check_in_date']) ?><br>
                                                Au <?= formatDate($reservation['check_out_date']) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <?php
                                            $status_class = match($reservation['status']) {
                                                'confirmed' => 'success',
                                                'pending' => 'warning',
                                                'cancelled' => 'danger',
                                                'checked_in' => 'info',
                                                'checked_out' => 'secondary',
                                                default => 'primary'
                                            };
                                            ?>
                                            <span class="badge bg-<?= $status_class ?>">
                                                <?= ucfirst($reservation['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($recent_reservations)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            Aucune réservation récente
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Reservations Tab -->
                <div class="tab-content d-none" id="reservations">
                    <h2 class="text-white fw-bold mb-4">Gestion des Réservations</h2>
                    
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Liste des réservations</h5>
                            <button class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i>Nouvelle réservation
                            </button>
                        </div>
                        
                        <!-- Filters -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <select class="form-select" id="statusFilter">
                                    <option value="">Tous les statuts</option>
                                    <option value="pending">En attente</option>
                                    <option value="confirmed">Confirmé</option>
                                    <option value="checked_in">Enregistré</option>
                                    <option value="checked_out">Parti</option>
                                    <option value="cancelled">Annulé</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="dateFilter" placeholder="Date">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="searchReservations" placeholder="Rechercher...">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-funnel"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div id="reservationsTable">
                            <!-- Reservations table content will be loaded here -->
                            <div class="text-center py-4">
                                <div class="loading-spinner"></div>
                                <p class="text-muted mt-2">Chargement des réservations...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rooms Tab -->
                <div class="tab-content d-none" id="rooms">
                    <h2 class="text-white fw-bold mb-4">Gestion des Chambres</h2>
                    
                    <div class="dashboard-card">
                        <h5 class="mb-3">État des chambres</h5>
                        <div id="roomsGrid">
                            <!-- Room status grid will be loaded here -->
                            <div class="text-center py-4">
                                <div class="loading-spinner"></div>
                                <p class="text-muted mt-2">Chargement des chambres...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional tabs content will be loaded dynamically -->
                <div class="tab-content d-none" id="guests">
                    <h2 class="text-white fw-bold mb-4">Gestion des Clients</h2>
                    <div class="dashboard-card">
                        <p class="text-muted">Contenu en cours de développement...</p>
                    </div>
                </div>

                <div class="tab-content d-none" id="staff">
                    <h2 class="text-white fw-bold mb-4">Gestion du Personnel</h2>
                    <div class="dashboard-card">
                        <p class="text-muted">Contenu en cours de développement...</p>
                    </div>
                </div>

                <div class="tab-content d-none" id="housekeeping">
                    <h2 class="text-white fw-bold mb-4">Gestion du Ménage</h2>
                    <div class="dashboard-card">
                        <p class="text-muted">Contenu en cours de développement...</p>
                    </div>
                </div>

                <div class="tab-content d-none" id="services">
                    <h2 class="text-white fw-bold mb-4">Gestion des Services</h2>
                    <div class="dashboard-card">
                        <p class="text-muted">Contenu en cours de développement...</p>
                    </div>
                </div>

                <div class="tab-content d-none" id="reports">
                    <h2 class="text-white fw-bold mb-4">Rapports</h2>
                    <div class="dashboard-card">
                        <p class="text-muted">Contenu en cours de développement...</p>
                    </div>
                </div>

                <div class="tab-content d-none" id="settings">
                    <h2 class="text-white fw-bold mb-4">Paramètres</h2>
                    <div class="dashboard-card">
                        <p class="text-muted">Contenu en cours de développement...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Dashboard tab management
function showTab(tabId) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('d-none');
    });
    
    // Show selected tab
    document.getElementById(tabId).classList.remove('d-none');
    
    // Update sidebar navigation
    document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
        link.classList.remove('active');
    });
    document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
    
    // Load tab content if needed
    loadTabContent(tabId);
}

// Tab navigation
document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const tabId = this.getAttribute('data-tab');
        showTab(tabId);
    });
});

// Load dynamic content for tabs
function loadTabContent(tabId) {
    switch(tabId) {
        case 'reservations':
            loadReservations();
            break;
        case 'rooms':
            loadRooms();
            break;
        // Add other cases as needed
    }
}

function loadReservations() {
    const container = document.getElementById('reservationsTable');
    // Simulate loading
    setTimeout(() => {
        container.innerHTML = `
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Chambre</th>
                            <th>Arrivée</th>
                            <th>Départ</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Aucune réservation trouvée
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;
    }, 1000);
}

function loadRooms() {
    const container = document.getElementById('roomsGrid');
    // Simulate loading
    setTimeout(() => {
        container.innerHTML = `
            <div class="row g-3">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <h6 class="text-success">Chambre 101</h6>
                            <span class="badge bg-success">Disponible</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card border-danger">
                        <div class="card-body text-center">
                            <h6 class="text-danger">Chambre 102</h6>
                            <span class="badge bg-danger">Occupée</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card border-warning">
                        <div class="card-body text-center">
                            <h6 class="text-warning">Chambre 103</h6>
                            <span class="badge bg-warning">Nettoyage</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }, 1000);
}

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    // Load initial content
    loadTabContent('dashboard');
});
</script>

<?php include '../../includes/footer.php'; ?>