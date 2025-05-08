<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PharmaLink</title>
    
    <!-- Favicon - Tailles plus grandes -->
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" sizes="48x48">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" sizes="96x96">
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}" sizes="180x180">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    
    <!-- تضمين ملفات CSS عبر Vite -->
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')

    <!-- تضمين Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- تضمين jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Core Variables */
        :root {
    --primary-color: #1a936f;
    --primary-light: #88d498;
    --primary-dark: #114B5F;
    --secondary-color: #3a506b;
    --secondary-light: #5bc0eb;
    --secondary-dark: #1C2541;
    --accent-color: #ffd166;
    --accent-dark: #f0b429;
    --danger-color: #ef476f;
    --success-color: #06d6a0;
    --warning-color: #ffc43d;
    --info-color: #118ab2;
    --text-light: #ffffff;
    --text-dark: #2b2d42;
    --text-muted: rgba(255, 255, 255, 0.85);
    --bg-light: #f8f9fa;
    --bg-light-hover: #e9ecef;
    --border-radius-sm: 4px;
    --border-radius: 8px;
    --border-radius-lg: 12px;
    --border-radius-xl: 20px;
    --box-shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
    --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    --box-shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12), 0 4px 8px rgba(0, 0, 0, 0.08);
    --box-shadow-hover: 0 10px 28px rgba(0, 0, 0, 0.2);
    --transition-fast: 0.2s;
    --transition-normal: 0.3s;
    --transition-slow: 0.5s;
}

html, body {
    height: 100%;
    margin: 0;
    font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    scroll-behavior: smooth;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: linear-gradient(135deg, var(--bg-light) 0%, #e9f7f2 100%);
    background-attachment: fixed;
    overflow-x: hidden;
    position: relative;
    
}
.navbar-brand {
    display: flex;
    align-items: center;
    font-weight: 600;
}

.navbar-brand img {
    height: 69px;
    width: auto;
    margin-right: 15px;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    transition: transform 0.3s ease;
}

.navbar-brand:hover img {
    transform: scale(1.05);
}
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="2" fill="%231a936f" opacity="0.05"/></svg>');
    pointer-events: none;
    z-index: -1;
}

/* Navbar Styling - Enhanced 3D Effect */
.navbar-custom {
    background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
    transition: all var(--transition-normal) ease;
    box-shadow: var(--box-shadow);
    padding-top: 18px;
    padding-bottom: 18px;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 999;
    overflow: hidden;
}

.navbar-custom::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.1) 100%);
    z-index: 0;
    animation: shineEffect 8s infinite linear;
}

@keyframes shineEffect {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.navbar-custom .nav-link {
    color: var(--text-light) !important;
    font-weight: 600;
    transition: all var(--transition-normal);
    padding: 8px 16px;
    border-radius: var(--border-radius);
    margin: 0 5px;
    position: relative;
    z-index: 1;
    overflow: hidden;
}

.navbar-custom .nav-link::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.2);
    transform: skewX(-15deg);
    transition: all var(--transition-normal);
    z-index: -1;
}

.navbar-custom .nav-link:hover::before {
    width: 100%;
}

.navbar-custom .nav-link:hover {
    transform: translateY(-3px);
    color: var(--accent-color) !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.navbar-custom .navbar-brand {
    font-weight: 700;
    color: var(--text-light) !important;
    font-size: 1.6rem;
    letter-spacing: 0.5px;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.navbar-custom .navbar-brand:hover {
    transform: scale(1.05);
    transition: transform var(--transition-normal);
}

.navbar-toggler {
    background-color: rgba(255, 255, 255, 0.2);
    border: none;
    padding: 10px 15px;
    border-radius: var(--border-radius);
    transition: all var(--transition-normal);
    position: relative;
    z-index: 1;
}

.navbar-toggler:hover {
    background-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

/* Sidebar - Modern Glassmorphic Design */
#sidebar {
    width: 280px;
    min-height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-color));
    color: var(--text-light);
    transition: all var(--transition-normal) cubic-bezier(0.68, -0.55, 0.27, 1.55);
    box-shadow: var(--box-shadow-lg);
    padding-top: 90px;
    padding-left: 1rem;
    padding-right: 1rem;
    padding-bottom: 1rem;
    display: flex;
    flex-direction: column;
    z-index: 100;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    overflow: hidden;
    margin-top: 0;
}

