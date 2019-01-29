<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Thanhpho extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devvn_tinhthanhpho';

    protected $primaryKey = 'matp';
                
    public $timestamps = false;

    public static function getAllData(){
        $key = 'hocplus_city';        
        if(Cache::has($key)){            
            return Cache::get($key);
        } else {
            $city = Thanhpho::get();
            Cache::forever($key, $city);
            return $city;
        }
    }
}
