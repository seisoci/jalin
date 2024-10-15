<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapNetto extends Model
{
  use HasFactory;

  protected $fillable = [
    'tgl_rekap',
    'rekap_bruto_id',
    'jalin_harian_id'
  ];

  public function jalin()
  {
    return $this->belongsTo(JalinHarian::class, 'jalin_harian_id');
  }

  public function rekap_bruto()
  {
    return $this->belongsTo(RekapBruto::class, 'rekap_bruto_id');
  }
}
