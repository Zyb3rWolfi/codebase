<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Socialite\Facades\Socialite;
use Response;
use Laravel\Passport\Token;
use Laravel\Passport\RefreshToken;

class AuthController extends Controller
{
    public function newRegister(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email|unique:users',
            'password'=> 'required'
        ]);

        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        $token = $user->createToken('API Token')->accessToken;
        return response([
            'user'=> $user,
            'token'=> $token

        ]);
    }

    public function newLogin(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password'=> 'required'
        ]);
        if (!Auth::attempt($data)) {
            return response([
                'message' => 'Invalid credentials '
            ], 401);
        }
        $token = Auth::user()->createToken('API Token')->accessToken;
        return response([
            'token'=> $token
            
        ], 200);
    }


    public function changeDetails(Request $request) {

        $user = Auth::user();
        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');

        $user->save();

        return response($user, 201);
    }
    public function redirectToGoogle() {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }
    public function handleGoogleCallback() {

        $user = Socialite::driver('google')->user();

        if (User::where('email', '=', $user->email)->exists() && User::where('provider', '=', 'google')->exists()) {
            $user = User::where('email', '=', $user->email)->first();
            $token = $user->createToken('API Token')->accessToken;
            return redirect('http://localhost:5173?token='.$token);
        } else {

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password'=> Hash::make($user->id),
                'provider' => 'google'
            ]);
            $token = $newUser->createToken('API Token')->accessToken;
            return redirect('http://localhost:5173?token='.$token);
        }
    }

    public function redirectToGithub() {
        return Socialite::driver('github')->with(["prompt" => "select_account"])->redirect();
    }

    public function handleGithubCallback() {
        $user = Socialite::driver('github')->user();
        if (User::where('email', '=', $user->email)->exists() && User::where('provider', '=', 'github')->exists()) {
            $user = User::where('email', '=', $user->email)->first();
            $token = $user->createToken('API Token')->accessToken;
            return redirect('http://localhost:5173?token='.$token);
        } else {
            if (User::where('email', '=', $user->email)->exists()) {
                return redirect('http://localhost:5173?error=Email already exists');
            }
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password'=> Hash::make($user->id),
                'provider' => 'github'
            ]);
            $token = $newUser->createToken('API Token')->accessToken;
            return redirect('http://localhost:5173?token='.$token);
        }
    }

    public function deleteAccount(Request $request) {
        $user = Auth::user();
        $user->delete();
        DB::table('codeblocks')->where('user_id', $user->id)->delete();
        return response([
            'message' => 'success'
        ], 200);
    }
    public function resetAuth(Request $request) {
        $user = Auth::user();
        $user->tokens()->delete();
        $user->provider = null;
        $user->save();
        return response([
            'message' => 'success'
        ], 200);
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
        if ($request->user()) {
            return response($request->user(), 200);
        }
        return response([
            'message' => 'Not logged in'
        ], 401);
    }

    public function Logout(Request $request) {
        $user = Auth::user()->token();
        $user->revoke();

        return response([
            'message' => 'logged out'
        ], 200);
    }
}
