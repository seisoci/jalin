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
    Schema::create('upload_file_documents', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('location');
      $table->enum('jenis_file', ['jalin', 'xlink', 'core']);
      $table->enum('jenis_laporan', ['jalin_rekap', 'jalin_clearing', 'jalin_harian', 'jalin_klaim', 'jalin_transaksi', 'core']);
      $table->date('tgl_dokumen');
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
    Schema::dropIfExists('upload_file_documents');
  }
};