#sidebar::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%);
    top: -250px;
    right: -250px;
    opacity: 0.1;
    z-index: -1;
}

#sidebar::after {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
    bottom: -150px;
    left: -150px;
    opacity: 0.1;
    z-index: -1;
}

#sidebar h4 {
    text-align: center;
    padding-bottom: 18px;
    margin-bottom: 25px;
    margin-top: 10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-light);
    position: relative;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

#sidebar h4::after {
    content: "";
    position: absolute;
    bottom: -1px;
    left: 50%;
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
    transform: translateX(-50%);
    border-radius: var(--border-radius);
}

#sidebar .nav-link {
    padding: 16px 20px;
    margin: 8px 15px;
    border-radius: var(--border-radius-lg);
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all var(--transition-normal);
    color: var(--text-muted);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

#sidebar .nav-link i {
    margin-right: 14px;
    font-size: 1.3rem;
    transition: all var(--transition-normal);
}

#sidebar .nav-link::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 5px;
    height: 100%;
    background-color: var(--accent-color);
    transform: translateX(5px);
    transition: all var(--transition-normal);
    opacity: 0;
}

#sidebar .nav-link:hover {
    background: linear-gradient(90deg, rgba(26, 147, 111, 0.2), rgba(26, 147, 111, 0.4));
    color: var(--text-light) !important;
    transform: translateX(8px);
    box-shadow: var(--box-shadow);
    padding-left: 25px;
}

#sidebar .nav-link:hover::before {
    transform: translateX(0);
    opacity: 1;
}

#sidebar .nav-link:hover i {
    transform: translateX(-3px) scale(1.2);
    color: var(--accent-color);
}

#sidebar .nav-link.active {
    background: linear-gradient(90deg, var(--primary-dark), var(--primary-color));
    color: var(--text-light);
    box-shadow: var(--box-shadow);
    padding-left: 25px;
}

#main-content {
    margin-left: 280px;
    transition: all var(--transition-normal) cubic-bezier(0.68, -0.55, 0.27, 1.55);
    padding: 120px 30px 30px;
    flex: 1;
    position: relative;
}

.sidebar-hidden #sidebar {
    width: 0;
    transform: translateX(-100%);
}

.sidebar-hidden #main-content {
    margin-left: 0;
    padding-bottom: 80px;
}

.toggle-sidebar-btn {
    position: fixed;
    top: 80px;
    left: 290px;
    background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
    color: white;
    border: none;
    padding: 10px 14px;
    border-radius: 50%;
    cursor: pointer;
    transition: all var(--transition-normal);
    z-index: 101;
    box-shadow: var(--box-shadow);
    display: flex;
    align-items: center;
    justify-content: center;
}

.toggle-sidebar-btn:hover {
    background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
    transform: rotate(180deg);
    box-shadow: var(--box-shadow-hover);
}

.n {
    margin-top: 0;
    margin-bottom: 15px;
    padding-top: 0;
    visibility: visible !important;
    display: block !important;
}

.n h4 {
    color: white;
    font-weight: bold;
    font-size: 1.3rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

#logout-button-container {
    position: absolute;
    bottom: 30px;
    left: 0;
    width: 100%;
    padding: 15px 20px;
}

#logout-button-container .btn {
    border-radius: var(--border-radius-lg);
    padding: 14px;
    font-weight: 600;
    transition: all var(--transition-normal);
    box-shadow: var(--box-shadow);
    background: linear-gradient(45deg, var(--danger-color), #ff758f);
    border: none;
    position: relative;
    overflow: hidden;
    z-index: 1;
    letter-spacing: 0.5px;
}

#logout-button-container .btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all var(--transition-slow);
    z-index: -1;
}

