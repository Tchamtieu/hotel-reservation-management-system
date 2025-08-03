<?php
$page_title = "Contact";
include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-5">
            <h1 class="text-white fw-bold">Contactez-nous</h1>
            <p class="text-light opacity-75">Nous sommes là pour vous aider et répondre à vos questions</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="form-glass">
                <h3 class="text-white mb-4">
                    <i class="bi bi-envelope text-primary me-2"></i>
                    Envoyez-nous un message
                </h3>
                
                <form id="contactForm" method="POST" action="api/process_contact.php">
                    <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label text-white">
                                <i class="bi bi-person me-1"></i>Nom complet *
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label text-white">
                                <i class="bi bi-envelope me-1"></i>Email *
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label text-white">
                                <i class="bi bi-telephone me-1"></i>Téléphone
                            </label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   placeholder="+237 6XX XXX XXX">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label text-white">
                                <i class="bi bi-tag me-1"></i>Sujet *
                            </label>
                            <select class="form-control" id="subject" name="subject" required>
                                <option value="">Sélectionnez un sujet</option>
                                <option value="Réservation">Demande de réservation</option>
                                <option value="Information">Demande d'information</option>
                                <option value="Service client">Service client</option>
                                <option value="Événement">Organisation d'événement</option>
                                <option value="Réclamation">Réclamation</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="message" class="form-label text-white">
                            <i class="bi bi-chat-text me-1"></i>Message *
                        </label>
                        <textarea class="form-control" id="message" name="message" rows="6" 
                                  placeholder="Votre message..." required></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                            <i class="bi bi-send me-2"></i>Envoyer le message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="col-lg-4">
            <!-- Contact Details -->
            <div class="glass-card p-4 mb-4">
                <h5 class="text-white mb-4">
                    <i class="bi bi-geo-alt text-primary me-2"></i>
                    Nos Coordonnées
                </h5>
                
                <div class="contact-info">
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt text-primary me-3 mt-1"></i>
                            <div>
                                <h6 class="text-white mb-1">Adresse</h6>
                                <p class="text-light opacity-75 mb-0">
                                    Quartier Bastos<br>
                                    Avenue Kennedy<br>
                                    Yaoundé, Cameroun
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-telephone text-success me-3 mt-1"></i>
                            <div>
                                <h6 class="text-white mb-1">Téléphone</h6>
                                <p class="text-light opacity-75 mb-0">
                                    <a href="tel:+2376XXXXXXX" class="text-light text-decoration-none">
                                        +237 6XX XXX XXX
                                    </a><br>
                                    <a href="tel:+237222XXXXX" class="text-light text-decoration-none">
                                        +237 222 XX XX XX
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-envelope text-warning me-3 mt-1"></i>
                            <div>
                                <h6 class="text-white mb-1">Email</h6>
                                <p class="text-light opacity-75 mb-0">
                                    <a href="mailto:contact@hotelboutique.cm" class="text-light text-decoration-none">
                                        contact@hotelboutique.cm
                                    </a><br>
                                    <a href="mailto:reservations@hotelboutique.cm" class="text-light text-decoration-none">
                                        reservations@hotelboutique.cm
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-clock text-info me-3 mt-1"></i>
                            <div>
                                <h6 class="text-white mb-1">Horaires d'accueil</h6>
                                <p class="text-light opacity-75 mb-0">
                                    24h/24 - 7j/7<br>
                                    Réception toujours ouverte
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="glass-card p-4 mb-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-share text-primary me-2"></i>
                    Suivez-nous
                </h5>
                <div class="row g-2">
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-custom w-100">
                            <i class="bi bi-facebook me-1"></i>Facebook
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-custom w-100">
                            <i class="bi bi-instagram me-1"></i>Instagram
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-custom w-100">
                            <i class="bi bi-twitter me-1"></i>Twitter
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-custom w-100">
                            <i class="bi bi-linkedin me-1"></i>LinkedIn
                        </a>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="glass-card p-4">
                <h5 class="text-white mb-3">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                    Contact d'Urgence
                </h5>
                <p class="text-light opacity-75 mb-3">
                    Pour toute urgence 24h/24
                </p>
                <a href="tel:+237EMERGENCY" class="btn btn-danger w-100">
                    <i class="bi bi-telephone-fill me-2"></i>
                    Numéro d'urgence
                </a>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="glass-card p-4">
                <h3 class="text-white mb-4 text-center">
                    <i class="bi bi-map text-primary me-2"></i>
                    Notre Emplacement
                </h3>
                
                <!-- Embedded Map Placeholder -->
                <div class="map-container position-relative" style="height: 400px; border-radius: 15px; overflow: hidden;">
                    <div class="d-flex align-items-center justify-content-center h-100 bg-secondary">
                        <div class="text-center text-white">
                            <i class="bi bi-geo-alt" style="font-size: 3rem;"></i>
                            <h5 class="mt-3">Carte Interactive</h5>
                            <p class="opacity-75">
                                Quartier Bastos, Avenue Kennedy<br>
                                Yaoundé, Cameroun
                            </p>
                            <button class="btn btn-primary-custom" onclick="openMaps()">
                                <i class="bi bi-map me-2"></i>Ouvrir dans Maps
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Directions -->
                <div class="row mt-4 g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="bi bi-airplane text-primary" style="font-size: 2rem;"></i>
                            <h6 class="text-white mt-2">Depuis l'Aéroport</h6>
                            <p class="text-light opacity-75 small">
                                35 minutes en voiture<br>
                                Navette disponible sur demande
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="bi bi-building text-success" style="font-size: 2rem;"></i>
                            <h6 class="text-white mt-2">Centre-ville</h6>
                            <p class="text-light opacity-75 small">
                                10 minutes en voiture<br>
                                Proche des attractions touristiques
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="bi bi-p-square text-warning" style="font-size: 2rem;"></i>
                            <h6 class="text-white mt-2">Parking</h6>
                            <p class="text-light opacity-75 small">
                                Parking gratuit disponible<br>
                                Sécurisé 24h/24
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <h3 class="text-white text-center mb-4">Questions Fréquemment Posées</h3>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item glass-card mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed glass-button text-white" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#faq1">
                            Comment puis-je modifier ou annuler ma réservation ?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-light">
                            Vous pouvez modifier ou annuler votre réservation gratuitement jusqu'à 24h avant votre arrivée. 
                            Contactez notre service client ou utilisez le lien dans votre email de confirmation.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item glass-card mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed glass-button text-white" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#faq2">
                            Quels sont les moyens de paiement acceptés ?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-light">
                            Nous acceptons les espèces (FCFA), les cartes bancaires (Visa, Mastercard), 
                            et les paiements par mobile money (Orange Money, MTN Money).
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item glass-card mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed glass-button text-white" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#faq3">
                            Proposez-vous un service de navette aéroport ?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-light">
                            Oui, nous proposons un service de navette depuis et vers l'aéroport de Yaoundé-Nsimalen. 
                            Le service coûte 15 000 FCFA par trajet et doit être réservé à l'avance.
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item glass-card mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed glass-button text-white" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#faq4">
                            L'hôtel dispose-t-il d'un parking ?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-light">
                            Oui, nous disposons d'un parking gratuit et sécurisé pour nos clients. 
                            Le parking est surveillé 24h/24 et dispose de places couvertes.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Contact form handling
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<span class="loading-spinner"></span> Envoi en cours...';
    submitBtn.disabled = true;
    
    // Simulate form submission
    setTimeout(() => {
        hotelApp.showNotification('Message envoyé avec succès! Nous vous répondrons sous 24h.', 'success');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        this.reset();
    }, 2000);
});

// Maps function
function openMaps() {
    // Replace with actual coordinates
    const lat = 3.848;
    const lng = 11.502;
    const url = `https://www.google.com/maps?q=${lat},${lng}`;
    window.open(url, '_blank');
}

// Auto-resize textarea
document.getElementById('message').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
});
</script>

<?php include 'includes/footer.php'; ?>