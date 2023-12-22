<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Builder;
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
use Illuminate\Support\Facades\Request as FacadesRequest;
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
        // Gets the type of login the user is trying to do
        $type = FacadesRequest::query('id');
        return Socialite::driver('google')->with(["prompt" => "select_account"])->with(["state" => $type])->redirect();
    }
    public function handleGoogleCallback() {
        // Gets the user from the provider and fetches the user ID from the database if it exists
        $user = Socialite::driver('google')->stateless()->user();
        $userId = request('state'); 

        // If the users connection exists in the database, log them in
        if (DB::table('user_providers')->where('provider_user_id', '=', $user->id)->exists() && DB::table('user_providers')->where('provider', '=', 'google')->exists()) {

            $user = User::where('email', '=', $user->email)->first();
            $token = $user->createToken('API Token')->accessToken;
            return redirect(env('VITE_URL').'?token='.$token);
        } else {

            // If the user exists however the connection does not, create the connection and log them in
            if (User::where('id', '=', $userId)->exists()) {
                DB::table('user_providers')->insert([
                    'user_id' => $userId,
                    'provider_user_id' => $user->id,
                    'provider' => 'google'
                ]);
                return redirect(env('VITE_URL').'?connection=google');
            }
            // If the user is not logged in and a record of the user connection doesn not exist with their account we do not log them in.
            if (User::where('email', '=', $user->email)->exists()) {
                return redirect(env('VITE_URL').'?error='.$userId);
            }
            // Otherwise we create a new user and log them in
            // This is where we create the user for Users table
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password'=> null,
                'provider' => 'google'
            ]);

            // This is where we create the user for user_providers table
            DB::table('user_providers')->insert([
                'user_id' => $newUser->id,
                'provider_user_id' => $user->id,
                'provider' => 'google'
            ]);

            // This is where we create the token for the user and redirect them to the front end
            $token = $newUser->createToken('API Token')->accessToken;
            return redirect(env('VITE_URL').'?token='.$token);
        }
    }

    public function redirectToGithub() {
        // Gets the type of login the user is trying to do
        $type = FacadesRequest::query('id');
        return Socialite::driver('github')->with(["state" => $type])->redirect();
    }


    public function handleGithubCallback() {
        // Gets the user from the provider and fetches the user ID from the database if it exists
        $user = Socialite::driver('github')->stateless()->user();
        $userId = request('state'); 

        // If the users connection exists in the database, log them in
        if (DB::table('user_providers')->where('provider_user_id', '=', $user->id)->exists() && DB::table('user_providers')->where('provider', '=', 'github')->exists()) {
            
                $user = DB::table('user_providers')->where('provider_user_id', '=', $user->id)->first()->user_id;
                $user = User::where('id', '=', $user)->first();
                $token = $user->createToken('API Token')->accessToken;
                return redirect(env('VITE_URL').'?token='.$token);
            
        } else {

            // If the user exists however the connection does not, create the connection and log them in
            if (User::where('id', '=', $userId)->exists()) {
                DB::table('user_providers')->insert([
                    'user_id' => $userId,
                    'provider_user_id' => $user->id,
                    'provider' => 'github'
                ]);
                return redirect(env('VITE_URL').'?connection=github');
            }
            
            // If the user is not logged in and a record of the user connection doesn not exist with their account we do not log them in.
            if (User::where('email', '=', $user->email)->exists()) {
                return redirect(env('VITE_URL').'?error='.$userId);
            }
            // Otherwise we create a new user and log them in
            // This is where we create the user for Users table
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password'=> null,
                'provider' => 'github'
            ]);

            // This is where we create the user for user_providers table
            DB::table('user_providers')->insert([
                'user_id' => $newUser->id,
                'provider_user_id' => $user->id,
                'provider' => 'github'
            ]);
            // This is where we create the token for the user and redirect them to the front end
            $token = $newUser->createToken('API Token')->accessToken;
            return redirect(env('VITE_URL').'?token='.$token);
        }
    }

    public function deleteAccount(Request $request) {
        $user = Auth::user();
        $user->delete();
        DB::table('codeblocks')->where('user_id', $user->id)->delete();
        DB::table('user_providers')->where('user_id', $user->id)->delete();
        return response([
            'message' => 'success'
        ], 200);
    }

    public function adminDeleteAccount(Request $request) {
        if (Auth::user()->admin == true) {
            $id = $request->input('id');
            DB::table('users')->where('id', $id)->delete();
            DB::table('user_providers')->where('user_id', $id)->delete();
            DB::table('codeblocks')->where('user_id', $id)->delete();
            return response([
                'message' => 'success'
            ], 200);
        }
        else {
            return response([
                'message' => 'not authed'
            ], 401);
        }
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

    public function addPassword(Request $request) {
        $user = Auth::user();
        $user->password = Hash::make($request->input('user_password'));
        $user->save();

        return response($user, 201);
    }

    public function removeGithub(Request $request) {
        
        $user = Auth::user();
        $canDelete = false;

        if (DB::table('users')->where('id', '=', $user->id)->where('password', '=', null)->exists()) {
            $data = DB::table('user_providers')->where('user_id', '=', $user->id);

            foreach($data->get() as $item) {
                if ($item->provider == 'google') {
                    $canDelete = true;
                }
            }
            if (!$canDelete) {
                return response([
                    'message' => 'You cannot remove your Github account as you have not set a password'
                ], 401);
            }
        }

        DB::table('user_providers')->where('user_id', '=', $user->id)->where('provider', '=', 'github')->delete();
        return response($user, 201);
    }

    public function removeGoogle(Request $request) {
        
        $user = Auth::user();
        $canDelete = false;

        if (DB::table('users')->where('id', '=', $user->id)->where('password', '=', null)->exists()) {
            $data = DB::table('user_providers')->where('user_id', '=', $user->id);

            foreach($data->get() as $item) {
                if ($item->provider == 'github') {
                    $canDelete = true;
                }
            }
            if (!$canDelete) {
                return response([
                    'message' => 'You cannot remove your Google account as you have not set a password'
                ], 401);
            }
        }

        DB::table('user_providers')->where('user_id', '=', $user->id)->where('provider', '=', 'google')->delete();
        return response($user, 201);
    }

    public function passwordNull(Request $request) {
        $user = Auth::user();

        if (DB::table('users')->where('id', '=', $user->id)->where('password', '=', null)->exists()) {
            return response([
                'password' => 'null'
            ], 200);
        } else {
            return response([
                'password' => 'not null'
            ], 200);
        }
    }

    public function removePassword(Request $request) {
        $data = DB::table('user_providers')->where('user_id', '=', Auth::user()->id)->get();
        $canRemove = false;
        foreach($data as $item) {
            $canRemove = true;
        }

        if (!$canRemove) {
            return response([
                'message' => 'You cannot remove your password as you have not connected any social media accounts'
            ], 401);
        }
        $user = Auth::user();
        $user->password = null;
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

    public function getConnections() {
        $user = Auth::user();
        $connections = DB::table('user_providers')->where('user_id', '=', $user->id)->get();
        return response($connections, 200);
    }
}
