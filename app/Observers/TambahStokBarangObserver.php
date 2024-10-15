<?php

namespace App\Observers;

use App\Models\Barang;
use App\Models\KembalikanBarang;
use App\Models\KurangBarang;
use App\Models\Stok;
use App\Models\TambahBarang;

class TambahStokBarangObserver
{

  public function created(TambahBarang $tambahBarang)
  {
    $stok = Stok::updateOrCreate([
      'barang_id' => $tambahBarang['barang_id']
    ]);
    if ($stok->wasRecentlyCreated) {
      $stok->qty = $tambahBarang['qty'];
      $stok->total_aset = $tambahBarang['total_harga'];
    } else {
      $stok->qty += $tambahBarang['qty'];
      $stok->total_aset += $tambahBarang['total_harga'];
    }
    $stok->save();

    $tambahBarang->jurnalstok()->create([
      'kode' => $tambahBarang['kode'],
      'barang_id' => $tambahBarang['barang_id'],
      'user_id' => $tambahBarang['user_id'],
      'ruang_penyimpanan_id' => $tambahBarang['ruang_penyimpanan_id'],
      'tgl' => $tambahBarang['tgl'],
      'qty' => $tambahBarang['qty'],
      'harga_satuan' => $tambahBarang['harga_satuan'],
      'total_harga' => $tambahBarang['total_harga'],
      'keterangan' => $tambahBarang['keterangan']
    ]);
  }

  public function updating(TambahBarang $tambahBarang)
  {
    $stok = Stok::whereBarangId($tambahBarang['barang_id'])->first();
    $stok->qty -= $tambahBarang->getOriginal('qty');
    $stok->total_aset -= $tambahBarang->getOriginal('total_harga');
    $stok->save();
  }

  public function updated(TambahBarang $tambahBarang)
  {
    $stok = Stok::whereBarangId($tambahBarang['barang_id'])->first();
    $stok->qty += $tambahBarang['qty'];
    $stok->total_aset += $tambahBarang['total_harga'];
    $stok->save();

    $tambahBarang->jurnalstok()->update([
      'kode' => $tambahBarang['kode'],
      'barang_id' => $tambahBarang['barang_id'],
      'user_id' => $tambahBarang['user_id'],
      'ruang_penyimpanan_id' => $tambahBarang['ruang_penyimpanan_id'],
      'tgl' => $tambahBarang['tgl'],
      'qty' => $tambahBarang['qty'],
      'harga_satuan' => $tambahBarang['harga_satuan'],
      'total_harga' => $tambahBarang['total_harga'],
      'keterangan' => $tambahBarang['keterangan']
    ]);

    $kurangBarang = KurangBarang::where('tambah_barang_id', $tambahBarang['id'])->get();
    foreach ($kurangBarang ?? [] as $item):
      $kurang = KurangBarang::find($item['id']);
      $kurang->update([
        'harga_satuan' => $tambahBarang['harga_satuan'],
        'total_harga' => ($kurang['qty'] * $tambahBarang['harga_satuan']),
      ]);

      $kembalikanBarang = KembalikanBarang::where('tambah_barang_id', $tambahBarang['id'])->get();
      foreach ($kembalikanBarang ?? [] as $itemChild):
        $kembalikan = KembalikanBarang::find($itemChild['id']);
        $kembalikan->update([
          'harga_satuan' => $tambahBarang['harga_satuan'],
          'total_harga' => ($kembalikan['qty'] * $tambahBarang['harga_satuan']),
        ]);
      endforeach;

    endforeach;
  }

  public function deleting(TambahBarang $tambahBarang)
  {
    $stok = Stok::whereBarangId($tambahBarang['barang_id'])->first();
    $stok->qty -= $tambahBarang->getOriginal('qty');
    $stok->total_aset -= $tambahBarang->getOriginal('total_harga');
    $stok->save();
    $tambahBarang->jurnalstok()->delete();
  }

}
