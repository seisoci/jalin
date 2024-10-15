<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConfigFileDetail;
use App\Models\Core;
use App\Models\UploadFileDocument;
use App\Traits\Helper;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadCoreController extends Controller
{
  use Helper, ResponseStatus;

  public function __construct()
  {
    $this->middleware('can:upload-core-list', ['only' => ['index', 'show']]);
    $this->middleware('can:upload-core-create', ['only' => ['create', 'store']]);
    $this->middleware('can:upload-core-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:upload-core-delete', ['only' => ['destroy']]);
  }


  public function index(Request $request)
  {
    $config['title'] = "Upload File Core";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Upload File Core"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('upload-core.store')
    ];

    if ($request->ajax()) {
      $data = UploadFileDocument::where([
        ['jenis_file', 'core'],
        ['jenis_laporan', 'core'],
      ]);
      return \DataTables::of($data)
        ->addColumn('action', function ($row) {
          $actionBtn = '<div class="dropdown">
                          <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi <i class="fa-regular fa-down"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item btn-delete" href="#" data-id ="' . $row->id . '" >Hapus</a></li>
                          </ul>
                        </div> ';
          return $actionBtn;
        })
        ->make(true);
    }

    return view('pages.backend.upload-files.core.index', compact('config', 'page_breadcrumbs'));
  }

  public function store(Request $request)
  {

    $configFile = ConfigFileDetail::where('code_trans', 'Core')
      ->orderBy('sort')
      ->get();

    foreach ($configFile as $item):
      $configFileMap[$item['field_name']] = [
        'start_at' => $item['start_at'],
        'length' => $item['length']
      ];
    endforeach;

    $validator = Validator::make($request->all(), [
      'tgl' => 'required|date:d M Y',
//      'file_raw' => 'required|mimes:txt,text',
    ]);

    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        $file = \File::get($request['file_raw']);
//        if (Storage::disk('public')->exists("template/core/" . $request['file_raw']->getClientOriginalName())) {
//          return response()->json($this->responseStore(false, '', 'File Sudah Ada'));
//        }
//
//        Storage::disk('public')->putFileAs("template/core/", $request['file_raw'], $request['file_raw']->getClientOriginalName());
        $lines = explode("\n", $file);
//        $dataRekap = [];
//        $kodeReport = NULL;

        $uploadFileDocument = UploadFileDocument::create([
          'name' => $request['file_raw']->getClientOriginalName(),
          'location' => 'template/core/' . $request['file_raw']->getClientOriginalName(),
          'jenis_file' => 'core',
          'jenis_laporan' => 'core',
          'tgl_dokumen' => $request['tgl'],
        ]);

        foreach ($lines as $item):
          if (is_numeric($this->trim_substr($item, $configFileMap['cabang']['start_at'], $configFileMap['cabang']['length']))) {
            $dataRekap [] = [
              'upload_file_document_id' => $uploadFileDocument['id'],
              'tgl' => $request['tgl'],
              'cabang' => $this->trim_substr($item, $configFileMap['cabang']['start_at'], $configFileMap['cabang']['length']),
              'acq' => $this->trim_substr($item, $configFileMap['acq']['start_at'], $configFileMap['acq']['length']),
              'iss' => $this->trim_substr($item, $configFileMap['iss']['start_at'], $configFileMap['iss']['length']),
              'destination' => $this->trim_substr($item, $configFileMap['destination']['start_at'], $configFileMap['destination']['length']),
              'terminal' => $this->trim_substr($item, $configFileMap['terminal']['start_at'], $configFileMap['terminal']['length']),
              'produk' => $this->trim_substr($item, $configFileMap['produk']['start_at'], $configFileMap['produk']['length']),
              'io' => $this->trim_substr($item, $configFileMap['io']['start_at'], $configFileMap['io']['length']),
              'msg' => $this->trim_substr($item, $configFileMap['msg']['start_at'], $configFileMap['msg']['length']),
              'proses' => $this->trim_substr($item, $configFileMap['proses']['start_at'], $configFileMap['proses']['length']),
              'trx_tgl' => $this->trx_tgl_core($item, $configFileMap['trx_tgl']['start_at'], $configFileMap['trx_tgl']['length']),
              'no_kartu' => $this->trim_substr($item, $configFileMap['no_kartu']['start_at'], $configFileMap['no_kartu']['length']),
              'no_rek_db' => $this->trim_substr($item, $configFileMap['no_rek_db']['start_at'], $configFileMap['no_rek_db']['length']),
              'no_rek_cr' => $this->trim_substr($item, $configFileMap['no_rek_cr']['start_at'], $configFileMap['no_rek_cr']['length']),
              'nilai_transaksi' => $this->money($item, $configFileMap['nilai_transaksi']['start_at'], $configFileMap['nilai_transaksi']['length']),
              'nilai_replace_rev' => $this->money($item, $configFileMap['nilai_replace_rev']['start_at'], $configFileMap['nilai_replace_rev']['length']),
              'hist_post' => $this->wordwrap_trim($item, $configFileMap['hist_post']['start_at'], $configFileMap['hist_post']['length']),
              'rec_num' => $this->money($item, $configFileMap['rec_num']['start_at'], $configFileMap['rec_num']['length']),
            ];
          }
        endforeach;

        Core::insert($dataRekap);
        DB::commit();
        $response = response()->json($this->responseStore(true));
      } catch (\Throwable $throw) {
        Storage::disk('public')->delete('template/jalin/harian/' . $request['file_raw']->getClientOriginalName());
        Log::error($throw);
        DB::rollBack();
        $response = response()->json($this->responseStore(false));
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function destroy($id)
  {
    try {
      $data = UploadFileDocument::find($id);
      $response = response()->json($this->responseDelete(false));
      $this->deleteRekapBruto($data['tgl_dokumen']);
      if ($data->delete()) {
        Storage::disk('public')->delete($data['location']);
        $response = response()->json($this->responseDelete(true));
      }
    } catch (\Throwable $throw) {
      Log::error($throw);
      DB::rollBack();
      $response = response()->json($this->responseStore(false));
    }
    return $response;
  }
}