#logout-button-container .btn:hover::before {
    left: 100%;
}

#logout-button-container .btn:hover {
    transform: translateY(-4px);
    box-shadow: var(--box-shadow-hover);
}

/* Card Styling with Modern Design */
.card {
    border: none;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--box-shadow);
    transition: all var(--transition-normal);
    overflow: hidden;
    background: rgba(255, 255, 255, 0.95);
    margin-bottom: 25px;
    position: relative;
    z-index: 1;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: var(--box-shadow-hover);
}

.card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    z-index: 1;
}

.card-header {
    background: linear-gradient(135deg, rgba(26, 147, 111, 0.1), rgba(26, 147, 111, 0.05));
    border-bottom: 1px solid rgba(26, 147, 111, 0.1);
    padding: 20px 25px;
}

.card-title {
    color: var(--primary-dark);
    font-weight: 700;
    margin-bottom: 0;
    position: relative;
    display: inline-block;
}

.card-title::after {
    content: "";
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 3px;
    background: var(--primary-color);
    border-radius: var(--border-radius);
}

.card-body {
    padding: 25px;
}

/* Alert Styling with Modern Design */
.alert-container {
    max-width: 700px;
    width: 100%;
    margin-top: 25px;
}

.alert {
    padding: 18px;
    font-size: 16px;
    border: none;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--box-shadow);
    position: relative;
    overflow: hidden;
    animation: slideInDown 0.5s forwards;
}

@keyframes slideInDown {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.alert-success {
    background: linear-gradient(135deg, rgba(6, 214, 160, 0.1), rgba(6, 214, 160, 0.05));
    border-left: 4px solid var(--success-color);
}

.alert-success::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" stroke="%2306d6a0" stroke-width="2" fill="none" stroke-dasharray="10" opacity="0.1"/></svg>');
    pointer-events: none;
}

.alert-danger {
    background: linear-gradient(135deg, rgba(239, 71, 111, 0.1), rgba(239, 71, 111, 0.05));
    border-left: 4px solid var(--danger-color);
}

.alert-danger::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M20,20 L80,80 M80,20 L20,80" stroke="%23ef476f" stroke-width="2" opacity="0.1"/></svg>');
    pointer-events: none;
}

/* Button Styling with Modern Design */
.btn {
    border-radius: var(--border-radius);
    padding: 10px 16px;
    font-weight: 600;
    transition: all var(--transition-normal);
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}

.btn::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%, -50%);
    transform-origin: 50% 50%;
}

.btn:hover::after {
    animation: ripple 1s;
}

@keyframes ripple {
    0% {
        transform: scale(0, 0);
        opacity: 0.5;
    }
    100% {
        transform: scale(30, 30);
        opacity: 0;
    }
}

