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
    <div class="row" style="height:15%">  
      <div class="col-sm-9"  style="background-color:orange;"><h1 style="font-weight:bold; padding-top:20px">MAHKAMAH AGUNG REPUBLIK INDONESIA</h1><h2 style="font-weight:bold;">PENGADILAN AGAMA KAIMANA</h2></div>
      <div class="col-sm-3" style="background-color:orange;"><div id="clock" style="font-size:50px; font-weight:bold; line-height:50px; padding-top:20px"></div><br><div id="date" style="font-size:25px; line-height:0;"><i>{{date('l, F jS, Y')}}</i></div></div>
    </div>
    <div class="row" style="height:10%">  
      <div class="col-sm-4" style="background-color:yellow; font-weight:bold; font-size:35px; text-align:center; line-height:80px">Ruang sidang utama</div>
      <div class="col-sm-8" style="background-color:black;"></div>
    </div>
    <div class="row" style="height:50%">  
      <div class="col-sm-4" style="background-color:yellow; font-weight:bold; text-align:center; font-size: 20px">Nomor antrian<br>
      <div class="row justify-content-center align-self-center" style="font-size:200px; font-weight:bold; color:red;" id="antrian_saat_ini"></div></div>
      <div class="col-sm-8" style="background-color:black;"></div>
    </div>
    <div class="row" style="height:15%">  
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
        document.getElementById('clock').innerHTML =  h + ":" + m + ":" + s;
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

