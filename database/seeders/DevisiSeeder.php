<?php

namespace Database\Seeders;

use App\Models\Devisi;
use Illuminate\Database\Seeder;

class DevisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'PUPR',
            'BAPPEDA',
            'PLN',
            'Kantor Pertanahan ATR/BPN',
            'KOMINFO',
            'PDAM',
        ];

        foreach ($data as $nama) {
            Devisi::firstOrCreate([
                'nama_devisi' => $nama,
            ]);
        }
    }
}