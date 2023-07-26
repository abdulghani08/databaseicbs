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

// Proses simpan data setoran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis']; // Ambil NIS dari form
    $nama = $_POST['nama']; // Ambil Nama dari form

    $nama_prestasi = $_POST['nama_prestasi'];
    $penyelenggara = $_POST['penyelenggara'];
    $waktu = $_POST['waktu'];
    $tingkat = $_POST['tingkat'];
    $juara = $_POST['juara'];

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        die("Santri tidak ditemukan");
    }

    // Query untuk menyimpan data prestasi
    $query = "INSERT INTO prestasi_isi (nis, nama, nama_prestasi, penyelenggara, waktu, tingkat, juara) VALUES ('$nis', '$nama', '$nama_prestasi', '$penyelenggara', '$waktu', '$tingkat', '$juara')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_prestasi.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data Prestasi.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Prestasi</title>
    <link rel="shortcut icon" href="logo.png">
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
        <h2>Form Tambah Prestasi Santri</h2>
        <form method="POST">
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">

            <label for="tanggal">Nama Prestasi :</label>
            <input type="text" id="nama_prestasi" name="nama_prestasi" required>

            <label for="penyelenggara">Penyelenggara :</label>
            <input type="text" id="penyelenggara" name="penyelenggara" required>

            <label for="hafalan">Tahun Diselenggarakan :</label>
            <input type="text" id="waktu" name="waktu" required>

            <label for="tingkat">Tingkat :</label>
            <select id="tingkat" name="tingkat" required>
                <option value="">Pilih Tingkat</option>
                <option value="kota">Asrama</option>
                <option value="kota">Sekolah</option>
                <option value="kota">ICBS</option>
                <option value="kota">Kota/ Kabupaten</option>
                <option value="provinsi">Provinsi</option>
                <option value="nasional">Nasional</option>
                <option value="internasional">Internasional</option>
            </select>

            <label for="juara">Juara :</label>
            <input type="text" id="juara" name="juara" required>

            <input type="submit" value="Tambah Prestasi">
        </form>
        <div class="add-button">
            <a href="dt_prestasi.php">Kembali</a>
        </div>
    </div>
</body>

</html>
