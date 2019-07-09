<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TokenLogin extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_member_token';

    protected $primaryKey = 'id';

    protected $fillable = ['member_id', 'token', 'expired_at'];
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
