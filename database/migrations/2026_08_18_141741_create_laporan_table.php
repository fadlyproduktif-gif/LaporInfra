<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {

            $table->id('id_laporan');

            $table->foreignId('id_user')
                ->constrained(
                    table: 'users',
                    column: 'id_user'
                )
                ->restrictOnDelete();

            $table->string('nama_laporan');

            $table->string('deskripsi');

            $table->string('lokasi');

            $table->string('foto_lokasi');

            $table->foreignId('id_status')
                ->nullable()
                ->constrained(
                    table: 'status_laporan',
                    column: 'id_status'
                )
                ->nullOnDelete();

            $table->string('keterangan_proggress');

            $table->foreignId('id_kategori')
                ->constrained(
                    table: 'kategori',
                    column: 'id_kategori'
                )
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};