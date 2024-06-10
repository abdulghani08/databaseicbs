<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $kabkota = mysqli_real_escape_string($koneksi, $_POST['kabkota']);
    $provinsi = mysqli_real_escape_string($koneksi, $_POST['provinsi']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $asrama = mysqli_real_escape_string($koneksi, $_POST['asrama']);
    $pembina = mysqli_real_escape_string($koneksi, $_POST['pembina']);
    $muhafizh = mysqli_real_escape_string($koneksi, $_POST['muhafizh']);
    $sekolah_asal = mysqli_real_escape_string($koneksi, $_POST['sekolah_asal']);
    $cita = mysqli_real_escape_string($koneksi, $_POST['cita']);
    $alamat_medsos = mysqli_real_escape_string($koneksi, $_POST['alamat_medsos']);
    $riwayat_penyakit = mysqli_real_escape_string($koneksi, $_POST['riwayat_penyakit']);
    $alergi = mysqli_real_escape_string($koneksi, $_POST['alergi']);
    $anakke = mysqli_real_escape_string($koneksi, $_POST['anakke']);
    $bersaudara = mysqli_real_escape_string($koneksi, $_POST['bersaudara']);
    $disenangi = mysqli_real_escape_string($koneksi, $_POST['disenangi']);
    $tidak_disenangi = mysqli_real_escape_string($koneksi, $_POST['tidak_disenangi']);
    $nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
    $pekerjaan_ayah = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ayah']);
    $hp_ayah = mysqli_real_escape_string($koneksi, $_POST['hp_ayah']);
    $nama_ibu = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
    $pekerjaan_ibu = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ibu']);
    $hp_ibu = mysqli_real_escape_string($koneksi, $_POST['hp_ibu']);
    $karakter_disukai = mysqli_real_escape_string($koneksi, $_POST['karakter_disukai']);
    $karakter_tidakdisukai = mysqli_real_escape_string($koneksi, $_POST['karakter_tidakdisukai']);
    $kelebihan = mysqli_real_escape_string($koneksi, $_POST['kelebihan']);
    $kekurangan = mysqli_real_escape_string($koneksi, $_POST['kekurangan']);
    $motto = mysqli_real_escape_string($koneksi, $_POST['motto']);
    
    // Query untuk menyimpan data santri ke tabel prestasi_data
    $query = "INSERT INTO portopolio_isi (nama, tempat_lahir, tanggal_lahir, nis, alamat, kabkota, provinsi, kelas, asrama, pembina, muhafizh, sekolah_asal, cita, alamat_medsos, riwayat_penyakit, alergi, anakke, bersaudara, disenangi, tidak_disenangi, nama_ayah, pekerjaan_ayah, hp_ayah, nama_ibu, pekerjaan_ibu, hp_ibu, karakter_disukai, karakter_tidakdisukai, kelebihan, kekurangan, motto) VALUES ('$nama', '$tempat_lahir', '$tanggal_lahir', '$nis', '$alamat', '$kabkota', '$provinsi', '$kelas', '$asrama', '$pembina', '$muhafizh', '$sekolah_asal', '$cita', '$alamat_medsos', '$riwayat_penyakit', '$alergi', '$anakke', '$bersaudara', '$disenangi', '$tidak_disenangi', '$nama_ayah', '$pekerjaan_ayah', '$hp_ayah', '$nama_ibu', '$pekerjaan_ibu', '$hp_ibu', '$karakter_disukai', '$karakter_tidakdisukai', '$kelebihan', '$kekurangan', '$motto')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data santri berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data santri.";
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .text-responsive {
            font-size: 16px;
            }

        @media (max-width: 576px) {
            .text-responsive {
                font-size: 0.6rem; /* Ukuran lebih kecil untuk perangkat kecil */
            }
        }

        @media (min-width: 768px) {
            .text-responsive {
                font-size: 18px; /* Ukuran lebih besar untuk perangkat sedang-besar */
            }
        }

        .card {
            margin: 0 auto;
            overflow-x: auto; /* Memungkinkan scrolling horizontal */
        }

        .tambahdata {
            width: 75%; /* Lebih kecil pada layar besar */
        }

        @media (max-width: 768px) {
            .tambahdata {
                width: 100%; /* Lebih besar pada perangkat kecil */
            }
        }

        .input-group input {
            font-size: 1rem; /* Default */
            }

        .btn {
            font-size: 1rem; /* Default */
        }

        @media (max-width: 576px) {
            .input-group input {
                font-size: 0.8rem; /* Ukuran lebih kecil untuk perangkat kecil */
        }

        .btn {
                font-size: 0.8rem; /* Ukuran lebih kecil untuk tombol */
            }
        }

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

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 0.7rem; /* Ukuran font lebih kecil untuk logo */
        }

        .navbar {
                font-size: 0.9rem; /* Ukuran navbar lebih kecil */
            }
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

    <div class="container py-2">
        <h1 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Tambah Data Potopolio Santri</h1>
    </div>

    <style>
        .form-control2 {
            display: block;
            width: 80%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #344767;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.7rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            margin-left: auto;
            margin-right: auto;
        }
        
        @media (prefers-reduced-motion: reduce) {
            .form-control2 {
                transition: none;
            }
        }
        .form-control2[type="file"] {
            overflow: hidden;
        }
        .form-control2[type="file"]:not(:disabled):not([readonly]) {
            cursor: pointer;
        }
        .form-control2:focus {
            color: #212529;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .form-control2::-webkit-date-and-time-value {
            height: 1.5em;
        }
        .form-control2::-moz-placeholder {
            color: #6c757d;
            opacity: 1;
        }
        .form-control2::placeholder {
            color: #6c757d;
            opacity: 1;
        }
        textarea.form-control2 {
            min-height: calc(1.5em + (0.75rem + 2px));
        }
        textarea.form-control2-sm {
            min-height: calc(1.5em + (0.5rem + 2px));
        }
        textarea.form-control2-lg {
            min-height: calc(1.5em + (1rem + 2px));
        }

        .form-control2-color {
            max-width: 3rem;
            height: auto;
            padding: 0.375rem;
        }
        .form-control2-color:not(:disabled):not([readonly]) {
            cursor: pointer;
        }
        .form-control2-color::-moz-color-swatch {
            height: 1.5em;
            border-radius: 0.25rem;
        }
        .form-control2-color::-webkit-color-swatch {
            height: 1.5em;
            border-radius: 0.25rem;
        }
        .input-group2 {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }
        .input-group2 > .form-control2,
        .input-group2 > .form-select {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            font-size: 0.75rem;
        }
        .input-group2 > .form-control2:focus,
        .input-group2 > .form-select:focus {
            z-index: 3;
        }

        .form-label2 {
            margin-bottom: 2rem;
        }
        .col-form-label2 {
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
            margin-bottom: 0;
            font-size: inherit;
            line-height: 1.5;
        }

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
            width: 90%;
            font-size: 13px; /* Increased text to enable scrolling */
        }

        .text-main {
            color: #343c6a !important;
        }
    </style>
    
    <div class="container mb-6">
        <div class="tambahdata py-2" style="overflow-x: auto;">
        <a class="fw-bold py-2" style="font-size: 13px;" href="dt_portopolio.php">Kembali ke Data Santri</a>
            <div class="card-form shadow p-4 mb-2 bg-body-tertiary rounded table-responsive">
                <section >
                    <div class="row justify-content-center py-2">
                    <div class=" justify-space-between table-responsive">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <h6 class="fs-6 fw-bold text-main shadow-lg p-3 bg-body-tertiary rounded bg-kuning">Masukkan Identitas</h6>
                                <div class="row">
                                    <!-- Kolom pertama -->
                                    <div class="form-group col-12 col-md-6">
                                        <label for="pas_poto" class="col-form-label2">Upload Foto Santri</label>
                                        <div class="input-group2 mb-3">
                                            <input type="file" class="form-control2" id="pas_poto" name="pas_poto" accept="image/*">
                                        </div>
                                    </div>
                                    
                                    <!-- Kolom kedua -->
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nama" class="col-form-label2">Nama Lengkap Santri</label>
                                        <div class="input-group2 mb-3">
                                            <input type="text" class="form-control2" id="nama" name="nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="tempat_lahir" class=" col-form-label2">Tempat lahir</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="tempat_lahir" name="tempat_lahir" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="tanggal_lahir" class="col-sm-6 col-form-label2">Tanggal Lahir</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="tanggal_lahir" name="tanggal_lahir" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nis" class=" col-form-label2">NIS</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="nis" name="nis" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="alamat" class=" col-form-label2">Alamat Lengkap</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="alamat" name="alamat" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="kabkota" class=" col-form-label2">Kab/Kota</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="kabkota" name="kabkota" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="provinsi" class=" col-form-label2">Provinsi</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="provinsi" name="provinsi" required>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <h6 class="fs-6 fw-bold text-main shadow-lg p-3 bg-body-tertiary rounded bg-kuning">Masukkan Data Santri</h6>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="kelas" class=" col-form-label2">kelas</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="kelas" name="kelas" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="asrama" class="col-sm-6 col-form-label2">Asrama</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="asrama" name="asrama" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="pembina" class=" col-form-label2">Pembina</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="pembina" name="pembina" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="muhafizh" class=" col-form-label2">Muhafizh</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="muhafizh" name="muhafizh" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="sekolah_asal" class=" col-form-label2">Sekolah Asal</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="sekolah_asal" name="sekolah_asal" required>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <h6 class="fs-6 fw-bold text-main shadow-lg p-3 bg-body-tertiary rounded bg-kuning">Masukkan Data Ayah Santri</h6>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nama_ayah" class="col-sm-8 col-form-label2">Nama Ayah</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="nama_ayah" name="nama_ayah">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="pekerjaan_ayah" class="col-sm-8 col-form-label2">Pekerjaan Ayah</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="pekerjaan_ayah" name="pekerjaan_ayah">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="hp_ayah" class="col-sm-8 col-form-label2">Nomor Handphone Ayah</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="hp_ayah" name="hp_ayah">
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <h6 class="fs-6 fw-bold text-main shadow-lg p-3 bg-body-tertiary rounded bg-kuning">Masukkan Data Ibu Santri</h6>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nama_ibu" class="col-sm-8 col-form-label2">Nama Ibu</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="nama_ibu" name="nama_ibu">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="pekerjaan_ibu" class="col-sm-8 col-form-label2">Pekerjaan Ibu</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="hp_ibu" class="col-sm-8 col-form-label2">Nomor Handphone Ibu</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="hp_ibu" name="hp_ibu">
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <h6 class="fs-6 fw-bold text-main shadow-lg p-3 bg-body-tertiary rounded bg-kuning">Masukkan Data Tambahan Santri</h6>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="cita" class="col-sm-8 col-form-label2">Cita-Cita</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="cita" name="cita">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="alamat_medsos" class="col-sm-8 col-form-label2">Alamat Medsos</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="alamat_medsos" name="alamat_medsos">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="riwayat_penyakit" class="col-sm-8 col-form-label2">Riwayat Penyakit</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="riwayat_penyakit" name="riwayat_penyakit">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="alergi" class="col-sm-8 col-form-label2">Alergi</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="alergi" name="alergi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="anakke" class="col-sm-8 col-form-label2">Anak ke-</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="anakke" name="anakke">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="bersaudara" class="col-sm-8 col-form-label2">Dari Berapa Bersaudara</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="bersaudara" name="bersaudara">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="disenangi" class="col-sm-8 col-form-label2">Hal yang Disenangi</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="disenangi" name="disenangi">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="tidak_disenangi" class="col-sm-8 col-form-label2">Hal yang Tidak Disenangi</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="tidak_disenangi" name="tidak_disenangi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="karakter_disukai" class="col-sm-8 col-form-label2">Karakter yang Disukai</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="karakter_disukai" name="karakter_disukai">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="karakter_tidakdisukai" class="col-sm-8 col-form-label2">Karakter yang Tidak Disukai</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="karakter_tidakdisukai" name="karakter_tidakdisukai">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="kelebihan" class="col-sm-8 col-form-label2">Kelebihan yang Dimiliki</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="kelebihan" name="kelebihan">
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="kekurangan" class="col-sm-8 col-form-label2">Kekurangan yang Dimiliki</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="kekurangan" name="kekurangan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="motto" class="col-sm-8 col-form-label2">Motto Hidup Santri</label>
                                        <div class="input-group2 mb-3 ">
                                            <input type="text" class="form-control2" id="motto" name="motto">
                                        </div>
                                    </div>
                                </div>
                                
                        
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-gradient-info w-100"  value="Tambah Data Pelanggaran">Tambah</button>
                                </div>
                        </form>
                    </div>
                </section>
            </div>
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
