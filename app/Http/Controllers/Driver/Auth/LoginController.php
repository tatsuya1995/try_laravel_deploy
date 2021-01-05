<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;

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

    //ゲストユーザー用のメールアドレスを定数として定義
    private const GUEST_USER_EMAIL = 'guestdriver@gmail.com';

    //ゲストログイン処理
    public function guestLogin()
    {
        $user = Driver::where('email',self::GUEST_USER_EMAIL)->first();
        if ($user) {
            Auth::login($user);
            return redirect('/driver/search');
        }
        return redirect('/driver/search');
    }

    protected $redirectTo = RouteServiceProvider::DRIVER_HOME;


    public function __construct()
    {
        $this->middleware('guest:driver')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard('driver');
    }

    public function showLoginForm()
    {
        return view('driver.auth.login');
    }
    public function logout(Request $request)
    {
        Auth::guard('driver')->logout();
        return $this->loggedOut($request);
    }
    public function loggedOut(Request $request)
    {
        return redirect(route('driver.login'));
    }
}
