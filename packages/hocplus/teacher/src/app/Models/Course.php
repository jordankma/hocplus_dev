<?php
namespace Hocplus\Teacher\App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Course extends Model
{
    use SoftDeletes;
    protected $table = 'hocplus_course';
    protected $primaryKey = 'course_id';
    /*
     * get Teacher info
     */
    public function getTeacher() {
        $query = DB::table('hocplus_course')->join('vne_teachers','vne_teachers.teacher_id','=','hocplus_course.teacher_id')->where('hocplus_course.course_id','=',$this->course_id)->get()->first();
        return $query;        
    }
    /*
     * get Subject info
     */
    public function getSubject() {
       $query1 = DB::table('hocplus_course')->join('vne_subject','hocplus_course.subject_id','=','vne_subject.subject_id')->join('vne_classes','vne_classes.classes_id','=','hocplus_course.classes_id')->select(DB::raw('vne_subject.name as subject_name,vne_classes.name as class_name'))->where('hocplus_course.course_id','=',$this->course_id)->get()->first();
       return $query1;
    }
}
