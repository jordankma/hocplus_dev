<?php

namespace Hocplus\Api\App\Http\Controllers\Traits;

use Adtech\Core\App\Models\Menu as MenuModel;
use Validator;
use Cache;

trait Menu
{
    public function getMenuLeft()
    {
        //get cache
        $domain_id= 16;
        $cache_data = 'data_api_api_menus_frontend_' . $domain_id;
        Cache::forget($cache_data);
        if (Cache::has($cache_data)) {
            $data = Cache::get($cache_data);
        } else {

            $menus = MenuModel::where('domain_id', $domain_id)
                ->where('type', 1)
                ->where('group', 'Left')
                ->where('parent', 0)
                ->orderBy('sort')->get();

            $list_menus = [];
            $arrTypeData = ['tintuc', 'tailieu'];
            $arrTypeView = ['list', 'detail'];
            if (count($menus) > 0) {
                foreach ($menus as $menu) {

                    $subMenuList = [];
                    $subMenus = MenuModel::where('domain_id', $domain_id)
                        ->where('type', 1)
                        ->where('group', 'Left')
                        ->where('parent', $menu->menu_id)
                        ->orderBy('sort')->get();
                    if (count($subMenus) > 0) {
                        foreach ($subMenus as $sub_menu) {
                            $item = new \stdClass();
                            $item->id = $sub_menu->menu_id;
                            $item->title = base64_encode($sub_menu->name);
                            $item->alias = in_array($sub_menu->typeView, $arrTypeView) ? base64_encode($sub_menu->route_params) : base64_encode($sub_menu->alias);
                            $icon_link = ($sub_menu->icon != '') ? config('site.url_storage') . $sub_menu->icon : '';
                            $item->icon = (self::is_url($sub_menu->icon)) ? $sub_menu->icon : $icon_link;
                            $item->type_view = ($sub_menu->typePage != '#') ? (int) $sub_menu->typePage : '#';
                            $item->type = $sub_menu->typeView;
                            $subMenuList[] = $item;
                        }
                    }

                    $item = new \stdClass();
                    $item->id = $menu->menu_id;
                    $item->title = base64_encode($menu->name);
                    $item->alias = in_array($menu->typeView, $arrTypeView) ? base64_encode($menu->route_params) : base64_encode($menu->alias);
                    $icon_link = ($menu->icon != '') ? config('site.url_storage') . $menu->icon : '';
                    $item->icon = (self::is_url($menu->icon)) ? $menu->icon : $icon_link;
                    $item->type_view = ($menu->typePage != '#') ? (int) $menu->typePage : '#';
                    if (count($subMenuList) > 0) {
                        $item->type = 'category';
                        $item->list_item = $subMenuList;
                    } else {
                        $item->type = 'detail';
                    }
                    $list_menus[] = $item;
                }
            }

            $data = '{
                    "data": {
                        "menu_left": ' . json_encode($list_menus) . '
                    },
                    "success" : true,
                    "message" : "ok!"
                }';
            $data = str_replace('null', '""', $data);

            //put cache
            $expiresAt = now()->addDays(5);
            Cache::put($cache_data, $data, $expiresAt);
        }

        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function getMenuBottom()
    {
        //get cache
        $domain_id= 16;
        $cache_data = 'data_api_api_menus_frontend_bottom_' . $domain_id;
        Cache::forget($cache_data);
        if (Cache::has($cache_data)) {
            $data = Cache::get($cache_data);
        } else {
            $menus = MenuModel::where('domain_id', $domain_id)
                ->where('type', 1)
                ->where('group', 'Bottom')
                ->where('parent', 0)
                ->orderBy('sort')->get();

            $list_menus = [];
            $updated_at = 0;
            $arrTypeData = ['tintuc', 'tailieu'];
            $arrTypeView = ['list', 'detail'];
            if (count($menus) > 0) {
                foreach ($menus as $menu) {
                    $item = new \stdClass();
                    $item->id = $menu->menu_id;
                    $item->title = base64_encode($menu->name);
                    $item->alias = in_array($menu->typeView, $arrTypeView) ? base64_encode($menu->route_params) : base64_encode($menu->alias);
                    $icon_link = ($menu->icon != '') ? config('site.url_storage') . $menu->icon : '';
                    $item->icon = (self::is_url($menu->icon)) ? $menu->icon : $icon_link;
                    $item->type_view = ($menu->typePage != '#') ? (int) $menu->typePage : '#';
                    $list_menus[] = $item;
                }
            }

            $data = '{
                    "data": {
                        "menu_bottom": ' . json_encode($list_menus) . '
                    },
                    "success" : true,
                    "message" : "ok!"
                }';
            $data = str_replace('null', '""', $data);

            //put cache
            $expiresAt = now()->addDays(5);
            Cache::put($cache_data, $data, $expiresAt);
        }

        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }
}