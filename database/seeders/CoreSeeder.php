<?php

namespace Database\Seeders;

use App\Models\ConfigFile;
use App\Models\ConfigFileDetail;
use Illuminate\Database\Seeder;

class CoreSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ConfigFile::create([
      'code_trans' => 'Core',
      'file_name' => 'Core'
    ]);

    $configFileDetail = [
      [
        'code_trans' => 'Core',
        'sort' => 1,
        'field_name' => 'cabang',
        'name' => 'Cabang',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 2,
        'field_name' => 'acq',
        'name' => 'Acquirer',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 3,
        'field_name' => 'iss',
        'name' => 'Issuer',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 4,
        'field_name' => 'destination',
        'name' => 'Destination',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 5,
        'field_name' => 'terminal',
        'name' => 'Terminal',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 6,
        'field_name' => 'produk',
        'name' => 'Produk',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 7,
        'field_name' => 'io',
        'name' => 'I/O',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 8,
        'field_name' => 'msg',
        'name' => 'MSG',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 9,
        'field_name' => 'proses',
        'name' => 'Proses',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 10,
        'field_name' => 'trx_tgl',
        'name' => 'Tanggal',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 11,
        'field_name' => 'no_kartu',
        'name' => 'No Kartu',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 12,
        'field_name' => 'no_rek_db',
        'name' => 'No Rek DB',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 13,
        'field_name' => 'no_rek_cr',
        'name' => 'No Rek CR',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => 'Core',
        'sort' => 14,
        'field_name' => 'nilai_transaksi',
        'name' => 'Nilai Transaksi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => 'Core',
        'sort' => 15,
        'field_name' => 'nilai_replace_rev',
        'name' => 'Nilai Replace Rev',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => 'Core',
        'sort' => 16,
        'field_name' => 'hist_post',
        'name' => 'Hist Post',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => 'Core',
        'sort' => 17,
        'field_name' => 'rec_num',
        'name' => 'Rec Num',
        'start_at' => 0,
        'length' => 0,
      ],
    ];

    foreach ($configFileDetail as $itemChild):
      ConfigFileDetail::create([
        'code_trans' => 'Core',
        'sort' => $itemChild['sort'],
        'field_name' => $itemChild['field_name'],
        'name' => $itemChild['name'],
        'start_at' => $itemChild['start_at'],
        'length' => $itemChild['length'],
      ]);
    endforeach;
  }
}
