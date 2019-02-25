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

use Hocplus\Teacherfrontend\App\Repositories\CourseRepository;
use Validator,Auth;
class TeacherfrontendController extends Controller
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

    public function index(Request $request)
    {
        $list_class = array();
        try {
            $list_class = Classes::with('getSubject')->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
        $data = [
            'list_class' => $list_class
        ];
        return view('HOCPLUS-TEACHERFRONTEND::modules.frontend.teacherfrontend.index',$data);
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $class_subject = $request->input('class_subject');
            $teachers = new Teacher();
            $teachers->name = $request->input('name');
            $teachers->alias = str_slug( $request->input('name'), "-" );
            $teachers->password = bcrypt($request->input('password'));
            $teachers->phone = $request->input('phone');
            $teachers->email = $request->input('email');
            $teachers->address = $request->input('address');
            if ($teachers->save()) {
                if(!empty($class_subject)){
                    foreach($class_subject as $key => $value) {
                        $arr_temp = explode("-",$value);
                        $teacher_class_subject = new TeacherClassSubject();
                        $teacher_class_subject->classes_id =  $arr_temp[0];
                        $teacher_class_subject->subject_id =  $arr_temp[1];
                        $teacher_class_subject->teacher_id = $teachers->teacher_id;
                        $teacher_class_subject->save();
                    }
                } 
                return redirect()->route('hocplus.get.register.teacher')->with('success','Đăng ký làm giảng viên thành công');
            } else{
                return redirect()->route('hocplus.get.register.teacher')->with('error','Đăng ký làm giảng viên thất bại');
            }
        } else {
            return $validator->messages();
        }
    }

    public function getMyCourse($teacher_alias = null){
        $teacher_id = Auth::guard('teacher')->id();
        $teacher = Teacher::where('teacher_id',$teacher_id)->with('getClasses','getSubject')->first();
        $timeNow = time();
        $courses = Course::with('isTeacher', 'isSubject', 'isClass', 'getLesson')->where('teacher_id',$teacher_id)->paginate(5, ['*'], 'page-course');
        $courses_end =  Course::with('isTeacher', 'isSubject', 'isClass', 'getLesson')->where('teacher_id',$teacher_id)->where('date_end', '<', $timeNow)->limit(4)->paginate(5, ['*'], 'page-course-end');
        $data = [
            'teacher' => $teacher,
            'courses' => $courses,
            'courses_end' => $courses_end
        ];
        return view('HOCPLUS-TEACHERFRONTEND::modules.frontend.profileteacher.mycourse',$data);   
    }
    public function getEditProfile($teacher_alias = null){
        $teacher_id = Auth::guard('teacher')->id();
        $list_class_subject = TeacherClassSubject::where('teacher_id',$teacher_id)->get();
        $list_class = array();
        try {
            $list_class = Classes::with('getSubject')->get();
        } catch (\Throwable $th) {
            //throw $th;
        }
        $list_class_subject_arr = array();
        if(!empty($list_class_subject)){
            foreach($list_class_subject as $key => $value){
                $list_class_subject_arr[] = $value->classes_id . '-' . $value->subject_id;      
            }
        }
        $teacher = Teacher::where('teacher_id',$teacher_id)->with('getClasses','getSubject')->first();
        $data = [
            'teacher' => $teacher,
            'list_class' => $list_class,
            'list_class_subject' => $list_class_subject,
            'list_class_subject_arr' => $list_class_subject_arr
        ];
        return view('HOCPLUS-TEACHERFRONTEND::modules.frontend.editteacher.edit',$data);   
    }

    public function getStream(Request $request){
        $course_id = $request->input('course_id');
        $lesson_id = $request->input('lesson_id');
        $time_now = time();
        $data_reponse['status'] = false;
        $teacher_id = Auth::guard('teacher')->id();
        $type_member = 'teacher';
        try {
            $temp = 'get-token?teacher_id=' . $teacher_id . '&course_id=' . $course_id . '&lesson_id=' . $lesson_id . '&time=' . $time_now . '&type=' . $type_member;
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
