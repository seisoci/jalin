<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Barang;
use App\Models\Signature;
use App\Models\TambahBarang;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sign;
use Yajra\DataTables\DataTables;

class SignatureController extends Controller
{
  use ResponseStatus;

  function __construct()
  {
    $this->middleware('can:signature-list', ['only' => ['index', 'show']]);
    $this->middleware('can:signature-create', ['only' => ['create', 'store']]);
    $this->middleware('can:signature-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:signature-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Signature";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Signature"],
    ];
    if ($request->ajax()) {
      $data = Signature::query();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<div class="btn-group dropend">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                               <li><a class="dropdown-item" href="' . route('signature.edit', $row->id) . '">Edit</a></li>
                               <li><a class="dropdown-item btn-delete" href="#" data-id ="' . $row->id . '" >Hapus</a></li>
                            </ul>
                          </div>';
          return $actionBtn;
        })->make();
    }
    return view('pages.backend.signature.index', compact('config'));
  }

  public function create()
  {
    $config['title'] = "Tambah Tanda Tangan";
    $config['breadcrumbs'] = [
      ['url' => route('signature.index'), 'title' => "Tanda Tangan"],
      ['url' => '#', 'title' => "Tambah Tanda Tangan"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('signature.store')
    ];
    return view('pages.backend.signature.form', compact('config'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'position' => 'required',
      'signature_title' => 'required',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $dimensions = [['300', '300', 'thumbnail']];
      try {
        Signature::create($request->all());
        DB::commit();
        $response = response()->json($this->responseStore(true, NULL, route('signature.index')));
      } catch (\Throwable $throw) {
        DB::rollBack();
        Log::error($throw);
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function edit($id)
  {
    $config['title'] = "Edit Tanda Tangan";
    $config['breadcrumbs'] = [
      ['url' => route('signature.index'), 'title' => "Tanda Tangan"],
      ['url' => '#', 'title' => "Edit Tanda Tangan"],
    ];

    $data = Signature::findOrFail($id);

    $config['form'] = (object)[
      'method' => 'PUT',
      'action' => route('signature.update', $id)
    ];
    return view('pages.backend.signature.form', compact('config', 'data'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'position' => 'required',
      'signature_title' => 'required',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $dimensions = [['300', '300', 'thumbnail']];
      try {
        $barang = Signature::firstOrFail();

        $barang->update($request->all());
        DB::commit();
        $response = response()->json($this->responseUpdate(true, route('signature.index')));
      } catch (\Throwable $throw) {
        Log::error($throw);
        DB::rollBack();
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function destroy($id)
  {
    $response = response()->json($this->responseDelete(false));
    $data = Signature::firstOrFail();

    DB::beginTransaction();
    try {
      if ($data->delete()) {
        $response = response()->json($this->responseDelete(true));
      }
      DB::commit();
    } catch (\Throwable $throw) {
      Log::error($throw);
      $response = response()->json(['error' => $throw->getMessage()]);
    }
    return $response;
  }


}
