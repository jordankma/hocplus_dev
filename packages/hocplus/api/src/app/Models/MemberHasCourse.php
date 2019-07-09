<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;
use Hocplus\Api\App\Models\Course;
class MemberHasCourse extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_member_has_course';

    protected $primaryKey = 'member_has_course_id';

    public function getCourse(){
        return $this->belongsTo(Course::class, 'course_id');
    }
}
