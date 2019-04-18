<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberHasCourse extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_member_has_course';

    protected $primaryKey = 'member_has_course_id';
    
    protected $fillable = ['member_id', 'course_id', 'exp'];
   
    public $timestamps = true;
   
}
