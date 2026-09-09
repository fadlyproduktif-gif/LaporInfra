@extends('admin.layouts.app')

@section('title', 'Detail & Penanganan Laporan')

@push('styles')
    @vite('resources/css/admin/detail-laporan.css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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

    <main>

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
            <a href="{{ route('admin.laporan.index') }}" class="btn-back">
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
                                        {{ $laporan->nama_laporan }}
                                    </div>
                                </div>

                                <div class="report-info-row">
                                    <div class="report-info-label">
                                        Kategori
                                    </div>

                                    <div class="report-info-value">
                                        <span class="report-category">
                                            {{ $laporan->kategori->nama_kategori }}
                                        </span>
                                    </div>
                                </div>

                                <div class="report-info-row">
                                    <div class="report-info-label">
                                        Lokasi
                                    </div>

                                    <div class="report-info-value">
                                        {{ $laporan->lokasi }}
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
                                            {{ $laporan->statusLaporan->nama_status }}
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </section>


                    @if ($laporan->latitude && $laporan->longitude)
                        <section class="report-card">

                            <div class="report-card-header">

                                <div class="card-icon">
                                    📍
                                </div>

                                <h2>
                                    Titik Lokasi
                                </h2>

                            </div>

                            <div style="padding: 20px;">

                                <div id="map" style="height: 350px; border-radius: 10px; overflow: hidden;"></div>

                            </div>

                        </section>
                    @endif

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
                                    {{ $laporan->deskripsi }}
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
                                <img src="/storage/{{ $laporan->foto_lokasi }}" alt="Foto lokasi laporan">
                            </div>

                        </div>

                    </section>

                    {{-- Foto Progress --}}
                    @if ($laporan->foto_progress)
                        <section class="report-card">

                            <div class="report-card-header">

                                <div class="card-icon">
                                    📷
                                </div>

                                <h2>
                                    Foto Progress
                                </h2>

                            </div>

                            <div class="report-card-body">

                                <div class="report-photo">
                                    <img src="{{ asset('storage/' . $laporan->foto_progress) }}"
                                        alt="Foto progress laporan">
                                </div>

                            </div>

                        </section>
                    @endif

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
                                        {{ $laporan->user->nama_user }}
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
                                        {{ $laporan->user->email }}
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

                            <button type="button" id="historyButton" class="history-button" title="Riwayat Progress"
                                aria-label="Riwayat Progress">
                                🕘
                            </button>
                        </div>

                        <div class="report-card-body">

                            <div class="progress-content">

                                <div class="progress-item">

                                    <span class="progress-label">
                                        Status
                                    </span>

                                    <span class="report-status process">
                                        {{ $laporan->statusLaporan->nama_status }}
                                    </span>

                                </div>

                                <div class="progress-item">

                                    <span class="progress-label">
                                        Keterangan
                                    </span>

                                    <div class="progress-note">
                                        {{ $laporan->keterangan_proggress }}
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

                <a href="{{ route('admin.laporan.index') }}" class="btn-admin-secondary">
                    ← Kembali ke Daftar Laporan
                </a>

            </div>

        </div>


        <!-- =========================
                 MODAL HISTORY
            ========================= -->

        <div id="historyModal" class="history-modal">

            <div class="history-modal-content">

                <div class="history-modal-header">

                    <div>
                        <h2>History Progress Laporan</h2>

                        <p>
                            Riwayat penanganan laporan
                        </p>
                    </div>

                    <button type="button" id="closeHistoryModal" aria-label="Tutup">
                        ×
                    </button>

                </div>


                <div class="history-modal-body">

                    <!-- KONDISI TERKINI -->
                    <div class="history-current">

                        <div class="history-title">
                            KONDISI SAAT INI
                        </div>

                        <div class="history-status">
                            {{ $laporan->statusLaporan->nama_status }}
                        </div>

                        <p>
                            {{ $laporan->keterangan_proggress }}
                        </p>

                    </div>


                    <!-- HISTORY -->
                    <div class="history-list">

                        @forelse ($laporan->history->sortByDesc('created_at') as $history)
                            <div class="history-item">

                                <div class="history-timeline">

                                    <span class="history-dot"></span>

                                </div>


                                <div class="history-item-content">

                                    <div class="history-user">

                                        <strong>
                                            {{ $history->userPengubah->nama_user }}
                                        </strong>

                                        @if ($history->userPengubah->devisi)
                                            <span>
                                                • {{ $history->userPengubah->devisi->nama_devisi }}
                                            </span>
                                        @endif

                                    </div>


                                    <small class="history-date">
                                        {{ $history->created_at->translatedFormat('d M Y • H:i') }}
                                    </small>


                                    <div class="history-card">

                                        <div class="history-row">

                                            <span>
                                                STATUS SEBELUMNYA
                                            </span>

                                            <strong>
                                                {{ $history->statusLaporan?->nama_status ?? '-' }}
                                            </strong>

                                        </div>


                                        <div class="history-row">

                                            <span>
                                                KETERANGAN
                                            </span>

                                            <p>
                                                {{ $history->keterangan_proggress }}
                                            </p>

                                        </div>


                                        <div class="history-row">

                                            <span>
                                                FOTO PROGRESS SEBELUMNYA
                                            </span>

                                            @if ($history->history_foto)
                                                <img class="history-thumbnail"
                                                    src="{{ asset('storage/' . $history->history_foto) }}"
                                                    alt="Foto progress sebelumnya">
                                            @else
                                                <p class="history-no-photo">
                                                    Belum ada foto progress pada tahap ini.
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="history-empty">
                                Belum ada riwayat penanganan.
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

        </div>
    </main>

    @push('scripts')

        <script>
            const inputFoto = document.getElementById('foto_progress');
            const previewContainer = document.getElementById('preview-container');
            const previewFoto = document.getElementById('preview-foto');

            inputFoto.addEventListener('change', function() {
                const file = this.files[0];

                if (!file) {
                    previewContainer.style.display = 'none';
                    previewFoto.src = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    previewFoto.src = e.target.result;
                    previewContainer.style.display = 'block';
                };

                reader.readAsDataURL(file);
            });
        </script>

        @if ($laporan->latitude && $laporan->longitude)
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

            <script>
                const latitude = {{ $laporan->latitude }};
                const longitude = {{ $laporan->longitude }};

                const map = L.map('map').setView(
                    [latitude, longitude],
                    17
                );

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([latitude, longitude])
                    .addTo(map)
                    .bindPopup('Lokasi laporan')
                    .openPopup();
            </script>
        @endif

        <script>
            const historyButton = document.getElementById('historyButton');
            const historyModal = document.getElementById('historyModal');
            const closeHistoryModal = document.getElementById('closeHistoryModal');

            historyButton.addEventListener('click', function() {
                historyModal.classList.add('show');
            });

            closeHistoryModal.addEventListener('click', function() {
                historyModal.classList.remove('show');
            });

            historyModal.addEventListener('click', function(event) {
                if (event.target === historyModal) {
                    historyModal.classList.remove('show');
                }
            });
        </script>

    @endpush
@endsection
