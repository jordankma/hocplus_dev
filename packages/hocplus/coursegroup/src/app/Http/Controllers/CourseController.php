<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Classes;
use Hocplus\Coursegroup\App\Models\Banner;
use Hocplus\Coursegroup\App\Models\Course;
use Hocplus\Coursegroup\App\Models\MemberHasCourse;

use Hocplus\Coursegroup\App\Repositories\CourseRepository;

class CourseController extends Controller
{
    public function __construct(CourseRepository $courseRepository)
    {
        parent::__construct();
        $this->course = $courseRepository;
    }

    public function index(Request $request, $course_id = null)
    {
        $member_id = 3;
        $course = Course::with('isTeacher', 'isSubject', 'isClass', 'getLesson')->first();
        if($course_id != null){
            $course = Course::with('isTeacher', 'isSubject', 'isClass', 'getLesson')->where('course_id',$course_id)->first();    
        }
        if(empty($course)){
            return redirect()->route('hocplus.frontend.index');
        }
        $list_course_relate = Course::where('classes_id',$course->classes_id)->take(5)->get();
        if(empty($list_course_relate)){
            $list_course_relate = Course::take(5)->get();
        }

        //check register
        $is_register = false;
        $member_has_course = MemberHasCourse::where('member_id',$member_id)->first();
        if($member_has_course){
            $is_register = true;   
        }
        $data = [
            'course' => $course,
            'list_course_relate' => $list_course_relate,
            'is_register' => $is_register
        ];
        return view('HOCPLUS-COURSEGROUP::modules.frontend.course.index',$data);
    }
}
