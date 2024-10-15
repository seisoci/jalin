<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperRekapBruto
 */
class RekapBruto extends Model
{
  use HasFactory;
  public $timestamps = false;

  protected $fillable = [
    'tgl_rekap',
    'jalin_harian_id',
    'core_id',
    'rekap_netto'
  ];

  public function jalin(){
    return $this->belongsTo(JalinHarian::class, 'jalin_harian_id');
  }

  public function core(){
    return $this->belongsTo(Core::class);
  }
}
