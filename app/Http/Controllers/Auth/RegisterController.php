<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */




//Validation before inserted into the database
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'ageRange' => 'required|string|max:255',
            'userAge' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'userType' => 'required|string|max:255',
            'preferredGenre' => 'required|string|max:255',
            'profileDescription' => 'required|string|max:255',
            'soundCloudWidget' => 'required|string|max:255',
            'soundCloudProfile' => 'required|string|max:255',
            'word1' => 'required|string|max:255',
            'word2' => 'required|string|max:255',
            'word3' => 'required|string|max:255',
            'word4' => 'required|string|max:255',
            'word5' => 'required|string|max:255',
            'similarity' => 'required|string|max:255',
            'instruments' => 'required|string|max:255',


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

     //Creates a user
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'ageRange' => $data['ageRange'],
            'userAge' => $data['userAge'],
            'country' => $data['country'],
            'location' => $data['location'],
            'userType' => $data['userType'],
            'preferredGenre' => $data['preferredGenre'],
            'profileDescription' => $data['profileDescription'],
            'soundCloudWidget' => $data['soundCloudWidget'],
            'soundCloudProfile' => $data['soundCloudProfile'],
            'word1' => $data['word1'],
            'word2' => $data['word2'],
            'word3' => $data['word3'],
            'word4' => $data['word4'],
            'word5' => $data['word5'],
            'similarity' => $data['similarity'],
            'instruments' => $data['instruments'],
        ]);
    }
}
