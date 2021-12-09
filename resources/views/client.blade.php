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
<div class="container-fluid vh-100" style="background-color:#1aeb39">
    <div class="row" style="height:10%">  
      <div class="col-sm-9"  style="background-color:orange;"><h3 style="font-weight:bold; padding-top:10px">MAHKAMAH AGUNG REPUBLIK INDONESIA</h3><h4 style="font-weight:bold;">PENGADILAN AGAMA KAIMANA</h4></div>
      <div class="col-sm-3" style="background-color:orange;"><div id="clock" style="font-size:50px; font-weight:bold; line-height:25px; padding-top:20px;"></div><br><div id="date" style="font-size:20px; line-height:0;"><b><i>{{date('l, F jS, Y')}}</i></b></div></div>
    </div>
    
    <div class="row" style="height:70%">  
      <div class="col-sm-4" style="background-color:yellow; font-weight:bold; text-align:center;"><div style="font-size: 50px; background-color:#21db53; border-radius: 25px; margin-top:25px">RUANG SIDANG UTAMA</div><div style="font-size: 40px; padding-top:0px;">NOMOR ANTRIAN</div>
      <div style="font-size:250px; font-weight:bold; color:red; background-color:white; border-radius: 25px;" id="antrian_saat_ini"></div></div>
      <div class="col-sm-8" style="background-color:yellow; padding-top:20px; padding-left:30px">
        <video width="90%;" height="auto" style="border-radius: 20px;" autoplay muted>
          <source src="public/video/kaimana.mp4" type="video/mp4" />
        </video>
      </div>
    </div>
    <div class="row" style="height:10%">  
      <div class="col-sm-4" style="background-color:#1aeb39; font-weight:bold; text-align:center; line-height:50px"><b>Jumlah antrian</b><br><div style="font-size:50px; font-weight:bold; text-align:center;" id="total_antrian"></div></div>
      <div class="col-sm-4" style="background-color:#1aeb39; font-weight:bold; text-align:center; line-height:50px"><b>Antrian selanjutnya</b><br><div style="font-size:50px; font-weight:bold; text-align:center" id="antrian_selanjutnya"></div></div>
      <div class="col-sm-4" style="background-color:#1aeb39; font-weight:bold; text-align:center; line-height:50px"><b>Sisa antrian</b><br><div style="font-size:50px; font-weight:bold; text-align:center;" id="sisa_antrian"></div></div>
    </div>
    <div class="row" style="height:10%">
      <div class="footer"><div class="col-sm-12" style="font-size:30px; background-color:cyan;"><marquee direction="left" style="font-size:30px"><i>SELAMAT DATANG DI KANTOR PENGADILAN AGAMA KAIMANA - SENYUM, SALAM, SAPA, SOPAN, SANTUN</i></marquee></div></div>
    </div>
</div>
</body>
</html>
@endsection
@push('scripts')
<script type="text/JavaScript">
if(typeof(EventSource) !== "undefined"){

    var source = new EventSource("server");

    source.addEventListener("antrian_saat_ini", function (event) {
        var data = event.data;
        // handle message
        document.getElementById("antrian_saat_ini").innerHTML = data;
    });

    source.addEventListener("total_antrian", function (event) {
        var data = event.data;
        // handle message
        document.getElementById("total_antrian").innerHTML = data;
    });

    source.addEventListener("antrian_selanjutnya", function (event) {
        var data = event.data;
        // handle message
        document.getElementById("antrian_selanjutnya").innerHTML = data;
    });

    source.addEventListener("sisa_antrian", function (event) {
        var data = event.data;
        // handle message
        document.getElementById("sisa_antrian").innerHTML = data;
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

