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
                $courses = $this->GetCourses(session('teacher')['id']);
                return view('teachers.dashboard',["courses"=>$courses]);
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

    public function CreateClass(Request $req)
    {
        try {

            $selected = $req->all(); 
            $students = $selected['students'];
            
            $id = DB::table('course')->insertGetId 
            (array(
                'name'=>$req['name'],
                't_id'=>$req['t_id'],
                'module_id'=>$req['module'],
                'course_status' => 1
                )
            );

            foreach ($students as $ele) 
            {
                DB::table('class')->insert(
                    array('course_id' => $id, 's_id' => $ele)
                );
            }
        
        
            // return ["msg"=>$ele];
            return ["msg"=>"Successfully Created Class"];
    
        } 
        catch (\Throwable $th) 
        {
                
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
            return ["errorMsg"=>json_encode($th)];
        }
    }


    public function GetCourses($id)
    {
        $data = DB::select("SELECT co.id as c_id,co.name as course,mo.name as module,mo.id FROM course co 
        inner join modules mo on co.module_id = mo.id 
        -- inner join class on co.id = class.course_id
        where co.t_id = ? and co.course_status = 1 ", [$id]);

        for ($i=0; $i < sizeof($data); $i++) { 
            # code...
            // echo $i;
            $no = DB::select("SELECT count(*) as noofstudents FROM `class` where course_id = ?", 
            [$data[$i]->c_id])
            [0]->noofstudents
            ;

            // echo json_encode($no);
            $data[$i]->noofstudents = $no;
        }
        
        return $data;
    }
    public function GetCourse($id,$t_id)
    {
        $data = DB::select("SELECT * FROM `course` where id=? and t_id=?", [$id,$t_id]);
        return $data[0];
    }
    public function DeleteClass(Request $req)
    {
        try {
            // DB::table('class')->where('course_id',$req['id'])->delete();
            DB::table('course')->where('id',$req['id'])->update(['course_status'=>0]);

            return ["msg"=>"Successfully Deleted"];
            
        } catch (\Throwable $th) {
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
            return ["errorMsg"=>json_encode($th)];
        }
    }
    public function Punchin($c_id,$id)
    {
        try {
            date_default_timezone_set('Asia/Karachi');
            DB::table('daily_logs')
            ->insert(["t_id"=>$id,"punchin"=>date_create(),"punchout"=>null,"course_id"=>$c_id]);
            
            // return ['msg' =>date_timestamp_get()];
            return ["msg"=>"Successfully punched in ".$id];
            
        } catch (\Throwable $th) {
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
            return ["errorMsg"=>json_encode($th)];
        }

    }
    public function Punchout($c_id,$id)
    {
        try {
            // DB::table('daily_logs')
            // ->where("t_id",$id)
            // ->where("Date(punchin)","current_date()")
            // ->update(['punchout'=>date_create()]);
            DB::update('update daily_logs set punchout = ? where t_id = ? and course_id =? and Date(punchin) = current_date()', [date_create(),$id,$c_id]);
            
            // return ['msg' =>date_timestamp_get()];
            return ["msg"=>"Successfully punched in ".$id];
            
        } catch (\Throwable $th) {
            return response( ["errorMsg"=>$th],422)
            ->header('Content-Type', 'application/json');
            return ["errorMsg"=>json_encode($th)];
        }

    }
    public function getPunchin($id,$c_id){
        $data = DB::select('select count(punchin) as punchin from daily_logs where t_id = ? and course_id =? and Date(punchin) =CURRENT_DATE()', [$id,$c_id]);
        return $data[0]->punchin;
    }
    public function getPunchout($id,$c_id){
        $data = DB::select('select count(punchout) as Punchout from daily_logs where t_id = ? and course_id =? and Date(punchout) = CURRENT_DATE()', [$id,$c_id]);
        return $data[0]->Punchout;
    }


    public function ClassView($id,Request $req)
    {
        $name = session('teacher')['name'];
        $cred = [$name,$name,session('teacher')['pass']];
        $exe= $this->getData($cred);
        if(session('teacher')){
            if($exe[0]->t_status == 1){
                
                $punchin = $this->getPunchin(session('teacher')['id'],$id);
                $punchout = $this->getPunchout(session('teacher')['id'],$id);
                $req->session()->put('teacher.punchin', $punchin);
                $req->session()->put('teacher.punchout', $punchout);
                $course = $this->GetCourse($id,session('teacher')['id']);
                return view('teachers.class',['course'=>$course]);
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
}
