<?php

namespace App\Observers;

use App\Models\KembalikanBarang;
use App\Models\KurangBarang;
use App\Models\Stok;
use App\Models\TambahBarang;

class KembalikanStokBarangObserver
{
  public function created(KembalikanBarang $kembalikanBarang)
  {
    $stok = Stok::updateOrCreate([
      'barang_id' => $kembalikanBarang['barang_id']
    ]);

    $stok->qty += $kembalikanBarang['qty'];
    $stok->total_aset += $kembalikanBarang['total_harga'];
    $stok->save();
    $kembalikanBarang->jurnalstok()->create([
      'kode' => $kembalikanBarang['kode'],
      'barang_id' => $kembalikanBarang['barang_id'],
      'user_id' => $kembalikanBarang['user_id'],
      'ruang_penyimpanan_id' => $kembalikanBarang['tambah_barang']['ruang_penyimpanan_id'],
      'tgl' => $kembalikanBarang['tgl'],
      'qty' => $kembalikanBarang['qty'],
      'harga_satuan' =>  $kembalikanBarang['harga_satuan'],
      'total_harga' => $kembalikanBarang['total_harga'],
      'keterangan' => $kembalikanBarang['keterangan']
    ]);
  }

  public function updating(KembalikanBarang $kembalikanBarang)
  {
    $stok = Stok::whereBarangId($kembalikanBarang['barang_id'])->first();
    $stok->qty -= $kembalikanBarang->getOriginal('qty');
    $stok->total_aset -= $kembalikanBarang->getOriginal('total_harga');
    $stok->save();
  }

  public function updated(KembalikanBarang $kembalikanBarang)
  {
    $stok = Stok::whereBarangId($kembalikanBarang['barang_id'])->first();
    $stok->qty += $kembalikanBarang['qty'];
    $stok->total_aset += $kembalikanBarang['total_harga'];
    $stok->save();
    $kembalikanBarang->jurnalstok()->update([
      'kode' => $kembalikanBarang['kode'],
      'barang_id' => $kembalikanBarang['barang_id'],
      'user_id' => $kembalikanBarang['user_id'],
      'ruang_penyimpanan_id' => $kembalikanBarang['tambah_barang']['ruang_penyimpanan_id'],
      'tgl' => $kembalikanBarang['tgl'],
      'qty' => $kembalikanBarang['qty'],
      'harga_satuan' => $kembalikanBarang['harga_satuan'],
      'total_harga' => $kembalikanBarang['total_harga'],
      'keterangan' => $kembalikanBarang['keterangan']
    ]);
  }

  public function deleting(KembalikanBarang $kembalikanBarang)
  {
    $stok = Stok::whereBarangId($kembalikanBarang['barang_id'])->first();
    $stok->qty -= $kembalikanBarang->getOriginal('qty');
    $stok->total_aset -= $kembalikanBarang->getOriginal('total_harga');
    $stok->save();
    $kembalikanBarang->jurnalstok()->delete();
  }
}
