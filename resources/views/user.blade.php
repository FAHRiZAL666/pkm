<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Data Pengguna</span>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                <i class="fa fa-plus"></i> Tambah Pengguna
            </button>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-start">No</th>
                        <th class="text-start">UID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <!-- Tambahkan $index -->
                        <tr data-id="{{ $user->id_user }}" data-nama="{{ $user->nama }}">
                            <td class="text-start fw-bold">{{ $index + 1 }}</td> <!-- Tampilkan nomor urut -->
                            <td class="text-start">{{ $user->uid }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-info btn-sm edit-user" data-bs-toggle="modal"
                                    data-bs-target="#editUserModal{{ $user->id_user }}">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteUserModal{{ $user->id_user }}">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-start">No</th>
                        <th class="text-start">UID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.store') }}" method="POST" id="tambahUserForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahUserModalLabel">Tambah Pengguna Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="uid" class="form-label">UID</label>
                            <input type="text" class="form-control" id="uid" name="uid" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengguna -->
    @foreach ($users as $user)
        <div class="modal fade" id="editUserModal{{ $user->id_user }}" tabindex="-1"
            aria-labelledby="editUserModalLabel{{ $user->id_user }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('users.update', ['id_user' => $user->id_user]) }}" method="POST"
                        id="editUserForm{{ $user->id_user }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id_user }}">Edit Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editUid{{ $user->id_user }}" class="form-label">UID</label>
                                <input type="text" class="form-control" id="editUid{{ $user->id_user }}"
                                    name="uid" value="{{ $user->uid }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNama{{ $user->id_user }}" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="editNama{{ $user->id_user }}"
                                    name="nama" value="{{ $user->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail{{ $user->id_user }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail{{ $user->id_user }}"
                                    name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPassword{{ $user->id_user }}" class="form-label">Password (Kosongkan
                                    jika tidak diubah)</label>
                                <input type="password" class="form-control" id="editPassword{{ $user->id_user }}"
                                    name="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Hapus Pengguna -->
    @foreach ($users as $user)
        <div class="modal fade" id="deleteUserModal{{ $user->id_user }}" tabindex="-1"
            aria-labelledby="deleteUserModalLabel{{ $user->id_user }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('users.destroy', $user->id_user) }}" method="POST"
                        id="deleteUserForm{{ $user->id_user }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


</x-layout>
