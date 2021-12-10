@extends('layouts/client')
@section('content')
<?php date_default_timezone_set("Asia/Jayapura");?>
<html>
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: red;
   color: black;
   text-align: center;
}
</style>
<body onload="startTime()">
<div class="container-fluid vh-100">
    <div class="row" style="height:10%">  
      <div class="col-sm-9"  style="color:white"><h2 style="font-weight:bold; padding-top:10px">MAHKAMAH AGUNG REPUBLIK INDONESIA</h2><h4 style="font-weight:bold;">PENGADILAN AGAMA KAIMANA</h4></div>
      <div class="col-sm-3" style="color:#12e034; text-align:right"><div id="clock" style="font-size:50px; font-weight:bold; line-height:25px; padding-top:20px;"></div><br><div id="date" style="font-size:20px; line-height:0; color:white"><b><i>{{date('l, F jS, Y')}}</i></b></div></div>
    </div>
    
    <div class="row" style="height:70%">  
      <div class="col-sm-4" style=" font-weight:bold; text-align:center;"><div style="background-color:orange; font-size: 40px; border-radius: 25px; margin-top:25px">RUANG SIDANG UTAMA</div><div style="font-size: 40px; padding-top:25px; color:yellow">NOMOR ANTRIAN</div>
      <div style="font-size:250px; font-weight:bold; color:red; background-color:white; border-radius: 25px; border:25px solid black" id="antrian_saat_ini"></div></div>
      <div class="col-sm-8" style=" padding-top:20px; padding-left:30px;">
        <video width="90%;" height="auto" style="border-radius: 20px;" autoplay loop muted>
          <source src="public/video/kaimana.mp4" type="video/mp4" />
        </video>
      </div>
    </div>
    <div class="row" style="height:10%">  
      <div class="col-sm-4" style="font-weight:bold; text-align:center; line-height:50px; font-size:30px; color:yellow; border-radius:15px;"><b>Jumlah antrian</b><br><div style="font-size:70px; font-weight:bold; text-align:center; color:white;" id="total_antrian"></div></div>
      <div class="col-sm-4" style="font-weight:bold; text-align:center; line-height:50px; font-size:30px; color:yellow"><b>Antrian selanjutnya</b><br><div style="font-size:70px; font-weight:bold; text-align:center" id="antrian_selanjutnya"></div></div>
      <div class="col-sm-4" style="font-weight:bold; text-align:center; line-height:50px; font-size:30px; color:yellow"><b>Sisa antrian</b><br><div style="font-size:70px; font-weight:bold; text-align:center;" id="sisa_antrian" ></div></div>
    </div>
    <div class="row" style="height:10%">
      <div class="footer"><div class="col-sm-12" style="font-size:30px; background-color:#00003d;"><marquee direction="left" style="font-size:25px; color:yellow"><b><i>SELAMAT DATANG DI KANTOR PENGADILAN AGAMA KAIMANA - SENYUM, SALAM, SAPA, SOPAN, SANTUN</i></b></marquee></div></div>
    </div>
</div>
</body>
</html>
@endsection
@push('scripts')
<script type="text/JavaScript">
if(typeof(EventSource) !== "undefined"){

    var source = new EventSource("server");
    
    function pad(num, size) {
        while (num.length < size) num = "0" + num;
        return num;
    }

    source.addEventListener("antrian_saat_ini", function (event) {
        var data = event.data;
        // handle message
        var number = pad(data, 3);
        document.getElementById("antrian_saat_ini").innerHTML = number;
    });

    source.addEventListener("total_antrian", function (event) {
        var data = event.data;
        // handle message
        var number = pad(data, 3);
        document.getElementById("total_antrian").innerHTML = number;
    });

    source.addEventListener("antrian_selanjutnya", function (event) {
        var data = event.data;
        if(data==0){
          var number = "<div style='color:red'>Habis</div>";
        }else{
          var number = pad(data, 3);
        }

        document.getElementById("antrian_selanjutnya").innerHTML = number;
    });

    source.addEventListener("sisa_antrian", function (event) {
        var data = event.data;
        
        if(data==0){
          var number = "<div style='color:red'>Habis</div>";
        }else{
          var number = pad(data, 3);
        }
        document.getElementById("sisa_antrian").innerHTML = number;
    });

    //Start realtime clock
    function startTime(){
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('clock').innerHTML =  h + ":" + m + ":" + s + " WIT";
        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};
        return i;
    }
    //End realtime clock

}
</script>
@endpush

