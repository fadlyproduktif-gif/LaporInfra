@extends('admin.layouts.app')

@section('title', 'Daftar Laporan')

@section('content')


@push('styles')

    @vite('resources/css/admin/laporan.css')

@endpush

<div class="admin-page">

    <div class="page-header">
        <div>
            <div class="breadcrumb">
                Admin System
            </div>

            <h1>Daftar Laporan</h1>

            <p>
                Semua laporan masuk dari masyarakat — hanya dapat dilihat.
            </p>
        </div>

        <div class="page-badge">
            <span>▤</span>
            3 Laporan
        </div>
    </div>


    {{-- Filter --}}
    <div class="report-filter">

        <div class="search-box">
            <span>⌕</span>

            <input
                type="text"
                placeholder="Cari nama laporan atau lokasi..."
            >
        </div>

        <select>
            <option>Semua Kategori</option>
            <option>Jalan & Trotoar</option>
            <option>Jembatan</option>
            <option>Drainase & Sanitasi</option>
            <option>Penerangan Jalan</option>
            <option>Fasilitas Umum</option>
            <option>Taman & RTH</option>
            <option>Lainnya</option>
        </select>

        <select>
            <option>Semua Status</option>
            <option>Menunggu</option>
            <option>Sedang Diproses</option>
            <option>Selesai</option>
        </select>

    </div>


    {{-- Table --}}
    <div class="report-table-wrapper">

        <table class="report-table">

            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NAMA LAPORAN</th>
                    <th>KATEGORI</th>
                    <th>LOKASI</th>
                    <th>STATUS</th>
                    <th>TANGGAL LAPORAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>

                    <td>
                        <strong>
                            Jalan Berlubang di Jl. Merdeka No. 12
                        </strong>
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
                        <span class="status-badge status-process">
                            ● Sedang Diproses
                        </span>
                    </td>

                    <td>
                        10 Agustus 2026
                    </td>

                    <td>
                        <a
                            href="{{ route('admin.laporan.show', ['id' => 1] ) }}"
                           class="btn-detail"
                        >
                            ◉
                            <span>Lihat Detail</span>
                        </a>
                    </td>
                </tr>


                <tr>
                    <td>2</td>

                    <td>
                        <strong>
                            Lampu Jalan Mati Sejak 2 Minggu Lalu
                        </strong>
                    </td>

                    <td>
                        <span class="category-badge">
                            Penerangan Jalan
                        </span>
                    </td>

                    <td>
                        Jl. Ahmad Yani
                    </td>

                    <td>
                        <span class="status-badge status-waiting">
                            ● Menunggu
                        </span>
                    </td>

                    <td>
                        5 Agustus 2026
                    </td>

                    <td>
                        <a
                            href="{{ route('admin.laporan.show', 2) }}"
                            class="btn-detail"
                        >
                            ◉
                            <span>Lihat Detail</span>
                        </a>
                    </td>
                </tr>


                <tr>
                    <td>3</td>

                    <td>
                        <strong>
                            Saluran Air Tersumbat di Gang Melati
                        </strong>
                    </td>

                    <td>
                        <span class="category-badge">
                            Drainase & Sanitasi
                        </span>
                    </td>

                    <td>
                        Gang Melati RT 04
                    </td>

                    <td>
                        <span class="status-badge status-success">
                            ● Selesai
                        </span>
                    </td>

                    <td>
                        28 Juli 2026
                    </td>

                    <td>
                        <a
                            href="{{ route('admin.laporan.show', 3) }}"
                            class="btn-detail"
                        >
                            ◉
                            <span>Lihat Detail</span>
                        </a>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>


    <div class="table-footer">
        Menampilkan 3 dari 3 laporan
    </div>

</div>

@endsection