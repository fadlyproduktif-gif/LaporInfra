@extends('admin.layouts.app')

@section('title', 'Kelola Akun')

@section('page-title', 'Kelola Akun')

@section(
    'page-description',
    'Kelola akun pengguna yang terdaftar pada sistem LAPORINFRA.'
)

@push('styles')
    @vite('resources/css/admin/akun.css')
@endpush


@section('content')

<div class="akun-page">

    {{-- =========================
        HEADER HALAMAN
    ========================== --}}
    <div class="akun-header">

        <div class="akun-header-text">
            <h1>Kelola Akun</h1>
            <p>Kelola akun pengguna yang terdaftar pada sistem LAPORINFRA.</p>
        </div>

        <div class="akun-header-action">

            <div class="akun-total">
                <i class="fa-solid fa-users"></i>
                <span>12 Akun</span>
            </div>

            <button
                type="button"
                id="tambahAkunBtn"
                class="btn-tambah-akun"
            >
                <i class="fa-solid fa-plus"></i>
                Tambah Akun
            </button>

        </div>

    </div>


    {{-- =========================
        FILTER DAN SEARCH
    ========================== --}}
    <div class="akun-filter-card">

        <div class="search-box akun-search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="searchAkun"
                placeholder="Cari nama atau email..."
            >

        </div>


        <div class="filter-select">

            <select id="filterRole">

                <option value="">Semua Role</option>
                <option value="masyarakat">Masyarakat</option>
                <option value="admin">Admin</option>

            </select>

            <i class="fa-solid fa-chevron-down"></i>

        </div>


        <div class="filter-select filter-divisi">

            <select id="filterDivisi">

                <option value="">Semua Divisi</option>
                <option value="PUPR">PUPR</option>
                <option value="Perhubungan">Perhubungan</option>
                <option value="Perumahan & Permukiman">
                    Perumahan & Permukiman
                </option>
                <option value="DLH">DLH</option>

            </select>

            <i class="fa-solid fa-chevron-down"></i>

        </div>

    </div>


    {{-- =========================
        TABLE
    ========================== --}}
    <div class="akun-table-card">

        <div class="table-responsive">

            <table class="akun-table">

                <thead>

                    <tr>

                        <th class="col-no">NO.</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>DIVISI</th>
                        <th class="col-aksi">AKSI</th>

                    </tr>

                </thead>


                <tbody>

                    {{-- DATA STATIC 1 --}}
                    <tr
                        class="akun-row"
                        data-nama="Fadly"
                        data-email="fadly@example.com"
                        data-role="masyarakat"
                        data-divisi=""
                    >

                        <td>1</td>

                        <td>

                            <div class="akun-user">

                                <div class="akun-avatar">
                                    F
                                </div>

                                <span>Fadly</span>

                            </div>

                        </td>

                        <td>fadly@example.com</td>

                        <td>
                            <span class="role-badge role-masyarakat">
                                Masyarakat
                            </span>
                        </td>

                        <td>
                            <span class="divisi-empty">—</span>
                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                                data-nama="Fadly"
                                data-email="fadly@example.com"
                                data-role="masyarakat"
                                data-divisi=""
                            >
                                <i class="fa-regular fa-pen-to-square"></i>
                                Edit
                            </button>

                            <button
                                type="button"
                                class="btn-hapus"
                                data-nama="Fadly"
                            >
                                <i class="fa-regular fa-trash-can"></i>
                                Hapus
                            </button>

                        </td>

                    </tr>


                    {{-- DATA STATIC 2 --}}
                    <tr
                        class="akun-row"
                        data-nama="Ahmad Rizki"
                        data-email="ahmad@laporinfra.go.id"
                        data-role="admin"
                        data-divisi="PUPR"
                    >

                        <td>2</td>

                        <td>

                            <div class="akun-user">

                                <div class="akun-avatar">
                                    A
                                </div>

                                <span>Ahmad Rizki</span>

                            </div>

                        </td>

                        <td>ahmad@laporinfra.go.id</td>

                        <td>
                            <span class="role-badge role-admin">
                                Admin
                            </span>
                        </td>

                        <td>
                            <span class="divisi-badge">
                                PUPR
                            </span>
                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                                data-nama="Ahmad Rizki"
                                data-email="ahmad@laporinfra.go.id"
                                data-role="admin"
                                data-divisi="PUPR"
                            >
                                <i class="fa-regular fa-pen-to-square"></i>
                                Edit
                            </button>

                            <button
                                type="button"
                                class="btn-hapus"
                                data-nama="Ahmad Rizki"
                            >
                                <i class="fa-regular fa-trash-can"></i>
                                Hapus
                            </button>

                        </td>

                    </tr>


                    {{-- DATA STATIC 3 --}}
                    <tr
                        class="akun-row"
                        data-nama="Siti Rahma"
                        data-email="siti@laporinfra.go.id"
                        data-role="admin"
                        data-divisi="Perhubungan"
                    >

                        <td>3</td>

                        <td>

                            <div class="akun-user">

                                <div class="akun-avatar">
                                    S
                                </div>

                                <span>Siti Rahma</span>

                            </div>

                        </td>

                        <td>siti@laporinfra.go.id</td>

                        <td>
                            <span class="role-badge role-admin">
                                Admin
                            </span>
                        </td>

                        <td>
                            <span class="divisi-badge">
                                Perhubungan
                            </span>
                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                                data-nama="Siti Rahma"
                                data-email="siti@laporinfra.go.id"
                                data-role="admin"
                                data-divisi="Perhubungan"
                            >
                                <i class="fa-regular fa-pen-to-square"></i>
                                Edit
                            </button>

                            <button
                                type="button"
                                class="btn-hapus"
                                data-nama="Siti Rahma"
                            >
                                <i class="fa-regular fa-trash-can"></i>
                                Hapus
                            </button>

                        </td>

                    </tr>


                    {{-- DATA STATIC 4 --}}
                    <tr
                        class="akun-row"
                        data-nama="Budi Santoso"
                        data-email="budi@laporinfra.go.id"
                        data-role="admin"
                        data-divisi="Perumahan & Permukiman"
                    >

                        <td>4</td>

                        <td>

                            <div class="akun-user">

                                <div class="akun-avatar">
                                    B
                                </div>

                                <span>Budi Santoso</span>

                            </div>

                        </td>

                        <td>budi@laporinfra.go.id</td>

                        <td>
                            <span class="role-badge role-admin">
                                Admin
                            </span>
                        </td>

                        <td>
                            <span class="divisi-badge">
                                Perumahan &amp; Permukiman
                            </span>
                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                                data-nama="Budi Santoso"
                                data-email="budi@laporinfra.go.id"
                                data-role="admin"
                                data-divisi="Perumahan & Permukiman"
                            >
                                <i class="fa-regular fa-pen-to-square"></i>
                                Edit
                            </button>

                            <button
                                type="button"
                                class="btn-hapus"
                                data-nama="Budi Santoso"
                            >
                                <i class="fa-regular fa-trash-can"></i>
                                Hapus
                            </button>

                        </td>

                    </tr>


                    {{-- DATA STATIC 5 --}}
                    <tr
                        class="akun-row"
                        data-nama="Rina Putri"
                        data-email="rina@laporinfra.go.id"
                        data-role="admin"
                        data-divisi="DLH"
                    >

                        <td>5</td>

                        <td>

                            <div class="akun-user">

                                <div class="akun-avatar">
                                    R
                                </div>

                                <span>Rina Putri</span>

                            </div>

                        </td>

                        <td>rina@laporinfra.go.id</td>

                        <td>
                            <span class="role-badge role-admin">
                                Admin
                            </span>
                        </td>

                        <td>
                            <span class="divisi-badge">
                                DLH
                            </span>
                        </td>

                        <td class="aksi-column">

                            <button
                                type="button"
                                class="btn-edit"
                                data-nama="Rina Putri"
                                data-email="rina@laporinfra.go.id"
                                data-role="admin"
                                data-divisi="DLH"
                            >
                                <i class="fa-regular fa-pen-to-square"></i>
                                Edit
                            </button>

                            <button
                                type="button"
                                class="btn-hapus"
                                data-nama="Rina Putri"
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


    {{-- =========================
        FOOTER TABLE
    ========================== --}}
    <div class="akun-table-footer">

        <p>
            Menampilkan 1–5 dari 12 akun
        </p>

        <div class="pagination">

            <button
                type="button"
                class="pagination-btn"
                id="prevPage"
                disabled
            >
                <i class="fa-solid fa-chevron-left"></i>
                Sebelumnya
            </button>

            <button
                type="button"
                class="pagination-number active"
            >
                1
            </button>

            <button
                type="button"
                class="pagination-btn"
                id="nextPage"
            >
                Berikutnya
                <i class="fa-solid fa-chevron-right"></i>
            </button>

        </div>

    </div>

