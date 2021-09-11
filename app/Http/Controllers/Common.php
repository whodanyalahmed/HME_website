<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\news;
class Common extends Controller
{
    public function GetNewsDetailsPag()
    {
        $data = news::paginate(2);

        // $data = json_decode(json_encode($data),true);
        return $data;
    }
    public function Index(Request $req){
        $news = $this->GetNewsDetailsPag();
        // echo json_encode($news);
        return view('welcome',["news"=>$news]);
    } 
}
