<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Frontend\App\Models\Teacher;
class Order extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_orders';

    protected $primaryKey = 'order_id';

    protected $fillable = ['course_id', 'order_code', 'user_id', 'voucher_id', 'total_money', 'total_discount', 'money_payment', 'status'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
   
}
