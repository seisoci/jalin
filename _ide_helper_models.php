<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AppSetting
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $name
 * @property mixed $value
 * @property int $status
 * @property int $is_global
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting active($value = true)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting setting(string $name, bool $global = false)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereIsGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppSetting whereValue($value)
 */
	class IdeHelperAppSetting {}
}

namespace App\Models{
/**
 * App\Models\Bank
 *
 * @property string $kode_bank
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereKodeBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereName($value)
 */
	class IdeHelperBank {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel owner()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel ownerEloquent()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel ownership()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel ownershipStok()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 */
	class IdeHelperBaseModel {}
}

namespace App\Models{
/**
 * App\Models\ConfigFile
 *
 * @property string $code_trans
 * @property string $file_name
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFile whereCodeTrans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFile whereFileName($value)
 */
	class IdeHelperConfigFile {}
}

namespace App\Models{
/**
 * App\Models\ConfigFileDetail
 *
 * @property int $id
 * @property string $code_trans
 * @property int $sort
 * @property string $field_name
 * @property string $name
 * @property string $start_at
 * @property string $length
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail whereCodeTrans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConfigFileDetail whereStartAt($value)
 */
	class IdeHelperConfigFileDetail {}
}

namespace App\Models{
/**
 * App\Models\Core
 *
 * @property int $id
 * @property int $upload_file_document_id
 * @property string $tgl
 * @property string $cabang
 * @property string $acq
 * @property string $iss
 * @property string|null $destination
 * @property string|null $terminal
 * @property string|null $produk
 * @property string|null $io
 * @property string|null $msg
 * @property string|null $proses
 * @property string|null $trx_tgl
 * @property string|null $no_kartu
 * @property string|null $no_rek_db
 * @property string|null $no_rek_cr
 * @property string $nilai_transaksi
 * @property string|null $nilai_replace_rev
 * @property string|null $hist_post
 * @property string|null $rec_num
 * @property string|null $rekap_bruto
 * @property string|null $rekap_netto
 * @method static \Illuminate\Database\Eloquent\Builder|Core newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Core newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Core query()
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereAcq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereCabang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereHistPost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereIo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereIss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereNilaiReplaceRev($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereNilaiTransaksi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereNoKartu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereNoRekCr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereNoRekDb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereProduk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereProses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereRecNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereRekapBruto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereRekapNetto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereTerminal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereTgl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereTrxTgl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Core whereUploadFileDocumentId($value)
 */
	class IdeHelperCore {}
}

namespace App\Models{
/**
 * App\Models\JalinHarian
 *
 * @property int $id
 * @property int $upload_file_document_id
 * @property string $tgl
 * @property string $kode_report
 * @property string $trx_time
 * @property string $trx_tgl
 * @property string $kode_terminal
 * @property string $no_kartu
 * @property string $jenis_message
 * @property string $kode_proses
 * @property string $nom_transaksi
 * @property string|null $kode_kesalahan
 * @property string|null $kode_bank_iss
 * @property string|null $kode_bank_acq
 * @property string|null $no_ref
 * @property string|null $merchant_type
 * @property string|null $kode_retail
 * @property string|null $approval
 * @property string|null $orig_nom
 * @property string|null $fee_iss
 * @property string|null $fee_switching
 * @property string|null $fee_lbg_svc
 * @property string|null $fee_lbg_std
 * @property string|null $net_nominal
 * @property string|null $rekap_bruto
 * @property string|null $rekap_netto
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian query()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereApproval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereFeeIss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereFeeLbgStd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereFeeLbgSvc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereFeeSwitching($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereJenisMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereKodeBankAcq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereKodeBankIss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereKodeKesalahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereKodeProses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereKodeReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereKodeRetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereKodeTerminal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereMerchantType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereNetNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereNoKartu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereNoRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereNomTransaksi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereOrigNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereRekapBruto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereRekapNetto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereTgl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereTrxTgl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereTrxTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinHarian whereUploadFileDocumentId($value)
 */
	class IdeHelperJalinHarian {}
}

namespace App\Models{
/**
 * App\Models\JalinKlaim
 *
 * @property int $id
 * @property int $upload_file_document_id
 * @property string $tgl
 * @property string $jenis
 * @property string $no_report
 * @property string $trx_code
 * @property string $trx_tgl
 * @property string $trx_time
 * @property string $ref_no
 * @property string $trace_no
 * @property string $term_id
 * @property string $no_kartu
 * @property string $kode_iss
 * @property string $kode_acq
 * @property string $marchant_id
 * @property string $marchant_location
 * @property string $marchant_name
 * @property string $nominal
 * @property string $marchant_code
 * @property string $dispute_trans_code
 * @property string $registration_num
 * @property string $dispute_amount
 * @property string $charge_back_fee
 * @property string $fee_return
 * @property string $dispute_net_amount
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim query()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereChargeBackFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereDisputeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereDisputeNetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereDisputeTransCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereFeeReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereKodeAcq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereKodeIss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereMarchantCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereMarchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereMarchantLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereMarchantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereNoKartu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereNoReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereRefNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereRegistrationNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereTermId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereTgl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereTraceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereTrxCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereTrxTgl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereTrxTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinKlaim whereUploadFileDocumentId($value)
 */
	class IdeHelperJalinKlaim {}
}

namespace App\Models{
/**
 * App\Models\JalinRekapitulasi
 *
 * @property int $id
 * @property int $upload_file_document_id
 * @property string $tgl
 * @property string $bank_name
 * @property int $acq_jml_trx_purchase
 * @property string $acq_acq_switch_purchase A
 * @property string $acq_iss_switch_purchase B
 * @property string $acq_iss_purchase C
 * @property string $acq_lbg_standard_purchase D
 * @property string $acq_lbg_service_purchase E
 * @property string $acq_total_fee_purchase F
 * @property string $acq_total_nominal_transaksi_purchase G
 * @property string $acq_jml_trx_refund
 * @property string $acq_fee_iss_refund H
 * @property string $acq_total_nominal_transaksi_refund I
 * @property string $iss_jml_trx_purchase
 * @property string $iss_fee_iss_purchase J
 * @property string $iss_total_nominal_transaksi_purchase K
 * @property string $iss_jml_trx_refund
 * @property string $iss_fee_iss_refund L
 * @property string $iss_total_nominal_transaksi_refund M
 * @property string $subtotal_gross_kewajiban N
 * @property string $subtotal_gross_hak O
 * @property string $acq_kewajiban_dispute P
 * @property string $acq_hak_dispute Q
 * @property string $iss_kewajiban_dispute R
 * @property string $iss_hak_dispute S
 * @property string $subtotal_gross_kewajiban_t T
 * @property string $subtotal_gross_hak_u U
 * @property string $total_gross_kewajiban_v V
 * @property string $total_gross_hak_w W
 * @property string $total_net_kewajiban X
 * @property string $total_net_hak Y
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqAcqSwitchPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqFeeIssRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqHakDispute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqIssPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqIssSwitchPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqJmlTrxPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqJmlTrxRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqKewajibanDispute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqLbgServicePurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqLbgStandardPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqTotalFeePurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqTotalNominalTransaksiPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereAcqTotalNominalTransaksiRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssFeeIssPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssFeeIssRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssHakDispute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssJmlTrxPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssJmlTrxRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssKewajibanDispute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssTotalNominalTransaksiPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereIssTotalNominalTransaksiRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereSubtotalGrossHak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereSubtotalGrossHakU($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereSubtotalGrossKewajiban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereSubtotalGrossKewajibanT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereTgl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereTotalGrossHakW($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereTotalGrossKewajibanV($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereTotalNetHak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereTotalNetKewajiban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JalinRekapitulasi whereUploadFileDocumentId($value)
 */
	class IdeHelperJalinRekapitulasi {}
}

namespace App\Models\Permissions{
/**
 * App\Models\Permissions\MenuManager
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $path_url
 * @property string|null $icon
 * @property string $type
 * @property string|null $position
 * @property int $sort
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions\MenuManagerRole[] $menu_manager_role
 * @property-read int|null $menu_manager_role_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions\Permissions[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager wherePathUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManager whereType($value)
 */
	class IdeHelperMenuManager {}
}

namespace App\Models\Permissions{
/**
 * App\Models\Permissions\MenuManagerRole
 *
 * @property int $id
 * @property int $menu_manager_id
 * @property int $role_id
 * @property-read \App\Models\Permissions\MenuManager $menu_manager
 * @property-read \App\Models\Role $roles
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManagerRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManagerRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManagerRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManagerRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManagerRole whereMenuManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuManagerRole whereRoleId($value)
 */
	class IdeHelperMenuManagerRole {}
}

namespace App\Models\Permissions{
/**
 * App\Models\Permissions\PermissionRole
 *
 * @property int $id
 * @property int $permission_id
 * @property int $role_id
 * @property-read \App\Models\Permissions\Permissions $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionRole wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionRole whereRoleId($value)
 */
	class IdeHelperPermissionRole {}
}

namespace App\Models\Permissions{
/**
 * App\Models\Permissions\Permissions
 *
 * @property int $id
 * @property int $menu_manager_id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions\PermissionRole[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereMenuManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereSlug($value)
 */
	class IdeHelperPermissions {}
}

namespace App\Models{
/**
 * App\Models\RekapBruto
 *
 * @property int $id
 * @property string $tgl_rekap
 * @property int $jalin_harian_id
 * @property int $core_id
 * @property-read \App\Models\Core $core
 * @property-read \App\Models\JalinHarian $jalin
 * @method static \Illuminate\Database\Eloquent\Builder|RekapBruto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapBruto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapBruto query()
 * @method static \Illuminate\Database\Eloquent\Builder|RekapBruto whereCoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapBruto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapBruto whereJalinHarianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RekapBruto whereTglRekap($value)
 */
	class IdeHelperRekapBruto {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $dashboard_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions\MenuManagerRole[] $menu_manager
 * @property-read int|null $menu_manager_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permissions\PermissionRole[] $permissions_role
 * @property-read int|null $permissions_role_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDashboardUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSlug($value)
 */
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property string|null $name
 * @property string|null $value
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class IdeHelperSetting {}
}

namespace App\Models{
/**
 * App\Models\Signature
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property string $signature_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Signature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Signature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Signature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereSignatureTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereUpdatedAt($value)
 */
	class IdeHelperSignature {}
}

namespace App\Models{
/**
 * App\Models\UploadFileDocument
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $jenis_file
 * @property string $jenis_laporan
 * @property string $tgl_dokumen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereJenisFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereJenisLaporan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereTglDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadFileDocument whereUpdatedAt($value)
 */
	class IdeHelperUploadFileDocument {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property int|null $role_id
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $active
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AppSetting|null $app_settings
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class IdeHelperUser {}
}

