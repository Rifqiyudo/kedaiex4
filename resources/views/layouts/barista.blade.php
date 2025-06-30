<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Barista Panel</title>
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
            background: var(--cream-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%);
            color: var(--cream);
            box-shadow: 4px 0 12px rgba(44, 24, 16, 0.1);
            border-right: 3px solid var(--accent-gold);
        }

        .sidebar h4 {
            color: var(--accent-gold);
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .sidebar .nav-link {
            color: var(--cream);
            font-weight: 500;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: linear-gradient(135deg, var(--accent-gold) 0%, #E6C200 100%);
            color: var(--coffee-dark);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
            border: 1px solid var(--accent-gold);
            transform: translateX(5px);
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .main-content {
            padding: 30px;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .navbar {
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%);
            box-shadow: 0 4px 12px rgba(44, 24, 16, 0.15);
            border-bottom: 3px solid var(--accent-gold);
        }

        .navbar-text {
            color: var(--cream) !important;
            font-weight: 500;
        }

        .btn-outline-danger {
            border: 2px solid #DC3545;
            color: #DC3545;
            background: transparent;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background: #DC3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
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

        .btn-success {
            background: linear-gradient(135deg, var(--accent-green) 0%, #5A7A4F 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #5A7A4F 0%, var(--accent-green) 100%);
            transform: translateY(-2px);
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

        .h3, .h4 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .badge {
            border-radius: 6px;
            font-weight: 500;
            padding: 6px 12px;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, var(--accent-gold) 0%, #E6C200 100%) !important;
            color: var(--coffee-dark);
        }

        .badge.bg-success {
            background: linear-gradient(135deg, var(--accent-green) 0%, #5A7A4F 100%) !important;
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #DC3545 0%, #C82333 100%) !important;
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
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4 class="mb-4 d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height:36px; width:auto; border-radius:8px; margin-right:8px;">Kedai Barista
            </h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('barista.transaksi.*') ? 'active' : '' }}" href="{{ route('barista.transaksi.index') }}">
                        <i class="bi bi-receipt-cutoff"></i>Transaksi
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex-grow-1">
            <nav class="navbar navbar-expand navbar-dark">
                <div class="container-fluid d-flex align-items-center">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height:28px; width:auto; border-radius:6px; margin-right:10px;">
                    <span class="navbar-text ms-auto">
                        <i class="bi bi-person-circle me-2"></i>{{ session('user')->name ?? 'Barista' }}
                    </span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline ms-3">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </nav>
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 