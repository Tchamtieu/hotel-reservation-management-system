// Gallery specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Gallery filtering functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            this.classList.add('filter-animation');
            
            // Remove animation class after animation completes
            setTimeout(() => {
                this.classList.remove('filter-animation');
            }, 300);
            
            // Filter gallery items
            galleryItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    item.classList.remove('hiding');
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    item.classList.add('hiding');
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 500);
                }
            });
        });
    });
    
    // Modal image gallery functionality
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('imageModalLabel');
    const prevButton = document.getElementById('prevImage');
    const nextButton = document.getElementById('nextImage');
    
    let currentImages = [];
    let currentIndex = 0;
    
    // Collect all visible gallery images
    function updateImageList() {
        const visibleItems = Array.from(galleryItems).filter(item => 
            !item.classList.contains('hiding') && 
            getComputedStyle(item).display !== 'none'
        );
        
        currentImages = visibleItems.map(item => {
            const button = item.querySelector('[data-image]');
            return {
                src: button.getAttribute('data-image'),
                title: button.getAttribute('data-title')
            };
        });
    }
    
    // Show modal with specific image
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            updateImageList();
            const imageSrc = this.getAttribute('data-image');
            const imageTitle = this.getAttribute('data-title');
            
            // Find current index
            currentIndex = currentImages.findIndex(img => img.src === imageSrc);
            if (currentIndex === -1) currentIndex = 0;
            
            showModalImage(currentIndex);
        });
    });
    
    // Show image at specific index
    function showModalImage(index) {
        if (currentImages.length === 0) return;
        
        const image = currentImages[index];
        modalImage.src = image.src;
        modalImage.alt = image.title;
        modalTitle.textContent = image.title;
        
        // Update navigation buttons
        prevButton.style.display = currentImages.length > 1 ? 'block' : 'none';
        nextButton.style.display = currentImages.length > 1 ? 'block' : 'none';
        
        // Add loading effect
        modalImage.style.opacity = '0';
        modalImage.onload = () => {
            modalImage.style.transition = 'opacity 0.3s ease';
            modalImage.style.opacity = '1';
        };
    }
    
    // Previous image
    prevButton.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
        showModalImage(currentIndex);
    });
    
    // Next image
    nextButton.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % currentImages.length;
        showModalImage(currentIndex);
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (imageModal.classList.contains('show')) {
            if (e.key === 'ArrowLeft') {
                prevButton.click();
            } else if (e.key === 'ArrowRight') {
                nextButton.click();
            } else if (e.key === 'Escape') {
                bootstrap.Modal.getInstance(imageModal).hide();
            }
        }
    });
    
    // Image zoom functionality
    let isZoomed = false;
    let startX, startY, translateX = 0, translateY = 0;
    
    modalImage.addEventListener('click', function(e) {
        const container = this.parentElement;
        
        if (!isZoomed) {
            // Zoom in
            isZoomed = true;
            container.classList.add('zoomed');
            
            // Calculate zoom center based on click position
            const rect = this.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = (e.clientY - rect.top) / rect.height;
            
            const offsetX = (0.5 - x) * rect.width;
            const offsetY = (0.5 - y) * rect.height;
            
            this.style.transformOrigin = `${x * 100}% ${y * 100}%`;
            this.style.transform = `scale(2) translate(${offsetX}px, ${offsetY}px)`;
        } else {
            // Zoom out
            isZoomed = false;
            container.classList.remove('zoomed');
            this.style.transform = 'scale(1) translate(0, 0)';
            translateX = 0;
            translateY = 0;
        }
    });
    
    // Drag functionality when zoomed
    modalImage.addEventListener('mousedown', function(e) {
        if (!isZoomed) return;
        
        e.preventDefault();
        startX = e.clientX - translateX;
        startY = e.clientY - translateY;
        
        document.addEventListener('mousemove', dragImage);
        document.addEventListener('mouseup', stopDrag);
    });
    
    function dragImage(e) {
        if (!isZoomed) return;
        
        translateX = e.clientX - startX;
        translateY = e.clientY - startY;
        
        modalImage.style.transform = `scale(2) translate(${translateX}px, ${translateY}px)`;
    }
    
    function stopDrag() {
        document.removeEventListener('mousemove', dragImage);
        document.removeEventListener('mouseup', stopDrag);
    }
    
    // Reset zoom when modal is hidden
    imageModal.addEventListener('hidden.bs.modal', function() {
        isZoomed = false;
        modalImage.style.transform = 'scale(1) translate(0, 0)';
        modalImage.parentElement.classList.remove('zoomed');
        translateX = 0;
        translateY = 0;
    });
    
    // Touch support for mobile devices
    let startTouchX, startTouchY, currentTouchX, currentTouchY;
    let isSwiping = false;
    
    modalImage.addEventListener('touchstart', function(e) {
        if (e.touches.length === 1) {
            startTouchX = e.touches[0].clientX;
            startTouchY = e.touches[0].clientY;
            isSwiping = true;
        }
    });
    
    modalImage.addEventListener('touchmove', function(e) {
        if (!isSwiping || e.touches.length !== 1) return;
        
        e.preventDefault();
        currentTouchX = e.touches[0].clientX;
        currentTouchY = e.touches[0].clientY;
    });
    
    modalImage.addEventListener('touchend', function(e) {
        if (!isSwiping) return;
        
        const diffX = startTouchX - currentTouchX;
        const diffY = Math.abs(startTouchY - currentTouchY);
        
        // If horizontal swipe is more significant than vertical
        if (Math.abs(diffX) > diffY && Math.abs(diffX) > 50) {
            if (diffX > 0) {
                // Swipe left - next image
                nextButton.click();
            } else {
                // Swipe right - previous image
                prevButton.click();
            }
        }
        
        isSwiping = false;
    });
    
    // Lazy loading for gallery images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.style.opacity = '0';
                    img.src = img.dataset.src;
                    img.onload = () => {
                        img.style.transition = 'opacity 0.5s ease';
                        img.style.opacity = '1';
                        img.removeAttribute('data-src');
                    };
                    imageObserver.unobserve(img);
                }
            }
        });
    });
    
    // Observe all gallery images with data-src
    document.querySelectorAll('.gallery-image[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
    
    // Enhanced hover effects for gallery cards
    galleryItems.forEach(item => {
        const card = item.querySelector('.gallery-card');
        const overlay = item.querySelector('.gallery-overlay');
        const content = item.querySelector('.gallery-content');
        
        card.addEventListener('mouseenter', function() {
            overlay.style.opacity = '1';
            content.style.transform = 'translateY(0)';
        });
        
        card.addEventListener('mouseleave', function() {
            overlay.style.opacity = '0';
            content.style.transform = 'translateY(30px)';
        });
    });
    
    // Carousel auto-play with pause on hover
    const carousel = document.getElementById('featuredCarousel');
    if (carousel) {
        const carouselInstance = new bootstrap.Carousel(carousel, {
            interval: 5000,
            ride: 'carousel'
        });
        
        carousel.addEventListener('mouseenter', () => {
            carouselInstance.pause();
        });
        
        carousel.addEventListener('mouseleave', () => {
            carouselInstance.cycle();
        });
    }
    
    // Animation on scroll for gallery items
    const galleryObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    galleryItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(50px)';
        item.style.transition = 'all 0.6s ease';
        galleryObserver.observe(item);
    });
    
    // Search functionality (if search input exists)
    const searchInput = document.getElementById('gallerySearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            galleryItems.forEach(item => {
                const title = item.querySelector('h5').textContent.toLowerCase();
                const description = item.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    item.style.display = 'block';
                    item.classList.remove('hiding');
                } else {
                    item.style.display = 'none';
                    item.classList.add('hiding');
                }
            });
        });
    }
    
    // Preload next/previous images for faster navigation
    function preloadImage(src) {
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = resolve;
            img.onerror = reject;
            img.src = src;
        });
    }
    
    function preloadAdjacentImages() {
        if (currentImages.length <= 1) return;
        
        const prevIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
        const nextIndex = (currentIndex + 1) % currentImages.length;
        
        preloadImage(currentImages[prevIndex].src);
        preloadImage(currentImages[nextIndex].src);
    }
    
    // Preload images when modal is shown
    imageModal.addEventListener('shown.bs.modal', preloadAdjacentImages);
    
    // Update image list when filter changes
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            setTimeout(updateImageList, 600); // Wait for filter animation
        });
    });
    
    // Initialize
    updateImageList();
    
    // Add visual feedback for loading states
    function showLoading(element) {
        element.style.position = 'relative';
        const loader = document.createElement('div');
        loader.className = 'loading-spinner';
        loader.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        loader.style.cssText = `
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--primary-color);
            font-size: 2rem;
            z-index: 10;
        `;
        element.appendChild(loader);
        return loader;
    }
    
    function hideLoading(loader) {
        if (loader && loader.parentElement) {
            loader.parentElement.removeChild(loader);
        }
    }
    
    // Error handling for broken images
    document.querySelectorAll('.gallery-image').forEach(img => {
        img.addEventListener('error', function() {
            this.src = 'assets/images/placeholder.jpg';
            this.alt = 'Image not available';
        });
    });
    
});

