<?php

namespace Hocplus\Frontend\App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Frontend\App\Models\Classes;
use Hocplus\Frontend\App\Models\TeacherClassSubject;
use Hocplus\Frontend\App\Models\Exam;

class Teacher extends Model implements AuthenticatableContract, CanResetPasswordContract{
    use Authenticatable, CanResetPassword, Notifiable, SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_teachers';

    protected $primaryKey = 'teacher_id';

    protected $fillable = ['name'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    public function getClasses(){
        return $this->belongsToMany(Classes::class, 'vne_teacher_class_subject', 'teacher_id', 'classes_id')->with('getSubject')->select('vne_classes.classes_id', 'name')->distinct();
    }

    public function getSubject(){
        return $this->hasMany(TeacherClassSubject::class, 'teacher_id');
    }

    public function getExam(){
        return $this->hasMany(Exam::class, 'user_id', 'teacher_id');
    }
}
