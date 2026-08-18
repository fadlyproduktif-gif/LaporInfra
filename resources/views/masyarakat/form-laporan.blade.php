@extends('masyarakat.layouts.app')

@section('title', 'Buat Laporan Baru')

@push('styles')
    @vite('resources/css/masyarakat/form-laporan.css')
@endpush

@section('content')

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


            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                    <label for="judul">
                        Judul Laporan <span>*</span>
                    </label>

                    <input type="text" id="judul" name="judul" placeholder="Contoh: Jalan berlubang di Jalan Merdeka">

                    <small>
                        Tuliskan judul yang singkat dan menggambarkan masalah.
                    </small>

                </div>


                <div class="form-group">

                    <label for="kategori">
                        Kategori <span>*</span>
                    </label>

                    <select id="kategori" name="kategori">

                        <option value="">
                            Pilih kategori
                        </option>

                        <option value="jalan">
                            Jalan & Trotoar
                        </option>

                        <option value="penerangan">
                            Penerangan Jalan
                        </option>

                        <option value="drainase">
                            Drainase & Sanitasi
                        </option>

                        <option value="lainnya">
                            Lainnya
                        </option>

                    </select>

                    <small>
                        Pilih kategori yang paling sesuai dengan jenis kerusakan.
                    </small>

                </div>


                <div class="form-group">

                    <label for="lokasi">
                        Lokasi Infrastruktur <span>*</span>
                    </label>

                    <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan alamat atau lokasi kerusakan...">

                    <small>
                        Contoh: Jl. Merdeka No. 12, dekat Kantor Desa
                    </small>

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

                        <div class="photo-upload-icon">
                            📷
                        </div>

                        <strong>Upload Foto</strong>

                        <span class="photo-upload-info">
                            JPG, JPEG, atau PNG • Maks. 2 MB
                        </span>

                        <label for="foto" class="btn-photo">
                            Pilih Foto
                        </label>

                        <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png,image/jpeg,image/png" hidden>

                        <span id="photo-name" class="photo-name"></span>

                    </div>

                </div>

                <div class="form-group">

                    <label for="deskripsi">
                        Deskripsi Laporan <span>*</span>
                    </label>

                    <textarea id="deskripsi" name="deskripsi" maxlength="1000"
                        placeholder="Jelaskan masalah infrastruktur yang Anda temukan secara singkat dan jelas..."></textarea>

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
            document.addEventListener('DOMContentLoaded', function () {

                const photoInput = document.getElementById('foto');
                const photoName = document.getElementById('photo-name');

                if (!photoInput || !photoName) {
                    return;
                }

                photoInput.addEventListener('change', function () {

                    const file = this.files[0];

                    if (!file) {
                        photoName.textContent = '';
                        photoName.style.display = 'none';
                        return;
                    }

                    const maxSize = 2 * 1024 * 1024;

                    if (file.size > maxSize) {

                        alert('Ukuran foto maksimal 2 MB.');

                        this.value = '';

                        photoName.textContent = '';
                        photoName.style.display = 'none';

                        return;
                    }

                    photoName.textContent = file.name;
                    photoName.style.display = 'block';

                });

            });
        </script>
    @endpush

@endsection