<?php

namespace App\Http\Controllers\Auth;

use App\Mail\newUser;
use App\Role;
use App\Rules\InvlidEmailAddy;
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
    protected $redirectTo = '/userhome';

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
    protected function validator(array $data)
    {


        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'email-confirm' => ['required','string','email','same:email','max:255',new InvlidEmailAddy()],
            'password' => 'required|string|min:6|confirmed',
            'tribenamepve' => 'required',
            'tribenamepvp' => 'required',
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
        $code = mt_rand(1111,999999);

        $user = User::create([
            'name' => $data['name'],
            'tribeName_pvp' => $data['tribenamepvp'],
            'tribeName_pve' => $data['tribenamepve'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gem_balance' => '500',
            'regcode' => $code,
        ]);

       $user->roles()->attach('4');
       $user->permissions()->attach('8');



        /*foreach($owners as $owner){
            \Mail::to($owner->email)->send( new newUser($data['name']));
        }*/

       return $user;

    }
}
