<?php

namespace App\Http\Controllers;

use App\Models\Usersapis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request){
        $fields=$request->validate([
            'name' => 'required|string|min:3|max:50',
            'lastname' => 'required|string|min:3|max:51',
            'email' => ['required','string','email','unique:usersapis','regex:/(.*)@(gmail|yahoo|outlook)\.com/i'],
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user=Usersapis::create([
            'name' => $fields['name'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);
        $token=$user->createToken('api_token')->plainTextToken;
        $response=[
            'user'=>$user,
            'token' =>$token
        ];
        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message'=>'Logged out'
        ];
    }
    public function login(Request $request){
        $fields=$request->validate([
            'email' => ['required','string'],
            'password' => 'required|string|min:8'
        ]);
        $user=Usersapis::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response(['message'=>'wrong credentials'],401);
        }
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>[
                'name'=>$user['name'],
                'lastname'=>$user['lastname'],
                'email'=>$user['email'],
                'updated_at'=>$user['updated_at']],
            'token' =>$token
        ];
        return response($response, 201);
    }
}
