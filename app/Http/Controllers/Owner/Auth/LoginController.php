<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    //ゲストユーザー用のメールアドレスを定数として定義
    private const GUEST_OWNER_EMAIL ='guestowner@gmail.com';

    //ゲストログイン処理
    public function guestLogin()
    {
        $user = Owner::where('email',self::GUEST_OWNER_EMAIL)->first();
        if ($user) {
            Auth::login($user);
            return view('/owner/schedule');
        }
        return view('/owner/schedule');
    }

    protected $redirectTo = RouteServiceProvider::OWNER_HOME;


    public function __construct()
    {
        $this->middleware('guest:owner')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard('owner');
    }

    public function showLoginForm()
    {
        return view('owner.auth.login');
    }
    public function logout(Request $request)
    {
        Auth::guard('owner')->logout();
        return $this->loggedOut($request);
    }
    public function loggedOut(Request $request)
    {
        return redirect(route('owner.login'));
    }
}
