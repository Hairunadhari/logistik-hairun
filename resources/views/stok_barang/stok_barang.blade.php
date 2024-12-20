@extends('layouts.app')
@section('content')
<div class="section-header">
    <h1>Data Stok Barang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">List Stok Barang</div>
    </div>
</div>
<div class="section-body">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Stok Barang</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Stok Masuk</th>
                                    <th scope="col">Stok Keluar</th>
                                    <th scope="col">Stok Akhir</th>
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
                    data: "stokMasuk",
                },
                {
                    data: "stokKeluar",
                },
                {
                    data: "stok",
                },

            ],
        });

    });

</script>
@endsection