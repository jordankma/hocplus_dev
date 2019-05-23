<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Application\Cms\Controllers\MController as Controller;
use Adtech\Core\App\Mail\Password as ActiveMailer;

use Adtech\Application\Cms\Traits\CaptchaTrait;
use Adtech\Application\Cms\Traits\ActivationTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Hocplus\Frontend\App\Models\Member;
use Mail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers, ActivationTrait, CaptchaTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

//        $this->middleware('member');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorEmail(array $data)
    {
//        $data['captcha'] = $this->captchaCheck();
        $validator = Validator::make($data, [
            'email' => 'required|unique:vne_members',
            'password' => 'required|min:6|max:30',
            'confirmPassword' => 'required|same:password'
        ], [
                'email.required' => trans('adtech-core::messages.email_required'),
                'email.unique' => trans('hocplus-frontend::messages.email_unique'),
                'email.email' => trans('adtech-core::messages.email_invalid'),
                'confirmPassword.required' => trans('hocplus-frontend::messages.confirm_password_required'),
                'confirmPassword.same' => trans('hocplus-frontend::messages.confirm_password_same'),
                'password.required' => trans('adtech-core::messages.password_required'),
                'password.min' => trans('adtech-core::messages.password_min'),
                'password.max' => trans('adtech-core::messages.password_max')
            ]
        );
        return $validator;
    }

    protected function validatorPhone(array $data)
    {
//        $data['captcha'] = $this->captchaCheck();
        $validator = Validator::make($data, [
            'phone' => 'required|unique:vne_members',
            'password' => 'required|min:6|max:30',
            'confirmPassword' => 'required|same:password'
        ], [
                'phone.required' => trans('adtech-core::messages.phone_required'),
                'phone.unique' => trans('hocplus-frontend::messages.phone_unique'),
                'phone.phone' => trans('adtech-core::messages.phone_invalid'),
                'confirmPassword.required' => trans('hocplus-frontend::messages.confirm_password_required'),
                'confirmPassword.same' => trans('hocplus-frontend::messages.confirm_password_same'),
                'password.required' => trans('adtech-core::messages.password_required'),
                'password.min' => trans('adtech-core::messages.password_min'),
                'password.max' => trans('adtech-core::messages.password_max')
            ]
        );
        return $validator;
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $data['type'] = 'student';
                $validator = $this->validator($request->all());

                if ($validator->fails()) {
//                    return redirect()->back()->withErrors($validator);
                    echo json_encode($validator->errors());
                } else {

                    if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        try {
                            $check_mail = file_get_contents('http://checkmail.vnedutech.vn/?mail=' . $data['email']);
                            $check_mail_arr = json_decode($check_mail,true);
                            // dd($check_mail_arr);
                            if($check_mail_arr['status'] == false){
                                $errors = [];
                                $errors['email'] = ['Email không hợp lệ'];
                                return json_encode($errors);    
                                
                            } 
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                        $member = Member::create([
                            'email' => $data['email'],
                            'password' => Hash::make($data['password']),
                            'type' => $data['type'],
                            'activated' => 0,
                            'status' => 1,
                            'token' => md5($data['email'] .$data['type'] .time())
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
                            echo json_encode(['success' => true]);
                        } 
                        else if(preg_match('/^[0-9]{10}+$/', $data['email'])){

                        }
                        else {
                            echo json_encode(['error' => 'Some things error!']);
                        }
                    } else {
                        echo json_encode(['error' => 'Email/SĐT không chính xác!']);
                    }

//                    $role = Role::whereName('User')->first();
//                    $user->assignRole($role);
//                    $this->initiateEmailActivation($user);
                }
            }
        } else {
            return view('modules.core.auth.register');
        }
    }

    
}
