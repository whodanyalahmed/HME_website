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
            $req->session()->flash('wrongId', 'Wrong Email or Password');
            return redirect('/admin/login');
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
                // return session('fee_status');\
            $data = $this->getStudentsData();
            return view('admin.dashboard',['data' => $data]);
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
        if(session('admin')){
            $data = $this->getStudentsData();
            return view('admin.allstudents', ['data'=>$data]);}
        else{
            return redirect('admin/login');
        }
    }
    public function Edit($id)
    {
        if(session('admin')){
            $data = $this->getStudentData($id);
            return $data;
            // return view('admin.EditStudent', ['data'=>$data]);
        }
        else{
            return redirect('admin/login');
        }
    }
    public function ActiveStudents()
    {
        if(session('admin')){
            $data = $this->getActiveStudentsData();
            return view('admin.ActiveStudents', ['data'=>$data]);}
        else{
            return redirect('admin/login');
        }
    }
    public function getStudentsData(){
        $data = DB::select('select *,qu.name as q_name,inte.name as i_name from students 
        inner join qualification qu on students.Qualification_id = qu.id 
        inner join interest inte on students.interest = inte.id

        ');
        // return $data;
        // echo gettype($data[0]['s_id']);
        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function getStudentData($id){
        $data = DB::select('select *,qu.name as q_name,inte.name as i_name from students 
        inner join qualification qu on students.Qualification_id = qu.id 
        inner join interest inte on students.interest = inte.id
        where s_id = '.$id);
        // return $data;
        // echo gettype($data[0]['s_id']);
        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function getActiveStudentsData(){
        // $data = DB::select('select *,qu.name as q_name,inte.name as i_name from students 
        // inner join qualification qu on students.Qualification_id = qu.id 
        // inner join interest inte on students.interest = inte.id
        // where students.s_status = 1
        // ');
        // return $data;
        // echo gettype($data[0]['s_id']);

        $data = DB::select('select st.s_id,st.s_name,st.s_email,st.fee_status,fe.fees_paid,fe.fee_challan_url as url,MONTHNAME(mon.month_name) as monthname,YEAR(mon.year) as year,inte.name from students as st
        inner join fees fe on st.s_id = fe.s_id
        inner join months mon on fe.month_id = mon.month_id
        inner join interest inte on st.interest = inte.id
        where st.s_status = 1');
        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function DeleteStudent($id)
    {
        try {
            //code...
            $data = DB::update('update students set s_status = 0 where s_id = ?', [$id]);
            return ['msg'=> 'Successfully updated'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['errorMsg'=> $th];
        }
        
    }
    public function ActiveStudent($id){
        try {
            //code...
            $data = DB::update('update students set s_status = 1 where s_id = ?', [$id]);
            return ['msg'=> 'Successfully updated'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['errorMsg'=> $th];
        }

    }
    public function notpaidStudent($id)
    {
        try {
            $data = DB::update('update students set fee_status = 0 where s_id = ?', [$id]);
            return ['msg'=> 'Successfully updated'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['errorMsg'=> $th];
        }
    }
    public function pendingStudent($id)
    {
        try {
            //code...
            $data = DB::update('update students set fee_status = 3 where s_id = ?', [$id]);
            return ['msg'=> 'Successfully updated'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['errorMsg'=> $th];
        }
    }
    public function paidStudent($id)
    {
        try {
            //code...
            $data = DB::update('update students set fee_status = 1 where s_id = ?', [$id]);
            return ['msg'=> 'Successfully updated'];
        } catch (\Throwable $th) {
            //throw $th;
            return ['errorMsg'=> $th];
        }
    }
    public function updateStudent(Request $req){


        try {
            DB::update("UPDATE `students` SET 
            s_name = ?, 
            s_co_id = ?,
            s_email=?, 
            s_password=?,
            s_contactno=?,
            fee_status=?,
            interest=?,
            Qualification_id=?,
            onsite=?,
            sub_interest_id=? WHERE `s_id` = ?", 
            [$req->name,
            $req->co_id,
            $req->email,
            $req->password,
            $req->phone,
            $req->fee_status,
            $req->interest,
            $req->qualification,
            $req->onsite,
            $req->sub_interest,
            $req->id]);

            return ["msg"=>"successfully updated ". $req->name];
    
    } 
    catch (\Throwable $th) 
    {
            
        return response( ["errorMsg"=>$th],422)
        ->header('Content-Type', 'application/json');
        // return ["errorMsg"=>$th];
    }
        


    }
}


// Query
// select st.s_name,st.s_email,st.fee_status,fe.fees_paid ,MONTHNAME(mon.month_name) as monthname,YEAR(mon.year) as year,inte.name from students as st
//         inner join fees fe on st.s_id = fe.s_id
//         inner join months mon on fe.month_id = mon.month_id
//         inner join interest inte on st.interest = inte.id
//         where st.s_id = 1000