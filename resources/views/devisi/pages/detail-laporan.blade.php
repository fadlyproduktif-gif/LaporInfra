@extends('devisi.layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    @vite('resources/css/devisi/detail-laporan.css')
@endpush

@section('content')

    @php
        $statusKey = match ($laporan->id_status) {
            1 => 'waiting',
            2 => 'postponed',
            3 => 'rejected',
            4 => 'accepted',
            5 => 'processing',
            6 => 'completed',
            default => 'unknow',
        };
    @endphp

    <main class="detail-page">

        <!-- =========================
                     TOP HEADER
                ========================== -->

        <div class="detail-top">

            <div class="detail-breadcrumb">
                <a href="{{ route('devisi.laporan') }}">
                    ← Kembali ke Daftar Laporan
                </a>
            </div>

            <div class="detail-heading">

                <div>
                    <h1>Detail & Penanganan Laporan</h1>

                    <p>
                        Dilaporkan pada {{ $laporan->created_at->translatedFormat('l, d F Y') }}
                        <span>•</span>
                        Diperbarui {{ $laporan->updated_at->translatedFormat('l, d F Y') }}
                    </p>
                </div>

                <div class="status-badge status-{{ $statusKey }}">
                    <span></span>
                    {{ $laporan->StatusLaporan->nama_status }}
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
                                {{ $laporan->nama_laporan }}
                            </div>

                        </div>

                        <div class="info-row">

                            <div class="info-label">
                                KATEGORI
                            </div>

                            <div class="info-value">

                                <span class="category-badge">
                                    {{ $laporan->kategori->nama_kategori }}
                                </span>

                            </div>

                        </div>

                        <div class="info-row">

                            <div class="info-label">
                                LOKASI
                            </div>

                            <div class="info-value">
                                {{ $laporan->lokasi }}
                            </div>

                        </div>

                        <div class="info-row">

                            <div class="info-label">
                                TANGGAL
                            </div>

                            <div class="info-value">
                                {{ $laporan->created_at->translatedFormat('l, d F Y') }}
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
                            {{ $laporan->deskripsi }}
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

                        <img src="/storage/{{ $laporan->foto_lokasi }}" alt="Foto lokasi laporan">

                    </div>

                </section>


                <!-- BOTTOM BUTTON -->

                <div class="detail-bottom">

                    <a href="{{ route('devisi.laporan') }}" class="back-button">
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
                                    {{ strtoupper(substr($laporan->user->nama_user, 0, 1)) }}
                                </div>

                                <strong>
                                    {{ $laporan->user->nama_user }}
                                </strong>

                            </div>

                        </div>


                        <div class="reporter-info">

                            <span class="small-label">
                                EMAIL
                            </span>

                            <p>
                                {{ $laporan->user->email }}
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
                        <form action="{{ route('devisi.laporan.update') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <input name="id_laporan" value="{{ $laporan->id_laporan }}" hidden>
                                <label>
                                    UBAH STATUS
                                </label>

                                <select name='id_status'>
                                    <option value="">Perbarui Status</option>
                                    @forelse ($status as $item)
                                        <option value="{{ $item->id_status }}" @selected($item->id_status == $laporan->id_status)>
                                            {{ $item->nama_status }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                 @error('id_status')
                                    <label style="font-weight: bold; text-decoration: underline">{{$message}}</label>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>
                                    KETERANGAN PROGRESS
                                </label>

                                <textarea name="keterangan_proggress" rows="5" placeholder="">{{ $laporan->keterangan_proggress }}</textarea>
                                <br>
                                @error('keterangan_proggress')
                                    <label style="font-weight: bold; text-decoration: underline">{{$message}}</label>
                                @enderror
                            </div>


                            <button type="submit" class="save-button">
                                Simpan Penanganan
                            </button>
                        </form>

                        <div class="last-update">

                            ◷
                            Terakhir diperbarui
                            {{ $laporan->updated_at->translatedFormat('l, d F Y') }}

                        </div>

                    </div>

                </section>

            </aside>

        </div>

    </main>

@endsection
