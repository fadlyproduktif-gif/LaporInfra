@extends('devisi.layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    @vite('resources/css/devisi/detail-laporan.css')
@endpush

@section('content')

<main class="detail-page">

    <!-- =========================
         TOP HEADER
    ========================== -->

    <div class="detail-top">

        <div class="detail-breadcrumb">
            <a href="#">
                ← Kembali ke Daftar Laporan
            </a>
        </div>

        <div class="detail-heading">

            <div>
                <h1>Detail & Penanganan Laporan</h1>

                <p>
                    Dilaporkan pada 10 Agustus 2026
                    <span>•</span>
                    Diperbarui 10 Agustus 2026
                </p>
            </div>

            <div class="status-badge status-waiting">
                <span></span>
                Menunggu
            </div>

        </div>

    </div>


    <!-- =========================
         CONTENT GRID
    ========================== -->

    <div class="detail-grid">

        <!-- =========================
             LEFT CONTENT
        ========================== -->

        <div class="detail-main">

            <!-- INFORMASI LAPORAN -->

            <section class="detail-card">

                <div class="card-header">

                    <div class="card-icon">
                        ▤
                    </div>

                    <h2>Informasi Laporan</h2>

                </div>

                <div class="card-body">

                    <div class="info-row">

                        <div class="info-label">
                            NAMA LAPORAN
                        </div>

                        <div class="info-value">
                            Jalan Berlubang di Jl. Merdeka No. 12
                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            KATEGORI
                        </div>

                        <div class="info-value">

                            <span class="category-badge">
                                Jalan & Trotoar
                            </span>

                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            LOKASI
                        </div>

                        <div class="info-value">
                            Jl. Merdeka No. 12,
                            Kel. Sudirman,
                            Kec. Menteng
                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            TANGGAL
                        </div>

                        <div class="info-value">
                            10 Agustus 2026
                        </div>

                    </div>

                </div>

            </section>


            <!-- DESKRIPSI -->

            <section class="detail-card">

                <div class="card-header">

                    <div class="card-icon">
                        ≡
                    </div>

                    <h2>Deskripsi Laporan</h2>

                </div>

                <div class="card-body description-body">

                    <p>
                        Terdapat jalan berlubang yang cukup besar
                        di Jl. Merdeka No. 12. Kondisi ini cukup
                        mengganggu pengguna jalan dan berpotensi
                        membahayakan pengendara terutama pada malam hari.
                    </p>

                </div>

            </section>


            <!-- FOTO LOKASI -->

            <section class="detail-card photo-card">

                <div class="card-header">

                    <div class="card-icon">
                        ▧
                    </div>

                    <h2>Foto Lokasi</h2>

                </div>

                <div class="card-body photo-body">

                    <img
                        src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=80"
                        alt="Foto lokasi laporan"
                    >

                </div>

            </section>


            <!-- BOTTOM BUTTON -->

            <div class="detail-bottom">

                <a href="#" class="back-button">
                    ←
                    Kembali ke Daftar Laporan
                </a>

            </div>

        </div>


        <!-- =========================
             RIGHT SIDEBAR
        ========================== -->

        <aside class="detail-side">

            <!-- INFORMASI PELAPOR -->

            <section class="detail-card reporter-card">

                <div class="card-header">

                    <div class="card-icon">
                        ♙
                    </div>

                    <h2>Informasi Pelapor</h2>

                </div>

                <div class="card-body">

                    <div class="reporter-info">

                        <span class="small-label">
                            PELAPOR
                        </span>

                        <div class="reporter-name">

                            <div class="reporter-avatar">
                                F
                            </div>

                            <strong>
                                Fadly
                            </strong>

                        </div>

                    </div>


                    <div class="reporter-info">

                        <span class="small-label">
                            EMAIL
                        </span>

                        <p>
                            fadly@example.com
                        </p>

                    </div>

                </div>

            </section>


            <!-- PENANGANAN -->

            <section class="detail-card handling-card">

                <div class="card-header">

                    <div class="card-icon">
                        ✎
                    </div>

                    <h2>Penanganan Laporan</h2>

                </div>

                <div class="card-body">

                    <div class="form-group">

                        <label>
                            UBAH STATUS
                        </label>

                        <select>
                            <option selected>Menunggu</option>
                            <option>Sedang Diproses</option>
                            <option>Selesai</option>
                        </select>

                    </div>


                    <div class="form-group">

                        <label>
                            KETERANGAN PROGRESS
                        </label>

                        <textarea
                            rows="5"
                            placeholder="Masukkan keterangan progress..."
                        >Laporan telah diterima dan akan segera ditindaklanjuti.</textarea>

                    </div>


                    <button
                        type="button"
                        class="save-button"
                    >
                        Simpan Penanganan
                    </button>


                    <div class="last-update">

                        ◷
                        Terakhir diperbarui
                        10 Agustus 2026

                    </div>

                </div>

            </section>

        </aside>

    </div>

</main>

@endsection