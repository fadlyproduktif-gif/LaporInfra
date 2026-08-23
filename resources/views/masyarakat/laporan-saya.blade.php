@extends('masyarakat.layouts.app')

@section('title', 'Laporan Saya')

@push('styles')
    @vite('resources/css/masyarakat/laporan-saya.css')
@endpush

@section('content')

<main class="laporan-container">

    <!-- Header -->
    <section class="laporan-header">

        <h1>Laporan Saya</h1>

        <p>
            Lihat dan pantau laporan yang telah Anda kirim.
        </p>

        <div class="laporan-count">
            <span>▣</span>
            <strong>3</strong>
            <span>Laporan</span>
        </div>

    </section>


    <!-- Status Legend -->
    <div class="status-legend">

        <span>
            <i class="dot waiting"></i>
            Menunggu
        </span>

        <span>
            <i class="dot processing"></i>
            Sedang Diproses
        </span>

        <span>
            <i class="dot completed"></i>
            Selesai
        </span>

    </div>


    <!-- Daftar Laporan -->
    <section class="laporan-list">


        <!-- Laporan 1 -->
        <article class="laporan-card processing-card">

            <div class="laporan-number">
                1
            </div>


            <div class="laporan-info">

                <h2>
                    Jalan Berlubang di Jl. Merdeka No. 12
                </h2>

                <div class="laporan-meta">

                    <span class="kategori">
                        ◇ Jalan & Trotoar
                    </span>

                    <span>
                        ▣ 10 Agustus 2026
                    </span>

                </div>

            </div>


            <div class="laporan-action">

                <span class="status processing-status">
                    ● Sedang Diproses
                </span>

                <a
                    href="{{route('masyarakat.detail-laporan')}}"
                    class="btn-detail"
                >
                    Lihat Detail
                </a>

            </div>

        </article>


        <!-- Laporan 2 -->
        <article class="laporan-card waiting-card">

            <div class="laporan-number">
                2
            </div>


            <div class="laporan-info">

                <h2>
                    Lampu Jalan Mati Sejak 2 Minggu Lalu
                </h2>

                <div class="laporan-meta">

                    <span class="kategori">
                        ◇ Penerangan Jalan
                    </span>

                    <span>
                        ▣ 5 Agustus 2026
                    </span>

                </div>

            </div>


            <div class="laporan-action">

                <span class="status waiting-status">
                    ● Menunggu
                </span>

                <a
                    href="#"
                    class="btn-detail"
                >
                    Lihat Detail
                </a>

            </div>

        </article>


        <!-- Laporan 3 -->
        <article class="laporan-card completed-card">

            <div class="laporan-number">
                3
            </div>


            <div class="laporan-info">

                <h2>
                    Saluran Air Tersumbat di Gang Melati RT 04
                </h2>

                <div class="laporan-meta">

                    <span class="kategori">
                        ◇ Drainase & Sanitasi
                    </span>

                    <span>
                        ▣ 28 Juli 2026
                    </span>

                </div>

            </div>


            <div class="laporan-action">

                <span class="status completed-status">
                    ● Selesai
                </span>

                <a
                    href="#"
                    class="btn-detail"
                >
                    Lihat Detail
                </a>

            </div>

        </article>

    </section>

</main>

@endsection