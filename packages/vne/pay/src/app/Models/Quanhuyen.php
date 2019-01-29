<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Quanhuyen extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devvn_quanhuyen';

    protected $primaryKey = 'maqh';
                
    public $timestamps = false;

    public static function getAllData($matp = null){
        $query = Quanhuyen::orderBy('maqh', 'asc');
        if(!empty($matp)){
            $query->where('matp', $matp);
        }
        $quanHuyen = $query->get();       
        return $quanHuyen;
    }
}
