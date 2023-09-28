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

// Proses simpan data ujian tahfizh ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_organisasi = $_POST['nama_organisasi'];
    $jabatan = $_POST['jabatan'];
    $periode = $_POST['periode'];
    $tingkat = $_POST['tingkat'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO pengalaman_organisasi_isi (nis, nama, nama_organisasi, jabatan, periode, tingkat) VALUES ('$nis', '$nama', '$nama_organisasi', '$jabatan', '$periode', '$tingkat')";
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
    <title>Form Tambah Pengalaman Organisasi</title>
    <link rel="shortcut icon" href="logo.png">
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
        <h2>Form Tambah Pengalaman Organisasi</h2>
        <form method="POST">
            <label for="nama_organisasi">Nama Organisasi:</label>
            <input type="text" id="nama_organisasi" name="nama_organisasi" required>

            <label for="jabatan">Jabatan:</label>
            <input type="text" id="jabatan" name="jabatan" required>

            <label for="periode">Periode:</label>
            <input type="text" id="periode" name="periode" required>

            <label for="tingkat">Tingkat:</label>
            <input type="text" id="tingkat" name="tingkat" required>

            

            <input type="submit" value="Tambah Pengalaman Organisasi">
        </form>
        <div class="add-button">
            <a href="dt_minatbakat.php">Kembali</a>
        </div>
    </div>
</body>

</html>
