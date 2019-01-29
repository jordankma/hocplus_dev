<?php

namespace Vne\Pay\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Frontend\App\Models\Teacher;
class Course extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_course';

    protected $primaryKey = 'course_id';

    protected $fillable = ['student_limit', 'student_register', 'date_start', 'date_end', 'time', 'status', 'price', 'discount', 'discount_exp', 'number_lesson', 'name', 'avartar', 'video', 'classes_id', 'subject_id', 'teacher_id', 'will_learn', 'target', 'request_content', 'summary', 'is_hot'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;

    public function isTeacher(){
        return $this->BelongsTo(Teacher::class, 'teacher_id');
    }
}
