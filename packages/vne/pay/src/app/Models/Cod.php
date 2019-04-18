<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cod extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_cod';

    protected $primaryKey = 'cod_id';

    protected $fillable = ['name', 'phone', 'address', 'city', 'district', 'wards', 'status', 'order_code', 'manage_id', 'type'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
   
}
