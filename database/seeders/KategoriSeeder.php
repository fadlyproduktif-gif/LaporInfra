<?php

namespace Database\Seeders;

use App\Models\Devisi;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

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

                Kategori::firstOrCreate([
                    'nama_kategori' => $namaKategori,
                    'id_devisi' => $opd->id_devisi,
                ]);
            }
        }
    }
}