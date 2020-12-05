<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner;

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
            'iconOwner' => ['required','file','image'],
            'imgCar' => ['required','file','image'],
            'nameCar' => ['required','string','max:20'],
            'numPeople' => ['required','numeric','min:1','max:20'],
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
        $pathOwner = $data['iconOwner']->store('public');
        $iconOwner = basename($pathOwner);
        $pathCar = $data['imgCar']->store('public');
        $imgCar = basename($pathCar);

        return Owner::create([
            'nameOwner' => $data['nameOwner'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'iconOwner' => $iconOwner,
            'imgCar' => $imgCar,
            'nameCar' => $data['nameCar'],
            'numPeople' => $data['numPeople'],
        ]);
    }
}
