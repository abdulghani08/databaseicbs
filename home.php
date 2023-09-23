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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <title>Santri Putri Harau</title>
    <link rel="shortcut icon" href="logo.png">
  </head>
  <body>

      <div class="header">
        <div class="container">
          <div class="row">
            <div class="col">
              <img id="logo" src="img/rilisan.png" alt="logo">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <h6 id="title-header">Selamat Datang di <br>Database Santri ICSB Putri<br>Harau</h6>
            </div>
          </div>
        </div>  
      </div>


      <div class="background">
          <img id="background" src="img/background.png" alt="background">
        <div class="slider">
          <div class="container">
            <div class="row">
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        

      <div class="content ">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="row">
                <div class="box">
                  <a href="dt_kepesantrenan.php">
                    <img src="img/kepesantrenan.png" alt="user">
                  </a>
                </div>
              <div class="row">
                <p id="title1">kpesantren</p>
              </div> 
              </div>  
            </div>
            <div class="col">
              <div class="row">
                <div class="box">
                  <a href="dt_tahfizh.php"> 
                    <img src="img/tahfizh.png" alt="search">
                  </a>
              </div>
              <div class="row">
                <p id="title2">Tahfizh</p>
              </div>
              </div> 
            </div>
            <div class="col">
              <div class="row">
                <div class="box">
                  <a href="dt_prestasi.php">
                    <img src="img/prestasi.png" alt="doc">
                  </a>
              </div>
              <div class="row">
                <p id="title3">Prestasi</p> 
              </div>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="box">
                  <a href="dt_disiplin.php">
                    <img src="img/kedisiplinan.png" alt="doc">
                  </a>
              </div>
              <div class="row">
                <p id="title3">Kedisiplinan</p> 
              </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="row">
                <div class="box" id="row2">
                  <a href="dt_perizinan.php">
                    <img src="img/perizinan.png" alt="phone">
                  </a>
                </div>
              <div class="row">
                <p id="title4">Perizinan</p>
              </div> 
              </div>  
            </div>
            <div class="col">
              <div class="row">
                <div class="box" id="row2">
                  <a href="dt_minatbakat.php">
                    <img src="img/minat.png" alt="galeri">
                  </a>
                </div>
              </div>
              <div class="row">
                <p id="title5">Minat</p>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="box" id="row2">
                 <a href="dt_portopolio.php">
                   <img src="img/portopolio.png" alt="clock">
                 </a> 
                </div>
              </div>
              <div class="row">
                <p id="title6">Portopolio</p> 
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="box" id="row2">
                 <a href="akun.php">
                   <img src="img/profil.png" alt="clock">
                 </a> 
                </div>
              </div>
              <div class="row">
                <p id="title6">Akun</p> 
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div> 
        
          <div class="footer">
            <div class="container">
              <div class="row">
                <div class="col">
                  <h5 id="title-footer">
                    Grafik Tahfizh  |  Grafik Disiplin  | Logout
                  </h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-auto">
                  <a href="grafik_tahfizh.php">
                    <img src="img/icon_grafiktahfizh.png" alt="wa" id="sosmed">
                  </a>
                  <a href="grafik_kedisiplinan.php">
                    <img src="img/icon_grafikdisiplin.png" alt="fb" id="sosmed">
                  </a>
                  <a href="logout.php">
                    <img src="img/logout_icon.png" alt="ig" id="sosmed">
                  </a>
                </div>
              </div>
            </div>  
          </div>
        </div>
       

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>