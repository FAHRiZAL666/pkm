<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <title>Park Cam Emotrack</title>
</head>

<body>
    {{-- list Lantai --}}
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Lantai {{ $lantaiSelected['nama_lantai'] }}</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Lantai
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($lantai as $item)
                                @if ($lantaiSelected['id_mall'] == $item->id_mall)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('home.mall.lantai', ['id_lantai' => $item->id_lantai]) }}">{{ $item->nama_lantai }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Denah --}}
    <div class="container mt-3">
        <h4 class="d-flex justify-content-center fw-bold text-decoration-underline">DENAH</h4>
        <img src="{{ asset('images/denah/' . $lantaiSelected['denah']) }}" alt="" class="img-fluid w-100">
    </div>

    {{-- CCTV --}}
    <div class="container mt-5">
        <h4 class="d-flex justify-content-center fw-bold text-decoration-underline mb-3">CCTV</h4>
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/S1UUTNBFHSw?si=0igShgHdLsSKQAsi" title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>

    {{-- BOOKING --}}
    <section class="container mt-5 mb-5">
        <h4 class="d-flex justify-content-center fw-bold text-decoration-underline mb-3">BOOKING</h4>
        <div class="row">
            @foreach ($slot as $item)
                @if ($lantaiSelected['id_lantai'] == $item->id_lantai)
                    <div class="col-3 col-md-2 d-flex justify-content-center">
                        <button type="button"
                            class="btn {{ $item->status == 'Kosong' ? 'btn-dark' : 'btn-danger disabled' }} btn-lg mb-2"
                            data-slotid="{{ $item->id_slot }}"
                            data-lantaiid="{{ $lantaiSelected['id_lantai'] }}"data-mallid="{{ $lantaiSelected['id_mall'] }}"
                            onclick="selectSlot(this)">
                            {{ $item->nama_slot }}
                        </button>
                    </div>
                @endif
            @endforeach
        </div>
        <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" class="container"
            style="width: 100%!important">
            @csrf
            <input type="hidden" name="slot_id" id="slot_id">
            <input type="hidden" name="lantai_id" id="lantai_id">
            <input type="hidden" name="mall_id" id="mall_id">
            <div class="row d-flex justify-content-center mt-3">
                <button type="submit" id="btnBooking"
                    class="btn btn-outline-dark rounded rounded-pill">BOOKING</button>
            </div>
        </form>
    </section>

    <script>
        function selectSlot(button) {
            // Menghapus kelas 'btn-dark' dan menambahkan 'btn-selected'
            button.classList.remove('btn-dark');
            button.classList.add('btn-selected', 'btn-success');

            // Mendapatkan semua tombol
            const buttons = document.querySelectorAll('button');
            buttons.forEach(btn => {
                // Menghapus kelas 'btn-selected' dari tombol lainnya
                if (btn !== button && btn.classList.contains('btn-selected')) {
                    btn.classList.remove('btn-selected');
                    btn.classList.add('btn-dark');
                }
            });

            // Menyimpan ID slot dan ID lantai ke input tersembunyi
            document.getElementById('slot_id').value = button.dataset.slotid;
            document.getElementById('lantai_id').value = button.dataset.lantaiid;
            document.getElementById('mall_id').value = button.dataset.mallid;
        }
    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
