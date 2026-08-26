<?php

namespace Database\Seeders;

use App\Models\StatusLaporan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusLaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusLaporan::create([
            'nama_status' => 'sedang dikirim'
        ]);
        StatusLaporan::create([
            'nama_status' => 'ditunda'
        ]);
        StatusLaporan::create([
            'nama_status' => 'ditolak'
        ]);
        StatusLaporan::create([
            'nama_status' => 'diterima'
        ]);
        StatusLaporan::create([
            'nama_status' => 'dilaksanakan'
        ]);
        StatusLaporan::create([
            'nama_status' => 'diselesaikan'
        ]);
    }
}
