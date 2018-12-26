<?php

namespace Vne\CourseTemplate\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\Classes\App\Models\Classes;
use Vne\Subject\App\Models\Subject;
use Vne\Teacher\App\Models\Teacher;
use Vne\TemplateTesson\App\Models\Templatelesson;

class CourseTemplate extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_course_templates';

    protected $primaryKey = 'course_template_id';

    protected $fillable = ['template_name', 'template_avatar', 'template_video_intro', 'classes_id', 'subject_id', 'teacher_id', 'will_learn', 'target', 'request_content', 'summary', 'is_hot'];

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
        $query = Coursetemplate::orderBy('course_template_id', 'desc');
        $limit = !empty($params['limit']) ? $params['limit'] : 20;
        if(!empty($params['teacher_id'])){
            $query->where(['teacher_id' => $params['teacher_id']]);
        }
        if(!empty($params['subject_id'])){
            $query->where(['subject_id' => $params['subject_id']]);
        }
        if(!empty($params['classes_id'])){
            $query->where(['classes_id' => $params['classes_id']]);
        }
        if(!empty($params['template_name'])){
            $query->where('template_name', 'like', $params['template_name'].'%');
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
    
    public function getTemplateLesson(){
        return $this->hasMany(Templatelesson::class, 'course_template_id');
    }
}
