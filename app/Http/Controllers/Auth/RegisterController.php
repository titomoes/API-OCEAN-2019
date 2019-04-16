<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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

    /**
     * @group Gerenciamento de Registro
     *
     * APIs for Gerenciar o registro
     */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Registra um Usuário.
     *
     * @bodyParam name string required O nome do usuário.
     * @bodyParam email string required O email do usuário.
     * @bodyParam password string required A senha do usuário.
     * @bodyParam password_confirmation string required A confirmação da senha do usuário.
     * @response 201{
     *  "id": 1,
     *  "name": "Jessica Jones",
     *  "email": "js@uea.edu.br",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "name: The name field is required.",
     *  "name: The name may not be greater than 255 characters.",
     *  "email: The email field is required.",
     *  "email: The email may not be greater than 255 characters.",
     *  "email: The email has already been taken.",
     *  "email: The email must be a valid email address.",
     *  "password : The password field is required.",
     *  "password : The password must be at least 8 characters.",
     *  "password : The password confirmation does not match."
     * ]
     * }
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user) ?: $this->unregistered();
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();
        return response()->json($user->toArray(), 201);
    }

    protected function unregistered()
    {
        return response()->json(['erro' => '03'], 422);
    }


}

