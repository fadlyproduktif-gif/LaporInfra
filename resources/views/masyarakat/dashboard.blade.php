@extends('masyarakat.layouts.app')

@section('title', 'Dashboard')

@push('styles')
    @vite('resources/css/masyarakat/dashboard.css')
@endpush

@section('content')

    <div class="container">

        <!-- Welcome -->
        <section class="welcome">

            <h1>
                Selamat datang, Fadly!
            </h1>

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

                    <h2>
                        Laporkan Infrastruktur Rusak
                    </h2>

                    <p>
                        Sampaikan laporan kerusakan infrastruktur di lingkungan
                        Anda. Setiap laporan akan ditindaklanjuti oleh pihak
                        yang berwenang.
                    </p>

                </div>

            </div>

            <a href="{{ url('/masyarakat/form-laporan') }}" class="btn-create">
                + &nbsp; Buat Laporan
            </a>

        </section>


        <!-- Reports -->
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


            <!-- Report 1 -->
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


            <!-- Report 2 -->
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


            <!-- Report 3 -->
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

    </div>

@endsection