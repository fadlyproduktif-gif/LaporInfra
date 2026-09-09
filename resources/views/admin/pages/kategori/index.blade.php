@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard Admin')

@section('page-description', 'Kelola data dan pantau sistem pelaporan LAPORINFRA.')

@push('styles')
    @vite('resources/css/admin/kategori.css')
@endpush

@section('content')

    {{-- =========================
        ALERT
    ========================== --}}

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


    <section class="content">

        {{-- =========================
            PAGE HEADING
        ========================== --}}

        <div class="page-heading">

            <div>
                <h1>
                    Kelola Kategori
                </h1>

                <p>
                    Kelola kategori infrastruktur yang digunakan dalam sistem LAPORINFRA.
                </p>
            </div>


            <div class="heading-actions">

                <div class="total-badge">
                    <span>◇</span>
                    {{ $kategori->count() }} Kategori
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


        {{-- =========================
            FILTER
        ========================== --}}

        <div class="filter-card">

            <div class="search-box">

                <span class="search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari nama kategori..."
                    onkeyup="searchCategory()"
                >

            </div>


            <div class="select-wrapper">

                <select
                    id="filterDivisi"
                    onchange="filterCategory()"
                >

                    <option value="">
                        Semua OPD
                    </option>

                    @forelse ($devisi as $item)

                        <option value="{{ $item->nama_devisi }}">
                            {{ $item->nama_devisi }}
                        </option>

                    @empty

                    @endforelse

                </select>

                <span class="select-arrow">
                    ⌄
                </span>

            </div>

        </div>


        {{-- =========================
            TABLE
        ========================== --}}

        <div class="table-card">

            <table>

                <thead>

                    <tr>

                        <th class="number-column">
                            NO.
                        </th>

                        <th>
                            NAMA KATEGORI
                        </th>

                        <th>
                            OPD
                        </th>

                        <th class="action-column">
                            AKSI
                        </th>

                    </tr>

                </thead>


                <tbody id="categoryTable">

                    @forelse ($kategori as $index => $item)

                        <tr
                            data-divisi="{{ $item->devisi->pluck('nama_devisi')->implode('|') }}"
                        >

                            {{-- NO --}}
                            <td>
                                {{ $index + 1 }}
                            </td>


                            {{-- KATEGORI --}}
                            <td>

                                <strong>
                                    {{ $item->nama_kategori }}
                                </strong>

                            </td>


                            {{-- OPD --}}
                            <td>

                                <div class="division-badges">

                                    @forelse ($item->devisi as $opd)

                                        <span class="division-badge">
                                            {{ $opd->nama_devisi }}
                                        </span>

                                    @empty

                                        <span class="division-badge">
                                            Belum ada OPD
                                        </span>

                                    @endforelse

                                </div>

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="action-buttons">

                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        class="btn-edit"
                                        onclick='openEditModal(
                                            @json($item->id_kategori),
                                            @json($item->nama_kategori)
                                        )'
                                    >
                                        ✎ Edit
                                    </button>


                                    {{-- TAMBAH OPD --}}
                                    <button
                                        type="button"
                                        class="btn-add-opd"
                                        onclick='openOpdModal(
                                            @json($item->id_kategori),
                                            @json($item->nama_kategori),
                                            @json($item->devisi->pluck("id_devisi")->values())
                                        )'
                                    >
                                        ＋ OPD
                                    </button>


                                    {{-- HAPUS --}}
                                    <button
                                        type="button"
                                        class="btn-delete"
                                        onclick='openDeleteModal(
                                            @json($item->id_kategori),
                                            @json($item->nama_kategori)
                                        )'
                                    >
                                        ♜ Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                style="text-align: center;"
                            >
                                Belum ada kategori.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


            <div class="table-footer">
                {{ $kategori->count() }} kategori terdaftar
            </div>

        </div>

    </section>



    {{-- =================================================
        MODAL TAMBAH / EDIT KATEGORI
    ================================================== --}}

    <div
        class="modal-overlay"
        id="categoryModal"
        onclick="closeModalOutside(event)"
    >

        <div class="modal">

            {{-- HEADER --}}
            <div class="modal-header">

                <h2 id="modalTitle">
                    Tambah Kategori
                </h2>

                <button
                    type="button"
                    class="modal-close"
                    onclick="closeModal()"
                >
                    ×
                </button>

            </div>


            {{-- BODY --}}
            <div class="modal-body">

                <form
                    action="{{ route('admin.kategori.store') }}"
                    method="POST"
                    id="categoryForm"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="_method"
                        id="formMethod"
                    >


                    <div class="form-group">

                        <label>
                            Nama Kategori <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="kategori"
                            id="categoryName"
                            placeholder="Masukkan nama kategori..."
                        >

                        @error('kategori')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </form>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-cancel"
                    onclick="closeModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    form="categoryForm"
                    class="btn-save"
                >
                    Simpan Kategori
                </button>

            </div>

        </div>

    </div>



    {{-- =================================================
        MODAL TAMBAH OPD
    ================================================== --}}

    <div
        class="modal-overlay"
        id="opdModal"
        onclick="closeOpdModalOutside(event)"
    >

        <div class="modal">

            {{-- HEADER --}}
            <div class="modal-header">

                <h2>
                    Tambah Penanganan OPD
                </h2>

                <button
                    type="button"
                    class="modal-close"
                    onclick="closeOpdModal()"
                >
                    ×
                </button>

            </div>


            {{-- BODY --}}
            <div class="modal-body">

                {{-- NAMA KATEGORI --}}
                <div class="form-group">

                    <label>
                        Kategori
                    </label>

                    <input
                        type="text"
                        id="opdCategoryName"
                        readonly
                    >

                </div>


                {{-- FORM OPD --}}
                <form
                    method="POST"
                    id="opdForm"
                >

                    @csrf


                    <div class="form-group">

                        <label>
                            OPD Penanganan
                        </label>


                        <div class="opd-checkbox-list">

                            @forelse ($devisi as $item)

                                <label class="opd-checkbox">

                                    <input
                                        type="checkbox"
                                        name="devisi[]"
                                        value="{{ $item->id_devisi }}"
                                        class="opd-checkbox-input"
                                    >

                                    <span>
                                        {{ $item->nama_devisi }}
                                    </span>

                                </label>

                            @empty

                                <p>
                                    Belum ada OPD.
                                </p>

                            @endforelse

                        </div>


                        @error('devisi')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </form>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-cancel"
                    onclick="closeOpdModal()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    form="opdForm"
                    class="btn-save"
                >
                    Simpan
                </button>

            </div>

        </div>

    </div>



    {{-- =================================================
        MODAL HAPUS
    ================================================== --}}

    <div
        class="modal-overlay"
        id="deleteModal"
        onclick="closeDeleteOutside(event)"
    >

        <div class="delete-modal">

            <div class="delete-icon">
                ♜
            </div>


            <h2>
                Hapus Kategori?
            </h2>


            <p>
                Apakah Anda yakin ingin menghapus kategori ini?
            </p>


            <div class="delete-description">

                Kategori

                <strong id="deleteCategoryName"></strong>

                akan dihapus secara permanen dan tidak dapat dipulihkan.

            </div>


            <form
                id="deleteForm"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <div class="delete-actions">

                    <button
                        type="button"
                        class="btn-cancel"
                        onclick="closeDeleteModal()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn-confirm-delete"
                    >
                        Hapus
                    </button>

                </div>

            </form>

        </div>

    </div>



    {{-- =================================================
        JAVASCRIPT
    ================================================== --}}

    <script>

        /*
        |--------------------------------------------------------------------------
        | MODAL TAMBAH KATEGORI
        |--------------------------------------------------------------------------
        */

        function openAddModal() {

            document.getElementById('modalTitle').innerText =
                'Tambah Kategori';

            document.getElementById('categoryName').value =
                '';

            document.getElementById('categoryForm').action =
                "{{ route('admin.kategori.store') }}";

            document.getElementById('formMethod').value =
                '';

            document.querySelector('#categoryModal .btn-save').innerText =
                'Simpan Kategori';

            document.getElementById('categoryModal')
                .classList.add('show');

        }



        /*
        |--------------------------------------------------------------------------
        | MODAL EDIT KATEGORI
        |--------------------------------------------------------------------------
        */

        function openEditModal(id, name) {

            document.getElementById('modalTitle').innerText =
                'Edit Kategori';

            document.getElementById('categoryName').value =
                name;

            document.getElementById('categoryForm').action =
                '/admin/kategori/update/' + id;

            document.getElementById('formMethod').value =
                'PUT';

            document.querySelector('#categoryModal .btn-save').innerText =
                'Simpan Perubahan';

            document.getElementById('categoryModal')
                .classList.add('show');

        }



        /*
        |--------------------------------------------------------------------------
        | TUTUP MODAL KATEGORI
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
        | MODAL TAMBAH OPD
        |--------------------------------------------------------------------------
        */

        function openOpdModal(id, name, currentDivisions) {

            document.getElementById('opdCategoryName').value =
                name;

            document.getElementById('opdForm').action =
                '/admin/kategori/' + id + '/tambah-devisi';


            const checkboxes =
                document.querySelectorAll(
                    '.opd-checkbox-input'
                );


            checkboxes.forEach(function (checkbox) {

                checkbox.checked =
                    currentDivisions.includes(
                        Number(checkbox.value)
                    );

            });


            document.getElementById('opdModal')
                .classList.add('show');

        }


        function closeOpdModal() {

            document.getElementById('opdModal')
                .classList.remove('show');

        }


        function closeOpdModalOutside(event) {

            if (event.target === event.currentTarget) {
                closeOpdModal();
            }

        }



        /*
        |--------------------------------------------------------------------------
        | MODAL HAPUS
        |--------------------------------------------------------------------------
        */

        function openDeleteModal(id, name) {

            document.getElementById('deleteCategoryName')
                .innerText = name;

            document.getElementById('deleteForm').action =
                '/admin/kategori/delete/' + id;

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



        /*
        |--------------------------------------------------------------------------
        | SEARCH KATEGORI
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


            rows.forEach(function (row) {

                const categoryCell =
                    row.querySelector('td:nth-child(2)');


                if (!categoryCell) {
                    return;
                }


                const name =
                    categoryCell.innerText
                    .toLowerCase();


                row.style.display =
                    name.includes(keyword)
                        ? ''
                        : 'none';

            });

        }



        /*
        |--------------------------------------------------------------------------
        | FILTER OPD
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


            rows.forEach(function (row) {

                const division =
                    row.dataset.divisi || '';


                const divisions =
                    division
                    .split('|')
                    .filter(Boolean);


                if (
                    selected === '' ||
                    divisions.includes(selected)
                ) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        }



        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {

                    closeModal();
                    closeOpdModal();
                    closeDeleteModal();

                }

            }
        );

    </script>

@endsection