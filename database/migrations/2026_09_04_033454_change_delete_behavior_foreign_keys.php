<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | KATEGORI → DEVISI
        |--------------------------------------------------------------------------
        */

        Schema::table('kategori', function (Blueprint $table) {

            $table->dropForeign(
                'kategori_id_devisi_foreign'
            );

            $table->foreign('id_devisi')
                ->references('id_devisi')
                ->on('devisi')
                ->restrictOnDelete();
        });


        /*
        |--------------------------------------------------------------------------
        | LAPORAN → KATEGORI
        |--------------------------------------------------------------------------
        */

        Schema::table('laporan', function (Blueprint $table) {

            $table->dropForeign(
                'id_kategori'
            );

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->restrictOnDelete();
        });


        /*
        |--------------------------------------------------------------------------
        | LAPORAN → USER
        |--------------------------------------------------------------------------
        */

        Schema::table('laporan', function (Blueprint $table) {

            $table->dropForeign(
                'id_user'
            );

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->restrictOnDelete();
        });
    }


    public function down(): void
    {
        /*
        Kembalikan ke CASCADE
        jika migration di-rollback.
        */


        Schema::table('kategori', function (Blueprint $table) {

            $table->dropForeign(
                'kategori_id_devisi_foreign'
            );

            $table->foreign('id_devisi')
                ->references('id_devisi')
                ->on('devisi')
                ->cascadeOnDelete();
        });


        Schema::table('laporan', function (Blueprint $table) {

            $table->dropForeign(
                'id_kategori'
            );

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->cascadeOnDelete();
        });


        Schema::table('laporan', function (Blueprint $table) {

            $table->dropForeign(
                'id_user'
            );

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};