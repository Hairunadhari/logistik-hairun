@extends('layout')
@section('content')
<style>
    svg{
        width: 20px
    }
</style>
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Add New
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="/submit-barang" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Input Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                       
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Barang</label>
                            <input name="nama_barang" required type="text" class="form-control" placeholder="Nama Barang">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                    <tr>
                        <td> {{ $data->firstItem() + $key }}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td>
                            <form action="/delete-barang/{{$item->id}}" method="post" onsubmit="return confirm('anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#exampleModaledit{{$item->id}}">
                                    Edit
                                </button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $data->links() !!}
        </div>
        </div>

    </div>

    @foreach ($data as $item)
    <!-- Modal edit -->
    <div class="modal fade" id="exampleModaledit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="/update-barang/{{$item->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" required value="{{$item->nama_barang}}" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
@endforeach

@endsection
