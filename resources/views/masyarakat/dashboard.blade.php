@extends('masyarakat.layouts.app')

@section('title', 'Dashboard')

@push('styles')
    @vite('resources/css/masyarakat/dashboard.css')
@endpush

@section('content')

    <div class="container">

        <!-- Welcome -->
        <section class="welcome">

            <h1>
                Selamat datang, {{ strtok(Auth::User()->nama_user, ' ') }}!
            </h1>

            <p>
                Gunakan LAPORINFRA untuk melaporkan kerusakan
                infrastruktur di sekitar Anda dan memantau status penanganannya.
            </p>

        </section>


        <!-- Create Report Banner -->
        <section class="report-banner">

            <div class="report-banner-content">

                <div class="report-icon">
                    🗺
                </div>

                <div>

                    <h2>
                        Laporkan Infrastruktur Rusak
                    </h2>

                    <p>
                        Sampaikan laporan kerusakan infrastruktur di lingkungan
                        Anda. Setiap laporan akan ditindaklanjuti oleh pihak
                        yang berwenang.
                    </p>

                </div>

            </div>

            <a href="{{ url('/masyarakat/form-laporan') }}" class="btn-create">
                + &nbsp; Buat Laporan
            </a>

        </section>


        <!-- Reports -->
        <section class="reports-section">

            <div class="reports-header">

                <h2>
                    Laporan Saya
                    <span class="report-count">{{ $laporan->count() }}</span>
                </h2>

                <a href="{{ route('masyarakat.laporan-saya') }}" class="view-all">
                    Lihat Semua
                </a>

            </div>


            <!-- Status Legend -->
            <div class="status-legend">

                <span>
                    <i class="dot waiting"></i>
                    Menunggu
                </span>

                <span>
                    <i class="dot processing"></i>
                    Sedang Diproses
                </span>

                <span>
                    <i class="dot completed"></i>
                    Selesai
                </span>

            </div>


            <!-- Report 1 -->
            @forelse ($laporan as $index => $item)
                <article class="report-card processing-card">

                    <div class="report-number">
                        {{ $index + 1 }}
                    </div>

                    <div class="report-info">

                        <h3>
                            {{ $item->nama_laporan }}
                        </h3>

                        <div class="report-meta">

                            <span class="category">
                                {{ $item->kategori->nama_kategori }}
                            </span>

                            <span>
                                {{ $item->created_at }}
                            </span>

                        </div>

                    </div>

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

                    <div class="report-action">

                        <span class="status-pill status-{{$statusKey}}">
                           ● {{ $item->statusLaporan->nama_status }}
                        </span>

                        <a href="{{ route('masyarakat.detail-laporan', $item->id_laporan) }}" class="btn-detail">
                            Lihat Detail
                        </a>

                    </div>

                </article>
            @empty
                <p>kosong</p>
            @endforelse


        </section>

    </div>

@endsection
