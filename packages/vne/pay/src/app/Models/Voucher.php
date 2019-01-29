<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Frontend\App\Models\Teacher;
class Voucher extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_voucher';

    protected $primaryKey = 'voucher_id';

    protected $fillable = ['code', 'type', 'discount', 'active', 'uid'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
   
}
