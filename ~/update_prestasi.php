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
    <title>Update Prestasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backgroundgedung.jpg');
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
        background-color: rgba(0, 120, 255, 0.5);
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
    </style>
</head>

<body>
    <div class="container">
        <div>
            <a href="dt_prestasi.php"><img src="back_icon.png" alt="back"></a>
        </div>
        <h2>REKAPAN PRESTASI</h2>
        <div class="add-button">
            <a href="form_tambahdata_prestasi.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>">Tambah Prestasi</a>
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
        </table>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Prestasi</th>
                    <th>Penyelenggara</th>
                    <th>Tahun Diselenggarakan</th>
                    <th>Tingkat</th>
                    <th>Juara</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM prestasi_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['nama_prestasi']; ?></td>
                        <td><?php echo $setoran_data['penyelenggara']; ?></td>
                        <td><?php echo $setoran_data['waktu']; ?></td>
                        <td><?php echo $setoran_data['tingkat']; ?></td>
                        <td><?php echo $setoran_data['juara']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
