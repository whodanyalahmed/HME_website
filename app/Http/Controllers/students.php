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
    public function getSubCourses($id){
        $exe = DB::select('select * from modules where parent = ? order by id ASC',[$id] );
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
            $this->GenerateFeesAll(session('user')['id']);
            $cred = [$name,$name,session('user')['pass']];
            $exe= $this->getData($cred);
            $status=  $exe[0]->fee_status;
            $total_payable = $this->getPayableFees(session('user')['id']);
            $req->session()->put('user.payable_fee', $total_payable);
            $req->session()->put('user.fee_status',$status );
            // $feeId = $this->getFeeId(session('user')['id']);
            // $feeData = fee::select('fee_challan_url')
            // ->where('fee_id',$feeId)
            // ->get();
            // $challa_url = $feeData[0]->fee_challan_url;
            // return $exe[0]->s_status;
            if($exe[0]->s_status == 1){
                if(session('user')['fee_status'] == 1){
                    $courses = $this->GetCourses(session('user')['id']);
                    // return session('fee_status');
                    return view('dashboard',['courses'=>$courses]);
                }
                else{
                    return view('s_payment');
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
        $month = date("m");
        $year = date("Y");
        $m_id = $this->getAddMonth($month,$year);

        $this->GenerateFees($s_id,$m_id);
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
        $new->s_joined_date= date("Y-m-d");

        $new->save();
        // echo "<script>console.log('Id is: ' ".$new->id.")</script>";
        return $new->id;
    }
    public function getAddMonth($month,$year){
        $data = DB::select('SELECT count(*) as num FROM months WHERE Month(month_name) = ? and YEAR(year) =?',[$month,$year]);

        // echo json_encode($data[0]->num);
        if($data[0]->num == 0){
            
            $date = date($year."-".$month."-1");
            // echo $date;
            $data = DB::insert('insert into months(month_name,year) values (?,?)',[$date,$date]);
            // return $data;
        }
        $data = DB::select('SELECT * FROM months WHERE 
        Month(month_name) = ? 
        and 
        YEAR(year) = ?',[$month,$year]);
        return $data[0]->month_id;
    
    }
    public function getStudentData($s_id){
        $data = DB::select('select * from students where s_id = ?', [$s_id]);
        return $data[0];
    }
    public function getfees($id){

        $data = DB::select('select * from modules where id = ?', [$id]);
        return $data[0]->fee;
    }
    
    public function getNoofVouchers($id){
        $data = DB::select('SELECT count(*) as vouchers FROM `fees` where s_id = ?', [$id]);
        return $data[0]->vouchers;
    }
    
    public function CurrentMonthGenerated($id){

        $monthid = $this->getCurMonthId();
        try {
            $data = DB::select('SELECT count(*) as vouchers FROM `fees` where s_id = ? and month_id=?', [$id,$monthid]);
            return $data[0]->vouchers;
            
        } catch (\Throwable $th) {
            return 0;
        }
    
    }
    public function getCurMonthId(){
        $monthId =DB::select("SELECT month_id FROM `months` where MONTH(month_name)=? and Year(year)=?",[intval(date('m')),intval(date('Y'))]); 
        try {
            $monthId = $monthId[0]->month_id;
        } catch (\Throwable $th) {
            $monthId = 0;
            
        }
        return $monthId;

    }
    public function getPayableFees($id){
        $total = $this->GetLastMonthPayableFee($id);
        // $data = DB::select('SELECT * FROM `fees` where s_id = ? and fees_paid = 0', [$id]);
        // foreach ($data as $value) {
        //     $total += $value->fees_amount;
        //   }
        return $total;
    }


    public function getAdmissionfees($id){

        $data = DB::select('select fee from interest where id = ?', [$id]);
        // echo json_encode($data);
        return $data[0]->fee;
    }
   
    public function GenerateFees($s_id,$m_id){
        // echo $s_id;cd 
        $data = $this->getStudentData($s_id);
        // echo json_encode($data);
        // $month = date("m");
        // $year = date("Y");
        // $m_id = $this->getAddMonth($month,$year);
        $admission = 0;
        $arrears = 0;
        $noofvouchers = $this->getNoofVouchers($s_id);
        // echo "no of vouchers: ".$noofvouchers . "\n<br>";

        if($noofvouchers == 0){
            // echo "\n new adm: ".$data ->is_new_admission. "<br>";
            // echo "on if<br>";
            if($data ->is_new_admission == 1){
                // echo "in inner if";
    
                $admission = $this->getAdmissionfees($data->interest);
            }
        }
        else{
        //     $Lastm_id = $this->getLastGeneratedFeeMonth($s_id);
        //     // echo json_encode($Lastm_id->id);
        //     $fee_info= DB::select('select fees_amount,fee_arrears from fees where s_id = ? and month_id=? and fees_paid=0', [$s_id,$Lastm_id->id])[0];
        //     // echo json_encode($fee_info);
        //     $fee_amount = $fee_info->fees_amount;
        //     $arrears = $fee_info->fee_arrears+$fee_amount;
            $arrears = $this->GetLastMonthPayableFee($s_id);
            // echo "in else\n<br>";
            DB::update('update students set is_new_admission =0 where s_id = ?', [$s_id]);        
        }
        $fees = $this->getfees($data->sub_interest_id);
        // echo gettype($fees);
        // echo gettype($admission);
        $total = $fees+$admission;
        $all = ["fees" => $fees,"total"=>$total];
        $fees = DB::insert('insert into fees (fees_amount, fees_paid,s_id,month_id,fee_challan_url,fee_arrears) values (?, ?, ?, ?, ?, ?)', [$total, 0,$s_id,$m_id,null,$arrears]);
        DB::update('update students set fee_status = 0 where s_id = ?', [$s_id]);
        return $all;

        

    }
    public function GetLastMonthPayableFee($s_id)
    {
        $Lastm_id = $this->getLastGeneratedFeeMonth($s_id);
        // echo json_encode($Lastm_id->id);
        try {
            $fee_info= DB::select('select fees_amount,fee_arrears from fees where s_id = ? and month_id=? and fees_paid=0', [$s_id,$Lastm_id->id])[0];
            
            $fee_amount = $fee_info->fees_amount;
            $arrears = $fee_info->fee_arrears+$fee_amount;
        } catch (\Throwable $th) {
            $arrears = 0;
        }
        // echo json_encode($fee_info);
        return $arrears;
    }
    public function GetStudentJoiningMonth($id)
    {
        $data = DB::select('SELECT Month(s_joined_date) as joining_month,YEAR(s_joined_date) as joining_year FROM `students` where s_id = ?', [$id]);
        // echo json_encode($data);
        return $data[0];
    }
    public function getLastGeneratedFeeMonth($id)
    {
        try {
            
            $data = DB::select("SELECT months.month_id as id , MONTH(months.month_name) as month,YEAR(months.month_name) as year  FROM `fees` 
            INNER join months on fees.month_id=months.month_id
            where s_id = ?
            ORDER BY `fees`.`month_id` DESC limit 1", [$id]);
            
            // echo json_encode($data);
            return $data[0];
        } catch (\Throwable $th) {
            
            // echo "in catch";
            $data = DB::select('select Month(s_joined_date) as month,Year(s_joined_date) as year from students where s_id  = ?', [$id]);
            
            // echo json_encode($data);
            return $data[0];
        }
        
    }
    
    public function GenerateFeesAll($id)
    {
        $CurGenerated = $this->CurrentMonthGenerated($id);
        $data = $this->getLastGeneratedFeeMonth($id);
        $last_gen_month =$data->month;
        $last_gen_year = $data->year;
        $cur_month = Date("m");
        $cur_year = Date("Y");

        if($CurGenerated == 0){

            
            while (true) {
                if($last_gen_month == 13){
                    $last_gen_month = 1;
                    $last_gen_year++;
                } 
                // echo $last_gen_year . " - ". $last_gen_month;
                
                $m_id = $this->getAddMonth($last_gen_month,$last_gen_year);
                // echo json_encode($m_id);
                $this->GenerateFees($id,$m_id);
                $last_gen_month++;
                if ($last_gen_month == $cur_month+1 && $last_gen_year == $cur_year){
                    break;
                }
            }
        }
    }

    public function GetCourses($id)
    {
        $data = DB::select("SELECT mo.name as module,co.id as course_id,co.name,class.id as class_id,class.s_id FROM `class` 
        INNER join course co on class.course_id = co.id
        INNER join modules mo on co.module_id = mo.id
        where s_id = ? and course_status = 1", [$id]);
        
        return $data;
    }
    public function GetCourse($id)
    {
        $data = DB::select("SELECT * FROM `course` where id=? and course_status=1", [$id]);
        return $data[0];
    }
    public function getMessages($c_id)
    {
        $data = DB::select("SELECT * FROM `message` where course_id = ? order by posted_at DESC",[$c_id]);
        return $data;
    } 
    public function ClassView($id,Request $req)
    {
        
        if(session('user')){
        $name = session('user')['name'];
        $cred = [$name,$name,session('user')['pass']];
        $exe= $this->getData($cred);
            if($exe[0]->s_status == 1){
                $courses = $this->GetCourses(session('user')['id']);
                $course = $this->GetCourse($id);
                $messages = $this->getMessages($id);
                return view('students.class',['course'=>$course,'courses'=>$courses,'messages'=>$messages]);
            }
            else{
                if(session()->has('user')){
                    // session()->pull('student');
                    session()->flush();
                    $req->session()->flash('disable', $name);
                    return redirect('/students/login');
                }
                
            }

        }
        else{
            return redirect('/teachers/login');
        }
    }

}



// SELECT MONTH(months.name) as month,YEAR(months.name) as year  FROM `fees` 
// INNER join months on fees.month_id=months.month_id
// where s_id = 1010
// ORDER BY `fees`.`month_id` DESC limit 1