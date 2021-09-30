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

    public function Upcoming(Request $req)
    {
        if(session('admin')){
            $data = $this->getupcomingData();
            // echo json_encode($data); 
            return view('admin.upcoming',['data' => $data]);
            // }
            // else{
            //     return view('s_payment',['challan'=>$challa_url]);
            // }
        }
        else{
            return redirect('/admin/login');
        }
    }
    public function classes(Request $req)
    {
        if(session('admin')){
            $data = $this->getCoursesData();
            $teachers = $this->GetTeachersData();

            // echo json_encode($data); 
            return view('admin.classes',['data' => $data,'teachers'=>$teachers]);
            // }
            // else{
            //     return view('s_payment',['challan'=>$challa_url]);
            // }
        }
        else{
            return redirect('/admin/login');
        }
    }
    public function admissionfee(Request $req)
    {
        if(session('admin')){
            $data = $this->GetAdmissionFeeDetails();
            return view('admin.admissionfee',['data' => $data]);

        }
        else{
            return redirect('/admin/login');
        }
    }
    public function coursesfee(Request $req)
    {
        if(session('admin')){
            $data = $this->GetCoursesFeeDetails();
            return view('admin.coursesfee',['data' => $data]);

        }
        else{
            return redirect('/admin/login');
        }
    }
    public function feedback(Request $req)
    {
        if(session('admin')){
            $data = $this->GetFeedbackDetails();
            return view('admin.feedback',['data' => $data]);

        }
        else{
            return redirect('/admin/login');
        }
    }
    public function Activity(Request $req)
    {
        if(session('admin')){
            $data = $this->GetActivityDetails();
            return view('admin.activity',['data' => $data]);

        }
        else{
            return redirect('/admin/login');
        }
    }
    public function careers(Request $req)
    {
        if(session('admin')){
            $data = $this->GetCareersDetails();
            return view('admin.careers',['data' => $data]);

        }
        else{
            return redirect('/admin/login');
        }
    }
    public function news(Request $req)
    {
        if(session('admin')){
            $data = $this->GetNewsDetails();
            return view('admin.news',['data' => $data]);

        }
        else{
            return redirect('/admin/login');
        }
    }
    public function GetAdmissionFeeDetails()
    {
        $data = DB::select('select * from interest');

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function GetNewsDetails()
    {
        $data = DB::select('select * from news');

        $data = json_decode(json_encode($data),true);
        return $data;
    }
   
    public function GetCoursesFeeDetails()
    {
        $data = DB::select('select * from modules WHERE id NOT IN ( select id from modules where parent=0)');

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function getCoursesData()
    {
        $data = DB::select('select * from course co 
        inner join teachers te on co.t_id = te.t_id
        where course_status = 1
            ');

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function GetFeedbackDetails()
    {
        $data = DB::select('select * from contactus');

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function GetActivityDetails()
    {
        $data = DB::select('SELECT * FROM `daily_logs` 
        inner join teachers te on daily_logs.t_id = te.t_id
        inner join course co on course_id = co.id');

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function GetTeachersData()
    {
        $data = DB::select('select * from teachers where t_status = 1');

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function GetCareersDetails()
    {
        $data = DB::select('select * from careers');

        $data = json_decode(json_encode($data),true);
        return $data;
    }

    public function UpcomingUpdate(Request $req)
    {
        try {
            $id = $req->id;
            $name = $req->name;
            $e_timing = $req->e_time;
            $s_timing = $req->s_time;
            $contact= $req->contact;
            DB::update('update upcoming_teachers set name=?,s_timing = ?,e_timing =?, contact =? where id= ?', [$name,$s_timing,$e_timing,$contact,$id]);
            return ["msg"=>"Successfully updated information"];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
        
    }
    public function admissionfeeUpdate(Request $req)
    {
        try {
            $id = $req->id;
            $fee = $req->fee;
            DB::update('update interest set fee =? where id= ?', [$fee,$id]);
            return ["msg"=>"Successfully updated information"];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
        
    }
    public function coursesfeeUpdate(Request $req)
    {
        try {
            $id = $req->id;
            $fee = $req->fee;
            DB::update('update modules set fee =? where id= ?', [$fee,$id]);
            return ["msg"=>"Successfully updated information"];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
        
    }
    public function newsUpdate(Request $req)
    {
        try {
            $id = $req->id;
            $message = $req->message;
            $heading = $req->heading;
            DB::update('update news set Heading =? , message =? where id= ?', [$heading,$message,$id]);
            return ["msg"=>"Successfully updated information"];
        } catch (\Throwable $th) {
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
            return ["errorMsg"=>json_encode($th)];
        }
        
    }
    public function updateTeacher(Request $req)
    {
        try {
            $id = $req->id;
            $f_id = $req->from_teacher;
            $t_id = $req->to_teacher;
            DB::update('update course set t_id =?  where id= ? ', [$t_id,$id]);
            return ["msg"=>"Successfully updated class " .$id." to teacher id ".$t_id];
        } catch (\Throwable $th) {
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
        }
        
    }
    public function newsDelete(Request $req)
    {
        try {
            $id = $req->id;
            DB::update('delete from news where id= ?', [$id]);
            return ["msg"=>"Successfully deleted"];
        } catch (\Throwable $th) {
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
            return ["errorMsg"=>json_encode($th)];
        }
        
    }
    public function UpcomingCreate(Request $req)    
    {
        try {
            $id = $req->id;
            $name = $req->name;
            $e_timing = $req->e_time;
            $s_timing = $req->s_time;
            $contact= $req->contact;
            DB::update('insert into upcoming_teachers (name,s_timing,e_timing,contact) Values(?,?,?,?)', [$name,$s_timing,$e_timing,$contact]);
            return ["msg"=>"Successfully added"];
        } catch (\Throwable $th) {
            return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
    }
    public function newsCreate(Request $req)    
    {
        try {
            $message= $req->message;
            $heading= $req->heading;
            DB::update('insert into news (Heading,message) Values(?,?)', [$heading,$message]);
            return ["msg"=>"Successfully added"];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
    }
    public function courseCreate(Request $req)    
    {
        try {
            $name= $req->course;
            if($req->parent){
                $id = DB::table('modules')->insertGetId(
                    [
                        'name'=>$name,
                        'parent'=>0,
                        'fee' => 0
                    ]
                    );
                $data= DB::insert('insert into interest (id,name,fee) Values(?,?,5000)', [$id,$name]);
            }
            else{
                $data = DB::insert('insert into modules (name,parent,fee) values (?, ?,?)', [$name,$req->parentName,$req->fees]);
                
            }
            
            return ["msg"=>"Successfully added"];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
    }
    public function getupcomingData()
    {
        $data = DB::select('select * from upcoming_teachers');

        $data = json_decode(json_encode($data),true);
        return $data;
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

        $data = DB::select('select st.s_id,st.s_name,st.s_email,st.fee_status,mo.name as modname,fe.fee_arrears,fe.fees_amount,fe.fee_id,fe.fees_paid,fe.fee_challan_url as url,MONTHNAME(mon.month_name) as monthname,YEAR(mon.year) as year,inte.name from students as st
        inner join fees fe on st.s_id = fe.s_id
        inner join months mon on fe.month_id = mon.month_id
        inner join interest inte on st.interest = inte.id
        left join modules mo on st.sub_interest_id = mo.id
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
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
        
    }
    public function ActiveStudent($id){
        try {
            //code...
            $data = DB::update('update students set s_status = 1 where s_id = ?', [$id]);
            return ['msg'=> 'Successfully updated'];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }

    }
    public function notpaidStudent($id,Request $req)
    {
        try {
            $data = DB::update('update students set fee_status = 0 where s_id = ?', [$id]);
            DB::update('update fees set fees_paid = 0 where fee_id = ?', [$req->fee_id]);
            return ['msg'=> 'Successfully changed to not paid'];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
    }
    public function pendingStudent($id)
    {
        try {
            //code...
            $data = DB::update('update students set fee_status = 3 where s_id = ?', [$id]);
            return ['msg'=> 'Successfully added to pending'];
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
        }
    }
    public function paidStudent($id,Request $req)
    {
        try {
            //code...
            DB::update('update fees set fees_paiddate=current_date(), fees_paid = 1 where fee_id = ?', [$req->fee_id]);
            DB::update('update students set fee_status = 1 where s_id = ?', [$req->id]);
           
            return ['msg'=> 'Successfully paid'];
            
        } catch (\Throwable $th) {
              return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
                return ["errorMsg"=>json_encode($th)];
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
        return ["errorMsg"=>$th];
    }
        


    }


    public function Contactus(Request $req)
    {
        try {
            $name = 
            DB::insert('insert into contactus (name,email,message) values (?, ?, ?)', 
            [
                $req->name,
                $req->email,
                $req->message
            ]);
            return ["msg"=>"successfully sent "];
    
        } 
        catch (\Throwable $th) 
        {
                
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
            return ["errorMsg"=>$th];
        }
    }
}


// Query
// select st.s_name,st.s_email,st.fee_status,fe.fees_paid ,MONTHNAME(mon.month_name) as monthname,YEAR(mon.year) as year,inte.name from students as st
//         inner join fees fe on st.s_id = fe.s_id
//         inner join months mon on fe.month_id = mon.month_id
//         inner join interest inte on st.interest = inte.id
//         where st.s_id = 1000