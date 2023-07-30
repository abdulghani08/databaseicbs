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

// Proses simpan data setoran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $hafalan = $_POST['hafalan'];
    $nilai = $_POST['nilai'];
    $totalHafalan = $_POST['total_hafalan'];

    // Membersihkan nilai $hafalan untuk mencegah serangan SQL injection
$hafalan = mysqli_real_escape_string($koneksi, $hafalan);

    // Query untuk menyimpan data setoran
    $query = "INSERT INTO putra_tahfizh_hafalan (nis, tanggal, hafalan, nilai, total_hafalan) VALUES ('$nis', '$tanggal', '$hafalan', '$nilai', '$totalHafalan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_tahfizh.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data setoran.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Setoran</title>
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
        <h2>Form Tambah Setoran</h2>
        <form method="POST">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="hafalan">Hafalan:</label>
            <input type="text" id="hafalan" name="hafalan" required>

            <label for="nilai">Nilai:</label>
            <select id="nilai" name="nilai" required>
                <option value="">Pilih Nilai</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <label for="total_hafalan">Total Hafalan (Per halaman):</label>
            <input type="number" id="total_hafalan" name="total_hafalan" step="0.1" min="0" max="604" required>
            <h6>Catatan : 1 Juz = 20 halaman</h6>

            <input type="submit" value="Tambah Setoran">
        </form>
        <div class="add-button">
            <a href="dt_tahfizh.php">Kembali</a>
        </div>
    </div>
</body>

</html>
