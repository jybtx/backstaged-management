<?php

namespace Jybtx\Backstaged\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Jybtx\Backstaged\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
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
    protected $redirectTo = '/home';

	protected $username;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest:admin', ['except' => 'logout']);
        $this->username = config('backstaged.username');
    }
    public function login(Request $request)
    {
    	return View::make('test');
    }
    /**
     * [自定义登录界面]
     * @author jybtx
     * @date   2019-12-23
     * @return [type]     [description]
     */
    public function showLoginForm()
    {
        return view('jybtx::test');
        // return View::make('test');
    }
    /**
     * [自定义认证驱动]
     * @author jybtx
     * @date   2019-12-23
     * @return [type]     [description]
     */
    protected function guard()
    {
        return auth()->guard(config('backstaged.guards.admin'));
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
        $request->session()->flush();
        $request->session()->regenerate();   
        return redirect('backstaged/login');
    }
}