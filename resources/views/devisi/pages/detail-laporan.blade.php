@extends('devisi.layouts.app')

@section('title', 'Detail Laporan')

@push('styles')
    @vite('resources/css/devisi/detail-laporan.css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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

                        <button type="button" id="historyButton" class="history-button" title="Riwayat Progress"
                            aria-label="Riwayat Progress">
                            🕘
                        </button>


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

                @if ($laporan->latitude && $laporan->longitude)
                    <section class="detail-card">

                        <div class="card-header">

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

                <section class="detail-card photo-card">

                    <div class="card-header">

                        <div class="card-icon">
                            ▧
                        </div>

                        <h2>Foto Progress</h2>

                    </div>

                    <div class="card-body photo-body">

                        @if ($laporan->foto_progress)
                            <img src="{{ asset('storage/' . $laporan->foto_progress) }}" alt="Foto progress laporan">
                        @else
                            <p>Belum ada foto progress.</p>
                        @endif

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
                        <form action="{{ route('devisi.laporan.update') }}" method="post" enctype="multipart/form-data">
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
                                    <label style="font-weight: bold; text-decoration: underline">{{ $message }}</label>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>
                                    KETERANGAN PROGRESS
                                </label>

                                <textarea name="keterangan_proggress" rows="5" placeholder="Masukkan keterangan progress...">{{ $laporan->keterangan_proggress }}</textarea>
                                <br>
                                @error('keterangan_proggress')
                                    <label style="font-weight: bold; text-decoration: underline">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group">

                                <label>
                                    FOTO PROGRESS
                                </label>

                                <input type="file" name="foto_progress" id="foto_progress" accept="image/*">

                                <div id="preview-container" style="display: none; margin-top: 10px;">
                                    <img id="preview-foto" src="" alt="Preview foto progress"
                                        style="max-width: 100%; border-radius: 8px;">
                                </div>

                                @error('foto_progress')
                                    <label style="font-weight: bold; text-decoration: underline">
                                        {{ $message }}
                                    </label>
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
