<?php

namespace Hocplus\Api\App\Http\Controllers;

use Adtech\Application\Cms\Controllers\AController as Controller;
use Adtech\Core\App\Mail\Password as ActiveMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Hocplus\Frontend\App\Models\Teacher;
use Hocplus\Api\App\Models\TokenLogin;
use Hocplus\Api\App\Models\Member;
use Validator;
use Mail;
use Hocplus\Frontend\App\Http\Controllers\Auth\SmsController;

class RegisterController extends Controller
{
    private $messages = array(
        'name.regex' => "Sai định dạng",
        'required' => "Bắt buộc",
        'numeric'  => "Phải là số"
    );

    public function __construct()
    {
        \Debugbar::disable();
    }

    private function _guard()
    {
        return Auth::guard('member');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $username = $request->input('username');
            $password = $request->input('password');   
            $register = self::save($username, $password);
            $data_encode = json_encode($register);
            return $data_encode; 
        } else{
            $data = [
                'success' => false,
                'message' => 'Thiếu tham số',
            ];    
            $data_encode = json_encode($data);
            return $data_encode;    
        }
    }

    public function save($username, $password){
        $data = [
            'success' => false,
            'message' => 'Đăng ký thất bại'
        ];
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $member = Member::where('email', $username)->first();
            if($member){
                $data = [
                    'success' => false,
                    'message' => 'Email đã tồn tại mời nhập email khác'
                ];   
            } else{
                try {
                    $check_mail = file_get_contents('http://checkmail.vnedutech.vn/?mail=' . $username);
                    $check_mail_arr = json_decode($check_mail,true);
                    if($check_mail_arr['status'] == false){
                        $data = [
                            'success' => false,
                            'message' => 'Email không hợp lệ'
                        ];
                        return $data; 
                    } 
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $token = rand(1001,9999);
                $member = Member::create([
                    'email' => $username,
                    'password' => Hash::make($password),
                    'type' => 'student',
                    'activated' => 0,
                    'status' => 1,
                    'token' => $token
                ]);
                if ($member->member_id) {
                    //send mail active
                    $from = config('mail.from.address');
                    $fromName = config('mail.from.name');
                    $activeMailer = new ActiveMailer();
                    $title = 'Kích hoạt tài khoản';
                    $activeMailer->setViewFile('HOCPLUS-FRONTEND::modules.auth.mail.active_account')
                    ->with([
                        'toName' => $member->email,
                        'email' => $member->email,
                        'randomToken' => $member->token
                    ])
                    ->from($from, $fromName)
                    ->subject($title);
                    Mail::to($member->email, $member->email)->send($activeMailer);
                    $data = [
                        'success' => true,
                        'message' => 'Đăng ký thành công. Mời bạn kiểm tra email để kích hoạt tài khoản!'
                    ];
                }
            }       
        } 
        elseif (preg_match('/^[0-9]{10}+$/', $username)) {
            $member = Member::where('phone', $username)->first();
            if($member){
                $data = [
                    'success' => false,
                    'message' => 'Sdt đã tồn tại mời nhập email khác'
                ];   
            } else{
                $token = rand(1001,9999);
                $member = Member::create([
                    'phone' => $username,
                    'password' => Hash::make($password),
                    'type' => 'student',
                    'activated' => 0,
                    'status' => 1,
                    'token' => $token
                ]);
                if ($member->member_id) {
                    $phone = $username;
                    $content = 'Ma OTP xac thuc cua Quy khach la ' . $member->token .' . Chi tiet noi dung: Ma kich hoat tai khoan tren Hocplus';
                    $sms = new SmsController();
                    $sms->sendOtpSms($phone, $content);
                    // if($obj['CodeResult'] == 100){
                    //     echo json_encode(['success' => true]);   
                    // } 
                    $data = [
                        'success' => true,
                        'message' => 'Đăng ký thành công. Mời bạn kiểm tra tin nhắn để kích hoạt tài khoản!'
                    ];
                } 
            }
        } else{
            $data = [
                'success' => false,
                'message' => 'Email/Sdt không đúng định dạng'
            ];
        }
        return $data;
    }

    public function verifyReg(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'otp' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $username = $request->input('username');
            $otp = $request->input('otp');
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $member = Member::where('token',$otp)->where('email',$username)->first();
            }
            else if(preg_match('/^[0-9]{10}+$/', $username)){
                $member = Member::where('token',$otp)->where('phone',$username)->first();
            }
            if ($member) {
                $member->activated = 1;
                $member->token = '';
                if($member->save()){
                    $data = [
                        'success' => true,
                        'message' => 'Xác thực thành công mời bạn đăng nhập',
                    ];    
                    $data_encode = json_encode($data);
                    return $data_encode; 
                }
            }
            return self::message(false, 'Mã OTP không hợp lệ!');  
        } else{
            return self::message(false, 'Token không hợp lệ');  
        }
    }
    public function resendOTP(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required'
        ], $this->messages);
        if (!$validator->fails()) {
            $username = $request->input('username');
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $member = Member::where('email',$username)->first();
                if($member){
                    try {
                        $check_mail = file_get_contents('http://checkmail.vnedutech.vn/?mail=' . $username);
                        $check_mail_arr = json_decode($check_mail,true);
                        if($check_mail_arr['status'] == false){
                            return self::message(false, 'Email không hợp lệ!'); 
                        } 
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    //send mail active
                    $from = config('mail.from.address');
                    $fromName = config('mail.from.name');
                    $activeMailer = new ActiveMailer();
                    $title = 'Kích hoạt tài khoản';
                    $activeMailer->setViewFile('HOCPLUS-FRONTEND::modules.auth.mail.active_account')
                    ->with([
                        'toName' => $member->email,
                        'email' => $member->email,
                        'randomToken' => $member->token
                    ])
                    ->from($from, $fromName)
                    ->subject($title);
                    Mail::to($member->email, $member->email)->send($activeMailer);
                    return self::message(true, 'Gửi lại mã thành công!');
                } else{
                    return self::message(false, 'Tài khoản chưa đăng ký!');     
                }
            }
            else if(preg_match('/^[0-9]{10}+$/', $username)){
                $member = Member::where('phone',$username)->first();
                if($member){
                    $phone = $username;
                    $content = 'Ma OTP xac thuc cua Quy khach la ' . $member->token .' . Chi tiet noi dung: Ma kich hoat tai khoan tren Hocplus';
                    $sms = new SmsController();
                    $sms->sendOtpSms($phone, $content);
                    return self::message(true, 'Gửi lại mã thành công!');
                } else{
                    return self::message(false, 'Tài khoản chưa đăng ký!');     
                }
            }
        } else{
            return self::message(false, 'Thiếu tham số!');  
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
