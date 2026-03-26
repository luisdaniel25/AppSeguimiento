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
        Schema::create('tbl_entecoformadores', function (Blueprint $table) {
            $table->integer('NIS', true);
            $table->integer('NumDoc');
            $table->string('RazonSocial', 100);
            $table->string('Direccion', 200);
            $table->string('Telefono', 50);
            $table->string('CorreoInstitucional', 50);
            $table->integer('tbl_tiposdocumentos_nis')->index('fk_tbl_entecoformadores_tbl_tiposdocumentos1_idx');
            $table->integer('tbl_rolesadministrativos_NIS')->index('fk_tbl_entecoformadores_tbl_rolesadministrativos1_idx');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_entecoformadores');
    }
};
