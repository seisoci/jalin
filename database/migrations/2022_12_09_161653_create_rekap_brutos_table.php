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
    Schema::create('rekap_brutos', function (Blueprint $table) {
      $table->id();
      $table->date('tgl_rekap');
      $table->foreignId('jalin_harian_id')->constrained()->on('jalin_harian')->onUpdate('cascade')->onDelete('cascade');
      $table->foreignId('core_id')->constrained()->on('cores')->onUpdate('cascade')->onDelete('cascade');
      $table->enum('rekap_netto',  ['normal', 'hold', 'clear'])->default('normal');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('rekap_brutos');
  }
};
