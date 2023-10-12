<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    public function Register(Request $request) {

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password'=> Hash::make($request->input('password'))
        ]);
        return response($user, 201);

    }

    public function Login(Request $request) {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*24); // 1 day

        return response([
            'message'=> 'success'  
        ]) -> cookie($cookie);
    }

    public function User(Request $request) {
        return Auth::user();
    }

    public function Logout(Request $request) {
        $cookie = \Cookie::forget('jwt');
        $request->user()->tokens()->delete();

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }
}
