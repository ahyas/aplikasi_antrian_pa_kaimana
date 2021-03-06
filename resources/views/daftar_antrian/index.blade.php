@extends('layouts/app')
@section('content')
<style type="text/css">
    
    table tr td:last-child {
        white-space: nowrap;
        width: 1px;
        text-align: right;
    }

    table thead tr th:last-child{
        white-space: nowrap;
        width: 1px;
        text-align:right;
    }

</style>
<?php date_default_timezone_set("Asia/Jayapura"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!--tanggal format bahasa indonesia-->
                <?php include("public/plugins/tgl_indo.php"); ?>
                <!--Jika login sebagai Admin 1-->
                @if(Auth::user()->id_role==1)
                <!-- Start Tabel untuk menampilkan daftar antrian sidang-->
                <div class="card-header">Daftar antrian sidang</div>
                <div class="card-body">
                    <p>Berikut ini adalah daftar perkara yang akan di sidangkan pada hari ini: <b><?php
                    $hariBahasaInggris = date('l'); $hariBahasaIndonesia = hariIndo($hariBahasaInggris); echo $hariBahasaIndonesia.", ".tgl_indo(date('Y-m-d')); ?></b></p>
                    <button class="btn btn-success btn-sm btnInput" id="btnInput">Input antrian</button>
                    <br><br>
                    <table class="table table-striped daftar_antrian" width="100%">
                        <thead>
                        <tr> 
                            <th width="100px">No. Antrian</th>                  
                            <th>No. Perkara</th>
                            <th>Penggugat</th>
                            <th>Tergugat</th>
                            <th width="70px">Jenis</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- End Tabel untuk menampilkan daftar antrian sidang-->

                <!-- Start Form untuk membuka daftar perkara -->
                <div class="modal fade" id="formDaftarPerkara" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                            <div class="modal-header bg-info text-white"  style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                                <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Daftar perkara</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
                            </div>
                            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb;">
                            <p>Masukan para pihak yang akan melakukan sidang hari ini</p>
                                <table class="table table-striped daftar_perkara" width="100%">
                                    <thead>
                                    <tr>                   
                                        <th width="100px">No. Perkara</th>
                                        <th>Penggugat</th>
                                        <th>Tergugat</th>
                                        <th width="70px">Jenis</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Form untuk membuka daftar perkara-->
            </div>
            <!--Jika login sebagai Admin 2-->
            @elseif(Auth::user()->id_role==2)
            <div class="card-header">Pemanggilan para pihak sesuai nomor antrians</div>
                <div class="card-body">
                    <table class="table table-striped pemanggilan_antrian" width="100%">
                        <thead>
                        <tr> 
                            <th width="100px">No. Antrian</th>                  
                            <th>No. Perkara</th>
                            <th>Penggugat</th>
                            <th>Tergugat</th>
                            <th width="70px">Jenis</th>
                            <th width="70px">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            @endif
            </div>
        </div>
    </div>
</div>

@endsection

<audio id="tingtung" src="public/audio/tingtung.mp3"></audio>
@push('scripts')
<!--Link cadangan kalau link local tidak berfungsi-->
<script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>
<!--<script src="public/js/responsivevoice.js"></script>-->
<script type="text/JavaScript">
    $(document).ready(function(){
        //Start Daftar perkara
        $(".daftar_perkara").DataTable({
            ajax:"{{route('antrian.get_data_perkara')}}",
            serverside:false,
            processing:false,
            columns:[
                {data:"no_perkara"},
                {data:"pihak2_text",searchable: false},
                {data:"pihak1_text",searchable: false},
                {data:"jenis_perkara",searchable: false},
                {data:"no_perkara",
                    mRender: function ( data ) 
                    {
                        return '<a href="javascript:void(0)" class="btn btn-success btn-sm pilih" data-no_perkara="'+data+'">Pilih</a>';
                    }
                }
            ]
        });
        //End daftar perkara

        //Start Daftar perkara yang akan di sidangkan pada hari ini
        $(".daftar_antrian").DataTable({
            ajax:"{{route('antrian.get_data_antrian')}}",
            serverside:false,
            processing:false,
            columns:[
                {data:"no_antrian"},
                {data:"no_perkara"},
                {data:"pihak2_text"},
                {data:"pihak1_text"},
                {data:"jenis_perkara"},
                {data:"no_perkara",
                    mRender: function ( data ) 
                    {
                        return '<a href="javascript:void(0)" class="btn btn-danger btn-sm hapus" data-no_perkara="'+data+'">Hapus</a>';
                    }
                }
            ]
        });
        //End Daftar perkara yang akan disidangkan pada hari ini
        
        //Start pemanggilan para pihak
        var tabel = $(".pemanggilan_antrian").DataTable({
            ajax:"{{route('antrian.get_data_antrian')}}",
            serverside:false,
            processing:false,
            columns:[
                {data:"no_antrian"},
                {data:"no_perkara"},
                {data:"pihak2_text"},
                {data:"pihak1_text"},
                {data:"jenis_perkara"},
                {data:"called",
                    mRender: function(data){
                        if(data==0){
                            return'<span class="badge badge-primary">Sudah dipanggil</span>';
                        }else{
                            return'<span class="badge badge-danger">Belum dipanggil</span>';
                        }
                    }
                },
                {data:"no_perkara",
                    mRender: function ( data) 
                    {
                        return '<a href="javascript:void(0)" class="btn btn-success btn-sm panggil" data-no_perkara="'+data+'" >Panggil</a>';
                    }
                }
            ]
        });
        //End pemanggilan para pihak

        setInterval( function () {
            tabel.ajax.reload(null, false);
        }, 5000 );

        $("body").on("click",".btnInput",function(){
            $("#formDaftarPerkara").modal("show");
        });

        $("body").on("click",".pilih",function(){
            console.log($(this).data("no_perkara"));
            let no_perkara = $(this).data("no_perkara");
            $.ajax({
                url:"{{route('antrian.input')}}",
                type:"GET",
                data:{no_perkara:no_perkara},
                success:function(data){
                    $(".daftar_perkara").DataTable().ajax.reload();
                    $(".daftar_antrian").DataTable().ajax.reload();
                    $("#formDaftarPerkara").modal("hide");
                }
            });
        });

        $("body").on("click",".hapus",function(){
            console.log($(this).data("no_perkara"));
            let no_perkara = $(this).data("no_perkara");
            $.ajax({
                url:"{{route('antrian.delete')}}",
                type:"GET",
                dataType:"JSON",
                data:{no_perkara:no_perkara},
                success:function(data){
                    $(".daftar_antrian").DataTable().ajax.reload();
                    $(".daftar_perkara").DataTable().ajax.reload();
                }
            });
        });

        //Start memanggil antrian lewat SSE (Server Sent Event)
        $("body").on("click",".panggil",function(){
            let no_perkara = $(this).data("no_perkara");
            console.log("Call "+no_perkara);
            $.ajax({
                url:"{{route('push.get_antrian')}}",
                type:"GET",
                data:{no_perkara:no_perkara},
                success:function(data){
                    console.log(data);
                    var bell = document.getElementById('tingtung');
                    // mainkan suara bell antrian
                    bell.pause();
                    bell.currentTime = 0;
                    bell.play();
                    // set delay antara suara bell dengan suara nomor antrian
                    durasi_bell = bell.duration * 770;
                    // mainkan suara nomor antrian
                    setTimeout(function() {
                        responsiveVoice.speak("Nomor Antrian, " + data.no_antrian.no_antrian + ", menuju, ruang sidang, utama", "Indonesian Female", {
                            rate: 0.9,
                            pitch: 1,
                            volume: 10
                        });
                    }, durasi_bell);
                }
            });
        });
        //End memanggil antrian lewat SSE
    });
</script>
@endpush