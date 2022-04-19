<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RouletteController extends Controller
{
    public function post(Request $request) {

        // $items = $request;
        // $items = $request->wantToEat;
        $items = $request->wantToEat;

        if($items){
            foreach($items as $shop_name) {
                $param = [
                    'date' => date('y-m-d'),
                    'shop_name' => $shop_name,
                ];
                DB::insert('insert into log (date, shop_name) values(:date, :shop_name)', $param);
            }
        }
        return view('roulette.roulette', ['items'=>$items]);
    }
}
