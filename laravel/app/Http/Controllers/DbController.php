<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
{
    public function getData() {
        $data = DB::table('sample')->pluck('strings');
        return response()->json(["search_results"=>["names"=>$data]], 200);
    }
}
