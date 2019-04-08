<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Classes;
use Hocplus\Coursegroup\App\Models\Banner;
use Hocplus\Coursegroup\App\Models\Course;
use Hocplus\Coursegroup\App\Models\Comments;
use Hocplus\Coursegroup\App\Models\MemberHasCourse;

use Hocplus\Coursegroup\App\Repositories\CourseRepository;
use Auth,Validator;
class CourseController extends Controller
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
        // $is_register = false;
        // $member_has_course = MemberHasCourse::where('member_id',$member_id)->where('course_id', $course_id)->first();
        // if($member_has_course){
        //     $is_register = true;   
        // }
        $is_register = self::checkRegister($member_id,$course_id);
        // dd($is_register);
        //get comment 
        $comments = Comments::where('course_id','=',$course_id)->where('status',1)->orderBy('updated_at')->get();
        //end get comment
        $data = [
            'course' => $course,
            'list_course_relate' => $list_course_relate,
            'is_register' => $is_register,
            'comments' => $comments
        ];
        return view('HOCPLUS-COURSEGROUP::modules.frontend.course.index',$data);
    }

    public function getStream(Request $request){
        $course_id = $request->input('course_id');
        $lesson_id = $request->input('lesson_id');
        $time_now = time();
        $url = config('site.url');
        $data_reponse['status'] = false;
        $member_id = Auth::guard('member')->id();
        $type_member = 'student';
        try {
            $temp = 'get-token?member_id=' . $member_id . '&course_id=' . $course_id . '&lesson_id=' . $lesson_id . '&time=' . $time_now . '&type=' . $type_member;
            $encrypted = self::my_simple_crypt( $temp , 'e' );
            $data_reponse = file_get_contents($url . '/' . 'resource/' . $encrypted);
            $data_reponse = json_decode($data_reponse,true);
            $url_stream = config('site.url_stream');
            if($data_reponse['status'] == true){
                $token = $data_reponse['data']['token'];
                $url = $url_stream . "?token=" . $token;
                return redirect($url);
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

    public function getDelete(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|numeric'
        ], $this->messages);
        if (!$validator->fails()) {
            $course_id = $request->input('course_id');
            $teacher_id = Auth::guard('teacher')->id();
            $course = $this->course->find($course_id);
            if (null != $course && $course->teacher_id = $teacher_id) {
                $this->course->delete($course_id);
                return redirect()->route('hocplus.get.my.course.teacher');
            } else {
                return redirect()->route('hocplus.get.my.course.teacher');
            }
        } else{
            return $validator->messages();
        }
    }
}