</div>



{{-- =====================================================
    MODAL TAMBAH AKUN
===================================================== --}}
<div
    class="modal-overlay"
    id="modalTambahAkun"
>

    <div class="modal-box modal-akun">

        <div class="modal-header">

            <h3>Tambah Akun</h3>

            <button
                type="button"
                class="modal-close"
                id="closeTambah"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        <div class="modal-body">

            <div class="form-group">

                <label>
                    Nama Lengkap
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="tambahNama"
                    placeholder="Masukkan nama lengkap"
                >

            </div>


            <div class="form-group">

                <label>
                    Email
                    <span>*</span>
                </label>

                <input
                    type="email"
                    id="tambahEmail"
                    placeholder="email@example.com"
                >

            </div>


            <div class="form-group">

                <label>
                    Password
                    <span>*</span>
                </label>

                <input
                    type="password"
                    id="tambahPassword"
                    placeholder="Minimal 6 karakter"
                >

            </div>


            <div class="form-group">

                <label>
                    Konfirmasi Password
                    <span>*</span>
                </label>

                <input
                    type="password"
                    id="tambahKonfirmasiPassword"
                    placeholder="Ulangi password"
                >

            </div>


            <div class="form-group">

                <label>
                    Role
                    <span>*</span>
                </label>

                <div class="role-selector">

                    <button
                        type="button"
                        class="role-option active"
                        data-role-target="tambah"
                        data-role-value="masyarakat"
                    >
                        Masyarakat
                    </button>

                    <button
                        type="button"
                        class="role-option"
                        data-role-target="tambah"
                        data-role-value="admin"
                    >
                        Admin
                    </button>

                </div>

                <input
                    type="hidden"
                    id="tambahRole"
                    value="masyarakat"
                >

            </div>


            <div class="form-group">

                <label>Divisi</label>

                <select
                    id="tambahDivisi"
                    class="modal-select"
                    disabled
                >

                    <option value="">
                        Tidak ada divisi
                    </option>

                    <option value="PUPR">
                        PUPR
                    </option>

                    <option value="Perhubungan">
                        Perhubungan
                    </option>

                    <option value="Perumahan & Permukiman">
                        Perumahan & Permukiman
                    </option>

                    <option value="DLH">
                        DLH
                    </option>

                </select>

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-modal-cancel"
                id="batalTambah"
            >
                Batal
            </button>

            <button
                type="button"
                class="btn-modal-save"
                id="simpanTambah"
            >
                Simpan Akun
            </button>

        </div>

    </div>

