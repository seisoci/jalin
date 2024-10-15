<?php

use App\Http\Controllers\Backend as Backend;
use Illuminate\Support\Facades\Route;

/* Bank Route */
Route::get('bank/select2', [Backend\BankController::class, 'select2'])->name('bank.select2');
Route::resource('bank', Backend\BankController::class);

/* Signature Route */
Route::get('signature/select2', [Backend\SignatureController::class, 'select2'])->name('bank.select2');
Route::resource('signature', Backend\SignatureController::class);

Route::resource('settings-logo', Backend\SettingController::class);

Route::get('config-file/select2-type', [Backend\ConfigFileController::class, 'select2Type'])->name('config-file.select2-type');
Route::get('config-file/select2', [Backend\ConfigFileController::class, 'select2'])->name('config-file.select2');
Route::get('config-file/{id}/generate', [Backend\ConfigFileController::class, 'generate'])->name('config-file.generate');
Route::resource('config-file', Backend\ConfigFileController::class);

Route::resource('upload-jalin-harian', Backend\UploadJalinHarianController::class);
Route::resource('jalin-harian', Backend\JalinHarianController::class);
Route::resource('jalin-rekap', Backend\JalinRekapController::class);
Route::resource('jalin-klaim', Backend\JalinKlaimController::class);

Route::resource('upload-jalin-klaim', Backend\UploadJalinKlaimController::class);

Route::resource('upload-jalin-rekap', Backend\UploadJalinRekapController::class);

Route::resource('upload-core', Backend\UploadCoreController::class);
Route::resource('core', Backend\CoreController::class);

Route::get('rekap-bruto/export', [Backend\RekapBrutoController::class, 'export'])->name('rekap-bruto.export');
Route::resource('rekap-bruto', Backend\RekapBrutoController::class);

Route::get('rekap-netto/export', [Backend\RekapNettoController::class, 'export'])->name('rekap-bruto.export');
Route::resource('rekap-netto', Backend\RekapNettoController::class);

Route::resource('penampungan-bruto-jalin', Backend\PenampunganBrutoJalinController::class);
Route::resource('penampungan-bruto-core', Backend\PenampunganBrutoCoreController::class);
Route::resource('penampungan-netto-jalin', Backend\PenampunganNettoJalinController::class);
Route::resource('penampungan-netto-rekap', Backend\PenampunganNettoRekapController::class);


