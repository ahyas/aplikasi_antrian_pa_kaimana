@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Selamat datang di dashboard aplikasi Antrian! Silahkan pilih menu di bawah ini.</p>
                    <div class="container">
                        <div class="row" style="text-align:center">
                        @if(Auth::user()->id_role==1)
                            <div class="col">
                                <a href="{{route('antrian.index')}}">Manage daftar antrian sidang hari ini</a>
                            </div>
                            <div class="col">
                                <a href="">Manage running text</a>
                            </div>
                            <div class="col">
                                <a href="">Menu 3</a>
                            </div>
                        @elseif(Auth::user()->id_role==2)
                            <div class="col">
                                <a href="{{route('antrian.index')}}">Pemanggilan antrian sidang</a>
                            </div>
                            <div class="col">
                                <a href="">Menu 2</a>
                            </div>
                            <div class="col">
                                <a href="">Menu 3</a>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection