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
    $tanggal = $_POST['tanggal'];
    $ujian = $_POST['ujian'];
    $nilai = $_POST['nilai'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO tahfizh_ujian (nis, nama, tanggal, ujian, nilai) VALUES ('$nis', '$nis', '$tanggal', '$ujian', '$nilai')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_tahfizh.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data ujian tahfizh.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Ujian Tahfizh</title>
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
        <h2>Form Tambah Ujian Tahfizh</h2>
        <form method="POST">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="ujian">Ujian Tahfizh:</label>
            <select id="ujian" name="ujian" required>
                <option value="">Pilih Ujian Tahfizh</option>
                <option value="Ujian Praktek Tahsin">Ujian Praktek Tahsin</option>
                <option value="Ujian Teori Tahsin">Ujian Teori Tahsin</option>
                <option value="Ujian Juz 30">Ujian Juz 30</option>
                <option value="Ujian Juz 29">Ujian Juz 29</option>
                <option value="Ujian Juz 1">Ujian Juz 1</option>
                <option value="Ujian Juz 2">Ujian Juz 2</option>
                <option value="Ujian Juz 3">Ujian Juz 3</option>
                <option value="Tasmi 5 Juz">Tasmi 5 Juz</option>
                <option value="Ujian Juz 4">Ujian Juz 4</option>
                <option value="Ujian Juz 5">Ujian Juz 5</option>
                <option value="Ujian Juz 6">Ujian Juz 6</option>
                <option value="Ujian Juz 7">Ujian Juz 7</option>
                <option value="Ujian Juz 8">Ujian Juz 8</option>
                <option value="Tasmi 10 Juz">Tasmi 10 Juz</option>
            </select>

            <label for="nilai">Nilai:</label>
            <select id="nilai" name="nilai" required>
                <option value="">Pilih Nilai</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <input type="submit" value="Tambah Ujian Tahfizh">
        </form>
        <div class="add-button">
            <a href="dt_tahfizh.php">Kembali</a>
        </div>
    </div>
</body>

</html>
