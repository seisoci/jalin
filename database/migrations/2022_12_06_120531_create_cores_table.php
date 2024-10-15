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
    Schema::create('cores', function (Blueprint $table) {
      $table->id();
      $table->foreignId('upload_file_document_id')->constrained()->on('upload_file_documents')->onUpdate('cascade')->onDelete('cascade');
      $table->date('tgl');
      $table->string('cabang');
      $table->string('acq');
      $table->string('iss');
      $table->string('destination')->nullable();
      $table->string('terminal')->nullable();
      $table->string('produk')->nullable();
      $table->string('io')->nullable();
      $table->string('msg')->nullable();
      $table->string('proses')->nullable();
      $table->string('trx_tgl')->nullable();
      $table->string('no_kartu')->nullable();
      $table->string('no_rek_db')->nullable();
      $table->string('no_rek_cr')->nullable();
      $table->decimal('nilai_transaksi', 15, 2)->default(0);
      $table->decimal('nilai_replace_rev', 15, 2)->nullable();
      $table->string('hist_post')->nullable();
      $table->decimal('rec_num', 15, 2)->nullable();
      $table->enum('rekap_bruto', ['normal', 'hold', 'clear'])->default('normal');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cores');
  }
};
