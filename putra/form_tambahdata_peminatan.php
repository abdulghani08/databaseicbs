<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa apakah ada permintaan pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan data dari form
    $nama_peminatan = mysqli_real_escape_string($koneksi, $_POST['nama_peminatan']);
    $jenis_peminatan = mysqli_real_escape_string($koneksi, $_POST['jenis_peminatan']);

    // Masukkan data ke tabel minat_bakat
    $query = "INSERT INTO minat_bakat (bakat, jenis) VALUES ('$nama_peminatan', '$jenis_peminatan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data peminatan telah berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data peminatan: " . mysqli_error($koneksi);
    }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Peminatan</title>
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button a {
            display: inline-block;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="button">
            <a href="daftar_minatbakat.php">Kembali</a>
        </div>
        <h2>Tambah Data Peminatan</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Peminatan:</label>
                <input type="text" name="nama_peminatan" required>
            </div>
            <div class="form-group">
                <label>Jenis Peminatan:</label>
                <input type="text" name="jenis_peminatan" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Tambah">
            </div>
        </form>
    </div>
</body>
</html>
