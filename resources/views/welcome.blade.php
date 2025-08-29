@extends('layouts.guest')

@section('title', 'Beranda')

@section('content')
    <div class="container-fluid px-5">
        <div id="heroCarousel" class="carousel slide carousel-fade mb-5 position-relative rounded-4 overflow-hidden" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner" style="height: 450px;">
                {{-- Slide 1 --}}
                <div class="carousel-item active">
                    <img src="{{ asset('images/foto1.jpeg') }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Slide 1">
                </div>

                {{-- Slide 2 --}}
                <div class="carousel-item">
                    <img src="{{ asset('images/foto2.jpeg') }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Slide 2">
                </div>
            </div>

            {{-- Overlay --}}
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4); z-index: 2;"></div>

            {{-- Teks di atas gambar --}}
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3" style="z-index: 3;">
                <h1 class="display-5 fw-bold">Selamat Datang di Kedai ExFour</h1>
                <p class="lead">Nikmati kopi berkualitas dengan suasana yang nyaman dan hangat</p>
                <a href="#tentang" class="btn btn-outline-light mt-3">Lihat Selengkapnya</a>
            </div>

        
        </div>
    </div>

    <section class="px-5" id="tentang" >
        <div class="container">
            <div class="row align-items-center">
                {{-- Teks di kiri --}}
                <div class="col-md-8">
                    <div class="text-uppercase text-muted mb-2" style="letter-spacing: 2px;">KUALITAS & KENYAMANAN</div>
                    <h2 class="fw-bold" style="color:#4A6741;">Bangga Menyajikan</h2>
                    <h2 class="fw-bold mb-4" style="color:#6B4423;">Rasa Terbaik untuk Hari Anda</h2>
                    <p style="font-size: 1.1rem; color: #5e4939;">
                        Kedai Exfour berdiri dari semangat kami untuk menghadirkan cita rasa kopi lokal dengan sentuhan kenyamanan khas rumah sendiri. Kami hanya memilih biji kopi terbaik dari penjuru Indonesia, dan menyajikannya lewat tangan barista yang berpengalaman dan penuh passion.
                    </p>
                    <p style="font-size: 1.1rem; color: #5e4939;">
                        Semua racikan dibuat secara konsisten, dengan standar kualitas tinggi dan pelayanan hangat. Kami ingin setiap cangkir kopi yang Anda nikmati di sini menjadi bagian dari cerita harian Anda. Semoga Exfour menjadi tempat pulang terbaik — setelah lelah, sebelum berjuang.
                    </p>
                </div>

                {{-- Gambar di kanan --}}
                <div class="col-md-4 text-center mt-4 mt-md-0">
                    <img src="{{ asset('images/coffee-home.png') }}" alt="Coffee" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <section class="px-5 py-5" >
            <div class="container">
            <div class="row mt-1 mb-4 justify-content-center text-center">
                <div class="col-md-10">
                    <h4 class="fw-bold mb-3" style="color:#4A6741;">Yuk, Terhubung Lebih Dekat!</h4>
                    <p style="font-size: 1.1rem; color:#6B4423;">
                        Temukan promo spesial, behind-the-scene racikan kopi kami, dan vibes seru di balik Kedai ExFour hanya di Instagram.
                    </p>

                    <div class="my-4">
                        <a href="https://www.instagram.com/exfour.id?igsh=MXdnMGxwbDAyczk3YQ==" target="_blank"
                        class="btn btn-outline-primary btn-lg px-4 py-2" style="border-radius: 30px; font-weight:600;">
                            <i class="bi bi-instagram me-2"></i>Follow Instagram: <b>@exfour.id</b>
                        </a>
                    </div>

                    {{-- Optional: Tambah preview feed IG palsu --}}
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <img src="{{ asset('images/ig1.png') }}" class="rounded-3" style="width: 120px; height: 120px; object-fit: cover;" alt="IG1">
                        <img src="{{ asset('images/ig2.png') }}" class="rounded-3" style="width: 120px; height: 120px; object-fit: cover;" alt="IG2">
                        <img src="{{ asset('images/ig3.png') }}" class="rounded-3" style="width: 120px; height: 120px; object-fit: cover;" alt="IG3">
                    </div>
                </div>
            </div>
            </div>
    </section>
    <section class="px-5 py-5 bg-light" style="border-radius: 1rem">
            <div class="container">
                <div class="text-center mb-4">
                    <h4 class="fw-bold" style="color:#4A6741;">Produk Populer Kami</h4>
                    <p class="text-muted">Racikan paling digemari pelanggan setia kami!</p>
                </div>
                <div class="position-relative">
                    <button id="scrollLeft" class="btn-panah left">&#10094;</button>
                    <div class="produk-scroll-wrapper" id="produkScroll">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="produk-card">
                                <div class="produk-img">
                                    <img src="{{ asset('images/produk/' . $i . '.jpg') }}" alt="Produk {{ $i }}">
                                </div>
                                
                            </div>
                        @endfor
                    </div>
                    <button id="scrollRight" class="btn-panah right">&#10095;</button>
                </div>
                

                <div class="text-center mt-4">
                    <a href="{{ route('pelanggan.produk.index') }}" class="btn btn-outline-primary px-4 py-2" style="border-radius: 30px;">
                        <i class="bi bi-box-seam me-2"></i>Lihat Selengkapnya
                    </a>
                </div>
            </div>
    </section>
    <section class="px-5" >
        <div class="row mt-5 mb-4 align-items-center">
                <div class="col-md-6">
                    <div class="map-container shadow rounded-4 overflow-hidden" style="border: 2px solid #eee;">
                        
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d494.640406940915!2d112.63909422799871!3d-7.3400529255439215!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fdd7bc74382d%3A0x7c6b7e44463aa167!2sEXFOUR!5e0!3m2!1sid!2sid!4v1751382044861!5m2!1sid!2sid"  width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-6 mt-5 mt-md-0">
                    <h3 class="fw-bold" style="color:#4A6741;">
                        <i class="bi bi-geo-alt-fill me-2"></i>Kunjungi Kedai ExFour
                    </h3>
                    <p style="font-size: 1.1rem; color:#6B4423;">
                        ExFour hadir untuk menemani harimu dengan kopi berkualitas dan tempat yang nyaman. Lokasi kami strategis dan mudah diakses, cocok untuk santai, kerja, atau ngobrol santai bersama teman.
                    </p>
                    <ul class="list-unstyled mt-3" style="color:#4A6741; font-size:1rem;">
                        <li><i class="bi bi-cup-hot-fill me-2"></i>Racikan kopi khas dan original</li>
                        <li><i class="bi bi-wifi me-2"></i>Fasilitas WiFi gratis & colokan</li>
                        <li><i class="bi bi-people-fill me-2"></i>Tempat nyaman untuk hangout</li>
                        <li><i class="bi bi-clock-fill me-2"></i>Buka setiap hari, 08.00–22.00 WIB</li>
                    </ul>

                    <a href="https://maps.app.goo.gl/9Q4JWRMf53JiuZEE7" target="_blank" class="btn btn-outline-success mt-3">
                        <i class="bi bi-map me-1"></i> Buka di Google Maps
                    </a>
                    </div>
                </div>


        
        </div>
    </section>
    <section class="px-5 py-5 bg-light" style="border-radius: 1rem">
    <div class="container">
        <div class="text-center mb-4">
            <h4 class="fw-bold" style="color:#4A6741;">Ulasan Pelanggan</h4>
            <p class="text-muted">Apa kata pelanggan setia kami?</p>
        </div>

        <!-- Swiper -->
        <div class="swiper ulasan-swiper">
            <div class="swiper-wrapper">
                @foreach($ulasan as $u)
                    <div class="swiper-slide">
                        <div class="card p-3 shadow-sm" style="border-radius: 1rem;">
                            <div class=" fw-bold"><h5>{{ $u->user->name }}</h5></div>
                            <div class="text-gold mb-2">Produk: {{ $u->order->orderItems->first()->product->nama  }}</div>
                            <div class="mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if($i <= $u->rating)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-muted"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-muted">{{ $u->review }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

@endsection 