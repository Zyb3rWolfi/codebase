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
}
