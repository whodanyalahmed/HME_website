<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\fee;

use Illuminate\Support\Facades\DB;

class students extends Controller
{
    public function getFeeId($id){
        $monthId =DB::select("SELECT month_id FROM `months` where MONTH(month_name)=?",[intval(date('m'))]); 
        $monthId = $monthId[0]->month_id;
        $cred = [$id,$monthId];
        
        $feeId = DB::select('select fee_id from fees where s_id=? and month_id=?',$cred);
        $feeId = $feeId[0]->fee_id;
        return $feeId;
    }
    public function Upload(Request $req)
    {   
        $name=  $req->file('file')->store('Snapshots', ['disk' => 'public']);
        

      
        $feeId = $this->getFeeId(session('user')['id']);
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
        return redirect('students/dashboard');

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
            return redirect('students/dashboard');
            
        }
        
    }

    function Dashboard(Request $req){
        if(session('user')){
            $name = session('user')['name'];
            $cred = [$name,$name,session('user')['pass']];
            $exe= $this->getData($cred);
            $status=  $exe[0]->fee_status;
            $req->session()->put('user.fee_status',$status );
            $feeId = $this->getFeeId(session('user')['id']);
            $feeData = fee::select('fee_challan_url')
            ->where('fee_id',$feeId)
            ->get();
            $challa_url = $feeData[0]->fee_challan_url;
            if(session('user')['fee_status'] == 1){
                // return session('fee_status');
                return view('dashboard');
            }
            else{
                return view('s_payment',['challan'=>$challa_url]);
            }
        }
        else{
            return redirect('/students/login');
        }
    }


    public function Signup(Request $req)
    {
      
        $this->AddStudent($req);
        $req->session()->flash('new', $req->name);
        
        return redirect('students/login');

    }

    public function AddStudent($req){
        $data = $req->input();
        $new = new student;
        $new->s_name = $req->name;
        $new->s_email = $req->email;
        // $new->s_password = password_hash($req->password,PASSWORD_DEFAULT);
        $new->s_password = $req->password;
        $new->s_co_id = 0;
        $new->s_contactno = $req->number;
        $new->onsite = $req->onsite;
        $new->qualification_id = $req->Qualification;
        $new->interest = $req->interest;
        $new->s_status= 1;
        $new->is_online= 0;
        $new->s_joined_date= null;
        $new->save();
        return $new->s_id();
    }
    public function getStudentData($s_id){
        $data = student::find($s_id);
        return $data;
    }
    public function getfees($id){

        $data = DB::select('select * from modules where id = ?', $id);
        return $data;
    }
    public function GenerateFees($s_id){
        $data = $this->getStudentData($s_id);
        if($data ->is_new_admission == 1){
            $admission = $this->getfees('6')->fee;
        }
        else{
            $admission = 0;
        }
        

    }
}
