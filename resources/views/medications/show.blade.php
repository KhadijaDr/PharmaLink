<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du médicament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($medication->image)
                        <img src="{{ asset('storage/' . $medication->image) }}" alt="{{ $medication->name }}" class="img-fluid rounded-start h-100 object-fit-cover">
                    @else
                        <img src="{{ asset('images/' . (rand(0, 4) == 0 ? 'paracetamol.jpg' : (rand(0, 3) == 0 ? 'VeinUp.png' : (rand(0, 2) == 0 ? 'g.jpg' : (rand(0, 1) == 0 ? 'unnamed.jpg' : 'pharmacie.jpg'))))) }}" alt="{{ $medication->name }}" class="img-fluid rounded-start h-100 object-fit-cover">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body p-4">
                        <h1 class="card-title fw-bold text-primary mb-3">{{ $medication->name }}</h1>
                        <p class="card-text fs-5 mb-4">{{ $medication->description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary fs-5 px-3 py-2">{{ $medication->price }} DH</span>
                            <span class="text-muted"><i class="fas fa-boxes me-2"></i>Stock: {{ $medication->quantity }}</span>
                        </div>
                        
                        <p class="card-text"><i class="far fa-calendar-alt me-2"></i>Date d'expiration: {{ \Carbon\Carbon::parse($medication->expiry_date)->format('d/m/Y') }}</p>
                        
                        <a href="{{ route('medications.index') }}" class="btn btn-outline-primary mt-3">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>