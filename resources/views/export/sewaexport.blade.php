<table>
    <thead>
        <tr>
            <th style="text-align: center; font-weight:bold">No</th>
            <th style="text-align: center; font-weight:bold">Tanggal Sewa</th>
            <th style="text-align: center; font-weight:bold">Nama Kendaraan</th>
            <th style="text-align: center; font-weight:bold">Nama Driver</th>
            <th style="text-align: center; font-weight:bold">Penyetuju 1</th>
            <th style="text-align: center; font-weight:bold">Penyetuju 2</th>
            <th style="text-align: center; font-weight:bold">Acc 1</th>
            <th style="text-align: center; font-weight:bold">Acc 2</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sewa as $item)
            <tr style="text-align:center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tanggal_sewa }}</td>
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
                    <td><span class="badge badge-danger">Belum Disetujui</span></td>
                @else
                    <td><span class="badge badge-warning">Disetujui</span></td>
                @endif

                @if ($item->acc_2 == 0)
                    <td><span class="badge badge-danger">Belum Disetujui</span></td>
                @else
                    <td><span class="badge badge-warning">Disetujui</span></td>
                @endif
            </tr>
           
           @endforeach
    </tbody>
</table>