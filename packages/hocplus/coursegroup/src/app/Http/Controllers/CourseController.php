<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Classes;
use Hocplus\Coursegroup\App\Models\Banner;
use Hocplus\Coursegroup\App\Models\Course;

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
        $course = Course::with('isTeacher', 'isSubject', 'isClass', 'getLesson')->first();
        if($course_id != null){
            $course = Course::with('isTeacher', 'isSubject', 'isClass', 'getLesson')->where('course_id',$course_id)->first();    
        }
        if(empty($course)){
            return redirect()->route('hocplus.frontend.index');
        }
        $data = [
            'course' => $course
        ];
        return view('HOCPLUS-COURSEGROUP::modules.frontend.course.index',$data);
    }
}
