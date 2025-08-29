<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Kedai Exfour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

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
            padding-top: 80px;
        }
        
         .navbar-custom {
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%) !important;
            box-shadow: 0 4px 12px rgba(44, 24, 16, 0.15);
            border-bottom: 3px solid var(--accent-gold);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1050;
            height: 80px; 
            display: flex;
            align-items: center;
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
            border-radius: 0;
            margin: 0 4px;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            width: 0%;
            height: 2px;
            background-color: var(--accent-gold);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active::after {
            width: 100%;
        }

        .nav-link.active {
            color: var(--accent-gold) !important;
            font-weight: 600;
            background: none !important;
            box-shadow: none !important;
        }
        .navbar-custom,
        .navbar-custom .navbar-collapse,
        .navbar-custom .navbar-toggler {
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 100%) !important;
        }

        @media (max-width: 768px) {
            .navbar-custom {
                height: auto;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }

            body {
                padding-top: 100px; 
            }
        }
        .btn-outline-light {
            border: 2px solid white;
            color: var(--cream);
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            border-color: var(--accent-gold);
            color: var(--accent-gold);
            background-color: transparent;
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


        .star {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
        }

        .star.selected {
            color: #ffc107 !important;
        }

        .produk-scroll-wrapper {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            user-select: none;
            cursor: grab;
            
            padding-bottom: 1rem;
        }   
        
        .produk-scroll-wrapper.dragging {
            cursor: grabbing;
        }

        .produk-scroll-wrapper::-webkit-scrollbar {
            display: none;
        }

        .produk-card {
            flex: 0 0 calc((100% - 3rem) / 3);
            max-width: calc((100% - 3rem) / 3);
            background: white;
            border-radius: 15px;
            overflow: hidden;   
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .produk-card:hover {
            transform: scale(1.03);
        }

        .produk-img {
            height: 400px;
            overflow: hidden;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .produk-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .produk-img:hover img {
            transform: scale(1.05);
        }

        @media (max-width: 992px) {
            .produk-card {
                flex: 0 0 70%;
                max-width: 70%;
            }
        }

        @media (max-width: 576px) {
            .produk-card {
                flex: 0 0 90%;
                max-width: 90%;
            }
        }

        .position-relative {
        position: relative;
        }

        .btn-panah {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: rgba(74, 103, 65, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        .btn-panah:hover {
            background-color: #4A6741;
        }

        .btn-panah.left {
            left: -20px;
        }

        .btn-panah.right {
            right: -20px;
        }
        ::-webkit-scrollbar {
            width: 14px;
            height: 18px;
        }

        ::-webkit-scrollbar-track {
            background: #f3f1e7; 
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-gold);
            border-radius: 10px;
            border: 2px solid #f3f1e7; 
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #d4af37cc; 
        }

        .user-info::after {
            display: none !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('pelanggan.produk.index') }}">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height:32px; width:auto; border-radius:8px; margin-right:8px;">Kedai ExFour
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.beranda') ? 'active' : '' }}" href="{{ route('pelanggan.beranda') }}">
                            </i>Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.produk.*') ? 'active' : '' }}" href="{{ route('pelanggan.produk.index') }}">
                            Produk
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link {{ request()->routeIs('pelanggan.cart.*') ? 'active' : '' }}" href="{{ route('pelanggan.cart.index') }}">
                            Keranjang Saya
                            @if($cartCount > 0)
                                <span class="badge bg-danger rounded-pill position-absolute top-20 start-100 translate-middle p-1 px-2" style="font-size: 0.65rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pelanggan.pesanan.*') ? 'active' : '' }}" href="{{ route('pelanggan.pesanan.index') }}">
                            Pesanan Saya
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-info" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>Selamat Datang, {{ session('user')->name }}!
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
                    <h5><i class="bi bi-cup-hot-fill me-2"></i>Kedai ExFour </h5>
                    <p>Di Kedai ExFour, kami percaya bahwa secangkir kopi yang berkualitas bisa mengubah hari Anda. Kami hadir bukan sekadar menyajikan kopi, tapi juga menciptakan suasana nyaman untuk berbagi cerita, tawa, dan ketenangan.</p>
                </div>
                <div class="col-md-4">
                    <h5>Jam Operasional</h5>
                    <p>Senin - Sabtu<br>
                    08:00 - 22:00 WIB</p>
                </div>
                <div class="col-md-4">
                    <h5>Hubungi Kami</h5>
                    <p>Telepon : <a href="https://wa.me/+6281338417718" style="color: white !important; text-decoration: none;">(+62) 813-3841-7718</a><br>
                    Email : <a href="mailto:exfour2020@gmail.com" style="color: white !important; text-decoration: none;">exfour2020@gmail.com</a></p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/exfour.id?igsh=MXdnMGxwbDAyczk3YQ==" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/+6281338417718"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--accent-gold);">
            <div class="text-center">
                <p>Copyright &copy; 2025 Kedai ExFour . All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.ulasan-swiper', {
            slidesPerView: 3,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#starRating .star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = this.getAttribute('data-value');
                    ratingInput.value = rating;

                    stars.forEach(s => s.classList.remove('selected'));

                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('selected');
                    }
                });
            });
        });
    </script>
    <script>
        const slider = document.getElementById('produkScroll');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('dragging');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
            e.preventDefault(); // cegah text selection
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('dragging');
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('dragging');
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault(); // penting supaya nggak ngereset scroll
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.2; // nilai geser
            slider.scrollLeft = scrollLeft - walk;
        });
    </script>
    <script>
        const scrollContainer = document.getElementById('produkScroll');
        const scrollAmount = scrollContainer.clientWidth; // geser 1 layar penuh

        document.getElementById('scrollLeft').addEventListener('click', () => {
            scrollContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });

        document.getElementById('scrollRight').addEventListener('click', () => {
            scrollContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });
    </script>
    @yield('scripts')
</body>
</html> 