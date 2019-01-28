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

use Hocplus\Teacherfrontend\App\Repositories\CourseRepository;
use Validator;
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

    public function getMyCourse(){
        
    }
}
