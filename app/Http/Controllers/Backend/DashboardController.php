<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\UploadFileDocument;
use App\Models\User;

class DashboardController extends Controller
{
  public function index()
  {
    $config['title'] = "Dashboard";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Dashboard"],
    ];

    $user = User::count();
    $jalin = UploadFileDocument::whereJenisFile('jalin')->count();
    $core = UploadFileDocument::whereJenisFile('core')->count();
    $bank = Bank::count();

    $data = [
      'user_count' => $user,
      'jalin_count' => $jalin,
      'core_count' => $core,
      'bank_count' => $bank,
    ];

    return view('pages.index', compact('config', 'data'));
  }
}
