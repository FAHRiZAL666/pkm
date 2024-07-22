<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card">
        <div class="card-header">
            Data Terkini Mobil di Parkiran
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-start">Pengendara</th>     
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th>Mall</th>
                            <th>Slot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kendaraan as $mobil)
                            <tr>
                                <td>
                                    @foreach ($users as $user)
                                        @if ($user->id_user == $mobil->id_user)
                                            {{ $user->nama }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $mobil->jam_masuk }}</td>
                                <td>{{ $mobil->jam_keluar }}</td>
                                <td>{{ $mobil->status }}</td>
                                <td>
                                    @foreach ($mall as $m)
                                        @if ($m->id_mall == $mobil->id_mall)
                                            {{ $m->nama_mall }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($slot as $s)
                                        @if ($s->id_slot == $mobil->id_slot)
                                            {{ $s->nama_slot }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Pengendara</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th>Mall</th>
                            <th>Slot</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</x-layout>