</div>



{{-- =====================================================
    MODAL EDIT AKUN
===================================================== --}}
<div
    class="modal-overlay"
    id="modalEditAkun"
>

    <div class="modal-box modal-akun">

        <div class="modal-header">

            <h3>Edit Akun</h3>

            <button
                type="button"
                class="modal-close"
                id="closeEdit"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        <div class="modal-body">

            <div class="form-group">

                <label>
                    Nama Lengkap
                    <span>*</span>
                </label>

                <input
                    type="text"
                    id="editNama"
                    placeholder="Masukkan nama lengkap"
                >

            </div>


            <div class="form-group">

                <label>
                    Email
                    <span>*</span>
                </label>

                <input
                    type="email"
                    id="editEmail"
                    placeholder="email@example.com"
                >

            </div>


            <div class="password-section">

                <p class="password-info">
                    Kosongkan jika tidak ingin mengubah password.
                </p>


                <div class="form-group">

                    <label>Password Baru</label>

                    <input
                        type="password"
                        id="editPassword"
                        placeholder="Kosongkan jika tidak diubah"
                    >

                </div>


                <div class="form-group">

                    <label>Konfirmasi Password Baru</label>

                    <input
                        type="password"
                        id="editKonfirmasiPassword"
                        placeholder="Ulangi password"
                    >

                </div>

            </div>


            <div class="form-group">

                <label>
                    Role
                    <span>*</span>
                </label>

                <div class="role-selector">

                    <button
                        type="button"
                        class="role-option"
                        data-role-target="edit"
                        data-role-value="masyarakat"
                    >
                        Masyarakat
                    </button>

                    <button
                        type="button"
                        class="role-option"
                        data-role-target="edit"
                        data-role-value="admin"
                    >
                        Admin
                    </button>

                </div>

                <input
                    type="hidden"
                    id="editRole"
                >

            </div>


            <div class="form-group">

                <label>Divisi</label>

                <select
                    id="editDivisi"
                    class="modal-select"
                >

                    <option value="">
                        Tidak ada divisi
                    </option>

                    <option value="PUPR">
                        PUPR
                    </option>

                    <option value="Perhubungan">
                        Perhubungan
                    </option>

                    <option value="Perumahan & Permukiman">
                        Perumahan & Permukiman
                    </option>

                    <option value="DLH">
                        DLH
                    </option>

                </select>

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn-modal-cancel"
                id="batalEdit"
            >
                Batal
            </button>

            <button
                type="button"
                class="btn-modal-save"
                id="simpanEdit"
            >
                Simpan Akun
            </button>

        </div>

    </div>

