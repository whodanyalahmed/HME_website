<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teacher;

use Illuminate\Support\Facades\DB;
class teachers extends Controller
{
    function Index(Request $req){
        // return $this->getAddMonth();
        $data= $req->Input();
        $cred= [$data['email'],$data['email'],$data['password']];
        $exe = $this->getData($cred);
        // $var = json_encode($exe,true);
        // echo json_encode(get_object_vars($exe[0]));
        if(empty($exe)){
            // echo view('something',['data'=>0]);
            
            $req->session()->flash('wrongId', 'Wrong Email or Password');
            return redirect('/teachers/login');
        }
        else{
            $req->session()->put('teacher', ['id'=>$exe[0]->t_id,'name'=>$exe[0]->t_name,'pass'=>$data['password'],'t_status'=>$exe[0]->t_status]);
            // return view('dashboard', ['data'=>$exe]);
            return redirect('teachers/dashboard');
            
        }
        
    }

    function Dashboard(Request $req){
        if(session('teacher')){
            $name = session('teacher')['name'];
            $cred = [$name,$name,session('teacher')['pass']];
            $exe= $this->getData($cred);
            $status=  $exe[0]->t_status;
            $req->session()->put('teacher.status',$status );
            // $feeId = $this->getFeeId(session('teacher')['id']);
            // $feeData = fee::select('fee_challan_url')
            // ->where('fee_id',$feeId)
            // ->get();
            // $challa_url = $feeData[0]->fee_challan_url;
            // return $exe[0]->s_status;
            if($exe[0]->t_status == 1){
                return view('teachers.dashboard');
            }
            else{
                if(session()->has('teacher')){
                    // session()->pull('teacher');
                    session()->flush();
                    $req->session()->flash('disable', $name);
                    return redirect('/teachers/login');
                }
            }
            
        }
        else{
            return redirect('/teachers/login');
        }
    }
    
    public function getData($cred){
        $exe = DB::select('select * from teachers where t_email = ? or t_name=? and t_password =?',$cred );
        return $exe;
    }
    public function AddTeacher($req){
        $data = $req->input();
        $new = new teacher;
        $new->t_name = $req->name;
        $new->t_email = $req->email;
        // $new->s_password = password_hash($req->password,PASSWORD_DEFAULT);
        $new->t_password = $req->password;
        
        $new->t_phone = $req->number;
        $new->t_start_timing = $req->s_time;
        $new->t_end_timing = $req->e_time;
        $new->t_status = 1;


        $new->save();
        // echo "<script>console.log('Id is: ' ".$new->id.")</script>";
        return $new->id;
    }



    public function Signup(Request $req)
    {
      
        $s_id = $this->AddTeacher($req);
        $req->session()->flash('new', $req->name);


        return redirect('teachers/login');

    }

}
