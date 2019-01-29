<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Core\App\Mail\Password as PasswordMailer;
use Adtech\Application\Cms\Controllers\MController as Controller;
use Adtech\Core\App\Repositories\PasswordResetRepository;
use Adtech\Core\App\Repositories\UserRepository as UserRepository;
use Hocplus\Frontend\App\Models\Member;
use Illuminate\Http\Request;
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

            if (($user = Member::where('email', $email)->first()) == null) {
                \Session::flash('flash_messenger', trans('adtech-core::messages.forgot_password_email_not_found'));
//                return redirect(route('adtech.core.auth.forgot'));
                echo json_encode(['success' => false]);
                die();
            }

            $from = config('mail.from.address');
            $fromName = config('mail.from.name');

            $title = trans('adtech-core::mail.forgot_password.title');

            $forgotPasswordMailer = new PasswordMailer();
            $resetPasswordLink = route('hocplus.frontend.auth.reset', ['token' => $randomToken = str_random(60)]);

            $forgotPasswordMailer->setViewFile('modules.core.auth.mail.forgot_password')
                ->with([
                    'toName' => $user->email,
                    'resetPasswordLink' => $resetPasswordLink
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
//                return redirect(route('adtech.core.auth.forgot'));
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false]);
            }
        }

//        return view('ADTECH-CORE::modules.core.auth.forgotpwd');
    }
}
