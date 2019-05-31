<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_transactions';

    protected $primaryKey = 'transaction_id';    
    
    protected $fillable = ['order_code', 'member_id', 'course_id', 'money_payment', 'method', 'type', 'money_before', 'money_after', 'seri', 'code', 'card_type', 'message'];

    public $timestamps = true;
        
}
