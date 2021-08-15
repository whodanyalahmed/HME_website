<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\fee;

use Illuminate\Support\Facades\DB;

class students extends Controller
{
    public function Upload(Request $req)
    {   
        $name=  $req->file('file')->store('Snapshots', ['disk' => 'public']);
        

        $monthId =DB::select("SELECT month_id FROM `months` where MONTH(month_name)=?",[intval(date('m'))]); 
        $monthId = $monthId[0]->month_id;
        $cred = [session('user')['id'],$monthId];
        
        $feeId = DB::select('select fee_id from fees where s_id=? and month_id=?',$cred);
        $feeId = $feeId[0]->fee_id;
        $feeDetails = fee::select('*')
        ->where ('fee_id',$feeId) 
        ->update(
            [
                'fee_challan_url'=>$name
            ]
            );
        
        $feeDetails = student::select('*')
        ->where ('s_id',session('user')['id']) 
        ->update(
            [
                'fee_status'=>3
            ]
            );
        $req->session()->flash('upload', session('user')['name']);
        return redirect('dashboard');

    }

    public function getData($cred){
        $exe = DB::select('select * from students where s_email = ? or s_name=? and s_password =?',$cred );
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
            $req->session()->put('user', ['id'=>$exe[0]->s_id,'name'=>$exe[0]->s_name,'pass'=>$data['password'],'fee_status'=>$exe[0]->fee_status]);
            // return view('dashboard', ['data'=>$exe]);
            return redirect('dashboard');
            
        }
        
    }

    function Dashboard(Request $req){
        if(session('user')){
            $name = session('user')['name'];
            $cred = [$name,$name,session('user')['pass']];
            $exe= $this->getData($cred);
            $status=  $exe[0]->fee_status;
            $req->session()->put('user.fee_status',$status );

            if(session('user')['fee_status'] == 1){
                // return session('fee_status');
                return view('dashboard');
            }
            else{
                return view('s_payment');
            }
        }
        else{
            return redirect('login');
        }
    }
}
