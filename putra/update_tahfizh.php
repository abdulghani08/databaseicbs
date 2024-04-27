<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data dari tabel tahfizh_data berdasarkan NIS dan Nama yang dikirim melalui parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];
$query = "SELECT * FROM putra_portopolio_isi WHERE nis='$nis' AND nama='$nama'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Tahfizh</title>
    <link rel="shortcut icon" href="../logo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../backgroundgedung.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .add-button {
            margin-bottom: 10px;
            text-align: center;
        }

        .add-button a {
            display: inline-block;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin-right: 10px;
        }

        .back-button a {
            display: inline-block;
            text-decoration: none;
            background-color: #FF0000;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #e0e0e0;
        }

        .details {
        background-color: rgba(255, 255, 255, 0.5);
        padding: 10px;
        border: 1px solid #ddd;
        }

        .details table {
        width: 100%;
        border-collapse: collapse;
        }

        .details th,
        .details td {
        padding: 8px;
        border: 1px solid #ddd;
        }

        .details th {
        background-color: rgba(76, 175, 80, 0.5);
        }

        .action-links {
            display: flex;
            justify-content: center;
        }

        .action-links a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .action-links a.back img {
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }

        .action-links a.delete img{
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }

        .action-links a.edit img{
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }

        tbody tr.kurang-lancar td {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <a href="dt_tahfizh.php"><img src="../back_icon.png" alt="home"></a>
        </div>
        <h2>REKAPAN HAFALAN</h2>
        <div class="add-button">
            <a href="form_tambahdata_setoran.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" style="background-color: #4CAF50;">Tambah Hafalan</a>
            <a href="form_tambahujian_tahfizh.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" style="background-color: #4CAF50;">Tambah Ujian Tasmi' Qur'an Perjuz</a>
            <a href="form_tambahujian_tasmik.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" style="background-color: #4CAF50;">Tambah Ujian Tahfizh</a>
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
        $setoran_query = "SELECT * FROM putra_tahfizh_hafalan WHERE nis='$nis'";
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
                    <a class="edit" href="edit_setoran_tahfizh.php?id=<?php echo $setoran_data['id']; ?>"><img src="../edit_icon.png" alt="Edit"></a>
                    <a class="delete" href="aksi_hapus_rekapan_hafalan.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="../delete_icon.png" alt="Delete"></a>
                    <!-- Tambahkan tombol edit dengan link ke edit_setoran_tahfizh.php -->
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>

<center><h3>Rekapan Ujian Tasmi' Qur'an Perjuz / Ujian Kenaikan Juz</h3></center>
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
        $setoran_query = "SELECT * FROM putra_tahfizh_ujian WHERE nis='$nis'";
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
                    <a class="edit" href="edit_ujian_tahfizh.php?id=<?php echo $setoran_data['id']; ?>"><img src="../edit_icon.png" alt="Edit"></a>
                    <a class="delete" href="aksi_hapus_ujian_tahfizh.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="../delete_icon.png" alt="Delete"></a>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>

<center><h3>Rekapan Ujian Tahfizh</h3></center>
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
        $setoran_query = "SELECT * FROM putra_tasmik_isi WHERE nis='$nis'";
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
                    <a class="delete" href="aksi_hapus_ujian_tasmik.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="../delete_icon.png" alt="Delete"></a>
                    <!-- Tambahkan tombol edit dengan link ke edit_setoran_tahfizh.php -->
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>

        <div class="total-hafalan">
        <?php
        // Menghitung jumlah total hafalan
        $total_hafalan_query = "SELECT SUM(total_hafalan) AS total FROM putra_tahfizh_hafalan WHERE nis='$nis'";
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
            $nilai_a_query = "SELECT COUNT(*) AS total FROM putra_tahfizh_hafalan WHERE nis='$nis' AND nilai='A'";
            $nilai_a_result = mysqli_query($koneksi, $nilai_a_query);
            $nilai_a_data = mysqli_fetch_assoc($nilai_a_result);
            $nilai_a_total = $nilai_a_data['total'];

            $nilai_b_query = "SELECT COUNT(*) AS total FROM putra_tahfizh_hafalan WHERE nis='$nis' AND nilai='B'";
            $nilai_b_result = mysqli_query($koneksi, $nilai_b_query);
            $nilai_b_data = mysqli_fetch_assoc($nilai_b_result);
            $nilai_b_total = $nilai_b_data['total'];

            $nilai_c_query = "SELECT COUNT(*) AS total FROM putra_tahfizh_hafalan WHERE nis='$nis' AND nilai='C'";
            $nilai_c_result = mysqli_query($koneksi, $nilai_c_query);
            $nilai_c_data = mysqli_fetch_assoc($nilai_c_result);
            $nilai_c_total = $nilai_c_data['total'];

            $nilai_d_query = "SELECT COUNT(*) AS total FROM putra_tahfizh_hafalan WHERE nis='$nis' AND nilai='D'";
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
