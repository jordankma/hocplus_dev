<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Application\Cms\Controllers\AController as Controller;
use Illuminate\Http\Request;
use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Api\App\Http\Controllers\TokenController;
use Hocplus\Api\App\Models\Member;
use Hocplus\Api\App\Models\Course;
use Hocplus\Api\App\Models\Lesson;
use Hocplus\Api\App\Models\MemberHasCourse;
use Hocplus\Api\App\Models\Comments;
use Hocplus\Api\App\Models\Rating;

use Hocplus\Api\App\Repositories\CourseRepository;

use Validator;
class CourseController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function __construct(CourseRepository $courseRepository){
        $this->course = $courseRepository;
        \Debugbar::disable();
    }

    public function listMyCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'token' => 'required',
        ], $this->messages);
        if (!$validator->fails()) {
            $member_id = $request->member_id;
            $token = $request->token;
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){
                $list_my_course = MemberHasCourse::where('member_id',$member_id)->with('getCourse')->with('getCourse.getTeacher')->paginate(5); 

                $data = array();
                if(!empty($list_my_course)){
                    foreach ($list_my_course as $key => $value) {
                        $value = json_decode($value,true);
                        // return $value;
                        $course = $value['get_course'];
                        // $teacher = $value['get_course']['get_teacher'][0];
                        $data[] = [
                            'id' => $course['course_id'],
                            'name' => base64_encode($course['name']),
                            'icon' => ($course['avartar'] != '' || file_exists(substr($course['avartar'], 1))) ? config('site.url_static') . $course['avartar'] : 'http://static.hocplus.vn/files/vendor/vnedutech-cms/default/hocplus/teacherfrontend/images/course.jpg',
                            // 'icon_gv' => $teacher['avatar_index'] != '' ? config('site.url_static') . $teacher['avatar_index'] : 'http://static.hocplus.vn/files/vendor/vnedutech-cms/default/hocplus/teacherfrontend/images/user.png',
                            // 'id_gv' => $teacher['teacher_id'],
                            // 'name_gv' => base64_encode($teacher['name']),
                            'icon_gv' => '',
                            'id_gv' => '',
                            'name_gv' => '',
                            'star' => 5,
                            'color' => ''
                        ];
                    }
                }  
                $data_reponse = [
                    'data' => $data,
                    'page' => $list_my_course->currentPage(),
                    'total_page' => $list_my_course->lastPage(),
                    'success' => true,
                    'message' => 'ok!'
                ];
                return json_encode($data_reponse);
            } else{
                return self::message(false, 'Token không hợp lệ');   
            }
        } else{
            return self::message(false, 'Thiếu tham số');   
        }
    }

    public function listLessonCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'course_id' => 'required',
            'token' => 'required',
        ], $this->messages);
        if (!$validator->fails()) {
            $member_id = $request->member_id;
            $course_id = $request->course_id;
            $token = $request->token;
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){
                $course = Course::find($course_id);
                $list_lesson = Lesson::where('course_id',$course_id)->paginate(5);
                $data = array();
                if(!empty($list_lesson)){
                    foreach ($list_lesson as $key => $value) {
                        $value = json_decode($value,true);
                        $time_now = time();
                        if($time_now > $value['date_start'] + $value['time_line']){
                            $check = 1;
                        }
                        elseif($value['date_start'] <= $time_now &&  $time_now <= $value['date_start'] + $value['time_line']){
                            $check = 2;
                        } else{
                            $check = 3;
                        }
                        $data[] = [
                            'id' => $value['lesson_id'],
                            'course_id' => $course->course_id,
                            'title' => base64_encode($value['name']),
                            'sub_title' => base64_encode($value['content']),
                            'time_start' => $value['date_start'],
                            'time_line' => $value['time_line'],
                            'time_end' => $value['date_end'],
                            'color' => '',
                            'check' => $check //1 da dien ra 2 dang dien ra 3 sap dien ra
                        ];
                    }
                } 
                $data_reponse = [
                    'data' => $data,
                    'title' => base64_encode($course->name),
                    'page' => $list_lesson->currentPage(),
                    'total_page' => $list_lesson->lastPage(),
                    'success' => true,
                    'message' => 'ok!'
                ];
                return json_encode($data_reponse);
            } else{
                return self::message(false, 'Token không hợp lệ'); 
            }
        } else{
            return self::message(false, 'Thiếu tham số');   
        }
    }

    public function getTokenCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'course_id' => 'required',
            'lesson_id' => 'required',
            'token' => 'required',
        ], $this->messages);
        if (!$validator->fails()) {
            $time_now = time();
            $url = config('app.url');
            $type_member = 'student';

            $member_id = $request->member_id;
            $course_id = $request->course_id;
            $lesson_id = $request->lesson_id;
            $token = $request->token;
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){ //check token
                $check_buy_course = self::checkBuyCourse($member_id, $course_id);
                if($check_buy_course){ //check mua khoa hoc
                    try {
                        $temp = 'get-token?member_id=' . $member_id . '&course_id=' . $course_id . '&lesson_id=' . $lesson_id . '&time=' . $time_now . '&type=' . $type_member;
                        $encrypted = self::my_simple_crypt( $temp , 'e' );
                        // dd($encrypted);
                        $data_reponse = file_get_contents($url . '/' . 'resource/' . $encrypted);
                        $data_reponse = json_decode($data_reponse,true);
                        $url_stream = config('site.url_stream');
                        if($data_reponse['status'] == true){
                            $token = $data_reponse['data']['token'];
                            $data = [
                                'success' => true,
                                'token' => $token,
                                'message' => 'Lấy token thành công'
                            ];    
                            $data_encode = json_encode($data);
                            return $data_encode;
                        }
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    return self::message(false, 'Lấy token thất bại');
                }else{
                    return self::message(false, 'Bạn cần mua khóa học');
                }
            } else{
                return self::message(false, 'Token không hợp lệ');
            }
        } else{
            return self::message(false, 'Thiếu tham số');  
        }    
    }

    public function listCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'token' => 'required',
            'type' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $class_id = $request->input('class_id');
            $subject_id = $request->input('subject_id');
            $member_id = $request->input('member_id');
            $token = $request->input('token');
            $type = $request->has('type') ? $request->input('type') : 'now';
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){ //check token
                $params = [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                    'member_id' => $member_id,
                    'token' => $token,
                    'type' => $type
                ];
                $list_course = $this->course->searchCourse($params);
                $data = array();
                if(!empty($list_course)){
                    foreach ($list_course as $key => $value) {
                        $value = json_decode($value,true);
                        $check_buy = self::checkBuyCourse($member_id,$value['course_id']);

                        $data[] = [
                            'id' => $value['course_id'],
                            'avartar' => $value['avartar'] != '' ? config('site.url_static') . $value['avartar'] : 'http://static.hocplus.vn/files/vendor/vnedutech-cms/default/hocplus/teacherfrontend/images/course.jpg',
                            'title' => base64_encode($value['name']),
                            'id_gv' => $value['is_teacher']['teacher_id'],
                            'name_gv' => base64_encode($value['is_teacher']['name']),
                            'icon_gv' => $value['is_teacher']['avatar_index'] != '' ? config('site.url_static') . $value['is_teacher']['avatar_index'] : 'http://static.hocplus.vn/files/vendor/vnedutech-cms/default/hocplus/teacherfrontend/images/user.png',
                            'star' => 5,
                            'check_buy' => $check_buy
                        ];
                    }
                } 
                $data_reponse = [
                    'data' => $data,
                    'page' => $list_course->currentPage(),
                    'total_page' => $list_course->lastPage(),
                    'success' => true,
                    'message' => 'ok!'
                ];
                return json_encode($data_reponse); 
            }else{
                return self::message(false, 'Token không hợp lệ');    
            }
        } else{
            return self::message(false, 'Thiếu tham số');     
        }         
    }

    public function detailCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'token' => 'required',
            'course_id' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $member_id = $request->input('member_id');
            $token = $request->input('token');
            $course_id = $request->input('course_id');
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){ //check token
                $data = $data_course_relate = $data_lesson = $data_comment = $data_rating = array();
                $course = Course::where('course_id',$course_id)->with('isTeacher', 'isSubject', 'isClass', 'getLesson')->first();
                $list_lesson = $course->getLesson;
                
                //data lesson 
                if(!empty($list_lesson)){
                    foreach ($list_lesson as $key => $value) {
                        $value = json_decode($value,true);
                        $time_now = time();
                        if($time_now > $value['date_start'] + $value['time_line']){
                            $check = 1;
                        }
                        elseif($value['date_start'] <= $time_now &&  $time_now <= $value['date_start'] + $value['time_line']){
                            $check = 2;
                        } else{
                            $check = 3;
                        }
                        $data_lesson[] = [
                            'id' => $value['lesson_id'],
                            'course_id' => $course->course_id,
                            'title' => base64_encode($value['name']),
                            'sub_title' => base64_encode($value['content']),
                            'time_start' => $value['date_start'],
                            'time_line' => $value['time_line'],
                            'time_end' => $value['date_end'],
                            'color' => '',
                            'check' => $check //1 da dien ra 2 dang dien ra 3 sap dien ra
                        ];
                    }
                } 
                //end datalesson
                //data comment
                $list_comments = Comments::where('course_id','=',$course_id)->where('status',1)->with('getMember')->orderBy('updated_at')->take(5)->get();
                if(!empty($list_comments)){
                    foreach ($list_comments as $key => $value) {
                        $name_member = '';
                        if($value->getMember){
                            $member_info_comment = $value->getMember;
                            $name_member = ($member_info_comment->name != '') ? $member_info_comment->name : $member_info_comment->email;
                            $name_member = $name_member != '' ? $name_member : $member_info_comment->phone; 
                        }
                        $data_comment[] = [
                            'id' => $value->id,
                            'comment' => base64_encode($value->comment),
                            'name_member' => base64_encode($name_member),
                            'created_at' => $value->created_at,
                            'rate' => 5,
                            'like' => 0 
                        ];
                    }
                } 
                //end data comment 
                //data course relate 
                $list_course_relate = Course::where('classes_id',$course->classes_id)->with('isTeacher')->take(5)->get();
                if(empty($list_course_relate)){
                    $list_course_relate = Course::take(5)->with('isTeacher')->get();
                } 
                if(!empty($list_course_relate)){
                    foreach ($list_course_relate as $key => $value) {
                        $value = json_decode($value,true);
                        $check_buy = self::checkBuyCourse($member_id,$value['course_id']);

                        $data_course_relate[] = [
                            'id' => $value['course_id'],
                            'avartar' => $value['avartar'],
                            'title' => base64_encode($value['name']),
                            'id_gv' => $value['is_teacher']['teacher_id'],
                            'name_gv' => base64_encode($value['is_teacher']['name']),
                            'star' => 5,
                            'check_buy' => $check_buy
                        ];
                    }    
                }
                //end datacourse relate
                //data rating
                $list_rating = Rating::where('course_id',$course_id)->get();
                $star1 = $star2 = $star3 = $star4 = $star5 = 0;
                if(!empty($list_rating)){
                    foreach ($list_rating as $key => $value) {
                        switch ($value->rate) {
                            case 1:
                                $star1++;
                                break;
                            case 2:
                                $star2++;
                                break;
                            case 3:
                                $star3++;
                                break;
                            case 4:
                                $star4++;
                                break;
                            case 5:
                                $star5++;
                                break;
                        }
                    }
                    $data_rating = [
                        'star1' => $star1,
                        'star2' => $star2,
                        'star3' => $star3,
                        'star4' => $star4,
                        'star5' => $star5
                    ];
                }
                //end data rating
                $data = [
                    'title' => base64_encode($course->name),
                    'class_name' => isset($course->isClass->name) ? base64_encode($course->isClass->name) : '',
                    'subject' => isset($course->isSubject->name) ? base64_encode($course->isSubject->name) : '',
                    'course_id' => $course->course_id,
                    'avartar' => $course->avartar != '' ? config('site.url_static') . $course->avartar : 'http://static.hocplus.vn/files/vendor/vnedutech-cms/default/hocplus/teacherfrontend/images/course.jpg',
                    'icon_gv' => '',
                    'id_gv' => '',
                    'name_gv' => '',
                    'video' => $course->video,
                    'student_limit' => $course->student_limit,
                    'student_register' => $course->student_register,
                    'time' => $course->time,
                    'number_lesson' => $course->number_lesson,
                    'price' => $course->price,
                    'will_learn' => base64_encode($course->will_learn),
                    'target' => base64_encode($course->target),
                    'request_content' => base64_encode($course->request_content),
                    'summary' => base64_encode($course->summary),
                    'list_lesson' => $data_lesson,
                    'list_course_relate' => $data_course_relate,
                    'list_rate' => $data_rating,
                    'list_comment' => $data_comment,
                    'star' => 5,
                    'check_buy' => self::checkBuyCourse($member_id,$course->course_id)

                ];
                $data_reponse = [
                    'data' => $data,
                    'success' => true,
                    'message' => 'ok!'
                ];
                return json_encode($data_reponse); 
            }else{
                return self::message(false, 'Token không hợp lệ');    
            }
        } else{
            return self::message(false, 'Thiếu tham số');     
        }         
    }

    public function listCommentCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'token' => 'required',
            'course_id' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $member_id = $request->input('member_id');
            $token = $request->input('token');
            $course_id = $request->input('course_id');
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){ //check token
                $list_comments = Comments::where('course_id','=',$course_id)->where('status',1)->with('getMember')->orderBy('updated_at')->paginate(5);
                $data = array();
                if(!empty($list_comments)){
                    foreach ($list_comments as $key => $value) {
                        $member_info_comment = $value->getMember;
                        $name_member = ($member_info_comment->name != '') ? $member_info_comment->name : $member_info_comment->email;
                        $name_member = $name_member != '' ? $name_member : $member_info_comment->phone; 
                        $data[] = [
                            'id' => $value->id,
                            'comment' => base64_encode($value->comment),
                            'name_member' => base64_encode($name_member),
                            'created_at' => $value->created_at,
                            'rate' => 5,
                            'like' => 0 
                        ];
                    }
                } 
                $data_reponse = [
                    'data' => $data,
                    'page' => $list_comments->currentPage(),
                    'total_page' => $list_comments->lastPage(),
                    'success' => true,
                    'message' => 'ok!'
                ];
                return json_encode($data_reponse); 
            }else{
                return self::message(false, 'Token không hợp lệ');    
            }
        } else{
            return self::message(false, 'Thiếu tham số');     
        }  
    }

    public function postCommentCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'token' => 'required',
            'course_id' => 'required',
            'comment' => 'required',
            'rate' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $member_id = $request->input('member_id');
            $token = $request->input('token');
            $course_id = $request->input('course_id');
            $comment = $request->input('comment');
            $rate = $request->input('rate');
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){ //check token
                $comments = new Comments();
                $comments->course_id = $course_id;
                $comments->comment = $comment;
                $comments->user_id = $member_id;
                $rating = new Rating;
                $rating->course_id = $course_id;
                $rating->rate = $rate;
                $rating->member_id = $member_id;
                if($comments->save() && $rating->save()){
                    return self::message(true, 'Comment thành công');        
                }else{
                    return self::message(false, 'Comment thất bại');    
                }
                return json_encode($data_reponse); 
            }else{
                return self::message(false, 'Token không hợp lệ');    
            }
        } else{
            return self::message(false, 'Thiếu tham số');     
        }
    }

    public function postRatingCourse(Request $request){
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
            'token' => 'required',
            'course_id' => 'required',
            'rate' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $member_id = $request->input('member_id');
            $token = $request->input('token');
            $course_id = $request->input('course_id');
            $rate = $request->input('rate');
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){ //check token
                $rate = Rating::where('course_id',$course_id)->where('member_id',$member_id)->first();
                if($rate){
                    return self::message(false, 'Bạn đã đánh giá khóa học!');  
                }
                $rating = new Rating;
                $rating->course_id = $course_id;
                $rating->rate = $rate;
                $rating->member_id = $member_id;
                if($rating->save()){
                    return self::message(true, 'Đánh giá thành công');        
                }else{
                    return self::message(false, 'Đánh giá thất bại');    
                } 
            }else{
                return self::message(false, 'Token không hợp lệ');    
            }
        } else{
            return self::message(false, 'Thiếu tham số');     
        }
    }
    
    function checkBuyCourse($member_id, $course_id){
        $status = false;
        $member = Member::find($member_id);
        if( $member->full_vip == 1 ){
            $status = true;    
        } else{
            $member_has_course = MemberHasCourse::where('member_id',$member_id)->where('course_id', $course_id)->first();
            if($member_has_course){
                $status = true;
            }
        }
        return $status;
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

    public function message($success, $message){
        $data = [
            'success' => $success,
            'message' => $message,
        ];    
        $data_encode = json_encode($data);
        return $data_encode;    
    }
}
