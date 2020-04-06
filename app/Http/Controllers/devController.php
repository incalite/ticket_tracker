<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class devController extends Controller
{

    
    public function devs(){
        $sql = DB::select("SELECT * FROM developers");
        $result = json_decode(json_encode($sql), true);
        return view('devs')->with([
            'developers' => $result
        ]);
    }
}
