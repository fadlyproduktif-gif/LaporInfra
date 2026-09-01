@extends('admin.layouts.app')


@section('title', 'Kelola Devisi')


@section('page-title', 'Kelola Devisi')


@section(
    'page-description',
    'Kelola devisi yang menangani laporan infrastruktur pada sistem LAPORINFRA.'
)


@push('styles')

    @vite('resources/css/admin/devisi.css')

@endpush


@section('content')

<div class="devisi-page">

    {{-- HEADER HALAMAN --}}
    <div class="devisi-header">

        <div>
            <h1>Kelola Devisi</h1>

            <p>
                Kelola devisi yang menangani laporan infrastruktur
                pada sistem LAPORINFRA.
            </p>
        </div>

    </div>


    {{-- INFO DAN TOMBOL --}}
    <div class="devisi-action">

        <div class="devisi-total">

            <i class="fa-solid fa-building"></i>

            <span id="totalDevisi">
                4 Devisi
            </span>

        </div>


        <button
            type="button"
            id="tambahDivisiBtn"
            class="btn-tambah-devisi"
        >

            <i class="fa-solid fa-plus"></i>

            Tambah Devisi

        </button>

    </div>


    {{-- SEARCH --}}
    <div class="devisi-search-card">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="searchDivisi"
                placeholder="Cari nama devisi..."
            >

        </div>

    </div>


    {{-- TABLE --}}
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

                    {{-- DATA STATIC --}}

                    <tr class="divisi-row">

                        <td>1</td>

                        <td class="nama-devisi">
                            Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)
                        </td>

                        <td>

                            <span class="kategori-badge">
                                3 kategori
                            </span>

                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                            >

                                <i class="fa-regular fa-pen-to-square"></i>

                                Edit

                            </button>


                            <button
                                type="button"
                                class="btn-hapus"
                            >

                                <i class="fa-regular fa-trash-can"></i>

                                Hapus

                            </button>

                        </td>

                    </tr>


                    <tr class="divisi-row">

                        <td>2</td>

                        <td class="nama-devisi">
                            Dinas Perhubungan
                        </td>

                        <td>

                            <span class="kategori-badge">
                                2 kategori
                            </span>

                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                            >

                                <i class="fa-regular fa-pen-to-square"></i>

                                Edit

                            </button>


                            <button
                                type="button"
                                class="btn-hapus"
                            >

                                <i class="fa-regular fa-trash-can"></i>

                                Hapus

                            </button>

                        </td>

                    </tr>


                    <tr class="divisi-row">

                        <td>3</td>

                        <td class="nama-devisi">
                            Dinas Perumahan dan Kawasan Permukiman
                        </td>

                        <td>

                            <span class="kategori-badge">
                                3 kategori
                            </span>

                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                            >

                                <i class="fa-regular fa-pen-to-square"></i>

                                Edit

                            </button>


                            <button
                                type="button"
                                class="btn-hapus"
                            >

                                <i class="fa-regular fa-trash-can"></i>

                                Hapus

                            </button>

                        </td>

                    </tr>


                    <tr class="divisi-row">

                        <td>4</td>

                        <td class="nama-devisi">
                            Dinas Lingkungan Hidup
                        </td>

                        <td>

                            <span class="kategori-badge">
                                2 kategori
                            </span>

                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                            >

                                <i class="fa-regular fa-pen-to-square"></i>

                                Edit

                            </button>


                            <button
                                type="button"
                                class="btn-hapus"
                            >

                                <i class="fa-regular fa-trash-can"></i>

                                Hapus

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =========================================
    MODAL TAMBAH DEVISI
========================================= --}}

<div
    class="modal-overlay"
    id="modalTambahDivisi"
>

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


            <button
                type="button"
                class="modal-close"
                id="closeTambah"
            >
                ×
            </button>

        </div>


        <div class="modal-body">

            <div class="modal-form-group">

                <label for="namaDivisiTambah">
                    Nama Devisi
                </label>

                <input
                    type="text"
                    id="namaDivisiTambah"
                    placeholder="Masukkan nama devisi"
                >

            </div>


            <div class="modal-form-group">

                <label for="kategoriTambah">
                    Jumlah Kategori
                </label>

                <input
                    type="number"
                    id="kategoriTambah"
                    placeholder="Contoh: 3"
                    min="0"
                >

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-modal-batal"
                id="batalTambah"
            >
                Batal
            </button>


            <button
                type="button"
                class="btn-modal-simpan"
                id="simpanTambah"
            >

                <i class="fa-solid fa-plus"></i>

                Tambah Devisi

            </button>

        </div>

    </div>

