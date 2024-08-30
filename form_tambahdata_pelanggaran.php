<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Proses simpan data pelanggaran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Pelanggaran</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF8C00;
            --secondary-color: #FFA500;
            --background-color: #FFF5E6;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 100%;
            width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--secondary-color);
        }

        input {
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            background-color: #f0f0f0;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--primary-color);
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        .add-button {
            text-align: center;
            margin-top: 20px;
        }

        .add-button a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .add-button a:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                padding: 20px;
            }
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
            <input type="number" id="poin" name="poin" placeholder="1.0" step="0.01" min="0" max="1000" required>

            <input type="submit" value="Tambah Data Pelanggaran">
        </form>
        <div class="add-button">
            <a href="dt_pelanggaran.php">Kembali</a>
        </div>
    </div>
</body>
</html>