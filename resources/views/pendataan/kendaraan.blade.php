@extends('layouts.template')

@section('title', 'Data Kendaraan')

@section('main')
    <h1 class="h3 mb-2 text-gray-800">Data Kendaraan</h1>

    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-fw fa-plus fa-beat-fade"></i> Tambah Data
    </button>
    <a href="/kendaraanexport" class="btn btn-warning mb-3"><i class="fa-solid fa-print"></i> Cetak Data</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kendaraan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kendaraan</th>
                            <th>Jenis</th>
                            <th>Konsumsi BBM</th>
                            <th>Jadwal Maintenance</th>
                            <th>Asal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kendaraan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kendaraan }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>Rp {{ number_format("$item->konsumsi_bbm", 0, ',', '.') }}</td>
                                @php
                                    setlocale(LC_ALL, 'IND');
                                    $tanggal = date_create($item->jadwal);
                                    $data =  \Carbon\Carbon::parse($tanggal)->formatLocalized('%d %B %Y');
                                @endphp
                                <td>{{ $data }}</td>
                                <td>{{ $item->asal }}</td>
                                @if ($item->status == 0)
                                    <td><span class="badge badge-warning">Tersedia</span></td>
                                @else
                                    <td><span class="badge badge-danger">Disewakan</span></td>
                                @endif
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
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Kendaraan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kendaraan.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label>Nama Kendaraan</label>
                                                    <input type="text" class="form-control" value="{{ $item->nama_kendaraan }}" name="nama_kendaraan">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis</label>
                                                    <select name="jenis" id="" class="form-control">
                                                        <option value="" disabled selected>Pilih Jenis...</option>
                                                        <option value="Angkutan Barang" @if ($item->jenis == 'Angkutan Barang')
                                                            @selected($item->jenis == 'Angkutan Barang')
                                                        @endif>Angkutan Barang</option>
                                                        <option value="Angkutan Orang" @if ($item->jenis == 'Angkutan Barang')
                                                            @selected($item->jenis == 'Angkutan Orang')
                                                        @endif>Angkutan Orang</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Konsumsi BBM</label>
                                                    <input type="number" class="form-control" value="{{ $item->konsumsi_bbm }}" name="konsumsi_bbm">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jadwal Maintenance</label>
                                                    <input type="date" class="form-control" value="{{ $item->jadwal }}" name="jadwal">
                                                </div>
                                                <div class="form-group">
                                                    <label>Asal</label>
                                                    <select name="asal" id="" class="form-control">
                                                        <option value="" disabled selected>Pilih Asal...</option>
                                                        <option value="Perusahaan" @if ($item->asal == 'Perusahaan')
                                                            @selected($item->asal == 'Perusahaan')
                                                        @endif>Perusahaan</option>
                                                        <option value="Penyewaan" @if ($item->asal == 'Penyewaan')
                                                            @selected($item->asal == 'Penyewaan')
                                                        @endif>Penyewaan</option>
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
                                        <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                   <p>Apa anda yakin ingin menghapus data <span class="badge badge-danger">{{ $item->nama_kendaraan }}</span> ?</p> 
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kendaraan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Kendaraan</label>
                            <input type="text" class="form-control" name="nama_kendaraan">
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                           <select name="jenis" id="" class="form-control">
                            <option value="" disabled selected>Pilih Jenis...</option>
                            <option value="Angkutan Barang">Angkutan Barang</option>
                            <option value="Angkutan Orang">Angkutan Orang</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label>Konsumsi BBM</label>
                            <input type="number" class="form-control" name="konsumsi_bbm">
                        </div>
                        <div class="form-group">
                            <label>Jadwal Maintenance</label>
                            <input type="date" class="form-control" name="jadwal" id="tanggal">
                        </div>
                        <div class="form-group">
                            <label>Asal</label>
                            <select name="asal" id="" class="form-control">
                                <option value="" disabled selected>Pilih Asal...</option>
                                <option value="Perusahaan">Perusahaan</option>
                                <option value="Penyewaan">Penyewaan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
