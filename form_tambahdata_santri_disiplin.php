<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $asrama = $_POST['asrama'];
    $pembina = $_POST['pembina'];
    
    // Query untuk menyimpan data santri ke tabel tahfizh_data
    $query = "INSERT INTO disiplin_data (nis, nama, kelas, asrama, pembina) VALUES ('$nis', '$nama', '$kelas', '$asrama', '$pembina')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data santri berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data santri.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Data Kedisiplinan Prestasi</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
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
            margin-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 100px;
        }

        input[type="text"] {
            width: 300px;
        }

        .submit-button {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Form Tambah Data Kedisiplinan Santri</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>NIS:</label>
                <input type="text" name="nis" required>
            </div>
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="kelas" required>
            </div>
            <div class="form-group">
                <label>Asrama:</label>
                <input type="text" name="asrama" required>
            </div>
            <div class="form-group">
                <label>Pembina:</label>
                <input type="text" name="pembina" required>
            </div>
            <div class="submit-button">
                <input type="submit" value="Tambah Data">
            </div>
            <div class="add-button">
            <a href="dt_disiplin.php">Kembali</a>
        </div>
        </form>
    </div>
</body>

</html>
