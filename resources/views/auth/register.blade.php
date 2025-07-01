<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi -kedai exfour </title>
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
            background: linear-gradient(135deg, var(--coffee-dark) 0%, var(--coffee-medium) 50%, var(--coffee-light) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="coffee" patternUnits="userSpaceOnUse" width="50" height="50"><circle cx="25" cy="25" r="1" fill="%23D4AF37" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23coffee)"/></svg>');
            opacity: 0.3;
            z-index: 0;
        }

        .register-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-box { 
            max-width: 500px; 
            width: 100%;
            background: var(--cream);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(44, 24, 16, 0.3);
            border: 3px solid var(--accent-gold);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        .register-header {
            background: linear-gradient(135deg, var(--coffee-medium) 0%, var(--coffee-light) 100%);
            color: var(--cream);
            padding: 30px;
            text-align: center;
            border-bottom: 3px solid var(--accent-gold);
        }

        .register-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .register-header .coffee-icon {
            font-size: 3rem;
            color: var(--accent-gold);
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .register-body {
            padding: 40px 30px;
        }

        .form-label {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #E0E0E0;
            border-radius: 12px;
            padding: 12px 16px;
            background: var(--cream-light);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            background: var(--cream);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green) 0%, #5A7A4F 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 6px 12px rgba(74, 103, 65, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5A7A4F 0%, var(--accent-green) 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(74, 103, 65, 0.4);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(139, 110, 99, 0.2);
        }

        .login-link a {
            color: var(--accent-green);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: var(--coffee-medium);
            text-decoration: underline;
        }

        .invalid-feedback {
            color: #DC3545;
            font-weight: 500;
        }

        .floating-coffee {
            position: absolute;
            font-size: 2rem;
            color: var(--accent-gold);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-coffee:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
        .floating-coffee:nth-child(2) { top: 20%; right: 15%; animation-delay: 2s; }
        .floating-coffee:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 4s; }
        .floating-coffee:nth-child(4) { bottom: 15%; right: 10%; animation-delay: 1s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .welcome-text {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 25px;
            text-align: center;
            line-height: 1.6;
        }

        @media (max-width: 576px) {
            .register-box { 
                margin: 20px;
                max-width: none;
            }
            .register-header, .register-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating coffee icons -->
    {{--
    <i class="bi bi-cup-hot floating-coffee"></i>
    <i class="bi bi-cup-straw floating-coffee"></i>
    <i class="bi bi-cup-hot-fill floating-coffee"></i>
    <i class="bi bi-cup-straw-fill floating-coffee"></i>
    --}}

    <div class="register-container">
        <div class="register-box">
            <div class="register-header">
                <div class="coffee-icon mb-2">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height:60px; width:auto; border-radius:16px;">
                </div>
                <h2>Kedai exfour</h2>
                <p class="mb-0">Daftar Akun Pelanggan</p>
            </div>
            <div class="register-body">
                <div class="welcome-text">
                    Bergabunglah dengan komunitas pecinta kopi kami dan nikmati pengalaman berbelanja yang menyenangkan!
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            <i class="bi bi-person me-2"></i>Nama Lengkap
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               required placeholder="Masukkan nama lengkap Anda">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="form-label">
                            <i class="bi bi-house me-2"></i>Alamat
                        </label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                               id="alamat" name="alamat" value="{{ old('alamat') }}" 
                               required placeholder="Masukkan alamat lengkap Anda">
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="no_telp" class="form-label">
                            <i class="bi bi-phone me-2"></i>Nomor Telepon
                        </label>
                        <input type="number" class="form-control @error('no_telp') is-invalid @enderror" 
                               id="no_telp" name="no_telp" value="{{ old('no_telp') }}" 
                               required placeholder="Masukkan Nomor Telepon Anda">
                        @error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope me-2"></i>Email
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               required placeholder="Masukkan email Anda">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock me-2"></i>Password
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required placeholder="Minimal 8 karakter">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            <i class="bi bi-shield-check me-2"></i>Konfirmasi Password
                        </label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" 
                               required placeholder="Ulangi password Anda">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </button>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="login-link">
                    <a href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-left me-1"></i>Sudah punya akun? Login di sini
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 