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
                $token = str_random('60');
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
                    $activeMailer->setViewFile('modules.core.auth.mail.active_account')
                    ->with([
                        'toName' => $member->email,
                        'email' => $member->email,
                        'activeLink' => route('hocplus.frontend.auth.activate',$member->token)
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
                $token = str_random('60');
                $member = Member::create([
                    'phone' => $username,
                    'password' => Hash::make($data['password']),
                    'type' => 'student',
                    'activated' => 0,
                    'status' => 1,
                    'token' => $token
                ]);
                if ($member->member_id) {
                    $activeLink = route('hocplus.frontend.auth.activate',$member->token);
                    $phone = $username;
                    $content = 'Để kích hoạt tài khoản Hocplus vui lòng nhấn vào link ' . $activeLink;
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


}
