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
    $ujian = $_POST['ujian'];
    $nilai = $_POST['nilai'];
    $penginput = $_POST['penginput'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO tahfizh_ujian (nis, nama, asrama, kelas, tanggal, ujian, nilai, penginput) VALUES ('$nis', '$nama', '$asrama', '$kelas', '$tanggal', '$ujian', '$nilai', '$penginput')";
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
        <h2>Form Tambah Ujian Tasmi'</h2>
        <form method="POST">
            <label for="penginput">Penginput:</label>
            <input type="text" id="penginput" name="penginput" value="<?php echo $_SESSION['username']; ?>" readonly>
            
            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>
            
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="ujian">Ujian Tasmi' :</label>
            <select id="ujian" name="ujian" required>
                <option value="">Pilih Ujian Tasmi</option>
                <option value="Ujian Praktek Tahsin">Ujian Praktek Tahsin</option>
                <option value="Ujian Teori Tahsin">Ujian Teori Tahsin</option>
                <option value="Tasmi 5 Juz">Tasmi 5 Juz</option>
                <option value="Tasmi 10 Juz">Tasmi 10 Juz</option>
                <option value="Tasmi 15 Juz">Tasmi 15 Juz</option>
                <option value="Tasmi 20 Juz">Tasmi 20 Juz</option>
                <option value="Tasmi 25 Juz">Tasmi 25 Juz</option>
                <option value="Tasmi 30 Juz">Tasmi 30 Juz</option>
                <?php for ($i = 1; $i <= 30; $i++) : ?>
                    <option value="Ujian Juz <?php echo $i; ?>">Ujian Juz <?php echo $i; ?></option>
                <?php endfor; ?>
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