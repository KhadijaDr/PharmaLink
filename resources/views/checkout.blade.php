@extends('layouts.app')

@section('content')
<div class="checkout-container">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Hero Section -->
    <div class="checkout-hero bg-primary-gradient text-white text-center py-5 mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-shopping-bag me-2"></i>Finalisation de Commande
            </h1>
            <p class="lead mb-0">Remplissez vos informations pour compléter votre achat</p>
        </div>
    </div>

    <div class="container">
        <!-- Messages de notification -->
        @if(session('success'))
        <div class="checkout-notification alert alert-success shadow-lg fade-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-4"></i>
                <div>
                    <h5 class="mb-1">Commande confirmée!</h5>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif
        
        @if(session('error'))
        <div class="checkout-notification alert alert-danger shadow-lg fade-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-3 fs-4"></i>
                <div>
                    <h5 class="mb-1">Erreur!</h5>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif
        
        @if ($errors->any())
        <div class="checkout-notification alert alert-danger shadow-lg fade-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-3 fs-4"></i>
                <div>
                    <h5 class="mb-1">Veuillez corriger les erreurs suivantes:</h5>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)
        @php
            $total = 0;
            foreach(session('cart') as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        @endphp

        <div class="row g-5">
            <!-- Checkout Form -->
            <div class="col-lg-7">
                <div class="checkout-card card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white py-3">
                        <h3 class="mb-0">
                            <i class="fas fa-user-circle me-2"></i>Informations personnelles
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form id="checkout-form" action="{{ url('/commandes/valider') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-user me-2 text-primary"></i>Nom complet
                                </label>
                                <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label fw-bold">
                                    <i class="fas fa-phone me-2 text-primary"></i>Téléphone
                                </label>
                                <input type="text" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="address" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>Adresse
                                </label>
                                <input type="text" name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="prescription" class="form-label fw-bold">
                                    <i class="fas fa-file-prescription me-2 text-primary"></i>Ordonnance médicale
                                </label>
                                <div class="file-upload-container @error('prescription') is-invalid @enderror">
                                    <input type="file" name="prescription" id="prescription" class="form-control form-control-lg" accept="image/*" required>
                                    <div id="file-name-display" class="mt-2 text-center"></div>
                                </div>
                                @error('prescription')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="cart_data" id="cart_data" value="{{ json_encode(session('cart', [])) }}">

                            <button type="submit" id="confirm-order-btn" class="btn btn-primary w-100 py-3 confirm-order-btn">
                                <i class="fas fa-lock me-2"></i> CONFIRMER LA COMMANDE
                            </button>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="{{ url('/purchase') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour à la pharmacie
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-5">
                <div class="order-summary-card card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white py-3">
                        <h3 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>Récapitulatif
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="order-items">
                            @foreach (session('cart') as $item)
                            <div class="order-item d-flex justify-content-between align-items-center p-4 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-pills fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                        <small class="text-muted">{{ $item['quantity'] }} × {{ $item['price'] }} DH</small>
                                    </div>
                                </div>
                                <div class="fw-bold">{{ $item['price'] * $item['quantity'] }} DH</div>
                            </div>
                            @endforeach
                        </div>

                        <div class="order-total p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Sous-total:</span>
                                <span>{{ $total }} DH</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Livraison:</span>
                                <span>Gratuite</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center total-price">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold fs-5">{{ $total }} DH</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="{{ url('/purchase') }}" class="btn btn-outline-primary btn-lg rounded-pill back-btn">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la pharmacie
                    </a>
                </div>
            </div>
        </div>

        @else
        <!-- Empty Cart -->
        <div class="empty-cart text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="fas fa-shopping-cart fs-1 text-muted"></i>
            </div>
            <h3 class="mb-3">Votre panier est vide</h3>
            <p class="text-muted mb-4">Vous n'avez aucun article dans votre panier</p>
            <a href="{{ url('/purchase') }}" class="btn btn-primary btn-lg rounded-pill">
                <i class="fas fa-arrow-left me-2"></i>Retour à la pharmacie
            </a>
        </div>
        @endif
    </div>

    <!-- Bouton flottant pour soumettre le formulaire (solution de secours) -->
    <div class="floating-action-btn" id="floating-submit-btn">
        <button type="button" class="btn btn-floating">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
</div>

<style>
    /* Base Styles */
    .checkout-container {
        padding-bottom: 5rem;
        margin-top: 85px;
    }

    /* État de soumission du formulaire */
    body.form-submitting::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    body.form-submitting::before {
        content: 'Traitement en cours...';
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 2rem;
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        font-weight: bold;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 300px;
    }

    body.form-submitting::before::after {
        content: '';
        width: 2rem;
        height: 2rem;
        border: 4px solid rgba(13, 110, 253, 0.2);
        border-top-color: #0d6efd;
        border-radius: 50%;
        margin-left: 1rem;
        animation: spinner 1s linear infinite;
    }

    @keyframes spinner {
        to { transform: rotate(360deg); }
    }

    /* Hero Section */
    .checkout-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        margin-top: -1rem;
        padding-top: 6rem;
        position: relative;
        overflow: hidden;
    }

    .checkout-hero::before {
        content: "";
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        height: 100px;
        background: white;
        transform: skewY(-3deg);
        z-index: 1;
    }

    /* Cards */
    .checkout-card, .order-summary-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .checkout-card:hover, .order-summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .card-header {
        border-radius: 0 !important;
    }

    /* Form Elements */
    .form-control-lg {
        padding: 1rem 1.25rem;
        border-radius: 0.5rem;
        border: 1px solid #e0e0e0;
    }

    .form-control-lg:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        border-color: #0d6efd;
    }

    /* File Upload */
    .file-upload-container {
        position: relative;
    }

    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed #0d6efd;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-label:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .upload-icon {
        font-size: 3rem;
        color: #0d6efd;
        margin-bottom: 1rem;
    }

    .upload-icon i {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    .upload-text p {
        font-weight: bold;
        margin-bottom: 0.25rem;
        color: #333;
    }

    .upload-text small {
        color: #6c757d;
    }

    /* Confirm Order Button */
    .confirm-order-btn {
        background-color: #26d07c; /* Couleur verte vive */
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        border: none;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(38, 208, 124, 0.3);
    }

    .confirm-order-btn:hover {
        background-color: #20b36b;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(38, 208, 124, 0.4);
        color: white;
    }

    .confirm-order-btn:active {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(38, 208, 124, 0.3);
    }

    .confirm-order-btn i {
        margin-right: 8px;
    }

    /* Buttons */
    .checkout-btn {
        border-radius: 0.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
    }

    .checkout-btn::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .checkout-btn:hover::after {
        left: 100%;
    }

    .back-btn {
        transition: all 0.3s ease;
        padding: 0.5rem 2rem;
    }

    .back-btn:hover {
        background-color: #0d6efd !important;
        color: white !important;
        transform: translateY(-2px);
    }

    /* Order Summary */
    .order-item {
        transition: background-color 0.3s ease;
    }

    .order-item:hover {
        background-color: #f8f9fa;
    }

    .total-price {
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    /* Empty Cart */
    .empty-cart {
        max-width: 500px;
        margin: 0 auto;
        background-color: white;
        border-radius: 1rem;
        padding: 3rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-cart-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 50%;
    }

    /* Notification */
    .checkout-notification {
        position: fixed;
        top: 100px;
        right: 30px;
        z-index: 9999;
        min-width: 350px;
        border-radius: 0.5rem;
        animation: slideIn 0.3s ease-out;
        border-left: 5px solid #198754;
    }

    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    /* Animations */
    @keyframes slideIn {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .checkout-hero {
            padding-top: 5rem;
        }
        
        .checkout-hero h1 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .checkout-container {
            padding-top: 1rem;
        }
        
        .checkout-notification {
            top: 80px;
            right: 15px;
            left: 15px;
            min-width: auto;
        }
        
        .file-upload-label {
            padding: 1.5rem;
        }
    }
    #sidebar {
        display: none;
    }
    #main-content {
        margin-left: 0;
        width: 100%;
    }
    .table-striped tbody tr:last-child {
        border-top: 2px solid #dee2e6;
    }

    /* Amélioration des alertes */
    .checkout-notification {
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 2rem;
        animation: fadeInDown 0.5s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Style du bouton de confirmation */
    .btn-icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .checkout-btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .checkout-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);
        transform: translateX(-100%);
        transition: all 0.6s ease;
        z-index: -1;
    }

    .checkout-btn:hover::before {
        transform: translateX(100%);
    }

    .checkout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(40, 167, 69, 0.3);
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .file-upload-label.is-invalid {
        border-color: #dc3545 !important;
    }

    #file-name-display {
        display: none;
    }

    /* Styles complémentaires pour l'aperçu d'image */
    .upload-preview {
        width: 100%;
        height: 200px;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .img-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .overlay-text {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .upload-preview:hover .overlay-text {
        opacity: 1;
    }
    
    .file-uploaded {
        border-color: #26d07c;
    }
    
    .badge.bg-success {
        background-color: #26d07c !important;
    }

    /* Style pour le bouton flottant */
    .floating-action-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 999;
        display: none;
    }
    
    .btn-floating {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #26d07c;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 10px rgba(0,0,0,0.25);
        font-size: 24px;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher le nom du fichier d'ordonnance sélectionné
        const prescriptionInput = document.getElementById('prescription');
        const fileNameDisplay = document.getElementById('file-name-display');
        const checkoutForm = document.getElementById('checkout-form');
        const cartDataInput = document.getElementById('cart_data');
        const submitButton = document.getElementById('confirm-order-btn');
        const floatingButton = document.getElementById('floating-submit-btn');
        
        if (prescriptionInput && fileNameDisplay) {
            prescriptionInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    fileNameDisplay.style.display = 'block';
                    fileNameDisplay.textContent = fileName;
                    fileNameDisplay.className = 'mt-2 text-center text-success';
                    
                    // Ajouter un badge pour indiquer que le fichier est sélectionné
                    const fileContainer = prescriptionInput.closest('.file-upload-container');
                    if (fileContainer) {
                        fileContainer.classList.add('file-uploaded');
                        const badge = document.createElement('span');
                        badge.className = 'badge bg-success position-absolute top-0 end-0 mt-2 me-2';
                        badge.innerHTML = '<i class="fas fa-check"></i> Fichier sélectionné';
                        fileContainer.appendChild(badge);
                    }
                } else {
                    fileNameDisplay.style.display = 'none';
                    fileNameDisplay.textContent = '';
                    
                    // Retirer le badge si le fichier est désélectionné
                    const fileContainer = prescriptionInput.closest('.file-upload-container');
                    if (fileContainer) {
                        fileContainer.classList.remove('file-uploaded');
                        const badge = fileContainer.querySelector('.badge');
                        if (badge) badge.remove();
                    }
                }
            });
        }
        
        // S'assurer que les données du panier sont toujours à jour avant la soumission
        function updateCartData() {
            if (cartDataInput) {
                // Essayer d'abord de récupérer le panier du localStorage si disponible
                const localCart = localStorage.getItem('pharmalink_cart');
                if (localCart && localCart !== '[]' && localCart !== '{}') {
                    cartDataInput.value = localCart;
                    console.log('Panier récupéré du localStorage');
                    return true;
                }
                
                // Si le panier en session est vide ou invalide, essayer de le récupérer des cookies
                if (!cartDataInput.value || cartDataInput.value === '[]' || cartDataInput.value === '{}') {
                    // Fonction pour lire un cookie par son nom
                    function getCookie(name) {
                        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                        return match ? decodeURIComponent(match[2]) : null;
                    }
                    
                    const cartCookie = getCookie('cart_data');
                    if (cartCookie && cartCookie !== '[]' && cartCookie !== '{}') {
                        cartDataInput.value = cartCookie;
                        console.log('Panier récupéré des cookies');
                        return true;
                    }
                } else {
                    // Le panier est déjà présent dans le champ hidden
                    return true;
                }
                
                console.error('Panier vide ou invalide');
                return false;
            }
            return false;
        }

        if (checkoutForm) {
            // Mettre à jour les données du panier au chargement de la page
            updateCartData();
            
            checkoutForm.addEventListener('submit', function(e) {
                // Désactiver le bouton lors de la soumission pour éviter les doubles soumissions
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> TRAITEMENT EN COURS...';
                }
                
                // Mettre à jour les données du panier avant soumission
                if (!updateCartData()) {
                    e.preventDefault();
                    alert('Votre panier est vide. Veuillez ajouter des produits avant de confirmer votre commande.');
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="fas fa-lock me-2"></i> CONFIRMER LA COMMANDE';
                    }
                    return false;
                }

                // Vérifier que le fichier d'ordonnance est sélectionné
                if (prescriptionInput && prescriptionInput.files.length === 0) {
                    e.preventDefault();
                    alert('Veuillez télécharger une ordonnance médicale.');
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="fas fa-lock me-2"></i> CONFIRMER LA COMMANDE';
                    }
                    return false;
                }
                
                // Afficher une indication visuelle que la soumission est en cours
                document.body.classList.add('form-submitting');
                
                // Si tout est valide, soumettre le formulaire
                return true;
            });
        }
        
        // Gestion du bouton flottant pour soumettre le formulaire
        if (floatingButton && checkoutForm) {
                floatingButton.addEventListener('click', function() {
                // Déclencher la soumission du formulaire
                checkoutForm.dispatchEvent(new Event('submit'));
                });
            
            // Afficher le bouton flottant lors du défilement
            window.addEventListener('scroll', function() {
                const submitButtonRect = submitButton.getBoundingClientRect();
                // Si le bouton de soumission n'est pas visible à l'écran
                if (submitButtonRect.bottom < 0 || submitButtonRect.top > window.innerHeight) {
                    floatingButton.style.display = 'block';
                } else {
                    floatingButton.style.display = 'none';
            }
        });
        }
    });
</script>
@endsection
