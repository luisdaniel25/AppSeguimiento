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
        Schema::create('tbl_centrodeformacion', function (Blueprint $table) {
            $table->integer('NIS', true);
            $table->integer('Codigo');
            $table->string('Denominacion', 100);
            $table->string('Direccion', 200)->nullable();
            $table->string('Observaciones', 200)->nullable();
            $table->integer('tbl_regionales_NIS')->index('fk_tbl_centrodeformacion_tbl_regionales1_idx');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_centrodeformacion');
    }
};
