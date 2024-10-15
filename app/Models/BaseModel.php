<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin IdeHelperBaseModel
 */
class BaseModel extends Model
{
  public static function boot()
  {
    parent::boot();
    self::creating(function ($model) {
      $model->user_id = Auth::id();
    });
    self::updating(function ($model) {
      $model->user_id = Auth::id();
    });
  }

  public function scopeOwnership(Builder $query): Builder
  {
    if (auth()->user()->hasRole('super-admin', 'admin-dinas', 'admin-tu')) {
      $query = $query->where('barang.user_type', 'dinas');
    } elseif (auth()->user()->hasRole('admin-splp')) {
      $query = $query->where('barang.user_id', auth()->id());
    }
    return $query;
  }

  public function scopeOwnerEloquent(Builder $query): Builder
  {
    if (auth()->user()->hasRole('super-admin', 'admin-dinas', 'admin-tu')) {
      $query = $query->whereRelation('barang', 'user_type', '=', 'dinas');
    } elseif (auth()->user()->hasRole('admin-splp', 'admin-skb')) {
      $query = $query->whereRelation('barang', 'user_id', '=', auth()->id());
    }
    return $query;
  }

  public function scopeOwner(Builder $query): Builder
  {
    if (auth()->user()->hasRole('super-admin', 'admin-dinas', 'admin-tu')) {
      $query = $query->where('barang.user_type', '=', 'dinas');
    } elseif (auth()->user()->hasRole('admin-splp', 'admin-skb')) {
      $query = $query->where('barang.user_id', auth()->id());
    }
    return $query;
  }

  public function scopeOwnershipStok(Builder $query): Builder
  {
    if (auth()->user()->hasRole('admin-splp', 'admin-skb')) {
      $query = $query->where('barang.user_id', auth()->id());
    }
    return $query;
  }


  protected function serializeDate(\DateTimeInterface $date)
  {
    return $date->isoFormat('YYYY-MM-DD HH:mm');
  }
}
