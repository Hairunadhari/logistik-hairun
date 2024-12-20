@extends('layouts.app')
@section('content')
<div class="section-header">
    <h1>Data Barang Masuk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">List Data Barang Masuk</div>
    </div>
</div>
<div class="section-body">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="w-100">Table Barang Masuk</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
                        <span class="text">+ Add New</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Origin (asal barang)</th>
                                    <th scope="col">Tgl Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- data ngelooping di bawah --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#table').DataTable({
            // responsive: true,
            processing: true,
            ordering: false,
            serverSide: true,
            ajax: {
                url: '{{ url()->current() }}',
            },
            columns: [{
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    data: "kode_barang",
                },
                {
                    data: "qty",
                },
                {
                    data: "origin",
                },
                {
                    data: "tanggal_masuk",
                },
            ],
        });

    });

</script>
@endsection
@section('modal')
<!-- Modal -->

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Form Input Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/submit-barang-masuk" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kode Barang</label>
                        <input name="kode_barang" required type="text" class="form-control" placeholder="Contoh : BRG-123">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Quantity</label>
                        <input name="qty" required type="number" class="form-control" placeholder="Quantity">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Origin (Asal barang)</label>
                        <input name="origin" required type="text" class="form-control" placeholder="Asal Barang">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tgl Masuk</label>
                        <input name="tanggal_masuk" required type="date" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
