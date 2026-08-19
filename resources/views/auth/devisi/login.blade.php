<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Devisi - LAPORINFRA</title>

    @vite('resources/css/auth/devisi/login.css')
</head>

<body>

    <main class="login-page">

        <!-- =========================
             LEFT - BRANDING
        ========================== -->
        <section class="login-brand">

            <div class="brand-overlay"></div>

            <div class="brand-content">

                <div class="brand-logo">
                    <div class="logo-icon">⚡</div>

                    <span>
                        LAPOR<span>INFRA</span>
                    </span>
                </div>


                <div class="brand-text">

                    <p class="brand-label">
                        PLATFORM PENGADUAN INFRASTRUKTUR
                    </p>

                    <h1>
                        Tindak Lanjuti<br>
                        Laporan<br>
                        Masyarakat
                    </h1>

                    <p class="brand-description">
                        Akses sistem untuk memproses dan menindaklanjuti
                        laporan kerusakan infrastruktur dari masyarakat
                        sesuai dengan tugas dan wilayah Anda.
                    </p>

                </div>


                <div class="brand-statistics">

                    <div class="stat">
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
                    </div>

                </div>

            </div>

        </section>


        <!-- =========================
             RIGHT - LOGIN
        ========================== -->
        <section class="login-form-section">

            <div class="login-container">

                <div class="login-header">

                    <h2>Masuk sebagai Devisi</h2>

                    <p>
                        Gunakan akun yang telah diberikan oleh administrator.
                    </p>

                </div>


                <!-- =========================
                     LOGIN FORM
                ========================== -->

                <form class="login-form">

                    <div class="form-group">

                        <label for="nim">
                            NIM
                        </label>

                        <input
                            type="text"
                            id="nim"
                            name="nim"
                            placeholder="Masukkan NIM Anda"
                        >

                    </div>


                    <div class="form-group">

                        <div class="password-label">

                            <label for="password">
                                Kata Sandi
                            </label>

                            <a href="#">
                                Lupa kata sandi?
                            </a>

                        </div>

                        <div class="password-input">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan kata sandi"
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                aria-label="Tampilkan kata sandi"
                            >
                                ◉
                            </button>

                        </div>

                    </div>


                    <div class="remember">

                        <label>
                            <input type="checkbox">

                            <span>
                                Ingat saya di perangkat ini
                            </span>
                        </label>

                    </div>


                    <button
                        type="submit"
                        class="login-button"
                    >
                        Masuk
                    </button>

                </form>


                <!-- =========================
                     DIVIDER
                ========================== -->

                <div class="divider">
                    <span>atau masuk dengan</span>
                </div>


                <!-- =========================
                     GOOGLE LOGIN
                ========================== -->

                <button
                    type="button"
                    class="google-button"
                >

                    <span class="google-icon">
                        G
                    </span>

                    <span>
                        Lanjutkan dengan Google
                    </span>

                </button>


                <!-- =========================
                     ACCOUNT INFO
                ========================== -->

                <div class="devisi-info">

                    <div class="info-icon">
                        i
                    </div>

                    <p>
                        Akun devisi dibuat dan dikelola oleh
                        administrator sistem. Jika Anda belum
                        memiliki akun, silakan hubungi admin.
                    </p>

                </div>


                <p class="login-notice">

                    Dengan masuk, Anda menyetujui
                    <a href="#">Syarat Layanan</a>
                    dan
                    <a href="#">Kebijakan Privasi</a>
                    LAPORINFRA.

                </p>

            </div>

        </section>

    </main>

</body>
</html>