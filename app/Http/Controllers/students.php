<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

use Illuminate\Support\Facades\DB;

class students extends Controller
{
    function Index(Request $req){
        $data= $req->Input();
        $cred= [$data['email'],$data['email'],$data['password']];
        $exe = DB::select('select * from students where s_email = ? or s_name=? and s_password =?',$cred );
        
        // $var = json_encode($exe,true);
        // echo json_encode(get_object_vars($exe[0]));
        $req->session()->put('user', $exe[0]->s_name);
        if(empty($exe)){
            echo "Cant find student";
        }
        else{
            return view('dashboard', ['data'=>$exe]);
            
        }
        
    }

    function Dashboard(Request $req){
        if(session('user')){

            return view('dashboard');
        }
        else{
            return redirect('login');
        }
    }
}
