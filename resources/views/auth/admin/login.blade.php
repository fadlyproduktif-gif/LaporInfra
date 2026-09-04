<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - LAPORINFRA</title>

    @vite('resources/css/auth/admin/login.css')
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

                    <span>LAPOR<span>INFRA</span></span>
                </div>

                <div class="brand-text">

                    <p class="brand-label">
                        PLATFORM PENGADUAN INFRASTRUKTUR
                    </p>

                    <h1>
                        Kelola Pengaduan<br>
                        Infrastruktur<br>
                        Masyarakat
                    </h1>

                    <p class="brand-description">
                        Bersama kita membangun Indonesia yang lebih baik.
                        Kelola laporan masyarakat dan pastikan setiap
                        pengaduan mendapatkan tindak lanjut yang tepat.
                    </p>

                </div>

                <div class="brand-statistics">
{{-- 
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
                    </div> --}}

                </div>

            </div>

        </section>


        <!-- =========================
             RIGHT - LOGIN
        ========================== -->
        <section class="login-form-section">

            <div class="login-container">

                <div class="login-header">

                    <h2>Masuk sebagai Admin</h2>

                    <p>
                        Silakan masuk menggunakan akun Google Anda.
                    </p>

                </div>


                <!-- Google Login -->
                <div class="google-login">

                    <a href="{{route('admin.google.redirect')}}" class="google-button">

                        <span class="google-icon">G</span>

                        <span>
                            Lanjutkan dengan Google
                        </span>

                    </a>

                </div>


                <div class="divider">
                    <span>akses khusus administrator</span>
                </div>


                <div class="admin-info">

                    <div class="info-icon">
                        ✓
                    </div>

                    <div>
                        <strong>Akun Administrator</strong>

                        <p>
                            Gunakan akun Google administrator
                            yang telah terdaftar pada sistem.
                        </p>
                    </div>

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