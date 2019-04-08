<?php

namespace Hocplus\Teacherfrontend\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Teacherfrontend\App\Models\Subject;
use Hocplus\Teacherfrontend\App\Models\Classes;
use Hocplus\Teacherfrontend\App\Models\Banner;
use Hocplus\Teacherfrontend\App\Models\Course;
use Hocplus\Teacherfrontend\App\Models\Teacher;
use Hocplus\Teacherfrontend\App\Models\TeacherClassSubject;
use Hocplus\Teacherfrontend\App\Models\Member;
use Hocplus\Teacherfrontend\App\Models\MemberHasCourse;
use Hocplus\Teacherfrontend\App\Repositories\CourseRepository;
use Validator,Auth;
class StudentfrontendController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct(CourseRepository $courseRepository)
    {
        parent::__construct();
        $this->course = $courseRepository;
    }

    public function getMyCourse($alias = null){
        $member_id = Auth::guard('member')->id();
        $member = Member::where('member_id',$member_id)->with('getCourse.getCourse.isTeacher','getCourse.getCourse.isSubject','getCourse.getCourse.isClass','getCourse.getCourse.getLesson')->first();
        $timeNow = time();
        $courses = MemberHasCourse::where('member_id',$member_id)
        ->with('getCourse.isTeacher', 'getCourse.isSubject', 'getCourse.isClass', 'getCourse.getLesson')
        ->paginate(2, ['*'], 'page-course');
        $courses_end = MemberHasCourse::where('member_id',$member_id)
        ->with('getCourse.isTeacher', 'getCourse.isSubject', 'getCourse.isClass', 'getCourse.getLesson')
        ->whereHas('getCourse', function ($query) use ($timeNow) {
            $query->where('hocplus_course.date_end', '<', $timeNow);
        })->paginate(2, ['*'], 'page-course-end');
        $data = [
            'member' => $member,
            'courses' => $courses,
            'courses_end' => $courses_end
        ];
        return view('HOCPLUS-TEACHERFRONTEND::modules.frontend.profilestudent.mycourse',$data);   
    }
}
