@extends('admin.layouts.app')


@section('title', 'Dashboard Admin')


@section('page-title', 'Dashboard Admin')


@section('page-description', 'Kelola data dan pantau sistem pelaporan LAPORINFRA.')


@push('styles')
    @vite('resources/css/admin/dashboard.css')
@endpush


@section('content')

    {{-- ==========================
         RINGKASAN
    =========================== --}}

    <section class="dashboard-section">

        <h2>
            Ringkasan
        </h2>


        <div class="summary-grid">

            {{-- Total Akun --}}
            <article class="summary-card">

                <div class="summary-icon">
                    ♙
                </div>

                <div>

                    <strong>
                        {{ $totalAkun }}
                    </strong>

                    <span>
                        Total Akun
                    </span>

                </div>

            </article>


            {{-- Total Devisi --}}
            <article class="summary-card">

                <div class="summary-icon">
                    ▥
                </div>

                <div>

                    <strong>
                        {{ $totalDevisi }}
                    </strong>

                    <span>
                        Total OPD
                    </span>

                </div>

            </article>


            {{-- Total Kategori --}}
            <article class="summary-card">

                <div class="summary-icon">
                    ◇
                </div>

                <div>

                    <strong>
                        {{ $totalKategori }}
                    </strong>

                    <span>
                        Total Kategori
                    </span>

                </div>

            </article>

        </div>

    </section>


    {{-- ==========================
         LAPORAN TERBARU
    =========================== --}}

    <section class="reports-card">

        <div class="card-header">

            <div>

                <h2>
                    Laporan Terbaru
                </h2>

                <h6>
                    {{ $laporan->count() }} laporan terbaru
                </h6>

                <p>
                    Daftar laporan terbaru yang dapat
                    dilihat oleh administrator.
                </p>

            </div>


            <span class="readonly-badge">
                ◉ &nbsp; Hanya Baca
            </span>

        </div>


        <div class="table-wrap">

            <table class="reports-table">

                <thead>

                    <tr>

                        <th>
                            Nama Laporan
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Lokasi
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Tanggal Laporan
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($laporan as $item)
                        <tr>

                            <td>

                                <strong>
                                    {{ $item->nama_laporan }}
                                </strong>

                            </td>


                            <td>

                                <span class="category-tag">

                                    {{ $item->kategori->nama_kategori }}

                                </span>

                            </td>


                            <td>

                                {{ $item->lokasi }}

                            </td>


                            <td>

                                <span class="status-badge">

                                    {{ $item->statusLaporan->nama_status }}

                                </span>

                            </td>


                            <td>

                                {{ $item->created_at }}

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="5" class="empty-state">
                                Belum ada laporan terbaru.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

@endsection
