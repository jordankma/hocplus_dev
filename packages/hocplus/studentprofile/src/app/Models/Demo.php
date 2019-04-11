<?php

namespace Hocplus\Studentprofile\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Demo extends Model {
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
    /**
     * wishlist
     */
    public function getWishList($member_id) {
        $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->get();
        return $query;          
    }
}
