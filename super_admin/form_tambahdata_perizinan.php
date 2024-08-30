<?php
session_start();
include "../connection.php";
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

// Proses simpan data setoran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis']; // Ambil NIS dari form
    $nama = $_POST['nama']; // Ambil Nama dari form

    $asrama = $_POST['asrama'];
    $kelas = $_POST['kelas'];
    $daritanggal = $_POST['daritanggal'];
    $sampaitanggal = $_POST['sampaitanggal'];
    $keperluan = mysqli_real_escape_string($koneksi, $_POST['keperluan']);
    $durasi = $_POST['durasi'];
    $penginput = $_POST['penginput'];

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        die("Santri tidak ditemukan");
    }

    // Generate ID secara otomatis
    $query_max_id = "SELECT MAX(id) AS max_id FROM perizinan_isi";
    $result_max_id = mysqli_query($koneksi, $query_max_id);
    $row_max_id = mysqli_fetch_assoc($result_max_id);
    $next_id = $row_max_id['max_id'] + 1;

    // Query untuk menyimpan data perizinan
    $query = "INSERT INTO perizinan_isi (id, nis, nama, asrama, kelas, daritanggal, sampaitanggal, keperluan, durasi, penginput) VALUES ('$next_id', '$nis', '$nama', '$asrama', '$kelas', '$daritanggal', '$sampaitanggal', '$keperluan', '$durasi', '$penginput')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_perizinan.php setelah data berhasil disimpan
        header("Location: update_perizinan.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data Kedisiplinan.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Surat Izin</title>
    <link rel="shortcut icon" href="../logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
    --primary-color: #2E8B57;    /* Sea Green */
    --secondary-color: #3CB371;  /* Medium Sea Green */
    --text-color: #333;
    --background-color: #E8F5E9;         /* Light Green background */
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
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
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
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-weight: 600;
        }

        form {
            display: grid;
            gap: 20px;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            transition: color 0.3s ease;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(255, 140, 0, 0.1);
            outline: none;
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .add-button {
            text-align: center;
            margin-top: 20px;
        }

        .add-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .add-button a:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
        }

        @media (max-width: 390px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 20px;
            }

            input {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Tambah Perizinan Santri</h2>
        <form method="POST">
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
            
            <label for="penginput">Penginput:</label>
            <input type="text" id="penginput" name="penginput" value="<?php echo $_SESSION['username']; ?>" readonly>
            
            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>

            <label for="daritanggal">Tanggal Izin:</label>
            <input type="date" id="daritanggal" name="daritanggal" required>

            <label for="sampaitanggal">Sampai Tanggal:</label>
            <input type="date" id="sampaitanggal" name="sampaitanggal" required>
            
            <label for="keperluan">Keperluan Izin:</label>
            <input type="text" id="keperluan" name="keperluan" required>

            <label for="durasi">Durasi Izin (Hari):</label>
            <input type="number" id="durasi" name="durasi" min="1" required>

            <input type="submit" value="Simpan">
        </form>
        <div class="add-button">
            <a href="dt_perizinan.php">Kembali</a>
        </div>
    </div>
</body>
</html>