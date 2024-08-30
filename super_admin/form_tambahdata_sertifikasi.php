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

// Proses simpan data ujian tahfizh ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $asrama = $_POST['asrama'];
    $kelas = $_POST['kelas'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $waktu_kegiatan = $_POST['waktu_kegiatan'];
    $penyelenggara = $_POST['penyelenggara'];
    $tingkat = $_POST['tingkat'];
    $penginput = $_POST['penginput'];

    // Query untuk menyimpan data ujian tahfizh
    $query = "INSERT INTO kegiatan_tersertifikasi_isi (nis, nama, asrama, kelas, nama_kegiatan, waktu_kegiatan, penyelenggara, tingkat, penginput) VALUES ('$nis', '$nama', '$asrama', '$kelas', '$nama_kegiatan', '$waktu_kegiatan', '$penyelenggara', '$tingkat', '$penginput')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_minatbakat.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data ujian tahfizh.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Kegiatan Tersertifikasi</title>
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
        <h2>Form Tambah Prestasi Santri</h2>
        <form method="POST">
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
            <label for="penginput">Penginput:</label>
            <input type="text" id="penginput" name="penginput" value="<?php echo $_SESSION['username']; ?>" readonly>
            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>

            <label for="nama_kegiatan">Nama Kegiatan :</label>
            <input type="text" id="nama_kegiatan" name="nama_kegiatan" required>

            <label for="waktu_kegiatan">Waktu Kegiatan :</label>
            <input type="date" id="waktu_kegiatan" name="waktu_kegiatan" required>

            <label for="penyelenggara">Penyelenggara :</label>
            <input type="text" id="penyelenggara" name="penyelenggara" required>

            <label for="tingkat">Tingkat :</label>
            <select id="tingkat" name="tingkat" required>
                <option value="">Pilih Tingkat</option>
                <option value="Asrama">Asrama</option>
                <option value="Sekolah">Sekolah</option>
                <option value="ICBS">ICBS</option>
                <option value="Kecamatan">Kecamatan</option>
                <option value="kota/kabupaten">Kota/ Kabupaten</option>
                <option value="provinsi">Provinsi</option>
                <option value="nasional">Nasional</option>
                <option value="internasional">Internasional</option>
            </select>

            <input type="submit" value="Tambah Kegiatan Tersertifikasi">
        </form>
        <div class="add-button">
            <a href="update_minatbakat.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>">Kembali</a>
        </div>
    </div>
</body>

</html>
