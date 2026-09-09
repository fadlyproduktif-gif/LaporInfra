<?php

namespace Database\Seeders;

use App\Models\Devisi;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'PUPR' => [
                'Jalan Rusak',
                'Jembatan Rusak',
                'Drainase/Selokan Rusak',
                'Irigasi Rusak',
            ],

            'BAPPEDA' => [
                'Perencanaan Infrastruktur',
                'Usulan Pembangunan Infrastruktur',
            ],

            'PLN' => [
                'Tiang Listrik Bermasalah',
                'Jaringan/Kabel Listrik Bermasalah',
            ],

            'Kantor Pertanahan ATR/BPN' => [
                'Permasalahan Pertanahan',
            ],

            'KOMINFO' => [
                'Gangguan Jaringan Internet',
                'Fasilitas WiFi Publik Bermasalah',
            ],

            'PDAM' => [
                'Pipa Air Bocor',
                'Gangguan Distribusi Air',
            ],
        ];

        foreach ($data as $namaOpd => $kategoriList) {

            $opd = Devisi::where(
                'nama_devisi',
                $namaOpd
            )->first();

            if (!$opd) {
                continue;
            }

            foreach ($kategoriList as $namaKategori) {

                $kategori = Kategori::firstOrCreate([
                    'nama_kategori' => $namaKategori,
                ]);

                DB::table('kategori_devisi')->insertOrIgnore([
                    'id_kategori' => $kategori->id_kategori,
                    'id_devisi' => $opd->id_devisi,
                ]);
            }
        }
    }
}