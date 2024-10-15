<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConfigFileDetail;
use App\Models\JalinHarian;
use App\Models\UploadFileDocument;
use App\Traits\Helper;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadJalinKlaimController extends Controller
{
  use Helper, ResponseStatus;

  public function __construct()
  {
    $this->middleware('can:upload-jalin-klaim-list', ['only' => ['index', 'show']]);
    $this->middleware('can:upload-jalin-klaim-create', ['only' => ['create', 'store']]);
    $this->middleware('can:upload-jalin-klaim-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:upload-jalin-klaim-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Upload File Jalin Klaim";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Upload File Jalin Klaim"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('upload-jalin-klaim.store')
    ];

    if ($request->ajax()) {
      $data = UploadFileDocument::where([
        ['jenis_file', 'jalin'],
        ['jenis_laporan', 'jalin_klaim'],
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

    return view('pages.backend.upload-files.jalin-klaim.index', compact('config', 'page_breadcrumbs'));
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
        $file = \File::get($request['file_raw']);
        if (Storage::disk('public')->exists("template/jalin/klaim/" . $request['file_raw']->getClientOriginalName())) {
          return response()->json($this->responseStore(false, '', 'File Sudah Ada'));
        }

        Storage::disk('public')->putFileAs("template/jalin/klaim/", $request['file_raw'], $request['file_raw']->getClientOriginalName());
        $lines = explode("\n", $file);
        $dataRekap = [];
        $kodeReport = NULL;

        $uploadFileDocument = UploadFileDocument::create([
          'name' => $request['file_raw']->getClientOriginalName(),
          'location' => 'template/jalin/klaim/' . $request['file_raw']->getClientOriginalName(),
          'jenis_file' => 'jalin',
          'jenis_laporan' => 'jalin_klaim',
          'tgl_dokumen' => $request['tgl'],
        ]);

        foreach ($lines as $item):
          if (trim(substr($item, 0, 9)) == "No Report") {
            $noReport = trim(substr($item, 13, 8));
          } elseif (!$noReport) {
            continue;
          }

          if (is_numeric(trim(substr($item, 0, 3)))) {
            $jenisReport = match ($noReport) {
              'DSPT01' => 'acq',
              'DSPT02' => 'iss',
            };

            $dataRekap [] = [
              'upload_file_document_id' => $uploadFileDocument['id'],
              'tgl' => $request['tgl'],
              'kode_report' => $kodeReport,
              'trx_code' => $this->wordwrap_trim($item, $configFileMap[$kodeReport]['trx_code']['start_at'], $configFileMap[$kodeReport]['trx_code']['length']),
              'trx_tgl' => $this->trx_tgl($item, $configFileMap[$kodeReport]['trx_tgl']['start_at'], $configFileMap[$kodeReport]['trx_tgl']['length']),
              'trx_time' => $this->wordwrap_trim($item, $configFileMap[$kodeReport]['trx_time']['start_at'], $configFileMap[$kodeReport]['trx_time']['length']),
              'ref_no' => $this->trim_substr($item, $configFileMap[$kodeReport]['ref_no']['start_at'], $configFileMap[$kodeReport]['ref_no']['length']),
              'trace_no' => $this->trim_substr($item, $configFileMap[$kodeReport]['trace_no']['start_at'], $configFileMap[$kodeReport]['trace_no']['length']),
              'term_id' => $this->trim_substr($item, $configFileMap[$kodeReport]['term_id']['start_at'], $configFileMap[$kodeReport]['term_id']['length']),
              'no_kartu' => $this->trim_substr($item, $configFileMap[$kodeReport]['no_kartu']['start_at'], $configFileMap[$kodeReport]['no_kartu']['length']),
              'kode_iss' => $this->trim_substr($item, $configFileMap[$kodeReport]['kode_iss']['start_at'], $configFileMap[$kodeReport]['kode_iss']['length']),
              'kode_acq' => $this->trim_substr($item, $configFileMap[$kodeReport]['kode_acq']['start_at'], $configFileMap[$kodeReport]['kode_acq']['length']),
              'marchant_id' => $this->trim_substr($item, $configFileMap[$kodeReport]['marchant_id']['start_at'], $configFileMap[$kodeReport]['marchant_id']['length']),
              'merchant_type' => $this->trim_substr($item, $configFileMap[$kodeReport]['merchant_type']['start_at'], $configFileMap[$kodeReport]['merchant_type']['length']),
              'marchant_location' => $this->trim_substr($item, $configFileMap[$kodeReport]['marchant_location']['start_at'], $configFileMap[$kodeReport]['marchant_location']['length']),
              'marchant_name' => $this->trim_substr($item, $configFileMap[$kodeReport]['marchant_name']['start_at'], $configFileMap[$kodeReport]['marchant_name']['length']),
              'marchant_code' => $this->trim_substr($item, $configFileMap[$kodeReport]['marchant_code']['start_at'], $configFileMap[$kodeReport]['marchant_code']['length']),
              'dispute_trans_code' => $this->trim_substr($item, $configFileMap[$kodeReport]['dispute_trans_code']['start_at'], $configFileMap[$kodeReport]['dispute_trans_code']['length']),
              'dispute_amount' => $this->money($item, $configFileMap[$kodeReport]['dispute_amount']['start_at'], $configFileMap[$kodeReport]['dispute_amount']['length']),
              'charge_back_fee' => $this->money($item, $configFileMap[$kodeReport]['charge_back_fee']['start_at'], $configFileMap[$kodeReport]['charge_back_fee']['length']),
              'fee_return' => $this->money($item, $configFileMap[$kodeReport]['fee_return']['start_at'], $configFileMap[$kodeReport]['fee_return']['length']),
              'dispute_net_amount' => $this->money($item, $configFileMap[$kodeReport]['dispute_net_amount']['start_at'], $configFileMap[$kodeReport]['dispute_net_amount']['length']),
            ];
          }
        endforeach;

        JalinHarian::insert($dataRekap);
        DB::commit();
        $response = response()->json($this->responseStore(true));
      } catch (\Throwable $throw) {
        Storage::disk('public')->delete('template/jalin/klaim/' . $request['file_raw']->getClientOriginalName());
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
