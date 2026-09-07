<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_user')
                ->constrained('users', 'id_user', 'id_user')
                ->onDelete('cascade');
            $table->string('nama_laporan');
            $table->string('deskripsi');
            $table->string('lokasi');
            $table->string('foto_lokasi');
            $table->foreignId('id_laporan')
                ->constrained('status_laporan', 'id_status', 'id_status')
                ->onDelete('cascade');
            $table->string('keterangan_proggress');
            $table->foreignId('id_kategori')
                ->constrained('kategori', 'id_kategori', 'id_kategori')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
