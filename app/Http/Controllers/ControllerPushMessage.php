<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ControllerPushMessage extends Controller
{
    public function server(Request $request){
        $no_perkara=$request["no_perkara"];
        $table=DB::table("tb_antrian")->select("no_perkara")->where("no_perkara",$no_perkara)->first();
        $data=array(
            "no_perkara"=>$no_perkara,
             );
        return view("server", compact("table","no_perkara","data"));
        //return response()->json($table);
    }

    public function get_antrian(Request $request){
        date_default_timezone_set("Asia/Jayapura");
        $no_perkara=$request["no_perkara"];
        $date=date("Y-m-d H:i:s");
        $table=DB::table("tb_antrian")
        ->where("no_perkara",$request["no_perkara"])
        ->update([
            "updated_at"=>$date
        ]);

        return response()->json($table);
    }

    public function client(){
        return view("client");
    }

    public function call(){
        return view("call");
    }

}
