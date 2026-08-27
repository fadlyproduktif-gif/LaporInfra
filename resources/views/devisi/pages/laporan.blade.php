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
        <span>3</span>
        <span>Laporan</span>
    </div>
</div>

<section class="filter-card">
    <form action="{{ url('/devisi/laporan') }}" method="GET" class="filter-form">
        <label class="search-box">
            <span>⌕</span>
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari laporan atau lokasi..."
                aria-label="Cari laporan atau lokasi">
        </label>

        <select name="status" aria-label="Filter status">
            <option value="">Semua Status</option>
            <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu</option>
            <option value="diproses" @selected(request('status') === 'diproses')>Sedang Diproses</option>
            <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
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
                @forelse(($reports ?? collect([
                    [
                        'id' => 1,
                        'name' => 'Jalan Berlubang di Jl. Merdeka No. 12',
                        'category' => 'Jalan & Trotoar',
                        'location' => 'Jl. Merdeka No. 12',
                        'status' => 'Sedang Diproses',
                        'status_key' => 'processing',
                        'date' => '10 Agustus 2026',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Lampu Jalan Mati Sejak 2 Minggu Lalu',
                        'category' => 'Penerangan Jalan',
                        'location' => 'Jl. Ahmad Yani',
                        'status' => 'Menunggu',
                        'status_key' => 'waiting',
                        'date' => '5 Agustus 2026',
                    ],
                    [
                        'id' => 3,
                        'name' => 'Saluran Air Tersumbat di Gang Melati RT 04',
                        'category' => 'Drainase & Sanitasi',
                        'location' => 'Gang Melati RT 04',
                        'status' => 'Selesai',
                        'status_key' => 'completed',
                        'date' => '28 Juli 2026',
                    ],
                ])) as $report)
                    @php
                        $statusKey = $report['status_key']
                            ?? match(strtolower($report['status'] ?? '')) {
                                'menunggu' => 'waiting',
                                'selesai' => 'completed',
                                default => 'processing',
                            };
                    @endphp

                    <tr>
                        <td class="number-cell">{{ $report['id'] ?? $loop->iteration }}</td>

                        <td class="name-cell">
                            {{ $report['name'] ?? $report->name ?? '-' }}
                        </td>

                        <td>
                            <span class="category-pill">
                                {{ $report['category'] ?? $report->category ?? '-' }}
                            </span>
                        </td>

                        <td class="location-cell">
                            {{ $report['location'] ?? $report->location ?? '-' }}
                        </td>

                        <td>
                            <span class="status-pill status-{{ $statusKey }}">
                                <i></i>
                                {{ $report['status'] ?? $report->status ?? '-' }}
                            </span>
                        </td>

                        <td class="date-cell">
                            {{ $report['date'] ?? $report->date ?? '-' }}
                        </td>

                        <td>
                            <a href="{{ url('/devisi/laporan/' . ($report['id'] ?? $report->id ?? $loop->iteration)) }}"
                               class="btn-detail">
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
        Menampilkan <strong>{{ ($reports ?? collect([1,2,3]))->count() }}</strong>
        laporan
    </div>
</section>
@endsection
