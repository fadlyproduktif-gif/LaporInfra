@extends('devisi.layouts.app')

@section('title', 'Dashboard Devisi')

@push('styles')
    @vite('resources/css/devisi/dashboard.css')
@endpush

@section('content')

<div class="dashboard-header">
    <div>
        <h1>Dashboard Devisi</h1>
        <p>Kelola dan pantau laporan infrastruktur untuk divisi PUPR.</p>
    </div>

    <div class="division-user">
        <span class="division-badge">PUPR</span>

        <div class="user-info">
            <strong>Admin Devisi</strong>
            <small>pupr@laporinfra.go.id</small>
        </div>

        <div class="user-avatar">
            P
        </div>
    </div>
</div>


<div class="division-card">

    <div class="division-icon">
        🏢
    </div>

    <div class="division-info">
        <span>DIVISI AKTIF</span>
        <strong>
            Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)
        </strong>
    </div>

    <span class="status-active">
        ● AKTIF
    </span>

</div>


<section class="summary-section">

    <h2>Ringkasan</h2>

    <div class="summary-grid">

        <div class="summary-card">
            <div class="summary-icon">
                📄
            </div>

            <div>
                <strong>25</strong>
                <span>Total Laporan</span>
            </div>
        </div>


        <div class="summary-card">
            <div class="summary-icon">
                🕐
            </div>

            <div>
                <strong>8</strong>
                <span>Menunggu</span>
            </div>
        </div>


        <div class="summary-card">
            <div class="summary-icon">
                ⚙
            </div>

            <div>
                <strong>5</strong>
                <span>Sedang Diproses</span>
            </div>
        </div>


        <div class="summary-card">
            <div class="summary-icon">
                ✓
            </div>

            <div>
                <strong>12</strong>
                <span>Selesai</span>
            </div>
        </div>

    </div>

</section>


<section class="reports-section">

    <div class="section-header">
        <div>
            <h2>Laporan Terbaru</h2>
            <p>Laporan terbaru yang ditujukan kepada divisi PUPR.</p>
        </div>

        <a href="#">
            Lihat Semua →
        </a>
    </div>


    <div class="reports-table">

        <div class="table-header">
            <span>NAMA LAPORAN</span>
            <span>KATEGORI</span>
            <span>LOKASI</span>
            <span>STATUS</span>
            <span>TANGGAL</span>
            <span></span>
        </div>


        <div class="table-row">

            <strong>
                Jalan Berlubang di Jl. Merdeka
            </strong>

            <span class="category">
                Jalan & Trotoar
            </span>

            <span>
                Jl. Merdeka No. 12
            </span>

            <span class="status waiting">
                ● Menunggu
            </span>

            <span>
                10 Agustus 2026
            </span>

            <a href="#" class="action-button">
                Lihat & Tangani
            </a>

        </div>


        <div class="table-row">

            <strong>
                Drainase Rusak di Jl. Sudirman
            </strong>

            <span class="category">
                Drainase & Sanitasi
            </span>

            <span>
                Jl. Sudirman
            </span>

            <span class="status processing">
                ● Sedang Diproses
            </span>

            <span>
                8 Agustus 2026
            </span>

            <a href="#" class="action-button">
                Lihat & Tangani
            </a>

        </div>


        <div class="table-row">

            <strong>
                Trotoar Rusak di Jl. Ahmad Yani
            </strong>

            <span class="category">
                Jalan & Trotoar
            </span>

            <span>
                Jl. Ahmad Yani
            </span>

            <span class="status completed">
                ● Selesai
            </span>

            <span>
                5 Agustus 2026
            </span>

            <a href="#" class="action-button">
                Lihat & Tangani
            </a>

        </div>

    </div>

</section>

@endsection