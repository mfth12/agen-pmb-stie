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
        Schema::table('transaknonkad', function (Blueprint $table) {
            // Foreign ke tabel non_akademiks
            $table->foreign('id_non')
                ->references('id')
                ->on('non_akademiks')
                ->onDelete('cascade');

            // Foreign ke tabel dbmahasiswa
            $table->foreign('id_peserta')
                ->references('ID')
                ->on('dbmahasiswa')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaknonkad', function (Blueprint $table) {
            $table->dropForeign(['id_non']);
            $table->dropForeign(['id_peserta']);
        });
    }
};
