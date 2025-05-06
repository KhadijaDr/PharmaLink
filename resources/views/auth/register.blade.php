<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - PharmaLink</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" sizes="32x32">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" sizes="96x96">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    
    <!-- ربط Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #1a936f;
            --primary-dark: #114B5F;
            --primary-light: #88d498;
            --secondary: #3a506b;
            --accent: #ffd166;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #114B5F 0%, #1a936f 100%);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 0;
        }

        .register-container {
            max-width: 550px;
            width: 100%;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            background-color: white;
            position: relative;
            z-index: 1;
            overflow: hidden;
            margin: 20px;
        }
        
        .register-container::before {
            content: "";
            position: absolute;
            width: 150%;
            height: 200px;
            background: linear-gradient(90deg, #88d498, #1a936f);
            transform: rotate(-8deg);
            top: -120px;
            left: -50px;
            z-index: -1;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }

        .register-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
            text-align: center;
            text-shadow: 0px 2px 4px rgba(0,0,0,0.1);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
            transform: translateY(-15px);
        }

        .logo-container img {
            height: 120px;
            width: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            transition: transform 0.5s ease;
            animation: float 4s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .logo-container img:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .btn-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
            border: none;
            padding: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(26, 147, 111, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-radius: 50px;
            color: white;
        }
        
        .btn-custom::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
            transform: translateX(-100%);
        }

        .btn-custom:hover {
            background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(26, 147, 111, 0.4);
            color: white;
        }
        
        .btn-custom:hover::after {
            animation: shine 1.5s infinite;
        }
        
        @keyframes shine {
            100% { transform: translateX(100%); }
        }

        .error-list {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            border-left: 4px solid #ef476f;
        }

        .form-control {
            padding: 14px 16px;
            border-radius: 50px;
            font-size: 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
            background-color: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(26, 147, 111, 0.2);
            background-color: white;
        }

        .form-label {
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 8px;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .register-footer {
            text-align: center;
            margin-top: 25px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .register-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .bg-shapes div {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            background: linear-gradient(45deg, var(--primary-light), var(--primary-color));
        }
        
        .shape-1 {
            width: 200px;
            height: 200px;
            top: -100px;
            right: -50px;
            animation: moving 8s linear infinite;
        }
        
        .shape-2 {
            width: 150px;
            height: 150px;
            bottom: -50px;
            left: -50px;
            animation: moving 10s linear infinite;
        }
        
        @keyframes moving {
            0% { transform: rotate(0deg) translateY(0px); }
            50% { transform: rotate(180deg) translateY(20px); }
            100% { transform: rotate(360deg) translateY(0px); }
        }
        
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }
        
        .form-group i.prefix {
            position: absolute;
            top: 50%;
            left: 16px; 
            transform: translateY(-50%);
            color: var(--primary-color);
            z-index: 10;
        }
        
        .form-group input {
            padding-left: 45px;
        }

        .btn-eye {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--primary-color);
        }
        
        .btn-eye:hover {
            color: var(--primary-dark);
        }
        
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        
        .login-link a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="bg-shapes">
        <div class="shape-1"></div>
        <div class="shape-2"></div>
    </div>

    <div class="register-container">
        <div class="logo-container">
            <img src="{{ asset('logo.png') }}" alt="PharmaLink Logo">
        </div>
        <h4 class="register-title"> Créez votre compte sur PharmaLink</h4>
        

        @if ($errors->any())
        <div class="error-list">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i> Nom
                </label>
                <div class="position-relative">
                  
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Adresse e-mail
                </label>
                <div class="position-relative">
                    
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                </div>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i> Mot de passe
                </label>
                <div class="position-relative">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                    <button type="button" class="btn-eye" tabindex="-1" onclick="togglePassword('password')" aria-label="Afficher le mot de passe">
                        <i id="eyeIcon1" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">
                    <i class="fas fa-lock"></i> Confirmer le mot de passe
                </label>
                <div class="position-relative">
                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required autocomplete="new-password">
                    <button type="button" class="btn-eye" tabindex="-1" onclick="togglePassword('password-confirm')" aria-label="Afficher le mot de passe">
                        <i id="eyeIcon2" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-custom">
                    <i class="fas fa-user-plus me-2"></i> S'inscrire
                </button>
            </div>
        </form>

        <div class="login-link">
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt me-1"></i> Déjà inscrit? Connectez-vous
            </a>
        </div>

        <div class="register-footer mt-4">
            <p>PharmaLink - Votre pharmacie en ligne de confiance</p>
        </div>
    </div>

    <!-- ربط مكتبات Bootstrap و JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
    function togglePassword(id) {
        var pwd = document.getElementById(id);
        var icon = document.getElementById(id === 'password' ? 'eyeIcon1' : 'eyeIcon2');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            pwd.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
</body>

</html>
