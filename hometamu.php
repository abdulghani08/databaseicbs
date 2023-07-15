<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek apakah pengguna sudah login dan levelnya adalah "Tamu"
if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'Tamu') {
    // Redirect pengguna ke halaman login jika belum login atau levelnya bukan "Tamu"
    header("Location: login.php");
    exit();
}

// Ambil NIS dari session
$nis = $_SESSION['username'];

// Ambil data santri dari tabel portopolio_isi berdasarkan NIS
$query = "SELECT * FROM portopolio_isi WHERE nis = '$nis'";
$result = mysqli_query($koneksi, $query);

// Periksa apakah data santri ditemukan
if (mysqli_num_rows($result) > 0) {
    $dataSantri = mysqli_fetch_assoc($result);
} else {
    // Jika data santri tidak ditemukan, set nilai default
    $dataSantri = array(
        'nama' => 'Nama Santri',
        'tempat_lahir' => 'Tempat Lahir',
        'tanggal_lahir' => 'Tanggal Lahir',
        'nis' => $nis,
        'alamat' => 'Alamat Santri',
        'kelas' => 'Kelas Santri',
        // Tambahkan data lainnya sesuai kebutuhan
    );
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Tamu</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .button-container {
            display: flex;
            justify-content: center;
        }

        .button-container a {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button-container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?></h2>

    <h3>Data Santri</h3>
    <table>
        <tr>
            <th>Nama Santri</th>
            <td><?php echo $dataSantri['nama']; ?></td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td><?php echo $dataSantri['tempat_lahir']; ?></td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td><?php echo $dataSantri['tanggal_lahir']; ?></td>
        </tr>
        <tr>
            <th>NIS</th>
            <td><?php echo $dataSantri['nis']; ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?php echo $dataSantri['alamat']; ?></td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td><?php echo $dataSantri['kelas']; ?></td>
        </tr>
        <!-- Tambahkan baris-baris data lainnya di sini sesuai kebutuhan -->
    </table>

    <div class="button-container">
        <a href="update_portopoliotamu.php?nis=<?php echo $nis; ?>" style="background-color: #4CAF50;">Lihat Portofolio</a>
        <a href="ganti_password.php" style="background-color: #f44336;">Ganti Password</a>
        <a href="edit_datasantri_portopoliotamu.php?nis=<?php echo $nis; ?>&nama=<?php echo $dataSantri['nama']; ?>" style="background-color: #FF9800;">Edit Biodata Santri</a>
        <a href="logout.php" style="background-color: #f44336;">Logout</a>
    </div>
</body>
</html>
