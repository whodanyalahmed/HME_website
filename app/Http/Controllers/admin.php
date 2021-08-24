<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\student;
class admin extends Controller
{
    public function getData($cred){
        $exe = DB::select('select * from admins where a_email = ? or a_name=? and a_password =?',$cred );
        return $exe;
    }
    function Index(Request $req){
        $data= $req->Input();
        $cred= [$data['email'],$data['email'],$data['password']];
        $exe = $this->getData($cred);
        // $var = json_encode($exe,true);
        // echo json_encode(get_object_vars($exe[0]));
        if(empty($exe)){
            echo view('something',['data'=>0]);
        }
        else{
            $req->session()->put('admin', ['id'=>$exe[0]->id,'name'=>$exe[0]->a_name,'pass'=>$data['password']]);
            // return view('dashboard', ['data'=>$exe]);
            return redirect('admin/dashboard');
            // return 'Logged in succesfully';
            
        }
        
    }
    function Dashboard(Request $req){
        if(session('admin')){
            // if(session('user')['fee_status'] == 1){
                // return session('fee_status');
            return view('admin.dashboard');
            // }
            // else{
            //     return view('s_payment',['challan'=>$challa_url]);
            // }
        }
        else{
            return redirect('/admin/login');
        }
    }
    public function pending()
    {
        $data = student::select('*')
        ->where('fee_status',3)
        ->get();
        return view('admin.pending');
    }
    public function All()
    {
        $data = DB::select('select *,qu.name as q_name,inte.name as i_name from students 
        inner join qualification qu on students.Qualification_id = qu.id
        inner join interest inte on students.interest = inte.id');
        // return $data;
        // echo gettype($data[0]['s_id']);
        $data = json_decode(json_encode($data),true);
        return view('admin.allstudents', ['data'=>$data]);
    }
    
}
