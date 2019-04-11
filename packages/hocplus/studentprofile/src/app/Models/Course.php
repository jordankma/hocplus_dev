<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Studentprofile\App\Models;
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
    /**
     * wishlist
     */
    public function getWishList($member_id) {
        $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('vne_member_has_wishlist','vne_member_has_wishlist.course_id','=','hocplus_course.course_id')->join('vne_members','vne_member_has_wishlist.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->paginate(10);
        return $query;          
    }
    /*filter by params*/
    public function filter($member_id, $params) {
        if ($params['subject_id']) {
            $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->where('hocplus_course.subject_id','=',$params['subject_id'])->paginate(10);                       
        }
        else
        if ($params['date_from'] && $params['date_to']) {
            $params['date_from'] = date("Y-m-d",strtotime($params['date_from']));
            $params['date_to'] = date("Y-m-d",strtotime($params['date_to']));
            $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->where('hocplus_course.date_start','>=',$params['date_from'])->where('hocplus_course.date_end','<=',$params['date_to'])->paginate(10);                                  
        }
        else
        if ($params['status']!=0) {
            $now = date("Y-m-d");
            switch (intval($params['status'])) {
                case 1:
                    $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->where('hocplus_course.date_start','>=',$now)->paginate(10);                                                      
                    break;
                case 2:
                    $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->where('hocplus_course.date_start','<=',$now)->where('hocplus_course.date_end','>=',$now)->paginate(10);                                                      
                    break;
                case 3:
                    $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->where('hocplus_course.date_end','<=',$now)->paginate(10);                                                     
                    break;
                default:
                    $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->where('hocplus_course.date_start','>=',$now)->paginate(10);                                                      
            }            
        }
        else
        if ($params['keyword']) {
            $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->where('hocplus_course.name','LIKE','%'.$params['keyword'].'%')->paginate(10);  
        }
        else {
            $query = DB::table('hocplus_course')->select('hocplus_course.course_id','hocplus_course.name','avartar','date_start','date_end')->join('hocplus_member_has_course','hocplus_member_has_course.course_id','=','hocplus_course.course_id')->join('vne_members','hocplus_member_has_course.member_id','=','vne_members.member_id')->where('hocplus_course.deleted_at','=',NULL)->where('vne_members.member_id','=',$member_id)->paginate(10);            
        }
        return $query;           
    }
    /*get lesson*/
    public function getLesson(){
        return $this->hasMany(Lesson::class, 'course_id');
    }
}