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
    Schema::create('jalin_rekaps', function (Blueprint $table) {
      $table->id();
      $table->foreignId('upload_file_document_id')->constrained()->on('upload_file_documents')->onUpdate('cascade')->onDelete('cascade');
      $table->string('tgl');
      $table->string('bank_name');
      $table->integer('acq_jml_trx_purchase');
      $table->decimal('acq_acq_switch_purchase', 20, 2)->default(0)->comment('A');
      $table->decimal('acq_iss_switch_purchase', 20, 2)->default(0)->comment('B');
      $table->decimal('acq_iss_purchase', 20, 2)->default(0)->comment('C');
      $table->decimal('acq_lbg_standard_purchase', 20, 2)->default(0)->comment('D');
      $table->decimal('acq_lbg_service_purchase', 20, 2)->default(0)->comment('E');
      $table->decimal('acq_total_fee_purchase', 20, 2)->default(0)->comment('F');
      $table->decimal('acq_total_nominal_transaksi_purchase', 20, 2)->default(0)->comment('G');
      $table->decimal('acq_jml_trx_refund', 20, 2)->default(0);
      $table->decimal('acq_fee_iss_refund', 20, 2)->default(0)->comment('H');
      $table->decimal('acq_total_nominal_transaksi_refund', 20, 2)->default(0)->comment('I');
      $table->decimal('iss_jml_trx_purchase', 20, 2)->default(0);
      $table->decimal('iss_fee_iss_purchase', 20, 2)->default(0)->comment('J');
      $table->decimal('iss_total_nominal_transaksi_purchase', 20, 2)->default(0)->comment('K');
      $table->decimal('iss_jml_trx_refund', 20, 2)->default(0);
      $table->decimal('iss_fee_iss_refund', 20, 2)->default(0)->comment('L');
      $table->decimal('iss_total_nominal_transaksi_refund', 20, 2)->default(0)->comment('M');
      $table->decimal('subtotal_gross_kewajiban', 20, 2)->default(0)->comment('N');
      $table->decimal('subtotal_gross_hak', 20, 2)->default(0)->comment('O');
      $table->decimal('acq_kewajiban_dispute', 20, 2)->default(0)->comment('P');
      $table->decimal('acq_hak_dispute', 20, 2)->default(0)->comment('Q');
      $table->decimal('iss_kewajiban_dispute', 20, 2)->default(0)->comment('R');
      $table->decimal('iss_hak_dispute', 20, 2)->default(0)->comment('S');
      $table->decimal('subtotal_gross_kewajiban_t', 20, 2)->default(0)->comment('T');
      $table->decimal('subtotal_gross_hak_u', 20, 2)->default(0)->comment('U');
      $table->decimal('total_gross_kewajiban_v', 20, 2)->default(0)->comment('V');
      $table->decimal('total_gross_hak_w', 20, 2)->default(0)->comment('W');
      $table->decimal('total_net_kewajiban', 20, 2)->default(0)->comment('X');
      $table->decimal('total_net_hak', 20, 2)->default(0)->comment('Y');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('jalin_rekaps');
  }
};
