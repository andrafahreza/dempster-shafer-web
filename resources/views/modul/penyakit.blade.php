@extends('template.main')

@section('konten')

@php
    $user = Auth::user();
@endphp

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Penyakit</li>
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
                            <div class="col-md-10">
                                <h5 class="card-title mb-0"><center>Data Penyakit</center></h5><br>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-border" data-bs-toggle="modal" data-bs-target="#tambah-data">Tambah Data</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <center>
                            <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="text-align:center;" id="example">
                                <thead>
                                    <tr>
                                        <th>Kode Penyakit</th>
                                        <th>Nama Penyakit</th>
                                        <th>Solusi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $item->kode_penyakit }}</td>
                                            <td>{{ $item->nama_penyakit }}</td>
                                            <td style="text-align: left;">{!! nl2br($item->solusi) !!}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-icon waves-effect waves-light edit" data-bs-toggle="modal" data-bs-target="#edit-data" value="{{ $item->id }}">
                                                    <li class="las la-pencil-alt"></li>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light hapus" data-bs-toggle="modal" data-bs-target="#hapus" value="{{ $item->id }}">
                                                    <li class="las la-trash"></li>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="tambah-dataLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-dataLabel">Tambah Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('penyakit/tambah') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="sub-menu" class="form-label">Kode penyakit</label>
                            <input type="text" name="kode_penyakit" class="form-control" placeholder="Masukkan kode penyakit" required> <br>
                        </div>
                        <div class="col-md-12">
                            <label for="sub-menu" class="form-label">Nama penyakit</label>
                            <input type="text" name="nama_penyakit" class="form-control" placeholder="Masukkan nama penyakit" required> <br>
                        </div>
                        <div class="col-md-12">
                            <label for="sub-menu" class="form-label">Solusi</label>
                            <textarea class="form-control" name="solusi" style="height: 200px" required></textarea>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-data" tabindex="-1" aria-labelledby="edit-dataLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-dataLabel">Edit Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('penyakit/edit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id_edit">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="sub-menu" class="form-label">Kode penyakit</label>
                            <input type="text" name="kode_penyakit" class="form-control" placeholder="Masukkan Kode penyakit" id="kode_penyakit" required> <br>
                        </div>
                        <div class="col-md-12">
                            <label for="sub-menu" class="form-label">Nama penyakit</label>
                            <input type="text" name="nama_penyakit" class="form-control" placeholder="Masukkan nama penyakit" id="nama_penyakit" required> <br>
                        </div>
                        <div class="col-md-12">
                            <label for="sub-menu" class="form-label">Solusi</label>
                            <textarea name="solusi" class="form-control" style="height: 200px" id="solusi" required></textarea>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="hapusLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusLabel">Hapus Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('penyakit/hapus') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id_hapus">
                    <div class="row">
                        <p>
                            Yakin ingin menghapus data ini?
                        </p>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

@if (session()->has('alert'))
    @php
        if (session('alert') == '1') {
            $icon = "success";
            $judul = "Berhasil !";
        } else {
            $icon = "error";
            $judul = "Gagal !";
        }
        $message = session('message');
    @endphp

    <script>
        var t;
        Swal.fire({
            title: "{{ $judul }}",
            html: "{{ $message }}",
            icon: "{{ $icon }}",
            timer: 2e3,
            timerProgressBar: !0,
            showCloseButton: !0,
            didOpen: function () {
            Swal.showLoading(),
                (t = setInterval(function () {
                var t = Swal.getHtmlContainer();
                t &&
                    (t = t.querySelector("b")) &&
                    (t.textContent = Swal.getTimerLeft());
                }, 100));
            },
            onClose: function () {
                clearInterval(t);
            },
        }).then(function (t) {
            t.dismiss === Swal.DismissReason.timer &&
            console.log("I was closed by the timer");
        });
    </script>
@endif

<script>
    $(document).ready( function () {
        $('#example').DataTable();
    });

    $('.hapus').on('click', function() {
        var valueid = $(this).attr("value");
        $('#id_hapus').val(valueid);
    });

    $('.edit').on('click', function() {
        var valueid = $(this).attr('value');
        $('#id_edit').val(valueid);
        $.ajax({
            type: 'post',
            url: 'penyakit/show-edit',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": valueid
            },
            success : function(data){
                $('#kode_penyakit').val(data['kode_penyakit']);
                $('#nama_penyakit').val(data['nama_penyakit']);
                $('#solusi').val(data['solusi']);
            }
        });
    });
</script>

@endsection
