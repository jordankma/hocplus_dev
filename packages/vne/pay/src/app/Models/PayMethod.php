<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Frontend\App\Models\Teacher;
class PayMethod extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_payments';

    protected $primaryKey = 'payment_id';

    protected $fillable = ['name', 'img', 'client_id', 'secret_key', 'code', 'type', 'ordinal', 'status', 'img_hover', 'notifi', 'detail'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
   
}
