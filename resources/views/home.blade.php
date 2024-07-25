<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- custom style --}}
    <link rel="stylesheet" href="style.css">
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Danfo&family=Luckiest+Guy&family=Song+Myung&display=swap"
        rel="stylesheet">
    <style>
        .carousel-container {
            position: relative;
            height: 520px;
            /* Atur tinggi Carousel sesuai kebutuhan */
        }

        .masthead {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 50vh; */
            /* Adjust height as needed */
            background-size: contain;
            /* Adjust to contain */
            background-position: center;
            /* Prevent tiling */
        }

        .color-overlay {
            background: rgba(0, 0, 0, 0.5);
            /* Optional: Add overlay color */
            width: 100%;
            height: 100%;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            /* X-offset, Y-offset, blur radius, color */
        }

        @media (max-width: 768px) {
            .masthead {
                background-size: contain;
                /* Prevent zoom in on smaller devices */
            }

            .color-overlay {
                padding: 20px;
                /* Optional: Add padding for better appearance on smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="masthead" style="background-image: url(images/bg.jpeg);">
        <div class="color-overlay d-flex justify-content-center align-items-center">
            <h3 class="text-light text-shadow">PARKCAMEMOTRACK</h3>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-6 d-flex justify-content-start">
                <h4>LOKASI</h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <input type="text" id="search-input"
                    class="search-box border border-2 border-dark rounded-pill p-1 px-3" placeholder="Cari Mall">
            </div>
        </div>
    </div>

    <div class="container mt-3 carousel-container">
        <div id="mallCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                @foreach ($mall->chunk(4) as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            @foreach ($chunk as $item)
                                <div class="col-3 card mx-2 mb-3 border border-0 bg-dark p-0">
                                    <a href="{{ route('home.show', ['id_mall' => $item->id_mall]) }}" class="btn">
                                        <img src="{{ asset('images/mall/' . $item->gambar) }}"
                                            class="card-img-top mt-2 ms-0" alt="{{ $item->nama_mall }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->nama_mall }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="carousel-indicators" style="bottom: -50px">
                @foreach ($mall->chunk(4) as $index => $chunk)
                    <button type="button" data-bs-target="#mallCarousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }} bg-dark" aria-current="true"
                        aria-label="Slide {{ $index }}"></button>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event listener untuk input search
            $('#search-input').on('input', function() {
                var searchValue = $(this).val().trim();

                // Jika input kosong, tampilkan semua data mall
                if (searchValue === '') {
                    renderAllMalls();
                } else {
                    // Jika tidak kosong, kirim request pencarian ke server
                    $.ajax({
                        url: '{{ route('search') }}', // Sesuaikan dengan route pencarian di Laravel
                        method: 'GET',
                        data: {
                            keyword: searchValue
                        },
                        success: function(response) {
                            renderMalls(
                                response); // Memanggil fungsi untuk menampilkan hasil pencarian
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });

            // Fungsi untuk menampilkan semua data mall dalam slide
            function renderAllMalls() {
                var carouselInner = $('#mallCarousel .carousel-inner');
                carouselInner.empty(); // Kosongkan konten carousel
                var totalSlides = 0;

                @foreach ($mall->chunk(4) as $index => $chunk)
                    var carouselItem = '<div class="carousel-item {{ $index === 0 ? 'active' : '' }}">' +
                        '<div class="row justify-content-center">';
                    @foreach ($chunk as $item)
                        carouselItem += '<div class="col-3 card mx-2 mb-3 border border-0 bg-dark p-0">' +
                            '<a href="{{ route('home.show', ['id_mall' => $item->id_mall]) }}" class="btn">' +
                            '<img src="{{ asset('images/mall/' . $item->gambar) }}" class="card-img-top mt-2 ms-0" alt="{{ $item->nama_mall }}">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">{{ $item->nama_mall }}</h5>' +
                            '</div>' +
                            '</a>' +
                            '</div>';
                    @endforeach
                    carouselItem += '</div></div>';
                    carouselInner.append(carouselItem);
                    totalSlides++;
                @endforeach

                // Refresh indikator carousel
                refreshCarouselIndicators(totalSlides);
            }

            // Fungsi untuk menampilkan hasil pencarian dalam slide
            function renderMalls(malls) {
                var carouselInner = $('#mallCarousel .carousel-inner');
                carouselInner.empty(); // Kosongkan konten carousel

                // Periksa apakah hasil pencarian kurang dari atau sama dengan 4
                var totalSlides = 0;
                if (malls.length <= 4) {
                    var carouselItem = '<div class="carousel-item active">' +
                        '<div class="row justify-content-center">';
                    malls.forEach(function(mall) {
                        carouselItem += '<div class="col-3 card mx-2 mb-3 border border-0 bg-dark p-0">' +
                            '<a href="{{ route('home.show', ['id_mall' => $item->id_mall]) }}" class="btn">' +
                            '<img src="' + mall.image + '" class="card-img-top mt-2 ms-0" alt="' + mall
                            .name + '">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">' + mall.name + '</h5>' +
                            '</div>' +
                            '</a>' +
                            '</div>';
                    });
                    carouselItem += '</div></div>';
                    carouselInner.append(carouselItem);
                    totalSlides++;
                } else {
                    malls.forEach(function(mall, index) {
                        var activeClass = index === 0 ? 'active' : '';
                        var carouselItem = '<div class="carousel-item ' + activeClass + '">' +
                            '<div class="row justify-content-center">' +
                            '<div class="col-3 card mx-2 mb-3 border border-0 bg-dark p-0">' +
                            '<a href="{{ route('home.show', ['id_mall' => $item->id_mall]) }}" class="btn">' +
                            '<img src="' + mall.image + '" class="card-img-top mt-2 ms-0" alt="' + mall
                            .name + '">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">' + mall.name + '</h5>' +
                            '</div>' +
                            '</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        carouselInner.append(carouselItem);
                        totalSlides++;
                    });
                }

                // Refresh indikator carousel
                refreshCarouselIndicators(totalSlides);
            }

            // Fungsi untuk menyegarkan indikator carousel
            function refreshCarouselIndicators(totalSlides) {
                var carouselIndicators = $('.carousel-indicators');
                carouselIndicators.empty();

                // Hitung jumlah indikator sesuai dengan jumlah slide
                for (var i = 0; i < totalSlides; i++) {
                    var indicatorClass = i === 0 ? 'active' : '';
                    var indicator = '<button type="button" data-bs-target="#mallCarousel" data-bs-slide-to="' + i +
                        '" class="' + indicatorClass + ' bg-dark" aria-current="true" aria-label="Slide ' + i +
                        '"></button>';
                    carouselIndicators.append(indicator);
                }
            }

            // Render semua data mall saat halaman pertama kali dimuat
            renderAllMalls();
        });
    </script>

    <div class="container mt-4">
        <a href="{{ route('karcis') }}" class="btn btn-light btn-dark rounded-pill btn-lg mb-4 mt-5"
            role="button">KARCIS</a>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
