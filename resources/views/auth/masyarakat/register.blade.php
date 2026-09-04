<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun - LAPORINFRA</title>

    @vite('resources/css/auth/masyarakat/register.css')
</head>

<body>

    <div class="register-page">

        <!-- =========================
             LEFT
        ========================== -->

        <div class="register-left">

            <div class="brand">

                <div class="brand-icon">
                    ⚡
                </div>

                <span>
                    LAPOR<span>INFRA</span>
                </span>

            </div>

            <div class="left-content">

                <p class="eyebrow">
                    BERGABUNG BERSAMA KAMI
                </p>

                <h1>
                    Jadilah bagian<br>
                    dari perubahan.
                </h1>

                <p>
                    Buat akun LAPORINFRA dan bantu melaporkan
                    kerusakan infrastruktur di sekitar Anda.
                </p>

                <div class="benefits">

                    <div class="benefit">
                        <span>✓</span>
                        <p>Laporkan kerusakan dengan mudah</p>
                    </div>

                    <div class="benefit">
                        <span>✓</span>
                        <p>Pantau perkembangan laporan Anda</p>
                    </div>

                    <div class="benefit">
                        <span>✓</span>
                        <p>Bantu menciptakan lingkungan yang lebih baik</p>
                    </div>

                </div>

            </div>

        </div>


        <!-- =========================
             RIGHT
        ========================== -->

        <div class="register-right">

            <div class="register-card">

                <div class="register-header">

                    <h2>Buat Akun</h2>

                    <p>
                        Sudah punya akun?
                        <a href="{{ route('auth.masyarakat.login') }}">
                            Masuk di sini
                        </a>
                    </p>

                </div>


                <!-- NAMA -->
                <form action="{{ route('register.masyarakat') }}" method="POST" class="login-form">
                    @csrf
                    <div class="form-group">

                        <label for="name">
                            Nama Lengkap
                        </label>

                        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap">
                        
                        @error('name')
                            <p>{{$message}}</p>
                        @enderror

                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Alamat Email
                        </label>

                        <input type="email" id="email" name="email" placeholder="nama@email.com">

                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Kata Sandi
                        </label>

                        <input type="password" id="password" name="password" placeholder="Buat kata sandi">

                        @error('password')
                            <p>{{ $message }}</p>
                        @enderror

                    </div>


                    <!-- CONFIRM PASSWORD -->

                    <div class="form-group">

                        <label for="password_confirmation">
                            Konfirmasi Kata Sandi
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Ulangi kata sandi">


                    </div>


                    <!-- TERMS -->

                    <label class="agreement">

                        <input type="checkbox">

                        <span>
                            Saya menyetujui
                            <a href="#">Syarat Layanan</a>
                            dan
                            <a href="#">Kebijakan Privasi</a>
                            LAPORINFRA.
                        </span>

                    </label>


                    <!-- REGISTER -->

                    <button type="submit" class="btn-register">
                        Daftar
                    </button>

                </form>
                <!-- DIVIDER -->

                <div class="divider">

                    <span></span>

                    <p>atau daftar dengan</p>

                    <span></span>

                </div>


                <!-- GOOGLE -->

                <button type="button" class="btn-google">

                    <span class="google-icon">
                        G
                    </span>

                    <span>
                        Daftar dengan Google
                    </span>

                </button>

            </div>

        </div>

    </div>

</body>

</html>
