<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'zidanhanzade01@gmail.com'
            ],
            [
                'nip' => null,
                'nama_user' => 'Administrator',
                'password' => null,
                'google_id' => null,
                'role' => 'admin',
                'id_devisi' => null,
            ]
        );
    }
}
