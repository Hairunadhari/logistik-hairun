@extends('layouts.app')
@section('content')
<div class="section-header">
    <h1>Data Barang Masuk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">DataTables</div>
        <div class="breadcrumb-item active"><a href="#">Barang Masuk</a></div>
        <div class="breadcrumb-item"><a href="#">Modules</a></div>
    </div>
</div>
<div class="section-body">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="/update-barang-masuk/{{$data->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kode Barang</label>
                            <input name="kode_barang" value="{{$data->kode_barang}}" required type="text" class="form-control" placeholder="Contoh : BRG-123">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Qty</label>
                            <input name="qty" required value="{{$data->qty}}" type="number" class="form-control" placeholder="Qty">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Origin (asal barang)</label>
                            <input name="origin" required value="{{$data->origin}}" type="text" class="form-control" placeholder="Asal Barang">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tgl Masuk</label>
                            <input name="tanggal_masuk" value="{{$data->tanggal_masuk}}" required type="date" class="form-control" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
