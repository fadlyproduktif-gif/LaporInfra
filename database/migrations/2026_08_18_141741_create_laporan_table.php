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
            $table->id();
            $table->foreignId('id_user')
                ->constrained('users', 'id_user', 'id_user')
                ->onDelete('cascade');
            $table->string('nama_laporan');
            $table->string('deskripsi');
            $table->string('lokasi');
            $table->string('foto_lokasi');
            $table->string('status_laporan');
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
