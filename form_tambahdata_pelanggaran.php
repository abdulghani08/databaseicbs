<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Proses simpan data pelanggaran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $klasifikasi = $_POST['klasifikasi'];
    $poin = $_POST['poin'];

    // Query untuk menyimpan data pelanggaran
    $query = "INSERT INTO daftar_pelanggaran (nama, jenis, klasifikasi, poin) VALUES ('$nama', '$jenis', '$klasifikasi', '$poin')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman daftar_pelanggaran.php setelah data berhasil disimpan
        header("Location: dt_pelanggaran.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data pelanggaran.: " . mysqli_error($koneksi);
    }
}
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
</head>
<body style="overflow-x: hidden; background-image: url('backgroundgedung.jpg');">
    <nav class="navbar navbar-expand-lg position-sticky top-0 z-index-3  w-100 shadow-none" style="background-color: #fff;">
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

    <div class="container py-2">
        <h1 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Tambah Data Pelanggaran</h1>
    </div>

    <style>
        .tambahdata {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            margin-left: auto;
            margin-right: auto;
            padding: 16px;
            width: 50%;
        }
    </style>
<<<<<<< HEAD
    
    <div class="container mb-6">
        <div class="tambahdata py-2" style="overflow-x: auto;">
        <a class="fw-bold py-2" style="font-size: 13px;" href="dt_pelanggaran.php">Lihat Data Pelanggaran</a>
            <div class="card-form shadow p-4 mb-2 bg-body-tertiary rounded table-responsive">
                <section>
                <div class="row justify-content-center py-2">
                    <div class=" justify-space-between">
                        <h5 class="text-center fw-bold">Masukkan Info Data Pelanggaran Baru</h5>
                        <form role="form" id="contact-form" method="post" autocomplete="off">
                            <div class="card-body">
                                <div class="mb-4 ">
                                    <div class="input-group input-group-static mb-4 ">
                                        <label class="fw-bold">Nama Pelanggaran</label>
                                        <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukkan Nama Pelanggaran" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="input-group input-group-static mb-4 ">
                                        <label class="fw-bold">Jenis Pelanggaran</label>
                                        <input class="form-control" type="text" id="jenis" name="jenis" placeholder="Masukkan Jenis Pelanggaran" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="fw-bold">Klasifikasi Pelanggaran</label>
                                        <input class="form-control" type="text" id="klasifikasi" name="klasifikasi" placeholder="Masukkan Klasifikasi Pelanggaran" required >
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label class="fw-bold">Poin Pelanggaran</label>
                                        <input class="form-control" type="number" id="poin" name="poin" placeholder="Masukkan Poin Pelanggaran" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-gradient-info w-100"  value="Tambah Data Pelanggaran">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </section>
            </div>
=======
</head>

<body>
    <div class="container">
        <h2>Form Tambah Data Pelanggaran</h2>
        <form method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="jenis">Jenis:</label>
            <input type="text" id="jenis" name="jenis" required>

            <label for="klasifikasi">Klasifikasi:</label>
            <input type="text" id="klasifikasi" name="klasifikasi" required>

            <label for="poin">Poin:</label>
            <input type="number" id="poin" name="poin" placeholder="1.0" step="0.01" min="0" max="1000" required>

            <input type="submit" value="Tambah Data Pelanggaran">
        </form>
        <div class="add-button">
            <a href="dt_pelanggaran.php">Kembali</a>
>>>>>>> a74c40d8e2cfd4f937b47d5c5f55958d68767b2c
        </div>
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
