<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Danfo&family=Luckiest+Guy&family=Song+Myung&display=swap" rel="stylesheet">

    <title>Home</title>
  </head>
  <body>
    <div class="masthead" style="background-image: url(images/bg.jpeg);">
        <div class="color-overlay d-flex justify-content-center align-items-center">

        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-3 align-self-start">
              <h4>LOKASI</h4>
            </div>
            <div class="col-2 align-self-start">

              </div>
            <div class="col-2 d-flex ms-3">
                <input type="text" id="search-input" class="search-box border border-2 border-dark rounded-pill p-1 px-3" placeholder="SEARCH">
                <i class="ms-1 mt-1"> <img src="images/search.svg" alt=""></i>
            </div>
          </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-3 card ms-auto border border-0 bg-dark p-0">
                <a href="{{route('main')}}" class="btn">
                <img src="images/card4.jpg" class="card-img-top mt-2 ms-0" alt="...">
                <div class="card-body">
                  <h5 class="card-title">PVJ</h5>
                </div>
                </a>
            </div>

            <div class="col-1">

            </div>

            <div class="col-3 card me-auto border border-0 bg-dark p-0">
                <a href="#" class="btn">
                <img src="images/card3.jpg" class="card-img-top mt-2" alt="...">
                <div class="card-body">
                  <h5 class="card-title">23 PASKAL</h5>
                </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-3 card ms-auto border border-0 bg-dark p-0">
                <a href="#" class="btn">
                <img src="images/card2.jpg" class="card-img-top mt-2" alt="...">
                <div class="card-body">
                  <h5 class="card-title">TSM</h5>
                </div>
                </a>
            </div>

            <div class="col-1">

            </div>

            <div class="col-3 card me-auto border border-0 bg-dark p-0">
                <a href="#" class="btn">
                <img src="images/card1.jpg" class="card-img-top mt-2" alt="...">
                <div class="card-body">
                  <h5 class="card-title">CIWALK</h5>
                </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
