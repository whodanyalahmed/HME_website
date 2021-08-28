<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\fee;

use Illuminate\Support\Facades\DB;

class students extends Controller
{
    public function getFeeId($id){
        // echo intval(date('Y'));
        $monthId =DB::select("SELECT month_id FROM `months` where MONTH(month_name)=? and Year(year)=?",[intval(date('m')),intval(date('Y'))]); 
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
        // return $this->getAddMonth();
        $data= $req->Input();
        $cred= [$data['email'],$data['email'],$data['password']];
        $exe = $this->getData($cred);
        // $var = json_encode($exe,true);
        // echo json_encode(get_object_vars($exe[0]));
        if(empty($exe)){
            // echo view('something',['data'=>0]);
            
            $req->session()->flash('wrongId', 'Wrong Email or Password');
            return redirect('/students/login');
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
            // return $exe[0]->s_status;
            if($exe[0]->s_status == 1){
                if(session('user')['fee_status'] == 1){
                    // return session('fee_status');
                    return view('dashboard');
                }
                else{
                    return view('s_payment',['challan'=>$challa_url]);
                }
            }
            else{
                if(session()->has('user')){
                    // session()->pull('user');
                    session()->flush();
                    $req->session()->flash('disable', $name);
                    return redirect('/students/login');
                }
            }
            
        }
        else{
            return redirect('/students/login');
        }
    }


    public function Signup(Request $req)
    {
      
        $s_id = $this->AddStudent($req);
        $req->session()->flash('new', $req->name);
        $this->GenerateFees($s_id);
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
        if($req->interest == "1" || $req->interest == "2" || $req->interest == "3"  ){
            $new->sub_interest_id = $req->sub_interest;
        }
        else{
            $new->sub_interest_id = $req->interest;
        }
        $new->s_status= 1;
        $new->is_online= 0;
        $new->s_joined_date= null;

        $new->save();
        // echo "<script>console.log('Id is: ' ".$new->id.")</script>";
        return $new->id;
    }
    public function getAddMonth(){
        $data = DB::select('SELECT count(*) as num FROM months WHERE month_name = Month(CURDATE()) and year = year(CURDATE())');
        echo json_encode($data[0]->num);
        if(!($data[0]->num > 1)){
            $data = DB::insert('insert into months(month_name,year) values (CURDATE(),CURDATE())');
            return $data;
        }
        else{
            $data = DB::select('SELECT * FROM months WHERE 
            month_name = Month(CURDATE()) 
            and 
            year = year(CURDATE())');
            return $data;
        }
    }
    public function getStudentData($s_id){
        $data = DB::select('select * from students where s_id = ?', [$s_id]);
        return $data[0];
    }
    public function getfees($id){

        $data = DB::select('select * from modules where id = ?', [$id]);
        return $data[0]->fee;
    }
    public function getAdmissionfees($id){

        $data = DB::select('select fee from interest where id = ?', [$id]);
        // echo json_encode($data);
        return $data[0]->fee;
    }
    public function GenerateFees($s_id){
        // echo $s_id;
        $data = $this->getStudentData($s_id);
        // echo json_encode($data);
        $m_id = $this->getAddMonth();
        $admission = 0;
        if($data ->is_new_admission == 1){
            // echo gettype($data->interest);
            $admission = $this->getAdmissionfees($data->interest);
        }
        $fees = $this->getfees($data->sub_interest_id);
        // echo gettype($fees);
        // echo gettype($admission);
        $total = $fees+$admission;
        $all = ["fees" => $fees,"total"=>$total];
        $fees = DB::insert('insert into fees (fees_amount, fees_paid,s_id,month_id,fee_challan_url) values (?, ?, ?, ?, ?)', [$total, 0,$s_id,$m_id,null]);
        return $all;

        

    }
}