// Gallery utility functions
const GalleryUtils = {
    
    // Add new gallery item dynamically
    addGalleryItem: function(imageSrc, title, description, category) {
        const galleryGrid = document.querySelector('.gallery-grid');
        const newItem = document.createElement('div');
        newItem.className = 'col-lg-4 col-md-6 gallery-item';
        newItem.setAttribute('data-category', category);
        
        newItem.innerHTML = `
            <div class="gallery-card glassmorphism">
                <img src="${imageSrc}" alt="${title}" class="gallery-image">
                <div class="gallery-overlay">
                    <div class="gallery-content">
                        <h5>${title}</h5>
                        <p>${description}</p>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="${imageSrc}" data-title="${title}">
                            <i class="fas fa-expand me-2"></i>View
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        galleryGrid.appendChild(newItem);
        
        // Add event listeners to new item
        const button = newItem.querySelector('[data-bs-toggle="modal"]');
        button.addEventListener('click', function() {
            // Trigger modal functionality
        });
    },
    
    // Get current filter
    getCurrentFilter: function() {
        return document.querySelector('.filter-btn.active').getAttribute('data-filter');
    },
    
    // Count items by category
    countByCategory: function() {
        const counts = {};
        document.querySelectorAll('.gallery-item').forEach(item => {
            const category = item.getAttribute('data-category');
            counts[category] = (counts[category] || 0) + 1;
        });
        return counts;
    }
    
};