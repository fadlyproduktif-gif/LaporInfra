@extends('admin.layouts.app')

@section('title', 'Detail & Penanganan Laporan')

@push('styles')
    @vite('resources/css/admin/detail-laporan.css')
@endpush

@section('content')

@php
    $statusClass = match ($laporan['status']) {
        'Menunggu' => 'status-menunggu',
        'Sedang Diproses' => 'status-diproses',
        'Selesai' => 'status-selesai',
        default => '',
    };
@endphp


<div class="admin-report-detail">

    {{-- Header --}}
    <div class="page-header">

    <div class="page-header-left">

        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <span class="breadcrumb-separator">/</span>

            <a href="{{ route('admin.laporan.index') }}">
                Laporan
            </a>

            <span class="breadcrumb-separator">/</span>

            <span>Detail Laporan</span>
        </div>

        <h1 class="page-title">
            Detail Laporan
        </h1>

        <p class="page-description">
            Informasi lengkap laporan yang masuk dari masyarakat.
        </p>

    </div>

    {{-- Label Read Only --}}
    <div class="admin-readonly-badge">
        <span class="readonly-icon">◉</span>
        HANYA BACA
    </div>

</div>


    {{-- Back --}}
    <a
        href="{{ route('admin.laporan.index') }}"
        class="btn-back"
    >
        ←
        Kembali ke Daftar Laporan
    </a>


    {{-- Content --}}
    <div class="report-detail-grid">

        {{-- LEFT --}}
        <main>

            {{-- Informasi laporan --}}
            <section class="report-card">

                <div class="report-card-header">
                    <div class="card-icon">
                        📄
                    </div>

                    <h2>
                        Informasi Laporan
                    </h2>
                </div>

                <div class="report-card-body">

                    <div class="report-info-list">

                        <div class="report-info-row">
                            <div class="report-info-label">
                                Nama Laporan
                            </div>

                            <div class="report-info-value">
                                {{$laporan->nama_laporan}}
                            </div>
                        </div>

                        <div class="report-info-row">
                            <div class="report-info-label">
                                Kategori
                            </div>

                            <div class="report-info-value">
                                <span class="report-category">
                                    {{$laporan->kategori->nama_kategori}}
                                </span>
                            </div>
                        </div>

                        <div class="report-info-row">
                            <div class="report-info-label">
                                Lokasi
                            </div>

                            <div class="report-info-value">
                                {{$laporan->lokasi}}
                            </div>
                        </div>

                        <div class="report-info-row">
                            <div class="report-info-label">
                                Tanggal Laporan
                            </div>

                            <div class="report-info-value">
                               {{ $laporan->created_at->translatedFormat('l, d F Y') }}
                            </div>
                        </div>

                        <div class="report-info-row">
                            <div class="report-info-label">
                                Terakhir Diperbarui
                            </div>

                            <div class="report-info-value">
                               {{ $laporan->updated_at->translatedFormat('l, d F Y') }}
                            </div>
                        </div>

                        <div class="report-info-row">
                            <div class="report-info-label">
                                Status
                            </div>

                            <div class="report-info-value">
                                <span class="report-status process">
                                    {{$laporan->statusLaporan->nama_status}}
                                </span>
                            </div>
                        </div>

                    </div>

                </div>

            </section>


            {{-- Deskripsi --}}
            <section class="report-card">

                <div class="report-card-header">
                    <div class="card-icon">
                        📝
                    </div>

                    <h2>
                        Deskripsi Laporan
                    </h2>
                </div>

                <div class="report-card-body">

                    <div class="report-description">
                        <p>
                           {{$laporan->deskripsi}}
                        </p>
                    </div>

                </div>

            </section>


            {{-- Foto --}}
            <section class="report-card">

                <div class="report-card-header">
                    <div class="card-icon">
                        🖼️
                    </div>

                    <h2>
                        Foto Lokasi
                    </h2>
                </div>

                <div class="report-card-body">

                    <div class="report-photo">
                        <img
                            src="/storage/{{ $laporan->foto_lokasi }}"
                            alt="Foto lokasi laporan"
                        >
                    </div>

                </div>

            </section>

        </main>


        {{-- RIGHT --}}
        <aside class="report-sidebar">

            {{-- Pelapor --}}
            <section class="report-card">

                <div class="report-card-header">
                    <div class="card-icon">
                        👤
                    </div>

                    <h2>
                        Informasi Pelapor
                    </h2>
                </div>

                <div class="report-card-body">

                    <div class="reporter-profile">

                        <div class="reporter-avatar">
                             {{ strtoupper(substr($laporan->user->nama_user, 0, 1)) }}
                        </div>

                        <div>
                            <p class="reporter-name">
                                {{$laporan->user->nama_user}}
                            </p>

                            <p class="reporter-role">
                                Masyarakat
                            </p>
                        </div>

                    </div>

                    <div class="reporter-detail">

                        <div class="reporter-detail-item">
                            <span class="reporter-detail-label">
                                Email
                            </span>

                            <span class="reporter-detail-value">
                                {{$laporan->user->email}}
                            </span>
                        </div>

                    </div>

                </div>

            </section>


            {{-- Progress --}}
            <section class="report-card">

                <div class="report-card-header">
                    <div class="card-icon">
                        ✓
                    </div>

                    <h2>
                        Progress Penanganan
                    </h2>
                </div>

                <div class="report-card-body">

                    <div class="progress-content">

                        <div class="progress-item">

                            <span class="progress-label">
                                Status
                            </span>

                            <span class="report-status process">
                                {{$laporan->statusLaporan->nama_status}}
                            </span>

                        </div>

                        <div class="progress-item">

                            <span class="progress-label">
                                Keterangan
                            </span>

                            <div class="progress-note">
                                {{$laporan->keterangan_proggress}}
                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- Read only --}}
            <div class="readonly-notice">

                <div class="readonly-notice-icon">
                    ℹ
                </div>

                <p class="readonly-notice-text">
                    Halaman ini hanya menampilkan data laporan.
                    Admin System tidak dapat mengubah informasi
                    laporan pada halaman ini.
                </p>

            </div>

        </aside>

    </div>


    <div class="report-detail-actions">

        <a
            href="{{ route('admin.laporan.index') }}"
            class="btn-admin-secondary"
        >
            ← Kembali ke Daftar Laporan
        </a>

    </div>

</div>

@endsection 