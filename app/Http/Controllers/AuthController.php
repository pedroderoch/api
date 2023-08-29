<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Registrar Novo Usuário
    public function registro(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) 
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $reponse = [
            'user' => $user,
            'token' => $token
        ];

        return response($reponse, 201);
    }

    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Login ou Senha Inválidos!'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        $reponse = [
            'user' => $user,
            'token' => $token
        ];

        return $reponse;
    }

    public function Logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout Realizado com sucesso!'
        ];
    }
}
