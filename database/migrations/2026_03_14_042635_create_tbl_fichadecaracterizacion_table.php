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
        Schema::create('tbl_fichadecaracterizacion', function (Blueprint $table) {
            $table->integer('NIS', true);
            $table->integer('Codigo');
            $table->string('Denominacion', 100);
            $table->integer('Cupo');
            $table->date('FechaInicio')->nullable();
            $table->date('FechaFin')->nullable();
            $table->string('Observaciones', 200)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->integer('tbl_instructores_NIS')->index('fk_tbl_fichadecaracterizacion_tbl_instructores1_idx');
            $table->integer('tbl_programasdeformacion_NIS')->index('fk_tbl_fichadecaracterizacion_tbl_programasdeformacion1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_fichadecaracterizacion');
    }
};
