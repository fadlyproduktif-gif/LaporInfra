@extends('devisi.layouts.app')


@section('title', 'Dashboard OPD')
@vite('resources/js/devisi-dashboard.js')

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
                        OPD AKTIF
                    </span>

                    <h2>
                        {{ Auth::User()->devisi->nama_devisi }}
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
                            {{ $totalLaporan }}
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
                            {{ $menunggu }}
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
                            {{ $dikerjakan }}
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
                            {{ $selesai }}
                        </strong>

                        <span>
                            Selesai
                        </span>

                    </div>

                </article>

            </div>

            <div class="summary-grid summary-grid-secondary">
                <article class="summary-card">

                    <div class="summary-icon accepted-icon">
                        ✓
                    </div>

                    <div class="summary-info">

                        <strong>
                            {{ $terima }}
                        </strong>
                        <span>
                            Diterima
                        </span>

                    </div>

                </article>

                <article class="summary-card">

                    <div class="summary-icon postponed-icon">
                        ◷
                    </div>

                    <div class="summary-info">

                        <strong>
                            {{ $tunda }}
                        </strong>

                        <span>
                            Ditunda
                        </span>

                    </div>

                </article>

                <article class="summary-card">

                    <div class="summary-icon rejected-icon">
                        ×
                    </div>

                    <div class="summary-info">

                        <strong>
                            {{ $tolak }}
                        </strong>

                        <span>
                            Ditolak
                        </span>

                    </div>

                </article>
            </div>
            <br>

            <section class="chart-card">

                <div class="chart-header">
                    <div>
                        <h2>Pemantauan Laporan Masuk</h2>
                        <p>Jumlah laporan yang masuk berdasarkan kategori.</p>
                    </div>

                    <div>
                        <span>Total laporan masuk {{$periode}} ini</span>
                        <strong>{{ $totalLaporanPeriode }} laporan</strong>
                    </div>

                    <form action="{{ route('devisi.dashboard') }}" method="get">
                        <select id="periode-chart" name="periode">
                            <option value="minggu" @selected($periode === 'minggu')>Minggu</option>
                            <option value="bulan" @selected($periode === 'bulan')>Bulan</option>
                            <option value="tahun" @selected($periode === 'tahun')>Tahun</option>
                        </select>

                        <button type="submit">
                            filter
                        </button>
                    </form>
                </div>
                <div class="chart-wrapper">
                    <canvas id="laporanChart"></canvas>
                </div>

            </section>
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


                <a href="{{ route('devisi.laporan') }}" class="view-all-reports">
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

                        @forelse ($laporanR as $item)
                            <tr>

                                <td>
                                    {{ $item->nama_laporan }}
                                </td>

                                <td>
                                    <span class="category-badge">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->lokasi }}
                                </td>
                                @php
                                    $statusKey = match ($item->id_status) {
                                        1 => 'waiting',
                                        2 => 'postponed',
                                        3 => 'rejected',
                                        4 => 'accepted',
                                        5 => 'processing',
                                        6 => 'completed',
                                        default => 'unknow',
                                    };
                                @endphp
                                <td>

                                    <span class="status-pill status-{{ $statusKey }}">
                                        ● {{ $item->statuslaporan->nama_status }}

                                    </span>

                                </td>

                                <td>
                                    {{ $item->created_at }}
                                </td>

                                <td>

                                    <a href="{{ route('devisi.detail-laporan', $item->id_laporan) }}"
                                        class="report-action-button">
                                        ✎ &nbsp; Lihat & Tangani
                                    </a>

                                </td>

                            </tr>
                        @empty
                        @endforelse



                    </tbody>

                </table>

            </div>

        </section>

    </div>

    <script>
        window.dataGrafik = @json($dataGrafik);
    </script>

@endsection
