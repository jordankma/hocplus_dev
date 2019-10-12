<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Core\App\Mail\Password as PasswordMailer;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Adtech\Core\App\Repositories\PasswordResetRepository;
use Adtech\Core\App\Repositories\UserRepository as UserRepository;
use Hocplus\Frontend\App\Models\Member;
use Illuminate\Http\Request;
use Hocplus\Frontend\App\Http\Controllers\Auth\SmsController;
use Mail;

class ForgotPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    private $_userRepository;

    private $_resetPasswordRepository;

    public function __construct(UserRepository $userRepository, PasswordResetRepository $passwordResetRepository)
    {
        \Debugbar::disable();
        parent::__construct();

        $this->_userRepository = $userRepository;

        $this->_resetPasswordRepository = $passwordResetRepository;
    }

    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {

            $username = $request->input('username');
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $email = $username;
                if (($user = Member::where('email', $email)->first()) == null) {
                    return self::message(false, 'Email đăng ký không tồn tại');
                }
                $from = config('mail.from.address');
                $fromName = config('mail.from.name');
    
                $title = trans('adtech-core::mail.forgot_password.title');
    
                $forgotPasswordMailer = new PasswordMailer();
                $randomToken = rand(1001,9999);
                // $resetPasswordLink = route('hocplus.frontend.auth.reset', ['token' => $randomToken = str_random(60)]);
    
                $forgotPasswordMailer->setViewFile('HOCPLUS-FRONTEND::modules.auth.mail.forgot_password')
                    ->with([
                        'toName' => $user->email,
                        'randomToken' => $randomToken
                    ])
                    ->from($from, $fromName)
                    ->subject($title);
    
                try {
                    $resetPassword = [
                        'email' => $email,
                        'token' => $randomToken,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    $this->_resetPasswordRepository->create($resetPassword);
    
                    Mail::to($user->email, $user->last_name)->send($forgotPasswordMailer);
                    \Session::flash('flash_messenger', trans('adtech-core::messages.forgot_password_success'));
                    return self::message(true, 'Vui lòng kiểm tra mail để đổi mật khẩu');
                } catch (Exception $e) {
                    return self::message(false, 'Lấy mật khẩu thất bại! Mời bạn kiểm tra lại'); 
                }
            } 
            elseif (preg_match('/^[0-9]{10}+$/', $username)) {
                $phone = $username;
                if (($user = Member::where('phone', $phone)->first()) == null) {
                    return self::message(false, 'Sdt đăng ký không tồn tại'); 
                    die();
                }
                // $resetPasswordLink = route('hocplus.frontend.auth.reset', ['token' => $randomToken = str_random(60)]);
                $randomToken = rand(1001,9999);
                $resetPassword = [
                    'phone' =>  $phone,
                    'token' => $randomToken,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $this->_resetPasswordRepository->create($resetPassword);
                $content = 'Ma OTP xac thuc cua Quy khach la ' . $randomToken .' . Chi tiet noi dung: Dat lai mat khau tai khoan tren Hocplus';
                // $content = 'Để reset tài khoản Hocplus vui lòng nhấn vào link ' . $resetPasswordLink;
                $sms = new SmsController();
                $sms->sendOtpSms($phone, $content);
                return self::message(true, 'Vui lòng kiểm tra tin nhắn để đổi mật khẩu'); 
            } else{
                return self::message(false, 'Email/Sdt không đúng định dạng');
            }
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
