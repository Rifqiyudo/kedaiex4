@extends('layouts.pelanggan')

@section('title', 'Beranda')

@section('content')
<div class="container py-4">
    <div class="row mb-5">
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div id="kedaiCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#kedaiCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#kedaiCarousel" data-bs-slide-to="1"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/foto1.jpeg') }}" class="d-block w-100 rounded-4" alt="Kedai Exfour">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Selamat Datang di kedai exfour </h3>
                            <p>Nikmati kopi berkualitas dengan suasana yang nyaman dan hangat</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/foto2.jpeg') }}" class="d-block w-100 rounded-4" alt="Kedai Exfour">
                        <div class="carousel-caption d-none d-md-block">
                            <h3>Kopi Pilihan Terbaik</h3>
                            <p>Dari biji kopi pilihan hingga racikan barista profesional</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#kedaiCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#kedaiCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
        <div class="col-lg-5 d-flex align-items-center">
            <div>
                <h2 class="mb-3" style="color:#4A6741;font-weight:700"><i class="bi bi-cup-hot-fill me-2"></i>Tentang kedai exfour </h2>
                <p style="font-size:1.1rem; color:#6B4423;">kedai exfour  adalah tempat terbaik untuk menikmati kopi pilihan dengan suasana yang hangat dan nyaman. Kami menghadirkan berbagai varian kopi dari biji pilihan, disajikan oleh barista profesional. Visi kami adalah menjadi tempat nongkrong favorit dan rumah kedua bagi para pecinta kopi di kota ini.</p>
                <ul class="list-unstyled mt-3" style="color:#4A6741;">
                    <li><i class="bi bi-check-circle-fill me-2"></i>Racikan kopi premium</li>
                    <li><i class="bi bi-check-circle-fill me-2"></i>Tempat nyaman & wifi gratis</li>
                    <li><i class="bi bi-check-circle-fill me-2"></i>Barista ramah & profesional</li>
                    <li><i class="bi bi-check-circle-fill me-2"></i>Harga terjangkau</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-2">
        <div class="col-12 text-center">
            <a href="https://www.instagram.com/exfour.id?igsh=MXdnMGxwbDAyczk3YQ==" target="_blank" class="btn btn-outline-primary btn-lg" style="border-radius: 30px; font-weight:600;">
                <i class="bi bi-instagram me-2"></i>Follow Instagram kami: <b>@exfour.id</b>
            </a>
            <div class="mt-2" style="color:#6B4423; font-size:1rem;">
                Dapatkan info promo, event, dan update terbaru di Instagram kami!
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="map-section">
                <div class="map-header">
                    <h3><i class="bi bi-geo-alt-fill me-2"></i>Lokasi Kami</h3>
                    <p>Kunjungi kedai kami untuk pengalaman kopi terbaik</p>
                </div>
                <div class="map-container p-0" style="height:auto;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.12640083426!2d112.63682857357247!3d-7.339699372194042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fd46ed79b8cf%3A0x6a30db386f690f52!2sAA%20Jl.%20Pancawarna%20No.24%2C%20Mulung%2C%20Kec.%20Driyorejo%2C%20Kabupaten%20Gresik%2C%20Jawa%20Timur%2061177!5e0!3m2!1sid!2sid!4v1751124441670!5m2!1sid!2sid" width="100%" height="400" style="border:0; border-radius:15px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection 