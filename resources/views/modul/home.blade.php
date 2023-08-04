@extends('template.main')

@section('konten')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ Auth::user()->name }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-title mb-0"><center>Selamat datang di administrator dari Aplikasi Mobile Mendeteksi Gangguan Mental Terhadap Manusia Dengan Menggunakan Metode Dempster Shafer</center></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
