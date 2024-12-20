@extends('layouts.app')
@section('content')
<div class="section-header">
    <h1>Data Barang Keluar</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">List Data Barang Keluar</div>
    </div>
</div>
<div class="section-body">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="w-100">Table Barang Keluar</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create2">
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
                                    <th scope="col">Destination (tujuan barang)</th>
                                    <th scope="col">Tgl Keluar</th>
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
                    data: "destination",
                },
                {
                    data: "tanggal_keluar",
                },

            ],
        });

    });

</script>
@endsection
@section('modal')
<!-- Modal -->

<div class="modal fade" id="create2" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Form Input Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/submit-barang-keluar" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Kode Barang</label>
                        <select name="kode_barang" required class="form-control" id="">
                            <option value="" readonly>Pilih Kode Barang</option>
                            @foreach ($data as $item)
                                <option value="{{$item->kode_barang}}">{{$item->kode_barang}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Quantity</label>
                        <input name="qty" required type="number" class="form-control" placeholder="Quantity">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Destination (Tujuan barang)</label>
                        <input name="destination" required type="text" class="form-control" placeholder="Tujuan Barang">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tgl Keluar</label>
                        <input name="tanggal_keluar" required type="date" class="form-control" >
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
