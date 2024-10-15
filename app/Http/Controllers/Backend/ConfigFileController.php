<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConfigFile;
use App\Models\ConfigFileDetail;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ConfigFileController extends Controller
{
  use ResponseStatus;

  function __construct()
  {
    $this->middleware('can:config-file-list', ['only' => ['index', 'show']]);
    $this->middleware('can:config-file-create', ['only' => ['create', 'store']]);
    $this->middleware('can:config-file-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:config-file-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Config File";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Config File"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('config-file.store')
    ];

    return view('pages.backend.config-file.index', compact('config'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'items' => 'required|array',
      'items.*.start_at' => 'required|integer',
      'items.*.length' => 'required|integer',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        foreach ($request['items'] ?? [] as $key => $item):
          ConfigFileDetail::find($key)->update([
            'start_at' => $item['start_at'],
            'length' => $item['length']
          ]);
        endforeach;
        DB::commit();
        $response = response()->json($this->responseStore(true, NULL, route('settings-logo.index')));
      } catch (Throwable $throw) {
        DB::rollBack();
        Log::error($throw);
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;

  }

  public function generate($id)
  {
    $data = ConfigFileDetail::where('code_trans', $id)->get();

    $response = '';
    foreach ($data as $item):
      $response .= "
      <div class='col-12'>
        <div class='row'>
          <div class='col-2'>
            <label class='control-label align-self-center'>{$item['name']}</label>
          </div>
          <div class='col-4'>
            <div class='form-group'>
              <input type='text' class='form-control' name='items[{$item['id']}][start_at]' value='{$item['start_at']}'  placeholder='Baris Mulai'>
            </div>
          </div>
          <div class='col-4'>
            <div class='form-group'>
              <input type='text' class='form-control' name='items[{$item['id']}][length]' value='{$item['length']}' placeholder='Panjang Baris'>
            </div>
          </div>
        </div>
      </div>
      ";
    endforeach;

    return $response;
  }

  public function select2Type(Request $request)
  {
    $page = $request->page;
    $resultCount = 10;
    $offset = ($page - 1) * $resultCount;
    $data = ConfigFile::where('code_trans', 'LIKE', '%' . $request->q . '%')
      ->groupBy('file_name')
      ->orderBy('code_trans')
      ->skip($offset)
      ->take($resultCount)
      ->selectRaw('file_name AS id, file_name as text')
      ->get();

    $count = ConfigFile::where('code_trans', 'LIKE', '%' . $request->q . '%')
      ->groupBy('code_trans')
      ->groupBy('file_name')
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

  public function select2(Request $request)
  {
    $page = $request->page;
    $resultCount = 10;
    $offset = ($page - 1) * $resultCount;
    $data = ConfigFile::where('code_trans', 'LIKE', '%' . $request->q . '%')
      ->where('file_name', $request['file_name'])
      ->groupBy('code_trans')
      ->orderBy('code_trans')
      ->skip($offset)
      ->take($resultCount)
      ->selectRaw('code_trans AS id, code_trans as text')
      ->get();

    $count = ConfigFile::where('code_trans', 'LIKE', '%' . $request->q . '%')
      ->where('file_name', $request['file_name'])
      ->groupBy('code_trans')
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
