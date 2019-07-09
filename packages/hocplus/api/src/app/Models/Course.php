<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Api\App\Models\Lesson;
use Hocplus\Api\App\Models\Teacher;
use Hocplus\Api\App\Models\Classes;
use Hocplus\Api\App\Models\Subject;
class Course extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_course';

    protected $primaryKey = 'course_id';

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
    public function getTeacher(){
        return $this->hasMany(Teacher::class, 'teacher_id');
    }
    public function isClass(){
        return $this->belongsTo(Classes::class, 'classes_id');
    }
    
    public function isSubject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    
    public function isTeacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    
    public function getLesson(){
        return $this->hasMany(Lesson::class, 'course_id');
    }

    
}
