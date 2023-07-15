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
    $jenis = $_POST['jenis'];
    $nilai = $_POST['nilai'];
    $penguji = $_POST['penguji'];
    $keterangan = $_POST['keterangan'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO kepesantrenan_isi (nis, nama, tanggal, jenis, nilai, penguji, keterangan) VALUES ('$nis', '$nama', '$tanggal', '$jenis', '$nilai', '$penguji', '$keterangan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_kepesantrenan.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data ujian tahfizh.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Ujian Kepesantrenan</title>
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
        <h2>Form Tambah Ujian Kepesantrenan</h2>
        <form method="POST">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="jenis">Jenis Ujian:</label>
            <select id="jenis" name="jenis" required>
                <option value="">Pilih Ujian Kepesantrenan</option>
                <option value="Ujian Bahasa Level 1">Ujian Bahasa Level 1</option>
                <option value="Ujian Bahasa Level 2">Ujian Bahasa Level 2</option>
                <option value="Ujian Bahasa Level 3">Ujian Bahasa Level 3</option>
                <option value="Praktek Wudhu dan Tayamum">Praktek Wudhu dan Tayamum</option>
                <option value="Praktek Sholat">Praktek Sholat</option>
                <option value="Praktek menyelenggarakan Jenazah">Praktek menyelenggarakan Jenazah</option>
                <option value="Praktek Sholat Jenazah">Praktek Sholat Jenazah</option>
                <option value="Zikir Ba'da sholat">Zikir Ba'da sholat</option>
                <option value="Do'a Ba'da sholat">Do'a Ba'da sholat</option>
                <option value="Zikir Almatsurat">Zikir Almatsurat</option>
                <option value="Doa Sehari - hari">Doa Sehari - hari</option>
                <option value="Pidato bahasa indonesia">Pidato bahasa indonesia</option>
                <option value="Pidato bahasa Arab">Pidato bahasa Arab</option>
                <option value="Pidato bahasa Inggris">Pidato bahasa Inggris</option>
                <option value="Hadist Pilihan">Hadist Pilihan</option>
                <option value="Hadist Arba'in 1">Hadist Arba'in 1</option>
                <option value="Hadist Arba'in 2">Hadist Arba'in 2</option>
                <option value="Hadist Arba'in 3">Hadist Arba'in 3</option>
                <option value="Hadist Arba'in 4">Hadist Arba'in 4</option>
                <option value="Hadist Arba'in 5">Hadist Arba'in 5</option>
                <option value="Hadist Arba'in 6">Hadist Arba'in 6</option>
                <option value="Hadist Arba'in 7">Hadist Arba'in 7</option>
                <option value="Hadist Arba'in 8">Hadist Arba'in 8</option>
                <option value="Hadist Arba'in 9">Hadist Arba'in 9</option>
                <option value="Hadist Arba'in 10">Hadist Arba'in 10</option>
                <option value="Hadist Arba'in 11">Hadist Arba'in 11</option>
                <option value="Hadist Arba'in 12">Hadist Arba'in 12</option>
                <option value="Hadist Arba'in 13">Hadist Arba'in 13</option>
                <option value="Hadist Arba'in 14">Hadist Arba'in 14</option>
                <option value="Hadist Arba'in 15">Hadist Arba'in 15</option>
                <option value="Hadist Arba'in 16">Hadist Arba'in 16</option>
                <option value="Hadist Arba'in 17">Hadist Arba'in 17</option>
                <option value="Hadist Arba'in 18">Hadist Arba'in 18</option>
                <option value="Hadist Arba'in 19">Hadist Arba'in 19</option>
                <option value="Hadist Arba'in 20">Hadist Arba'in 20</option>
                <option value="Hadist Arba'in 21">Hadist Arba'in 21</option>
                <option value="Hadist Arba'in 22">Hadist Arba'in 22</option>
                <option value="Hadist Arba'in 23">Hadist Arba'in 23</option>
                <option value="Hadist Arba'in 24">Hadist Arba'in 24</option>
                <option value="Hadist Arba'in 25">Hadist Arba'in 25</option>
                <option value="Hadist Arba'in 26">Hadist Arba'in 26</option>
                <option value="Hadist Arba'in 27">Hadist Arba'in 27</option>
                <option value="Hadist Arba'in 28">Hadist Arba'in 28</option>
                <option value="Hadist Arba'in 29">Hadist Arba'in 29</option>
                <option value="Hadist Arba'in 30">Hadist Arba'in 30</option>
                <option value="Hadist Arba'in 31">Hadist Arba'in 31</option>
                <option value="Hadist Arba'in 32">Hadist Arba'in 32</option>
                <option value="Hadist Arba'in 33">Hadist Arba'in 33</option>
                <option value="Hadist Arba'in 34">Hadist Arba'in 34</option>
                <option value="Hadist Arba'in 35">Hadist Arba'in 35</option>
                <option value="Hadist Arba'in 36">Hadist Arba'in 36</option>
                <option value="Hadist Arba'in 37">Hadist Arba'in 37</option>
                <option value="Hadist Arba'in 38">Hadist Arba'in 38</option>
                <option value="Hadist Arba'in 39">Hadist Arba'in 39</option>
                <option value="Hadist Arba'in 40">Hadist Arba'in 40</option>

            </select>

            <label for="nilai">Nilai:</label>
            <select id="nilai" name="nilai" required>
                <option value="">Pilih Nilai</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <label for="penguji">Nama Penguji:</label>
            <input type="text" id="penguji" name="penguji" required>

            <label for="keterangan">Keterangan:</label>
            <select id="keterangan" name="keterangan" required>
                <option value="">Pilih Keterangan</option>
                <option value="Tuntas">Tuntas</option>
                <option value="Belum Tuntas">Belum Tuntas</option>
            </select>

            <input type="submit" value="Tambah Ujian Kepesantrenan">
        </form>
        <div class="add-button">
            <a href="dt_kepesantrenan.php">Kembali</a>
        </div>
    </div>
</body>

</html>
