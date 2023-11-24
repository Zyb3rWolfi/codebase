<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public function getData(string $search) {
        $id = Auth::user()->id;
        $data = DB::table('codeBlocks')->where('title', 'LIKE', '%'.$search.'%') ->where('user_id', $id) -> get();
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
            $data = DB::table('codeBlocks')->where('user_id', $id)->get();

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
}
