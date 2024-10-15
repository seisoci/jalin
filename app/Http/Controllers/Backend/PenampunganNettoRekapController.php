<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Core;
use App\Models\RekapBruto;
use Illuminate\Http\Request;

class PenampunganNettoRekapController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:penampungan-netto-rekap-list', ['only' => ['index', 'show']]);
    $this->middleware('can:penampungan-netto-rekap-create', ['only' => ['create', 'store']]);
    $this->middleware('can:penampungan-netto-rekap-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:penampungan-netto-rekap-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Netto Hasil Rekap Dari Bruto";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Netto Hasil Rekap Dari Bruto"],
    ];

    if ($request->ajax()) {
      $data = RekapBruto::selectRaw('
           `rekap_brutos`.`id`,
           `rekap_brutos`.`tgl_rekap` AS `tgl`,
           `cores`.`trx_tgl`,
           `cores`.`no_kartu` AS `no_card`,
           `cores`.`terminal` AS `terminal_code`,
           `cores`.`nilai_transaksi` AS `amount`
        ')
        ->leftJoin('cores', 'cores.id', '=', 'rekap_brutos.core_id')
        ->whereRekapNetto('hold');

      if ($request->filled('tgl')) {
        $data->where('rekap_brutos.tgl_rekap', $request['tgl']);
      }

      return \DataTables::of($data)
        ->make(true);
    }

    return view('pages.backend.penampungan-netto-rekap.index', compact('config', 'page_breadcrumbs'));
  }
}
