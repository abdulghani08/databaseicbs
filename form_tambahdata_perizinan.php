<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil NIS dan Nama dari parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];

// Proses simpan data setoran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis']; // Ambil NIS dari form
    $nama = $_POST['nama']; // Ambil Nama dari form

    $daritanggal = $_POST['daritanggal'];
    $sampaitanggal = $_POST['sampaitanggal'];
    $keperluan = $_POST['keperluan'];
    $durasi = $_POST['durasi'];

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        die("Santri tidak ditemukan");
    }

    // Generate ID secara otomatis
    $query_max_id = "SELECT MAX(id) AS max_id FROM perizinan_isi";
    $result_max_id = mysqli_query($koneksi, $query_max_id);
    $row_max_id = mysqli_fetch_assoc($result_max_id);
    $next_id = $row_max_id['max_id'] + 1;

    // Query untuk menyimpan data perizinan
    $query = "INSERT INTO perizinan_isi (id, nis, nama, daritanggal, sampaitanggal, keperluan, durasi) VALUES ('$next_id', '$nis', '$nama', '$daritanggal', '$sampaitanggal', '$keperluan', '$durasi')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_perizinan.php setelah data berhasil disimpan
        header("Location: update_perizinan.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data Kedisiplinan.";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Surat Izin</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
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

        form {
            margin-top: 20px;
        }

        label,
        input {
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Form Tambah Perizinan Santri</h2>
        <form method="POST">
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">

            <label for="daritanggal">Tanggal Izin :</label>
            <input type="date" id="daritanggal" name="daritanggal" required>

            <label for="sampaitanggal">Sampai Tanggal :</label>
            <input type="date" id="sampaitanggal" name="sampaitanggal" required>
            
            <label for="keperluan">Keperluan Izin :</label>
            <input type="text" id="keperluan" name="keperluan" required>

            <label for="durasi">Durasi Izin (Hari) :</label>
            <!-- <input type="text" id="poin" name="poin" required> -->
            <input type="number" id="durasi" name="durasi" min="1" required>


            <input type="submit" value="Simpan">
        </form>
        <div class="add-button">
            <a href="dt_perizinan.php">Kembali</a>
        </div>
    </div>
</body>

</html>
