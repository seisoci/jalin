<?php

namespace App\Classes\Theme;

use App\Models\Permissions\MenuManager;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class Menu
{

  public static function sidebar()
  {
    $menuManager = new MenuManager();
    $roleId = isset(Auth::user()->role_id) ? Auth::user()->role_id : NULL;
    $menu_list = $menuManager->get_menu_role((isset(Auth::user()->role_id) ? Auth::user()->role_id : 0));
    $roots = [];
    foreach ($menu_list as $v) :
      $v->parent_id == 0 ? array_push($roots, $v->id) : array_push($roots, $v->parent_id);
    endforeach;
    $roots = array_unique($roots);
    $roots = MenuManager::whereIn('id', $roots)
      ->orderBy('sort', 'asc')
      ->get();
    Log::error($roleId);
    return self::tree($roots, $menu_list, $roleId);
  }

  public static function tree($roots, $menu_list, $roleId, $parentId = 0, $endChild = 0)
  {
    $html = '';
    foreach ($roots as $v):
      if ($v->type == 'module') {
        $html .= '<li class="nav-item">
                     <a class="nav-link ' . ($v->path_url == request()->getPathInfo() ? 'active' : '') . '" href="' . $v->path_url . '" role="button" aria-expanded="false"
                        aria-controls="utilities-error">
                        <i class="icon ' . ($v->icon ?? '') . '">
                        </i>
                        <span class="item-name">' . $v->title . '</span>
                     </a></li>
               ';
      } elseif ($v->type == 'static') {
        $html .= '<li class="nav-item">
                     <a class="nav-link" data-bs-toggle="collapse" href="#' . Str::slug($v->title) . '" role="button" aria-expanded="false"
                        aria-controls="utilities-error">
                        <i class="icon ' . ($v->icon ?? '') . '">
                        </i>
                        <span class="item-name">' . $v->title . '</span>
                           </svg>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </i>
                     </a>
                     <ul class="sub-nav collapse" id="' . Str::slug($v->title) . '" data-bs-parent="#sidebar">
               ';

        $list_menu = $menu_list->where('parent_id', $v->id)->sortBy('sort');

        foreach ($list_menu as $item):
          $icon = isset($item->icon) ? '<i class="' . $item->icon . '"></i>' : '<i class="icon">
                      <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                          </g>
                      </svg>
                    </i>';
          $html .= '
            <li class="nav-item ' . ($item->path_url == request()->getPathInfo() ? 'active' : '') . ' ">
                <a class="nav-link ' . ($item->path_url == request()->getPathInfo() ? 'active' : '') . '"
                    href="' . URL::to($item->path_url) . '">
                    ' . $icon . '
                    <i class="sidenav-mini-icon"> H </i>
                    <span class="item-name">' . $item->title . '</span>
                </a>
            </li>
          ';
        endforeach;
        $html .= '</ul></li>';
      } elseif ($v->type == 'header') {
        $html .= '<li class="nav-item static-item">
                            <a class="nav-link static-item disabled text-start" href="#" tabindex="-1">
                                <span class="default-icon">' . $v->title . '</span>
                                <span class="mini-icon" data-bs-toggle="tooltip" data-bs-placement="right">-</span>
                            </a>
                        </li>
               ';
      } else {
        $html .= '<li><hr class="hr-horizontal"></li>';
      }
    endforeach;
    return $html;
  }

  public static function header_sidebar()
  {
    $menuManager = new MenuManager();
    $roleId = isset(Auth::user()->role_id) ? Auth::user()->role_id : NULL;
    $menu_list = $menuManager->get_menu_role((isset(Auth::user()->role_id) ? Auth::user()->role_id : 0));
    $roots = [];
    foreach ($menu_list as $v) :
      $v->parent_id == 0 ? array_push($roots, $v->id) : array_push($roots, $v->parent_id);
    endforeach;
    $roots = array_unique($roots);
    $roots = MenuManager::whereIn('id', $roots)
      ->orderBy('sort', 'asc')
      ->get();
    return self::tree_header($roots, $menu_list, $roleId);
  }

  public static function tree_header($roots, $menu_list, $roleId, $parentId = 0, $endChild = 0)
  {
    $html = '';
    foreach ($roots as $v):
      if ($v->type == 'module') {
        $html .= '<li class="nav-item">
                     <a class="nav-link ' . ($v->path_url == request()->getPathInfo() ? 'active' : '') . '" href="' . $v->path_url . '" role="button" aria-expanded="false"
                        aria-controls="utilities-error">
                        <i class="icon ' . ($v->icon ?? '') . '">
                        </i>
                        <span class="item-name">' . $v->title . '</span>
                     </a></li>
               ';
      } elseif ($v->type == 'static') {
        $list_menu = $menu_list->where('parent_id', $v->id)->sortBy('sort');
        $html .= '<li class="nav-item '.(self::activeMenu($list_menu) ? 'active' : '').'">
                     <a class="nav-link" data-bs-toggle="collapse" href="#' . Str::slug($v->title) . '" role="button" aria-expanded="false"
                        aria-controls="utilities-error">
                        <i class="icon ' . ($v->icon ?? '') . '">
                        </i>
                        <span class="item-name">' . $v->title . '</span>
                           </svg>
                     </a>
                     <ul class="iq-header-sub-menu list-unstyled collapse" id="' . Str::slug($v->title) . '" data-bs-parent="#sidebar">
               ';

        $list_menu = $menu_list->where('parent_id', $v->id)->sortBy('sort');

        foreach ($list_menu as $item):
          $icon = isset($item->icon) ? '<i class="' . $item->icon . '"></i>' : '<i class="icon">
                      <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <g>
                          <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                          </g>
                      </svg>
                    </i>';
          $html .= '
            <li class="nav-item ' . ($item->path_url == request()->getPathInfo() ? 'active' : '') . ' ">
                <a class="nav-link ' . ($item->path_url == request()->getPathInfo() ? 'active' : '') . '"
                    href="' . URL::to($item->path_url) . '">
                    <span class="item-name">' . $item->title . '</span>
                </a>
            </li>
          ';
        endforeach;
        $html .= '</ul></li>';
      } elseif ($v->type == 'header') {
        $html .= '<li class="nav-item static-item">
                            <a class="nav-link static-item disabled text-start" href="#" tabindex="-1">
                                <span class="default-icon">' . $v->title . '</span>
                                <span class="mini-icon" data-bs-toggle="tooltip" data-bs-placement="right">-</span>
                            </a>
                        </li>
               ';
      } else {
        $html .= '<li><hr class="hr-horizontal"></li>';
      }
    endforeach;
    return $html;
  }

  public static function settings()
  {
    $settings = Setting::all();
    $collection = $settings->mapWithKeys(function ($item, $key) {
      return [$item['name'] => $item['value']];
    })->toArray();
    return (object)$collection;
  }

  private static function activeMenu($list_menu)
  {
    $active = FALSE;
    foreach ($list_menu ?? [] as $item):
      $active = request()->segment(2) == str_replace('/backend/', '', (!$item->path_url ? '' : $item->path_url)) ? TRUE : FALSE;
      if($active){
        break;
      }
    endforeach;
    return $active;
  }

}
