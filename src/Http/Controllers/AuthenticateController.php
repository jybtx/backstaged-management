<?php

namespace Jybtx\Backstaged\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Jybtx\Backstaged\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthenticateController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    protected $username;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:'.config('backstaged.auth.guard'), ['except' => ['logout','showLoginForm']]);
        $this->username = config('backstaged.username');
    }
    /**
     * 重写登录验证规则
     * @author jybtx
     * @date   2019-12-27
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            self::username() => 'required',
            'password'       => 'required',
            'captcha'        => 'required|captcha'
        ]);
    }
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            array_merge(
                $this->credentials($request),
                ['is_ban'=>0]
            ),
            $request->filled('remember')
        );
    }
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended( prefixPath().DIRECTORY_SEPARATOR.'index' );
    }

    /**
     * [重写登录方法]
     * @author jybtx
     * @date   2019-12-27
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request))
        {
            return $this->sendLoginResponse($request);
        }
        else
        {
            return view('jybtx::login')->with('faild',trans('This account has been disabled, please contact the administrator!'));
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * [自定义登录界面]
     * @author jybtx
     * @date   2019-12-23
     * @return [type]     [description]
     */
    public function showLoginForm()
    {
        return view('jybtx::login');
    }
    /**
     * 重写登录验证
     * @author jybtx
     * @date   2019-12-23
     * @return [type]     [description]
     */
    public function username()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }
    /**
     * 退出系统重写
     * @author jybtx
     * @date   2019-12-24
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(config('backstaged.route.prefix').DIRECTORY_SEPARATOR.'login');
    }
    /**
     * [自定义认证驱动]
     * @author jybtx
     * @date   2019-12-23
     * @return [type]     [description]
     */
    protected function guard()
    {
        return auth()->guard(config('backstaged.auth.guard'));
    }
}