</div>



{{-- =====================================================
    MODAL HAPUS AKUN
===================================================== --}}
<div
    class="modal-overlay"
    id="modalHapusAkun"
>

    <div class="modal-box modal-hapus-box">

        <div class="hapus-icon">

            <i class="fa-regular fa-trash-can"></i>

        </div>


        <h3>Hapus Akun</h3>

        <p class="hapus-question">
            Apakah Anda yakin ingin menghapus akun ini?
        </p>

        <p class="hapus-description">

            Akun
            <strong id="hapusNamaAkun">
                Fadly
            </strong>

            akan dihapus secara permanen.
            Data akun yang dihapus tidak dapat dipulihkan.

        </p>


        <div class="modal-footer modal-footer-hapus">

            <button
                type="button"
                class="btn-modal-cancel"
                id="batalHapus"
            >
                Batal
            </button>

            <button
                type="button"
                class="btn-modal-delete"
                id="konfirmasiHapus"
            >
                Hapus
            </button>

        </div>

    </div>

</div>



{{-- =====================================================
    JAVASCRIPT
===================================================== --}}
<script>

document.addEventListener('DOMContentLoaded', function () {


    // =====================================================
    // AMBIL ELEMEN
    // =====================================================

    const tambahAkunBtn = document.getElementById('tambahAkunBtn');

    const modalTambah = document.getElementById('modalTambahAkun');
    const modalEdit = document.getElementById('modalEditAkun');
    const modalHapus = document.getElementById('modalHapusAkun');


    const closeTambah = document.getElementById('closeTambah');
    const closeEdit = document.getElementById('closeEdit');


    const batalTambah = document.getElementById('batalTambah');
    const batalEdit = document.getElementById('batalEdit');
    const batalHapus = document.getElementById('batalHapus');


    const simpanTambah = document.getElementById('simpanTambah');
    const simpanEdit = document.getElementById('simpanEdit');
    const konfirmasiHapus = document.getElementById('konfirmasiHapus');


    const editButtons = document.querySelectorAll('.btn-edit');
    const hapusButtons = document.querySelectorAll('.btn-hapus');


    // =====================================================
    // BUKA MODAL TAMBAH
    // =====================================================

    if (tambahAkunBtn) {

        tambahAkunBtn.addEventListener('click', function () {

            modalTambah.classList.add('active');

        });

    }


    // =====================================================
    // TUTUP MODAL TAMBAH
    // =====================================================

    if (closeTambah) {

        closeTambah.addEventListener('click', function () {

            modalTambah.classList.remove('active');

        });

    }


    if (batalTambah) {

        batalTambah.addEventListener('click', function () {

            modalTambah.classList.remove('active');

        });

    }


    // =====================================================
    // SIMPAN TAMBAH
    // HANYA FUNGSI TAMPILAN
    // =====================================================

    if (simpanTambah) {

        simpanTambah.addEventListener('click', function () {

            modalTambah.classList.remove('active');

        });

    }


    // =====================================================
    // BUKA MODAL EDIT
    // =====================================================

    editButtons.forEach(function (button) {

        button.addEventListener('click', function () {


            const nama = this.getAttribute('data-nama');
            const email = this.getAttribute('data-email');
            const role = this.getAttribute('data-role');
            const divisi = this.getAttribute('data-divisi');


            document.getElementById('editNama').value = nama;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;


            const editDivisi = document.getElementById('editDivisi');

            editDivisi.value = divisi;


            // RESET ROLE BUTTON
            document
                .querySelectorAll('[data-role-target="edit"]')
                .forEach(function (roleButton) {

                    roleButton.classList.remove('active');

                });


            // AKTIFKAN ROLE YANG SESUAI
            const selectedRole = document.querySelector(
                '[data-role-target="edit"][data-role-value="' + role + '"]'
            );


            if (selectedRole) {

                selectedRole.classList.add('active');

            }


            // JIKA MASYARAKAT
            if (role === 'masyarakat') {

                editDivisi.value = '';
                editDivisi.disabled = true;

            } else {

                editDivisi.disabled = false;

            }


            modalEdit.classList.add('active');

        });

    });


    // =====================================================
    // TUTUP MODAL EDIT
    // =====================================================

    if (closeEdit) {

        closeEdit.addEventListener('click', function () {

            modalEdit.classList.remove('active');

        });

    }


    if (batalEdit) {

        batalEdit.addEventListener('click', function () {

            modalEdit.classList.remove('active');

        });

    }


    // =====================================================
    // SIMPAN EDIT
    // =====================================================

    if (simpanEdit) {

        simpanEdit.addEventListener('click', function () {

            modalEdit.classList.remove('active');

        });

    }


    // =====================================================
    // BUKA MODAL HAPUS
    // =====================================================

    hapusButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const nama = this.getAttribute('data-nama');


            document.getElementById('hapusNamaAkun').textContent = nama;


            modalHapus.classList.add('active');

        });

    });


    // =====================================================
    // BATAL HAPUS
    // =====================================================

    if (batalHapus) {

        batalHapus.addEventListener('click', function () {

            modalHapus.classList.remove('active');

        });

    }


    // =====================================================
    // KONFIRMASI HAPUS
    // HANYA TAMPILAN
    // =====================================================

    if (konfirmasiHapus) {

        konfirmasiHapus.addEventListener('click', function () {

            modalHapus.classList.remove('active');

        });

    }


    // =====================================================
    // ROLE SELECTOR
    // =====================================================

    const roleOptions = document.querySelectorAll('.role-option');


    roleOptions.forEach(function (button) {

        button.addEventListener('click', function () {


            const target = this.getAttribute('data-role-target');
            const role = this.getAttribute('data-role-value');


            document
                .querySelectorAll(
                    '[data-role-target="' + target + '"]'
                )
                .forEach(function (item) {

                    item.classList.remove('active');

                });


            this.classList.add('active');


            if (target === 'tambah') {

                document.getElementById('tambahRole').value = role;


                const tambahDivisi =
                    document.getElementById('tambahDivisi');


                if (role === 'masyarakat') {

                    tambahDivisi.value = '';
                    tambahDivisi.disabled = true;

                } else {

                    tambahDivisi.disabled = false;

                }

            }


            if (target === 'edit') {

                document.getElementById('editRole').value = role;


                const editDivisi =
                    document.getElementById('editDivisi');


                if (role === 'masyarakat') {

                    editDivisi.value = '';
                    editDivisi.disabled = true;

                } else {

                    editDivisi.disabled = false;

                }

            }


        });

    });


    // =====================================================
    // TUTUP MODAL SAAT KLIK OVERLAY
    // =====================================================

    window.addEventListener('click', function (event) {


        if (event.target === modalTambah) {

            modalTambah.classList.remove('active');

        }


        if (event.target === modalEdit) {

            modalEdit.classList.remove('active');

        }


        if (event.target === modalHapus) {

            modalHapus.classList.remove('active');

        }


    });


    // =====================================================
    // SEARCH DAN FILTER
    // =====================================================

    const searchInput =
        document.getElementById('searchAkun');

    const filterRole =
        document.getElementById('filterRole');

    const filterDivisi =
        document.getElementById('filterDivisi');

    const akunRows =
        document.querySelectorAll('.akun-row');


    function filterAkun() {


        const keyword =
            searchInput.value.toLowerCase();

        const selectedRole =
            filterRole.value.toLowerCase();

        const selectedDivisi =
            filterDivisi.value.toLowerCase();


        akunRows.forEach(function (row) {


            const nama =
                row.getAttribute('data-nama').toLowerCase();

            const email =
                row.getAttribute('data-email').toLowerCase();

            const role =
                row.getAttribute('data-role').toLowerCase();

            const divisi =
                row.getAttribute('data-divisi').toLowerCase();


            const cocokSearch =
                nama.includes(keyword) ||
                email.includes(keyword);


            const cocokRole =
                selectedRole === '' ||
                role === selectedRole;


            const cocokDivisi =
                selectedDivisi === '' ||
                divisi === selectedDivisi;


            if (
                cocokSearch &&
                cocokRole &&
                cocokDivisi
            ) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }


        });


    }


    if (searchInput) {

        searchInput.addEventListener('input', filterAkun);

    }


    if (filterRole) {

        filterRole.addEventListener('change', filterAkun);

    }


    if (filterDivisi) {

        filterDivisi.addEventListener('change', filterAkun);

    }


});

</script>

@endsection