@extends('admin.layouts.app')


@section('title', 'Dashboard Admin')


@section('page-title', 'Dashboard Admin')


@section(
    'page-description',
    'Kelola data dan pantau sistem pelaporan LAPORINFRA.'
)


@push('styles')

    @vite('resources/css/admin/kategori.css')

@endpush


@section('content')
        <!-- CONTENT -->
        <section class="content">


            <!-- PAGE TITLE -->
            <div class="page-heading">

                <div>
                    <h1>Kelola Kategori</h1>

                    <p>
                        Kelola kategori infrastruktur yang digunakan dalam sistem LAPORINFRA.
                    </p>
                </div>


                <div class="heading-actions">

                    <div class="total-badge">
                        <span>◇</span>
                        5 Kategori
                    </div>

                    <button
                        type="button"
                        class="btn-add"
                        onclick="openAddModal()"
                    >
                        <span>＋</span>
                        Tambah Kategori
                    </button>

                </div>

            </div>


            <!-- FILTER -->
            <div class="filter-card">

                <div class="search-box">

                    <span class="search-icon">⌕</span>

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari nama kategori..."
                        onkeyup="searchCategory()"
                    >

                </div>


                <div class="select-wrapper">

                    <select id="filterDivisi" onchange="filterCategory()">

                        <option value="">Semua Divisi</option>

                        <option value="PUPR">
                            PUPR
                        </option>

                        <option value="Perhubungan">
                            Perhubungan
                        </option>

                        <option value="Perumahan & Permukiman">
                            Perumahan & Permukiman
                        </option>

                        <option value="Lingkungan Hidup">
                            Lingkungan Hidup
                        </option>

                    </select>

                    <span class="select-arrow">⌄</span>

                </div>

            </div>


            <!-- TABLE -->
            <div class="table-card">

                <table>

                    <thead>

                        <tr>
                            <th class="number-column">NO.</th>
                            <th>NAMA KATEGORI</th>
                            <th>DIVISI</th>
                            <th class="action-column">AKSI</th>
                        </tr>

                    </thead>


                    <tbody id="categoryTable">

                        <!-- DATA 1 -->
                        <tr data-divisi="PUPR">

                            <td>1</td>

                            <td>
                                <strong>Jalan & Trotoar</strong>
                            </td>

                            <td>
                                <span class="division-badge">
                                    PUPR
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <button
                                        class="btn-edit"
                                        onclick="openEditModal('Jalan & Trotoar', 'PUPR')"
                                    >
                                        ✎ Edit
                                    </button>

                                    <button
                                        class="btn-delete"
                                        onclick="openDeleteModal('Jalan & Trotoar')"
                                    >
                                        ♜ Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>


                        <!-- DATA 2 -->
                        <tr data-divisi="Perhubungan">

                            <td>2</td>

                            <td>
                                <strong>Penerangan Jalan</strong>
                            </td>

                            <td>
                                <span class="division-badge">
                                    Perhubungan
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <button
                                        class="btn-edit"
                                        onclick="openEditModal('Penerangan Jalan', 'Perhubungan')"
                                    >
                                        ✎ Edit
                                    </button>

                                    <button
                                        class="btn-delete"
                                        onclick="openDeleteModal('Penerangan Jalan')"
                                    >
                                        ♜ Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>


                        <!-- DATA 3 -->
                        <tr data-divisi="PUPR">

                            <td>3</td>

                            <td>
                                <strong>Drainase & Sanitasi</strong>
                            </td>

                            <td>
                                <span class="division-badge">
                                    PUPR
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <button
                                        class="btn-edit"
                                        onclick="openEditModal('Drainase & Sanitasi', 'PUPR')"
                                    >
                                        ✎ Edit
                                    </button>

                                    <button
                                        class="btn-delete"
                                        onclick="openDeleteModal('Drainase & Sanitasi')"
                                    >
                                        ♜ Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>


                        <!-- DATA 4 -->
                        <tr data-divisi="Lingkungan Hidup">

                            <td>4</td>

                            <td>
                                <strong>Persampahan</strong>
                            </td>

                            <td>
                                <span class="division-badge">
                                    Lingkungan Hidup
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <button
                                        class="btn-edit"
                                        onclick="openEditModal('Persampahan', 'Lingkungan Hidup')"
                                    >
                                        ✎ Edit
                                    </button>

                                    <button
                                        class="btn-delete"
                                        onclick="openDeleteModal('Persampahan')"
                                    >
                                        ♜ Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>


                        <!-- DATA 5 -->
                        <tr data-divisi="Perumahan & Permukiman">

                            <td>5</td>

                            <td>
                                <strong>Fasilitas Umum</strong>
                            </td>

                            <td>
                                <span class="division-badge">
                                    Perumahan & Permukiman
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <button
                                        class="btn-edit"
                                        onclick="openEditModal('Fasilitas Umum', 'Perumahan & Permukiman')"
                                    >
                                        ✎ Edit
                                    </button>

                                    <button
                                        class="btn-delete"
                                        onclick="openDeleteModal('Fasilitas Umum')"
                                    >
                                        ♜ Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>


                <div class="table-footer">
                    5 kategori terdaftar
                </div>

            </div>

        </section>





<!-- ================================================= -->
<!-- MODAL TAMBAH / EDIT -->
<!-- ================================================= -->

