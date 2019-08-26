<?php

namespace Vne\Course\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\Course\App\Models\Course;

class Lesson extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_lesson';

    protected $primaryKey = 'lesson_id';

    protected $fillable = ['name', 'date_start', 'content', 'active', 'status', 'url', 'time_line'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
       
    
    public static function customSearch($params){
        $limit = !empty($params['limit']) ? $params['limit'] : 20;
        $query = Lesson::orderBy('lesson_id', 'desc');
        if(!empty($params['active'])){
             $query->where('active', $params['active']);
        }
        if(!empty($params['course_id'])){
             $query->where('course_id', $params['course_id']);
        }
        
        $data = $query->paginate($limit)->appends($params);
       
        return $data;
    }
    
    public function getCourse(){
        return $this->belongsTo(Course::class, 'course_id');
    }       
}
