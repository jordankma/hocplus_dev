<?php

namespace Vne\Teacher\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\Teacher\App\Models\Teacher;
class TeacherClassSubject extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teacher_class_subject';

    protected $primaryKey = 'teacher_class_subject_id';

    // protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
    
    public static function findTeacher($params){
        $query = TeacherClassSubject::select('teacher_id')->orderBy('teacher_class_subject_id', 'desc');
        if($params['classes_id']){
            $query->where('classes_id', $params['classes_id']);
        }
        if($params['subject_id']){
            $query->where('subject_id', $params['subject_id']);
        }
        $data = $query->distinct()->get();
        
        return $data;
    }
    
    public function getTeacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
