<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil NIS dan Nama dari parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];

// Ambil informasi asrama berdasarkan NIS dan Nama
$query_asrama = "SELECT asrama FROM portopolio_isi WHERE nis = '$nis' AND nama = '$nama'";
$result_asrama = mysqli_query($koneksi, $query_asrama);

if ($result_asrama) {
    $row_asrama = mysqli_fetch_assoc($result_asrama);
    $asrama = $row_asrama['asrama'];
} else {
    // Handle jika terjadi kesalahan dalam mengambil data asrama
    $asrama = ""; // Atur menjadi nilai default jika tidak ada data
}


// Ambil informasi asrama berdasarkan NIS dan Nama
$query_kelas = "SELECT kelas FROM portopolio_isi WHERE nis = '$nis' AND nama = '$nama'";
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
    $asrama = $_POST['asrama'];
    $kelas = $_POST['kelas'];
    $tanggal = $_POST['tanggal'];
    $ujian = mysqli_real_escape_string($koneksi, $_POST['ujian']);
    $nilai = $_POST['nilai'];
    $total_halaman = $_POST['total_halaman'];
    $penginput = $_POST['penginput'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO tasmik_isi (nis, nama, asrama, kelas, tanggal, ujian, nilai, total_halaman, penginput) VALUES ('$nis', '$nama', '$asrama', '$kelas', '$tanggal', '$ujian', '$nilai', '$total_halaman', '$penginput')";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Ujian Tasmik</title>
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

        input, select {
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            background-color: #f0f0f0;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
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
        <h2>Form Tambah Ujian Tahfizh</h2>
        <form method="POST">
            <label for="penginput">Penginput:</label>
            <input type="text" id="penginput" name="penginput" value="<?php echo $_SESSION['username']; ?>" readonly>

            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>
        
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
