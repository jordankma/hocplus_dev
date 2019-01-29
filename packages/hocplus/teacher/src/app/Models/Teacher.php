<?php

namespace Hocplus\Teacher\App\Models;
use Hocplus\Teacher\App\Models\Teacher;
use Hocplus\Teacher\App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Teacher extends Model
{
    /*
    protected $table = 'tbl_teachers';
    protected $primaryKey = 'teacher_id'; */
    
    use SoftDeletes;

    protected $table = 'vne_teachers';

    protected $primaryKey = 'teacher_id';

    //protected $fillable = ['name'];

    protected $dates = ['deleted_at']; 
    
    /*
     * get Subject Name
     */
    public function getSubjectName() {
        $teacher_id = $this->teacher_id;
        $query = DB::table('vne_subject')->select('vne_subject.name')->join('vne_teacher_class_subject','vne_subject.subject_id','=','vne_teacher_class_subject.subject_id')->join('vne_teachers','vne_teachers.teacher_id','=','vne_teacher_class_subject.teacher_id')->where('vne_teachers.teacher_id','=',$teacher_id)->where('vne_teacher_class_subject.deleted_at','=',NULL)->get()->first();        
        if ($query) {
            return $query->name;    
        }
        else {
            return 'Chưa dạy môn nào';
        }        
    }

    /*
     * get number of courses
     */
    public function getNumberOfCourse() {
        $query = DB::table('hocplus_course')->join('vne_teachers','hocplus_course.teacher_id','=','vne_teachers.teacher_id')->where('vne_teachers.teacher_id','=',$this->teacher_id)->get();
        return count($query);
    }
    /*
     * get number of lesson
     */
    public function getNumberOfLesson() {
        $query = DB::table('vne_teachers')->join('vne_teacher_class_subject','vne_teachers.teacher_id','=','vne_teacher_class_subject.teacher_id')->join('hocplus_course','vne_teacher_class_subject.teacher_id','=','hocplus_course.teacher_id')->join('hocplus_lesson','hocplus_course.course_id','=','hocplus_lesson.course_id')->where('vne_teacher_class_subject.deleted_at','=',NULL)->where('vne_teachers.teacher_id','=',$this->teacher_id)->get();
        return count($query);
    }
    /**
     * get total of Students
    */
    public function getTotalOfStudent() {
        $query1 = DB::table('hocplus_course')->join('vne_teachers','hocplus_course.teacher_id','=','vne_teachers.teacher_id')->select(DB::raw('SUM(student_register) as total_student'))->where('vne_teachers.teacher_id','=',$this->teacher_id)->get()->first();
        if ($query1) {
            return intval($query1->total_student); 
        }
        else {
            return 0;
        }
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
    
    public function listClass($class_id, $subject_id = 0) {
        if ($class_id == 0) {
            $query = DB::table('vne_teachers')->select('vne_teachers.teacher_id')->join('vne_teacher_class_subject','vne_teachers.teacher_id','=','vne_teacher_class_subject.teacher_id')->join('vne_subject','vne_subject.subject_id','=','vne_teacher_class_subject.subject_id')->where('vne_teacher_class_subject.deleted_at','=',NULL)->where('vne_subject.subject_id','=',$subject_id)->distinct()->get();            
        }
        else
        if ($subject_id == 0) {
            $query = DB::table('vne_teachers')->select('vne_teachers.teacher_id')->join('vne_teacher_class_subject','vne_teachers.teacher_id','=','vne_teacher_class_subject.teacher_id')->join('vne_classes','vne_classes.classes_id','=','vne_teacher_class_subject.classes_id')->where('vne_teacher_class_subject.deleted_at','=',NULL)->where('vne_classes.classes_id',$class_id)->distinct()->get();
        }
        else {
            $query = DB::table('vne_teachers')->select('vne_teachers.teacher_id')->join('vne_teacher_class_subject','vne_teachers.teacher_id','=','vne_teacher_class_subject.teacher_id')->join('vne_classes','vne_classes.classes_id','=','vne_teacher_class_subject.classes_id')->join('vne_subject','vne_subject.subject_id','=','vne_teacher_class_subject.subject_id')->where('vne_teacher_class_subject.deleted_at','=',NULL)->where('vne_classes.classes_id',$class_id)->where('vne_subject.subject_id','=',$subject_id)->distinct()->get();
        }
        $teacher = new Teacher;
        $list = array();
        foreach ($query as $k => $item) {
            $list[] = $item->teacher_id;
        }
        $result = $teacher->wherein('teacher_id',$list)->paginate(10);
        return $result;
    }

    public function listCourse($flag) {
        $timeNow = date('Y-m-d'); //echo $timeNow; die();
        if ($flag == 'upcomming') {
            $query = DB::table('vne_teachers')->select('vne_teachers.teacher_id')->join('hocplus_course','vne_teachers.teacher_id','=','hocplus_course.teacher_id')->where('vne_teachers.deleted_at','=',NULL)->where('date_start', '>', $timeNow)->distinct()->get();
        }
        else if ($flag == 'incomming') {
            $query = DB::table('vne_teachers')->select('vne_teachers.teacher_id')->join('hocplus_course','vne_teachers.teacher_id','=','hocplus_course.teacher_id')->where('vne_teachers.deleted_at','=',NULL)->where('date_start', '<', $timeNow)->where('date_end', '>', $timeNow)->distinct()->get();
        }
        else {
            $query = DB::table('vne_teachers')->select('vne_teachers.teacher_id')->join('hocplus_course','vne_teachers.teacher_id','=','hocplus_course.teacher_id')->where('vne_teachers.deleted_at','=',NULL)->distinct()->get();
        }
        $teacher = new Teacher;
        $list = array();
        foreach ($query as $k => $item) {
            $list[] = $item->teacher_id;
        }
        //var_dump($list); die();
        $result = $teacher->wherein('teacher_id',$list)->paginate(10);
        return $result;        
    }
    
    /**
     * filter teachers by params
     */
    public function filter($params) {
        $model = new Teacher;
        $keyword = isset($params['keyword'])?$params['keyword']:'';
        $sort = isset($params['sort'])?$params['sort']:'';   
        if ($sort == 'name') {
            $query = $model->where('name','LIKE','%'.$keyword.'%')->orderBy('name'); 
        }
        else if ($sort == 'newest') {
            $query = $model->where('name','LIKE','%'.$keyword.'%')->orderBy('updated_at','desc'); 
        }
        else {
            $query = $model->where('name','LIKE','%'.$keyword.'%');     
        }
        /** filter by class_id */     
        if (isset($params['byclass']) &&  isset($params['bysubject'])) {
            $query = $model->listClass($params['byclass'], $params['bysubject']);
            return $query;            
        }
        else if (isset($params['byclass'])) { 
            $query = $model->listClass($params['byclass']);
            return $query;
        }
        else if (isset($params['bysubject'])) {
            $query = $model->listClass(0,$params['bysubject']);
            return $query;
        }
        /** filter by course status */
        if (isset($params['incomming'])) {
            $query = $model->listCourse('incomming');
            return $query;
        }
        else if (isset($params['upcomming'])) {
            $query = $model->listCourse('upcomming');
            return $query;
        }
        $result = $query->paginate(10);       
        return $result;        
    }    
}
