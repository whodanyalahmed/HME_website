<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Common extends Controller
{
    public function Index(Request $req){
        return view('welcome');
    } 
}
