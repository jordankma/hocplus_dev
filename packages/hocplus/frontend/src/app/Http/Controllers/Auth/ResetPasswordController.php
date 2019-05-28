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

class ResetPasswordController extends Controller
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
    public function reset(Request $request, $resetToken)
    {
        $passwordReset = $this->_passwordResetRepository->findWhere(['token' => $resetToken])->sortBy('created_at', 0, true)->first();
        if (null == $passwordReset) {
//            return redirect(route('adtech.core.auth.login'));
            echo json_encode(['success' => false]);
            die();
        }

        $createAtTimestamp = strtotime($passwordReset->created_at);
        if ((time() - $createAtTimestamp) > 10 * 60000) {
            $this->_passwordResetRepository->delete($passwordReset->id);
            \Session::flash('flash_messenger', trans('adtech-core::messages.reset_password_failed'));
//            return redirect(route('adtech.core.auth.forgot'));
            echo json_encode(['success' => false]);
            die();
        }

        if ($request->isMethod('post')) {
            $password = $request->input('inputPassword');
            $confirmPassword = $request->input('inputConfirmPassword');

            if ($password != $confirmPassword) {
                echo json_encode(['success' => false]);
                die();
            }

            $data = [
                'password' => Hash::make($password)
            ];
//            $this->_userRepository->update($data, $passwordReset->email, 'email');
            if($passwordReset->email != ''){
                Member::where('email', $passwordReset->email)->update($data);
                Teacher::where('email', $passwordReset->email)->update($data);
            }
            else if($passwordReset->phone != ''){
                Member::where('phone', $passwordReset->phone)->update($data);
                Teacher::where('phone', $passwordReset->phone)->update($data);
            }
            $this->_passwordResetRepository->delete($passwordReset->id);

            echo json_encode(['success' => true]);
//             $from = config('mail.from.address');
//             $fromName = config('mail.from.name');

//             $title = trans('adtech-core::mail.reset_password.title');

//             $resetPasswordMailer = new PasswordMailer();
//             $resetPasswordMailer->setViewFile('modules.core.auth.mail.reset_password')
//                 ->with([
//                     'toName' => $passwordReset->email,
//                     'email' => $passwordReset->email,
//                     'loginLink' => route('adtech.core.auth.login')
//                 ])
//                 ->from($from, $fromName)
//                 ->subject($title);

//             try {
//                 Mail::to($passwordReset->email, $passwordReset->email)->send($resetPasswordMailer);
//                 \Session::flash('flash_messenger', trans('adtech-core::messages.reset_password_success'));
// //                return redirect(route('adtech.core.auth.login'));
//                 echo json_encode(['success' => true]);
//             } catch (Exception $e) {
//                 echo json_encode(['success' => false]);
//             }
        }

//        return view('modules.core.auth.forgot-password-confirm');
    }
}
