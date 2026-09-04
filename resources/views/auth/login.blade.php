<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Diperlukan - LAPORINFRA</title>

    @vite('resources/css/auth/login.css')
</head>

<body>

    <main class="login-container">

        <div class="login-card">

            <div class="icon">
                🔐
            </div>

            <h1>Masuk ke LAPORINFRA</h1>

            <p>
                Pilih jenis akun yang ingin digunakan.
            </p>

            <div class="login-options">

                <a href="{{ route('auth.masyarakat.login') }}">
                    Login Masyarakat
                </a>

                <a href="{{ route('auth.admin.login') }}">
                    Login Admin
                </a>

                <a href="{{ route('auth.devisi.login') }}">
                    Login OPD
                </a>

            </div>

            <a href="{{ route('home') }}" class="back-link">
                ← Kembali ke halaman utama
            </a>

        </div>

    </main>

</body>

</html>
