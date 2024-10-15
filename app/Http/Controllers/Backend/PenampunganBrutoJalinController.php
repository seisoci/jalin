<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JalinHarian;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;

class PenampunganBrutoJalinController extends Controller
{
  function __construct()
  {
    $this->middleware('can:penampungan-bruto-list', ['only' => ['index', 'show']]);
    $this->middleware('can:penampungan-bruto-create', ['only' => ['create', 'store']]);
    $this->middleware('can:penampungan-bruto-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:penampungan-bruto-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Bruto";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Bruto"],
    ];

    if ($request->ajax()) {
      $data = JalinHarian::whereRekapBruto('hold')
        ->whereKodeReport('56');

      if ($request->filled('tgl')) {
        $data->where('tgl', $request['tgl']);
      }

      return \DataTables::of($data)
        ->make(true);
    }

    return view('pages.backend.penampungan-bruto-jalin.index', compact('config', 'page_breadcrumbs'));
  }

}
