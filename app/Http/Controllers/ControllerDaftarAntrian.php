<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;

class ControllerDaftarAntrian extends Controller
{
    public function index(){
        return view("daftar_antrian/index");
    }

    public function getDaftarPerkara(){
        $table=DB::table("sipp.dataumumweb")
        ->select("sipp.dataumumweb.IDPerkara as id","sipp.dataumumweb.noPerkara as no_perkara","sipp.jenisperkaraweb.nama as jenis_perkara", "sipp.dataumumweb.statusAkhir as status_akhir","sipp.dataumumweb.tglPutusan as tgl_putusan","sipp.perkara.pihak1_text","sipp.perkara.pihak2_text")
        ->join("sipp.jenisperkaraweb", "sipp.dataumumweb.IDJenisPerkara","=","sipp.jenisperkaraweb.id")
        ->leftJoin("sipp.perkara", "sipp.dataumumweb.IDPerkara","=","sipp.perkara.perkara_id")
        ->where("sipp.dataumumweb.IDProses","=","296")
        ->whereNotIn('sipp.dataumumweb.noPerkara', function($q){
            $q->select('u4441694_db_antri.tb_antrian.no_perkara')->from('u4441694_db_antri.tb_antrian');
        })
        ->get();
        return DataTables::of($table)->make(true);
    }

    public function getDaftarAntrian(){
        $table=DB::table("sipp.dataumumweb")
        ->select("sipp.dataumumweb.IDPerkara as id","sipp.dataumumweb.noPerkara as no_perkara","sipp.jenisperkaraweb.nama as jenis_perkara", "sipp.dataumumweb.statusAkhir as status_akhir","sipp.dataumumweb.tglPutusan as tgl_putusan","sipp.perkara.pihak1_text","sipp.perkara.pihak2_text","u4441694_db_antri.tb_antrian.no_antrian")
        ->join("sipp.jenisperkaraweb", "sipp.dataumumweb.IDJenisPerkara","=","sipp.jenisperkaraweb.id")
        ->join("sipp.perkara", "sipp.dataumumweb.IDPerkara","=","sipp.perkara.perkara_id")
        ->join("u4441694_db_antri.tb_antrian","sipp.dataumumweb.noPerkara","=","u4441694_db_antri.tb_antrian.no_perkara")
        ->where("sipp.dataumumweb.IDProses","=","296")
        ->get();

        return DataTables::of($table)->make(true);
    }

    public function input(Request $request){
        $date = date("Y-m-d");
        $datetime = date("Y-m-d H:i:s");
        $find = DB::table("tb_antrian")->where("tanggal",$date)->count();
        if($find==0){
            $no_antrian=1;
        }else{
            $no_antrian=$find+1;
        }
        $table=DB::table("tb_antrian")->insert([
            "no_perkara"=>$request['no_perkara'],
            "tanggal"=>$date,
            "no_antrian"=>$no_antrian
        ]);

        return response()->json($table);
    }

    public function delete(Request $request){
        $table=DB::table("tb_antrian")
        ->where("no_perkara",$request["no_perkara"])
        ->delete();
        return response()->json($table);
    }
}
