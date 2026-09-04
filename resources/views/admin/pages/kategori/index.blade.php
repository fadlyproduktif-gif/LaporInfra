@extends('admin.layouts.app')


@section('title', 'Dashboard Admin')


@section('page-title', 'Dashboard Admin')


@section('page-description', 'Kelola data dan pantau sistem pelaporan LAPORINFRA.')


@push('styles')
    @vite('resources/css/admin/kategori.css')
@endpush


@section('content')
    <!-- CONTENT -->
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
                    {{ $kategori->count() }} Kategori
                </div>

                <button type="button" class="btn-add" onclick="openAddModal()">
                    <span>＋</span>
                    Tambah Kategori
                </button>

            </div>

        </div>


        <!-- FILTER -->
        <div class="filter-card">

            <div class="search-box">

                <span class="search-icon">⌕</span>

                <input type="text" id="searchInput" placeholder="Cari nama kategori..." onkeyup="searchCategory()">

            </div>


            <div class="select-wrapper">

                <select id="filterDivisi" name="devisi" onchange="filterCategory()">

                    <option value="">Semua OPD</option>
                    @forelse ($devisi as $item)
                        <option value="{{ $item->nama_devisi }}">
                            {{ $item->nama_devisi }}
                        </option>
                    @empty
                    @endforelse

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
                        <th>OPD</th>
                        <th class="action-column">AKSI</th>
                    </tr>

                </thead>


                <tbody id="categoryTable">
                    @forelse ($kategori as $index => $item)
                        <!-- DATA 1 -->
                        <tr data-divisi="{{ $item->devisi->nama_devisi }}">

                            <td>{{ $index + 1 }}</td>

                            <td>
                                <strong>{{ $item->nama_kategori }}</strong>
                            </td>

                            <td>
                                <span class="division-badge">
                                    {{ $item->devisi->nama_devisi }}
                                </span>
                            </td>

                            <td>

                                <div class="action-buttons">

                                    <button class="btn-edit"
                                        onclick="openEditModal(
                                                '{{ $item->id_kategori }}',
                                                '{{ $item->nama_kategori }}',
                                                '{{ $item->id_devisi }}',
                                            )">
                                        ✎ Edit
                                    </button>

                                    <button class="btn-delete"
                                        onclick="openDeleteModal('{{ $item->id_kategori }}', '{{ $item->nama_kategori }}')">
                                        ♜ Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>
                    @empty
                    @endforelse


                </tbody>

            </table>


            <div class="table-footer">
                {{ $kategori->count() }} kategori terdaftar
            </div>

        </div>

    </section>





    <!-- ================================================= -->
    <!-- MODAL TAMBAH / EDIT -->
    <!-- ================================================= -->

    <div class="modal-overlay" id="categoryModal" onclick="closeModalOutside(event)">

        <div class="modal">

            <div class="modal-header">

                <h2 id="modalTitle">
                    Tambah Kategori
                </h2>

                <button class="modal-close" onclick="closeModal()">
                    ×
                </button>

            </div>


            <div class="modal-body">

                <form action="{{ route('admin.kategori.store') }}" method="POST" id="categoryForm">
                    @csrf

                    <input type="hidden" name="_method" id="formMethod">
                    <div class="form-group">

                        <label>
                            Nama Kategori <span>*</span>
                        </label>

                        <input type="text" name="kategori" id="categoryName" placeholder="Masukkan nama kategori...">
                        @error('kategori')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">

                        <label>
                            OPD <span>*</span>
                        </label>

                        <div class="modal-select">

                            <select name="devisi" id="categoryDivision">

                                <option value="">
                                    Pilih OPD...
                                </option>

                                @forelse ($devisi as $item)
                                    <option value="{{ $item->id_devisi }}">
                                        {{ $item->nama_devisi }}
                                    </option>
                                @empty
                                @endforelse

                            </select>
                            @error('devisi')
                                <p>{{ $message }}</p>
                            @enderror
                            <span>⌄</span>

                        </div>

                    </div>

            </div>


            <div class="modal-footer">

                <button type="button" class="btn-cancel" onclick="closeModal()">
                    Batal
                </button>

                <button type="submit" class="btn-save">
                    Simpan Kategori
                </button>

            </div>

            </form>
        </div>
    </div>


    <!-- ================================================= -->
    <!-- MODAL HAPUS -->
    <!-- ================================================= -->

    <div class="modal-overlay" id="deleteModal" onclick="closeDeleteOutside(event)">

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
                    {{ $kategori }}
                </strong>
                akan dihapus secara permanen dan tidak dapat dipulihkan.

            </div>


            <form id="deleteForm" method="post">
                <div class="delete-actions">

                    <button type="button" class="btn-cancel" onclick="closeDeleteModal()">
                        Batal
                    </button>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-confirm-delete" onclick="deleteCategory()">
                        Hapus
            </form>




        </div>

        </button>
    </div>

    </div>



    <script>
        /*
                                            ------------------------------------------------------------------------
                                            MODAL TAMBAH
                                            --------------------------------------------------------------------------
                                            */

        function openAddModal() {

            document.getElementById('modalTitle').innerText =
                'Tambah Kategori';

            document.getElementById('categoryName').value = '';

            document.getElementById('categoryDivision').value = '';

            document.getElementById('categoryForm').action =
                "{{ route('admin.kategori.store') }}";

            document.getElementById('formMethod').value = '';

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

        function openEditModal(id, name, division) {

            document.getElementById('modalTitle').innerText =
                'Edit Kategori';

            document.getElementById('categoryName').value =
                name;

            document.getElementById('categoryDivision').value =
                division;

            document.getElementById('categoryForm').action =
                "/admin/kategori/update/" + id;

            document.getElementById('formMethod').value =
                'PUT';

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

        function openDeleteModal(id, name) {

            document.getElementById('deleteCategoryName')
                .innerText = name;

            document.getElementById('deleteForm').action =
                "/admin/kategori/delete/" + id;

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


        function deleteCategory(id, name) {

            // alert(
            //     'Kategori dihapus.'
            // );

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
                    name.includes(keyword) ?
                    '' :
                    'none';

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
