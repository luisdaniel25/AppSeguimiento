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
        Schema::table('tbl_entecoformadores', function (Blueprint $table) {
            $table->foreign(['tbl_rolesadministrativos_NIS'], 'fk_tbl_entecoformadores_tbl_rolesadministrativos1')->references(['NIS'])->on('tbl_rolesadministrativos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tbl_tiposdocumentos_nis'], 'fk_tbl_entecoformadores_tbl_tiposdocumentos1')->references(['nis'])->on('tbl_tiposdocumentos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_entecoformadores', function (Blueprint $table) {
            $table->dropForeign('fk_tbl_entecoformadores_tbl_rolesadministrativos1');
            $table->dropForeign('fk_tbl_entecoformadores_tbl_tiposdocumentos1');
        });
    }
};
