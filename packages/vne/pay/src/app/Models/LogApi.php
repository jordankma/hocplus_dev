<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_log_api';

    protected $primaryKey = 'log_id';

    protected $fillable = ['order_id', 'type', 'message', 'url', 'response_text', 'params', 'action', 'created_log_date', 'updated_log_date'];
    
    const CREATED_AT = 'created_log_date';
    const UPDATED_AT = 'updated_log_date';

    public $timestamps = true;
   
}
