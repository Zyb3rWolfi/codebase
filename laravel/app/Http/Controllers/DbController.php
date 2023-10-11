<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public function getData(string $search) {
        $data = DB::table('sample')->where('strings', 'LIKE', '%'.$search.'%')->get();
        foreach ($data as $key => $value) {
            $data[$key] = $value;
        }
        return response()->json([
            'strings' => $data,
        ]);
    }
}
