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
use Validator,Auth,Datetime;
use Illuminate\Support\Facades\Storage;

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

    public function postEditProfile(Request $request){
        //get avatar
        
        // $name_avatar = $avatar->getClientOriginalName();

        $teacher_id = Auth::guard('teacher')->id();
        $class_subject = $request->input('class_subject');
        $birthday = $request->input('day') . '/' . $request->input('moth') . '/' . $request->input('year');
        $time = strtotime($birthday);
        $birthday = date('Y-m-d H:i:s',$time);
        $current_password = $request->input('current_password');
        $password = $request->input('password');
        $conf_password = $request->input('conf_password');


        $teacher = Teacher::find($teacher_id);  
        if(empty($teacher)){
            return redirect()->route('index');
        } 
        //update avatar 
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $name_avatar = $avatar->getClientOriginalName();
            $array_tmp = explode("/",$teacher->avatar_index);
            if($array_tmp[count($array_tmp) - 1] != $name_avatar){

                $path_avatar = $request->file('avatar')->store(
                    'hocplus/teacher/'. $teacher_id . '/avatars' , 'static'
                );    
                $teacher->avatar_index = '/' . $path_avatar;
                $teacher->avatar_detail = '/' . $path_avatar;
            }
        }
        //end update avatar
        //update cmt 
        if($request->hasFile('image_cmt_before')){
            $image_cmt_before = $request->file('image_cmt_before');
            $name_image_cmt_before = $image_cmt_before->getClientOriginalName();
            $array_tmp = explode("/",$teacher->image_cmt_before);
            if($array_tmp[count($array_tmp) - 1] != $name_image_cmt_before){

                $path_image_cmt_before = $request->file('image_cmt_before')->store(
                    'hocplus/teacher/'. $teacher_id . '/cmt' , 'static'
                );    
                $teacher->image_cmt_before = '/' . $path_image_cmt_before;
            }
        }
        if($request->hasFile('image_cmt_after')){
            $image_cmt_after = $request->file('image_cmt_after');
            $name_image_cmt_after = $image_cmt_after->getClientOriginalName();
            $array_tmp = explode("/",$teacher->image_cmt_after);
            if($array_tmp[count($array_tmp) - 1] != $name_image_cmt_after){

                $path_image_cmt_after = $request->file('image_cmt_after')->store(
                    'hocplus/teacher/'. $teacher_id . '/cmt' , 'static'
                );    
                $teacher->image_cmt_after = '/' . $path_image_cmt_after;
            }
        }
        //end update cmt

        $teacher->name = $request->input('name');
        $teacher->gender = $request->input('gender');
        $teacher->address = $request->input('address');
        $teacher->said_like = $request->input('said_like');
        $teacher->workplace = $request->input('workplace');
        $teacher->experience = $request->input('experience');
        $teacher->degree = $request->input('degree');
        $teacher->timezone = $request->input('timezone');
        $teacher->bank_name = $request->input('bank_name');
        $teacher->bank_branch = $request->input('bank_branch');
        $teacher->bank_name_account = $request->input('bank_name_account');
        $teacher->bank_number = $request->input('bank_number');
        $teacher->birthday = $birthday;

        //update passowrd
        if($current_password != '' && $password != '' && $conf_password != ''){
            if($current_password != '' || $password != '' || $conf_password != ''){
                return redirect()->route('hocplus.get.edit.profile.teacher')->with('error','Vui lòng nhập đủ thông tin 3 trường để cập nhật mật khẩu');    
            } else{
                if(!Hash::check($current_password, $teacher->password)){
                    return redirect()->route('hocplus.get.edit.profile.teacher')->with('error','Mật khẩu hiện tại không đúng');
                } else{
                    if($password != $conf_password){
                        return redirect()->route('hocplus.get.edit.profile.teacher')->with('error','Mật khẩu không khớp nhau');    
                    } else{
                        $teacher->password = bcrypt($password);       
                    }
                }
            }
        }
        //end update password
        if($teacher->save()){
            $teacher->update_info = 1;
            $teacher->save();
            TeacherClassSubject::where('teacher_id', $teacher->teacher_id)->delete();
            if(!empty($class_subject)){
                foreach($class_subject as $key => $value) {
                    $arr_temp = explode("-",$value);
                    $teacher_class_subject = new TeacherClassSubject();
                    $teacher_class_subject->classes_id =  $arr_temp[0];
                    $teacher_class_subject->subject_id =  $arr_temp[1];
                    $teacher_class_subject->teacher_id = $teacher->teacher_id;
                    $teacher_class_subject->save();
                }
            }
            return redirect()->route('hocplus.get.edit.profile.teacher')->with('success','Cập nhật thông tin thành công');
        } else{
            return redirect()->route('hocplus.get.edit.profile.teacher');   
        }
    }

    public function getDashboard(Request $request){
        $teacher_id = Auth::guard('teacher')->id();
        $teacher = Teacher::where('teacher_id',$teacher_id)->with('getClasses','getSubject')->first();
        $data = [   
            'teacher' => $teacher
        ];
        return view('HOCPLUS-TEACHERFRONTEND::modules.frontend.dashboardteacher.dashboard',$data); 
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
                $url_stream = config('site.url_stream');
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
}
