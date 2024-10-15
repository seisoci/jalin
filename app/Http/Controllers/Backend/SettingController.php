<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Prefix;
use App\Models\Setting;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
  use ResponseStatus;

  function __construct()
  {
    $this->middleware('can:settings-logo-list', ['only' => ['index', 'show']]);
    $this->middleware('can:settings-logo-create', ['only' => ['create', 'store']]);
    $this->middleware('can:settings-logo-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:settings-logo-delete', ['only' => ['destroy']]);
  }

  public function index()
  {
    $config['title'] = "Pengaturan";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Pengaturan"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('settings-logo.store')
    ];

    $data = (object)Setting::all()->mapWithKeys(function ($item) {
      return [$item['name'] => $item['value']];
    });

    return view('pages.backend.settings-logo.index', compact('config', 'data'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'image' => 'image|mimes:jpg,png,jpeg|nullable',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $image = NULL;
      $dimensions = [array('200', '200', 'thumbnail')];
      try {
        $logo = Setting::whereName('logo')->first();
        if (!isset($logo)) {
          $logo = Setting::create(['name' => 'logo']);
        }

        if (isset($request['logo']) && !empty($request['logo'])) {
          $image = FileUpload::uploadImage('logo', $dimensions, 'public', $logo['value'], 'logo');
        }

        Setting::updateOrCreate(
          ['name' => 'logo'],
          ['value' => $image]
        );

        DB::commit();
        $response = response()->json($this->responseStore(true, NULL, route('settings-logo.index')));
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

}
