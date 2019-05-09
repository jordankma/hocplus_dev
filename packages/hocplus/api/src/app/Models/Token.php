<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_token';

    protected $primaryKey = 'id';

    protected $fillable = ['member_id', 'course_id', 'lesson_id', 'type', 'token', 'expired_at'];
    
    public $timestamps = true;
}