.btn-primary {
    background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
    border: none;
    box-shadow: 0 4px 15px rgba(26, 147, 111, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(26, 147, 111, 0.4);
}

.btn-secondary {
    background: linear-gradient(45deg, var(--secondary-dark), var(--secondary-color));
    border: none;
    box-shadow: 0 4px 15px rgba(58, 80, 107, 0.3);
}

.btn-secondary:hover {
    background: linear-gradient(45deg, var(--secondary-color), var(--secondary-dark));
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(58, 80, 107, 0.4);
}

.btn-danger {
    background: linear-gradient(45deg, var(--danger-color), #ff758f);
    border: none;
    box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
}

.btn-danger:hover {
    background: linear-gradient(45deg, #ff758f, var(--danger-color));
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(239, 71, 111, 0.4);
}

.btn-success {
    background: linear-gradient(45deg, var(--success-color), #8eedc7);
    border: none;
    box-shadow: 0 4px 15px rgba(6, 214, 160, 0.3);
}

.btn-success:hover {
    background: linear-gradient(45deg, #8eedc7, var(--success-color));
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4);
}

/* Table Styling with Modern Design */
.table {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    background: white;
}

.table thead th {
    background: linear-gradient(45deg, var(--primary-dark), var(--primary-color));
    color: white;
    font-weight: 600;
    padding: 16px;
    border: none;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
}

.table tbody tr {
    transition: all var(--transition-normal);
}

.table tbody tr:nth-child(odd) {
    background-color: rgba(26, 147, 111, 0.03);
}

.table tbody tr:hover {
    background-color: rgba(26, 147, 111, 0.07);
    transform: scale(1.01);
}

.table tbody td {
    padding: 14px;
    vertical-align: middle;
    border-color: rgba(0, 0, 0, 0.05);
}

/* Form Styling with Modern Design */
.form-control {
    border-radius: var(--border-radius);
    padding: 12px 16px;
    font-size: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
    transition: all var(--transition-normal);
    box-shadow: var(--box-shadow-sm);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(26, 147, 111, 0.2);
}

.form-label {
    font-weight: 600;
    color: var(--secondary-dark);
    margin-bottom: 8px;
}

.form-select {
    border-radius: var(--border-radius);
    padding: 12px 16px;
    font-size: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
    transition: all var(--transition-normal);
    box-shadow: var(--box-shadow-sm);
}

.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(26, 147, 111, 0.2);
}

/* Footer Styling with Modern Design */
.custom-footer {
    background: linear-gradient(135deg, var(--secondary-dark), var(--primary-dark));
    color: var(--text-light);
    padding: 40px 0 30px;
    width: 100%;
    position: relative;
    z-index: 10;
}

.custom-footer::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color), var(--primary-color));
    background-size: 200% 100%;
    animation: gradient-animation 6s infinite;
}

@keyframes gradient-animation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.custom-footer::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M0,50 Q25,40 50,50 T100,50" stroke="white" fill="none" stroke-width="0.5" opacity="0.05"/></svg>');
    pointer-events: none;
}

.custom-footer a {
    text-decoration: none;
    transition: all var(--transition-normal);
    color: var(--text-light);
    font-weight: 500;
    padding: 6px 12px;
    border-radius: var(--border-radius);
    position: relative;
}

.custom-footer a::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 10%;
    width: 80%;
    height: 2px;
    background: var(--accent-color);
    transform: scaleX(0);
    transition: transform var(--transition-normal);
    transform-origin: right;
}

.custom-footer a:hover {
    color: var(--accent-color);
}

.custom-footer a:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

/* Social Links with Modern Design */
.social-links {
    margin-top: 20px;
}

.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 12px;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    transition: all var(--transition-normal);
    box-shadow: var(--box-shadow);
    position: relative;
    overflow: hidden;
}

.social-links a::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
    opacity: 0;
    transition: opacity var(--transition-normal);
}

.social-links a:hover {
    transform: translateY(-5px) rotate(360deg);
    box-shadow: var(--box-shadow-hover);
}

.social-links a:hover::before {
    opacity: 1;
}

.social-links a i {
    font-size: 20px;
    color: white;
    position: relative;
    z-index: 1;
}

/* Responsive Design Enhancements */
@media (max-width: 992px) {
    #sidebar {
        width: 240px;
    }
    
    #main-content {
        margin-left: 240px;
        padding-top: 80px;
    }
    
    .toggle-sidebar-btn {
        left: 250px;
        top: 80px;
    }
    
    .card-body {
        padding: 20px;
    }
}

@media (max-width: 768px) {
    #sidebar {
        width: 0;
        transform: translateX(-100%);
    }
    
    #main-content {
        margin-left: 0;
        padding-top: 80px;
    }
    
    .toggle-sidebar-btn {
        left: 15px;
        top: 80px;
    }
    
    .n {
        margin-top: 45px;
    }
    
    .navbar-custom {
        padding: 10px 0;
    }
    
    .card {
        margin-bottom: 20px;
    }
    
    .card-header {
        padding: 15px 20px;
    }
    
    .card-body {
        padding: 15px;
    }
    
    .custom-footer {
        padding: 30px 0 20px;
    }
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 1s forwards;
}

.slide-up {
    animation: slideUp 0.8s forwards;
}

