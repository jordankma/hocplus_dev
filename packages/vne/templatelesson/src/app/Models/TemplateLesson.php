<?php

namespace Vne\Templatelesson\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\CourseTemplate\App\Models\CourseTemplate;

class TemplateLesson extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_template_lesson';

    protected $primaryKey = 'template_lesson_id';

    protected $fillable = ['name', 'content', 'active', 'course_template_id'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
    
    public function getCourseTemplate(){
        return $this->belongsTo(Coursetemplate::class, 'course_template_id');
    }
    
    public static function customSearch($params){
        $limit = !empty($params['limit']) ? $params['limit'] : 20;
        $query = TemplateLesson::orderBy('template_lesson_id', 'desc');
        if(!empty($params['course_template_id'])){
            $query->where('course_template_id', $params['course_template_id']);
        }
        if(!empty($params['name'])){
            $query->where('name', $params['name']);
        }
        $data = $query->paginate($limit)->appends($params);
        return $data;
    }
}
