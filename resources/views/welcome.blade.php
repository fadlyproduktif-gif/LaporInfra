<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LAPORINFRA - Sistem Pelaporan Infrastruktur</title>

    @vite('resources/css/home.css')
</head>

<body>

    <!-- ================= HEADER ================= -->
    <header class="navbar">

        <div class="container navbar-content">

            <a href="{{ route('home') }}" class="logo">
                LAPOR<span>INFRA</span>
            </a>

            <nav class="nav-menu">
                <a href="#tentang">Tentang</a>
                <a href="#cara-kerja">Cara Kerja</a>
                <a href="#fitur">Fitur</a>

                <a href="{{ route('auth.masyarakat.login') }}" class="nav-login">
                    Login
                </a>
            </nav>

        </div>

    </header>


    <!-- ================= HERO ================= -->
    <main>

        <section class="hero">

            <div class="container hero-content">

                <div class="hero-text">

                    <span class="hero-badge">
                        Sistem Pelaporan Infrastruktur
                    </span>

                    <h1>
                        Laporkan Kerusakan
                        <span>Infrastruktur</span>
                        di Sekitar Anda
                    </h1>

                    <p>
                        Sampaikan laporan kerusakan infrastruktur
                        dengan mudah dan bantu pemerintah menangani
                        permasalahan di lingkungan Anda dengan lebih cepat.
                    </p>

                    <div class="hero-actions">

                        <a href="{{ route('auth.masyarakat.login') }}"
                           class="btn-primary">
                            Mulai Melapor
                            <span>→</span>
                        </a>

                        <a href="#cara-kerja"
                           class="btn-secondary">
                            Pelajari Selengkapnya
                        </a>

                    </div>

                </div>


                <div class="hero-visual">

                    <div class="illustration-card">

                        <div class="illustration-icon">
                            📍
                        </div>

                        <div class="illustration-content">
                            <strong>Laporan Infrastruktur</strong>
                            <span>Laporkan masalah di sekitar Anda</span>
                        </div>

                        <div class="status-dot"></div>

                    </div>

                    <div class="illustration-card card-small">

                        <div class="small-icon">
                            ✓
                        </div>

                        <div>
                            <strong>Laporan Diproses</strong>
                            <span>Tim terkait sedang menangani</span>
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- ================= TENTANG ================= -->
        <section class="section" id="tentang">

            <div class="container">

                <div class="section-heading">

                    <span>Tentang LAPORINFRA</span>

                    <h2>
                        Satu tempat untuk melaporkan
                        kerusakan infrastruktur
                    </h2>

                    <p>
                        LAPORINFRA membantu masyarakat menyampaikan
                        laporan kerusakan infrastruktur kepada bidang
                        terkait sehingga laporan dapat diproses dengan
                        lebih terarah.
                    </p>

                </div>


                <div class="feature-grid" id="fitur">

                    <div class="feature-card">

                        <div class="feature-icon">
                            📍
                        </div>

                        <h3>Lokasi Jelas</h3>

                        <p>
                            Sertakan lokasi kejadian agar laporan
                            lebih mudah ditemukan oleh petugas.
                        </p>

                    </div>


                    <div class="feature-card">

                        <div class="feature-icon">
                            📷
                        </div>

                        <h3>Bukti Foto</h3>

                        <p>
                            Tambahkan foto kerusakan sebagai
                            informasi pendukung laporan.
                        </p>

                    </div>


                    <div class="feature-card">

                        <div class="feature-icon">
                            📊
                        </div>

                        <h3>Pantau Laporan</h3>

                        <p>
                            Masyarakat dapat melihat perkembangan
                            dan status laporan yang telah dibuat.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- ================= CARA KERJA ================= -->
        <section class="section how-section" id="cara-kerja">

            <div class="container">

                <div class="section-heading">

                    <span>Cara Kerja</span>

                    <h2>
                        Melaporkan kerusakan jadi lebih mudah
                    </h2>

                    <p>
                        Proses pelaporan dirancang sederhana agar
                        masyarakat dapat membuat laporan tanpa
                        proses yang rumit.
                    </p>

                </div>


                <div class="steps">

                    <div class="step">

                        <div class="step-number">
                            01
                        </div>

                        <h3>Buat Laporan</h3>

                        <p>
                            Masukkan informasi kerusakan,
                            lokasi, deskripsi, dan foto.
                        </p>

                    </div>


                    <div class="step">

                        <div class="step-number">
                            02
                        </div>

                        <h3>Laporan Diteruskan</h3>

                        <p>
                            Laporan diteruskan kepada devisi
                            yang sesuai dengan kategorinya.
                        </p>

                    </div>


                    <div class="step">

                        <div class="step-number">
                            03
                        </div>

                        <h3>Laporan Diproses</h3>

                        <p>
                            Devisi terkait melakukan proses
                            penanganan laporan.
                        </p>

                    </div>


                    <div class="step">

                        <div class="step-number">
                            04
                        </div>

                        <h3>Pantau Status</h3>

                        <p>
                            Masyarakat dapat mengetahui
                            perkembangan laporan.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- ================= CTA ================= -->
        <section class="cta-section">

            <div class="container">

                <div class="cta-card">

                    <div>
                        <span class="cta-label">
                            Mari berkontribusi
                        </span>

                        <h2>
                            Temukan kerusakan?
                            Laporkan sekarang.
                        </h2>

                        <p>
                            Bantu menciptakan infrastruktur
                            yang lebih baik untuk lingkungan kita.
                        </p>
                    </div>

                    <a href="{{ route('auth.masyarakat.login') }}"
                       class="btn-white">
                        Mulai Melapor →
                    </a>

                </div>

            </div>

        </section>

    </main>


    <!-- ================= FOOTER ================= -->
    <footer class="footer">

        <div class="container footer-content">

            <div>
                <a href="{{ route('home') }}" class="logo footer-logo">
                    LAPOR<span>INFRA</span>
                </a>

                <p>
                    Sistem Pelaporan Kerusakan Infrastruktur.
                </p>
            </div>

            <div class="footer-copy">
                © 2026 LAPORINFRA. All rights reserved.
            </div>

        </div>

    </footer>

</body>
</html>