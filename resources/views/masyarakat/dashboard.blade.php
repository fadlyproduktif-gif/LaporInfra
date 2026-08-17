<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Masyarakat - LAPORINFRA</title>

   @vite('resources/css/masyarakat.css')
</head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Masyarakat - LAPORINFRA</title>

    @vite('resources/css/masyarakat.css')
</head>

<body>

    <!-- Navbar -->
    <header class="navbar">

        <div class="navbar-left">
            <div class="logo-icon">⚡</div>
            <div class="logo-text">
                LAPOR<span>INFRA</span>
            </div>
        </div>

        <nav class="navbar-menu">
            <a href="#" class="active">Beranda</a>
            <a href="#">Laporan Saya</a>
        </nav>

        <div class="user-menu">
            <div class="user-avatar">F</div>

            <span>Fadly</span>

            <span class="arrow">⌄</span>
        </div>

    </header>


    <!-- Main Content -->
    <main class="container">

        <!-- Welcome -->
        <section class="welcome">
            <h1>Selamat datang, Fadly!</h1>

            <p>
                Gunakan LAPORINFRA untuk melaporkan kerusakan
                infrastruktur di sekitar Anda dan memantau status penanganannya.
            </p>
        </section>


        <!-- Create Report Banner -->
        <section class="report-banner">

            <div class="report-banner-content">

                <div class="report-icon">
                    🗺
                </div>

                <div>
                    <h2>Laporkan Infrastruktur Rusak</h2>

                    <p>
                        Sampaikan laporan kerusakan infrastruktur di lingkungan
                        Anda. Setiap laporan akan ditindaklanjuti oleh pihak
                        yang berwenang.
                    </p>
                </div>

            </div>

            <a href="#" class="btn-create">
                + &nbsp; Buat Laporan
            </a>

        </section>


        <!-- Report Header -->
        <section class="reports-section">

            <div class="reports-header">

                <h2>
                    Laporan Saya
                    <span class="report-count">3</span>
                </h2>

                <a href="#" class="view-all">
                    Lihat Semua
                </a>

            </div>


            <!-- Status Legend -->
            <div class="status-legend">

                <span>
                    <i class="dot waiting"></i>
                    Menunggu
                </span>

                <span>
                    <i class="dot processing"></i>
                    Sedang Diproses
                </span>

                <span>
                    <i class="dot completed"></i>
                    Selesai
                </span>

            </div>


            <!-- Report Card 1 -->
            <article class="report-card processing-card">

                <div class="report-number">
                    1
                </div>

                <div class="report-info">

                    <h3>
                        Jalan Berlubang di Jl. Merdeka No. 12
                    </h3>

                    <div class="report-meta">

                        <span class="category">
                            ◇ Jalan & Trotoar
                        </span>

                        <span>
                            ▣ 10 Agustus 2026
                        </span>

                    </div>

                </div>

                <div class="report-action">

                    <span class="status processing-status">
                        ● Sedang Diproses
                    </span>

                    <a href="#" class="btn-detail">
                        Lihat Detail
                    </a>

                </div>

            </article>


            <!-- Report Card 2 -->
            <article class="report-card waiting-card">

                <div class="report-number">
                    2
                </div>

                <div class="report-info">

                    <h3>
                        Lampu Jalan Mati Sejak 2 Minggu Lalu
                    </h3>

                    <div class="report-meta">

                        <span class="category">
                            ◇ Penerangan Jalan
                        </span>

                        <span>
                            ▣ 5 Agustus 2026
                        </span>

                    </div>

                </div>

                <div class="report-action">

                    <span class="status waiting-status">
                        ● Menunggu
                    </span>

                    <a href="#" class="btn-detail">
                        Lihat Detail
                    </a>

                </div>

            </article>


            <!-- Report Card 3 -->
            <article class="report-card completed-card">

                <div class="report-number">
                    3
                </div>

                <div class="report-info">

                    <h3>
                        Saluran Air Tersumbat di Gang Melati RT 04
                    </h3>

                    <div class="report-meta">

                        <span class="category">
                            ◇ Drainase & Sanitasi
                        </span>

                        <span>
                            ▣ 28 Juli 2026
                        </span>

                    </div>

                </div>

                <div class="report-action">

                    <span class="status completed-status">
                        ● Selesai
                    </span>

                    <a href="#" class="btn-detail">
                        Lihat Detail
                    </a>

                </div>

            </article>

        </section>

    </main>


    <!-- Footer -->
    <footer class="footer">

        <span>
            © 2026 LAPORINFRA — Sistem Pengaduan Infrastruktur Publik
        </span>

        <span>
            Layanan Publik Republik Indonesia
        </span>

    </footer>

</body>
</html>