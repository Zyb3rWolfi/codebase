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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\RateLimiter;
use Response;

class AuthController extends Controller
{
    public function Register(Request $request) {

        if (User::where('email', '=', $request->input('email'))->exists()) {
            return response([
                'message' => 'Email already exists'
            ], 409);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password'=> Hash::make($request->input('password'))
        ]);
        return response($user, 201);

    }

    public function changeDetails(Request $request) {

        $user = Auth::user();
        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');

        $user->save();

        return response($user, 201);
    }

    public function Login(Request $request) {


        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials '
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*24); // 1 day

        return response([
            'message'=> 'success'  
        ]) -> withCookie($cookie);
    }

    public function changePassword(Request $request) {
        $user = Auth::user();

        $currentPassword = Auth::user()->password;

        if (!(Hash::check($request->input('user_password'), $currentPassword))) {
            return response([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }
        $user->password = Hash::make($request->input('user_new_password'));
        $user->save();

        return response($user, 201);
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
