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
                            {{ $total }}
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
                            {{$menunggu}}
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
                            {{$dikerjakan}}
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
                            {{$selesai}}
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

                                <td>

                                    <span class="status-badge status-waiting">
                                        ● {{ $item->statuslaporan->nama_status }}

                                    </span>

                                </td>

                                <td>
                                    {{$item->created_at}}
                                </td>

                                <td>

                                    <a href="{{route('devisi.detail-laporan', $item->id_laporan)}}" class="report-action-button">
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

@endsection
