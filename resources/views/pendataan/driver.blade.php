@extends('layouts.template')

@section('title', 'Data Driver')

@section('main')
    <h1 class="h3 mb-2 text-gray-800">Data Driver</h1>

    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Control')
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-fw fa-plus fa-beat-fade"></i> Tambah Data
        </button>
    @endif
    <a href="/driverexport" class="btn btn-warning mb-3"><i class="fa-solid fa-print"></i> Cetak Data</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Driver</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Driver</th>
                            <th>Alamat Driver</th>
                            <th>Telepon Driver</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($driver as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_driver }}</td>
                                <td>{{ $item->alamat_driver }}</td>
                                <td>{{ $item->telepon_driver }}</td>
                                <td class="d-flex">
                                    <a href="" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editData{{ $item->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-danger ml-2" data-toggle="modal"
                                    data-target="#delData{{ $item->id }}"><i class="fa-solid fa-trash"></i></a>
                                </td>

                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editData{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Driver</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('driver.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label>Nama Driver</label>
                                                    <input type="text" class="form-control" value="{{ $item->nama_driver }}" name="nama_driver">
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Driver</label>
                                                    <input type="text" class="form-control" value="{{ $item->alamat_driver }}" name="alamat_driver">
                                                </div>
                                                <div class="form-group">
                                                    <label>Telepon Distributor</label>
                                                    <input type="text" class="form-control" value="{{ $item->telepon_driver }}" name="telepon_driver">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <!-- Modal Edit Akhir-->
                             <!-- Modal Delete-->
                                <div class="modal fade" id="delData{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ingin menghapus Data ?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('driver.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                   <p>Apa anda yakin ingin menghapus data <span class="badge badge-danger">{{ $item->nama_driver }}</span> ?</p> 
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Akhir Delete-->
                           @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('driver.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Driver</label>
                            <input type="text" class="form-control" name="nama_driver">
                        </div>
                        <div class="form-group">
                            <label>Alamat Driver</label>
                            <input type="text" class="form-control" name="alamat_driver">
                        </div>
                        <div class="form-group">
                            <label>Telepon Driver</label>
                            <input type="text" class="form-control" name="telepon_driver">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
