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
                    <div class="col">
                        <a href="{{route('antrian.index')}}">Input daftar antrian sidang hari ini</a>
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="col">
                    
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection