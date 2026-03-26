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
        Schema::table('tbl_centrodeformacion', function (Blueprint $table) {
            $table->foreign(['tbl_regionales_NIS'], 'fk_tbl_centrodeformacion_tbl_regionales1')->references(['NIS'])->on('tbl_regionales')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_centrodeformacion', function (Blueprint $table) {
            $table->dropForeign('fk_tbl_centrodeformacion_tbl_regionales1');
        });
    }
};
