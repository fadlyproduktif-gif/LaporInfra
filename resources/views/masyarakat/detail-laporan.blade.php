@extends('masyarakat.layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    @vite('resources/css/masyarakat/detail-laporan.css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

@section('content')

    @php
        $lastHistory = $laporan->history->sortByDesc('created_at')->first();
    @endphp

    <main class="detail-container">

        <!-- Back -->
        <a href="{{ route('masyarakat.laporan-saya') }}" class="back-link">
            ← Kembali ke Laporan Saya
        </a>


        <!-- Header -->
        <section class="detail-header">

            <div>

                <h1>
                    {{ $laporan->nama_laporan }}
                </h1>

                <p>
                    Dilaporkan pada
                    {{ $laporan->created_at->translatedFormat('l, d F Y') }}

                    ·

                    Diperbarui
                    {{ $laporan->updated_at->translatedFormat('l, d F Y') }}
                </p>

            </div>


            <span class="detail-status">
                ● {{ $laporan->statusLaporan->nama_status }}
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
                                {{ $laporan->kategori->nama_kategori }}
                            </span>

                        </div>


                        <div class="information-row">

                            <span class="information-label">
                                LOKASI
                            </span>

                            <span>
                                {{ $laporan->lokasi }}
                            </span>

                        </div>


                        <div class="information-row">

                            <span class="information-label">
                                TANGGAL LAPORAN
                            </span>

                            <span>
                                {{ $laporan->created_at->translatedFormat('l, d F Y') }}
                            </span>

                        </div>


                        <div class="information-row">

                            <span class="information-label">
                                TERAKHIR DIPERBARUI
                            </span>

                            <span>
                                {{ $laporan->updated_at->translatedFormat('l, d F Y') }}
                            </span>

                        </div>

                    </div>

                </section>


                <!-- Titik Lokasi -->
                @if ($laporan->latitude && $laporan->longitude)
                    <section class="detail-card">

                        <div class="detail-card-header">

                            <div class="card-icon">
                                📍
                            </div>

                            <h2>
                                Titik Lokasi
                            </h2>

                        </div>

                        <div style="padding: 20px;">

                            <div id="map"
                                style="
                                    height: 350px;
                                    border-radius: 10px;
                                    overflow: hidden;
                                ">
                            </div>

                        </div>

                    </section>
                @endif


                <!-- Foto Lokasi -->
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

                        <img src="{{ asset('storage/' . $laporan->foto_lokasi) }}" alt="Foto lokasi laporan">

                    </div>

                </section>


                <!-- Foto Progress -->
                @if ($laporan->foto_progress)
                    <section class="detail-card photo-card">

                        <div class="detail-card-header">

                            <div class="card-icon">
                                📷
                            </div>

                            <h2>
                                Foto Progress
                            </h2>

                        </div>


                        <div class="photo-wrapper">

                            <img src="{{ asset('storage/' . $laporan->foto_progress) }}" alt="Foto progress laporan">

                        </div>

                    </section>
                @endif


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
                            {{ $laporan->deskripsi }}
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

                        <!-- History Button -->
                        <button type="button" id="historyButton" class="history-button" title="Riwayat Progress"
                            aria-label="Riwayat Progress">
                            🕘
                        </button>

                    </div>

                    
                    <div class="status-content">
                        <span class="status-label">
                            STATUS SAAT INI
                        </span>

                        @if ($lastHistory && $lastHistory->userPengubah->devisi)
                            <div class="history-current-updater">
                                Diperbarui oleh
                                <strong>
                                    {{ $lastHistory->userPengubah->devisi->nama_devisi }}
                                </strong>
                            </div>
                            <br>
                        @endif


                        <span class="detail-status">
                            ● {{ $laporan->statusLaporan->nama_status }}
                        </span>


                        <span class="status-label progress-label">
                            KETERANGAN PROGRESS
                        </span>

                        <div class="progress-box">

                            {{ $laporan->keterangan_proggress }}

                        </div>


                        <div class="updated-info">

                            Terakhir diperbarui pada
                            {{ $laporan->updated_at->translatedFormat('l, d F Y') }}

                        </div>

                    </div>

                </section>

            </aside>

        </div>

    </main>


    <!-- =========================
                                     MODAL HISTORY
                                ========================== -->

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

                    @if ($lastHistory && $lastHistory->userPengubah->devisi)
                        <div class="history-current-updater">
                            Diperbarui oleh
                            <strong>
                                {{ $lastHistory->userPengubah->devisi->nama_devisi }}
                            </strong>
                        </div>
                    @endif



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


    <!-- =========================
                                     SCRIPTS
                                ========================== -->

    @push('scripts')

        <!-- Leaflet -->
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


        <!-- History Modal -->
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
