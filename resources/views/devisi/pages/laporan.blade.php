@extends('devisi.layouts.app')

@section('title', 'Laporan')
@section('breadcrumb', 'PUPR')
@section('page_title', 'Daftar Laporan')

@push('styles')
    @vite('resources/css/devisi/laporan.css')
@endpush

@section('content')
    <div class="page-intro">
        <div>
            <h2>Daftar Laporan</h2>
            <p>Laporan infrastruktur yang ditujukan kepada divisi PUPR.</p>
        </div>

        <div class="total-badge">
            <span>▤</span>
            <span>{{ $laporan->count() }}</span>
            <span>Laporan</span>
        </div>
    </div>

    <section class="filter-card">
        <form action="{{ url('/devisi/laporan') }}" method="GET" class="filter-form">
            <label class="search-box">
                <span>⌕</span>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari laporan atau lokasi..."
                    aria-label="Cari laporan atau lokasi">
            </label>

            <select name="status" aria-label="Filter status">
                <option value="">Semua Status</option>
                @forelse ($status as $item)
                    <option value="{{ $item->id_status }}">{{ $item->nama_status }}</option>

                @empty
                    <option>belum ada</option>
                @endforelse

            </select>

            <button type="submit" class="btn-filter">Filter</button>
        </form>
    </section>

    <section class="report-table-card">
        <div class="table-wrap">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Laporan</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($laporan as $index => $item)
                        <tr>
                            <td class="number-cell">{{ $index + 1 }}</td>

                            <td class="name-cell">
                                {{ $item->nama_laporan }}
                            </td>

                            <td>
                                <span class="category-pill">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </td>

                            <td class="location-cell">
                                {{ $item->lokasi }}
                            </td>

                            <td>
                                <span class="status-pill status-{{ $item->statusLaporan->nama_status }}">
                                    {{ $item->statusLaporan->nama_status }}
                                </span>
                            </td>

                            <td class="date-cell">
                                {{ $item->created_at }}
                            </td>

                            <td>
                                <a href="{{ route('devisi.detail-laporan', $item->id_laporan) }}" class="btn-detail">
                                    <span>◉</span>
                                    Lihat &amp; Tangani
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                Belum ada laporan yang ditujukan kepada divisi ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            Menampilkan <strong>{{ $laporan->count() }}</strong>
            laporan
        </div>
    </section>
@endsection
