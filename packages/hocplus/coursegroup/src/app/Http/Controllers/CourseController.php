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
use Auth;
class CourseController extends Controller
{
    public function __construct(CourseRepository $courseRepository)
    {
        parent::__construct();
        $this->course = $courseRepository;
    }
    
    public function index(Request $request, $course_id = null)
    {
        $member_id = Auth::guard('member')->id();
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

    public function getStream(Request $request){
        $course_id = $request->input('course_id');
        $lesson_id = $request->input('lesson_id');
        $time_now = time();
        $data_reponse['status'] = false;
        $member_id = Auth::guard('member')->id();
        $type_member = 'student';
        try {
            $temp = 'get-token?member_id=' . $member_id . '&course_id=' . $course_id . '&lesson_id=' . $lesson_id . '&time=' . $time_now . '&type=' . $type_member;
            $encrypted = self::my_simple_crypt( $temp , 'e' );
            $data_reponse = file_get_contents('http://hocplus.vnedutech.vn/resource/' . $encrypted);
            $data_reponse = json_decode($data_reponse,true);
            if($data_reponse['status'] == true){
                $token = $data_reponse['data']['token'];
                $url = "https://stream.hocplus.vnedutech.vn/?token=" . $token;
                return Redirect::to($url);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->back();
    }

    public function my_simple_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = env('SECRET_KEY');
        $secret_iv = env('SECRET_IV');

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = substr( hash( 'sha256', $secret_key ), 0 ,32);
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        return $output;
    }
}
