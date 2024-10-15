<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUploadFileDocument
 */
class UploadFileDocument extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'location',
    'jenis_file',
    'jenis_laporan',
    'tgl_dokumen',
  ];
}
