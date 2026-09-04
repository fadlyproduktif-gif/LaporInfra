@extends('admin.layouts.app')

@section('title', 'Kelola Devisi')

@section('page-title', 'Kelola Devisi')

@section('page-description', 'Kelola devisi yang menangani laporan infrastruktur pada sistem LAPORINFRA.')

@push('styles')
    @vite('resources/css/admin/devisi.css')
@endpush

@section('content')

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="devisi-page">

        {{-- =========================================
             HEADER
        ========================================= --}}

        <div class="devisi-header">

            <div>

                <h1>
                    Kelola Devisi
                </h1>

                <p>
                    Kelola devisi yang menangani laporan infrastruktur
                    pada sistem LAPORINFRA.
                </p>

            </div>

        </div>


        {{-- =========================================
             INFO DAN TOMBOL
        ========================================= --}}

        <div class="devisi-action">

            <div class="devisi-total">

                <i class="fa-solid fa-building"></i>

                <span id="totalDevisi">
                    {{ $total }} Devisi
                </span>

            </div>


            <button type="button" id="tambahDivisiBtn" class="btn-tambah-devisi">

                <i class="fa-solid fa-plus"></i>

                Tambah Devisi

            </button>

        </div>


        {{-- =========================================
             SEARCH
        ========================================= --}}

        <div class="devisi-search-card">

            <div class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text" id="searchDivisi" placeholder="Cari nama devisi...">

            </div>

        </div>


        {{-- =========================================
             TABLE
        ========================================= --}}

        <div class="devisi-table-card">

            <div class="table-responsive">

                <table class="devisi-table">

                    <thead>

                        <tr>

                            <th class="col-no">
                                NO.
                            </th>

                            <th>
                                NAMA DEVISI
                            </th>

                            <th>
                                JUMLAH KATEGORI
                            </th>

                            <th class="col-aksi">
                                AKSI
                            </th>

                        </tr>

                    </thead>


                    <tbody id="devisiTableBody">

                        @forelse ($devisi as $index => $item)
                            <tr class="divisi-row" data-id="{{ $item->id_devisi }}">

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                <td class="nama-devisi">
                                    {{ $item->nama_devisi }}
                                </td>


                                <td>

                                    <span class="kategori-badge">
                                        {{ $item->kategori->count() }}
                                    </span>

                                </td>


                                <td class="aksi-column">

                                    <button type="button" class="btn-edit">

                                        <i class="fa-regular fa-pen-to-square"></i>

                                        Edit

                                    </button>


                                    <button type="button" class="btn-hapus">

                                        <i class="fa-regular fa-trash-can"></i>

                                        Hapus

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" style="text-align: center;">
                                    Belum ada devisi.
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =========================================
         MODAL TAMBAH DEVISI
    ========================================= --}}

    <div class="modal-overlay" id="modalTambahDivisi">

        <div class="modal-box">

            <div class="modal-header">

                <div>

                    <h2>
                        Tambah Devisi
                    </h2>

                    <p>
                        Tambahkan devisi baru ke dalam sistem.
                    </p>

                </div>


                <button type="button" class="modal-close" id="closeTambah">
                    ×
                </button>

            </div>


            <form action="{{ route('admin.devisi.store') }}" method="POST">

                @csrf

                <div class="modal-body">

                    <div class="modal-form-group">

                        <label for="namaDivisiTambah">
                            Nama Devisi
                        </label>

                        <input type="text" name="nama_devisi" id="namaDivisiTambah" placeholder="Masukkan nama devisi"
                            value="{{ old('nama_devisi') }}">

                        @error('nama_devisi')
                            <small style="color: #dc4b4b;">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button" class="btn-modal-batal" id="batalTambah">
                        Batal
                    </button>


                    <button type="submit" class="btn-modal-simpan">

                        <i class="fa-solid fa-plus"></i>

                        Tambah Devisi

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================
         MODAL EDIT DEVISI
    ========================================= --}}

    <div class="modal-overlay" id="modalEditDivisi">

        <div class="modal-box">

            <div class="modal-header">

                <div>

                    <h2>
                        Edit Devisi
                    </h2>

                    <p>
                        Perbarui informasi devisi.
                    </p>

                </div>


                <button type="button" class="modal-close" id="closeEdit">
                    ×
                </button>

            </div>


            <form id="divisiForm" method="POST">

                @csrf

                @method('PUT')


                <div class="modal-body">

                    <div class="modal-form-group">

                        <label for="namaDivisiEdit">
                            Nama Devisi
                        </label>

                        <input name="nama_devisi" type="text" id="namaDivisiEdit">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button" class="btn-modal-batal" id="batalEdit">
                        Batal
                    </button>


                    <button type="submit" class="btn-modal-simpan">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================
         MODAL HAPUS DEVISI
    ========================================= --}}

    <div class="modal-overlay" id="modalHapusDivisi">

        <div class="modal-box modal-hapus-box">

            <div class="modal-hapus-content">

                <div class="hapus-icon">

                    <i class="fa-solid fa-trash-can"></i>

                </div>


                <h2>
                    Hapus Devisi?
                </h2>


                <p>

                    Apakah Anda yakin ingin menghapus
                    <strong id="namaDivisiHapus">
                        devisi ini
                    </strong>?

                    Tindakan ini tidak dapat dibatalkan.

                </p>

            </div>


            <form id="hapusDivisiForm" method="POST">

                @csrf

                @method('DELETE')


                <div class="modal-footer modal-hapus-footer">

                    <button type="button" class="btn-modal-batal" id="batalHapus">
                        Batal
                    </button>


                    <button type="submit" class="btn-modal-hapus">

                        <i class="fa-solid fa-trash-can"></i>

                        Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================
         JAVASCRIPT
    ========================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* =========================================
               AMBIL ELEMEN
            ========================================= */

            const tambahBtn =
                document.getElementById('tambahDivisiBtn');

            const modalTambah =
                document.getElementById('modalTambahDivisi');

            const modalEdit =
                document.getElementById('modalEditDivisi');

            const modalHapus =
                document.getElementById('modalHapusDivisi');


            const closeTambah =
                document.getElementById('closeTambah');

            const closeEdit =
                document.getElementById('closeEdit');


            const batalTambah =
                document.getElementById('batalTambah');

            const batalEdit =
                document.getElementById('batalEdit');

            const batalHapus =
                document.getElementById('batalHapus');


            const searchInput =
                document.getElementById('searchDivisi');

            const namaDivisiTambah =
                document.getElementById('namaDivisiTambah');

            const namaDivisiEdit =
                document.getElementById('namaDivisiEdit');

            const namaDivisiHapus =
                document.getElementById('namaDivisiHapus');


            const divisiForm =
                document.getElementById('divisiForm');

            const hapusDivisiForm =
                document.getElementById('hapusDivisiForm');


            /* =========================================
               BUKA MODAL
            ========================================= */

            function bukaModal(modal) {

                if (modal) {
                    modal.classList.add('active');
                }

            }


            /* =========================================
               TUTUP MODAL
            ========================================= */

            function tutupModal(modal) {

                if (modal) {
                    modal.classList.remove('active');
                }

            }


            /* =========================================
               TAMBAH DEVISI
            ========================================= */

            tambahBtn.addEventListener('click', function() {

                namaDivisiTambah.value = '';

                bukaModal(modalTambah);

            });


            closeTambah.addEventListener('click', function() {

                tutupModal(modalTambah);

            });


            batalTambah.addEventListener('click', function() {

                tutupModal(modalTambah);

            });


            /* =========================================
               EDIT DEVISI
            ========================================= */

            document
                .querySelectorAll('.divisi-row')
                .forEach(function(row) {

                    const editButton =
                        row.querySelector('.btn-edit');

                    const hapusButton =
                        row.querySelector('.btn-hapus');


                    editButton.addEventListener('click', function() {

                        const id =
                            row.dataset.id;

                        const nama =
                            row.querySelector('.nama-devisi')
                            .textContent
                            .trim();


                        namaDivisiEdit.value =
                            nama;


                        divisiForm.action =
                            "/admin/devisi/update/" + id;


                        bukaModal(modalEdit);

                    });


                    /* =========================================
                       HAPUS DEVISI
                    ========================================= */

                    hapusButton.addEventListener('click', function() {

                        const id =
                            row.dataset.id;

                        const nama =
                            row.querySelector('.nama-devisi')
                            .textContent
                            .trim();


                        namaDivisiHapus.textContent =
                            nama;


                        hapusDivisiForm.action =
                            "/admin/devisi/delete/" + id;


                        bukaModal(modalHapus);

                    });

                });


            /* =========================================
               TUTUP EDIT
            ========================================= */

            closeEdit.addEventListener('click', function() {

                tutupModal(modalEdit);

            });


            batalEdit.addEventListener('click', function() {

                tutupModal(modalEdit);

            });


            /* =========================================
               TUTUP HAPUS
            ========================================= */

            batalHapus.addEventListener('click', function() {

                tutupModal(modalHapus);

            });


            /* =========================================
               SEARCH
            ========================================= */

            searchInput.addEventListener('input', function() {

                const keyword =
                    this.value
                    .toLowerCase()
                    .trim();


                const rows =
                    document.querySelectorAll('.divisi-row');


                rows.forEach(function(row) {

                    const nama =
                        row.querySelector('.nama-devisi')
                        .textContent
                        .toLowerCase();


                    row.style.display =
                        nama.includes(keyword) ?
                        '' :
                        'none';

                });

            });


            /* =========================================
               KLIK LUAR MODAL
            ========================================= */

            window.addEventListener('click', function(event) {

                if (event.target === modalTambah) {
                    tutupModal(modalTambah);
                }

                if (event.target === modalEdit) {
                    tutupModal(modalEdit);
                }

                if (event.target === modalHapus) {
                    tutupModal(modalHapus);
                }

            });


            /* =========================================
               ESCAPE
            ========================================= */

            document.addEventListener('keydown', function(event) {

                if (event.key === 'Escape') {

                    tutupModal(modalTambah);
                    tutupModal(modalEdit);
                    tutupModal(modalHapus);

                }

            });

        });
    </script>

@endsection
