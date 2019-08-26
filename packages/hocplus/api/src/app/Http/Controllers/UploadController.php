<?php

namespace Hocplus\Api\App\Http\Controllers;

use Illuminate\Http\Request;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Validator;
use Illuminate\Support\Facades\Storage;
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

    public function message($success, $message){
        $data = [
            'success' => $success,
            'message' => $message,
        ];    
        $data_encode = json_encode($data);
        return $data_encode;    
    }
}
