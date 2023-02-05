@extends('layouts.template')

@section('title', 'Sewa Kendaraan')

@section('main')
    <h1 class="h3 mb-2 text-gray-800">Sewa Kendaraan</h1>

    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Control')
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-fw fa-plus fa-beat-fade"></i> Tambah Data
        </button>
        
    @endif
    <a href="/sewaexport" class="btn btn-warning mb-3"><i class="fa-solid fa-print"></i> Cetak Data</a>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sewa Kendaraan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Sewa</th>
                            <th>Nama Kendaraan</th>
                            <th>Nama Driver</th>
                            <th>Penyetuju 1</th>
                            <th>Penyetuju 2</th>
                            <th>Acc 1</th>
                            <th>Acc 2</th>
                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Control')
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sewa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @php
                                    setlocale(LC_ALL, 'IND');
                                    $tanggal = date_create($item->tanggal_sewa);
                                    $data =  \Carbon\Carbon::parse($tanggal)->formatLocalized('%d %B %Y');
                                @endphp
                                <td>{{ $data }}</td>
                                <td>{{ $item->kendaraan->nama_kendaraan }}</td>
                                <td>{{ $item->driver->nama_driver}}</td>
                                @php
                                    $pen1 = DB::table('users')->join('sewas', 'users.id', '=', 'sewas.penyetuju_1')->where('penyetuju_1', '=', $item->penyetuju_1)->get();
                                @endphp
                                    @foreach ($pen1 as $nama)
                                        <td>{{ $nama->nama }}</td>
                                    @endforeach

                                @php
                                    $pen2 = DB::table('users')->join('sewas', 'users.id', '=', 'sewas.penyetuju_2')->where('penyetuju_2', '=', $item->penyetuju_2)->get();
                                @endphp
                                    @foreach ($pen2 as $nama2)
                                        <td>{{ $nama2->nama }}</td>
                                    @endforeach

                                @if ($item->acc_1 == 0)
                                    @if (Auth::user()->id == $item->penyetuju_1)
                                        <td><a href="acc1/{{ $item->id }}" class="btn btn-sm btn-danger">Belum Disetujui</a></td>
                                    @else
                                        <td><span class="badge badge-danger">Belum Disetujui</span></td>
                                    @endif
                                @else
                                    <td><span class="badge badge-warning">Disetujui</span></td>
                                @endif

                                @if ($item->acc_2 == 0)
                                    @if (Auth::user()->id == $item->penyetuju_2)
                                        <td><a href="acc2/{{ $item->id }}" class="btn btn-sm btn-danger">Belum Disetujui</a></td>
                                    @else
                                        <td><span class="badge badge-danger">Belum Disetujui</span></td>
                                    @endif
                                @else
                                    <td><span class="badge badge-warning">Disetujui</span></td>
                                @endif
                                @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Control')
                                <td class="d-flex">
                                    <a href="" class="btn btn-danger ml-2" data-toggle="modal"
                                    data-target="#delData{{ $item->id }}"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                @endif

                            </tr>
                           
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
                                        <form action="{{ route('sewa.destroy', $item->id) }}" method="POST">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Sewa Kendaraan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sewa.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Sewa</label>
                            <input type="date" class="form-control" name="tanggal_sewa" id="tanggal">
                        </div>
                        <div class="form-group">
                            <label>Nama Kendaraan</label>
                            <select name="kendaraan_id" id="" class="form-control" required>
                                <option value="" disabled selected>Pilih Nama Kendaraan...</option>
                                @foreach ($kendaraan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kendaraan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Driver</label>
                            <select name="driver_id" id="" class="form-control" required>
                                <option value="" disabled selected>Pilih Nama Driver...</option>
                                @foreach ($driver as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_driver }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penyetuju 1</label>
                            <select name="penyetuju_1" id="" class="form-control" required>
                                <option value="" disabled selected>Pilih Penyetuju 1...</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penyetuju 2</label>
                            <select name="penyetuju_2" id="" class="form-control" required>
                                <option value="" disabled selected>Pilih Penyetuju 2...</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
