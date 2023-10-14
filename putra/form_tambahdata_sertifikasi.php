<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil NIS dan Nama dari parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];

// Proses simpan data ujian tahfizh ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $waktu_kegiatan = $_POST['waktu_kegiatan'];
    $penyelenggara = $_POST['penyelenggara'];
    $tingkat = $_POST['tingkat'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO putra_kegiatan_tersertifikasi_isi (nis, nama, nama_kegiatan, waktu_kegiatan, penyelenggara, tingkat) VALUES ('$nis', '$nama', '$nama_kegiatan', '$waktu_kegiatan', '$penyelenggara', '$tingkat')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_minatbakat.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data ujian tahfizh.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Pengalaman Kegiatan Tersertifikasi</title>
    <link rel="shortcut icon" href="../logo.png">
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
        <h2>Form Tambah Pengalaman Kegiatan Tersertifikasi</h2>
        <form method="POST">
            <label for="nama_kegiatan">Nama Kegiatan:</label>
            <input type="text" id="nama_kegiatan" name="nama_kegiatan" required>

            <label for="waktu_kegiatan">Waktu Kegiatan:</label>
            <input type="date" id="waktu_kegiatan" name="waktu_kegiatan" required>

            <label for="penyelenggara">penyelenggara:</label>
            <input type="text" id="penyelenggara" name="penyelenggara" required>

            <label for="tingkat">Tingkat:</label>
            <input type="text" id="tingkat" name="tingkat" required>

            

            <input type="submit" value="Tambah Pengalaman Kegiatan Tersertifikasi">
        </form>
        <div class="add-button">
            <a href="dt_minatbakat.php">Kembali</a>
        </div>
    </div>
</body>

</html>
