<?php
session_start();
include "connection.php";
error_reporting(E_ALL^(E_NOTICE|E_WARNING));
if(empty($_SESSION['username'])){ 
    die("Anda belum login"); 
}

$koneksi = mysqli_connect($host, $username, $password, $database);
$user = $_SESSION['username'];
$sql="SELECT * from register where username='$user'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="img/rilisan.png" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <title>Database Santri ICBS Putri</title>
    <!--     Fonts and icons     -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"
    />
    <!-- Nucleo Icons -->
    <link href="css/nucleo-icons.css" rel="stylesheet" />
    <link href="css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script
      src="https://kit.fontawesome.com/42d5adcbca.js"
      crossorigin="anonymous"
    ></script>
    <!-- Material Icons -->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Round"
      rel="stylesheet"
    />
    <!-- CSS Files -->
    <link
      id="pagestyle"
      href="css/material-kit.css?v=3.0.4"
      rel="stylesheet"
    />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script
      defer
      data-site="YOUR_DOMAIN_HERE"
      src="https://api.nepcha.com/js/nepcha-analytics.js"
    ></script>
  </head>
  
<body class="about-us" style="overflow-x: hidden;">
  <nav class="navbar navbar-expand-lg position-sticky top-0 z-index-3 w-100 shadow-none" style="background-color: #fff;">
    <div class="container">
      <img src="img/rilisan.png" style="width: 4%; margin-right: 2%;" alt="logo">
      <a class="navbar-brand text-dark fw-bold "rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank" href="homeadmin.php">
        Database Santri ICSB Putri
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
        <ul class="navbar-nav navbar-nav-hover ms-auto">
          <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
            <a class="nav-link ps-2 text-dark fw-bold d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="material-icons text-dark opacity-6 me-2 text-md">dashboard</i>
              Program
              <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
              <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
            </a>
            <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
              <div class="d-none d-lg-block">
                <a href="dt_kepesantrenan.php" class="dropdown-item border-radius-md">
                  <span>Kepesantrenan</span>
                </a>
                <a href="dt_tahfizh.php" class="dropdown-item border-radius-md">
                  <span>Tahfizh</span>
                </a>
                <a href="dt_prestasi.php" class="dropdown-item border-radius-md">
                  <span>Prestasi</span>
                </a>
                <a href="dt_disiplin.php" class="dropdown-item border-radius-md">
                  <span>Disiplin</span>
                </a>
                <a href="dt_perizinan.php" class="dropdown-item border-radius-md">
                  <span>Perizinan</span>
                </a>
                <a href="dt_minatbakat.php" class="dropdown-item border-radius-md">
                  <span>Minat</span>
                </a>
                <a href="dt_portopolio.php" class="dropdown-item border-radius-md">
                  <span>Portopolio</span>
                </a>
                <a href="rekapan_putri/rekapan.php" class="dropdown-item border-radius-md">
                  <span>Rekapan</span>
                </a>
              </div>
              <div class="d-lg-none">
              <a href="dt_kepesantrenan.php" class="dropdown-item border-radius-md">
                  <span>Kepesantrenan</span>
                </a>
                <a href="dt_tahfizh.php" class="dropdown-item border-radius-md">
                  <span>Tahfizh</span>
                </a>
                <a href="dt_prestasi.php" class="dropdown-item border-radius-md">
                  <span>Prestasi</span>
                </a>
                <a href="dt_disiplin.php" class="dropdown-item border-radius-md">
                  <span>Disiplin</span>
                </a>
                <a href="dt_perizinan.php" class="dropdown-item border-radius-md">
                  <span>Perizinan</span>
                </a>
                <a href="dt_minatbakat.php" class="dropdown-item border-radius-md">
                  <span>Minat</span>
                </a>
                <a href="dt_portopolio.php" class="dropdown-item border-radius-md">
                  <span>Portopolio</span>
                </a>
                <a href="rekapan_putri/rekapan.php" class="dropdown-item border-radius-md">
                  <span>Rekapan</span>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
            <a class="nav-link ps-2 text-dark fw-bold d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="material-icons text-dark opacity-6 me-2 text-md">dashboard</i>
              Grafik
              <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
              <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
            </a>
            <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
              <div class="d-none d-lg-block">
                <a href="grafik_tahfizh.php" class="dropdown-item border-radius-md">
                  <span>Grafik Tahfizh</span>
                </a>
                <a href="grafik_kedisiplinan.php" class="dropdown-item border-radius-md">
                  <span>Grafik Disiplin</span>
                </a>
              </div>
              <div class="d-lg-none">
              <a href="grafik_tahfizh.php" class="dropdown-item border-radius-md">
                  <span>Grafik Tahfizh</span>
                </a>
                <a href="grafik_kedisiplinan.php" class="dropdown-item border-radius-md">
                  <span>Grafik Disiplin</span>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
            <a class="nav-link ps-2 text-dark fw-bold d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="material-icons text-dark opacity-6 me-2 text-md">dashboard</i>
              Akun
              <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
              <img src="img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
            </a>
            <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
              <div class="d-none d-lg-block">
                <a href="akun.php" class="dropdown-item border-radius-md">
                  <span>Kelola Akun</span>
                </a>
                <a href="logout.php" class="dropdown-item border-radius-md">
                  <span>Logout</span>
                </a>
              </div>
              <div class="d-lg-none">
                <a href="akun.php" class="dropdown-item border-radius-md">
                    <span>Kelola Akun</span>
                  </a>
                  <a href="logout.php" class="dropdown-item border-radius-md">
                    <span>Logout</span>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- End Navbar -->

    <header class="bg-gradient-light">
      <div class="page-header min-vh-75" style="background-image: url('background.jpg');">
        <span class="mask bg-gradient-white opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center mx-auto my-auto">
            <img src="img/rilisan.png" width="25%" class="rounded center" alt="logo">
              <h1 class="text-light fw-bold " style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">SELAMAT DATANG</h1>
              <h4 class=" mb-6 text-light fw-bold opacity-9" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">di Database Santri ICBS Putri Harau </h4>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="card card-body shadow-xl mx-3 mx-md-7 mt-n6 py-5 ">
      <section class="py-4 table-responsive">
        <div class="slider container">
          <div class="row align-items-center">
            <div class="row justify-content-start">
              <div class="col">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="img/slider1.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider2.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider3.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider4.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider5.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider6.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider7.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider8.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider9.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider10.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider11.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider12.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider13.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider14.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider15.png" alt="First slide" id="slider1">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/slider16.png" alt="First slide" id="slider1">
                        </div>
                      </div>
                    </div>
                </div>
          </div>
        </div>
      </section>
      <hr>
      <style>
      .row2{
          display: grid;
          grid-template-columns: repeat(4, 1fr); /* 4 kolom untuk 2 baris */
          gap: 4%; /* Jarak antar kotak */
        }

        .box2 {
          text-align: center; /* Memusatkan teks dan ikon */
        }

        .box2 img {
          width: 28%; /* Atur ukuran ikon */
        }
      </style>
      <section class="position-relativ mx-n4" >
        <div class="row2">
          <div class="box2">
            <div class="row">
              <a href="dt_kepesantrenan.php">
                <img src="img/kpesantrenan.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Kpesantrenan</p>
              </a>
            </div>
          </div>
          <div class="box2">
            <div class="row">
              <a href="dt_tahfizh.php">
                <img src="img/tahfizh2.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Tahfizh</p>
              </a>
            </div>
          </div>
          <div class="box2">
            <div class="row">
              <a href="dt_prestasi.php">
                <img src="img/prestasi2.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Prestasi</p>
              </a>
            </div>
          </div>
          <div class="box2">
            <div class="row">
              <a href="dt_disiplin.php">
                <img src="img/disiplin.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Kedisiplinan</p>
              </a>
            </div>
          </div>
          <div class="box2">
            <div class="row">
              <a href="dt_perizinan.php">
                <img src="img/perizinan2.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Perizinan</p>
              </a>
            </div>
          </div>
          <div class="box2">
            <div class="row">
              <a href="dt_minatbakat.php">
                <img src="img/minat2.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Minat</p>
              </a>
            </div>
          </div>
          <div class="box2">
            <div class="row">
              <a href="dt_portopolio.php">
                <img src="img/portofolio2.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Portopolio</p>
              </a>
            </div>
          </div>
          <div class="box2">
            <div class="row">
              <a href="rekapan_putri/rekapan.php">
                <img src="img/rekapan2.png" alt="user" style="max-width: 100%; height: auto;">
                <p class="fw-bold">Rekapan</p>
              </a>
            </div>
          </div>
        </div>
      </section>
    </div>
    <br>
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    ></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    ></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    ></script>
    <!--   Core JS Files   -->
    <script
      src="js/core/popper.min.js"
      type="text/javascript"
    ></script>
    <script
      src="js/core/bootstrap.min.js"
      type="text/javascript"
    ></script>
    <script src="js/plugins/perfect-scrollbar.min.js"></script>
    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="js/plugins/countup.min.js"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <script
      src="js/material-kit.min.js?v=3.0.4"
      type="text/javascript"
    ></script>
    <script>
      // get the element to animate
      var element = document.getElementById("count-stats");
      var elementHeight = element.clientHeight;

      // listen for scroll event and call animate function

      document.addEventListener("scroll", animate);

      // check if element is in view
      function inView() {
        // get window height
        var windowHeight = window.innerHeight;
        // get number of pixels that the document is scrolled
        var scrollY = window.scrollY || window.pageYOffset;
        // get current scroll position (distance from the top of the page to the bottom of the current viewport)
        var scrollPosition = scrollY + windowHeight;
        // get element position (distance from the top of the page to the bottom of the element)
        var elementPosition =
          element.getBoundingClientRect().top + scrollY + elementHeight;

        // is scroll position greater than element position? (is element in view?)
        if (scrollPosition > elementPosition) {
          return true;
        }

        return false;
      }

      var animateComplete = true;
      // animate element when it is in view
      function animate() {
        // is element in view?
        if (inView()) {
          if (animateComplete) {
            if (document.getElementById("state1")) {
              const countUp = new CountUp(
                "state1",
                document.getElementById("state1").getAttribute("countTo")
              );
              if (!countUp.error) {
                countUp.start();
              } else {
                console.error(countUp.error);
              }
            }
            if (document.getElementById("state2")) {
              const countUp1 = new CountUp(
                "state2",
                document.getElementById("state2").getAttribute("countTo")
              );
              if (!countUp1.error) {
                countUp1.start();
              } else {
                console.error(countUp1.error);
              }
            }
            if (document.getElementById("state3")) {
              const countUp2 = new CountUp(
                "state3",
                document.getElementById("state3").getAttribute("countTo")
              );
              if (!countUp2.error) {
                countUp2.start();
              } else {
                console.error(countUp2.error);
              }
            }
            animateComplete = false;
          }
        }
      }

      if (document.getElementById("typed")) {
        var typed = new Typed("#typed", {
          stringsElement: "#typed-strings",
          typeSpeed: 90,
          backSpeed: 90,
          backDelay: 200,
          startDelay: 500,
          loop: true,
        });
      }
    </script>
    <script>
      if (document.getElementsByClassName("page-header")) {
        window.onscroll = debounce(function () {
          var scrollPosition = window.pageYOffset;
          var bgParallax = document.querySelector(".page-header");
          var oVal = window.scrollY / 3;
          bgParallax.style.transform = "translate3d(0," + oVal + "px,0)";
        }, 6);
      }
    </script>
  </body>
</html>