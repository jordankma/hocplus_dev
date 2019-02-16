<?php

namespace Hocplus\Teacherfrontend\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Teacherfrontend\App\Models\Classes;
use Hocplus\Teacherfrontend\App\Models\TeacherClassSubject;

class Teacher extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_teachers';

    protected $primaryKey = 'teacher_id';

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function getClasses(){        
        return $this->belongsToMany(Classes::class, 'vne_teacher_class_subject', 'teacher_id', 'classes_id')->with('getSubject')->select('vne_classes.classes_id', 'name')->distinct();
    }
    
    public function getSubject(){
        return $this->hasMany(TeacherClassSubject::class, 'teacher_id');
    }

    /*
     * get list of Classes
     */
    public function teachClasses($teacher_id) {
        $query = DB::table('vne_classes')->select('vne_classes.name')->join('vne_teacher_class_subject','vne_classes.classes_id','=','vne_teacher_class_subject.classes_id')->join('vne_teachers','vne_teachers.teacher_id','=','vne_teacher_class_subject.teacher_id')->where('vne_teachers.teacher_id','=',$teacher_id)->where('vne_teacher_class_subject.deleted_at','=',NULL)->get();
        return $query;
    }
    /*
     * teach subject
     */
    public function teachSubject($teacher_id) {
        $query = DB::table('vne_subject')->select('vne_subject.name')->join('vne_teacher_class_subject','vne_subject.subject_id','=','vne_teacher_class_subject.subject_id')->join('vne_teachers','vne_teachers.teacher_id','=','vne_teacher_class_subject.teacher_id')->where('vne_teachers.teacher_id','=',$teacher_id)->where('vne_teacher_class_subject.deleted_at','=',NULL)->get()->first();
        return $query;
    }
}
