<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = $request->validate([
             'name' => 'required|string',
             'email' => 'required|email|unique:users',
             'password' => 'required|string|confirmed'
         ]);
 
         $user = User::create([
             'name' => $validate['name'],
             'email' => $validate['email'],
             'password' => Hash::make($validate['password']) 
         ]);
 
         $token = $user->createToken(('auth_token'))->plainTextToken;
 
        
 
         return response()->json([
             'user' => $user,
             'token' => $token
         ], 201);
     }
 
     public function login(Request $reqeust){
         $validate = $reqeust->validate([
             'email' => 'required|email',
             'password' => 'required|string'
         ]);
 
         $user = User::where('email', $validate['email'])->first();
 
         if(!$user || !Hash::check($validate['password'], $user->password)){
             throw ValidationException::withMessages([
                 'email' => ['The provided credentials are incorrect']
             ]);
         }
 
         $token = $user->createToken(('auth_token'))->plainTextToken;
 
         return response()->json([
             'user' => $user,
             'token' => $token
         ], 201);
     }
 
     public function logout(Request $request){
         $request->user()->currentAccessToken()->delete();
         return response()->json(['message' => 'Logged out'], 200);
     }
}
