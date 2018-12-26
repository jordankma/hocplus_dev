<?php

namespace Vne\Teacher\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\Classes\App\Models\Classes;
use Vne\Teacher\App\Models\TeacherClassSubject;
class Teacher extends Model {
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teachers';

    protected $primaryKey = 'teacher_id';

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function getClasses(){        
        return $this->belongsToMany(Classes::class, 'teacher_class_subject', 'teacher_id', 'classes_id')->with('getSubject')->select('classes.classes_id', 'name')->distinct();
    }
    
    public function getSubject(){
        return $this->hasMany(TeacherClassSubject::class, 'teacher_id');
    }
}