</div>


{{-- =========================================
    MODAL EDIT DEVISI
========================================= --}}

<div
    class="modal-overlay"
    id="modalEditDivisi"
>

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


            <button
                type="button"
                class="modal-close"
                id="closeEdit"
            >
                ×
            </button>

        </div>


        <div class="modal-body">

            <div class="modal-form-group">

                <label for="namaDivisiEdit">
                    Nama Devisi
                </label>

                <input
                    type="text"
                    id="namaDivisiEdit"
                >

            </div>


            <div class="modal-form-group">

                <label for="kategoriEdit">
                    Jumlah Kategori
                </label>

                <input
                    type="number"
                    id="kategoriEdit"
                    min="0"
                >

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-modal-batal"
                id="batalEdit"
            >
                Batal
            </button>


            <button
                type="button"
                class="btn-modal-simpan"
                id="simpanEdit"
            >

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Perubahan

            </button>

        </div>

    </div>

</div>


{{-- =========================================
    MODAL HAPUS DEVISI
========================================= --}}

<div
    class="modal-overlay"
    id="modalHapusDivisi"
>

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


        <div class="modal-footer modal-hapus-footer">

            <button
                type="button"
                class="btn-modal-batal"
                id="batalHapus"
            >
                Batal
            </button>


            <button
                type="button"
                class="btn-modal-hapus"
                id="konfirmasiHapus"
            >

                <i class="fa-solid fa-trash-can"></i>

                Hapus

            </button>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {


    // =========================================
    // AMBIL ELEMEN
    // =========================================

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


    const simpanTambah =
        document.getElementById('simpanTambah');

    const simpanEdit =
        document.getElementById('simpanEdit');

    const konfirmasiHapus =
        document.getElementById('konfirmasiHapus');


    const searchInput =
        document.getElementById('searchDivisi');

    const tableBody =
        document.getElementById('devisiTableBody');


    const namaDivisiTambah =
        document.getElementById('namaDivisiTambah');

    const kategoriTambah =
        document.getElementById('kategoriTambah');


    const namaDivisiEdit =
        document.getElementById('namaDivisiEdit');

    const kategoriEdit =
        document.getElementById('kategoriEdit');


    const namaDivisiHapus =
        document.getElementById('namaDivisiHapus');

    const totalDevisi =
        document.getElementById('totalDevisi');


    let barisEdit = null;
    let barisHapus = null;


    // =========================================
    // FUNGSI BUKA MODAL
    // =========================================

    function bukaModal(modal) {

        if (modal) {
            modal.classList.add('active');
        }

    }


    // =========================================
    // FUNGSI TUTUP MODAL
    // =========================================

    function tutupModal(modal) {

        if (modal) {
            modal.classList.remove('active');
        }

    }


    // =========================================
    // UPDATE NOMOR DAN TOTAL
    // =========================================

    function updateTabel() {

        const rows =
            tableBody.querySelectorAll('.divisi-row');

        rows.forEach(function (row, index) {

            row.children[0].textContent = index + 1;

        });


        totalDevisi.textContent =
            rows.length + ' Devisi';

    }


    // =========================================
    // TAMBAH DEVISI
    // =========================================

    tambahBtn.addEventListener('click', function () {

        namaDivisiTambah.value = '';
        kategoriTambah.value = '';

        bukaModal(modalTambah);

    });


    closeTambah.addEventListener('click', function () {

        tutupModal(modalTambah);

    });


    batalTambah.addEventListener('click', function () {

        tutupModal(modalTambah);

    });


    simpanTambah.addEventListener('click', function () {

        const nama =
            namaDivisiTambah.value.trim();

        const kategori =
            kategoriTambah.value.trim();


        if (nama === '') {

            alert('Nama devisi harus diisi.');

            return;

        }


        if (kategori === '') {

            alert('Jumlah kategori harus diisi.');

            return;

        }


        const nomor =
            tableBody.querySelectorAll('.divisi-row').length + 1;


        const row =
            document.createElement('tr');


        row.classList.add('divisi-row');


        row.innerHTML = `

            <td>${nomor}</td>

            <td class="nama-devisi">
                ${nama}
            </td>

            <td>

                <span class="kategori-badge">
                    ${kategori} kategori
                </span>

            </td>

            <td class="aksi-column">

                <button
                    type="button"
                    class="btn-edit"
                >

                    <i class="fa-regular fa-pen-to-square"></i>

                    Edit

                </button>


                <button
                    type="button"
                    class="btn-hapus"
                >

                    <i class="fa-regular fa-trash-can"></i>

                    Hapus

                </button>

            </td>

        `;


        tableBody.appendChild(row);


        pasangEventTombol(row);


        updateTabel();


        tutupModal(modalTambah);

    });


    // =========================================
    // EVENT EDIT DAN HAPUS
    // =========================================

    function pasangEventTombol(row) {


        const editButton =
            row.querySelector('.btn-edit');


        const hapusButton =
            row.querySelector('.btn-hapus');


        editButton.addEventListener('click', function () {


            barisEdit = row;


            const nama =
                row.querySelector('.nama-devisi').textContent.trim();


            const kategoriText =
                row.querySelector('.kategori-badge').textContent.trim();


            const kategori =
                kategoriText.replace(' kategori', '');


            namaDivisiEdit.value = nama;

            kategoriEdit.value = kategori;


            bukaModal(modalEdit);

        });


        hapusButton.addEventListener('click', function () {


            barisHapus = row;


            const nama =
                row.querySelector('.nama-devisi').textContent.trim();


            namaDivisiHapus.textContent = nama;


            bukaModal(modalHapus);

        });


    }


    // =========================================
    // PASANG EVENT UNTUK DATA AWAL
    // =========================================

    document.querySelectorAll('.divisi-row').forEach(function (row) {

        pasangEventTombol(row);

    });


    // =========================================
    // TUTUP MODAL EDIT
    // =========================================

    closeEdit.addEventListener('click', function () {

        tutupModal(modalEdit);

    });


    batalEdit.addEventListener('click', function () {

        tutupModal(modalEdit);

    });


    // =========================================
    // SIMPAN EDIT
    // =========================================

    simpanEdit.addEventListener('click', function () {


        if (!barisEdit) {
            return;
        }


        const nama =
            namaDivisiEdit.value.trim();

        const kategori =
            kategoriEdit.value.trim();


        if (nama === '') {

            alert('Nama devisi harus diisi.');

            return;

        }


        if (kategori === '') {

            alert('Jumlah kategori harus diisi.');

            return;

        }


        barisEdit.querySelector('.nama-devisi').textContent =
            nama;


        barisEdit.querySelector('.kategori-badge').textContent =
            kategori + ' kategori';


        tutupModal(modalEdit);


        barisEdit = null;

    });


    // =========================================
    // TUTUP MODAL HAPUS
    // =========================================

    batalHapus.addEventListener('click', function () {

        tutupModal(modalHapus);

    });


    // =========================================
    // KONFIRMASI HAPUS
    // =========================================

    konfirmasiHapus.addEventListener('click', function () {


        if (!barisHapus) {
            return;
        }


        barisHapus.remove();


        updateTabel();


        tutupModal(modalHapus);


        barisHapus = null;

    });


    // =========================================
    // SEARCH DEVISI
    // =========================================

    searchInput.addEventListener('input', function () {


        const keyword =
            this.value.toLowerCase();


        const rows =
            document.querySelectorAll('.divisi-row');


        rows.forEach(function (row) {


            const nama =
                row.querySelector('.nama-devisi')
                    .textContent
                    .toLowerCase();


            if (nama.includes(keyword)) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }


        });

    });


    // =========================================
    // TUTUP MODAL JIKA KLIK LUAR
    // =========================================

    window.addEventListener('click', function (event) {


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


});

</script>


@endsection