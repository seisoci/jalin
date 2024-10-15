<?php

namespace App\Traits;

use App\Models\Core;
use App\Models\JalinHarian;
use App\Models\RekapBruto;
use App\Models\RekapNetto;
use Carbon\Carbon;

trait Helper
{
  public function convertToDecimal($numeric = 0)
  {
    return floatval(str_replace(',', '', $numeric));
  }

  public function wordwrap_trim($string, $start, $length)
  {
    return wordwrap(trim(substr($string, $start, $length)), 2, ':', true);
  }


  public function money($string, $start, $length)
  {
    return floatval(str_replace(',', '', trim(substr($string, $start, $length))));
  }

  public function trx_tgl($string, $start, $length)
  {
    $trim = self::trim_substr($string, $start, $length);
    return Carbon::createFromFormat('ymd', $trim)->format('Y-m-d');

  }

  public function trim_substr($string, $start, $length)
  {
    return trim(substr($string, $start, $length));
  }

  public function trx_tgl_core($string, $start, $length)
  {
    $trim = self::trim_substr($string, $start, $length);
    return Carbon::createFromFormat('d/m/Y', $trim)->format('Y-m-d');
  }

  public function matching($array_1, $array_2)
  {
    $arr = [];
    foreach ($array_1 as $row_1) {
      $match = FALSE;
      foreach ($array_2 as $key_2 => $row_2) {
        if ($row_1['no_card'] == $row_2['no_card'] and $row_1['terminal_code'] == $row_2['terminal_code'] and $row_1['amount'] == $row_2['amount']) {
          $arr['jalin_same'][] = $row_1;
          $arr['core_same'][] = $row_2;
          unset($array_2[$key_2]);
          $match = TRUE;
          break;
        }
      }
      if (!$match) {
        $arr['jalin_diff'][] = $row_1;
      }
    }
    $arr['core_diff'] = array_values($array_2);

    return $arr;
  }

  public function deleteRekapBruto($tgl){
    $this->deleteRekapNetto($tgl);
    $data = RekapBruto::where('tgl_rekap', $tgl)->get();
    foreach ($data as $item):
      JalinHarian::find($item['jalin_harian_id'])->update(['rekap_bruto' => 'normal']);
      Core::find($item['core_id'])->update(['rekap_bruto' => 'normal']);
    endforeach;

    JalinHarian::where('tgl', $tgl)->update(['rekap_bruto'=> 'normal']);
    Core::where('tgl', $tgl)->update(['rekap_bruto'=> 'normal']);
  }

  public function deleteRekapNetto($tgl){
    $data = RekapNetto::where('tgl_rekap', $tgl)->get();
    foreach ($data as $item):
      JalinHarian::find($item['jalin_harian_id'])->update(['rekap_netto' => 'normal']);
      RekapBruto::find($item['rekap_bruto_id'])->update(['rekap_netto' => 'normal']);
    endforeach;

    JalinHarian::where('tgl', $tgl)->update(['rekap_bruto'=> 'normal']);
  }

  private function toHtmlBruto($dataRekapBruto = array(), $dataRekapSum)
  {
    $jalin = $core = '';

    $no = 1;
    foreach ($dataRekapBruto as $item):
      $core .= "
         <tr>
           <td>{$no}</td>
           <td>{$item['core']['trx_tgl']}</td>
           <td>{$item['core']['acq']}</td>
           <td>{$item['core']['no_kartu']}</td>
           <td>{$item['core']['terminal']}</td>
           <td class='autoNumeric text-end'>{$item['core']['nilai_transaksi']}</td>
         </tr>
        ";

      $jalin .= "
         <tr>
           <td>{$item['jalin']['trx_tgl']}</td>
           <td>{$item['jalin']['kode_bank_acq']}</td>
           <td>{$item['jalin']['no_kartu']}</td>
           <td>{$item['jalin']['kode_terminal']}</td>
           <td class='autoNumeric text-end'>{$item['jalin']['nom_transaksi']}</td>
         </tr>
        ";
      $no++;
    endforeach;

    $coreFooter = '
       <tr>
         <td class="text-end" colspan="5"><h6>Total</h6></td>
         <td class="text-end"><h6 class="autoNumeric">'.$dataRekapSum['core_sum_amount'].'</h6></td>
       </tr>
    ';

    $jalinFooter = '
       <tr>
         <td class="text-end" colspan="4"><h6>Total</h6></td>
         <td class="text-end"><h6 class="autoNumeric">'.$dataRekapSum['jalin_sum_amount'].'</h6></td>
       </tr>
    ';

    return [
      'core' => $core,
      'jalin' => $jalin,
      'core_footer' => $coreFooter,
      'jalin_footer' => $jalinFooter,
    ];
  }

  private function toHtmlNetto($dataRekapBruto = array(), $dataRekapSum)
  {
    $jalin = $core = '';

    $no = 1;
    foreach ($dataRekapBruto as $item):
      $core .= "
         <tr>
           <td>{$no}</td>
           <td>{$item['rekap_bruto']['core']['trx_tgl']}</td>
           <td>{$item['rekap_bruto']['core']['acq']}</td>
           <td>{$item['rekap_bruto']['core']['no_kartu']}</td>
           <td>{$item['rekap_bruto']['core']['terminal']}</td>
           <td class='autoNumeric text-end'>{$item['rekap_bruto']['core']['nilai_transaksi']}</td>
         </tr>
        ";

      $jalin .= "
         <tr>
           <td>{$item['jalin']['trx_tgl']}</td>
           <td>{$item['jalin']['kode_bank_acq']}</td>
           <td>{$item['jalin']['no_kartu']}</td>
           <td>{$item['jalin']['kode_terminal']}</td>
           <td class='autoNumeric text-end'>{$item['jalin']['nom_transaksi']}</td>
         </tr>
        ";
      $no++;
    endforeach;

    $coreFooter = '
       <tr>
         <td class="text-end" colspan="5"><h6>Total</h6></td>
         <td class="text-end"><h6 class="autoNumeric">'.$dataRekapSum['core_sum_amount'].'</h6></td>
       </tr>
    ';

    $jalinFooter = '
       <tr>
         <td class="text-end" colspan="4"><h6>Total</h6></td>
         <td class="text-end"><h6 class="autoNumeric">'.$dataRekapSum['jalin_sum_amount'].'</h6></td>
       </tr>
    ';

    return [
      'core' => $core,
      'jalin' => $jalin,
      'core_footer' => $coreFooter,
      'jalin_footer' => $jalinFooter,
    ];
  }

}
