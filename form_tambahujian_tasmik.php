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
    $ujian = mysqli_real_escape_string($koneksi, $_POST['ujian']);
    $nilai = $_POST['nilai'];
    $total_halaman = $_POST['total_halaman'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO tasmik_isi (nis, nama, tanggal, ujian, nilai, total_halaman) VALUES ('$nis', '$nis', '$tanggal', '$ujian', '$nilai', '$total_halaman')";
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
            <input type="text" id="ujian" name="ujian" required>
            <h6>Contoh Penulisan 
<br>1. Qs. Al Baqaroh 1-29 (Hal. 2-5) 
(jika perhalaman)

<br>2. Qs. An-Naba 1 -40 
(Jika 1 surat)

<br>3. Qs. An-Naba 31 - 40 dan An Naziat 1-15 (hal. 583)
(jika beda surat tapi 1 halaman)</h6>

            <!-- <label for="ujian">Ujian Tahfizh:</label>
            <select id="ujian" name="ujian" required>
                <option value="">Pilih Ujian Tahfizh</option>
                <option value="Ujian Praktek Tahsin">Ujian Praktek Tahsin</option>
                <option value="Ujian Teori Tahsin">Ujian Teori Tahsin</option>
                <option value="Tasmi 5 Juz">Tasmi 5 Juz</option>
                <option value="Tasmi 10 Juz">Tasmi 10 Juz</option>
                <option value="Tasmi 15 Juz">Tasmi 15 Juz</option>
                <option value="Tasmi 20 Juz">Tasmi 20 Juz</option>
                <option value="Tasmi 25 Juz">Tasmi 25 Juz</option>
                <option value="Tasmi 30 Juz">Tasmi 30 Juz</option>
                <option value="Ujian Juz 1">Ujian Juz 1</option>
                <option value="Ujian Juz 2">Ujian Juz 2</option>
                <option value="Ujian Juz 3">Ujian Juz 3</option>
                <option value="Ujian Juz 4">Ujian Juz 4</option>
                <option value="Ujian Juz 5">Ujian Juz 5</option>
                <option value="Ujian Juz 6">Ujian Juz 6</option>
                <option value="Ujian Juz 7">Ujian Juz 7</option>
                <option value="Ujian Juz 8">Ujian Juz 8</option>
                <option value="Ujian Juz 9">Ujian Juz 9</option>
                <option value="Ujian Juz 10">Ujian Juz 10</option>
                <option value="Ujian Juz 11">Ujian Juz 11</option>
                <option value="Ujian Juz 12">Ujian Juz 12</option>
                <option value="Ujian Juz 13">Ujian Juz 13</option>
                <option value="Ujian Juz 14">Ujian Juz 14</option>
                <option value="Ujian Juz 15">Ujian Juz 15</option>
                <option value="Ujian Juz 16">Ujian Juz 16</option>
                <option value="Ujian Juz 17">Ujian Juz 17</option>
                <option value="Ujian Juz 18">Ujian Juz 18</option>
                <option value="Ujian Juz 19">Ujian Juz 19</option>
                <option value="Ujian Juz 20">Ujian Juz 20</option>
                <option value="Ujian Juz 21">Ujian Juz 21</option>
                <option value="Ujian Juz 22">Ujian Juz 22</option>
                <option value="Ujian Juz 23">Ujian Juz 23</option>
                <option value="Ujian Juz 24">Ujian Juz 24</option>
                <option value="Ujian Juz 25">Ujian Juz 25</option>
                <option value="Ujian Juz 26">Ujian Juz 26</option>
                <option value="Ujian Juz 27">Ujian Juz 27</option>
                <option value="Ujian Juz 28">Ujian Juz 28</option>
                <option value="Ujian Juz 29">Ujian Juz 29</option>
                <option value="Ujian Juz 30">Ujian Juz 30</option>
            </select> -->

            <label for="nilai">Nilai:</label>
            <select id="nilai" name="nilai" required>
                <option value="">Pilih Nilai</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <label for="total_halaman">Total Hafalan (Per halaman):</label>
            <input type="number" id="total_halaman" name="total_halaman" step="0.1" min="0" max="604" required>
            <h6>Catatan : 1 Juz = 20 halaman</h6>
            <br>
            <br>
            <input type="submit" value="Tambah Ujian Tahfizh">
        </form>
        <div class="add-button">
            <a href="dt_tahfizh.php">Kembali</a>
        </div>
    </div>
</body>

</html>
