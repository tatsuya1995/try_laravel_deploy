<?php

namespace App\Http\Controllers\owner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\owner;

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
    protected $redirectTo = RouteServiceProvider::OWNER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:owner');
    }

    protected function guard()
    {
        return Auth::guard('owner');
    }

    public function showRegistrationForm()
    {
        return view('owner.auth.register');
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
            'nameOwner' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'imgCar' => ['required','string','max:20'],
            'nameCar' => ['required','string','max:20'],
            'numPeople' => ['required','numeric','max:20'],
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
        return Owner::create([
            'nameOwner' => $data['nameOwner'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'imgCar' => $data['imgCar'],
            'nameCar' => $data['nameCar'],
            'numPeople' => $data['numPeople'],
        ]);
    }
}
