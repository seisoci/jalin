<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Core;
use App\Models\JalinHarian;
use App\Models\RekapBruto;
use App\Models\RekapNetto;
use App\Traits\Helper;
use App\Traits\ResponseStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapNettoController extends Controller
{
  use Helper, ResponseStatus;

  public function __construct()
  {
    $this->middleware('can:rekap-netto-list', ['only' => ['index', 'show']]);
    $this->middleware('can:rekap-netto-create', ['only' => ['create', 'store']]);
    $this->middleware('can:rekap-netto-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:rekap-netto-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Perbandingan Netto";
    $page_breadcrumbs = [
      ['url' => '#', 'title' => "Perbandingan Netto"],
    ];

    if ($request->ajax()) {
      $dataRekapNetto = RekapNetto::with('jalin', 'rekap_bruto.core')
        ->where('tgl_rekap', $request['tgl'])
        ->get();

      $dataRekapSum = RekapNetto::selectRaw('
            SUM(`jalin_harian`.`nom_transaksi`) AS `jalin_sum_amount`,
            SUM(`cores`.`nilai_transaksi`) AS `core_sum_amount`
        ')
        ->leftJoin('jalin_harian', 'jalin_harian.id', '=', 'rekap_nettos.jalin_harian_id')
        ->leftJoin('rekap_brutos', 'rekap_brutos.id', '=', 'rekap_nettos.rekap_bruto_id')
        ->leftJoin('cores', 'cores.id', '=', 'rekap_brutos.core_id')
        ->where('rekap_nettos.tgl_rekap', $request['tgl'])
        ->first();

      $data = [
        'status' => 'success',
        'message' => 'Data berhasil disimpan',
        'data' => $this->toHtmlNetto($dataRekapNetto, $dataRekapSum)
      ];

      return response()->json($data);
    }

    return view('pages.backend.rekon.rekap-netto.index', compact('config', 'page_breadcrumbs'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tgl' => 'required|date:Y-m-d',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        RekapNetto::where('tgl_rekap', $request['tgl'])->delete();

        self::deleteRekapNetto($request['tgl']);

        $jalin = JalinHarian::selectRaw('
           `id`,
           `tgl`,
           `trx_tgl`,
           `no_kartu` AS `no_card`,
           `kode_terminal` AS `terminal_code`,
           `nom_transaksi` AS `amount`
          ')
          ->where('kode_report', "56D")
          ->where(function ($q) use ($request) {
            $q->whereDate('tgl', $request['tgl']);
            $q->orWhere('rekap_netto', 'hold');
          })
          ->orderBy('trx_tgl')
          ->orderBy('no_kartu')
          ->orderBy('nom_transaksi')
          ->get()
          ->toArray();

        $core = RekapBruto::selectRaw('
           `rekap_brutos`.`id`,
           `rekap_brutos`.`tgl_rekap` AS `tgl`,
           `cores`.`trx_tgl`,
           `cores`.`no_kartu` AS `no_card`,
           `cores`.`terminal` AS `terminal_code`,
           `cores`.`nilai_transaksi` AS `amount`
          ')
          ->leftJoin('cores', 'cores.id', '=', 'rekap_brutos.core_id')
          ->where(function ($q) use ($request) {
            $q->whereDate('rekap_brutos.tgl_rekap', $request['tgl']);
            $q->orWhere('rekap_brutos.rekap_netto', 'hold');
          })
          ->orderBy('cores.trx_tgl')
          ->orderBy('cores.no_kartu')
          ->orderBy('cores.nilai_transaksi')
          ->get()
          ->toArray();

        $dataMatching = $this->matching($jalin, $core);
        foreach ($dataMatching['jalin_same'] ?? [] as $key => $item):
          RekapNetto::create([
            'tgl_rekap' => $request['tgl'],
            'rekap_bruto_id' => $dataMatching['core_same'][$key]['id'],
            'jalin_harian_id' => $item['id']
          ]);
          JalinHarian::find($item['id'])->update(['rekap_netto' => 'clear']);
        endforeach;

        foreach ($dataMatching['core_same'] ?? [] as $item):
          RekapBruto::find($item['id'])->update(['rekap_netto' => 'clear']);
        endforeach;

        foreach ($dataMatching['jalin_diff'] ?? [] as $item):
          JalinHarian::find($item['id'])->update(['rekap_netto' => 'hold']);
        endforeach;

        foreach ($dataMatching['core_diff'] ?? [] as $item):
          RekapBruto::find($item['id'])->update(['rekap_netto' => 'hold']);
        endforeach;

        JalinHarian::where([
          ['tgl', $request['tgl']],
          ['rekap_netto', $request['normal']],
        ])->update(['rekap_netto' => 'hold']);

        $dataRekapNetto = RekapNetto::with('rekap_bruto.core', 'jalin')
          ->where('tgl_rekap', $request['tgl'])
          ->get();

        $dataRekapSum = RekapNetto::selectRaw('
            SUM(`jalin_harian`.`nom_transaksi`) AS `jalin_sum_amount`,
            SUM(`cores`.`nilai_transaksi`) AS `core_sum_amount`
        ')
          ->leftJoin('jalin_harian', 'jalin_harian.id', '=', 'rekap_nettos.jalin_harian_id')
          ->leftJoin('rekap_brutos', 'rekap_brutos.id', '=', 'rekap_nettos.rekap_bruto_id')
          ->leftJoin('cores', 'cores.id', '=', 'rekap_brutos.core_id')
          ->where('rekap_nettos.tgl_rekap', $request['tgl'])
          ->first();

        $data = [
          'status' => 'success',
          'message' => 'Data berhasil disimpan',
          'data' => $this->toHtmlNetto($dataRekapNetto, $dataRekapSum)
        ];
        DB::commit();
        $response = response()->json($data);
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

    $data = RekapNetto::where('tgl_rekap', $id);
    self::deleteRekapNetto($id);

    DB::beginTransaction();
    try {
      if ($data) {
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

  public function export(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'tgl' => 'required|date:Y-m-d',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()
          ->setPaperSize(PageSetup::PAPERSIZE_A4)
          ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        $bodyLeftRight = [
          'borders' => [
            'right' => [
              'borderStyle' => Border::BORDER_THIN,
            ],
            'left' => [
              'borderStyle' => Border::BORDER_THIN,
            ],
          ],
        ];

        $bodyStyle = [
          'borders' => [
            'outline' => [
              'borderStyle' => Border::BORDER_THIN,
            ],
          ],
        ];

        $styleArray = [
          'font' => [
            'bold' => true,
            'size' => 11,
            'name' => 'Arial'
          ]];


        $headerTitleMerge = 'PERBANDINGAN DATA NETTO Tgl Rekap: ' . Carbon::parse($request['tgl'])->isoFormat('DD MMMM YYYY');
        $headerTitle = ['No.', 'Tgl Trx', 'ACQ', 'No Kartu', 'Terminal', 'Nominal', 'Tgl Trx', 'ACQ', 'No Kartu', 'Terminal', 'Nominal'];

        $headerStart = 'A';
        $sheet->setCellValue("{$headerStart}2", $headerTitleMerge);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A2")->applyFromArray($styleArray);
        $sheet->getStyle("A3:K3")->applyFromArray($styleArray);
        $sheet->getStyle("A2:K2")->applyFromArray($bodyStyle);
        $sheet->mergeCells("A2:K2");

        foreach ($headerTitle as $key => $item):
          $sheet->setCellValue("{$headerStart}3", $item);
          $key != (count($headerTitle) - 1) ? $headerStart++ : '';
        endforeach;

        $data = RekapNetto::with('jalin', 'rekap_bruto.core')
          ->where('tgl_rekap', $request['tgl'])
          ->get();

        $idx = 3;
        $no = 1;
        foreach ($data ?? [] as $item):
          $sheet->getStyle("A{$idx}:K{$idx}")->applyFromArray($bodyLeftRight);
          $idx++;
          $sheet->setCellValue('A' . $idx, $no++);
          $sheet->getStyle('A' . $idx)->getAlignment()->setHorizontal('center');
          $sheet->setCellValue('B' . $idx, $item['rekap_bruto']['core']['trx_tgl']);
          $sheet->setCellValueExplicit('C' . $idx, $item['rekap_bruto']['core']['acq'], DataType::TYPE_STRING);
          $sheet->setCellValueExplicit('D' . $idx, $item['rekap_bruto']['core']['no_kartu'], DataType::TYPE_STRING);
          $sheet->setCellValueExplicit('E' . $idx, $item['rekap_bruto']['core']['terminal'], DataType::TYPE_STRING);
          $sheet->setCellValue('F' . $idx, $item['rekap_bruto']['core']['nilai_transaksi']);
          $sheet->getStyle("F{$idx}")->getNumberFormat()->setFormatCode('#,##0');
          $sheet->setCellValue('G' . $idx, $item['jalin']['trx_tgl']);
          $sheet->setCellValueExplicit('H' . $idx, $item['jalin']['kode_bank_acq'], DataType::TYPE_STRING);
          $sheet->setCellValueExplicit('I' . $idx, $item['jalin']['no_kartu'], DataType::TYPE_STRING);
          $sheet->setCellValueExplicit('J' . $idx, $item['jalin']['kode_terminal'], DataType::TYPE_STRING);
          $sheet->setCellValue('K' . $idx, $item['jalin']['nom_transaksi']);
          $sheet->getStyle("K{$idx}")->getNumberFormat()->setFormatCode('#,##0');
        endforeach;

        $sheet->getStyle("A{$idx}:K{$idx}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
        $idx++;
        $idxLast = $idx - 1;
        $sheet->mergeCells("A{$idx}:B{$idx}");
        $sheet->getStyle("A{$idx}:K{$idx}")->applyFromArray($styleArray);
        $sheet->setCellValue("E{$idx}", "Total");
        $sheet->setCellValue("F{$idx}", "=SUM(F4:F{$idxLast})");
        $sheet->setCellValue("J{$idx}", "Total");
        $sheet->setCellValue("K{$idx}", "=SUM(K4:K{$idxLast})");
        $sheet->getStyle("F{$idx}")->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("K{$idx}")->getNumberFormat()->setFormatCode('#,##0');

        foreach ($sheet->getColumnIterator() as $column) {
          $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $headerTitleMerge . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();

      } catch (\Throwable $throw) {
        Log::error($throw);
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

}
