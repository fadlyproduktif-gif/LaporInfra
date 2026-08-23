<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Masyarakat - LAPORINFRA</title>

    @vite('resources/css/auth/masyarakat/login.css')
</head>

<body>

    <div class="auth-page">

        <!-- =========================
             LEFT SIDE
        ========================== -->
        <div class="auth-left">

            <div class="overlay"></div>

            <div class="left-content">

                <div class="brand">
                    <div class="brand-icon">⚡</div>
                    <span>LAPOR<span>INFRA</span></span>
                </div>

                <div class="hero-content">

                    <p class="eyebrow">
                        PLATFORM PENGADUAN INFRASTRUKTUR
                    </p>

                    <h1>
                        Laporkan Kerusakan<br>
                        Infrastruktur di<br>
                        Sekitar Anda
                    </h1>

                    <p class="hero-description">
                        Bersama kita membangun Indonesia yang lebih baik.
                        Setiap laporan yang Anda kirimkan membantu pemerintah
                        memprioritaskan perbaikan infrastruktur di daerah Anda.
                    </p>

                </div>

                <div class="statistics">

                    <!-- <div class="stat">
                        <strong>48.200+</strong>
                        <span>Laporan Diterima</span>
                    </div>

                    <div class="stat">
                        <strong>31 Prov</strong>
                        <span>Cakupan Wilayah</span>
                    </div>

                    <div class="stat">
                        <strong>72%</strong>
                        <span>Laporan Ditindaklanjuti</span>
                    </div> -->

                </div>

            </div>

        </div>


        <!-- =========================
             RIGHT SIDE
        ========================== -->
        <div class="auth-right">

            <div class="auth-card">

                <div class="auth-header">

                    <h2>Masuk ke Akun</h2>

                    <p>
                        Belum punya akun?
                        <a href="{{ route('masyarakat.register') }}">Daftar di sini</a>
                    </p>
                    <br>
                    @if (session('loginError'))
                        <p><u>{{session('loginError')}}</u></p>
                    @endif

                </div>


                <!-- EMAIL -->
                <form class="login-form" method="POST" action="{{ route('login.masyarakat') }}">
                    @csrf
                    <div class="form-group">

                        <label for="email">
                            Alamat Email
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">✉</span>

                            <input type="email" id="email" name="email" placeholder="nama@email.com">

                        </div>

                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <div class="label-row">

                            <label for="password">
                                Kata Sandi
                            </label>

                            <a href="#">
                                Lupa kata sandi?
                            </a>

                        </div>

                        <div class="input-wrapper">

                            <span class="input-icon">🔒</span>

                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi">

                            <button type="button" class="password-toggle">
                                ◉
                            </button>

                        </div>

                        @error('password')
                            <p>{{$message}}</p>
                        @enderror

                    </div>


                    <!-- REMEMBER -->

                    <label class="remember">

                        <input type="checkbox">

                        <span>Ingat saya di perangkat ini</span>

                    </label>


                    <!-- LOGIN -->

                    <button type="submit" class="btn-login">
                        Masuk
                    </button>
                </form>


                <!-- DIVIDER -->

                <div class="divider">

                    <span></span>

                    <p>atau masuk dengan</p>

                    <span></span>

                </div>


                <!-- GOOGLE -->

                <button type="button" class="btn-google">

                    <span class="google-icon">G</span>

                    <span>
                        Lanjutkan dengan Google
                    </span>

                </button>
                <!-- end form -->


                <!-- TERMS -->

                <p class="terms">
                    Dengan masuk, Anda menyetujui
                    <a href="#">Syarat Layanan</a>
                    dan
                    <a href="#">Kebijakan Privasi</a>
                    LAPORINFRA.
                </p>

            </div>

        </div>

    </div>

</body>

</html>
