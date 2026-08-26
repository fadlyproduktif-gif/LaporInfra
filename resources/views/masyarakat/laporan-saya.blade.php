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
                <strong>{{$laporan->count()}}</strong>
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
            @forelse ($laporan as $index => $item)
                <article class="laporan-card processing-card">

                    <div class="laporan-number">
                        {{$index + 1}}
                    </div>


                    <div class="laporan-info">

                        <h2>
                            {{$item->nama_laporan}}
                        </h2>

                        <div class="laporan-meta">

                            <span class="kategori">
                                {{$item->kategori->nama_kategori}}
                            </span>

                            <span>
                               {{$item->created_at}}
                            </span>

                        </div>

                    </div>


                    <div class="laporan-action">

                        <span class="status processing-status">
                            {{$item->StatusLaporan->nama_status}}
                        </span>

                            <a href="{{ route('masyarakat.detail-laporan', $item->id_laporan) }}" class="btn-detail">
                                Lihat Detail
                            </a>

                    </div>

                </article>
            @empty
            @endforelse


        </section>

    </main>

@endsection
