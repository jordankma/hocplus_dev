<?php

namespace Hocplus\Frontend\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Frontend\App\Models\Teacher;

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
    
    public function getTeacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