.slide-right {
    animation: slideRight 0.8s forwards;
}

.scale-in {
    animation: scaleIn 0.5s forwards;
}

.bounce-in {
    animation: bounceIn 0.6s forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes slideRight {
    from { transform: translateX(-50px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes scaleIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

@keyframes bounceIn {
    0% { transform: scale(0.3); opacity: 0; }
    50% { transform: scale(1.05); opacity: 0.8; }
    70% { transform: scale(0.9); opacity: 0.9; }
    100% { transform: scale(1); opacity: 1; }
}

/* Badge Styling with Modern Design */
.badge {
    font-weight: 600;
    padding: 6px 12px;
    border-radius: var(--border-radius);
    letter-spacing: 0.5px;
    box-shadow: var(--box-shadow-sm);
}

.badge-primary {
    background: linear-gradient(45deg, var(--primary-color), var(--primary-light));
    color: white;
}

.badge-secondary {
    background: linear-gradient(45deg, var(--secondary-color), var(--secondary-light));
    color: white;
}

.badge-success {
    background: linear-gradient(45deg, var(--success-color), #8eedc7);
    color: var(--secondary-dark);
}
.current-time {
    background: rgba(255, 255, 255, 0.2);
    padding: 2px 8px;
    border-radius: 10px;
    font-family: monospace;
}

.badge-danger {
    background: linear-gradient(45deg, var(--danger-color), #ff758f);
    color: white;
}

.badge-warning {
    background: linear-gradient(45deg, var(--warning-color), #ffdd99);
    color: var(--secondary-dark);
}

.badge-info {
    background: linear-gradient(45deg, var(--info-color), var(--secondary-light));
    color: white;
}

/* Pagination Styling with Modern Design */
.pagination {
    box-shadow: var(--box-shadow);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.alert-notifications {
        position: fixed;
        top: 70px; /* يتناسب مع ارتفاع شريط التنقل */
        right: 20px;
        z-index: 1050; /* أعلى من شريط التنقل */
        width: auto;
        max-width: 500px;
        animation: slideIn 0.3s ease-out;
    }
    
    .alert-notifications .alert {
        opacity: 1;
        background-color: white;
        border: 1px solid #dee2e6;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.25rem;
    }
    
    .alert-notifications .alert-success {
        border-left: 4px solid #28a745;
    }
    
    .alert-notifications .alert-danger {
        border-left: 4px solid #dc3545;
    }
    
    /* تأثير الظهور */
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* التأكد من أن الإشعارات لا تظهر في القائمة الجانبية */
    #sidebar .alert-notifications {
        display: none !important;
    }

    .footer-links .footer-link {
        color: #fff;
        font-weight: 500;
        text-decoration: none;
        padding: 0 8px;
        transition: color 0.2s;
        font-size: 1rem;
    }
    .footer-links .footer-link:hover {
        color: var(--accent);
        text-decoration: underline;
    }
    .footer-links .footer-sep {
        color: #bbb;
        font-size: 1.1rem;
        padding: 0 2px;
        user-select: none;
    }

    /* Ajouter une marge pour les titres des sections */
    .card-header h3, .card-header h4, h2.section-title, h3.section-title {
        margin-top: 20px;
    }

    /* Ajouter des marges pour toutes les cartes و sections */
    .card, .section-content, .content-section {
        margin-top: 30px;
    }

    /* Style pour le contenu principal */
    #main-content {
        padding-top: 90px !important;
    }

    .n h4.sidebar-title {
        color: white;
        font-weight: bold;
        font-size: 1.4rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        background-color: rgba(26, 147, 111, 0.3);
        padding: 10px 0;
        border-radius: var(--border-radius);
        margin-bottom: 15px;
    }

    .k h5 {
        font-weight: bold;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        letter-spacing: 0.5px;
    }

    /* Style pour les pages d'inscription et connexion */
    body.auth-page {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);/*  */
        border-radius: var(--border-radius-lg);
        box-shadow: var(--box-shadow-lg);
        border: none;
        overflow: hidden;
    }

    .auth-card .card-header {
        background: var(--primary-dark); 
        color: white;
        border-bottom: none;
        padding: 1.5rem;
    }

    </style>
</head>
<body class="bg-light">

    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/pharmacy') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 70px; margin-right: 10px;">
            <div class="d-flex flex-column">
                <span class="fs-4 fw-bold">PharmaLink</span>
                <span class="current-time ms-2" style="font-size: 0.8rem;"></span>
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse {{ request()->is('pharmacy') ? 'justify-content-center' : 'justify-content-end' }}" id="navbarNav">
            <ul class="navbar-nav align-items-center {{ request()->is('pharmacy') ? 'gap-2' : '' }}">
                @if(request()->is('pharmacy'))
                    <li class="nav-item d-flex align-items-center mx-2">
                        <a class="nav-link d-flex align-items-center {{ request()->is('pharmacy') ? 'active' : '' }}" href="{{ url('/pharmacy') }}">
                            <i class="fas fa-home me-1"></i> <span>Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center mx-2">
                        <a class="nav-link d-flex align-items-center" href="{{ url('/pharmacy#articles-section') }}">
                            <i class="fas fa-newspaper me-1"></i> <span>Articles</span>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center mx-2">
                        <a class="nav-link d-flex align-items-center" href="{{ url('/pharmacy#contact-section') }}">
                            <i class="fas fa-phone-alt me-1"></i> <span>Contactez-nous</span>
                        </a>
                    </li>
                    @if(auth()->check())
                    <li class="nav-item d-flex align-items-center mx-2">
                        <a class="nav-link d-flex align-items-center" href="{{ route('medications.index') }}">
                            <i class="fas fa-pills me-1"></i> <span>Gestion des médicaments</span>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center mx-2">
                        <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-1"></i> <span>Déconnexion</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @else
                    <li class="nav-item d-flex align-items-center mx-2">
                        <a class="nav-link d-flex align-items-center" href="{{ url('/purchase') }}">
                            <i class="fas fa-shopping-cart me-1"></i> <span>Achetez maintenant</span>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center mx-2">
                        <a class="nav-link d-flex align-items-center" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i> <span>Inscrivez-vous</span>
                        </a>
                    </li>
                    @endif
                @elseif(request()->routeIs('medications.*'))
                    <li class="nav-item d-flex align-items-center mx-3">
                        <a class="nav-link d-flex align-items-center {{ request()->routeIs('medications.index') ? 'active' : '' }}" href="{{ route('medications.index') }}">
                            <i class="fas fa-pills me-1"></i> <span>Gestion des médicaments</span>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center mx-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-1"></i> <span>Déconnexion</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <!-- Autres pages : afficher Gestion des médicaments et Déconnexion -->
                    <li class="nav-item d-flex align-items-center mx-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('medications.index') }}">
                            <i class="fas fa-pills me-1"></i> <span>Gestion des médicaments</span>
                        </a>
                    </li>
                    @if(auth()->check())
                    <li class="nav-item d-flex align-items-center mx-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-1"></i> <span>Déconnexion</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @else
                    <li class="nav-item d-flex align-items-center mx-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> <span>Connexion</span>
                        </a>
                    </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
    
</nav>
<div class="alert-notifications fixed-top" style="margin-top: 70px; z-index: 1030;">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-0">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-0">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
        
        <div class="d-flex">
        @php
            $hideSidebar = Request::is('purchase') || Request::is('checkout') || Request::is('pharmacy') || Request::is('articles/show') || Request::is('about') || Request::is('privacy-policy') || Request::is('terms');
        @endphp

        @unless($hideSidebar)
            <!-- Sidebar -->
            <div id="sidebar" class="p-3">
                <div class="n">
                    <h4 class="text-center sidebar-title">Tableau de bord</h4>
                </div>
                <ul class="nav flex-column">
                    <div class="k">
                       
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('medications.index')) active @endif" href="{{ route('medications.index') }}">
                                <i class="fas fa-pills me-2"></i> Liste des médicaments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('orders.*')) active @endif" href="{{ route('orders.index') }}">
                                <i class="fas fa-clipboard-list me-2"></i> Commandes
                                <span id="pending-orders-badge" class="badge bg-danger d-none ms-2">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('medications.create')) active @endif" href="{{ route('medications.create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Ajouter un nouveau médicament
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('medications.expiry-alert')) active @endif" href="{{ route('medications.expiry-alert') }}">
                                <i class="fas fa-exclamation-triangle me-2"></i> Alertes de validité
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('medications.out-of-stock')) active @endif" href="{{ route('medications.out-of-stock') }}">
                                <i class="fas fa-times-circle me-2"></i> Médicaments expirés
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('articles.create')) active @endif" href="{{ route('articles.create') }}">
                                <i class="fas fa-pen-fancy me-2"></i> Ajouter un nouvel article
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('pharmacy.inquiries')) active @endif" href="{{ route('pharmacy.inquiries') }}">
                                <i class="fas fa-envelope me-2"></i> Demandes des utilisateurs
                                <span id="new-inquiries-badge" class="badge bg-danger d-none ms-2">0</span>
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
        @endunless

        <!-- Main Content -->
        <div id="main-content" class="p-4 {{ $hideSidebar ? 'w-100' : 'flex-grow-1' }}">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    

    <script>
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            let sidebar = document.getElementById("sidebar");
            let mainContent = document.getElementById("main-content");
            let toggleButton = document.getElementById("toggle-sidebar");

            if (toggleButton) {
                toggleButton.addEventListener("click", function () {
                    sidebar.classList.toggle("d-none"); // إخفاء أو إظهار القائمة
                    mainContent.classList.toggle("w-100"); // توسيع الصفحة الرئيسية عند إخفاء القائمة
                });
            }
            
            // Active link highlighting
            const currentLocation = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && (currentLocation === href || currentLocation.includes(href))) {
                    link.classList.add('active');
                    link.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
                    link.style.fontWeight = '700';
                }
            });
        });
        
        AOS.init({
            duration: 1000, // مدة التأثير
            easing: 'ease-in-out', // نوع التأثير
            once: true, // التأثير مرة واحدة فقط
        });
        function updateTime() {
    const now = new Date();
    const timeElement = document.querySelector('.current-time');
    
    // تنسيق الوقت باللغة الفرنسية
    const timeString = now.toLocaleTimeString('fr-FR', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false // لاستخدام تنسيق 24 ساعة
    });
    
    timeElement.textContent = timeString;
    const options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false
};
timeElement.textContent = now.toLocaleDateString('fr-FR', options);
}

