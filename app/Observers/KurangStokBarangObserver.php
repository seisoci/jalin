<?php

namespace App\Observers;

use App\Models\KurangBarang;
use App\Models\Stok;
use App\Models\TambahBarang;

class KurangStokBarangObserver
{
  public function created(KurangBarang $kurangBarang)
  {
    $stok = Stok::updateOrCreate([
      'barang_id' => $kurangBarang['barang_id']
    ]);

    $stok->qty -= $kurangBarang['qty'];
    $stok->total_aset -= $kurangBarang['total_harga'];
    $stok->save();
    $kurangBarang->jurnalstok()->create([
      'kode' => $kurangBarang['kode'],
      'barang_id' => $kurangBarang['barang_id'],
      'user_id' => $kurangBarang['user_id'],
      'ruang_penyimpanan_id' => $kurangBarang['tambah_barang']['ruang_penyimpanan_id'],
      'tgl' => $kurangBarang['tgl'],
      'qty' => -1 * $kurangBarang['qty'],
      'harga_satuan' => -1 * $kurangBarang['harga_satuan'],
      'total_harga' => -1 * $kurangBarang['total_harga'],
      'keterangan' => $kurangBarang['keterangan']
    ]);
  }

  public function updating(KurangBarang $kurangBarang)
  {
    $stok = Stok::whereBarangId($kurangBarang['barang_id'])->first();
    $stok->qty += $kurangBarang->getOriginal('qty');
    $stok->total_aset += $kurangBarang->getOriginal('total_harga');
    $stok->save();
  }

  public function updated(KurangBarang $kurangBarang)
  {
    $stok = Stok::whereBarangId($kurangBarang['barang_id'])->first();
    $stok->qty -= $kurangBarang['qty'];
    $stok->total_aset -= $kurangBarang['total_harga'];
    $stok->save();

    $kurangBarang->jurnalstok()->update([
      'kode' => $kurangBarang['kode'],
      'barang_id' => $kurangBarang['barang_id'],
      'user_id' => $kurangBarang['user_id'],
      'ruang_penyimpanan_id' => $kurangBarang['tambah_barang']['ruang_penyimpanan_id'],
      'tgl' => $kurangBarang['tgl'],
      'qty' => -1 * $kurangBarang['qty'],
      'harga_satuan' => -1 * $kurangBarang['harga_satuan'],
      'total_harga' => -1 * $kurangBarang['total_harga'],
      'keterangan' => $kurangBarang['keterangan']
    ]);
  }

  public function deleting(KurangBarang $kurangBarang)
  {
    $stok = Stok::whereBarangId($kurangBarang['barang_id'])->first();
    $stok->qty += $kurangBarang->getOriginal('qty');
    $stok->total_aset += $kurangBarang->getOriginal('total_harga');
    $stok->save();
    $kurangBarang->jurnalstok()->delete();
  }
}
