@extends('layouts/app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar antrian sidang</div>

                <div class="card-body">
                    <p>Daftar antrian sidang hari ini</p>
                    <button class="btn btn-success btn-sm btnInput" id="btnInput">Input antrian</button>
                    <br><br>
                    <table class="table table-striped daftar_antrian" width="100%">
                        <thead>
                        <tr> 
                            <td width="60px">Antrian</td>                  
                            <td>No. Perkara</td>
                            <td>Pihak 1</td>
                            <td>Pihak 2</td>
                            <td width="70px">Jenis</td>
                            <td>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formDaftarPerkara" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
            <div class="modal-header bg-info text-white"  style="background-image: linear-gradient(#d0e2f8, #e2ecfb); height: 30px; line-height: 6px; font-size: 13px; border-top: 1px white solid">
                <p style="line-height: 0; color:#0a4293; font-weight:normal; font-size:14px; font-weight:600;">Daftar barang</p><button style="line-height: 0; background-color:red; border-radius:3px;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:white">&times;</span></button>
            </div>
            <div class="modal-body" style="background-color:white; border-left:6px solid #e2ecfb; border-right:6px solid #e2ecfb; border-bottom:6px solid #e2ecfb; font-size:13px">
            <p>Masukan para pihak yang akan melakukan sidang hari ini</p>
                <table class="table table-striped daftar_perkara" width="100%">
                    <thead>
                    <tr>                   
                        <td>No. Perkara</td>
                        <td>Pihak 1</td>
                        <td>Pihak 2</td>
                        <td width="70px">Jenis</td>
                        <td>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/JavaScript">
    $(document).ready(function(){
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

        $("body").on("click",".btnInput",function(){
            $("#formDaftarPerkara").modal("show");
            $(".daftar_perkara").DataTable().ajax.reload();
        });

        $("body").on("click",".pilih",function(){
            console.log($(this).data("no_perkara"));
            let no_perkara = $(this).data("no_perkara");
            $.ajax({
                url:"{{route('antrian.input')}}",
                type:"GET",
                data:{no_perkara:no_perkara},
                success:function(data){
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
                }
            });
        });

    });
</script>
@endpush