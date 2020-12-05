<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;
use Storage;
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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DRIVER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:driver');
    }

    protected function guard()
    {
        return Auth::guard('driver');
    }

    public function showRegistrationForm()
    {
        return view('driver.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nameDriver' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'iconDriver' => ['required','file','image',],
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        //ファイル内に保存
        // $pathDriver = $data['iconDriver']->store('public');
        // $iconDriver = basename($pathDriver);
        
        $iconDriver = $data['iconDriver'];
        $pathIconDriver = Storage::disk('s3')->putFile('/laravel.s3',$iconDriver,'public');

            return Driver::create([
            'nameDriver' => $data['nameDriver'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'iconDriver' => Storage::disk('s3')->url($pathIconDriver),
        ]);
    }
}
