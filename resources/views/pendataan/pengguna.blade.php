@extends('layouts.template')

@section('title', 'Data Pengguna')

@section('main')
    <h1 class="h3 mb-2 text-gray-800">Data Pengguna</h1>

    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-fw fa-plus fa-beat-fade"></i> Tambah Data
    </button>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->username}}</td>
                                <td>{{ $item->role }}</td>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Role Pengguna</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('user.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label>Role Pengguna</label>
                                                    <select name="role" class="form-control" id="">
                                                        <option value="Admin" @if ($item->role == 'Admin') @selected($item->role == 'Admin') @endif>Admin</option>
                                                        <option value="Control"  @if ($item->role == "Control") @selected($item->role == "Control") @endif>Control</option>
                                                        <option value="Manajer"  @if ($item->role == "Manajer") @selected($item->role == "Manajer") @endif>Manajer</option>
                                                        <option value="Boss"  @if ($item->role == "Boss") @selected($item->role == "Boss") @endif>Boss</option>
                                                    </select>
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
                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                   <p>Apa anda yakin ingin menghapus data <span class="badge badge-danger">{{ $item->nama }}</span> ?</p> 
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pengguna</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label>Alamat Pengguna</label>
                            <input type="text" class="form-control" name="alamat">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control" id="">
                                <option value="Admin">Admin</option>
                                <option value="Control">Control</option>
                                <option value="Manajer">Manajer</option>
                                <option value="Boss">Boss</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
