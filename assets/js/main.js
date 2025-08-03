// Main JavaScript file for Hotel Management System

document.addEventListener('DOMContentLoaded', function() {
    // Initialize components
    initializeGallery();
    initializeBookingForm();
    initializeDashboard();
    initializeAnimations();
    initializeTooltips();
});

// Gallery functionality
function initializeGallery() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const imgSrc = this.querySelector('img').src;
            const imgAlt = this.querySelector('img').alt;
            showImageModal(imgSrc, imgAlt);
        });
    });
}

function showImageModal(src, alt) {
    // Create modal if it doesn't exist
    let modal = document.getElementById('imageModal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'imageModal';
        modal.className = 'modal fade';
        modal.innerHTML = `
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content glass-card">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        <img id="modalImage" src="" alt="" class="img-fluid w-100 rounded">
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }
    
    // Update modal content
    document.getElementById('modalImage').src = src;
    document.getElementById('modalImage').alt = alt;
    
    // Show modal
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
}

// Booking form functionality
function initializeBookingForm() {
    const bookingForm = document.getElementById('bookingForm');
    const checkInDate = document.getElementById('checkIn');
    const checkOutDate = document.getElementById('checkOut');
    const roomSelect = document.getElementById('roomType');
    
    if (checkInDate && checkOutDate) {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        checkInDate.min = today;
        checkOutDate.min = today;
        
        // Update checkout minimum when checkin changes
        checkInDate.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            checkinDate.setDate(checkinDate.getDate() + 1);
            checkOutDate.min = checkinDate.toISOString().split('T')[0];
            
            if (checkOutDate.value && new Date(checkOutDate.value) <= new Date(this.value)) {
                checkOutDate.value = '';
            }
            
            updateAvailability();
        });
        
        checkOutDate.addEventListener('change', updateAvailability);
        roomSelect?.addEventListener('change', updatePricing);
    }
    
    if (bookingForm) {
        bookingForm.addEventListener('submit', handleBookingSubmit);
    }
}

function updateAvailability() {
    const checkIn = document.getElementById('checkIn').value;
    const checkOut = document.getElementById('checkOut').value;
    const availabilityDiv = document.getElementById('availability');
    
    if (checkIn && checkOut && availabilityDiv) {
        availabilityDiv.innerHTML = '<div class="text-center"><div class="loading-spinner"></div> Vérification de la disponibilité...</div>';
        
        // Simulate API call
        setTimeout(() => {
            const available = Math.random() > 0.3; // 70% chance of availability
            if (available) {
                availabilityDiv.innerHTML = `
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> Chambres disponibles pour ces dates
                    </div>
                `;
            } else {
                availabilityDiv.innerHTML = `
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> Disponibilité limitée pour ces dates
                    </div>
                `;
            }
        }, 1500);
    }
}

function updatePricing() {
    const roomType = document.getElementById('roomType')?.value;
    const pricingDiv = document.getElementById('pricing');
    
    if (roomType && pricingDiv) {
        const prices = {
            'standard': 45000,
            'deluxe': 65000,
            'suite': 95000,
            'presidential': 150000
        };
        
        const price = prices[roomType] || 0;
        pricingDiv.innerHTML = `
            <div class="card glass-card">
                <div class="card-body text-center">
                    <h5>Prix par nuit</h5>
                    <h3 class="text-primary">${formatCurrency(price)}</h3>
                </div>
            </div>
        `;
    }
}

function handleBookingSubmit(e) {
    e.preventDefault();
    
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<span class="loading-spinner"></span> Traitement...';
    submitBtn.disabled = true;
    
    // Simulate form submission
    setTimeout(() => {
        showNotification('Réservation soumise avec succès!', 'success');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        e.target.reset();
    }, 2000);
}

// Dashboard functionality
function initializeDashboard() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.dashboard-sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    // Initialize dashboard charts if on dashboard page
    if (document.querySelector('.dashboard-content')) {
        initializeCharts();
        loadDashboardStats();
    }
}

function initializeCharts() {
    // Placeholder for chart initialization
    // You would integrate Chart.js or another charting library here
    console.log('Charts initialized');
}

function loadDashboardStats() {
    const statCards = document.querySelectorAll('.stat-number');
    
    statCards.forEach(card => {
        const targetValue = parseInt(card.dataset.target) || 0;
        animateCounter(card, targetValue);
    });
}

function animateCounter(element, target) {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 30);
}

// Animation utilities
function initializeAnimations() {
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, { threshold: 0.1 });
    
    // Observe elements with animation classes
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
}

// Tooltip initialization
function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show notification-toast`;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
    `;
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Utility functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('fr-CM', {
        style: 'currency',
        currency: 'XAF',
        minimumFractionDigits: 0
    }).format(amount) + ' FCFA';
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Form validation
function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        }
    });
    
    return isValid;
}

// AJAX helper
function makeRequest(url, options = {}) {
    const defaultOptions = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    };
    
    return fetch(url, { ...defaultOptions, ...options })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .catch(error => {
            console.error('Request failed:', error);
            showNotification('Une erreur est survenue. Veuillez réessayer.', 'error');
            throw error;
        });
}

// Search functionality
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
            const query = this.value.trim();
            if (query.length >= 2) {
                performSearch(query);
            }
        }, 300));
    }
}

function performSearch(query) {
    // Implement search functionality
    console.log('Searching for:', query);
}

// Export functions for global use
window.hotelApp = {
    showNotification,
    formatCurrency,
    validateForm,
    makeRequest,
    showImageModal
};