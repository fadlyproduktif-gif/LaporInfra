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
                {{ $laporan->count() }}
            </div>
        </div>


        {{-- Filter --}}
        <form action="{{ route('admin.laporan.index') }}" method="get">
            <div class="report-filter">

                <div class="search-box">
                    <span>⌕</span>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama laporan atau lokasi...">
                </div>

                <select name="kategori">
                    <option value="">Semua kategori</option>
                    @forelse ($kategori as $item)
                        <option value="{{ $item->id_kategori }}" @selected(request('kategori') == $item->id_kategori)>
                            {{ $item->nama_kategori }}
                        </option>
                    @empty
                    @endforelse
                </select>



                <select name="status">
                    <option value="">Semua Status</option>
                    @forelse ($status as $item)
                        <option value="{{ $item->id_status }}" @selected(request('status') == $item->id_status)>
                            {{ $item->nama_status }}
                        </option>
                    @empty
                    @endforelse
                </select>
                <button type="submit">
                    filter
                </button>
            </div>
        </form>


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
                    @forelse ($laporan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <strong>
                                    {{ $item->nama_laporan }}
                                </strong>
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
                                    default => 'unknown',
                                };
                            @endphp

                            <td>
                                <span class="status-badge status-{{ $statusKey }}">
                                    ● {{ $item->statusLaporan->nama_status }}
                                </span>
                            </td>

                            <td>
                                {{ $item->created_at }}
                            </td>

                            <td>
                                <a href="{{ route('admin.laporan.show', $item->id_laporan) }}" class="btn-detail">
                                    ◉
                                    <span>Lihat Detail</span>
                                </a>
                            </td>
                        </tr>

                    @empty
                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="table-footer">
            Menampilkan {{ $laporan->count() }} dari {{ $totalLaporan }} laporan
        </div>

    </div>

@endsection
