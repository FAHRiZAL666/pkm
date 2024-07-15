<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Karcis Parkir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body class="bdy">
  <div class="karcis">
    <div class="head-karcis">KARCIS</div>
    <div class="bdy-karcis">Lantai       : {{ $dataBooking->lantai }}</div>
    <div class="bdy-karcis">Slot Parkir  : {{ $dataBooking->slot_parkir }}</div>
    <div class="bdy-karcis">Jam Masuk    : {{ $dataBooking->jam_masuk->format('H:i') }}</div>
    <div class="bdy-karcis">Jam keluar    : {{ $dataBooking->jam_keluar->format('H:i') }}</div>
    <div class="noted">*NOTED : JIKA LEBIH DARI 5 MENIT PARKIRAN TIDAK TERISI, SISTEM AKAN TERHAPUS. SEHINGGA MENJADI KOSONG KEMBALI.</div>
  </div>
    <div>
        <a href="{{route('home')}}" class="btn btn-light rounded-pill btn-lg mb-4 mt-5" role="button">KARCIS</a>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
