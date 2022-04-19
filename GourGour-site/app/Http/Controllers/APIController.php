<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function index() {

        $url = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=4220fc6905135026&address=%E6%96%B0%E5%AE%BF&genre=G007&budget=B010&format=json';
        $json = file_get_contents($url);
        $date = json_encode($json, JSON_UNESCAPED_UNICODE);
        return view('api.result', ['date'=>$date]);

    }

    public function post(Request $request) {

        $url = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=4220fc6905135026&format=json';
        $erea = $request->erea;
        $genre = $request->genre;
        $budget = $request->budget;

        if($erea) {
            $url = $url . "&keyword=" . $erea;
        } else{
            $url = $url . "&address=県";
        }
        if($genre) {
            $url = $url . "&genre=" . $genre;
        }
        if($budget) {
            $url = $url . "&budget=" . $budget;
        }

        $json = file_get_contents($url);
        // $date = json_encode($json, JSON_UNESCAPED_UNICODE);
        
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');     
        $date = json_decode($json, true);
        // $date = $date["results"];
        $date = $date["results"]["shop"];
        // $date = $date["results"]["shop"][1]["name"];
        $date = json_encode($date, JSON_UNESCAPED_UNICODE);
        // return view('api.result', ['date'=>$genre]);
        // return view('api.result', ['date'=>$url]);
        return view('api.result', ['date'=>$date]);
    
    }
}
