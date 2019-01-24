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
        return $this->belongsToMany(Classes::class, 'teacher_class_subject', 'teacher_id', 'classes_id')->with('getSubject')->select('vne_classes.classes_id', 'name')->distinct();
    }
    
    public function getSubject(){
        return $this->hasMany(TeacherClassSubject::class, 'teacher_id');
    }
}
