<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JalinHarian;
use Illuminate\Http\Request;

class PenampunganNettoJalinController extends Controller
{
  function __construct()
  {
    $this->middleware('can:penampungan-netto-jalin-list', ['only' => ['index', 'show']]);
    $this->middleware('can:penampungan-netto-jalin-create', ['only' => ['create', 'store']]);
    $this->middleware('can:penampungan-netto-jalin-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:penampungan-netto-jalin-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Netto Jalin 56D";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Netto Jalin 56D"],
    ];

    if ($request->ajax()) {
      $data = JalinHarian::whereRekapNetto('hold')
        ->whereKodeReport('56D');


      if ($request->filled('tgl')) {
        $data->where('tgl', $request['tgl']);
      }

      return \DataTables::of($data)
        ->make(true);
    }

    return view('pages.backend.penampungan-netto-jalin.index', compact('config', 'page_breadcrumbs'));
  }

}
