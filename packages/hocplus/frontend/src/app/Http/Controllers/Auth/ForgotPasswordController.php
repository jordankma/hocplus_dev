<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Core\App\Mail\Password as PasswordMailer;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Adtech\Core\App\Repositories\PasswordResetRepository;
use Adtech\Core\App\Repositories\UserRepository as UserRepository;
use Hocplus\Frontend\App\Models\Member;
use Hocplus\Frontend\App\Models\Teacher;
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
        parent::__construct();

        $this->_userRepository = $userRepository;

        $this->_resetPasswordRepository = $passwordResetRepository;
    }
    
    public function forgot(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (($user = Member::where('email', $email)->first()) == null) {
                    \Session::flash('flash_messenger', trans('adtech-core::messages.forgot_password_email_not_found'));
                    echo json_encode(['success' => false]);
                    die();
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
                    echo json_encode(['success' => true]);
                } catch (Exception $e) {
                    echo json_encode(['success' => false]);
                }
            } else{
                $phone = $email;
                if (($user = Member::where('phone', $phone)->first()) == null) {
                    \Session::flash('flash_messenger', trans('adtech-core::messages.forgot_password_email_not_found'));
                    echo json_encode(['success' => false]);
                    die();
                }
                $randomToken = rand(1001,9999);
                // $resetPasswordLink = route('hocplus.frontend.auth.reset', ['token' => $randomToken = str_random(60)]);
                $resetPassword = [
                    'phone' =>  $phone,
                    'token' => $randomToken,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $this->_resetPasswordRepository->create($resetPassword);
                $content = 'Ma OTP xac thuc cua Quy khach la ' . $randomToken .' . Chi tiet noi dung: Dat lai mat khau tai khoan tren Hocplus';
                $sms = new SmsController();
                $sms->sendOtpSms($phone, $content);

                echo json_encode(['success' => true]);
            }
        }
    }
    public function forgotTeacher(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (($user = Teacher::where('email', $email)->first()) == null) {
                    \Session::flash('flash_messenger', trans('adtech-core::messages.forgot_password_email_not_found'));
                    echo json_encode(['success' => false]);
                    die();
                }
    
                $from = config('mail.from.address');
                $fromName = config('mail.from.name');
    
                $title = trans('adtech-core::mail.forgot_password.title');
    
                $forgotPasswordMailer = new PasswordMailer();
                $randomToken = rand(1001,9999);
                // $resetPasswordLink = route('hocplus.frontend.auth.reset-teacher', ['token' => $randomToken = str_random(60)]);
    
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
                    echo json_encode(['success' => true]);
                } catch (Exception $e) {
                    echo json_encode(['success' => false]);
                }
            } else{
                $phone = $email;
                if (($user = Teacher::where('phone', $phone)->first()) == null) {
                    \Session::flash('flash_messenger', trans('adtech-core::messages.forgot_password_email_not_found'));
                    echo json_encode(['success' => false]);
                    die();
                }
                // $resetPasswordLink = route('hocplus.frontend.auth.reset-teacher', ['token' => $randomToken = str_random(60)]);
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
                echo json_encode(['success' => true]);
            }
        }
    }
}
