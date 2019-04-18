<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Frontend\App\Models\Member;
class MemberDeposit extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_member_deposit';

    protected $primaryKey = 'member_deposit_id';

    protected $fillable = ['member_id', 'deposit', 'deposit_hash', 'deposit_status'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
   
}
