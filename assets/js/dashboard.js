// Dashboard JavaScript Functionality
document.addEventListener('DOMContentLoaded', function() {
    
    // Sidebar navigation
    initializeSidebar();
    
    // Content section switching
    initializeContentSwitching();
    
    // Responsive sidebar toggle
    initializeResponsiveSidebar();
    
    // Initialize notifications
    initializeNotifications();
    
    // Auto-refresh dashboard data
    initializeAutoRefresh();
    
});

// Sidebar Navigation
function initializeSidebar() {
    const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetSection = this.getAttribute('data-section');
            
            // Update active nav link
            navLinks.forEach(nl => nl.classList.remove('active'));
            this.classList.add('active');
            
            // Switch content section
            switchContentSection(targetSection);
            
            // Update page title
            const pageTitle = document.querySelector('.page-title');
            if (pageTitle) {
                pageTitle.textContent = this.querySelector('span').textContent;
            }
        });
    });
}

// Content Section Switching
function initializeContentSwitching() {
    const sections = document.querySelectorAll('.content-section');
    
    // Hide all sections initially except the first active one
    sections.forEach(section => {
        if (!section.classList.contains('active')) {
            section.style.display = 'none';
        }
    });
}

function switchContentSection(sectionId) {
    const sections = document.querySelectorAll('.content-section');
    
    // Hide all sections
    sections.forEach(section => {
        section.classList.remove('active');
        section.style.display = 'none';
    });
    
    // Show target section
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.style.display = 'block';
        setTimeout(() => {
            targetSection.classList.add('active');
        }, 50);
    }
}

// Responsive Sidebar
function initializeResponsiveSidebar() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('sidebar-open');
        });
    }
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1200) {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('show');
                mainContent.classList.remove('sidebar-open');
            }
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1200) {
            sidebar.classList.remove('show');
            mainContent.classList.remove('sidebar-open');
        }
    });
}

// Notifications
function initializeNotifications() {
    // Simulate real-time notifications
    setTimeout(() => {
        showNotification('New booking received for Hilton Yaoundé', 'success');
    }, 5000);
    
    setTimeout(() => {
        showNotification('Room maintenance completed in K Hotel Douala', 'info');
    }, 10000);
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification alert alert-${type}`;
    notification.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <span>${message}</span>
            <button type="button" class="btn-close btn-close-white" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Auto-refresh dashboard data
function initializeAutoRefresh() {
    // Refresh every 30 seconds
    setInterval(() => {
        updateDashboardData();
    }, 30000);
}

function updateDashboardData() {
    // Simulate updating statistics
    const statCards = document.querySelectorAll('.stat-card');
    
    statCards.forEach(card => {
        card.classList.add('loading');
        
        setTimeout(() => {
            card.classList.remove('loading');
            
            // Update notification badge
            const notificationBadge = document.querySelector('.nav-link .badge');
            if (notificationBadge) {
                const currentCount = parseInt(notificationBadge.textContent);
                notificationBadge.textContent = Math.max(0, currentCount + Math.floor(Math.random() * 3) - 1);
            }
        }, 1000);
    });
}

// Table interactions
function initializeTableActions() {
    const tableButtons = document.querySelectorAll('.btn-group .btn');
    
    tableButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('title') || this.textContent.trim();
            const row = this.closest('tr');
            
            switch(action) {
                case 'View':
                    handleViewAction(row);
                    break;
                case 'Edit':
                    handleEditAction(row);
                    break;
                case 'Delete':
                case 'Cancel':
                    handleDeleteAction(row);
                    break;
            }
        });
    });
}

function handleViewAction(row) {
    const firstCell = row.querySelector('td');
    const id = firstCell ? firstCell.textContent.trim() : 'Unknown';
    showNotification(`Viewing details for ${id}`, 'info');
}

function handleEditAction(row) {
    const firstCell = row.querySelector('td');
    const id = firstCell ? firstCell.textContent.trim() : 'Unknown';
    showNotification(`Edit mode for ${id}`, 'warning');
}

function handleDeleteAction(row) {
    const firstCell = row.querySelector('td');
    const id = firstCell ? firstCell.textContent.trim() : 'Unknown';
    
    if (confirm(`Are you sure you want to delete ${id}?`)) {
        row.style.opacity = '0.5';
        row.style.pointerEvents = 'none';
        showNotification(`${id} has been deleted`, 'success');
        
        setTimeout(() => {
            row.remove();
        }, 1000);
    }
}

// Form handling
function initializeForms() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            
            // Simulate form submission
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
                showNotification('Settings saved successfully!', 'success');
            }, 2000);
        });
    });
}

// Search functionality
function initializeSearch() {
    const searchInputs = document.querySelectorAll('input[type="search"], .search-input');
    
    searchInputs.forEach(input => {
        input.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const table = this.closest('.card')?.querySelector('table') || 
                         document.querySelector('table');
            
            if (table) {
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    });
}

// Dashboard utilities
const DashboardUtils = {
    
    // Format currency
    formatCurrency: function(amount) {
        return new Intl.NumberFormat('fr-CM', {
            style: 'currency',
            currency: 'XAF',
            minimumFractionDigits: 0
        }).format(amount);
    },
    
    // Format date
    formatDate: function(dateString) {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    },
    
    // Get status badge class
    getStatusBadge: function(status) {
        const badges = {
            'active': 'success',
            'inactive': 'secondary',
            'confirmed': 'success',
            'pending': 'warning',
            'cancelled': 'danger',
            'completed': 'info'
        };
        return badges[status] || 'secondary';
    },
    
    // Show loading state
    showLoading: function(element) {
        element.classList.add('loading');
    },
    
    // Hide loading state
    hideLoading: function(element) {
        element.classList.remove('loading');
    },
    
    // Animate counter
    animateCounter: function(element, targetValue, duration = 1000) {
        const startValue = 0;
        const increment = targetValue / (duration / 16);
        let currentValue = startValue;
        
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= targetValue) {
                element.textContent = targetValue;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(currentValue);
            }
        }, 16);
    },
    
    // Export data to CSV
    exportToCSV: function(tableId, filename = 'export.csv') {
        const table = document.getElementById(tableId) || document.querySelector('table');
        if (!table) return;
        
        const rows = [];
        const tableRows = table.querySelectorAll('tr');
        
        tableRows.forEach(row => {
            const cols = row.querySelectorAll('td, th');
            const rowData = Array.from(cols).map(col => 
                `"${col.textContent.replace(/"/g, '""')}"`
            );
            rows.push(rowData.join(','));
        });
        
        const csvContent = rows.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        a.click();
        
        window.URL.revokeObjectURL(url);
    }
};

// Initialize additional features when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeTableActions();
    initializeForms();
    initializeSearch();
    
    // Animate counters on page load
    const counters = document.querySelectorAll('.stat-content h3');
    counters.forEach(counter => {
        const value = parseInt(counter.textContent.replace(/[^\d]/g, ''));
        if (value) {
            counter.textContent = '0';
            DashboardUtils.animateCounter(counter, value);
        }
    });
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + S to save (prevent default and show notification)
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        showNotification('Use the Save button to save changes', 'info');
    }
    
    // Escape to close modals
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(modal => {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    }
});

// Export dashboard utilities globally
window.DashboardUtils = DashboardUtils;
window.showNotification = showNotification;