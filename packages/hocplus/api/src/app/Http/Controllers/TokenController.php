<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Application\Cms\Controllers\AController as Controller;
use Illuminate\Http\Request;
use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Api\App\Models\TokenLogin;

class TokenController extends Controller
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
    public function __construct()
    {
        \Debugbar::disable();
    }

    public function checkToken($member_id, $token){
        $status = false;
        $token_login = TokenLogin::where('member_id', $member_id)->where('token', $token)->first();
        if($token_login){
            $status = true;
        }
        return $status;
    }
}
