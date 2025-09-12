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
        Schema::create('non_akademiks', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint unsigned auto increment
            $table->string('kegiatan');
            $table->string('kategori');
            $table->string('ta');
            $table->string('semester');
            $table->date('tglmulai');
            $table->date('tglselesai');
            $table->bigInteger('biaya')->default(0);
            $table->bigInteger('tot_penerimaan')->default(0);
            $table->bigInteger('tot_pengeluaran')->default(0);
            $table->string('narsum');
            $table->string('id_penyelenggara');
            $table->string('penyelenggara');
            $table->integer('jml_peserta')->default(0);
            $table->string('noser');
            $table->string('skpi')->default('0');
            $table->string('statusopen')->default('1');
            $table->string('brosur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_akademiks');
    }
};
