<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Data Terkini Mall yang Terdaftar</span>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahMallModal">
                <i class="fa fa-plus"></i> Tambah Mall
            </button>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-start">Gambar</th>
                        <th>Nama Mall</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mall as $m)
                        <tr data-id="{{ $m->id }}" data-nama="{{ $m->nama_mall }}">
                            <td class="d-flex justify-content-start">
                                <img src="{{ asset('images/mall/' . $m->gambar) }}" alt="" style="width: 200px">
                            </td>
                            <td class="align-middle">
                                <h5>{{ $m->nama_mall }}</h5>
                                <a href="{{ route('mall.show', ['mall' => $m->id_mall]) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                                <button type="button" class="btn btn-info btn-sm edit-mall" data-bs-toggle="modal"
                                    data-bs-target="#editMallModal{{ $m->id_mall }}">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm delete-mall" data-bs-toggle="modal"
                                    data-bs-target="#deleteMallModal{{ $m->id_mall }}">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-start">Gambar</th>
                        <th>Nama Mall</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Mall -->
    <div class="modal fade" id="tambahMallModal" tabindex="-1" aria-labelledby="tambahMallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('mall.store') }}" method="POST" enctype="multipart/form-data"
                    id="tambahMallForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahMallModalLabel">Tambah Mall Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaMall" class="form-label">Nama Mall</label>
                            <input type="text" class="form-control" id="namaMall" name="nama_mall" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <img id="previewImage" class="img-preview" src="#" alt="Preview Gambar"
                                style="max-width: 100%; display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mall -->
    @foreach ($mall as $item)
        <div class="modal fade" id="editMallModal{{ $item->id_mall }}" tabindex="-1"
            aria-labelledby="editMallModalLabel{{ $item->id_mall }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editMallForm{{ $item->id_mall }}"
                        action="{{ route('mall.update', ['mall' => $item->id_mall]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMallModalLabel{{ $item->id_mall }}">Edit Mall</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editNamaMall" class="form-label">Nama Mall</label>
                                <input type="text" class="form-control" id="editNamaMall{{ $item->id_mall }}"
                                    name="nama_mall" value="{{ $item->nama_mall }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editGambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="editGambar{{ $item->id_mall }}"
                                    name="gambar" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <img id="previewImageEdit{{ $item->id_mall }}" class="img-preview"
                                    src="{{ asset('images/mall/' . $item->gambar) }}" alt="Preview Gambar"
                                    style="max-width: 100%;">
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

    <!-- Modal Hapus Mall -->
    @foreach ($mall as $item)
        <div class="modal fade" id="deleteMallModal{{ $item->id_mall }}" tabindex="-1"
            aria-labelledby="deleteMallModalLabel{{ $item->id_mall }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteMallForm{{ $item->id_mall }}"
                        action="{{ route('mall.destroy', ['mall' => $item->id_mall]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteMallModalLabel{{ $item->id_mall }}">Hapus Mall</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus mall ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#gambar').change(function() {
                previewImage(this);
            });

            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('[id^=editGambar]').change(function() {
                var id = $(this).attr('id').replace('editGambar', '');
                previewImageEdit(this, id);
            });

            function previewImageEdit(input, id) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImageEdit' + id).attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>

</x-layout>
