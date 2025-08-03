// Services page specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize AOS (Animate On Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true,
            offset: 100
        });
    }
    
    // Service Details Data
    const serviceDetails = {
        'presidential-suite': {
            title: 'Presidential Suite',
            images: [
                'assets/images/services/presidential-suite-1.jpg',
                'assets/images/services/presidential-suite-2.jpg',
                'assets/images/services/presidential-suite-3.jpg'
            ],
            description: 'Experience the pinnacle of luxury in our Presidential Suite, featuring 300 square meters of elegantly appointed space with panoramic city views, marble bathrooms, and personalized butler service.',
            features: [
                'Master bedroom with king-size bed',
                'Separate living and dining areas',
                'Private balcony with city views',
                'Marble bathroom with jacuzzi',
                'Personal butler service',
                'Complimentary airport transfer',
                'Mini bar and wine selection',
                'High-speed internet'
            ],
            price: '250,000 FCFA/night',
            includes: 'Breakfast, Wi-Fi, Butler Service, Airport Transfer'
        },
        'executive-suite': {
            title: 'Executive Suite',
            images: [
                'assets/images/services/executive-suite-1.jpg',
                'assets/images/services/executive-suite-2.jpg'
            ],
            description: 'Perfect for business travelers, our Executive Suite offers 120 square meters of sophisticated space with a separate living area and premium amenities.',
            features: [
                'Spacious bedroom with premium bedding',
                'Separate living area with sofa',
                'Work desk with ergonomic chair',
                'Executive lounge access',
                'Complimentary breakfast',
                'High-speed internet',
                'Mini bar',
                'City or garden views'
            ],
            price: '150,000 FCFA/night',
            includes: 'Breakfast, Wi-Fi, Executive Lounge Access'
        },
        'deluxe-room': {
            title: 'Deluxe Room',
            images: [
                'assets/images/services/deluxe-room-1.jpg',
                'assets/images/services/deluxe-room-2.jpg'
            ],
            description: 'Our Deluxe Rooms combine comfort and elegance in 45 square meters of beautifully designed space with modern amenities and stunning views.',
            features: [
                'Comfortable king or twin beds',
                'Modern bathroom with premium toiletries',
                'Air conditioning',
                'Flat-screen TV with cable',
                'Mini bar',
                'Free Wi-Fi',
                'Room service',
                'Garden or city views'
            ],
            price: '85,000 FCFA/night',
            includes: 'Wi-Fi, Mini Bar, Room Service'
        },
        'nkomo-restaurant': {
            title: 'Nkomo Restaurant',
            images: [
                'assets/images/services/nkomo-restaurant-1.jpg',
                'assets/images/services/nkomo-restaurant-2.jpg'
            ],
            description: 'Experience authentic Cameroonian flavors and international cuisine in our award-winning restaurant, featuring locally sourced ingredients and expert wine pairings.',
            features: [
                'Authentic Cameroonian dishes',
                'International cuisine menu',
                'Locally sourced ingredients',
                'Expert wine pairings',
                'Private dining rooms available',
                'Chef\'s table experience',
                'Vegetarian and vegan options',
                'Cultural dining presentations'
            ],
            price: 'From 15,000 FCFA/person',
            includes: 'Table service, cultural presentation'
        },
        'sky-lounge': {
            title: 'Sky Lounge',
            images: [
                'assets/images/services/sky-lounge-1.jpg',
                'assets/images/services/sky-lounge-2.jpg'
            ],
            description: 'Enjoy panoramic city views while sipping signature cocktails and light bites in our sophisticated rooftop lounge.',
            features: [
                'Panoramic city views',
                'Signature cocktail menu',
                'Premium spirits selection',
                'Light bites and appetizers',
                'Live music on weekends',
                'Private event space',
                'Outdoor terrace',
                'Professional bartenders'
            ],
            price: 'From 5,000 FCFA/drink',
            includes: 'Complimentary appetizers with cocktails'
        }
        // Add more service details as needed
    };
    
    // Tab switching functionality
    const serviceTabs = document.querySelectorAll('#serviceTabs .nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    serviceTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-bs-target');
            
            // Update active tab
            serviceTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Show target content with animation
            tabPanes.forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            setTimeout(() => {
                const targetPane = document.querySelector(targetTab);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                    
                    // Trigger AOS refresh for newly visible elements
                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }
                }
            }, 150);
        });
    });
    
    // Service detail modal functionality
    const serviceModal = document.getElementById('serviceModal');
    const serviceModalLabel = document.getElementById('serviceModalLabel');
    const serviceModalBody = document.getElementById('serviceModalBody');
    const serviceButtons = document.querySelectorAll('.btn-service');
    
    serviceButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-service');
            const service = serviceDetails[serviceId];
            
            if (service) {
                // Update modal title
                serviceModalLabel.textContent = service.title;
                
                // Create modal content
                const modalContent = createServiceModalContent(service);
                serviceModalBody.innerHTML = modalContent;
                
                // Show modal
                const modal = new bootstrap.Modal(serviceModal);
                modal.show();
                
                // Initialize image carousel if present
                initializeModalCarousel();
            }
        });
    });
    
    // Create service modal content
    function createServiceModalContent(service) {
        const imagesCarousel = service.images.length > 1 ? 
            createImageCarousel(service.images) : 
            `<img src="${service.images[0]}" class="img-fluid rounded mb-4" alt="${service.title}">`;
        
        return `
            ${imagesCarousel}
            <div class="service-modal-content">
                <p class="lead mb-4">${service.description}</p>
                
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="text-primary mb-3">Features & Amenities</h6>
                        <ul class="list-unstyled">
                            ${service.features.map(feature => `
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>${feature}
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing-info glassmorphism p-3 rounded">
                            <h6 class="text-primary mb-2">Pricing</h6>
                            <p class="h5 text-white mb-3">${service.price}</p>
                            <h6 class="text-primary mb-2">Includes</h6>
                            <p class="small text-light mb-0">${service.includes}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    
    // Create image carousel for modal
    function createImageCarousel(images) {
        const carouselId = 'serviceCarousel';
        const indicators = images.map((_, index) => 
            `<button type="button" data-bs-target="#${carouselId}" data-bs-slide-to="${index}" 
             class="${index === 0 ? 'active' : ''}" aria-label="Slide ${index + 1}"></button>`
        ).join('');
        
        const slides = images.map((image, index) => 
            `<div class="carousel-item ${index === 0 ? 'active' : ''}">
                <img src="${image}" class="d-block w-100 rounded" alt="Service Image ${index + 1}">
            </div>`
        ).join('');
        
        return `
            <div id="${carouselId}" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    ${indicators}
                </div>
                <div class="carousel-inner">
                    ${slides}
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#${carouselId}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#${carouselId}" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        `;
    }
    
    // Initialize modal carousel
    function initializeModalCarousel() {
        const carousel = document.querySelector('#serviceCarousel');
        if (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: 5000,
                ride: 'carousel'
            });
        }
    }
    
    // Enhanced hover effects for service cards
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.02)';
            this.style.boxShadow = '0 30px 70px 0 rgba(31, 38, 135, 0.6)';
            
            // Add floating particles effect
            if (!this.querySelector('.floating-particles')) {
                const particles = document.createElement('div');
                particles.className = 'floating-particles';
                this.appendChild(particles);
            }
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
            
            // Remove floating particles
            const particles = this.querySelector('.floating-particles');
            if (particles) {
                particles.remove();
            }
        });
    });
    
    // Additional services hover effects
    const additionalServices = document.querySelectorAll('.additional-service');
    
    additionalServices.forEach(service => {
        service.addEventListener('mouseenter', function() {
            const icon = this.querySelector('i');
            icon.style.transform = 'scale(1.2) rotate(5deg)';
            icon.style.color = 'var(--secondary-color)';
        });
        
        service.addEventListener('mouseleave', function() {
            const icon = this.querySelector('i');
            icon.style.transform = '';
            icon.style.color = '';
        });
    });
    
    // Smooth scrolling for service navigation
    function scrollToServices(category) {
        const targetTab = document.querySelector(`[data-bs-target="#${category}"]`);
        if (targetTab) {
            targetTab.click();
            setTimeout(() => {
                targetTab.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }, 200);
        }
    }
    
    // Price animation
    function animatePrices() {
        const priceElements = document.querySelectorAll('.service-price .price');
        
        priceElements.forEach(element => {
            const text = element.textContent;
            if (text.includes('FCFA')) {
                element.innerHTML = text.replace(/(\d+,?\d*)\s*FCFA/, 
                    '<span class="price-number">$1</span> <span class="currency">FCFA</span>');
            }
        });
    }
    
    // Service card loading animation
    function addLoadingState(card) {
        card.classList.add('loading');
        setTimeout(() => {
            card.classList.remove('loading');
        }, 1500);
    }
    
    // Initialize features
    animatePrices();
    
    // Lazy loading for service images
    const serviceImages = document.querySelectorAll('.service-image');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            }
        });
    });
    
    serviceImages.forEach(img => {
        if (img.dataset.src) {
            imageObserver.observe(img);
        }
    });
    
    // Search functionality for services
    function filterServices(searchTerm) {
        const allCards = document.querySelectorAll('.service-card');
        const searchLower = searchTerm.toLowerCase();
        
        allCards.forEach(card => {
            const title = card.querySelector('h5').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();
            const features = Array.from(card.querySelectorAll('.feature-tag'))
                .map(tag => tag.textContent.toLowerCase()).join(' ');
            
            if (title.includes(searchLower) || 
                description.includes(searchLower) || 
                features.includes(searchLower)) {
                card.style.display = 'block';
                card.style.opacity = '1';
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
            }
        });
    }
    
    // Add search input if needed
    const searchInput = document.getElementById('serviceSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterServices(this.value);
        });
    }
    
    // Booking integration
    function initializeBookingIntegration() {
        const bookingButtons = document.querySelectorAll('a[href="booking.php"]');
        
        bookingButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Get service information for pre-filling booking form
                const serviceCard = this.closest('.service-card, .modal-content');
                if (serviceCard) {
                    const serviceName = serviceCard.querySelector('h5').textContent;
                    const servicePrice = serviceCard.querySelector('.price').textContent;
                    
                    // Store in sessionStorage for booking page
                    sessionStorage.setItem('selectedService', JSON.stringify({
                        name: serviceName,
                        price: servicePrice
                    }));
                }
            });
        });
    }
    
    initializeBookingIntegration();
    
    // Performance optimization: Debounced resize handler
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Refresh AOS on resize
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        }, 250);
    });
    
    // Error handling for missing images
    serviceImages.forEach(img => {
        img.addEventListener('error', function() {
            this.src = 'assets/images/placeholder-service.jpg';
            this.alt = 'Service image not available';
        });
    });
    
});

