<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ControllerPushMessage extends Controller
{
    public function server(Request $request){
        $no_perkara=$request["no_perkara"];
        $table=DB::connection('remote_mysql')
        ->table("u4441694_db_antri.tb_antrian")
        ->select("u4441694_db_antri.tb_antrian.no_perkara")
        ->where("u4441694_db_antri.tb_antrian.no_perkara",$no_perkara)
        ->first();
        
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
        $table=DB::connection('remote_mysql')->table("u4441694_db_antri.tb_antrian")
        ->where("u4441694_db_antri.tb_antrian.no_perkara",$request["no_perkara"])
        ->update([
            "u4441694_db_antri.tb_antrian.called"=>1,
            "u4441694_db_antri.tb_antrian.updated_at"=>$date
        ]);

        $no_antrian=DB::connection('remote_mysql')->table("u4441694_db_antri.tb_antrian")
        ->where("u4441694_db_antri.tb_antrian.no_perkara",$no_perkara)
        ->select("u4441694_db_antri.tb_antrian.no_antrian")
        ->first();

        return response()->json(["table"=>$table,"no_antrian"=>$no_antrian]);
    }

    public function client(){
        return view("client");
    }

    public function call(){
        return view("call");
    }

}
