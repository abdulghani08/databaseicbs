<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data dari tabel tahfizh_data berdasarkan NIS dan Nama yang dikirim melalui parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];
$query = "SELECT * FROM portopolio_isi WHERE nis='$nis' AND nama='$nama'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>

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
        href="css/material-kit.css"
        rel="stylesheet"
    />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script
        defer
        data-site="YOUR_DOMAIN_HERE"
        src="https://api.nepcha.com/js/nepcha-analytics.js"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
            background-image: url('backgroundgedung.jpg');
        }

    
        /* Ukuran font yang berbeda untuk tampilan yang responsif */
        @media (max-width: 576px) {
            .input-group input {
                font-size: 0.8rem; /* Ukuran font lebih kecil pada perangkat kecil */
            }

            .btn {
                font-size: 0.8rem; /* Ukuran font lebih kecil untuk tombol */
            }
        }

        @media (min-width: 768px) {
            .input-group input {
                font-size: 1rem; /* Ukuran font lebih besar pada layar besar */
            }

            .btn {
                font-size: 1rem; /* Ukuran font default */
            }
        }
        /* Responsive Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #fff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-toggler {
            border: none;
            outline: none;
        }

        /* Responsiveness for Button */
        .btn-kuning {
            padding: 16px;
            font-size: 0.8rem;
        }

        @media (max-width: 576px) {
            .btn-kuning {
                padding: 6px;
                font-size: 0.5rem;
            }

            .navbar-brand {
                font-size: 0.7rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }

        /* Responsive Text */
        .text-responsive {
            font-size: 18px;
        }

        @media (max-width: 576px) {
            .text-responsive {
                font-size: 14px;
            }
        }

        @media (min-width: 768px) {
            .text-responsive {
                font-size: 20px;
            }
        }

        /* Responsive Table */
        .table {
            font-size: 13px;
        }

        @media (max-width: 576px) {
            .table {
                font-size: 9px;
                padding: 1px;
            }
        }

        /* Responsive Card */
        .card {
            margin: 0 auto;
            overflow-x: auto;
        }

        /* Responsive Tambahdata */
        .tambahdata {
            display: flex;
            flex-direction: column;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .tambahdata {
                width: 100%;
            }
        }

        @media (min-width: 769px) {
            .tambahdata {
                width: 75%;
            }
        }

        /* Ukuran icon yang berbeda untuk tampilan yang responsif */
        @media (max-width: 576px) {
            .material-icons {
                font-size: 1rem; /* Ukuran icon lebih kecil pada perangkat kecil */
        }
    }

    </style>
</head>

<body style="overflow-x: hidden; background-image: url('backgroundgedung.jpg');">
    <nav class="navbar navbar-expand-lg position-sticky top-0 z-index-3 w-100 shadow-none" style="background-color: #fff;">
        <div class="container">
            <img src="img/rilisan.png" style="width: 4%; margin-right: 2%;" alt="logo">
            <a class="navbar-brand  text-dark fw-bold "rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank" href="homeadmin.php">
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
    

    <div class=" py-2">
        <h1 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Minat Bakat Santri</h1>
        <div class="add-santri-button text-center">
            <a class="btn btn-kuning" href="form_tambahdata_minatbakat.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>">Tambah Minat Bakat</a>
            <a class="btn btn-kuning" href="form_tambahdata_pengalaman_organisasi.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>">Tambah Pengalaman Organisasi</a>
            <a class="btn btn-kuning" href="form_tambahdata_sertifikasi.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>">Tambah Pengalaman Kegiatan Tersertifikasi</a>

        </div>
    </div>

    <div class="container">
        <div class="card " style="overflow-x: auto;">
            <div class="tambahdata">
                <section >
                    <table class="table table-sm table-striped">
                        <tr >
                            <th>Nama</th>
                            <td><?php echo $data['nama']; ?></td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td><?php echo $data['nis']; ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?php echo $data['kelas']; ?></td>
                        </tr>
                        <tr>
                            <th>Asrama</th>
                            <td><?php echo $data['asrama']; ?></td>
                        </tr>
                        <tr>
                            <th>Pembina</th>
                            <td><?php echo $data['pembina']; ?></td>
                        </tr>
                    </table>
                </section>
            <br>
            <section class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminatan</th>
                            <th>Jenis Peminatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                        <?php
                        $setoran_query = "SELECT * FROM minat_bakat_isi WHERE nis='$nis'";
                        $setoran_result = mysqli_query($koneksi, $setoran_query);
                        $no = 1;
                        while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $setoran_data['bakat']; ?></td>
                                <td><?php echo $setoran_data['jenis']; ?></td>
                                <td class="action-links">
                                    <!-- <a class="edit" href="edit_minatbakat.php?id=<?php echo $setoran_data['id']; ?>"><img src="edit_icon.png" alt="Edit"></a> -->
                                    <a class="delete" href="aksi_hapus_minatbakat.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </section>
            <br>

        <div class=" py-2">
            <h1 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Pengalaman Organisasi</h1>
        </div>
        <section>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Organisasi</th>
                        <th>Jabatan</th>
                        <th>Periode</th>
                        <th>Tingkat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                    <?php
                    $setoran_query = "SELECT * FROM pengalaman_organisasi_isi WHERE nis='$nis'";
                    $setoran_result = mysqli_query($koneksi, $setoran_query);
                    $no = 1;
                    while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $setoran_data['nama_organisasi']; ?></td>
                            <td><?php echo $setoran_data['jabatan']; ?></td>
                            <td><?php echo $setoran_data['periode']; ?></td>
                            <td><?php echo $setoran_data['tingkat']; ?></td>
                            <td class="action-links">
                                <!-- <a class="edit" href="edit_minatbakat.php?id=<?php echo $setoran_data['id']; ?>"><img src="edit_icon.png" alt="Edit"></a> -->
                                <a class="delete" href="aksi_hapus_pengalaman_organisasi.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </section>
        
        <br>
        <div class=" py-2">
            <h1 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Pengalaman Kegiatan Tersertifikasi</h1>
        </div>
        <section>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Waktu Kegiatan</th>
                        <th>Penyelenggara</th>
                        <th>Tingkat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                    <?php
                    $setoran_query = "SELECT * FROM kegiatan_tersertifikasi_isi WHERE nis='$nis'";
                    $setoran_result = mysqli_query($koneksi, $setoran_query);
                    $no = 1;
                    while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $setoran_data['nama_kegiatan']; ?></td>
                            <td><?php echo $setoran_data['waktu_kegiatan']; ?></td>
                            <td><?php echo $setoran_data['penyelenggara']; ?></td>
                            <td><?php echo $setoran_data['tingkat']; ?></td>
                            <td class="action-links">
                                <!-- <a class="edit" href="edit_minatbakat.php?id=<?php echo $setoran_data['id']; ?>"><img src="edit_icon.png" alt="Edit"></a> -->
                                <a class="delete" href="aksi_hapus_kegiatan_tersertifikasi.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
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
