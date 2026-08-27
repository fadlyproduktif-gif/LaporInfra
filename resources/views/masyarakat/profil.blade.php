@extends('masyarakat.layouts.app')

@section('title', 'Profil Saya')

@push('styles')
    @vite('resources/css/masyarakat/profil.css')
@endpush

@section('content')


    <!-- =========================
                                                                         MAIN
                                                                    ========================== -->

    <main class="profile-container">

        <!-- BACK -->

        <a href="{{ route('masyarakat.dashboard') }}" class="back-link">
            ← Kembali ke Dashboard
        </a>


        <!-- PAGE HEADER -->

        <div class="profile-heading">

            <h1>
                Profil Saya
            </h1>

            <p>
                Kelola informasi akun dan profil Anda.
            </p>

        </div>


        <!-- =========================
                                                                             INFORMASI PROFIL
                                                                        ========================== -->

        <section class="profile-card">

            <div class="card-header">

                <h2>
                    Informasi Profil
                </h2>

            </div>


            <div class="profile-information" id="profile-display">

                <div class="profile-user">

                    <div class="large-avatar">
                        {{ strtoupper(substr($user->nama_user, 0, 1)) }}
                    </div>

                    <div class="profile-user-info">

                        <h3>
                            {{ $user->nama_user }}
                        </h3>

                        <p>
                            {{ $user->email }}
                        </p>

                        <span class="role-badge">
                            {{ $user->role }}
                        </span>

                    </div>

                </div>

                <button type="button" class="btn-outline" id="btn-edit-profile">
                    ✎ &nbsp; Ubah Profil
                </button>

            </div>


            <form method="POST" action="{{ route('masyarakat.profil.update.email') }}">
                @csrf
                @method('PUT')

                <div id="profile-edit-form" style="display: none" class="profile-edit-form">

                    <div class="form-group">
                        <label for="nama_user">
                            NAMA LENGKAP <span>*</span>
                        </label>

                        <input type="text" id="nama_user" name="nama_user" value="{{ $user->nama_user }}">
                    </div>

                    <div class="form-group">
                        <label for="email">
                            EMAIL <span>*</span>
                        </label>

                        <input type="email" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="profile-edit-actions">
                        <button type="button" class="btn-edit-cancel">
                            Batal
                        </button>

                        <button type="submit" class="btn-edit-save">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>

            </form>

        </section>


        <!-- =========================
                                                                             KEAMANAN AKUN
                                                                        ========================== -->

        <section class="profile-card security-card">

            <div class="card-header">

                <h2>
                    Keamanan Akun
                </h2>

                <p>
                    Ubah password untuk menjaga keamanan akun Anda.
                </p>

            </div>

            <form action="{{ route('masyarakat.profil.update.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="security-form">

                    <!-- PASSWORD LAMA -->

                    <div class="form-group">

                        <label for="current-password">
                            PASSWORD SAAT INI <span>*</span>
                        </label>

                        <div class="password-input">

                            <input name="password" type="password" id="current-password"
                                placeholder="Masukkan password saat ini">

                            <button type="button" class="password-toggle">
                                ◉
                            </button>

                        </div>
                        @error('password')
                            <p>{{ $message }}</p>
                        @enderror
                        @if (session('errorPassword'))
                            <p>{{ session('errorPassword') }}</p>
                        @endif

                    </div>


                    <!-- PASSWORD BARU -->

                    <div class="form-group">

                        <label for="new-password">
                            PASSWORD BARU <span>*</span>
                        </label>

                        <div class="password-input">

                            <input name="new_password" type="password" id="new-password" placeholder="Minimal 8 karakter">

                            <button type="button" class="password-toggle">
                                ◉
                            </button>

                        </div>


                    </div>


                    <!-- KONFIRMASI -->

                    <div class="form-group">

                        <label for="confirm-password">
                            KONFIRMASI PASSWORD BARU <span>*</span>
                        </label>

                        <div class="password-input">

                            <input name="new_password_confirmation" type="password" id="confirm-password"
                                placeholder="Ulangi password baru">

                            <button type="button" class="password-toggle">
                                ◉
                            </button>

                        </div>

                    </div>


                    <div class="form-submit">

                        <button type="submit" class="btn-orange">
                            Ubah Password
                        </button>

                    </div>

                </div>
            </form>
        </section>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    const btnEdit = document.getElementById('btn-edit-profile');
                    const btnCancel = document.getElementById('btn-cancel-edit');

                    const profileDisplay = document.getElementById('profile-display');
                    const profileEditForm = document.getElementById('profile-edit-form');


                    btnEdit.addEventListener('click', function() {

                        profileDisplay.style.display = 'none';
                        profileEditForm.style.display = 'block';

                    });


                    btnCancel.addEventListener('click', function() {

                        profileDisplay.style.display = 'flex';
                        profileEditForm.style.display = 'none';

                    });

                });
            </script>
        @endpush

    </main>
@endsection
