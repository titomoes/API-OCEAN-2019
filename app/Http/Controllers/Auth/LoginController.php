<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Loga um Usuário.
     *
     * @bodyParam name string required O nome do usuário.
     * @bodyParam password string required A senha do usuário.
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
     *  "email: The email field is required.",
     *  "email: The email may not be greater than 255 characters.",
     *  "email: The email must be a valid email address.",
     *  "password : The password field is required.",
     *  "password : The password must be at least 8 characters."
     * ]
     * }
     */

    public function login(Request $request)
    {
        $this->validateLogin($request->all())->validate();

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json($user->toArray(), 200);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Desloga um Usuário.
     * @authenticated
     * @response 200{
     * "data": "User logged out."
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     */
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
            return response()->json(["data"=>'User logged out.'], 200);
        }
        return response()->json('Cant User logged out.', 500);

    }

}
