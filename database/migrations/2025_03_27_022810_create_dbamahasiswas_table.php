<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations: tidak perlu karena tabel sudah ada di database dba
     */
    public function up(): void
    {
        // Schema::connection('mysql2')->create('mahasiswa', function (Blueprint $table) {
        // tabel sudah ada, tdk perlu dicreat/edit
        // $table->id();
        // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('mahasiswa');
    }
};
