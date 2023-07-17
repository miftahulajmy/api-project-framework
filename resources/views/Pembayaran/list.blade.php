@extends('layouts.main')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('title','List Data pembayaran')
@section('button_header')
<a href="javascript:void(0)" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create" id="btn-create-post">Create</a>
@endsection
@section('judul_header','Data pembayaran')
@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">LARAVEL CRUD AJAX </h4>
                <div class="card border-0 shadow-sm rounded-md mt-4">
                    <div class="card-body">
 
                        <!-- <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a> -->
 
                        <table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr>
                                    <th>NISN</th>
                                    <th>Tanggal</th>
                                    <th>Jenis_pembayaran</th>
                                    <th>Jumlah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-posts">
                                @foreach($Pembayaran as $pembayaran)
                                <tr id="index_{{ $pembayaran->id }}">
                                    <td>{{ $pembayaran->NISN }}</td>
                                    <td>{{ $pembayaran->Tanggal }}</td>
                                    <td>{{ $pembayaran->Jenis_pembayaran }}</td>
                                    <td>{{ $pembayaran->Jumlah }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $pembayaran->id }}" class="btn btn-primary btn-sm">EDIT</a>
                                        <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $pembayaran->id }}" class="btn btn-danger btn-sm">DELETE</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pembayaran.modal-create')
    @include('pembayaran.update')
    @include('pembayaran.delete')
@endsection
@section('js')
<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $("#kt_datatable_example_5").DataTable({
        "language" : {
            "lengthMenu" : "Show _MENU_",
        },
        "dom":
        "<'row'"+
        "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
        ">" +

        "<'table-responsive'tr>" +

        "<'row'"+
        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
        ">"
    });
</script>
@endsection