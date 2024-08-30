<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tahfizh</title>
    <link rel="shortcut icon" href="logo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF9800;
            --secondary-color: #FFA726;
            --background-color: #FFF3E0;
            --text-color: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 20px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2, h3 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-weight: 600;
        }

        .add-button {
            margin-bottom: 20px;
            text-align: center;
        }

        .add-button a {
            display: inline-block;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #fff;
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            margin: 5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .add-button a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: none;
        }

        th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
        }

        tbody tr {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .action-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            width: 150px;
            text-align: center;
        }

        .action-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-button i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .action-button span {
            font-size: 14px;
            font-weight: 600;
        }

        .action-links a {
            display: inline-block;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .action-links a:hover {
            background-color: var(--secondary-color);
        }

        .action-links img {
            width: 20px;
            height: 20px;
        }

        .total-hafalan {
            background-color: var(--primary-color);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            text-align: center;
            font-weight: 600;
        }

        canvas {
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 767px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            .add-button a {
                padding: 8px 16px;
                font-size: 14px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px 4px;
            }

            .hide-mobile {
                display: none;
            }

            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .details {
                font-size: 14px;
            }

            .action-links img {
                width: 16px;
                height: 16px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .action-button {
                width: 80%;
                max-width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <a href="dt_tahfizh.php"><img src="back_icon.png" alt="home"></a>
        </div>
        <h2>REKAPAN HAFALAN</h2>
        <div class="action-buttons">
            <a href="form_tambahdata_setoran.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" class="action-button">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Hafalan</span>
            </a>
            <a href="form_tambahujian_tahfizh.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" class="action-button">
                <i class="fas fa-book-reader"></i>
                <span>Tambah Ujian Tasmi' Qur'an Perjuz</span>
            </a>
            <a href="form_tambahujian_tasmik.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" class="action-button">
                <i class="fas fa-clipboard-check"></i>
                <span>Tambah Ujian Tahfizh</span>
            </a>
        </div>
        <div class="details">
        <table>
            <tr>
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
            <tr>
            <th>Muhafizh</th>
            <td><?php echo $data['muhafizh']; ?></td>
            </tr>
        </table>
        </div>

<center><h3>Rekapan Hafalan</h3></center>
<div class="table-container">
<table>
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
                    <a class="edit" href="edit_setoran_tahfizh.php?id=<?php echo $setoran_data['id']; ?>"><img src="edit_icon.png" alt="Edit"></a>
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

<center><h3>Rekapan Ujian Tasmi' Qur'an Perjuz / Ujian Kenaikan Juz</h3></center>
<div class="table-container">
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Ujian</th>
            <th>Nilai</th>
            <th>Keterangan</th>
            <th>Action</th> <!-- Tambahkan kolom Action -->
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
                <td><?php echo $no; ?></td>
                <td><?php echo $setoran_data['tanggal']; ?></td>
                <td><?php echo $setoran_data['ujian']; ?></td>
                <td><?php echo $nilai; ?></td>
                <td><?php echo $keterangan; ?></td>
                <td class="action-links">
                    <a class="edit" href="edit_ujian_tahfizh.php?id=<?php echo $setoran_data['id']; ?>"><img src="edit_icon.png" alt="Edit"></a>
                    <a class="delete" href="aksi_hapus_ujian_tahfizh.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>
<div>

<center><h3>Rekapan Ujian Tahfizh</h3></center>
<div class="table-container">
<table>
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
                <td><?php echo $no; ?></td>
                <td><?php echo $setoran_data['tanggal']; ?></td>
                <td><?php echo $setoran_data['ujian']; ?></td>
                <td><?php echo $nilai; ?></td>
                <td><?php echo $keterangan; ?></td>
                <td><?php echo $setoran_data['total_halaman']; ?></td>
                <td class="action-links">
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
        <p>Jumlah Total Hafalan: <?php echo $total_hafalan; ?> Halaman</p>
        <p>Jumlah Total Hafalan per Juz: <?php echo $jumlah_total_hafalan_per_juz; ?></p>
        </div>

        <center><h3>Grafik Kualitas Hafalan</h3></center>

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

                // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add fade-in animation to elements as they enter the viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        });

        document.querySelectorAll('table, .details, .total-hafalan, canvas').forEach(el => {
            observer.observe(el);
        });
        </script>

    </div>
</body>

</html>
