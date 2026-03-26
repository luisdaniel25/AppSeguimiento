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
        Schema::table('tbl_instructores', function (Blueprint $table) {
            $table->foreign(['tbl_eps_nis'], 'fk_tbl_instructores_tbl_eps1')->references(['nis'])->on('tbl_eps')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tbl_tiposdocumentos_nis'], 'fk_tbl_instructores_tbl_tiposdocumentos1')->references(['nis'])->on('tbl_tiposdocumentos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_instructores', function (Blueprint $table) {
            $table->dropForeign('fk_tbl_instructores_tbl_eps1');
            $table->dropForeign('fk_tbl_instructores_tbl_tiposdocumentos1');
        });
    }
};
