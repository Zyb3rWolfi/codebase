<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public function getData(Request $request) {
        $id = Auth::user()->id;
        if (Auth::user()) {
            $title = $request->input('title');
            $languages = $request->input('filters', []);
            if ($languages == null) {
                $results = DB::table('codeBlocks')->where('user_id', $id)->where('title', 'LIKE', '%'.$title.'%')->get();
            } else {
                $results = DB::table('codeBlocks')->where('user_id', $id)->where('title', 'LIKE', '%'.$title.'%')->whereIn('language', $languages)->get();
            }
    
            foreach ($results as $key => $value) {
                $results[$key] = $value;
            }
        }
        return response()->json([
            'strings' => $results,
        ]);
    }

    public function getUserBlocks(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $languages = $request->input('filters', []);
            if ($languages == null) {
                $results = DB::table('codeBlocks')->where('user_id', $id)->get();
            } else {
                $results = DB::table('codeBlocks')->where('user_id', $id)->whereIn('language', $languages)->get();
            }
    
            foreach ($results as $key => $value) {
                $results[$key] = $value;
            }

        }
        return response()->json([
            'strings' => $results,
        ]);
    }

    public function addBlock(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $data = DB::table('codeBlocks')->insert([
                'language' => $request->input('language'),
                'user_id' => $id,
                'title' => $request->input('title'),
                'code' => $request->input('code'),
                'description' => $request->input('description'),
            ]);
            return response()->json([
                'message' => 'success',
            ]);
        }
    }

    public function deleteBlock(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            DB::table('codeBlocks')->where('user_id', $id)->where('title', $request->input('title'))->delete();
            return response()->json([
                'message' => 'success',
            ]);
        }
    }

    public function updateBlock(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $db = DB::table('codeBlocks')->where('user_id', $id)->where('id', $request->input('id'))->update([
                'code' => $request->input('newCode'),
                'title' => $request->input('newTitle'),
                'description' => $request->input('newDescription'),
                'language' => $request->input('newLanguage'),
            ]);
            return response()->json([
                'message' => 'success',
                'db' => $db,
            ]);
        }
    }
    public function getSharedBlock(string $token) {
        $data = DB::table('codeBlocks')->where('shareToken', $token)-> get();
        foreach ($data as $key => $value) {
            $data[$key] = $value;
        }
        return response()->json([
            'strings' => $data,
        ]);
    }
    public function createShareToken(Request $request) {
            $token = bin2hex(random_bytes(16));
            $db = DB::table('codeBlocks')->where('id', $request->input('id'))->update([
                'shareToken' => $token,
            ]);
            return response()->json([
                'message' => 'success',
                'token' => $token,
                'db' => $db,
            ]);
        
    }

    public function getUserCount(Request $request) {
        if (Auth::user()->admin == true) {
            $data = DB::table('users')->count();
            return response()->json([
                'count' => $data,
            ]);
        }
        else {
            return response()->json([
                'message' => 'not authed',
            ]);
        }
    }

    public function getNewUserCount(Request $request) {
        if (Auth::user()->admin == true) {
            $data = DB::table('users')->where('created_at', 'LIKE', date("Y-m-d").'%')->count();
            return response()->json([
                'count' => $data,
            ]);
        }
        else {
            return response()->json([
                'message' => 'not authed',
            ]);
        }
    }
    public function GetUserPreviews(Request $request) {
        if (Auth::user()->admin == true) {
            $name = $request->input('name');
            if ($name == "") {
                $data = DB::table('users')->select("name","email","id")->get();
            } else {
                $data = DB::table('users')->select("name","email","id")->where("name", "LIKE", "%".$name."%")->orWhere("id", "LIKE", "%".$name."%")->get();
            }
            foreach ($data as $key => $value) {
                $data[$key] = $value;
            }
            return response()->json([
                'strings' => $data,
            ]);
        }
        else {
            return response()->json([
                'message' => 'not authed',
            ]);
        }
    }

    public function getUserDetailsByID(Request $request){
        if (Auth::user()->admin == true) {
            $id = $request->input('id');
            $data = DB::table('users')->select('created_at', 'updated_at')->where('id', $id)->get();
            foreach ($data as $key => $value) {
                $data[$key] = $value;
            }
            return response()->json([
                'strings' => $data,

            ]);
        }
        else {
            return response()->json([
                'message' => 'not authed',
            ]);
        }
    }
}
