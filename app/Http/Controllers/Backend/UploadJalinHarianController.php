<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConfigFileDetail;
use App\Models\JalinHarian;
use App\Models\UploadFileDocument;
use App\Traits\Helper;
use App\Traits\ResponseStatus;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadJalinHarianController extends Controller
{
  use Helper, ResponseStatus;

  public function __construct()
  {
    $this->middleware('can:upload-jalin-harian-list', ['only' => ['index', 'show']]);
    $this->middleware('can:upload-jalin-harian-create', ['only' => ['create', 'store']]);
    $this->middleware('can:upload-jalin-harian-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:upload-jalin-harian-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Upload File Harian Jalin";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Upload File Harian Jalin"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('upload-jalin-harian.store')
    ];

    if ($request->ajax()) {
      $data = UploadFileDocument::where([
        ['jenis_file', 'jalin'],
        ['jenis_laporan', 'jalin_harian'],
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

    return view('pages.backend.upload-files.jalin-harian.index', compact('config', 'page_breadcrumbs'));
  }

  public function store(Request $request)
  {

    $configFile = ConfigFileDetail::orderBy('code_trans')->orderBy('sort')->get();
    foreach ($configFile as $item):
      $configFileMap[$item['code_trans']][$item['field_name']] = [
        'start_at' => $item['start_at'],
        'length' => $item['length']
      ];
    endforeach;

    $validator = Validator::make($request->all(), [
      'tgl' => 'required|date:d M Y',
      'file_raw' => 'required|mimes:txt,text',
    ]);

    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        $file = File::get($request['file_raw']);
        if (Storage::disk('public')->exists("template/jalin/harian/" . $request['file_raw']->getClientOriginalName())) {
          return response()->json($this->responseStore(false, '', 'File Sudah Ada'));
        }

        Storage::disk('public')->putFileAs("template/jalin/harian/", $request['file_raw'], $request['file_raw']->getClientOriginalName());
        $lines = explode("\n", $file);
        $dataRekap = [];
        $kodeReport = NULL;

        $uploadFileDocument = UploadFileDocument::create([
          'name' => $request['file_raw']->getClientOriginalName(),
          'location' => 'template/jalin/harian/' . $request['file_raw']->getClientOriginalName(),
          'jenis_file' => 'jalin',
          'jenis_laporan' => 'jalin_harian',
          'tgl_dokumen' => $request['tgl'],
        ]);

        foreach ($lines as $item):
          if (trim(substr($item, 0, 11)) == "KODE REPORT" && str_contains(trim(substr($item, 14, 4)), '54') || str_contains(trim(substr($item, 14, 4)), '56')) {
            $kodeReport = trim(substr($item, 14, 4));
          } elseif (!$kodeReport) {
            continue;
          }

          if (is_numeric(trim(substr($item, 0, 6)))) {
            $dataRekap [] = [
              'upload_file_document_id' => $uploadFileDocument['id'],
              'tgl' => $request['tgl'],
              'kode_report' => $kodeReport,
              'trx_time' => $this->wordwrap_trim($item, $configFileMap[$kodeReport]['trx_time']['start_at'], $configFileMap[$kodeReport]['trx_time']['length']),
              'trx_tgl' => $this->trx_tgl($item, $configFileMap[$kodeReport]['trx_tgl']['start_at'], $configFileMap[$kodeReport]['trx_tgl']['length']),
              'kode_terminal' => $this->trim_substr($item, $configFileMap[$kodeReport]['kode_terminal']['start_at'], $configFileMap[$kodeReport]['kode_terminal']['length']),
              'no_kartu' => $this->trim_substr($item, $configFileMap[$kodeReport]['no_kartu']['start_at'], $configFileMap[$kodeReport]['no_kartu']['length']),
              'jenis_message' => $this->trim_substr($item, $configFileMap[$kodeReport]['jenis_message']['start_at'], $configFileMap[$kodeReport]['jenis_message']['length']),
              'kode_proses' => $this->trim_substr($item, $configFileMap[$kodeReport]['kode_proses']['start_at'], $configFileMap[$kodeReport]['kode_proses']['length']),
              'nom_transaksi' => $this->money($item, $configFileMap[$kodeReport]['nom_transaksi']['start_at'], $configFileMap[$kodeReport]['nom_transaksi']['length']),
              'kode_kesalahan' => $this->trim_substr($item, $configFileMap[$kodeReport]['kode_proses']['start_at'], $configFileMap[$kodeReport]['kode_proses']['length']),
              'kode_bank_iss' => str_contains($kodeReport, '54') ? $this->trim_substr($item, $configFileMap[$kodeReport]['kode_bank_iss']['start_at'], $configFileMap[$kodeReport]['kode_bank_iss']['length']) : NULL,
              'kode_bank_acq' => str_contains($kodeReport, '56') ? $this->trim_substr($item, $configFileMap[$kodeReport]['kode_bank_acq']['start_at'], $configFileMap[$kodeReport]['kode_bank_acq']['length']) : NULL,
              'no_ref' => $this->trim_substr($item, $configFileMap[$kodeReport]['no_ref']['start_at'], $configFileMap[$kodeReport]['no_ref']['length']),
              'merchant_type' => $this->trim_substr($item, $configFileMap[$kodeReport]['merchant_type']['start_at'], $configFileMap[$kodeReport]['merchant_type']['length']),
              'kode_retail' => $this->trim_substr($item, $configFileMap[$kodeReport]['kode_retail']['start_at'], $configFileMap[$kodeReport]['kode_retail']['length']),
              'approval' => $this->trim_substr($item, $configFileMap[$kodeReport]['approval']['start_at'], $configFileMap[$kodeReport]['approval']['length']),
              'orig_nom' => $this->trim_substr($item, $configFileMap[$kodeReport]['orig_nom']['start_at'], $configFileMap[$kodeReport]['orig_nom']['length']),
              'fee_iss' => isset($configFileMap[$kodeReport]['fee_iss']) ? $this->money($item, $configFileMap[$kodeReport]['fee_iss']['start_at'], $configFileMap[$kodeReport]['fee_iss']['length']) : NULL,
              'fee_switching' => isset($configFileMap[$kodeReport]['fee_switching']) ? $this->money($item, $configFileMap[$kodeReport]['fee_switching']['start_at'], $configFileMap[$kodeReport]['fee_switching']['length']) : NULL,
              'fee_lbg_svc' => isset($configFileMap[$kodeReport]['fee_lbg_svc']) ? $this->money($item, $configFileMap[$kodeReport]['fee_lbg_svc']['start_at'], $configFileMap[$kodeReport]['fee_lbg_svc']['length']) : NULL,
              'fee_lbg_std' => isset($configFileMap[$kodeReport]['fee_lbg_std']) ? $this->money($item, $configFileMap[$kodeReport]['fee_lbg_std']['start_at'], $configFileMap[$kodeReport]['fee_lbg_std']['length']) : NULL,
              'net_nominal' => isset($configFileMap[$kodeReport]['net_nominal']) ? $this->money($item, $configFileMap[$kodeReport]['net_nominal']['start_at'], $configFileMap[$kodeReport]['net_nominal']['length']) : NULL,
            ];
          }
        endforeach;

        JalinHarian::insert($dataRekap);
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
      $this->deleteRekapBruto($data['tgl_dokumen']);
      $response = response()->json($this->responseDelete(false));
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
