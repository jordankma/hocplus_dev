<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Xaphuong extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devvn_xaphuongthitran';

    protected $primaryKey = 'xaid';
                
    public $timestamps = false;

    public static function getAllData($maqh = null){
      
        $query = Xaphuong::orderBy('xaid', 'asc');
        if(!empty($maqh)){
            $query->where('maqh', $maqh);
        }
        $xaPhuong = $query->get();       
        return $xaPhuong;
        
    }
}
