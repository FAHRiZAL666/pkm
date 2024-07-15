<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <title>Park Cam Emotrack</title>
  <style>





  </style>
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
      <div class="navbar-brand">Navbar</div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ">
          <li class="nav-item dropdown me-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Lantai
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" id="B1" href="#">B1</a></li>
              <li><a class="dropdown-item" id="B2" href="#">B2</a></li>
              <li><a class="dropdown-item" id="B3" href="#">B3</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="denah">
    <div>DENAH</div>
    <img src="images/denah.jpg" alt="">
  </div>

  <div class="cctv">
    <div id="svp_player9eruz4l2mvc4"></div>
  </div>

  <div class="text-booking">
    BOOKING
  </div>

  <form action="{{ route('booking.store') }}" method="POST">
    @csrf
    <div class="container p-0 mt-3 slot">
        <div class="row slot-booking ms-1">
            @foreach(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'] as $letter)
                <div class="col-1">
                    <input type="radio" class="select-slot" id="B1{{ $letter }}" name="slot[]" value="B1{{ $letter }}"
                           data-slot="B1{{ $letter }}"
                           {{ in_array("B1$letter", $bookedSlots) ? 'disabled' : '' }}>
                    <label for="B1{{ $letter }}" class="select-slot-label">B1{{ $letter }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="btn-booking">
        <button type="submit" id="bookingButton">BOOKING</button>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>



  <script language="javascript" type="text/javascript" src="//play.streamingvideoprovider.com/js/dplayer.js"></script>
  <script language="javascript">
    var vars = {
        clip_id: "9eruz4l2mvc4",
        transparent: "true",
        pause: "1",
        repeat: "",
        bg_color: "#ffffff",
        fs_mode: "2",
        no_controls: "",
        start_img: "0",
        start_volume: "34",
        close_button: "",
        brand_new_window: "1",
        auto_hide: "1",
        stretch_video: "",
        player_align: "NONE",
        offset_x: "0",
        offset_y: "0",
        player_color_ratio: 0.6,
        skinAlpha: "50",
        colorBase: "#250864",
        colorIcon: "#ffffff",
        colorHighlight: "#7f54f8",
        direct: "false",
        is_responsive: "true",
        viewers_limit: 0,
        cc_position: "bottom",
        cc_positionOffset: 70,
        cc_multiplier: 0.03,
        cc_textColor: "#ffffff",
        cc_textOutlineColor: "#ffffff",
        cc_bkgColor: "#000000",
        cc_bkgAlpha: 0.1,
        aspect_ratio: "16:9",
        play_button: "1",
        play_button_style: "pulsing",
        sleek_player: "1",
        auto_play: "0",
        auto_play_type: "unMute",
        floating_player: "none"
    };
    var svp_player = new SVPDynamicPlayer("svp_player9eruz4l2mvc4", "", "100%", "100%", {
        use_div: "svp_player9eruz4l2mvc4",
        skin: "3"
    }, vars);
    svp_player.execute();
  </script>
  <noscript>Your browser does not support JavaScript! JavaScript is needed to display this video player!</noscript>

  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
