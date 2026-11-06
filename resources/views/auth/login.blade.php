<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Inventaris</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body { min-height: 100vh; background: linear-gradient(135deg, #edf4f2, #f8f6ef); }
        .login-shell { width: min(100% - 2rem, 440px); }
        .brand-mark { width: 48px; height: 48px; display: grid; place-items: center; border-radius: 12px; background: #0a46e9; color: white; }
        .form-control { min-height: 46px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">
    <main class="login-shell">
        <header class="d-flex align-items-center gap-3 mb-4">
            <div class="brand-mark" aria-hidden="true"><i class="fa-solid fa-boxes-stacked"></i></div>
            <div>
                <h1 class="h4 mb-1">Inventaris Barang</h1>
                <p class="text-secondary mb-0">Masuk untuk mengelola persediaan</p>
            </div>
        </header>

        <section class="bg-white border rounded-3 shadow-sm p-4 p-md-5">
            <h2 class="h5 mb-4">Masuk ke akun</h2>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" autocomplete="current-password" required>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" id="remember" name="remember" type="checkbox" value="1">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">
                    <i class="fa-solid fa-right-to-bracket me-2" aria-hidden="true"></i>Masuk
                </button>
            </form>
        </section>
    </main>
</body>
</html>