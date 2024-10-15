<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;

class ThemeController extends Controller
{
  public function index()
  {
    $config['title'] = "Theme";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Theme"]
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('themes.store')
    ];

    $data = AppSetting::where('user_id', auth()->id())->firstOrFail();

    return view('pages.backend.themes.form', compact('config', 'data'));
  }
}
