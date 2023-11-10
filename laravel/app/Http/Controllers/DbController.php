<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public function getData(string $search) {
        $id = Auth::user()->id;
        $data = DB::table('sample')->where('title', 'LIKE', '%'.$search.'%') ->where('user_id', $id) -> get();
        foreach ($data as $key => $value) {
            $data[$key] = $value;
        }
        return response()->json([
            'strings' => $data,
        ]);
    }

    public function getUserBlocks() {
        if (Auth::user()){
            $id = Auth::user()->id;
            $data = DB::table('sample')->where('user_id', $id)->get();

            foreach ($data as $key => $value) {
                $data[$key] = $value;
            }
            return response()->json([
                'strings' => $data,
            ]);

        } else {
            return response ([
                'message' => 'error'
            ]);
        }
    }

    public function addBlock(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $data = DB::table('sample')->insert([
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
            DB::table('sample')->where('user_id', $id)->where('strings', $request->input('description'))->delete();
            return response()->json([
                'message' => 'success',
            ]);
        }
    }

    public function updateBlock(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            $db = DB::table('sample')->where('user_id', $id)->where('title', $request->input('description'))->update([
                'code' => $request->input('newCode'),
                'title' => $request->input('newDescription'),
            ]);
            return response()->json([
                'message' => 'success',
                'db' => $db,
            ]);
        }
    }
}
