@extends('masyarakat.layouts.app')

@section('title', 'Buat Laporan Baru')

@push('styles')
    @vite('resources/css/masyarakat/form-laporan.css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

@section('content')
    @if ($errors->any())
        <div>
            <strong>Ada error:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-container">

        <a href="{{ url('/masyarakat/dashboard') }}" class="back-link">
            ← Kembali ke Dashboard
        </a>

        <section class="page-header">

            <h1>
                Buat Laporan Baru
            </h1>

            <p>
                Sampaikan masalah infrastruktur yang Anda temukan
                di lingkungan Anda.<br>
                Laporan akan diteruskan ke instansi terkait.
            </p>

        </section>


        <section class="form-card">

            <div class="form-header">

                <div class="form-icon">
                    ▣
                </div>

                <div>

                    <h2>
                        Formulir Pengaduan
                    </h2>

                    <p>
                        Kolom bertanda <span>*</span> wajib diisi
                    </p>

                </div>

            </div>


            <form method="POST" action="{{ route('masyarakat.form-laporan') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                    <label for="judul">
                        Judul Laporan <span>*</span>
                    </label>

                    <input type="text" id="judul" name="nama_laporan"
                        placeholder="Contoh: Jalan berlubang di Jalan Merdeka" value="{{ old('nama_laporan') }}">

                    <small>
                        Tuliskan judul yang singkat dan menggambarkan masalah.
                    </small>

                </div>


                <div class="form-group">

                    <label for="kategori">
                        Kategori <span>*</span>
                    </label>

                    <select id="kategori" name="id_kategori">

                        <option value="">
                            Pilih kategori
                        </option>

                        @foreach ($kategori as $item)
                            <option value="{{ $item->id_kategori }}">
                                @selected(old('id_kategori') == $item->id_kategori)
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach

                    </select>

                    <small>
                        Pilih kategori yang paling sesuai dengan jenis kerusakan.
                    </small>

                </div>


                <div class="form-group">

                    <label for="lokasi">
                        Lokasi Infrastruktur <span>*</span>
                    </label>

                    <div class="lokasi-search">
                        <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan alamat atau nama jalan..."
                            value="{{ old('lokasi') }}">

                        <button type="button" id="btnCariLokasi">
                            Cari
                        </button>
                    </div>

                    <small id="lokasiInfo">
                        Contoh: Jl. Merdeka No. 12, Payakumbuh
                    </small>

                </div>

                <div class="form-group">

                    <label>
                        Titik Lokasi <span>*</span>
                    </label>

                    <div id="map" style="height: 350px; border-radius: 10px;"></div>

                    <small>
                        Klik pada peta untuk menentukan lokasi kerusakan.
                    </small>

                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                </div>
                <!-- Foto Infrastruktur -->
                <div class="form-group">

                    <label for="foto">
                        Foto Infrastruktur <span>*</span>
                    </label>

                    <small class="form-help">
                        Tambahkan foto sebagai bukti kondisi infrastruktur yang dilaporkan.
                    </small>

                    <div class="photo-upload">

                        <label for="foto_lokasi">
                            Foto Lokasi
                        </label>

                        <input type="file" id="foto_lokasi" name="foto_lokasi" accept="image/*">

                        <div id="fotoPreview" class="foto-preview">
                            <span>Belum ada foto dipilih</span>
                        </div>

                    </div>

                </div>

                <div class="form-group">

                    <label for="deskripsi">
                        Deskripsi Laporan <span>*</span>
                    </label>

                    <textarea id="deskripsi" name="deskripsi" maxlength="1000"
                        placeholder="Jelaskan masalah infrastruktur yang Anda temukan secara singkat dan jelas...">{{ old('deskripsi') }}</textarea>

                    <div class="description-footer">

                        <small>
                            Cantumkan lokasi, kondisi, dan waktu kerusakan jika diketahui.
                        </small>

                        <span id="counter">
                            0/1000
                        </span>

                    </div>

                </div>


                <div class="form-actions">

                    <button type="button" class="btn-cancel">
                        Batal
                    </button>

                    <button type="submit" class="btn-submit">
                        ➤ &nbsp; Kirim Laporan
                    </button>

                </div>

            </form>

        </section>

    </div>

    @push('scripts')
        <script>
            const fotoInput = document.getElementById('foto_lokasi');
            const fotoPreview = document.getElementById('fotoPreview');

            fotoInput.addEventListener('change', function() {

                const file = this.files[0];

                if (!file) {
                    fotoPreview.innerHTML = `
                <span>Belum ada foto dipilih</span>
            `;
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    fotoPreview.innerHTML = `
                <span>File yang dipilih bukan gambar.</span>
            `;

                    this.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(event) {

                    fotoPreview.innerHTML = `
                <img
                    src="${event.target.result}"
                    alt="Preview foto laporan"
                >
                <p>${file.name}</p>
            `;

                };

                reader.readAsDataURL(file);
            });
        </script>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <script>
            const defaultLocation = [-0.2167, 100.6333];

            const map = L.map('map').setView(defaultLocation, 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker;

            function setLocation(latitude, longitude) {

                const position = [latitude, longitude];

                if (marker) {
                    marker.setLatLng(position);
                } else {
                    marker = L.marker(position).addTo(map);
                }

                map.setView(position, 17);

                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            }

            // Ambil lokasi perangkat
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(
                    function(position) {

                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        setLocation(latitude, longitude);

                    },
                    function() {

                        console.log('Lokasi pengguna tidak dapat diperoleh.');

                    }
                );

            }

            // Klik manual pada peta
            map.on('click', function(e) {

                setLocation(
                    e.latlng.lat,
                    e.latlng.lng
                );

            });

            // =========================
            // CARI LOKASI BERDASARKAN ALAMAT
            // =========================

            const lokasiInput = document.getElementById('lokasi');
            const btnCariLokasi = document.getElementById('btnCariLokasi');
            const lokasiInfo = document.getElementById('lokasiInfo');

            function cariLokasi() {

                const query = lokasiInput.value.trim();

                if (!query) {
                    lokasiInfo.textContent = 'Masukkan alamat atau nama jalan terlebih dahulu.';
                    return;
                }

                lokasiInfo.textContent = 'Sedang mencari lokasi...';

                const url =
                    'https://nominatim.openstreetmap.org/search' +
                    '?format=jsonv2' +
                    '&q=' + encodeURIComponent(query + ', Payakumbuh, Indonesia') +
                    '&limit=1';

                fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {

                        if (!response.ok) {
                            throw new Error('Gagal menghubungi layanan pencarian lokasi.');
                        }

                        return response.json();

                    })
                    .then(data => {

                        if (data.length === 0) {

                            lokasiInfo.textContent =
                                'Lokasi tidak ditemukan. Coba masukkan alamat yang lebih lengkap.';

                            return;
                        }

                        const hasil = data[0];

                        const latitude = parseFloat(hasil.lat);
                        const longitude = parseFloat(hasil.lon);

                        setLocation(latitude, longitude);

                        lokasiInfo.textContent =
                            'Lokasi ditemukan: ' + hasil.display_name;

                    })
                    .catch(error => {

                        console.error(error);

                        lokasiInfo.textContent =
                            'Terjadi kesalahan saat mencari lokasi.';

                    });
            }

            // Klik tombol Cari
            btnCariLokasi.addEventListener('click', cariLokasi);

            // Tekan Enter pada input lokasi
            lokasiInput.addEventListener('keydown', function(event) {

                if (event.key === 'Enter') {

                    event.preventDefault();

                    cariLokasi();

                }

            });
        </script>
    @endpush

@endsection
