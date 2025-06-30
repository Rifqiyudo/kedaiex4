<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            min-height: 100vh;
            background: var(--cream-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%);
            box-shadow: 0 4px 12px rgba(44, 24, 16, 0.15);
            border-bottom: 3px solid var(--accent-gold);
        }

        .navbar-brand {
            color: var(--cream) !important;
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .navbar-brand:hover {
            color: var(--accent-gold) !important;
        }

        .btn-light {
            background: var(--cream);
            border: 2px solid var(--coffee-light);
            color: var(--text-dark);
            font-weight: 500;
        }

        .btn-light:hover {
            background: var(--coffee-light);
            border-color: var(--coffee-medium);
            color: var(--cream);
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%);
            box-shadow: 4px 0 12px rgba(44, 24, 16, 0.1);
            border-right: 3px solid var(--accent-gold);
        }

        .sidebar .nav-link {
            color: var(--cream);
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            border: 1px solid transparent;
        }

        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--coffee-light) 100%);
            color: var(--cream);
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--accent-gold) 0%, #E6C200 100%);
            color: var(--coffee-dark);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
            border: 1px solid var(--accent-gold);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .card {
            background: var(--cream);
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(44, 24, 16, 0.08);
            border-left: 4px solid var(--accent-gold);
        }

        .card-header {
            background: linear-gradient(135deg, var(--coffee-medium) 0%, var(--coffee-light) 100%);
            color: var(--cream);
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green) 0%, #5A7A4F 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(74, 103, 65, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5A7A4F 0%, var(--accent-green) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(74, 103, 65, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--accent-gold) 0%, #E6C200 100%);
            border: none;
            color: var(--coffee-dark);
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #E6C200 0%, var(--accent-gold) 100%);
            color: var(--coffee-dark);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #DC3545 0%, #C82333 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #C82333 0%, #DC3545 100%);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--coffee-light) 0%, var(--coffee-medium) 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, var(--coffee-medium) 0%, var(--coffee-light) 100%);
            transform: translateY(-2px);
        }

        .table {
            background: var(--cream);
            border-radius: 8px;
            overflow: hidden;
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

        .alert-success {
            background: linear-gradient(135deg, #D4EDDA 0%, #C3E6CB 100%);
            border: 2px solid var(--accent-green);
            color: var(--text-dark);
            border-radius: 8px;
        }

        .form-control, .form-select {
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            background: var(--cream-light);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            background: var(--cream);
        }

        .h3 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .dropdown-menu {
            background: var(--cream);
            border: 2px solid var(--coffee-light);
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(44, 24, 16, 0.15);
        }

        .dropdown-item:hover {
            background: var(--coffee-light);
            color: var(--cream);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--coffee-light);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--coffee-medium);
        }

        /* Animation for page load */
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
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height:32px; width:auto; border-radius:8px; margin-right:8px;">Kedai exfour Admin
        </a>
        <div class="dropdown ms-auto">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2"></i>Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left;">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar py-4">
            <div class="position-sticky">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height:40px; width:auto; border-radius:10px;">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin')) active @endif" href="/admin">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                   
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin/produk*')) active @endif" href="/admin/produk">
                            <i class="bi bi-box-seam"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin/kategori*')) active @endif" href="/admin/kategori">
                            <i class="bi bi-tags-fill"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin/promo*')) active @endif" href="/admin/promo">
                            <i class="bi bi-tag-fill"></i> Promo
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin/transaksi*')) active @endif" href="/admin/transaksi">
                            <i class="bi bi-receipt-cutoff"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin/stok*')) active @endif" href="/admin/stok">
                            <i class="bi bi-archive-fill"></i> Stok
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin/laporan*')) active @endif" href="/admin/laporan">
                            <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link @if(request()->is('admin/user*')) active @endif" href="/admin/user">
                            <i class="bi bi-people-fill"></i> User
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="col-md-10 ms-sm-auto px-md-4 py-4 fade-in">
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html> 