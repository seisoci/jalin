<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Core;
use App\Models\JalinHarian;
use Illuminate\Http\Request;

class CoreController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:core-list', ['only' => ['index', 'show']]);
    $this->middleware('can:core-create', ['only' => ['create', 'store']]);
    $this->middleware('can:core-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:core-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Core";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Core"],
    ];

    if ($request->ajax()) {
      $data = Core::query();

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

    return view('pages.backend.jalin.core.index', compact('config', 'page_breadcrumbs'));
  }
}
