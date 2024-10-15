<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConfigFileDetail;
use App\Models\JalinHarian;
use App\Models\JalinRekap;
use App\Models\UploadFileDocument;
use App\Traits\Helper;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadJalinRekapController extends Controller
{
  use Helper, ResponseStatus;

  public function __construct()
  {
    $this->middleware('can:upload-jalin-rekap-list', ['only' => ['index', 'show']]);
    $this->middleware('can:upload-jalin-rekap-create', ['only' => ['create', 'store']]);
    $this->middleware('can:upload-jalin-rekap-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:upload-jalin-rekap-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Upload File Rekap Jalin";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Daftar Upload File Rekap Jalin"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('upload-jalin-rekap.store')
    ];

    if ($request->ajax()) {
      $data = UploadFileDocument::where([
        ['jenis_file', 'jalin'],
        ['jenis_laporan', 'jalin_rekap'],
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

    return view('pages.backend.upload-files.jalin-rekap.index', compact('config', 'page_breadcrumbs'));
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
        if (Storage::disk('public')->exists("template/jalin/rekap/" . $request['file_raw']->getClientOriginalName())) {
          return response()->json($this->responseStore(false, '', 'File Sudah Ada'));
        }

        Storage::disk('public')->putFileAs("template/jalin/rekap/", $request['file_raw'], $request['file_raw']->getClientOriginalName());
        $lines = explode("\n", $file);
        $dataRekap = [];

        $uploadFileDocument = UploadFileDocument::create([
          'name' => $request['file_raw']->getClientOriginalName(),
          'location' => 'template/jalin/rekap/' . $request['file_raw']->getClientOriginalName(),
          'jenis_file' => 'jalin',
          'jenis_laporan' => 'jalin_rekap',
          'tgl_dokumen' => $request['tgl'],
        ]);

        foreach ($lines as $item):
          $expPipe = explode('|', $item);
          if (isset($expPipe[1]) && is_numeric($expPipe[1])) {
            if (isset($dataRekap[(int)trim($expPipe[1])])) {
              $dataRekap[(int)trim($expPipe[1])] =
                array_merge($dataRekap[(int)trim($expPipe[1])],
                  [
                    'acq_kewajiban_dispute' => $this->convertToDecimal($expPipe[3]),
                    'acq_hak_dispute' => $this->convertToDecimal($expPipe[4]),
                    'iss_kewajiban_dispute' => $this->convertToDecimal($expPipe[5]),
                    'iss_hak_dispute' => $this->convertToDecimal($expPipe[6]),
                    'subtotal_gross_kewajiban_t' => $this->convertToDecimal($expPipe[7]),
                    'subtotal_gross_hak_u' => $this->convertToDecimal($expPipe[8]),
                    'total_gross_kewajiban_v' => $this->convertToDecimal($expPipe[9]),
                    'total_gross_hak_w' => $this->convertToDecimal($expPipe[10]),
                    'total_net_kewajiban' => $this->convertToDecimal($expPipe[11]),
                    'total_net_hak' => $this->convertToDecimal($expPipe[12]),
                  ]);
            } else {
              $dataRekap[(int)trim($expPipe[1])] = [
                'tgl' => $request['tgl'],
                'upload_file_document_id' => $uploadFileDocument['id'],
                'bank_name' => $expPipe[2],
                'acq_jml_trx_purchase' => $this->convertToDecimal($expPipe[3]),
                'acq_acq_switch_purchase' => $this->convertToDecimal($expPipe[4]),
                'acq_iss_switch_purchase' => $this->convertToDecimal($expPipe[5]),
                'acq_iss_purchase' => $this->convertToDecimal($expPipe[6]),
                'acq_lbg_standard_purchase' => $this->convertToDecimal($expPipe[7]),
                'acq_lbg_service_purchase' => $this->convertToDecimal($expPipe[8]),
                'acq_total_fee_purchase' => $this->convertToDecimal($expPipe[9]),
                'acq_total_nominal_transaksi_purchase' => $this->convertToDecimal($expPipe[10]),
                'acq_jml_trx_refund' => $this->convertToDecimal($expPipe[11]),
                'acq_fee_iss_refund' => $this->convertToDecimal($expPipe[12]),
                'acq_total_nominal_transaksi_refund' => $this->convertToDecimal($expPipe[13]),
                'iss_jml_trx_purchase' => $this->convertToDecimal($expPipe[14]),
                'iss_fee_iss_purchase' => $this->convertToDecimal($expPipe[15]),
                'iss_total_nominal_transaksi_purchase' => $this->convertToDecimal($expPipe[16]),
                'iss_jml_trx_refund' => $this->convertToDecimal($expPipe[17]),
                'iss_fee_iss_refund' => $this->convertToDecimal($expPipe[18]),
                'iss_total_nominal_transaksi_refund' => $this->convertToDecimal($expPipe[19]),
                'subtotal_gross_kewajiban' => $this->convertToDecimal($expPipe[20]),
                'subtotal_gross_hak' => $this->convertToDecimal($expPipe[21]),
              ];
            }
          }
        endforeach;
        JalinRekap::insert($dataRekap);
        DB::commit();
        $response = response()->json($this->responseStore(true));
      } catch (\Throwable $throw) {
        Storage::disk('public')->delete('template/jalin/rekap/' . $request['file_raw']->getClientOriginalName());
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
