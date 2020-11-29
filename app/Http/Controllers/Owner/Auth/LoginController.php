<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::OWNER_HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
