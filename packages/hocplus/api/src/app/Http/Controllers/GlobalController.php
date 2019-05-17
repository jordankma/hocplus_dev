<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Application\Cms\Controllers\AController as Controller;
use Hocplus\Api\App\Http\Controllers\Traits\Token;
use Illuminate\Http\Request;
use Validator;

class GlobalController extends Controller
{
    use Token;

    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function get(Request $request, $route_hash)
    {
        // dd('1');
        $encrypted = $this->my_simple_crypt( 'get-token?member_id=1&course_id=11&lesson_id=18&time=' . time(), 'e' );
        $decrypted = $this->my_simple_crypt( $route_hash, 'd' );
        $parts = parse_url($decrypted);

//        echo $encrypted.'<br>';
//        echo $decrypted.'<br>';die;

        $query = [];
        $data = '{
                    "status" : false,
                    "message" : "Not found!"
                }';
        if (count($parts) > 0) {
            if (isset($parts['query'])) {
                parse_str($parts['query'], $query);
            }

            $request->merge($query);
            $validator = Validator::make($request->all(), [
                'time' => 'required|numeric'
            ], $this->messages);

            if (!$validator->fails()) {

                if ((time() - $request->input('time')) < 600000) {//5
                    switch ($parts['path']) {
                        case 'verify-token'://ok
                            $data = $this->verifyToken($request)->getContent();
                            break;
                        case 'get-token'://ok
                            $data = $this->getToken($request)->getContent();
                            break;
                    }
                }
            }
        }
        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }


    public function verify(Request $request)
    {
        $data = $this->verifyToken($request)->getContent();
        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }

    public function record(Request $request)
    {
        $data = $this->recordLesson($request)->getContent();
        return response($data)->setStatusCode(200)->header('Content-Type', 'application/json; charset=utf-8');
    }
}