<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JalinRekap;
use App\Models\UploadFileDocument;
use App\Traits\Helper;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;

class JalinRekapController extends Controller
{
  use Helper, ResponseStatus;

  public function __construct()
  {
    $this->middleware('can:jalin-rekap-list', ['only' => ['index', 'show']]);
    $this->middleware('can:jalin-rekap-create', ['only' => ['create', 'store']]);
    $this->middleware('can:jalin-rekap-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:jalin-rekap-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Data Rekapitulasi Jalin";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Data Rekapitulasi Jalin"],
    ];

    if ($request->ajax()) {
      $data = JalinRekap::query();

      if ($request->filled('tgl')) {
        $data->where('tgl', $request['tgl']);
      }else{
        $data->whereNull('tgl');
      }

      return \DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }

    return view('pages.backend.jalin.jalin-rekap.index', compact('config', 'page_breadcrumbs'));
  }


}
