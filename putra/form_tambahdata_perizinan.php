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

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM putra_portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        die("Santri tidak ditemukan");
    }

    // Generate ID secara otomatis
    $query_max_id = "SELECT MAX(id) AS max_id FROM putra_perizinan_isi";
    $result_max_id = mysqli_query($koneksi, $query_max_id);
    $row_max_id = mysqli_fetch_assoc($result_max_id);
    $next_id = $row_max_id['max_id'] + 1;

    // Query untuk menyimpan data perizinan
    $query = "INSERT INTO putra_perizinan_isi (id, nis, nama, asrama, kelas, daritanggal, sampaitanggal, keperluan, durasi) VALUES ('$next_id', '$nis', '$nama', '$asrama', '$kelas', '$daritanggal', '$sampaitanggal', '$keperluan', '$durasi')";
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
<html>

<head>
    <title>Form Tambah Surat Izin</title>
    <link rel="shortcut icon" href="../logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
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
        <h2>Form Tambah Perizinan Santri</h2>
        <form method="POST">
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">

            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>
            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>

            <label for="daritanggal">Tanggal Izin :</label>
            <input type="date" id="daritanggal" name="daritanggal" required>

            <label for="sampaitanggal">Sampai Tanggal :</label>
            <input type="date" id="sampaitanggal" name="sampaitanggal" required>
            
            <label for="keperluan">Keperluan Izin :</label>
            <input type="text" id="keperluan" name="keperluan" required>

            <label for="durasi">Durasi Izin (Hari) :</label>
            <!-- <input type="text" id="poin" name="poin" required> -->
            <input type="number" id="durasi" name="durasi" min="1" required>


            <input type="submit" value="Simpan">
        </form>
        <div class="add-button">
            <a href="dt_perizinan.php">Kembali</a>
        </div>
    </div>
</body>

</html>
