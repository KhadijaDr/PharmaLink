<!-- resources/views/medications/purchase_show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="row g-0">
                <div class="col-md-5">
                    @if($medication->image)
                        <img src="{{ asset('storage/' . $medication->image) }}" alt="{{ $medication->name }}" class="img-fluid rounded-start h-100 object-fit-cover">
                    @else
                        <img src="{{ asset('images/' . (rand(0, 4) == 0 ? 'paracetamol.jpg' : (rand(0, 3) == 0 ? 'VeinUp.png' : (rand(0, 2) == 0 ? 'g.jpg' : (rand(0, 1) == 0 ? 'unnamed.jpg' : 'pharmacie.jpg'))))) }}" alt="{{ $medication->name }}" class="img-fluid rounded-start h-100 object-fit-cover">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="card-body p-4">
                        <h1 class="card-title fw-bold text-primary mb-3">{{ $medication->name }}</h1>
                        <p class="card-text fs-5 mb-4">{{ $medication->description }}</p>

                        <div class="alert alert-info mb-4">
                            <span class="badge bg-primary fs-5 px-3 py-2 mb-2 d-inline-block">Prix: {{ number_format($medication->price, 2) }} DH</span>
                            <p class="mb-0"><i class="fas fa-boxes me-2"></i>Stock disponible: <span id="stock-display" data-stock="{{ $medication->quantity }}">{{ $medication->quantity }}</span></p>
                            <div class="mt-3 fw-bold text-dark">
                                <i class="fas fa-calculator me-2"></i>Prix total: <span id="total-price">{{ number_format($medication->price, 2) }}</span> DH
                            </div>
                        </div>
                        
                        <form action="{{ route('medications.purchase.store', $medication->id) }}" method="POST" class="mt-4" id="purchase-form">
        @csrf
                            <input type="hidden" name="medication_id" value="{{ $medication->id }}">
                            <div class="form-group mb-3">
                                <label for="quantity" class="form-label fw-bold">Quantité</label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" id="decrement-qty">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" class="form-control form-control-lg text-center" min="1" max="{{ $medication->quantity }}" value="1" required>
                                    <button type="button" class="btn btn-outline-secondary" id="increment-qty">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted mt-2">La quantité sera déduite du stock disponible.</small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="customer_name" class="form-label fw-bold">Votre nom complet</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="customer_phone" class="form-label fw-bold">Numéro de téléphone</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="form-control" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="customer_address" class="form-label fw-bold">Adresse de livraison</label>
                                <textarea name="customer_address" id="customer_address" class="form-control" rows="3" required></textarea>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="prescription" class="form-label fw-bold">Ordonnance (si nécessaire)</label>
                                <input type="file" name="prescription" id="prescription" class="form-control">
                                <small class="form-text text-muted">Formats acceptés: jpg, png, pdf (max 2Mo)</small>
        </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                                    <i class="fas fa-shopping-cart me-2"></i>Acheter
                                </button>
                                <a href="{{ route('medications.purchase') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Retour
                                </a>
                            </div>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const incrementBtn = document.getElementById('increment-qty');
        const decrementBtn = document.getElementById('decrement-qty');
        const stockDisplay = document.getElementById('stock-display');
        const submitBtn = document.getElementById('submit-btn');
        const form = document.getElementById('purchase-form');
        
        const maxStock = parseInt(stockDisplay.dataset.stock);
        
        // Fonction pour vérifier la disponibilité du stock
        function checkStock() {
            const qty = parseInt(quantityInput.value);
            if (qty > maxStock) {
                quantityInput.value = maxStock;
                showAlert('La quantité demandée dépasse le stock disponible.');
            }
            
            // Désactiver le bouton si la quantité est 0 ou inférieure
            submitBtn.disabled = qty <= 0 || qty > maxStock;
            
            // Mettre à jour l'affichage du prix total
            updateTotalPrice();
        }
        
        // Fonction pour afficher une alerte
        function showAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-warning alert-dismissible fade show mt-3';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            const existingAlert = form.querySelector('.alert');
            if (existingAlert) {
                existingAlert.remove();
            }
            
            form.insertBefore(alertDiv, form.firstChild);
            
            // Disparaître après 3 secondes
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 3000);
        }
        
        // Fonction pour mettre à jour le prix total
        function updateTotalPrice() {
            const qty = parseInt(quantityInput.value);
            const price = {{ $medication->price }};
            const total = qty * price;
            
            // Si un élément d'affichage du prix total existe, le mettre à jour
            const totalPriceElement = document.getElementById('total-price');
            if (totalPriceElement) {
                totalPriceElement.textContent = total.toFixed(2) + ' DH';
            }
        }
        
        // Gestionnaires d'événements pour les boutons +/-
        incrementBtn.addEventListener('click', function() {
            if (parseInt(quantityInput.value) < maxStock) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                checkStock();
            }
        });
        
        decrementBtn.addEventListener('click', function() {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                checkStock();
            }
        });
        
        // Vérifier la quantité à chaque changement manuel
        quantityInput.addEventListener('change', checkStock);
        
        // Validation du formulaire avant soumission
        form.addEventListener('submit', function(e) {
            const qty = parseInt(quantityInput.value);
            if (qty <= 0 || qty > maxStock) {
                e.preventDefault();
                showAlert('Veuillez sélectionner une quantité valide.');
            }
        });
        
        // Initialisation
        checkStock();
    });
</script>