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

            h4 {
                font-size: 1.4rem;
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
    
    <div class=" py-2">
        <h4 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Rekapan Hafalan</h4>
    </div>
    <div class="container">
        <div class="card " style="overflow-x: auto;">
            <div class="card-form shadow p-4 mb-2 bg-body-tertiary rounded">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Hafalan</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                            <th>Total Hafalan (Halaman)</th>
                            <th>Action</th> <!-- Tambahkan kolom Action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $setoran_query = "SELECT * FROM tahfizh_hafalan WHERE nis='$nis'";
                        $setoran_result = mysqli_query($koneksi, $setoran_query);
                        $no = 1;
                        while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                            $nilai = $setoran_data['nilai'];
                            $keterangan = '';
                            if ($nilai == 'A') {
                                $keterangan = 'Sangat Baik';
                            } elseif ($nilai == 'B') {
                                $keterangan = 'Baik';
                            } elseif ($nilai == 'C') {
                                $keterangan = 'Kurang Lancar';
                            } elseif ($nilai == 'D') {
                                $keterangan = 'Tidak Lancar';
                            }
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $setoran_data['tanggal']; ?></td>
                                <td><?php echo $setoran_data['hafalan']; ?></td>
                                <td><?php echo $nilai; ?></td>
                                <td><?php echo $keterangan; ?></td>
                                <td><?php echo $setoran_data['total_hafalan']; ?></td>
                                <td class="action-links">
                                    <!-- Tambahkan tombol hapus dengan link ke aksi_hapus_rekapan_hafalan.php -->
                                    <a class="edit" href="edit_setoran_tahfizh.php?id=<?php echo $setoran_data['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                        </svg>
                                    </a>
                                    <a class="delete" href="aksi_hapus_rekapan_hafalan.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                                    <!-- Tambahkan tombol edit dengan link ke edit_setoran_tahfizh.php -->
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>    
        </div>
    </div>

    <div class=" py-2">
        <h4 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Rekapan Ujian Tasmi' Qur'an Perjuz / Ujian Kenaikan Juz</h4>
    </div>
    <div class="container">
        <div class="card " style="overflow-x: auto;">
            <div class="card-form shadow p-4 mb-2 bg-body-tertiary rounded">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Nama Ujian</th>
                            <th class="text-center">Nilai</th>
                            <th>Keterangan</th>
                            <th class="text-center">Action</th> <!-- Tambahkan kolom Action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $setoran_query = "SELECT * FROM tahfizh_ujian WHERE nis='$nis'";
                        $setoran_result = mysqli_query($koneksi, $setoran_query);
                        $no = 1;
                        while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                            $nilai = $setoran_data['nilai'];
                            $keterangan = '';
                            if ($nilai == 'A') {
                                $keterangan = 'Sangat Baik';
                            } elseif ($nilai == 'B') {
                                $keterangan = 'Baik';
                            } elseif ($nilai == 'C') {
                                $keterangan = 'Kurang Lancar';
                            } elseif ($nilai == 'D') {
                                $keterangan = 'Tidak Lancar(Mengulang)';
                            }
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $setoran_data['tanggal']; ?></td>
                                <td><?php echo $setoran_data['ujian']; ?></td>
                                <td class="text-center"><?php echo $nilai; ?></td>
                                <td><?php echo $keterangan; ?></td>
                                <td class="action-links text-center">
                                    <a class="edit" href="edit_ujian_tahfizh.php?id=<?php echo $setoran_data['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                        </svg>
                                    </a>
                                    <a class="delete" href="aksi_hapus_ujian_tahfizh.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>    
        </div>
    </div>

    <div class=" py-2">
        <h4 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Rekapan Ujian Tahfizh</h4>
    </div>
    <div class="container"> 
        <div class="card " style="overflow-x: auto;">
            <div class="card-form shadow p-4 mb-2 bg-body-tertiary rounded">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Hafalan</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                            <th>Total Hafalan (Halaman)</th>
                            <th class="text-center">Action</th> <!-- Tambahkan kolom Action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $setoran_query = "SELECT * FROM tasmik_isi WHERE nis='$nis'";
                        $setoran_result = mysqli_query($koneksi, $setoran_query);
                        $no = 1;
                        while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                            $nilai = $setoran_data['nilai'];
                            $keterangan = '';
                            if ($nilai == 'A') {
                                $keterangan = 'Sangat Baik';
                            } elseif ($nilai == 'B') {
                                $keterangan = 'Baik';
                            } elseif ($nilai == 'C') {
                                $keterangan = 'Kurang Lancar';
                            } elseif ($nilai == 'D') {
                                $keterangan = 'Tidak Lancar';
                            }
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $setoran_data['tanggal']; ?></td>
                                <td><?php echo $setoran_data['ujian']; ?></td>
                                <td><?php echo $nilai; ?></td>
                                <td><?php echo $keterangan; ?></td>
                                <td><?php echo $setoran_data['total_halaman']; ?></td>
                                <td class="action-links text-center">
                                    <!-- Tambahkan tombol hapus dengan link ke aksi_hapus_rekapan_hafalan.php -->
                                    <!-- <a class="edit" href="edit_setoran_tahfizh.php?id=<?php echo $setoran_data['id']; ?>"><img src="edit_icon.png" alt="Edit"></a> -->
                                    <a class="delete" href="aksi_hapus_ujian_tasmik.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                                    <!-- Tambahkan tombol edit dengan link ke edit_setoran_tahfizh.php -->
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>    
        </div>
    </div>
        
    <div class="total-hafalan">
        <?php
        // Menghitung jumlah total hafalan
        $total_hafalan_query = "SELECT SUM(total_hafalan) AS total FROM tahfizh_hafalan WHERE nis='$nis'";
        $total_hafalan_result = mysqli_query($koneksi, $total_hafalan_query);
        $total_hafalan_data = mysqli_fetch_assoc($total_hafalan_result);
        $total_hafalan = $total_hafalan_data['total'];

        // Menghitung jumlah total hafalan per juz
        $total_hafalan_per_juz = 20; // Ubah sesuai dengan jumlah total hafalan per juz
        $jumlah_total_hafalan_per_juz = $total_hafalan / $total_hafalan_per_juz;
        ?>
        <h6>Jumlah Total Hafalan: <?php echo $total_hafalan; ?> Halaman</h6>
        <h6>Jumlah Total Hafalan per Juz: <?php echo $jumlah_total_hafalan_per_juz; ?></h6>
    </div>

    <div class=" py-2">
        <h4 class="text-center text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Grafik Kualitas Hafalan</h4>
    </div>
    <div class="container">
        <canvas id="chart"></canvas>
        <script>
            // Mendapatkan data nilai dari PHP
            <?php
            $nilai_a_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='A'";
            $nilai_a_result = mysqli_query($koneksi, $nilai_a_query);
            $nilai_a_data = mysqli_fetch_assoc($nilai_a_result);
            $nilai_a_total = $nilai_a_data['total'];

            $nilai_b_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='B'";
            $nilai_b_result = mysqli_query($koneksi, $nilai_b_query);
            $nilai_b_data = mysqli_fetch_assoc($nilai_b_result);
            $nilai_b_total = $nilai_b_data['total'];

            $nilai_c_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='C'";
            $nilai_c_result = mysqli_query($koneksi, $nilai_c_query);
            $nilai_c_data = mysqli_fetch_assoc($nilai_c_result);
            $nilai_c_total = $nilai_c_data['total'];

            $nilai_d_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='D'";
            $nilai_d_result = mysqli_query($koneksi, $nilai_d_query);
            $nilai_d_data = mysqli_fetch_assoc($nilai_d_result);
            $nilai_d_total = $nilai_d_data['total'];
            ?>

                // Menampilkan diagram
                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['A (Sangat Baik)', 'B (Baik)', 'C (Kurang Lancar)', 'D (Tidak Lancar)'],
                        datasets: [{
                            label: 'Grafik',
                            data: [<?php echo $nilai_a_total; ?>, <?php echo $nilai_b_total; ?>, <?php echo $nilai_c_total; ?>, <?php echo $nilai_d_total; ?>],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
        </script>
    </div>
</body>

</html>