// Utility functions for services
const ServicesUtils = {
    
    // Get current active tab
    getCurrentTab: function() {
        return document.querySelector('#serviceTabs .nav-link.active').getAttribute('data-bs-target');
    },
    
    // Switch to specific tab
    switchToTab: function(tabId) {
        const tab = document.querySelector(`[data-bs-target="#${tabId}"]`);
        if (tab) {
            tab.click();
        }
    },
    
    // Format price in FCFA
    formatPrice: function(amount) {
        return new Intl.NumberFormat('fr-CM', {
            style: 'currency',
            currency: 'XAF',
            minimumFractionDigits: 0
        }).format(amount);
    },
    
    // Add new service dynamically
    addService: function(serviceData, category) {
        const categoryPane = document.getElementById(category);
        if (categoryPane) {
            const serviceGrid = categoryPane.querySelector('.row');
            const serviceCard = this.createServiceCard(serviceData);
            serviceGrid.appendChild(serviceCard);
        }
    },
    
    // Create service card element
    createServiceCard: function(serviceData) {
        const cardDiv = document.createElement('div');
        cardDiv.className = 'col-lg-4 col-md-6';
        cardDiv.innerHTML = `
            <div class="service-card glassmorphism h-100" data-category="${serviceData.category}">
                <div class="service-icon">
                    <i class="${serviceData.icon}"></i>
                </div>
                <img src="${serviceData.image}" alt="${serviceData.title}" class="service-image">
                <div class="service-content">
                    <h5>${serviceData.title}</h5>
                    <p>${serviceData.description}</p>
                    <div class="service-features">
                        ${serviceData.features.map(feature => 
                            `<span class="feature-tag">${feature}</span>`
                        ).join('')}
                    </div>
                    <div class="service-price">
                        <span class="price">${serviceData.price}</span>
                    </div>
                    <button class="btn btn-primary btn-service" data-service="${serviceData.id}">
                        <i class="fas fa-info-circle me-2"></i>Learn More
                    </button>
                </div>
            </div>
        `;
        return cardDiv;
    }
    
};