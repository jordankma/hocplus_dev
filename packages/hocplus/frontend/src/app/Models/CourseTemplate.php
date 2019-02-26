<?php

namespace Hocplus\Frontend\App\Models;

use Illuminate\Database\Eloquent\Model;
use Hocplus\Frontend\App\Models\Classes;
use Hocplus\Frontend\App\Models\Subject;
use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Frontend\App\Models\TemplateLesson;

class CourseTemplate extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_course_templates';

    protected $primaryKey = 'course_template_id';

    protected $fillable = [
        'template_name', 'template_avatar', 'template_video_intro', 'classes_id', 'subject_id', 'teacher_id',
        'will_learn', 'target', 'request_content', 'summary', 'is_hot', 'time', 'number_lesson', 'keyword',
        'alias', 'time', 'number_lesson'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;
    
    public function isClass(){
        return $this->BelongsTo(Classes::class, 'classes_id');
    }
    
    public function isSubject(){
        return $this->BelongsTo(Subject::class, 'subject_id');
    }
    
    public function isTeacher(){
        return $this->BelongsTo(Teacher::class, 'teacher_id');
    }
    
    public function getTemplateLesson(){
        return $this->hasMany(Templatelesson::class, 'course_template_id');
    }
}
