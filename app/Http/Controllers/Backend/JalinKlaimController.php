<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JalinKlaim;
use App\Models\JalinRekap;
use App\Traits\Helper;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;

class JalinKlaimController extends Controller
{
  use Helper, ResponseStatus;

  public function __construct()
  {
    $this->middleware('can:jalin-klaim-list', ['only' => ['index', 'show']]);
    $this->middleware('can:jalin-klaim-create', ['only' => ['create', 'store']]);
    $this->middleware('can:jalin-klaim-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:jalin-klaim-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Klaim Jalin";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Data Klaim Jalin"],
    ];

    if ($request->ajax()) {
      $data = JalinKlaim::query();

      if ($request->filled('tgl')) {
        $data->where('tgl', $request['tgl']);
      }
      if ($request->filled('no_report')) {
        $data->where('no_report', $request['no_report']);
      }

      return \DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }

    return view('pages.backend.jalin.jalin-klaim.index', compact('config', 'page_breadcrumbs'));
  }
}
