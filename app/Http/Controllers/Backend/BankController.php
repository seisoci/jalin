<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Kecamatan;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BankController extends Controller
{
  use ResponseStatus;

  function __construct()
  {
    $this->middleware('can:bank-list', ['only' => ['index', 'show']]);
    $this->middleware('can:bank-create', ['only' => ['create', 'store']]);
    $this->middleware('can:bank-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:bank-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Bank";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Bank"],
    ];
    if ($request->ajax()) {
      $data = Bank::query();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<div class="btn-group dropend">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                  data-bs-kode_bank="' . $row->kode_bank . '"
                                  data-bs-name="' . $row->name . '"
                                  class="dropdown-item">Ubah</a></li>
                                <li><a class="dropdown-item btn-delete" href="#" data-id ="' . $row->id . '" >Hapus</a></li>
                            </ul>
                          </div>';
          return $actionBtn;
        })->make();
    }
    return view('pages.backend.bank.index', compact('config'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'kode_bank' => 'required',
      'name' => 'required',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        Bank::create($request->all());
        DB::commit();
        $response = response()->json($this->responseStore(true));
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

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'kode_bank' => 'required',
      'name' => 'required',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        $data = Bank::findOrFail($id);
        $data->update($request->all());
        DB::commit();
        $response = response()->json($this->responseUpdate(true));
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
    $response = response()->json([
      'status' => 'error',
      'message' => 'Data gagal dihapus'
    ]);
    $data = Bank::find($id);
    DB::beginTransaction();
    try {
      if($data){
        $data->delete();
        DB::commit();
        $response = response()->json([
          'status' => 'success',
          'message' => 'Data berhasil dihapus'
        ]);
      }
    } catch (\Throwable $throw) {
      Log::error($throw);
      $response = response()->json(['error' => $throw->getMessage()]);
    }
    return $response;
  }

  public function select2(Request $request)
  {
    $page = $request->page;
    $resultCount = 10;
    $offset = ($page - 1) * $resultCount;
    $data = Bank::where('name', 'LIKE', '%' . $request->q . '%')
      ->orderBy('name')
      ->skip($offset)
      ->take($resultCount)
      ->selectRaw('id, name as text')
      ->get();

    $count = Bank::where('name', 'LIKE', '%' . $request->q . '%')
      ->get()
      ->count();

    $endCount = $offset + $resultCount;
    $morePages = $count > $endCount;

    $results = array(
      "results" => $data,
      "pagination" => array(
        "more" => $morePages
      )
    );

    return response()->json($results);
  }


}
