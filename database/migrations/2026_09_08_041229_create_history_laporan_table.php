<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_laporan', function (Blueprint $table) {
            $table->id('id_history');

            $table->foreignId('id_laporan')
                ->constrained(
                    table: 'laporan',
                    column: 'id_laporan'
                )
                ->cascadeOnDelete();

            $table->foreignId('id_user_pengubah')
                ->constrained(
                    table: 'users',
                    column: 'id_user'
                )
                ->restrictOnDelete();

            $table->foreignId('id_status')
                ->nullable()
                ->constrained(
                    table: 'status_laporan',
                    column: 'id_status'
                )
                ->nullOnDelete();

            $table->string('keterangan_proggress');

            $table->string('history_foto')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_laporan');
    }
};