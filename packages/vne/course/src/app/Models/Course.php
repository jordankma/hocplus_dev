<?php

namespace Vne\Course\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\Subject\App\Models\Subject;
use Vne\Teacher\App\Models\Teacher;
use Vne\Course\App\Models\Lesson;
use Vne\Classes\App\Models\Classes;

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
    
    public static function boot()
    {
        parent::boot();


        self::creating(function($data){

        });

        self::created(function($data){
            // ... code here
        });

        self::updating(function($data){
            // ... code here

        });

        self::updated(function($data){
            // ... code here
        });

        self::deleting(function($data){
            // ... code here
        });

        self::deleted(function($data){
            // ... code here
        });
    }
    
    public static function customSearch($params){
        $limit = !empty($params['limit']) ? $params['limit'] : 20;
        $query = Course::orderBy('course_id', 'desc');
        if(!empty($params['active'])){
            return $query->where('active', $params['active']);
        }
        if(!empty($params['teacher_id'])){
            return $query->where('teacher_id', $params['teacher_id']);
        }
        if(!empty($params['subject_id'])){
            return $query->where('subject_id', $params['subject_id']);
        }
        if(!empty($params['classes_id'])){
            return $query->where('classes_id', $params['classes_id']);
        }
        $data = $query->paginate($limit)->appends($params);
        return $data;
    }
    
     public function isClass(){
        return $this->BelongsTo(Classes::class, 'classes_id');
    }
    
    public function isSubject(){
        return $this->BelongsTo(Subject::class, 'subject_id');
    }
    
    public function isTeacher(){
        return $this->BelongsTo(Teacher::class, 'teacher_id');
    }
    
    public function getLesson(){
        return $this->hasMany(Lesson::class, 'course_id');
    }
}
