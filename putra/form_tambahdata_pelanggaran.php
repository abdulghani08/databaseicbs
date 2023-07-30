<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Proses simpan data pelanggaran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
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
    <title>Form Tambah Data Pelanggaran</title>
    <link rel="shortcut icon" href="../logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background.jpg');
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
        <h2>Form Tambah Data Pelanggaran</h2>
        <form method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="jenis">Jenis:</label>
            <input type="text" id="jenis" name="jenis" required>

            <label for="klasifikasi">Klasifikasi:</label>
            <input type="text" id="klasifikasi" name="klasifikasi" required>

            <label for="poin">Poin:</label>
            <input type="number" id="poin" name="poin" placeholder="1.0" step="0.01" min="0" max="10" required>

            <input type="submit" value="Tambah Data Pelanggaran">
        </form>
        <div class="add-button">
            <a href="dt_pelanggaran.php">Kembali</a>
        </div>
    </div>
</body>

</html>
