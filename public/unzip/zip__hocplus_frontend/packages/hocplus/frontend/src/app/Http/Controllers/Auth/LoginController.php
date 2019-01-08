<?php

namespace Hocplus\Frontend\App\Http\Controllers\Auth;

use Adtech\Application\Cms\Controllers\MController as Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator, Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    private function _guard()
    {
        return Auth::guard('member');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function _authenticate(Request $request)
    {
        if (!$request->isXmlHttpRequest()) return response('404 not found', 404);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember', false);
        if ($this->_guard()->attempt(['email' => $email, 'password' => $password], $remember)) {
            $request->session()->regenerateToken();
            $this->clearLoginAttempts($request);

            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function login(Request $request)
    {
        if ($this->user) {
            $routeName = 'hocplus.frontend.index';
            return redirect()->intended(route($routeName));
        }

        if ($request->ajax()) {
            if ($request->isMethod('post')) {
                $authenticate = $this->_authenticate($request);

                echo json_encode($authenticate);
            } else {
                return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index');
            }
        } else {
            return view('HOCPLUS-FRONTEND::modules.frontend.homepage.index');
        }
    }

    public function logout(Request $request)
    {
        $this->_guard()->logout();

        \Session::flash('flash_messenger', trans('adtech-core::messages.logout_success'));

        return redirect(route('hocplus.frontend.index'));
    }
}
