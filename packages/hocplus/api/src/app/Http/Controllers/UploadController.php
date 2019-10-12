<?php

namespace Hocplus\Api\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Validator;
use Illuminate\Support\Facades\Storage;
use Hocplus\Api\App\Http\Controllers\TokenController;
use Hocplus\Api\App\Models\Member;

class UploadController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct(){
        \Debugbar::disable();
    }

    public function uploadDocument(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
            'user_id' => 'required',
            'type' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $file = $request->input('file');
            $user_id = $request->input('user_id');
            $type = $request->input('type');
            if($type == 'student'){
                $path_file = $request->file('file')->store(
                    'hocplus/student/'. $user_id . '/document-stream' , 'static'
                );
            } else{
                $path_file = $request->file('file')->store(
                    'hocplus/teacher/'. $user_id . '/document-stream' , 'static'
                );
            }
            $data_reponse = [
                'path_file' => config('site.url_static') . '/files' . '/' . $path_file,
                'success' => true,
                'message' => 'ok!'
            ];
            return json_encode($data_reponse);

        }else{
            return self::message(false, 'Thiếu tham số'); 
        }
    }
    public function uploadAvatarStudent(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
            'member_id' => 'required',
            'token' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $file = $request->input('file');
            $member_id = $request->input('member_id');
            $type = 'student';
            $token = $request->input('token');
            $token_controller = new TokenController();
            $status = $token_controller->checkToken($member_id, $token); 
            if($status){
                $path_file = $request->file('file')->store(
                    'hocplus/student/'. $member_id . '/avatars' , 'static'
                );
                $path_avatar = '/files' . '/' . $path_file;
                $member = Member::find($member_id);
                $member->avatar = $path_avatar;
                if($member->save()){
                    $data_reponse = [
                        'path_file' => config('site.url_static') . '/files' . '/' . $path_file,
                        'success' => true,
                        'message' => 'Upload thành công!'
                    ];
                    return json_encode($data_reponse);
                }
                return self::message(false, 'Upload thất bại');
            } else{
                return self::message(false, 'Token không hợp lệ');    
            }
        }else{
            return self::message(false, 'Thiếu tham số'); 
        }
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
