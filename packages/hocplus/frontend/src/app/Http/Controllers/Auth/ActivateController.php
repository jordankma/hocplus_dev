<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Core\App\Mail\Password as PasswordMailer;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Adtech\Core\App\Repositories\PasswordResetRepository;
use Adtech\Core\App\Repositories\UserRepository;
use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Frontend\App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Mail;

class ActivateController extends Controller
{
    private $_passwordResetRepository;

    private $_userRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository, UserRepository $userRepository)
    {
        parent::__construct();
//        $this->middleware('member');
        $this->_userRepository = $userRepository;
        $this->_passwordResetRepository = $passwordResetRepository;
    }

    /**
     * @param Request $request
     * @param String $resetToken
     */
    // public function activate(Request $request, $token)
    // {
    //     $member = Member::where('token',$token)->first();
    //     if(empty($member)){
    //         return redirect()->back();
    //     };
    //     $member->activated = 1;
    //     if($member->save()){
    //         $member->token = '';     
    //         $member->save();
    //         return redirect()->route('hocplus.frontend.index');   
    //     }   
    // }

    public function activate(Request $request){

        $otp = $request->input('otp');
        $username = $request->input('username');
        $member = null;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $member = Member::where('token',$otp)->where('email',$username)->first();
        }
        else if(preg_match('/^[0-9]{10}+$/', $username)){
            $member = Member::where('token',$otp)->where('phone',$username)->first();
        }
        if (null == $member) {
            echo json_encode(['success' => false]);
            die();
        }    
        $member->activated = 1;
        if($member->save()){
            echo json_encode(['success' => true,'token' => $otp]);
            die();
        }
        echo json_encode(['success' => false]);
        die();
    }
}
