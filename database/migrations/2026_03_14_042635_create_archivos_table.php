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
        Schema::create('archivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_original');
            $table->string('nombre_guardado');
            $table->string('ruta');
            $table->string('tipo_mime');
            $table->bigInteger('tamano');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->integer('tbl_aprendices_NIS')->index('fk_archivos_tbl_aprendices1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
