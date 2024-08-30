<?php
session_start();
include "connection.php";

if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'Tamu') {
    header("Location: login.php");
    exit();
}

$nis = $_SESSION['username'];
$nama = $_POST['nama'];
$asrama = $_POST['asrama'];
$kelas = $_POST['kelas'];
$tanggal = $_POST['tanggal'];

// Bidang Ibadah (sholat)
$shalat_shubuh = isset($_POST['shalat_shubuh']) ? 1 : 0;
$shalat_dzuhur = isset($_POST['shalat_dzuhur']) ? 1 : 0;
$shalat_ashar = isset($_POST['shalat_ashar']) ? 1 : 0;
$shalat_maghrib = isset($_POST['shalat_maghrib']) ? 1 : 0;
$shalat_isya = isset($_POST['shalat_isya']) ? 1 : 0;
$shalat_qiyamul_lail = isset($_POST['shalat_qiyamul_lail']) ? 1 : 0;
$shalat_dhuha = isset($_POST['shalat_dhuha']) ? 1 : 0;
// Tambahkan bidang ibadah lainnya

// Bidang Ibadah (lainnya)
$menghafal = isset($_POST['menghafal']) ? 1 : 0;
$murajaah = isset($_POST['murajaah']) ? 1 : 0;
$membaca_almatsurat = isset($_POST['membaca_almatsurat']) ? 1 : 0;

// Kegiatan Birrul Walidain
$membangunkan_orangtua = isset($_POST['membangunkan_orangtua']) ? 1 : 0;
$merapikan_sandal = isset($_POST['merapikan_sandal']) ? 1 : 0;
$menghidangkan_makanan = isset($_POST['menghidangkan_makanan']) ? 1 : 0;
$menjemur = isset($_POST['menjemur']) ? 1 : 0;
$tadarus_keluarga = isset($_POST['tadarus_keluarga']) ? 1 : 0;
$menghadiri_kajian = isset($_POST['menghadiri_kajian']) ? 1 : 0;

// Bidang Kebersihan/ Kerapian
$membersihkan_kamar = isset($_POST['membersihkan_kamar']) ? 1 : 0;
$membersihkan_rumah = isset($_POST['membersihkan_rumah']) ? 1 : 0;
$membersihkan_wc = isset($_POST['membersihkan_wc']) ? 1 : 0;
$mencuci_piring = isset($_POST['mencuci_piring']) ? 1 : 0;
$mencuci_pakaian = isset($_POST['mencuci_pakaian']) ? 1 : 0;

// Aktivitas Pribadi
$membaca_buku_agama = isset($_POST['membaca_buku_agama']) ? 1 : 0;
$riyadhoh = isset($_POST['riyadhoh']) ? 1 : 0;
$mengenalkan_icbs = isset($_POST['mengenalkan_icbs']) ? 1 : 0;
$silaturahmi = isset($_POST['silaturahmi']) ? 1 : 0;

$jumlah_rawatib = isset($_POST['jumlah_rawatib']) ? $_POST['jumlah_rawatib'] : 0;
$jumlah_tilawah = isset($_POST['jumlah_tilawah']) ? $_POST['jumlah_tilawah'] : 0;
// Tambahkan bidang akhlak dan ibadah lainnya

$keterangan = $_POST['keterangan'];

$koneksi = mysqli_connect($host, $username, $password, $database);

// Query untuk mendapatkan nilai id terakhir dari tabel
$query_id = "SELECT MAX(id) AS last_id FROM tamu_laporan_bw";
$result_id = mysqli_query($koneksi, $query_id);
$row_id = mysqli_fetch_assoc($result_id);
$last_id = $row_id['last_id'];

// Menentukan nilai id baru
$new_id = $last_id + 1;

$query = "INSERT INTO tamu_laporan_bw (id, nis, nama, asrama, kelas, tanggal, shalat_shubuh, shalat_dzuhur, shalat_ashar, shalat_maghrib, shalat_isya, shalat_qiyamul_lail, shalat_dhuha, menghafal, murajaah, membaca_almatsurat, membangunkan_orangtua, merapikan_sandal, menghidangkan_makanan, menjemur, tadarus_keluarga, menghadiri_kajian, membersihkan_kamar, membersihkan_rumah, membersihkan_wc, mencuci_piring, mencuci_pakaian, membaca_buku_agama, riyadhoh, mengenalkan_icbs, silaturahmi, jumlah_rawatib, jumlah_tilawah, keterangan)
          VALUES ('$new_id', '$nis', '$nama', '$asrama', '$kelas', '$tanggal', $shalat_shubuh, $shalat_dzuhur, $shalat_ashar, $shalat_maghrib, $shalat_isya, $shalat_qiyamul_lail, $shalat_dhuha, $menghafal, $murajaah, $membaca_almatsurat, $membangunkan_orangtua, $merapikan_sandal, $menghidangkan_makanan, $menjemur, $tadarus_keluarga, $menghadiri_kajian, $membersihkan_kamar, $membersihkan_rumah, $membersihkan_wc, $mencuci_piring, $mencuci_pakaian, $membaca_buku_agama, $riyadhoh, $mengenalkan_icbs, $silaturahmi, $jumlah_rawatib, $jumlah_tilawah, '$keterangan')";

if (mysqli_query($koneksi, $query)) {
    echo "";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Input Laporan</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #333;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Proses Input Laporan</h1>
        <?php if (isset($success_message)) { ?>
            <p><?php echo $success_message; ?></p>
        <?php } else { ?>
            <p>Data laporan harian berhasil disimpan.</p>
        <?php } ?>
        <a href="tamu_laporan_bw.php" class="btn btn-primary">Kembali ke Home Laporan</a>
    </div>
</body>
</html>