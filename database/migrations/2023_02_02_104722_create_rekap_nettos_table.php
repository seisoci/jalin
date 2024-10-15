<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('rekap_nettos', function (Blueprint $table) {
      $table->id();
      $table->date('tgl_rekap');
      $table->foreignId('rekap_bruto_id')->constrained()->on('rekap_brutos')->onUpdate('cascade')->onDelete('cascade');
      $table->foreignId('jalin_harian_id')->constrained()->on('jalin_harian')->onUpdate('cascade')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('rekap_nettos');
  }
};
