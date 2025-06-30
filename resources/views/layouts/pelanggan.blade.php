<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Kedai Exfour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --coffee-dark: #2C1810;
            --coffee-medium: #5D4037;
            --coffee-light: #8D6E63;
            --cream: #F5F1E8;
            --cream-light: #FAF8F3;
            --accent-green: #4A6741;
            --accent-gold: #D4AF37;
            --text-dark: #2C1810;
            --text-light: #6B4423;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--cream-light);
            min-height: 100vh;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%) !important;
            box-shadow: 0 4px 12px rgba(44, 24, 16, 0.15);
            border-bottom: 3px solid var(--accent-gold);
        }
        
        .navbar-brand {
            font-weight: bold;
            color: var(--cream) !important;
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        .navbar-brand:hover {
            color: var(--accent-gold) !important;
        }
        
        .nav-link {
            color: var(--cream) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
            margin: 0 4px;
        }
        
        .nav-link:hover {
            background: rgba(212, 175, 55, 0.2);
            color: var(--accent-gold) !important;
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, var(--accent-gold) 0%, #E6C200 100%);
            color: var(--coffee-dark) !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }
        
        .main-content {
            background: var(--cream);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(44, 24, 16, 0.08);
            margin: 20px;
            padding: 30px;
            min-height: calc(100vh - 140px);
            border-left: 4px solid var(--accent-gold);
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(44, 24, 16, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: var(--cream);
            border-left: 4px solid var(--accent-gold);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(44, 24, 16, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green) 0%, #5A7A4F 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(74, 103, 65, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #5A7A4F 0%, var(--accent-green) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(74, 103, 65, 0.4);
        }
        
        .btn-outline-primary {
            border-color: var(--accent-green);
            color: var(--accent-green);
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
        }
        
        .btn-outline-primary:hover {
            background: var(--accent-green);
            border-color: var(--accent-green);
            transform: translateY(-2px);
        }
        
        .user-info {
            background: linear-gradient(135deg, var(--accent-gold) 0%, #E6C200 100%);
            color: var(--coffee-dark);
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid var(--accent-gold);
        }
        
        .user-info:hover {
            background: linear-gradient(135deg, #E6C200 0%, var(--accent-gold) 100%);
            transform: translateY(-2px);
        }
        
        .page-title {
            color: var(--text-dark);
            font-weight: bold;
            margin-bottom: 30px;
            position: relative;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-green) 100%);
            border-radius: 2px;
        }
        
        .alert {
            border-radius: 15px;
            border: none;
        }
        
        .table {
            border-radius: 15px;
            overflow: hidden;
            background: var(--cream);
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--coffee-medium) 0%, var(--coffee-light) 100%);
            color: var(--cream);
            border: none;
            font-weight: 600;
            padding: 15px;
        }
        
        .table tbody tr:hover {
            background: rgba(212, 175, 55, 0.1);
        }
        
        .badge {
            border-radius: 20px;
            padding: 8px 15px;
            font-weight: 600;
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #E0E0E0;
            transition: all 0.3s ease;
            background: var(--cream-light);
        }
        
        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            background: var(--cream);
        }

        /* Carousel Styles */
        .carousel-section {
            margin: 30px 0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(44, 24, 16, 0.15);
        }

        .carousel-item {
            height: 400px;
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%);
        }

        .carousel-item img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        .carousel-caption {
            background: rgba(44, 24, 16, 0.8);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
        }

        .carousel-caption h3 {
            color: var(--accent-gold);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .carousel-caption p {
            color: var(--cream);
            font-size: 1.1rem;
        }

        /* Map Section */
        .map-section {
            margin: 30px 0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(44, 24, 16, 0.15);
        }

        .map-header {
            background: linear-gradient(135deg, var(--coffee-medium) 0%, var(--coffee-light) 100%);
            color: var(--cream);
            padding: 20px;
            text-align: center;
        }

        .map-header h3 {
            color: var(--accent-gold);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .map-container {
            height: 400px;
            background: var(--cream-light);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .map-placeholder {
            background: linear-gradient(135deg, var(--coffee-light) 0%, var(--coffee-medium) 100%);
            color: var(--cream);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 500px;
        }

        .map-placeholder i {
            font-size: 3rem;
            color: var(--accent-gold);
            margin-bottom: 20px;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%);
            color: var(--cream);
            padding: 30px 0;
            margin-top: 50px;
            border-top: 3px solid var(--accent-gold);
        }

        .footer h5 {
            color: var(--accent-gold);
            font-weight: 700;
            margin-bottom: 15px;
        }

        .footer p {
            color: var(--cream);
            line-height: 1.6;
        }

        .footer .social-links a {
            color: var(--accent-gold);
            font-size: 1.5rem;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .footer .social-links a:hover {
            color: var(--cream);
            transform: translateY(-3px);
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('pelanggan.produk.index') }}">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height:32px; width:auto; border-radius:8px; margin-right:8px;">Kedai ExFlour
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.beranda') ? 'active' : '' }}" href="{{ route('pelanggan.beranda') }}">
                            <i class="bi bi-house-door-fill me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.produk.*') ? 'active' : '' }}" href="{{ route('pelanggan.produk.index') }}">
                            <i class="bi bi-box-seam me-1"></i>Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.pesanan.*') ? 'active' : '' }}" href="{{ route('pelanggan.pesanan.index') }}">
                            <i class="bi bi-receipt me-1"></i>Pesanan Saya
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-info" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ session('user')->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content fade-in">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="bi bi-cup-hot-fill me-2"></i>kedai exfour </h5>
                    <p>Menghadirkan kopi berkualitas dengan suasana yang nyaman untuk menemani hari-hari Anda.</p>
                </div>
                <div class="col-md-4">
                    <h5>Jam Operasional</h5>
                    <p>Senin - Minggu<br>
                    08:00 - 22:00 WIB</p>
                </div>
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <p>Telepon: (+62) 82233774897<br>
                    Email: info@kedaiexfour .com</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/exfour.id?igsh=MXdnMGxwbDAyczk3YQ==" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--accent-gold);">
            <div class="text-center">
                <p>&copy; 2025 kedai exfour . All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 