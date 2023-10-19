<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public function getData(string $search) {
        $id = Auth::user()->id;
        $data = DB::table('sample')->where('strings', 'LIKE', '%'.$search.'%') ->where('id', $id) -> get();
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
            $data = DB::table('sample')->where('id', $id)->get();

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
                'id' => $id,
                'strings' => $request->input('description'),
                'content' => $request->input('code'),
            ]);
            return response()->json([
                'message' => 'success',
            ]);
        }
    }

    public function deleteBlock(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            DB::table('sample')->where('id', $id)->where('strings', $request->input('description'))->delete();
            return response()->json([
                'message' => 'success',
            ]);
        }
    }

    public function updateBlock(Request $request) {
        if (Auth::user()) {
            $id = Auth::user()->id;
            DB::table('sample')->where('id', $id)->where('strings', $request->input('before_description'))->update([
                'content' => $request->input('code'),
                'strings' => $request->input('description'),
            ]);
            return response()->json([
                'message' => 'success',
            ]);
        }
    }
}
