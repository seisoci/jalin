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
    Schema::create('config_file_details', function (Blueprint $table) {
      $table->id();
      $table->string('code_trans');
      $table->integer('sort');
      $table->string('field_name');
      $table->string('name');
      $table->string('start_at');
      $table->string('length');
      $table->foreign('code_trans')->references('code_trans')->on('config_files');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('config_file_details');
  }
};
