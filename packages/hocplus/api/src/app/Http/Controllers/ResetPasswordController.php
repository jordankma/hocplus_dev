<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Core\App\Mail\Password as PasswordMailer;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Adtech\Core\App\Repositories\PasswordResetRepository;
use Adtech\Core\App\Repositories\UserRepository;
use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Frontend\App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Mail;

class ResetPasswordController extends Controller
{
    private $_passwordResetRepository;

    private $_userRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository, UserRepository $userRepository)
    {
        \Debugbar::disable();
        parent::__construct();
//        $this->middleware('member');
        $this->_userRepository = $userRepository;
        $this->_passwordResetRepository = $passwordResetRepository;
    }

    /**
     * @param Request $request
     * @param String $resetToken
     */
    public function changePassword(Request $request)
    {
        $resetToken = $request->input('reset_token');
        $passwordReset = $this->_passwordResetRepository->findWhere(['token' => $resetToken])->sortBy('created_at', 0, true)->first();
        if (null == $passwordReset) {
            return self::message(false, 'Token không tồn tại');
        }

        $createAtTimestamp = strtotime($passwordReset->created_at);
        if ((time() - $createAtTimestamp) > 10 * 60000) {
            $this->_passwordResetRepository->delete($passwordReset->id);
            \Session::flash('flash_messenger', trans('adtech-core::messages.reset_password_failed'));
            return self::message(false, 'Token hết hạn');
        }

        if ($request->isMethod('post')) {
            $password = $request->input('password');
            $confirmPassword = $request->input('password_conf');

            if ($password != $confirmPassword) {
                return self::message(false, 'Hai mật khẩu không khớp nhau');
            }

            $data = [
                'password' => Hash::make($password)
            ];
            if($passwordReset->email != ''){
                Member::where('email', $passwordReset->email)->update($data);
            }
            else if($passwordReset->phone != ''){
                Member::where('phone', $passwordReset->phone)->update($data);
            }
            $this->_passwordResetRepository->delete($passwordReset->id);

            return self::message(true, 'Đổi mật khẩu thành công');
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
