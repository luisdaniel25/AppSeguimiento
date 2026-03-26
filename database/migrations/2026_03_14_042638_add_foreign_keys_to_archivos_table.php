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
        Schema::table('archivos', function (Blueprint $table) {
            $table->foreign(['tbl_aprendices_NIS'], 'fk_archivos_tbl_aprendices1')->references(['NIS'])->on('tbl_aprendices')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('archivos', function (Blueprint $table) {
            $table->dropForeign('fk_archivos_tbl_aprendices1');
        });
    }
};
