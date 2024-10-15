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
    Schema::create('jalin_harian', function (Blueprint $table) {
      $table->id();
      $table->foreignId('upload_file_document_id')->constrained()->on('upload_file_documents')->onUpdate('cascade')->onDelete('cascade');
      $table->date('tgl');
      $table->enum('kode_report', ['54', '54A', '54B', '54C', '54D', '54E', '54F', '56', '56A', '56B', '56C', '56D', '56E', '56F']);
      $table->time('trx_time');
      $table->date('trx_tgl');
      $table->string('kode_terminal', 50);
      $table->string('no_kartu', 50);
      $table->string('jenis_message', 50);
      $table->string('kode_proses', 50);
      $table->decimal('nom_transaksi', 20, 2);
      $table->string('kode_kesalahan', 5)->nullable();
      $table->string('kode_bank_iss', 20)->nullable();
      $table->string('kode_bank_acq', 20)->nullable();
      $table->string('no_ref', 24)->nullable();
      $table->string('merchant_type', 24)->nullable();
      $table->string('kode_retail', 24)->nullable();
      $table->string('approval', 24)->nullable();
      $table->string('orig_nom', 24)->nullable();
      $table->decimal('fee_iss', 20, 2)->nullable();
      $table->decimal('fee_switching', 20, 2)->nullable();
      $table->decimal('fee_lbg_svc', 20, 2)->nullable();
      $table->decimal('fee_lbg_std', 20, 2)->nullable();
      $table->decimal('net_nominal', 20, 2)->nullable();
      $table->enum('rekap_bruto', ['normal', 'hold', 'clear'])->default('normal');
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
    Schema::dropIfExists('jalin_harian');
  }
};
