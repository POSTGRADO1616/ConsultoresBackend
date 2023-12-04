<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 


class UserController extends Controller
{
    public function login(Request $request){
        $request->validate([
            "email"=> "required|email",
            "password"=>"required"
        ]);

        $user=User::where("email","=",$request->email)->first();

        if(isset($user->id)){
            if(Hash::check($request->password,$user->password)){
                $token=$user->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "status"=> 1,
                    "msg" => "Usuario Logeado!",
                    "token_acceso" => $token
                ],200);
            }
            else{
                return response()->json([
                    "status"=>0,
                    "msg"=>"El password es incorrecto"
                ],404);
            }
        }else{
            return response()->json([
                "status"=>0,
                "msg"=>"El usuario no existe"
            ],404);
        }
    }
    public function userProfile(){
        return response()->json([
            "status"=>1,
            "msg"=>"Perfil de usuario",
            "data" => auth()->user()
        ],200);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status"=>1,
            "msg"=>"Cierre de sesion"
        ],200);
    }
}
