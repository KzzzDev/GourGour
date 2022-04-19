<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    public function post(Request $request) {
        
        // $name = $request->name;
        // $password = $request->password;

        $param = [
            'name' => $request->name,
            'password' => $request->password,
        ];
        $result = DB::select('select name from user where name = :name', ['name'=>$request->name]);
        if($result) {
            $return_url = 'user.rogin';
        } else{
            DB::insert('insert into user (name, password) values(:name, :password)', $param);
            $result = DB::select('select date, history from history where name = :name', ['name'=>$request->name]);
            $return_url = 'user.mypage';
        }
        // $result = DB::select('select * from user');
        
        // $db = new PDO('mysql:host=intern-mysql;dbname=intern-project', 'user', 'pass');
        // // $db = new PDO('mysql:host=' . 'intern-mysql' . ';dbname=' . 'intern-project', 'user', 'pass');
        // $sql = 'INSERT INTO user VALUE(:name, :password)';
        // $prepare = $db->prepare($sql);

        // $prepare->bindValue(':name', $name, PDO::PARAM_STR);
        // $prepare->bindValue(':password', $password, PDO::PARAM_STR);
        // $prepare->execute();

        // $sql = 'SELECT * FROM user';
        // $prepare = $db->prepare($sql);
        // $prepare->execute();

        // $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        // return view('user.mypage' ,['result'=>$result]);
        // return view('user.rogin' ,['result'=>$result]);
        return view($return_url ,['result'=>$result]);
    }
}
