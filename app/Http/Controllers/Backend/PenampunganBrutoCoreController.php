<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Core;
use Illuminate\Http\Request;

class PenampunganBrutoCoreController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:penampungan-bruto-core-list', ['only' => ['index', 'show']]);
    $this->middleware('can:penampungan-bruto-core-create', ['only' => ['create', 'store']]);
    $this->middleware('can:penampungan-bruto-core-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:penampungan-bruto-core-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Bruto Core";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Bruto Core"],
    ];

    if ($request->ajax()) {
      $data = Core::whereRekapBruto('hold')
        ->where('no_rek_db', '!=', '');

      if ($request->filled('tgl')) {
        $data->where('tgl', $request['tgl']);
      }

      if ($request->filled('transaksi')) {
        match ($request['transaksi']) {
          'debit' => $data->where('no_rek_db', '!=', ''),
          'credit' =>  $data->where('no_rek_cr', '!=', ''),
        };
      }

      return \DataTables::of($data)
        ->make(true);
    }

    return view('pages.backend.penampungan-bruto-core.index', compact('config', 'page_breadcrumbs'));
  }
}