<div
    class="modal-overlay"
    id="categoryModal"
    onclick="closeModalOutside(event)"
>

    <div class="modal">

        <div class="modal-header">

            <h2 id="modalTitle">
                Tambah Kategori
            </h2>

            <button
                class="modal-close"
                onclick="closeModal()"
            >
                ×
            </button>

        </div>


        <div class="modal-body">

            <div class="form-group">

                <label>
                    Nama Kategori <span>*</span>
                </label>

                <input
                    type="text"
                    id="categoryName"
                    placeholder="Masukkan nama kategori..."
                >

            </div>


            <div class="form-group">

                <label>
                    Divisi <span>*</span>
                </label>

                <div class="modal-select">

                    <select id="categoryDivision">

                        <option value="">
                            Pilih divisi...
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

                        <option value="Lingkungan Hidup">
                            Lingkungan Hidup
                        </option>

                    </select>

                    <span>⌄</span>

                </div>

            </div>

        </div>


        <div class="modal-footer">

            <button
                class="btn-cancel"
                onclick="closeModal()"
            >
                Batal
            </button>

            <button
                class="btn-save"
                onclick="saveCategory()"
            >
                Simpan Kategori
            </button>

        </div>

    </div>




<!-- ================================================= -->
<!-- MODAL HAPUS -->
<!-- ================================================= -->

<div
    class="modal-overlay"
    id="deleteModal"
    onclick="closeDeleteOutside(event)"
>

    <div class="delete-modal">

        <div class="delete-icon">
            ♜
        </div>

        <h2>Hapus Kategori?</h2>

        <p>
            Apakah Anda yakin ingin menghapus kategori ini?
        </p>

        <div class="delete-description">

            Kategori
            <strong id="deleteCategoryName">
                Jalan & Trotoar
            </strong>
            akan dihapus secara permanen dan tidak dapat dipulihkan.

        </div>


        <div class="delete-actions">

            <button
                class="btn-cancel"
                onclick="closeDeleteModal()"
            >
                Batal
            </button>

            <button
                class="btn-confirm-delete"
                onclick="deleteCategory()"
            >
                Hapus
            </button>

        </div>

    </div>

</div>



<script>

    /*
    |--------------------------------------------------------------------------
    | MODAL TAMBAH
    |--------------------------------------------------------------------------
    */

    function openAddModal() {

        document.getElementById('modalTitle').innerText =
            'Tambah Kategori';

        document.getElementById('categoryName').value = '';

        document.getElementById('categoryDivision').value = '';

        document.querySelector('.btn-save').innerText =
            'Simpan Kategori';

        document.getElementById('categoryModal')
            .classList.add('show');

    }


    /*
    |--------------------------------------------------------------------------
    | MODAL EDIT
    |--------------------------------------------------------------------------
    */

    function openEditModal(name, division) {

        document.getElementById('modalTitle').innerText =
            'Edit Kategori';

        document.getElementById('categoryName').value =
            name;

        document.getElementById('categoryDivision').value =
            division;

        document.querySelector('.btn-save').innerText =
            'Simpan Perubahan';

        document.getElementById('categoryModal')
            .classList.add('show');

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    function closeModal() {

        document.getElementById('categoryModal')
            .classList.remove('show');

    }


    function closeModalOutside(event) {

        if (event.target === event.currentTarget) {
            closeModal();
        }

    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DUMMY
    |--------------------------------------------------------------------------
    */

    function saveCategory() {

        const name =
            document.getElementById('categoryName').value;

        const division =
            document.getElementById('categoryDivision').value;

        if (!name || !division) {

            alert('Nama kategori dan divisi wajib diisi.');

            return;
        }

        alert(
            'Data berhasil disimpan sebagai tampilan dummy.'
        );

        closeModal();

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE MODAL
    |--------------------------------------------------------------------------
    */

    function openDeleteModal(name) {

        document.getElementById('deleteCategoryName')
            .innerText = name;

        document.getElementById('deleteModal')
            .classList.add('show');

    }


    function closeDeleteModal() {

        document.getElementById('deleteModal')
            .classList.remove('show');

    }


    function closeDeleteOutside(event) {

        if (event.target === event.currentTarget) {
            closeDeleteModal();
        }

    }


    function deleteCategory() {

        alert(
            'Kategori dihapus sebagai tampilan dummy.'
        );

        closeDeleteModal();

    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    function searchCategory() {

        const keyword =
            document
                .getElementById('searchInput')
                .value
                .toLowerCase();

        const rows =
            document.querySelectorAll(
                '#categoryTable tr'
            );

        rows.forEach(function(row) {

            const name =
                row
                    .querySelector('td:nth-child(2)')
                    .innerText
                    .toLowerCase();

            row.style.display =
                name.includes(keyword)
                    ? ''
                    : 'none';

        });

    }


    /*
    |--------------------------------------------------------------------------
    | FILTER DIVISI
    |--------------------------------------------------------------------------
    */

    function filterCategory() {

        const selected =
            document
                .getElementById('filterDivisi')
                .value;

        const rows =
            document.querySelectorAll(
                '#categoryTable tr'
            );

        rows.forEach(function(row) {

            const division =
                row.dataset.divisi;

            if (
                selected === '' ||
                division === selected
            ) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE MODAL
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                closeModal();
                closeDeleteModal();

            }

        }
    );

</script>

</body>
</html>

@endsection