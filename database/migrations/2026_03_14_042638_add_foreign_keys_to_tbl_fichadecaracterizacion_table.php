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
        Schema::table('tbl_fichadecaracterizacion', function (Blueprint $table) {
            $table->foreign(['tbl_instructores_NIS'], 'fk_tbl_fichadecaracterizacion_tbl_instructores1')->references(['NIS'])->on('tbl_instructores')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tbl_programasdeformacion_NIS'], 'fk_tbl_fichadecaracterizacion_tbl_programasdeformacion1')->references(['NIS'])->on('tbl_programasdeformacion')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_fichadecaracterizacion', function (Blueprint $table) {
            $table->dropForeign('fk_tbl_fichadecaracterizacion_tbl_instructores1');
            $table->dropForeign('fk_tbl_fichadecaracterizacion_tbl_programasdeformacion1');
        });
    }
};
