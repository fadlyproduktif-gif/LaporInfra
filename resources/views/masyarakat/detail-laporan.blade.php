@extends('masyarakat.layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    @vite('resources/css/masyarakat/detail-laporan.css')
@endpush

@section('content')

<main class="detail-container">

    <!-- Back -->
    <a href="#" class="back-link">
        ← Kembali ke Laporan Saya
    </a>


    <!-- Header -->
    <section class="detail-header">

        <div>

            <h1>
                Jalan Berlubang di Jl. Merdeka No. 12
            </h1>

            <p>
                Dilaporkan pada 10 Agustus 2026
                ·
                Diperbarui 12 Agustus 2026
            </p>

        </div>


        <span class="detail-status">
            ● Sedang Diproses
        </span>

    </section>


    <!-- Detail Layout -->
    <div class="detail-layout">


        <!-- LEFT -->
        <div class="detail-main">


            <!-- Informasi -->
            <section class="detail-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ⓘ
                    </div>

                    <h2>
                        Informasi Laporan
                    </h2>

                </div>


                <div class="detail-information">

                    <div class="information-row">

                        <span class="information-label">
                            KATEGORI
                        </span>

                        <span>
                            Jalan & Trotoar
                        </span>

                    </div>


                    <div class="information-row">

                        <span class="information-label">
                            LOKASI
                        </span>

                        <span>
                            Jl. Merdeka No. 12,
                            Kel. Sudirman,
                            Kec. Menteng
                        </span>

                    </div>


                    <div class="information-row">

                        <span class="information-label">
                            TANGGAL LAPORAN
                        </span>

                        <span>
                            10 Agustus 2026
                        </span>

                    </div>


                    <div class="information-row">

                        <span class="information-label">
                            TERAKHIR DIPERBARUI
                        </span>

                        <span>
                            12 Agustus 2026
                        </span>

                    </div>

                </div>

            </section>


            <!-- Foto -->
            <section class="detail-card photo-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ▧
                    </div>

                    <h2>
                        Foto Lokasi
                    </h2>

                </div>


                <div class="photo-wrapper">

                    <img
                        src="https://images.unsplash.com/photo-1519501025264-65ba15a82390"
                        alt="Foto lokasi laporan"
                    >

                </div>

            </section>


            <!-- Deskripsi -->
            <section class="detail-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ≡
                    </div>

                    <h2>
                        Deskripsi Laporan
                    </h2>

                </div>


                <div class="description-content">

                    <p>
                        Terdapat beberapa lubang pada badan jalan
                        yang cukup mengganggu pengguna jalan.
                        Lubang berukuran sekitar 30–50 cm dengan
                        kedalaman ±10 cm. Kondisi ini berpotensi
                        menyebabkan kecelakaan terutama pada malam
                        hari saat penerangan minim.
                    </p>

                </div>

            </section>

        </div>


        <!-- RIGHT -->
        <aside class="detail-sidebar">

            <section class="status-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ✓
                    </div>

                    <h2>
                        Status Laporan
                    </h2>

                </div>


                <div class="status-content">

                    <span class="status-label">
                        STATUS SAAT INI
                    </span>

                    <span class="detail-status">
                        ● Sedang Diproses
                    </span>


                    <span class="status-label progress-label">
                        KETERANGAN PROGRESS
                    </span>

                    <div class="progress-box">

                        Sedang dilakukan pemeriksaan
                        lokasi oleh petugas Dinas PUPR.

                    </div>


                    <div class="updated-info">

                        Terakhir diperbarui pada
                        12 Agustus 2026

                    </div>

                </div>

            </section>

        </aside>

    </div>

</main>

@endsection