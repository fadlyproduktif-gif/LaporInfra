@extends('devisi.layouts.app')


@section('title', 'Dashboard Devisi')


@section('content')

<div class="dashboard-container">


    <!-- Division Active -->
    <section class="division-active-card">

        <div class="division-active-left">

            <div class="division-active-icon">
                ▦
            </div>

            <div>

                <span class="section-label">
                    DIVISI AKTIF
                </span>

                <h2>
                    Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)
                </h2>

            </div>

        </div>


        <span class="active-badge">
            ● AKTIF
        </span>

    </section>



    <!-- Summary -->
    <section class="summary-section">

        <h2 class="summary-title">
            Ringkasan
        </h2>


        <div class="summary-grid">


            <!-- Total -->
            <article class="summary-card">

                <div class="summary-icon">
                    ▣
                </div>

                <div class="summary-info">

                    <strong>
                        25
                    </strong>

                    <span>
                        Total Laporan
                    </span>

                </div>

            </article>



            <!-- Waiting -->
            <article class="summary-card">

                <div class="summary-icon waiting-icon">
                    ◷
                </div>

                <div class="summary-info">

                    <strong>
                        8
                    </strong>

                    <span>
                        Menunggu
                    </span>

                </div>

            </article>



            <!-- Processing -->
            <article class="summary-card">

                <div class="summary-icon processing-icon">
                    ⚙
                </div>

                <div class="summary-info">

                    <strong>
                        5
                    </strong>

                    <span>
                        Sedang Diproses
                    </span>

                </div>

            </article>



            <!-- Completed -->
            <article class="summary-card">

                <div class="summary-icon completed-icon">
                    ✓
                </div>

                <div class="summary-info">

                    <strong>
                        12
                    </strong>

                    <span>
                        Selesai
                    </span>

                </div>

            </article>

        </div>

    </section>



    <!-- Latest Reports -->
    <section class="latest-reports-card">

        <div class="latest-reports-header">

            <div>

                <h2>
                    Laporan Terbaru
                </h2>

                <p>
                    Laporan terbaru yang ditujukan kepada divisi PUPR.
                </p>

            </div>


            <a href="#" class="view-all-reports">
                Lihat Semua
                <span>›</span>
            </a>

        </div>



        <!-- Table -->
        <div class="reports-table-wrapper">

            <table class="reports-table">

                <thead>

                    <tr>

                        <th>
                            NAMA LAPORAN
                        </th>

                        <th>
                            KATEGORI
                        </th>

                        <th>
                            LOKASI
                        </th>

                        <th>
                            STATUS
                        </th>

                        <th>
                            TANGGAL
                        </th>

                        <th>
                            AKSI
                        </th>

                    </tr>

                </thead>


                <tbody>


                    <!-- Report 1 -->
                    <tr>

                        <td>
                            Jalan Berlubang di Jl. Merdeka...
                        </td>

                        <td>
                            <span class="category-badge">
                                Jalan & Trotoar
                            </span>
                        </td>

                        <td>
                            Jl. Merdeka No. 12
                        </td>

                        <td>

                            <span class="status-badge status-waiting">
                                ● Menunggu
                            </span>

                        </td>

                        <td>
                            10 Agustus 2026
                        </td>

                        <td>

                            <a href="#" class="report-action-button">
                                ✎ &nbsp; Lihat & Tangani
                            </a>

                        </td>

                    </tr>



                    <!-- Report 2 -->
                    <tr>

                        <td>
                            Drainase Rusak di Jl. Sudirman...
                        </td>

                        <td>
                            <span class="category-badge">
                                Drainase & Sanitasi
                            </span>
                        </td>

                        <td>
                            Jl. Sudirman
                        </td>

                        <td>

                            <span class="status-badge status-processing">
                                ● Sedang Diproses
                            </span>

                        </td>

                        <td>
                            8 Agustus 2026
                        </td>

                        <td>

                            <a href="#" class="report-action-button">
                                ✎ &nbsp; Lihat & Tangani
                            </a>

                        </td>

                    </tr>



                    <!-- Report 3 -->
                    <tr>

                        <td>
                            Trotoar Rusak di Jl. Ahmad Yani...
                        </td>

                        <td>
                            <span class="category-badge">
                                Jalan & Trotoar
                            </span>
                        </td>

                        <td>
                            Jl. Ahmad Yani
                        </td>

                        <td>

                            <span class="status-badge status-completed">
                                ● Selesai
                            </span>

                        </td>

                        <td>
                            5 Agustus 2026
                        </td>

                        <td>

                            <a href="#" class="report-action-button">
                                ✎ &nbsp; Lihat & Tangani
                            </a>

                        </td>

                    </tr>


                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection