<?php

namespace Database\Seeders;

use App\Models\ConfigFile;
use App\Models\ConfigFileDetail;
use Illuminate\Database\Seeder;

class JalinHarianSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $jalinCodeTrans = ['54', '54A', '54B', '54C', '54D', '54E', '54F', '56', '56A', '56B', '56C', '56D', '56E', '56F'];
    $jalinHarian = 'Jalin Harian';

    foreach ($jalinCodeTrans as $item):
      ConfigFile::create([
        'code_trans' => $item,
        'file_name' => $jalinHarian
      ]);
    endforeach;

    $configFileDetail54 = [
      [
        'code_trans' => '54',
        'sort' => 1,
        'field_name' => 'trx_time',
        'name' => 'Waktu Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 2,
        'field_name' => 'trx_tgl',
        'name' => 'Tanggal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 3,
        'field_name' => 'kode_terminal',
        'name' => 'Kode Terminal',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 4,
        'field_name' => 'no_kartu',
        'name' => 'No Kartu',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 5,
        'field_name' => 'jenis_message',
        'name' => 'Jenis Message',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 6,
        'field_name' => 'kode_proses',
        'name' => 'Kode Pemrosesan',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 7,
        'field_name' => 'nom_transaksi',
        'name' => 'Nominal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 8,
        'field_name' => 'kode_kesalahan',
        'name' => 'Kode Kesalahan',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 9,
        'field_name' => 'kode_bank_iss',
        'name' => 'Kode Bank Issuer',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 10,
        'field_name' => 'no_ref',
        'name' => 'No Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 11,
        'field_name' => 'merchant_type',
        'name' => 'Merchant Type',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 12,
        'field_name' => 'kode_retail',
        'name' => 'Kode Retail',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 13,
        'field_name' => 'approval',
        'name' => 'Kode Approval',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 14,
        'field_name' => 'orig_nom',
        'name' => 'Orig Nomor Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],
    ];

    $configFileDetail54D = [
      [
        'code_trans' => '54D',
        'sort' => 1,
        'field_name' => 'trx_time',
        'name' => 'Waktu Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54D',
        'sort' => 2,
        'field_name' => 'trx_tgl',
        'name' => 'Tanggal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54D',
        'sort' => 3,
        'field_name' => 'kode_terminal',
        'name' => 'Kode Terminal',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54D',
        'sort' => 4,
        'field_name' => 'no_kartu',
        'name' => 'No Kartu',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54D',
        'sort' => 5,
        'field_name' => 'jenis_message',
        'name' => 'Jenis Message',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54D',
        'sort' => 6,
        'field_name' => 'kode_proses',
        'name' => 'Kode Pemrosesan',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54D',
        'sort' => 7,
        'field_name' => 'nom_transaksi',
        'name' => 'Nominal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 8,
        'field_name' => 'kode_kesalahan',
        'name' => 'Kode Kesalahan',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 9,
        'field_name' => 'kode_bank_iss',
        'name' => 'Kode Bank Issuer',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 10,
        'field_name' => 'no_ref',
        'name' => 'No Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 11,
        'field_name' => 'merchant_type',
        'name' => 'Merchant Type',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 12,
        'field_name' => 'kode_retail',
        'name' => 'Kode Retail',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 13,
        'field_name' => 'approval',
        'name' => 'Kode Approval',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 14,
        'field_name' => 'orig_nom',
        'name' => 'Orig Nomor Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 15,
        'field_name' => 'fee_iss',
        'name' => 'Fee Issuer',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 16,
        'field_name' => 'fee_switching',
        'name' => 'Fee Switching',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 17,
        'field_name' => 'fee_lbg_svc',
        'name' => 'Fee LBG SVC',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 18,
        'field_name' => 'fee_lbg_std',
        'name' => 'Fee LBG STD',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54D',
        'sort' => 19,
        'field_name' => 'net_nominal',
        'name' => 'Net Nominal',
        'start_at' => 0,
        'length' => 0,
      ],
    ];

    $configFileDetail56 = [
      [
        'code_trans' => '54',
        'sort' => 1,
        'field_name' => 'trx_time',
        'name' => 'Waktu Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 2,
        'field_name' => 'trx_tgl',
        'name' => 'Tanggal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 3,
        'field_name' => 'kode_terminal',
        'name' => 'Kode Terminal',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 4,
        'field_name' => 'no_kartu',
        'name' => 'No Kartu',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 5,
        'field_name' => 'jenis_message',
        'name' => 'Jenis Message',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 6,
        'field_name' => 'kode_proses',
        'name' => 'Kode Pemrosesan',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '54',
        'sort' => 7,
        'field_name' => 'nom_transaksi',
        'name' => 'Nominal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 8,
        'field_name' => 'kode_kesalahan',
        'name' => 'Kode Kesalahan',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 9,
        'field_name' => 'kode_bank_acq',
        'name' => 'Kode Bank Acquirer',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 10,
        'field_name' => 'no_ref',
        'name' => 'No Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 11,
        'field_name' => 'merchant_type',
        'name' => 'Merchant Type',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 12,
        'field_name' => 'kode_retail',
        'name' => 'Kode Retail',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 13,
        'field_name' => 'approval',
        'name' => 'Kode Approval',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '54',
        'sort' => 14,
        'field_name' => 'orig_nom',
        'name' => 'Orig Nomor Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],
    ];

    $configFileDetail56D = [
      [
        'code_trans' => '56D',
        'sort' => 1,
        'field_name' => 'trx_time',
        'name' => 'Waktu Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '56D',
        'sort' => 2,
        'field_name' => 'trx_tgl',
        'name' => 'Tanggal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '56D',
        'sort' => 3,
        'field_name' => 'kode_terminal',
        'name' => 'Kode Terminal',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '56D',
        'sort' => 4,
        'field_name' => 'no_kartu',
        'name' => 'No Kartu',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '56D',
        'sort' => 5,
        'field_name' => 'jenis_message',
        'name' => 'Jenis Message',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '56D',
        'sort' => 6,
        'field_name' => 'kode_proses',
        'name' => 'Kode Pemrosesan',
        'start_at' => 0,
        'length' => 0,
      ], [
        'code_trans' => '56D',
        'sort' => 7,
        'field_name' => 'nom_transaksi',
        'name' => 'Nominal Transaksi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 8,
        'field_name' => 'kode_kesalahan',
        'name' => 'Kode Kesalahan',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 9,
        'field_name' => 'kode_bank_acq',
        'name' => 'Kode Bank Acquirer',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 10,
        'field_name' => 'no_ref',
        'name' => 'No Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 11,
        'field_name' => 'merchant_type',
        'name' => 'Merchant Type',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 12,
        'field_name' => 'kode_retail',
        'name' => 'Kode Retail',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 13,
        'field_name' => 'approval',
        'name' => 'Kode Approval',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 14,
        'field_name' => 'orig_nom',
        'name' => 'Orig Nomor Refrensi',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 15,
        'field_name' => 'fee_iss',
        'name' => 'Fee Issuer',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 16,
        'field_name' => 'fee_switching',
        'name' => 'Fee Switching',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 17,
        'field_name' => 'fee_lbg_svc',
        'name' => 'Fee LBG SVC',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 18,
        'field_name' => 'fee_lbg_std',
        'name' => 'Fee LBG STD',
        'start_at' => 0,
        'length' => 0,
      ],[
        'code_trans' => '56D',
        'sort' => 19,
        'field_name' => 'net_nominal',
        'name' => 'Net Nominal',
        'start_at' => 0,
        'length' => 0,
      ],
    ];

    foreach ($jalinCodeTrans as $item):
      if(in_array($item, ['54', '54A', '54B', '54C', '54E', '54F'])){
       foreach ($configFileDetail54 as $itemChild):
         ConfigFileDetail::create([
           'code_trans' => $item,
           'sort' => $itemChild['sort'],
           'field_name'  => $itemChild['field_name'],
           'name' => $itemChild['name'],
           'start_at' => $itemChild['start_at'],
           'length' =>$itemChild['length'],
         ]);
       endforeach;
      }elseif($item == '54D'){
        ConfigFileDetail::insert($configFileDetail54D);
      }elseif(in_array($item, ['56', '56A', '56B', '56C', '54E', '56F'])){
        foreach ($configFileDetail56 as $itemChild):
          ConfigFileDetail::create([
            'code_trans' => $item,
            'sort' => $itemChild['sort'],
            'field_name'  => $itemChild['field_name'],
            'name' => $itemChild['name'],
            'start_at' => $itemChild['start_at'],
            'length' =>$itemChild['length'],
          ]);
        endforeach;
      }elseif($item == '56D'){
        ConfigFileDetail::insert($configFileDetail56D);
      }
      endforeach;
  }
}
