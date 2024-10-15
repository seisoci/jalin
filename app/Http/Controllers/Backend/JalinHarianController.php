<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JalinHarian;
use Illuminate\Http\Request;

class JalinHarianController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:jalin-harian-list', ['only' => ['index', 'show']]);
    $this->middleware('can:jalin-harian-create', ['only' => ['create', 'store']]);
    $this->middleware('can:jalin-harian-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:jalin-harian-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Harian Jalin";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Harian Jalin"],
    ];

    if ($request->ajax()) {
      $data = JalinHarian::query();

      if ($request->filled('tgl')) {
        $data->where('tgl', $request['tgl']);
      }

      if ($request->filled('kode_report')) {
        $data->where('kode_report', $request['kode_report']);
      }

      return \DataTables::of($data)
        ->make(true);
    }

    return view('pages.backend.jalin.jalin-harian.index', compact('config', 'page_breadcrumbs'));
  }
}
