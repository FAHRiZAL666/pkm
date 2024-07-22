<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karcis Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bdy">
    <div class="karcis">
        <div class="head-karcis">KARCIS</div>
        @if ($kendaraan->isEmpty())
            <div class="bdy-karcis fs-5 text-center fst-italic text danger">Anda belum melakukan pemesanan slot parkir
            </div>
        @else
            @foreach ($kendaraan as $data)
                @foreach ($mall as $m)
                    @if ($data->id_mall == $m->id_mall)
                        <div class="bdy-karcis">Mall : {{ $m->nama_mall }}</div>
                    @endif
                @endforeach
                @foreach ($lantai as $l)
                    @if ($data->id_lantai == $l->id_lantai)
                        <div class="bdy-karcis">Lantai : {{ $l->nama_lantai }}</div>
                    @endif
                @endforeach
                @foreach ($slot as $s)
                    @if ($data->id_slot == $s->id_slot)
                        <div class="bdy-karcis">Slot : {{ $s->nama_slot }}</div>
                    @endif
                @endforeach
                <div class="bdy-karcis">Status : {{ $data->status }}</div>
                <div class="bdy-karcis">Jam Masuk : {{ \Carbon\Carbon::parse($data->jam_masuk)->format('H:i') }}</div>
                {{-- Tambahkan logika untuk jam keluar di sini jika sudah ada --}}
                <div class="noted">*NOTED : JIKA LEBIH DARI JAM MASUK PARKIRAN TIDAK TERISI, SISTEM AKAN TERHAPUS.
                    SEHINGGA
                    MENJADI KOSONG KEMBALI, DAN ANDA HARUS MEMESAN LAGI</div>
            @endforeach
        @endif
    </div>
    <div class="container">
        <a href="{{ route('home') }}" class="btn btn-light rounded-pill btn-lg mb-4 mt-5" role="button">KARCIS</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
