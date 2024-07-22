<!-- resources/views/mall/show.blade.php -->
<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>{{ $title }}</span>
            <div>
                <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#tambahLantai"><i
                        class="fa fa-plus"></i> Lantai</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($lantai as $l)
                    <div class="col-sm-3 col-lg-3">
                        <div class="card mb-2">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Lantai {{ $l->nama_lantai }}</span>
                                <div>
                                    <a class="btn btn-sm btn-warning" href="#" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop{{ $l->id_lantai }}"><i
                                            class="fa fa-pencil-alt"></i></a>
                                    <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal"
                                        data-bs-target="#tambahSlot{{ $l->id_lantai }}"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('images/denah/' . $l->denah) }}" alt="" class="img-fluid">
                                <div class="row">
                                    <div class="col">
                                        @foreach ($slot as $s)
                                            @if ($l->id_lantai == $s->id_lantai)
                                                <a class="badge text-decoration-none text-center {{ $s->status == 'Kosong' ? 'text-bg-dark' : 'text-bg-danger' }}"
                                                    href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editslot{{ $s->id_slot }}">{{ $s->nama_slot }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('mall.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <!-- Modal Detail Lantai -->
    @foreach ($lantai as $item)
        <div class="modal fade" id="staticBackdrop{{ $item->id_lantai }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Lantai {{ $item->nama_lantai }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('lantai.update', $item->id_lantai) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_lantai{{ $item->id_lantai }}" class="form-label">Nama Lantai</label>
                                <input type="text" class="form-control" id="nama_lantai{{ $item->id_lantai }}"
                                    name="nama_lantai" placeholder="Masukan nama lantai"
                                    value="{{ $item->nama_lantai }}">
                                <div class="form-text">Contoh nama: <b>B1</b></div>
                            </div>
                            <div class="mb-3">
                                <label for="editGambar{{ $item->id_lantai }}" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="editGambar{{ $item->id_lantai }}"
                                    name="denah" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <img id="previewImageEdit{{ $item->id_lantai }}" class="img-preview"
                                    src="{{ asset('images/denah/' . $item->denah) }}" alt="denah"
                                    style="max-width: 100%;">
                            </div>
                            <input type="hidden" name="id_mall" value="{{ request()->segment(2) }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <form action="{{ route('lantai.destroy', $item->id_lantai) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    {{-- tambah lantai --}}
    <div class="modal fade" id="tambahLantai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Lantai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('lantai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_lantai" class="form-label">Nama lantai</label>
                            <input type="text" class="form-control" id="nama_lantai" name="nama_lantai"
                                placeholder="Masukan nama lantai" required>
                            <div id="emailHelp" class="form-text">Contoh nama: <b>B1</b></div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="denah"
                                accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <img id="previewImage" class="img-preview" src="#" alt="Preview Gambar"
                                style="max-width: 100%; display: none;">
                        </div>
                        <input type="hidden" name="id_mall" value="{{ Request::segment(2) }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('gambar').addEventListener('change', function() {
            const preview = document.getElementById('previewImage');
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            }
        });
    </script>


    <!-- Modal Detail Slot -->
    @foreach ($slot as $s)
        <div class="modal fade" id="editslot{{ $s->id_slot }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Slot Parkir</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('slot.update', ['id_slot' => $s->id_slot]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_slot{{ $s->id_slot }}" class="form-label">Nama Slot</label>
                                <input type="text" class="form-control" id="nama_slot{{ $s->id_slot }}"
                                    name="nama_slot" value="{{ $s->nama_slot }}">
                                <div class="form-text">Contoh nama: <b>B1A</b></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="terisi{{ $s->id_slot }}" value="Terisi"
                                        {{ $s->status == 'Terisi' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="terisi{{ $s->id_slot }}">
                                        Terisi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="kosong{{ $s->id_slot }}" value="Kosong"
                                        {{ $s->status == 'Kosong' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="kosong{{ $s->id_slot }}">
                                        Kosong
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <form action="{{ route('slot.destroy', ['id_slot' => $s->id_slot]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    {{-- tambah slot --}}
    @foreach ($lantai as $l)
        <div class="modal fade" id="tambahSlot{{ $l->id_lantai }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Slot Parkir</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('slot.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_slot{{ $l->id_lantai }}" class="form-label">Nama Slot</label>
                                <input type="text" class="form-control" id="nama_slot{{ $l->id_lantai }}"
                                    name="nama_slot" placeholder="Masukan nama slot parkir">
                                <div class="form-text">Contoh nama: <b>B1A</b></div>
                            </div>
                            <input type="hidden" name="id_lantai" value="{{ $l->id_lantai }}">
                            <input type="hidden" name="status" value="Kosong">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
