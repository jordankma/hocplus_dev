<?php

namespace Vne\Payment\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_payments';

    protected $primaryKey = 'payment_id';

    protected $fillable = ['name', 'img', 'client_id', 'secret_key', 'code', 'type', 'ordinal', 'status', 'img_hover', 'notifi', 'detail'];
    
    public $timestamps = true;
    
    protected $dates = ['deleted_at'];
    
    public static function customSearch($params){
        $orderBy = !empty($params['order_by']) ? $params['order_by'] : 'desc';
        $limit = !empty($params['limit']) ? $params['limit'] : 20;
        $query = Payment::orderBy('payment_id', $orderBy);
        if(!empty($params['name'])){
            $query->where('name', $params['name']);
        }
        return $query->paginate($limit)->appends($params);
    }
}
