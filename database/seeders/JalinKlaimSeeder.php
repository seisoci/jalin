<?php

namespace Database\Seeders;

use App\Models\ConfigFile;
use App\Models\ConfigFileDetail;
use Illuminate\Database\Seeder;

class JalinKlaimSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $jalinCodeTrans = ['DSPT01', 'DSPT02'];
    $jalinHarian = 'Jalin Klaim';

    foreach ($jalinCodeTrans as $item):
      ConfigFile::create([
        'code_trans' => $item,
        'file_name' => $jalinHarian
      ]);
    endforeach;


    $configFileDetail = [
      [
        'sort' => 1,
        'field_name' => 'trx_code',
        'name' => 'Trx code',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 2,
        'field_name' => 'trx_tgl',
        'name' => 'Tanggal Trx',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 3,
        'field_name' => 'trx_time',
        'name' => 'Jam Trx',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 4,
        'field_name' => 'ref_no',
        'name' => 'Ref No',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 5,
        'field_name' => 'trace_no',
        'name' => 'Trace No',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 6,
        'field_name' => 'term_id',
        'name' => 'Term ID',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 7,
        'field_name' => 'no_kartu',
        'name' => 'No Kartu',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 8,
        'field_name' => 'kode_iss',
        'name' => 'Kode ISS',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 9,
        'field_name' => 'kode_acq',
        'name' => 'Kode ACQ',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 10,
        'field_name' => 'marchant_id',
        'name' => 'MerchantID',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 11,
        'field_name' => 'merchant_type',
        'name' => 'Merchant Type',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 12,
        'field_name' => 'marchant_location',
        'name' => 'Merchant Location',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 13,
        'field_name' => 'marchant_name',
        'name' => 'Merchant Name',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 14,
        'field_name' => 'marchant_code',
        'name' => 'Nominal Merchant Code',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 15,
        'field_name' => 'dispute_trans_code',
        'name' => 'Dispute Trans Code',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 16,
        'field_name' => 'dispute_amount',
        'name' => 'Dispute Amount',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 17,
        'field_name' => 'charge_back_fee',
        'name' => 'Chargeback Fee',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 18,
        'field_name' => 'fee_return',
        'name' => 'Fee Return',
        'start_at' => 0,
        'length' => 0,
      ], [
        'sort' => 19,
        'field_name' => 'dispute_net_amount',
        'name' => 'Dispute Net Amount',
        'start_at' => 0,
        'length' => 0,
      ],
    ];


    foreach ($jalinCodeTrans as $item):
      foreach ($configFileDetail as $itemChild):
        ConfigFileDetail::create([
          'code_trans' => $item,
          'sort' => $itemChild['sort'],
          'field_name' => $itemChild['field_name'],
          'name' => $itemChild['name'],
          'start_at' => $itemChild['start_at'],
          'length' => $itemChild['length'],
        ]);
      endforeach;
    endforeach;
  }
}
