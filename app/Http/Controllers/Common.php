<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\news;
class Common extends Controller
{
    public function GetNewsDetailsPag()
    {
        $data = news::orderBy('posted_at','DESC')->paginate(2)
            // ->sortByDesc('posted_at')
        ;  

        // $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function GetAdmissionFeeDetails()
    {
        $data = DB::select('select * from interest ')
            // ->sortByDesc('posted_at')
        ;  

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function GetCourseFeeDetails()
    {
        $data = DB::select('SELECT * 
        FROM modules 
        WHERE id NOT IN ( 1,2,3,4,5 )')
            // ->sortByDesc('posted_at')
        ;  

        $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function Index(Request $req){
        $news = $this->GetNewsDetailsPag();
        $admission = $this->GetAdmissionFeeDetails();
        $courses = $this->GetCourseFeeDetails();
        // echo json_encode($news);
        return view('welcome',["news"=>$news,'admissions'=>$admission,'courses'=>$courses]);
    } 
    public function Upload(Request $req)
    {   
        // $validatedData = $req->validate([
            //     'file' => 'required|pdf,doc,docx|max:2048',
            
            //    ]);
            try {   
            $file=  $req->file('file')->store('files', ['disk' => 'public']);
            $name = $req->name;
            $number= $req->number;
            
            DB::insert('insert into careers (name,number,file_path) values (?, ?, ?)', [$name,$number,$file]);
                // return ["msg"=>$ele];
                return ["msg"=>"Successfully uploaded"];
    
            } 
            catch (\Throwable $th) 
            {
                    
                return response( ["errorMsg"=>$th],422)
                ->header('Content-Type', 'application/json');
            }

        

      
      
        ;

    }

}
