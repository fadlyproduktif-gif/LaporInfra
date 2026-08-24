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

        <a href="#" class="back-link">
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


            <div class="profile-information">

                <div class="profile-user">

                    <div class="large-avatar">
                        F
                    </div>

                    <div class="profile-user-info">

                        <h3>
                            Fadly Maulana
                        </h3>

                        <p>
                            fadly.maulana@email.com
                        </p>

                        <span class="role-badge">
                            Masyarakat
                        </span>

                    </div>

                </div>


                <button class="btn-outline">
                    ✎ &nbsp; Ubah Profil
                </button>

            </div>

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


            <div class="security-form">

                <!-- PASSWORD LAMA -->

                <div class="form-group">

                    <label for="current-password">
                        PASSWORD SAAT INI <span>*</span>
                    </label>

                    <div class="password-input">

                        <input type="password" id="current-password" placeholder="Masukkan password saat ini">

                        <button type="button" class="password-toggle">
                            ◉
                        </button>

                    </div>

                </div>


                <!-- PASSWORD BARU -->

                <div class="form-group">

                    <label for="new-password">
                        PASSWORD BARU <span>*</span>
                    </label>

                    <div class="password-input">

                        <input type="password" id="new-password" placeholder="Minimal 8 karakter">

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

                        <input type="password" id="confirm-password" placeholder="Ulangi password baru">

                        <button type="button" class="password-toggle">
                            ◉
                        </button>

                    </div>

                </div>


                <div class="form-submit">

                    <button type="button" class="btn-orange">
                        Ubah Password
                    </button>

                </div>

            </div>

        </section>

    </main>
@endsection
