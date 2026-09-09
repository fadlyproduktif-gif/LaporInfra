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
        Schema::create('kategori_devisi', function (Blueprint $table) {
            $table->id('id_kategori_devisi');

            $table->foreignId('id_kategori')->constrained(
                table: 'kategori',
                column: 'id_kategori',
            )->cascadeOnDelete();

            $table->foreignId('id_devisi')->constrained(
                table: 'devisi',
                column: 'id_devisi'
            )->cascadeOnDelete();

            $table->unique(['id_kategori', 'id_devisi']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_devisi');
    }
};
