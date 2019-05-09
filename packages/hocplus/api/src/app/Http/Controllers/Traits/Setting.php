<?php

namespace Hocplus\Api\App\Http\Controllers\Traits;

use Adtech\Core\App\Models\Setting as SettingModel;
use Validator;
use Cache;

trait Setting
{
    public function getConfig()
    {
        //get cache
        $domain_id= 16;
        $cache_data = 'data_api_settings_config_' . $domain_id;
        Cache::forget($cache_data);
        if (Cache::has($cache_data)) {
            $data = Cache::get($cache_data);
        } else {
            $settings = SettingModel::where('domain_id', $domain_id)->get();
            $settingView = array('logo' => '', 'slogan' => '', 'hello_txt' => '');
            if (count($settings) > 0) {
                foreach ($settings as $setting) {
                    switch ($setting->name) {
                        case 'logo':
                            $settingView['logo'] = $setting->value;
                            break;
                        case 'slogan':
                            $settingView['slogan'] = $setting->value;
                            break;
                    }
                }
            }
            $data = '{
                    "data": {
                        "config": {
                            "logo": "' . $settingView['logo'] . '",
                            "slogan": "' . $settingView['slogan'] . '",
                            "color": {
                                "colorPrimary": "#c20375",
                                "colorPrimaryDark": "#c20375",
                                "colorText": "#c20375",
                                "backgroundColor": "#c20375"
                            },
                            "position_menu": "left",
                            "welcome_screen": [{
                                    "title": "",
                                    "image": "https://i.imgur.com/pbldh77.png"
                                },
                                {
                                    "title": "HÆ¯á»šNG DáºªN THI",
                                    "image": "https://i.imgur.com/SWBhudp.png"
                                },
                                {
                                    "title": "HÆ¯á»šNG DáºªN THI",
                                    "image": "https://i.imgur.com/ZhlJOA5.png"
                                }]
                        }
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