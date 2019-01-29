<?php

namespace Hocplus\Teacher\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
//use Hocplus\Teacher\App\Repositories\DemoRepository;
//use Hocplus\Teacher\App\Repositories\TeacherRepository;
use Hocplus\Teacher\App\Models\Teacher;
use Hocplus\Teacher\App\Models\Subject;
use Hocplus\Teacher\App\Models\Course;
use Hocplus\Teacher\App\Models\TblClass;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /*
    public function __construct(TeacherRepository $teacherRepository)
    {
        parent::__construct();
        $this->teacher = $teacherRepository;
    }*/    
    /**
     *  list of teachers 
     */
    public function index(Request $request) {
        // $params = array();
        $params = $request->all(); 
        if (count($params) > 0) {
            $teacher = new Teacher;
            $teachers = $teacher->filter($params);                
        }
        else {
            $teachers = Teacher::paginate(10);
        }
        // var_dump($params); die();
        $subjects = Subject::all();
        $classes = TblClass::all();
        $subjectClass = Subject::all();
        /*count number of courses*/
        $courses = array();
        $lessons = array();
        /*find class name*/
        $teach_classes = array();
        $teach_subject = array();
        $students = array();
        if ($teachers) {
            foreach ($teachers as $teacher) {
                $courses[$teacher->teacher_id] = $teacher->getNumberOfCourse();               
                $students[$teacher->teacher_id] = $teacher->getTotalOfStudent();  
                $teach_subject[$teacher->teacher_id] = $teacher->getSubjectName();
                // count number of lesson
                $lessons[$teacher->teacher_id] = $teacher->getNumberOfLesson();
            }
        }
        return view('HOCPLUS-TEACHER::modules.teacher.index', compact('teachers','params','subjects','subjectClass','classes','courses','teach_classes','teach_subject','lessons','students'));
    }
    /*
     * teacher info
     */
    public function detail($teacher_id) {
        $teacher_id = intval($teacher_id); 
        $teacher = Teacher::find($teacher_id);
        $course = new Course;
        $timeNow = date('Y-m-d');
        $courses = array();
        $courses['will'] =  $course->where('teacher_id',$teacher_id)->where('date_start', '>', $timeNow)->limit(4)->get();
        $courses['now'] =  $course->where('teacher_id',$teacher_id)->where('date_start', '<', $timeNow)->where('date_end', '>', $timeNow)->limit(4)->get();
        $courses['end'] =  $course->where('teacher_id',$teacher_id)->where('date_end', '<', $timeNow)->limit(4)->get();
        $subjects = Subject::all();
        $classes = TblClass::all();
        $teachers = array();
        $teach_classes = $teacher->teachClasses($teacher_id);
        $teach_subject = $teacher->teachSubject($teacher_id);        
        $subject_classes = array();
        foreach ($courses as $list_course) {
            foreach ($list_course as $course) {
                if ($course->getTeacher()) {
                    $teachers[$course->course_id] = $course->getTeacher(); 
                    $subject_classes[$course->course_id] = $course->getSubject();
                }
                else {
                    $teachers[$course->course_id] = 'Chưa có dữ liệu';
                }
            }
        }
        return view('HOCPLUS-TEACHER::modules.teacher.detail',compact('teacher','courses','subjects','classes','teachers','teach_classes','teach_subject','subject_classes'));
    }
}
