<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperConfigFile
 */
class ConfigFile extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $keyType = 'string';
  protected $primaryKey = 'code_trans';

  protected $fillable = [
    'code_trans',
    'file_name',
  ];

  public function configDetail(){
    return $this->hasMany(ConfigFileDetail::class, 'code_trans')->orderBy('sort')->keyBy('field_name');
  }
}
