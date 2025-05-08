@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 border-0 rounded-4 animated-card">
            <h1 class="text-center text-success mb-4">
                <i class="fas fa-pills"></i> Ajouter un nouveau médicament
            </h1>

            <form action="{{ route('medications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-primary">Nom du médicament</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-capsules"></i></span>
                            <input type="text" class="form-control custom-input" name="name" id="name" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="expiry_date" class="form-label fw-bold text-primary">Date d'expiration</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" class="form-control custom-input" name="expiry_date" id="expiry_date" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="supplier" class="form-label fw-bold text-primary">Fournisseur</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-truck"></i></span>
                            <input type="text" class="form-control custom-input" name="supplier" id="supplier" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="quantity" class="form-label fw-bold text-primary">Quantité</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-box"></i></span>
                            <input type="number" class="form-control custom-input" name="quantity" id="quantity" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold text-primary">Prix (Dirham)</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-success text-white"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" class="form-control custom-input" name="price" id="price" step="0.01" min="0" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-bold text-primary">Description</label>
                        <textarea class="form-control custom-input" name="description" id="description" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
        <label for="image" class="form-label fw-bold text-primary"> Image du médicament</label>
        <input type="file" class="form-control custom-input" name="image" id="image" accept="image/*">
        
        <div class="mt-3">
            <label class="form-label fw-bold text-primary">Ou choisissez une image par défaut:</label>
            <div class="row g-2 mt-1">
                <div class="col-md-2 col-4">
                    <div class="default-image-option">
                        <input type="radio" name="default_image" id="img_paracetamol" value="paracetamol.jpg" class="d-none">
                        <label for="img_paracetamol" class="w-100">
                            <img src="{{ asset('images/paracetamol.jpg') }}" alt="Paracetamol" class="img-thumbnail default-img">
                        </label>
                    </div>
                </div>
                <div class="col-md-2 col-4">
                    <div class="default-image-option">
                        <input type="radio" name="default_image" id="img_veinup" value="VeinUp.png" class="d-none">
                        <label for="img_veinup" class="w-100">
                            <img src="{{ asset('images/VeinUp.png') }}" alt="VeinUp" class="img-thumbnail default-img">
                        </label>
                    </div>
                </div>
                <div class="col-md-2 col-4">
                    <div class="default-image-option">
                        <input type="radio" name="default_image" id="img_g" value="g.jpg" class="d-none">
                        <label for="img_g" class="w-100">
                            <img src="{{ asset('images/g.jpg') }}" alt="G" class="img-thumbnail default-img">
                        </label>
                    </div>
                </div>
                <div class="col-md-2 col-4">
                    <div class="default-image-option">
                        <input type="radio" name="default_image" id="img_unnamed" value="unnamed.jpg" class="d-none">
                        <label for="img_unnamed" class="w-100">
                            <img src="{{ asset('images/unnamed.jpg') }}" alt="Unnamed" class="img-thumbnail default-img">
                        </label>
                    </div>
                </div>
                <div class="col-md-2 col-4">
                    <div class="default-image-option">
                        <input type="radio" name="default_image" id="img_pharmacie" value="pharmacie.jpg" class="d-none">
                        <label for="img_pharmacie" class="w-100">
                            <img src="{{ asset('images/pharmacie.jpg') }}" alt="Pharmacie" class="img-thumbnail default-img">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success w-100 py-2 shadow-sm custom-btn">
                        <i class="fas fa-check-circle"></i> Enregistrer
                    </button>
                    <!-- <a href="{{ route('medications.index') }}" class="btn btn-outline-success w-100 mt-2 py-2 shadow-sm custom-btn">
                        <i class="fas fa-arrow-left"></i> الرجوع إلى لائحة الأدوية
                    </a> -->
                </div>
            </form>
        </div>
    </div>

    <style>
       
        .custom-input {
            transition: all 0.4s ease-in-out;
            border: 2px solid #dee2e6;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            position: relative;
        }

        .custom-input:focus {
            border-color: #198754 !important;
            box-shadow: 0 0 12px rgba(25, 135, 84, 0.6);
            background-color: #ffffff;
            transform: scale(1.02);
        }

       
        .custom-btn {
            transition: all 0.3s ease-in-out;
            border-radius: 8px;
            font-size: 18px;
        }

        .custom-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.4);
        }

       
        .animated-card {
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 0.6s ease-in-out forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Styles pour le sélecteur d'images par défaut */
        .default-image-option label {
            cursor: pointer;
            border: 3px solid transparent;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: block;
        }
        
        .default-image-option label:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .default-image-option input:checked + label {
            border-color: #198754;
            box-shadow: 0 0 0 2px #198754, 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .default-img {
            width: 100%;
            height: 70px;
            object-fit: cover;
            transition: all 0.3s ease;
        }
        
        .selected-img {
            border-color: #198754 !important;
            box-shadow: 0 0 0 2px #198754, 0 5px 15px rgba(0,0,0,0.2) !important;
        }
    </style>
    
    <script>
        // Script pour gérer la sélection d'images par défaut
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');
            const defaultImgOptions = document.querySelectorAll('input[name="default_image"]');
            
            // Déselectionner l'image par défaut quand une image est téléchargée
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    defaultImgOptions.forEach(option => option.checked = false);
                }
            });
            
            // Vider l'input file quand une image par défaut est sélectionnée
            defaultImgOptions.forEach(option => {
                option.addEventListener('change', function() {
                    if (this.checked) {
                        fileInput.value = '';
                    }
                });
            });
            
            // Ajouter une classe active à l'image sélectionnée
            const defaultImgLabels = document.querySelectorAll('.default-image-option label');
            defaultImgLabels.forEach(label => {
                label.addEventListener('click', function() {
                    defaultImgLabels.forEach(l => l.classList.remove('selected-img'));
                    this.classList.add('selected-img');
                });
            });
        });
    </script>
@endsection
