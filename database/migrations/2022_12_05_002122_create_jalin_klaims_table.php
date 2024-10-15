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
    Schema::create('jalin_klaim', function (Blueprint $table) {
      $table->id();
      $table->foreignId('upload_file_document_id')->constrained()->on('upload_file_documents')->onUpdate('cascade')->onDelete('cascade');
      $table->date('tgl');
      $table->enum('jenis', ['acq', 'iss']);
      $table->string('no_report', 50);
      $table->string('trx_code', 50);
      $table->date('trx_tgl');
      $table->time('trx_time');
      $table->string('ref_no', 50);
      $table->string('trace_no', 50);
      $table->string('term_id', 50);
      $table->decimal('no_kartu', 50, 0);
      $table->string('kode_iss', 50);
      $table->string('kode_acq', 50);
      $table->string('marchant_id', 50);
      $table->string('marchant_location', 50);
      $table->string('marchant_name', 50);
      $table->decimal('nominal', 20, 2);
      $table->string('marchant_code', 50);
      $table->string('dispute_trans_code', 50);
      $table->string('registration_num', 50);
      $table->decimal('dispute_amount', 20, 2);
      $table->decimal('charge_back_fee', 20, 2);
      $table->decimal('fee_return', 20, 2);
      $table->decimal('dispute_net_amount', 20, 2);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('jalin_klaims');
  }
};
