<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Application\Cms\Controllers\MController as Controller;
use Adtech\Application\Cms\Traits\CaptchaTrait;
use Adtech\Application\Cms\Traits\ActivationTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Hocplus\Frontend\App\Models\Member;

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
    protected function validator(array $data)
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

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $validator = $this->validator($request->all());
                if ($validator->fails()) {
//                    return redirect()->back()->withErrors($validator);
                    echo json_encode($validator->errors());
                } else {

                    if (preg_match('/^[0-9]{10}+$/', $data['email']) || filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $member = Member::create([
                            'email' => $data['email'],
                            'password' => Hash::make($data['password']),
                            'type' => $data['type'],
                            'activated' => 1,
                            'status' => 1,
                        ]);
                        if ($member->member_id) {
                            echo json_encode(['success' => true]);
                        } else {
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
