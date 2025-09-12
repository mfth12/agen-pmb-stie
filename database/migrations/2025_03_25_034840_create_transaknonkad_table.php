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
        Schema::create('transaknonkad', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_non')->unsigned();
            $table->bigInteger('id_peserta')->unsigned();
            // $table->char('id_peserta', 20);
            $table->string('kode_bayar');
            $table->string('status_bayar')->nullable();
            $table->tinyInteger('nilai')->default(0);
            $table->string('lulus')->default('0');
            $table->string('no_sertifikat')->default('-');
            $table->string('file_sertifikat')->default('-');

            // kolom tambahan dari SQL
            $table->string('kegiatan', 50)->nullable();
            $table->string('kategori', 15)->nullable();
            $table->string('ta', 5)->nullable();
            $table->date('tgl')->nullable();
            $table->char('skpi', 1)->default('0');

            $table->timestamps();

            // $table->foreign('id_non')->references('id')->on('non_akademiks')->onDelete('cascade');
            // $table->foreign('id_peserta')->references('ID')->on('dbmahasiswa')->onDelete('cascade');
        });
    }

    //database2





    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaknonkad');
    }
};
