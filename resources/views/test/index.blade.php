@extends('layouts/new')

@section('content')
<style type="text/css">
.footer{
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: red;
   color: black;
   text-align: center;
}
</style>
<div class="container-fluid">
    
        <!-- Jumbotron -->
        <div class="p-5 text-center bg-light" style="height:100px;">
            <h1 style="line-height:0px; text-align:left;">MAHKAMAH AGUNG REPUBLIK INDONESIA</h1>
            <h2 style="line-height:50px; text-align:left">Pengadilan Agama Kaimana</h2>
        </div>
        <!-- Jumbotron -->
    
  <div class="row" style="padding-top:30px">
    <div class="col" style="text-align: center;">
        <div class="card text-white bg-dark mb-3" style="max-width: 100%; height:300px">
            <div class="card-header"><h5 class="card-title">RUANG SIDANG UTAMA</h5></div>
            <div class="card-body">
                <h5 class="card-title">Dark card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
    <div class="col-8" style="text-align: center;">
        <div class="card text-white bg-dark mb-3" style="max-width: 100%; height:500px">
            <div class="card-header"><h5 class="card-title">RUANG SIDANG UTAMA</h5></div>
            <div class="card-body">
                <h5 class="card-title">Dark card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
  </div>

  <div class="row" style=" margin-bottom:0">
    <div class="col" style="text-align: center;">
        <div class="card text-white bg-dark mb-3" style="max-width: 100%">
            <div class="card-header"><h5 class="card-title">Jumlah Antrian</h5></div>
            <div class="card-body">
                <h5 class="card-title">Dark card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
    <div class="col" style="text-align: center">
        <div class="card text-white bg-dark mb-3" style="max-width: 100%">
            <div class="card-header"><h5 class="card-title">Antrian selanjutnya</h5></div>
            <div class="card-body">
                <h5 class="card-title">Dark card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
    <div class="col" style="text-align: center">
        <div class="card text-white bg-dark mb-3" style="max-width: 100%">
            <div class="card-header"><h5 class="card-title">Sisa antrian</h5></div>
            <div class="card-body">
                <h5 class="card-title">Dark card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
  </div>

  <div class="row align-items-end">
      <div class="footer"><div class="col-sm-12" style="font-size:30px; background-color:#00003d;"><marquee direction="left" style="font-size:25px; color:white"><b><i>SELAMAT DATANG DI KANTOR PENGADILAN AGAMA KAIMANA - SENYUM, SALAM, SAPA, SOPAN, SANTUN</i></b></marquee></div></div>
    </div>
</div>
@endsection