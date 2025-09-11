<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   */
  public function up(): void
  {
    Schema::create('konfigurasis', function (Blueprint $table) {
      $table->increments('id');
      $table->string('config_group');
      $table->string('config_key');
      $table->text('config_value')->nullable();
      $table->string('value_1')->nullable();
      $table->string('value_2')->nullable();
      $table->string('value_3')->nullable();
      $table->string('value_4')->nullable();
      $table->string('value_5')->nullable();
      $table->timestamps();
      // $table->engine = 'MyISAM'; //now used for optimization
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('konfigurasis');
  }
};
