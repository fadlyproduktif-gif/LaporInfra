@extends('masyarakat.layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    @vite('resources/css/masyarakat/detail-laporan.css')
@endpush

@section('content')

<main class="detail-container">

    <!-- Back -->
    <a href="{{ route('masyarakat.laporan-saya') }}" class="back-link">
        ← Kembali ke Laporan Saya 
    </a>


    <!-- Header -->
    <section class="detail-header">

        <div>

            <h1>
                {{$laporan->nama_laporan}}
            </h1>

            <p>
                Dilaporkan pada {{$laporan->created_at->translatedFormat('l, d F Y')}}
                ·
                Diperbarui {{$laporan->updated_at->translatedFormat('l, d F Y')}}
            </p>

        </div>


        <span class="detail-status">
            ● {{$laporan->StatusLaporan->nama_status}}
        </span>

    </section>


    <!-- Detail Layout -->
    <div class="detail-layout">


        <!-- LEFT -->
        <div class="detail-main">


            <!-- Informasi -->
            <section class="detail-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ⓘ
                    </div>

                    <h2>
                        Informasi Laporan
                    </h2>

                </div>


                <div class="detail-information">

                    <div class="information-row">

                        <span class="information-label">
                            KATEGORI
                        </span>

                        <span>
                            {{$laporan->kategori->nama_kategori}}
                        </span>

                    </div>


                    <div class="information-row">

                        <span class="information-label">
                            LOKASI
                        </span>

                        <span>
                            {{$laporan->lokasi}}
                        </span>

                    </div>


                    <div class="information-row">

                        <span class="information-label">
                            TANGGAL LAPORAN
                        </span>

                        <span>
                            {{$laporan->created_at->translatedFormat('l, d F Y')}}
                        </span>

                    </div>


                    <div class="information-row">

                        <span class="information-label">
                            TERAKHIR DIPERBARUI
                        </span>

                        <span>
                            {{$laporan->updated_at->translatedFormat('l, d F Y')}}
                        </span>

                        
                    </div>

                </div>

            </section>


            <!-- Foto -->
            <section class="detail-card photo-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ▧
                    </div>

                    <h2>
                        Foto Lokasi
                    </h2>

                </div>


                <div class="photo-wrapper">

                    <img
                        src="{{ asset('storage/'.$laporan->foto_lokasi) }}"
                        alt="Foto lokasi laporan"
                    >

                </div>

            </section>


            <!-- Deskripsi -->
            <section class="detail-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ≡
                    </div>

                    <h2>
                        Deskripsi Laporan
                    </h2>

                </div>


                <div class="description-content">

                    <p>
                        {{$laporan->deskripsi}}
                    </p>

                </div>

            </section>

        </div>


        <!-- RIGHT -->
        <aside class="detail-sidebar">

            <section class="status-card">

                <div class="detail-card-header">

                    <div class="card-icon">
                        ✓
                    </div>

                    <h2>
                        Status Laporan
                    </h2>

                </div>


                <div class="status-content">

                    <span class="status-label">
                        STATUS SAAT INI
                    </span>

                    <span class="detail-status">
                        ● {{$laporan->StatusLaporan->nama_status}}
                    </span>


                    <span class="status-label progress-label">
                        KETERANGAN PROGRESS
                    </span>

                    <div class="progress-box">

                        {{$laporan->keterangan_proggress}}

                    </div>


                    <div class="updated-info">

                        Terakhir diperbarui pada
                        {{$laporan->updated_at->translatedFormat('l, d F Y')}}

                    </div>

                </div>

            </section>

        </aside>

    </div>

</main>

@endsection