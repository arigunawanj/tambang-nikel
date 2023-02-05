@extends('layouts.template')

@section('title', 'Riwayat Peminjaman')

@section('main')
    <h1 class="h3 mb-2 text-gray-800">Riwayat Peminjaman</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pakai</th>
                            <th>Nama Kendaraan</th>
                            <th>Status</th>
                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Control')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tanggal_pakai }}</td>
                                <td>{{ $item->kendaraan->nama_kendaraan }}</td>
                                @if ($item->status == 0)
                                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Control')
                                        <td><a href="sewakan/{{ $item->id }}" class="badge badge-success">Disewakan</a></td>
                                    @else
                                        <td><span class="badge badge-success">Disewakan</span></td>
                                    @endif
                                @else
                                    <td><span class="badge badge-info">Selesai disewakan</span></td>
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
                                        <form action="{{ route('riwayat.destroy', $item->id) }}" method="POST">
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

   
@endsection
