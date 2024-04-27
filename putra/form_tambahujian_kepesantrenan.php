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

// Ambil informasi asrama berdasarkan NIS dan Nama
$query_asrama = "SELECT asrama FROM putra_portopolio_isi WHERE nis = '$nis' AND nama = '$nama'";
$result_asrama = mysqli_query($koneksi, $query_asrama);

if ($result_asrama) {
    $row_asrama = mysqli_fetch_assoc($result_asrama);
    $asrama = $row_asrama['asrama'];
} else {
    // Handle jika terjadi kesalahan dalam mengambil data asrama
    $asrama = ""; // Atur menjadi nilai default jika tidak ada data
}

// Ambil informasi asrama berdasarkan NIS dan Nama
$query_kelas = "SELECT kelas FROM putra_portopolio_isi WHERE nis = '$nis' AND nama = '$nama'";
$result_kelas = mysqli_query($koneksi, $query_kelas);

if ($result_kelas) {
    $row_kelas = mysqli_fetch_assoc($result_kelas);
    $kelas = $row_kelas['kelas'];
} else {
    // Handle jika terjadi kesalahan dalam mengambil data asrama
    $kelas = ""; // Atur menjadi nilai default jika tidak ada data
}

// Proses simpan data ujian tahfizh ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kelas = $_POST['kelas'];
    $asrama = $_POST['asrama'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $nilai = $_POST['nilai'];
    $penguji = $_POST['penguji'];
    $keterangan = $_POST['keterangan'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO putra_kepesantrenan_isi (nis, nama, asrama, kelas, tanggal, jenis, nilai, penguji, keterangan) VALUES ('$nis', '$nama', '$asrama', '$kelas', '$tanggal', '$jenis', '$nilai', '$penguji', '$keterangan')";
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
        <h2>Form Tambah Ujian Kepesantrenan</h2>
        <form method="POST">
            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>
        
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="jenis">Jenis Ujian:</label>
            <select id="jenis" name="jenis" required>
                <option value="">Pilih Ujian Kepesantrenan</option>
                <option value="Ujian Bahasa Level 1">Ujian Bahasa Level 1</option>
                <option value="Ujian Bahasa Level 2">Ujian Bahasa Level 2</option>
                <option value="Ujian Bahasa Level 3">Ujian Bahasa Level 3</option>
                <option value="Khatam Tilawah Quran">Khatam tilawah quran</option>
                <option value="Khatam Membaca Terjemahan Alquran">Khatam membaca terjemahan Alquran</option>
                <option value="Bacaan Sholat Beserta Terjemahan">Bacaan Sholat beserta terjemahan</option>
                <option value="100 Hadist Pilihan">100 hadist pilihan</option>
                <option value="Bahasa Arab">Bahasa Arab</option>
                <option value="Fiqh">Fiqh</option>
                <option value="Praktek Wudhu dan Tayamum">Praktek Wudhu dan Tayamum</option>
                <option value="Praktek Sholat">Praktek Sholat</option>
                <option value="Praktek menyelenggarakan Jenazah">Praktek menyelenggarakan Jenazah</option>
                <option value="Praktek Sholat Jenazah">Praktek Sholat Jenazah</option>
                <option value="Zikir Bada sholat">Zikir Bada sholat</option>
                <option value="Doa Bada sholat">Doa Bada sholat</option>
                <option value="Zikir Almatsurat">Zikir Almatsurat</option>
                <option value="Doa Sehari - hari">Doa Sehari - hari</option>
                <option value="Pidato bahasa indonesia">Pidato bahasa indonesia</option>
                <option value="Pidato bahasa Arab">Pidato bahasa Arab</option>
                <option value="Pidato bahasa Inggris">Pidato bahasa Inggris</option>
                <option value="Hadist Pilihan">Hadist Pilihan</option>
                <option value="Hadist Arbain 1">Hadist Arbain 1</option>
                <option value="Hadist Arbain 2">Hadist Arbain 2</option>
                <option value="Hadist Arbain 3">Hadist Arbain 3</option>
                <option value="Hadist Arbain 4">Hadist Arbain 4</option>
                <option value="Hadist Arbain 5">Hadist Arbain 5</option>
                <option value="Hadist Arbain 6">Hadist Arbain 6</option>
                <option value="Hadist Arbain 7">Hadist Arbain 7</option>
                <option value="Hadist Arbain 8">Hadist Arbain 8</option>
                <option value="Hadist Arbain 9">Hadist Arbain 9</option>
                <option value="Hadist Arbain 10">Hadist Arbain 10</option>
                <option value="Hadist Arbain 11">Hadist Arbain 11</option>
                <option value="Hadist Arbain 12">Hadist Arbain 12</option>
                <option value="Hadist Arbain 13">Hadist Arbain 13</option>
                <option value="Hadist Arbain 14">Hadist Arbain 14</option>
                <option value="Hadist Arbain 15">Hadist Arbain 15</option>
                <option value="Hadist Arbain 16">Hadist Arbain 16</option>
                <option value="Hadist Arbain 17">Hadist Arbain 17</option>
                <option value="Hadist Arbain 18">Hadist Arbain 18</option>
                <option value="Hadist Arbain 19">Hadist Arbain 19</option>
                <option value="Hadist Arbain 20">Hadist Arbain 20</option>
                <option value="Hadist Arbain 21">Hadist Arbain 21</option>
                <option value="Hadist Arbain 22">Hadist Arbain 22</option>
                <option value="Hadist Arbain 23">Hadist Arbain 23</option>
                <option value="Hadist Arbain 24">Hadist Arbain 24</option>
                <option value="Hadist Arbain 25">Hadist Arbain 25</option>
                <option value="Hadist Arbain 26">Hadist Arbain 26</option>
                <option value="Hadist Arbain 27">Hadist Arbain 27</option>
                <option value="Hadist Arbain 28">Hadist Arbain 28</option>
                <option value="Hadist Arbain 29">Hadist Arbain 29</option>
                <option value="Hadist Arbain 30">Hadist Arbain 30</option>
                <option value="Hadist Arbain 31">Hadist Arbain 31</option>
                <option value="Hadist Arbain 32">Hadist Arbain 32</option>
                <option value="Hadist Arbain 33">Hadist Arbain 33</option>
                <option value="Hadist Arbain 34">Hadist Arbain 34</option>
                <option value="Hadist Arbain 35">Hadist Arbain 35</option>
                <option value="Hadist Arbain 36">Hadist Arbain 36</option>
                <option value="Hadist Arbain 37">Hadist Arbain 37</option>
                <option value="Hadist Arbain 38">Hadist Arbain 38</option>
                <option value="Hadist Arbain 39">Hadist Arbain 39</option>
                <option value="Hadist Arbain 40">Hadist Arbain 40</option>

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
