<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperConfigFileDetail
 */
class ConfigFileDetail extends Model
{
  use HasFactory;
  public $timestamps = false;

  protected $fillable = [
    'code_trans',
    'sort',
    'field_name',
    'name',
    'start_at',
    'length',
  ];
}
