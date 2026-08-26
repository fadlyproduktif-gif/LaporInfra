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
        Schema::table('laporan', function (Blueprint $table) {
            $table->foreignId('id_status')
            ->nullable()
            ->after("foto_lokasi")
            ->constrained('status_laporan', 'id_status')
            ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
           $table->dropForeign(['id_status']);
           $table->dropColumn(['id_status']);
        });
    }
};
