<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa apakah ada permintaan pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan data dari form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $asrama = $_POST['asrama'];
    $pembina = $_POST['pembina'];

    // Perbarui data pada tabel tahfizh_data
    $query = "UPDATE putra_prestasi_data SET nama='$nama', kelas='$kelas', asrama='$asrama', pembina='$pembina' WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data telah berhasil diperbarui.";
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi);
    }
}

// Dapatkan data santri berdasarkan NIS yang diterima dari parameter URL
$nis = $_GET['nis'];
$query = "SELECT * FROM putra_prestasi_data WHERE nis='$nis'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Santri Prestasi</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000066;
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button a{
        background-color: #FF0000;
        color: #FFFFFF;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="button">
                <a href="dt_prestasi.php">Kembali</a>
            </div>
        <h2>Edit Data Santri Prestasi</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>NIS</label>
                <input type="text" name="nis" value="<?php echo $row['nis']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="<?php echo $row['nama']; ?>">
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" value="<?php echo $row['kelas']; ?>">
            </div>
            <div class="form-group">
                <label>Asrama</label>
                <input type="text" name="asrama" value="<?php echo $row['asrama']; ?>">
            </div>
            <div class="form-group">
                <label>Pembina</label>
                <input type="text" name="pembina" value="<?php echo $row['pembina']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan">
            </div>
        </form>
    </div>
</body>
</html>
