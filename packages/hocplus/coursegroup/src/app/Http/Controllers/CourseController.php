<?php

namespace Hocplus\Coursegroup\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\MController as Controller;

use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Classes;
use Hocplus\Coursegroup\App\Models\Banner;
use Hocplus\Coursegroup\App\Models\Course;
use Hocplus\Coursegroup\App\Models\ES_Course;
use Hocplus\Coursegroup\App\Models\Comments;
use Hocplus\Coursegroup\App\Models\MemberHasCourse;
use Hocplus\Coursegroup\App\Models\MemberHasWishlist;
use Hocplus\Coursegroup\App\Models\ClassHasSubject;
use Hocplus\Rating\App\Models\Rating;
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
        $comments = Comments::where('course_id','=',$course_id)->where('status',1)->with('getMember')->orderBy('updated_at')->get();
        //end get comment

        //get rating
        $rate = 0;
        $rating = new Rating;
        $rate_result = $rating->where('course_id', '=',$course_id)->get();
        $stars = array();
        $total = count($rate_result);
        $dem = 0;
        for ($i= 1; $i<=5; $i++) {
            $stars[$i] = 0;
            foreach ($rate_result as $item) {
                if ($item->rate == $i) {
                    $stars[$i]++;
                    $dem++;
                    $rate = $rate + $i;
                }
            }
            
            if ($total >0) {
                $stars[$i] = round(100*$stars[$i]/$total);
            }
            
        }
        if ($dem>0) {
            //echo $rate; die;
            $rate = round($rate/$dem,1); //die;
        }
        else {
            $rate = 0;
        }
        $member = $this->user;
        if ($member) {
            $member_id = $member->member_id;
        }
        else {
            $member_id = 0;
        }

        $your_rate_result = Rating::where('course_id', '=',$course_id)->where('member_id', '=',$member_id)->get()->first();
        if ($your_rate_result) {
            $your_rate = $your_rate_result->rate;
        }
        else {
            $your_rate = 0;
        }
        //end get rating
        
        $data = [
            'course' => $course,
            'list_course_relate' => $list_course_relate,
            'is_register' => $is_register,
            'member_id' => $member_id,
            'comments' => $comments,
            'rate' => $rate,
            'stars' => $stars,
            'course_id' => $course_id,
            'your_rate' => $your_rate
        ];
        return view('HOCPLUS-COURSEGROUP::modules.frontend.course.index',$data);
    }

    public function getStream(Request $request){
        $course_id = $request->input('course_id');
        $lesson_id = $request->input('lesson_id');
        $time_now = time();
        $url = config('app.url');
        $data_reponse['status'] = false;
        $member_id = Auth::guard('member')->id();
        // $member_id = Auth::guard('member')->id() != null ? Auth::guard('member')->id() : $request->input('member_id');
        $type_member = 'student';
        try {
            $temp = 'get-token?member_id=' . $member_id . '&course_id=' . $course_id . '&lesson_id=' . $lesson_id . '&time=' . $time_now . '&type=' . $type_member;
            $encrypted = self::my_simple_crypt( $temp , 'e' );
            // dd($encrypted);
            $data_reponse = file_get_contents($url . '/' . 'resource/' . $encrypted);
            $data_reponse = json_decode($data_reponse,true);
            $url_stream = config('site.url_stream');
            if($data_reponse['status'] == true){
                $token = $data_reponse['data']['token'];
                $url = $url_stream . "?token=" . $token;
                // dd($url);
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

    public function AddWishlist(Request $request){
        $data['status'] = false;
        $data['message'] = 'Thêm khóa học vào khóa học yêu thích thất bại! ';
        $course_id = $request->input('course_id');
        $member_id = Auth::guard('member')->id();
        $member_has_wishlist = MemberHasWishlist::where('course_id',$course_id)->where('member_id',$member_id)->first();
        if(!empty($member_has_wishlist)){
            if($member_has_wishlist->delete()){
                $data['status'] = true;
                $data['message'] = 'Xóa khóa học khỏi khóa học yêu thích thành công!';
            }  
        } else{
            $member_has_wishlist_insert = new MemberHasWishlist();
            $member_has_wishlist_insert->course_id = $course_id;
            $member_has_wishlist_insert->member_id = $member_id;
            if($member_has_wishlist_insert->save()){
                $data['status'] = true;
                $data['message'] = 'Thêm khóa học vào khóa học yêu thích thành công!';
            };
        }
        return response()->json($data);
    }

    public function getSubject(Request $request){
        $classes_id = $request->input('classes_id');
        $subjects = ClassHasSubject::where('classes_id',$classes_id)->select('subject_id')->get();
        $str = '<option>Chọn môn</option>';
        if(count($subjects) > 0){
            foreach($subjects as $element){
                $subject = Subject::where('subject_id', $element->subject_id)->first();
                if(!empty($subject)){
                    $str .= '<option value="' . $subject->subject_id . '">' . $subject->name .'</option>';
                }
            }
        }
        return response()->json(['str'=> $str]);
    }

    public function syncCourse(Request $request){
        $limit = !empty($request->limit) ? (int)$request->limit : 2000;
        $list = ES_Course::with('isTeacher', 'isSubject', 'isClass', 'getLesson')->where('sync_es', 1)->take($limit)->get();
        if (!empty($list)) {
            try {
                $list->addToIndex();
                $arr = [];
                foreach ($list as $item){
                    $arr[] = $item->course_id;
                }
                if(ES_Course::whereIn('course_id',$arr)->update(['sync_es' => 2])){
                    echo "<pre>";
                    print_r( ' - done');
                    echo "</pre>";
                };
            } catch (\Exception $e) {
                echo "<pre>";
                print_r($e->getMessage());
                echo "</pre>";
                die;
            }
        } else {
            echo "<pre>";
            print_r('all done');
            echo "</pre>";
            die;
        }
    }
    
    public function searchCourse(Request $request){
        $courses = [];
        // if ($request->ajax()) {
            if($request->has('q')){
                $params['name'] = $request->input('q');
                $offset = $request->has('offset') ? $request->input('offset') : 1 ;
                $limit = $request->has('limit') ? $request->input('limit') : 4 ;
                $list_courses = ES_Course::customSearch($params, $offset, $limit);
                foreach($list_courses as $item){
                    $courses[] = [
                        'name' => $item['name'], 10,
                        'image' => ($item['avartar'] != '' || file_exists(substr($item['avartar'], 1))) ? config('site.url_static') . '/' . $item['avartar'] : '/vendor/' . $group_name . '/' . $skin . '/hocplus/frontend/images/course.jpg',
                        'price' => number_format($item['price'], 0,'.','.'),
                        'price_promo' => number_format($item['price_promo'], 0,'.','.'),
                        'url' => route('hocplus.course.detail',$item['course_id'])
                    ];
                }
            }
        // }
        echo json_encode($courses);
    }
}
