<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCore
 */
class Core extends Model
{
  use HasFactory;
  public $timestamps = false;

  protected $fillable = [
    'upload_file_document_id',
    'tgl',
    'cabang',
    'acq',
    'iss',
    'destination',
    'terminal',
    'produk',
    'io',
    'msg',
    'proses',
    'trx_tgl',
    'no_kartu',
    'no_rek_db',
    'no_rek_cr',
    'nilai_transaksi',
    'nilai_replace_rev',
    'hist_post',
    'rec_num',
    'rekap_bruto',
  ];
}
