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
        Schema::table('tbl_aprendices', function (Blueprint $table) {
            $table->foreign(['tbl_centrodeformacion_NIS'], 'fk_tbl_aprendices_tbl_centrodeformacion1')->references(['NIS'])->on('tbl_centrodeformacion')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tbl_eps_nis'], 'fk_tbl_aprendices_tbl_eps1')->references(['nis'])->on('tbl_eps')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tbl_programasdeformacion_NIS'], 'fk_tbl_aprendices_tbl_programasdeformacion1')->references(['NIS'])->on('tbl_programasdeformacion')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tbl_tiposdocumentos_nis'], 'fk_tbl_aprendices_tbl_tiposdocumentos')->references(['nis'])->on('tbl_tiposdocumentos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_aprendices', function (Blueprint $table) {
            $table->dropForeign('fk_tbl_aprendices_tbl_centrodeformacion1');
            $table->dropForeign('fk_tbl_aprendices_tbl_eps1');
            $table->dropForeign('fk_tbl_aprendices_tbl_programasdeformacion1');
            $table->dropForeign('fk_tbl_aprendices_tbl_tiposdocumentos');
        });
    }
};
