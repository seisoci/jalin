<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSignature
 */
class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'position',
      'signature_title'
    ];

  protected function serializeDate(\DateTimeInterface $date)
  {
    return $date->isoFormat('YYYY-MM-DD HH:mm');
  }
}
