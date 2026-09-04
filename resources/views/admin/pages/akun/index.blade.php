@extends('admin.layouts.app')

@section('title', 'Kelola Akun')

@section('page-title', 'Kelola Akun')

@section('page-description', 'Kelola akun pengguna yang terdaftar pada sistem LAPORINFRA.')

@push('styles')
    @vite('resources/css/admin/akun.css')
@endpush


@section('content')

    {{-- =====================================================
        ALERT
    ====================================================== --}}

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


    <div class="akun-page">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="akun-header">

            <div class="akun-header-text">

                <h1>
                    Kelola Akun
                </h1>

                <p>
                    Kelola akun pengguna yang terdaftar pada sistem LAPORINFRA.
                </p>

            </div>


            <div class="akun-header-action">

                <div class="akun-total">

                    <i class="fa-solid fa-users"></i>

                    <span>
                        {{ $akun->count() }} Akun
                    </span>

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


        {{-- =====================================================
            FILTER
        ====================================================== --}}

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

                    <option value="">
                        Semua Role
                    </option>

                    @foreach ($role as $item)

                        <option value="{{ $item }}">

                            {{ $item === 'opd' ? 'OPD' : ucfirst($item) }}

                        </option>

                    @endforeach

                </select>

                <i class="fa-solid fa-chevron-down"></i>

            </div>


            <div class="filter-select filter-divisi">

                <select id="filterDivisi">

                    <option value="">
                        Semua OPD
                    </option>

                    @foreach ($devisi as $item)

                        <option value="{{ $item->nama_devisi }}">
                            {{ $item->nama_devisi }}
                        </option>

                    @endforeach

                </select>

                <i class="fa-solid fa-chevron-down"></i>

            </div>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}

        <div class="akun-table-card">

            <div class="table-responsive">

                <table class="akun-table">

                    <thead>

                        <tr>

                            <th class="col-no">
                                NO.
                            </th>

                            <th>
                                NAMA
                            </th>

                            <th>
                                EMAIL
                            </th>

                            <th>
                                ROLE
                            </th>

                            <th>
                                OPD
                            </th>

                            <th class="col-aksi">
                                AKSI
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($akun as $index => $item)

                            <tr
                                class="akun-row"

                                data-id="{{ $item->id_user }}"

                                data-nama="{{ $item->nama_user }}"

                                data-email="{{ $item->email }}"

                                data-role="{{ $item->role }}"

                                data-divisi="{{ $item->devisi?->nama_devisi ?? '' }}"
                            >

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                <td>

                                    <div class="akun-user">

                                        <div class="akun-avatar">

                                            {{ strtoupper(substr($item->nama_user, 0, 1)) }}

                                        </div>


                                        <span>
                                            {{ $item->nama_user }}
                                        </span>

                                    </div>

                                </td>


                                <td>
                                    {{ $item->email }}
                                </td>


                                <td>

                                    <span class="role-badge role-{{ $item->role }}">

                                        {{ $item->role === 'opd'
                                            ? 'OPD'
                                            : ucfirst($item->role) }}

                                    </span>

                                </td>


                                <td>

                                    <span class="divisi-badge">

                                        {{ $item->devisi?->nama_devisi ?? '-' }}

                                    </span>

                                </td>


                                <td class="aksi-column">

                                    <button
                                        type="button"
                                        class="btn-edit"

                                        data-id="{{ $item->id_user }}"

                                        data-nama="{{ $item->nama_user }}"

                                        data-email="{{ $item->email }}"

                                        data-role="{{ $item->role }}"

                                        data-nip="{{ $item->nip ?? '' }}"

                                        data-divisi="{{ $item->id_devisi ?? '' }}"
                                    >

                                        <i class="fa-regular fa-pen-to-square"></i>

                                        Edit

                                    </button>


                                    <button
                                        type="button"
                                        class="btn-hapus"

                                        data-id="{{ $item->id_user }}"

                                        data-nama="{{ $item->nama_user }}"
                                    >

                                        <i class="fa-regular fa-trash-can"></i>

                                        Hapus

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-state"
                                >
                                    Belum ada akun.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =====================================================
            MODAL TAMBAH
        ====================================================== --}}

        <div
            class="modal-overlay"
            id="modalTambahAkun"
        >

            <div class="modal-box modal-akun">

                <div class="modal-header">

                    <h3>
                        Tambah Akun
                    </h3>


                    <button
                        type="button"
                        class="modal-close"
                        id="closeTambah"
                    >

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>


                <form
                    action="{{ route('admin.akun.store') }}"
                    method="POST"
                >

                    @csrf


                    <div class="modal-body">

                        {{-- NAMA --}}

                        <div class="form-group">

                            <label>
                                Nama Lengkap
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_user"
                                id="tambahNama"
                                placeholder="Masukkan nama lengkap"
                                required
                            >

                        </div>


                        {{-- EMAIL --}}

                        <div class="form-group">

                            <label>
                                Email
                                <span>*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="tambahEmail"
                                placeholder="email@example.com"
                                required
                            >

                        </div>


                        {{-- ROLE --}}

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
                                    data-role-value="opd"
                                >
                                    OPD
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
                                name="role"
                                id="tambahRole"
                                value="masyarakat"
                            >

                        </div>


                        {{-- PASSWORD --}}

                        <div
                            class="form-group"
                            id="tambahPasswordGroup"
                        >

                            <label>
                                Password
                                <span>*</span>
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="tambahPassword"
                                placeholder="Minimal 8 karakter"
                            >

                        </div>


                        {{-- KONFIRMASI --}}

                        <div
                            class="form-group"
                            id="tambahPasswordConfirmGroup"
                        >

                            <label>
                                Konfirmasi Password
                                <span>*</span>
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="tambahKonfirmasiPassword"
                                placeholder="Ulangi password"
                            >

                        </div>


                        {{-- NIP --}}

                        <div
                            class="form-group"
                            id="tambahNipGroup"
                            style="display: none;"
                        >

                            <label>
                                NIP
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="nip"
                                id="tambahNip"
                                placeholder="Masukkan NIP"
                                disabled
                            >

                        </div>


                        {{-- OPD --}}

                        <div
                            class="form-group"
                            id="tambahDivisiGroup"
                            style="display: none;"
                        >

                            <label>
                                OPD
                                <span>*</span>
                            </label>


                            <select
                                name="id_devisi"
                                id="tambahDivisi"
                                class="modal-select"
                                disabled
                            >

                                <option value="">
                                    Pilih OPD...
                                </option>


                                @foreach ($devisi as $item)

                                    <option value="{{ $item->id_devisi }}">
                                        {{ $item->nama_devisi }}
                                    </option>

                                @endforeach

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
                            type="submit"
                            class="btn-modal-save"
                        >
                            Simpan Akun
                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- =====================================================
            MODAL EDIT
        ====================================================== --}}

        <div
            class="modal-overlay"
            id="modalEditAkun"
        >

            <div class="modal-box modal-akun">

                <div class="modal-header">

                    <h3>
                        Edit Akun
                    </h3>


                    <button
                        type="button"
                        class="modal-close"
                        id="closeEdit"
                    >

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>


                <form
                    id="editAkunForm"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">

                        {{-- NAMA --}}

                        <div class="form-group">

                            <label>
                                Nama Lengkap
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_user"
                                id="editNama"
                                required
                            >

                        </div>


                        {{-- EMAIL --}}

                        <div class="form-group">

                            <label>
                                Email
                                <span>*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="editEmail"
                                required
                            >

                        </div>


                        {{-- ROLE --}}

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
                                    data-role-value="opd"
                                >
                                    OPD
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
                                name="role"
                                id="editRole"
                            >

                        </div>


                        {{-- NIP --}}

                        <div
                            class="form-group"
                            id="editNipGroup"
                            style="display: none;"
                        >

                            <label>
                                NIP
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="nip"
                                id="editNip"
                                disabled
                            >

                        </div>


                        {{-- OPD --}}

                        <div
                            class="form-group"
                            id="editDivisiGroup"
                            style="display: none;"
                        >

                            <label>
                                OPD
                                <span>*</span>
                            </label>

                            <select
                                name="id_devisi"
                                id="editDivisi"
                                class="modal-select"
                                disabled
                            >

                                <option value="">
                                    Pilih OPD...
                                </option>


                                @foreach ($devisi as $item)

                                    <option value="{{ $item->id_devisi }}">
                                        {{ $item->nama_devisi }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- PASSWORD --}}

                        <div class="form-group">

                            <label>
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="editPassword"
                                placeholder="Kosongkan jika tidak diubah"
                            >

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}

                        <div class="form-group">

                            <label>
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="editKonfirmasiPassword"
                                placeholder="Ulangi password baru"
                            >

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
                            type="submit"
                            class="btn-modal-save"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- =====================================================
            MODAL HAPUS
        ====================================================== --}}

        <div
            class="modal-overlay"
            id="modalHapusAkun"
        >

            <div class="modal-box modal-hapus-box">

                <div class="hapus-icon">

                    <i class="fa-regular fa-trash-can"></i>

                </div>


                <h3>
                    Hapus Akun
                </h3>


                <p class="hapus-question">
                    Apakah Anda yakin ingin menghapus akun ini?
                </p>


                <p class="hapus-description">

                    Akun

                    <strong id="hapusNamaAkun">
                        -
                    </strong>

                    akan dihapus secara permanen.

                </p>


                <form
                    id="hapusAkunForm"
                    method="POST"
                >

                    @csrf

                    @method('DELETE')


                    <div class="modal-footer modal-footer-hapus">

                        <button
                            type="button"
                            class="btn-modal-cancel"
                            id="batalHapus"
                        >
                            Batal
                        </button>


                        <button
                            type="submit"
                            class="btn-modal-delete"
                        >
                            Hapus
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =====================================================
        JAVASCRIPT
    ====================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /* =====================================================
               ELEMENT
            ===================================================== */

            const tambahBtn =
                document.getElementById('tambahAkunBtn');

            const modalTambah =
                document.getElementById('modalTambahAkun');

            const modalEdit =
                document.getElementById('modalEditAkun');

            const modalHapus =
                document.getElementById('modalHapusAkun');


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


            const editForm =
                document.getElementById('editAkunForm');

            const deleteForm =
                document.getElementById('hapusAkunForm');


            /* =====================================================
               MODAL HELPER
            ===================================================== */

            function buka(modal) {
                modal.classList.add('active');
            }


            function tutup(modal) {
                modal.classList.remove('active');
            }


            /* =====================================================
               TAMBAH AKUN
            ===================================================== */

            tambahBtn.addEventListener('click', function () {

                document.getElementById('tambahRole').value =
                    'masyarakat';


                document
                    .querySelectorAll(
                        '[data-role-target="tambah"]'
                    )
                    .forEach(function (button) {

                        button.classList.remove('active');

                    });


                const masyarakatButton =
                    document.querySelector(
                        '[data-role-target="tambah"][data-role-value="masyarakat"]'
                    );


                if (masyarakatButton) {

                    masyarakatButton.classList.add('active');

                }


                updateTambahForm('masyarakat');


                buka(modalTambah);

            });


            closeTambah.addEventListener('click', function () {
                tutup(modalTambah);
            });


            batalTambah.addEventListener('click', function () {
                tutup(modalTambah);
            });


            /* =====================================================
               FORM TAMBAH BERDASARKAN ROLE
            ===================================================== */

            function updateTambahForm(role) {

                const passwordGroup =
                    document.getElementById(
                        'tambahPasswordGroup'
                    );

                const passwordConfirmGroup =
                    document.getElementById(
                        'tambahPasswordConfirmGroup'
                    );

                const nipGroup =
                    document.getElementById(
                        'tambahNipGroup'
                    );

                const divisiGroup =
                    document.getElementById(
                        'tambahDivisiGroup'
                    );


                const password =
                    document.getElementById(
                        'tambahPassword'
                    );

                const passwordConfirm =
                    document.getElementById(
                        'tambahKonfirmasiPassword'
                    );

                const nip =
                    document.getElementById(
                        'tambahNip'
                    );

                const divisi =
                    document.getElementById(
                        'tambahDivisi'
                    );


                /* Sembunyikan field */

                passwordGroup.style.display = 'none';

                passwordConfirmGroup.style.display = 'none';

                nipGroup.style.display = 'none';

                divisiGroup.style.display = 'none';


                /* Disable field OPD */

                nip.disabled = true;

                divisi.disabled = true;


                /* Bersihkan field OPD */

                nip.value = '';

                divisi.value = '';


                /* =================================================
                   MASYARAKAT
                ================================================= */

                if (role === 'masyarakat') {

                    passwordGroup.style.display = '';

                    passwordConfirmGroup.style.display = '';

                    password.disabled = false;

                    passwordConfirm.disabled = false;

                }


                /* =================================================
                   OPD
                ================================================= */

                if (role === 'opd') {

                    passwordGroup.style.display = '';

                    passwordConfirmGroup.style.display = '';

                    nipGroup.style.display = '';

                    divisiGroup.style.display = '';

                    password.disabled = false;

                    passwordConfirm.disabled = false;

                    nip.disabled = false;

                    divisi.disabled = false;

                }


                /* =================================================
                   ADMIN
                ================================================= */

                if (role === 'admin') {

                    password.value = '';

                    passwordConfirm.value = '';

                    password.disabled = true;

                    passwordConfirm.disabled = true;

                }

            }


            /* =====================================================
               EDIT
            ===================================================== */

            document
                .querySelectorAll('.btn-edit')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const id =
                            this.dataset.id;

                        const nama =
                            this.dataset.nama;

                        const email =
                            this.dataset.email;

                        const role =
                            this.dataset.role;

                        const nip =
                            this.dataset.nip || '';

                        const divisi =
                            this.dataset.divisi || '';


                        document.getElementById(
                            'editNama'
                        ).value = nama;


                        document.getElementById(
                            'editEmail'
                        ).value = email;


                        document.getElementById(
                            'editNip'
                        ).value = nip;


                        document.getElementById(
                            'editRole'
                        ).value = role;


                        document.getElementById(
                            'editDivisi'
                        ).value = divisi;


                        editForm.action =
                            '/admin/akun/update/' + id;


                        /* Reset tombol role */

                        document
                            .querySelectorAll(
                                '[data-role-target="edit"]'
                            )
                            .forEach(function (item) {

                                item.classList.remove('active');

                            });


                        /* Aktifkan role yang sesuai */

                        const selectedRole =
                            document.querySelector(
                                '[data-role-target="edit"][data-role-value="' +
                                role +
                                '"]'
                            );


                        if (selectedRole) {

                            selectedRole.classList.add('active');

                        }


                        updateEditForm(role);


                        buka(modalEdit);

                    });

                });


            /* =====================================================
               FORM EDIT BERDASARKAN ROLE
            ===================================================== */

            function updateEditForm(role) {

                const nipGroup =
                    document.getElementById(
                        'editNipGroup'
                    );

                const divisiGroup =
                    document.getElementById(
                        'editDivisiGroup'
                    );

                const nip =
                    document.getElementById(
                        'editNip'
                    );

                const divisi =
                    document.getElementById(
                        'editDivisi'
                    );


                /* Sembunyikan */

                nipGroup.style.display = 'none';

                divisiGroup.style.display = 'none';


                /* Disable */

                nip.disabled = true;

                divisi.disabled = true;


                /* =================================================
                   OPD
                ================================================= */

                if (role === 'opd') {

                    nipGroup.style.display = '';

                    divisiGroup.style.display = '';

                    nip.disabled = false;

                    divisi.disabled = false;

                } else {

                    nip.value = '';

                    divisi.value = '';

                }


                /* =================================================
                   ADMIN
                ================================================= */

                if (role === 'admin') {

                    document.getElementById(
                        'editPassword'
                    ).value = '';

                    document.getElementById(
                        'editKonfirmasiPassword'
                    ).value = '';

                }

            }


            closeEdit.addEventListener('click', function () {
                tutup(modalEdit);
            });


            batalEdit.addEventListener('click', function () {
                tutup(modalEdit);
            });


            /* =====================================================
               ROLE SELECTOR
            ===================================================== */

            document
                .querySelectorAll('.role-option')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const target =
                            this.dataset.roleTarget;

                        const role =
                            this.dataset.roleValue;


                        document
                            .querySelectorAll(
                                '[data-role-target="' +
                                target +
                                '"]'
                            )
                            .forEach(function (item) {

                                item.classList.remove('active');

                            });


                        this.classList.add('active');


                        /* Tambah */

                        if (target === 'tambah') {

                            document.getElementById(
                                'tambahRole'
                            ).value = role;


                            updateTambahForm(role);

                        }


                        /* Edit */

                        if (target === 'edit') {

                            document.getElementById(
                                'editRole'
                            ).value = role;


                            updateEditForm(role);

                        }

                    });

                });


            /* =====================================================
               DELETE
            ===================================================== */

            document
                .querySelectorAll('.btn-hapus')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const id =
                            this.dataset.id;

                        const nama =
                            this.dataset.nama;


                        document.getElementById(
                            'hapusNamaAkun'
                        ).textContent = nama;


                        deleteForm.action =
                            '/admin/akun/delete/' + id;


                        buka(modalHapus);

                    });

                });


            batalHapus.addEventListener('click', function () {
                tutup(modalHapus);
            });


            /* =====================================================
               KLIK OVERLAY
            ===================================================== */

            window.addEventListener('click', function (event) {

                if (event.target === modalTambah) {
                    tutup(modalTambah);
                }

                if (event.target === modalEdit) {
                    tutup(modalEdit);
                }

                if (event.target === modalHapus) {
                    tutup(modalHapus);
                }

            });


            /* =====================================================
               ESCAPE
            ===================================================== */

            document.addEventListener('keydown', function (event) {

                if (event.key === 'Escape') {

                    tutup(modalTambah);

                    tutup(modalEdit);

                    tutup(modalHapus);

                }

            });


            /* =====================================================
               SEARCH + FILTER
            ===================================================== */

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
                    searchInput.value
                    .toLowerCase()
                    .trim();


                const selectedRole =
                    filterRole.value
                    .toLowerCase();


                const selectedDivisi =
                    filterDivisi.value
                    .toLowerCase();


                akunRows.forEach(function (row) {

                    const nama =
                        row.dataset.nama
                        .toLowerCase();


                    const email =
                        row.dataset.email
                        .toLowerCase();


                    const role =
                        row.dataset.role
                        .toLowerCase();


                    const divisi =
                        row.dataset.divisi
                        .toLowerCase();


                    const cocokSearch =
                        nama.includes(keyword) ||
                        email.includes(keyword);


                    const cocokRole =
                        selectedRole === '' ||
                        role === selectedRole;


                    const cocokDivisi =
                        selectedDivisi === '' ||
                        divisi === selectedDivisi;


                    row.style.display =
                        cocokSearch &&
                        cocokRole &&
                        cocokDivisi
                            ? ''
                            : 'none';

                });

            }


            searchInput.addEventListener(
                'input',
                filterAkun
            );


            filterRole.addEventListener(
                'change',
                filterAkun
            );


            filterDivisi.addEventListener(
                'change',
                filterAkun
            );


            /* =====================================================
               DEFAULT
            ===================================================== */

            updateTambahForm('masyarakat');

        });

    </script>

@endsection