// تحديث الوقت كل ثانية
setInterval(updateTime, 1000);
updateTime(); // التشغيل الأولي

// تحديث الوقت كل ثانية
setInterval(updateTime, 1000);
updateTime(); // التشغيل الأولي
function fetchNewItemsCount() {
        fetch('/get-counts')
            .then(response => response.json())
            .then(data => {
  
                const ordersBadge = document.getElementById('pending-orders-badge');
                if (data.pending_orders > 0) {
                    ordersBadge.classList.remove('d-none');
                    ordersBadge.textContent = data.pending_orders;
                } else {
                    ordersBadge.classList.add('d-none');
                }

                // تحديث badge الاستفسارات
                const inquiriesBadge = document.getElementById('new-inquiries-badge');
                if (data.new_inquiries > 0) {
                    inquiriesBadge.classList.remove('d-none');
                    inquiriesBadge.textContent = data.new_inquiries;
                } else {
                    inquiriesBadge.classList.add('d-none');
                }
            })
            .catch(error => console.error('Error:', error));
    }


    document.addEventListener('DOMContentLoaded', function() {
        fetchNewItemsCount();
       
        setInterval(fetchNewItemsCount, 60000);
    });
    document.addEventListener('DOMContentLoaded', function() {
        var alerts = document.querySelectorAll('.alert-notifications .alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });

    </script>
</body>
</html>