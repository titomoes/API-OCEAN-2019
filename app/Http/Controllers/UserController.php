<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function validator_create(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    protected function validator_update(array $data)
    {
        return Validator::make($data, [
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'password' => ['string', 'min:8'],
        ]);
    }

    /**
     * Lista todos os Usuários.
     * @authenticated
     * @response 200{
     *  "id": 1,
     *  "name": "Jessica Jones",
     *  "email": "js@uea.edu.br",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        if ($users->isNotEmpty()) {
            return response()->json($users, 200);
        } else {
            return response()->json(["erro" => "01"], 404);
        }
    }

    /**
     * Salva o Usuário no Banco de Dados.
     * @authenticated
     * @bodyParam name string required O nome do usuário.
     * @bodyParam email string required O email do usuário.
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
     *  "name: The name field is required.",
     *  "name: The name may not be greater than 255 characters.",
     *  "email: The email field is required.",
     *  "email: The email may not be greater than 255 characters.",
     *  "email: The email has already been taken.",
     *  "email: The email must be a valid email address.",
     *  "password : The password field is required.",
     *  "password : The password must be at least 8 characters."
     * ]
     * }
     * @response 400{
     * "erro":"02 = No create the object"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator_create($request->all())->validate();
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        if ($user) {
            $user->generateToken();
            return response()->json($user, 201);
        } else {
            return response()->json(["erro" => "02"], 400);
        }
    }

    /**
     * Mostra um Usuário específico dado o id.
     * @authenticated
     * @queryParam user required O id do usuário.
     * @response 200{
     *  "id": 1,
     *  "name": "Jessica Jones",
     *  "email": "js@uea.edu.br",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(["erro" => "01"], 404);
        }

    }

    /**
     * Atualiza os dados de um usuário específico.
     * @authenticated
     * @queryParam user required O id do usuário.
     * @response 200{
     *  "id": 1,
     *  "name": "Jessica Jones",
     *  "email": "js@uea.edu.br",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
     * }
     * @response 404{
     * "erro":"03 = No update the object"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "name: The name may not be greater than 255 characters.",
     *  "email: The email may not be greater than 255 characters.",
     *  "email: The email must be a valid email address.",
     *  "password : The password must be at least 8 characters."
     * ]
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator_update($request->all())->validate();
        $user = User::find($id);
        if ($user) {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return response()->json($user, 200);
        } else {
            return response()->json(["erro" => "03"], 404);
        }
    }

    /**
     * Remove um usuário específico .
     * @authenticated
     * @queryParam user required O id do usuário.
     * @response 204{
     *  "data": "User Deleted"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 404{
     * "erro":"04 = No delete the object"
     * }
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(["data" => "User Deleted"], 204);
        } else {
            return response()->json(["erro" => "04"], 404);
        }
    }

    /**
     * Pesquisa um usuário por nome.
     * @authenticated
     * @queryParam name required O nome do usuário.
     * @response 200{
     *  "id": 1,
     *  "name": "Jessica Jones",
     *  "email": "js@uea.edu.br",
     *  "updated_at": "2019-04-15 12:20:44",
     *  "created_at": "2019-04-15 12:20:44",
     *  "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
     * }
     * @response 404{
     *  "erro": "01 = No query results"
     * }
     * @response 401{
     *  "message": "Unauthenticated"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors":[
     *  "name: The name may not be greater than 255 characters."
     * ]
     * }
     * @param string $name
     * @return \Illuminate\Http\Response
     */

    public function search_name($name)
    {
        $data = ['name' => $name];
        $namevalidate = Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);
        if ($namevalidate->validate()) {
            $search = User::where('name', 'like', '%' . $name . '%')->get();
            if ($search->isNotEmpty()) {
                return response()->json($search, 200);
            } else {
                return response()->json(['error' => '01'], 404);
            }
        }


    }
}

