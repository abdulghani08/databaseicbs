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
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nis = $_POST['nis'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];
    $asrama = $_POST['asrama'];
    $pembina = $_POST['pembina'];
    $muhafizh = $_POST['muhafizh'];
    $sekolah_asal = $_POST['sekolah_asal'];
    $cita = $_POST['cita'];
    $alamat_medsos = $_POST['alamat_medsos'];
    $riwayat_penyakit = $_POST['riwayat_penyakit'];
    $alergi = $_POST['alergi'];
    $anakke = $_POST['anakke'];
    $bersaudara = $_POST['bersaudara'];
    $disenangi = $_POST['disenangi'];
    $tidak_disenangi = $_POST['tidak_disenangi'];
    $nama_ayah = $_POST['nama_ayah'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $hp_ayah = $_POST['hp_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $hp_ibu = $_POST['hp_ibu'];
    $karakter_disukai = $_POST['karakter_disukai'];
    $karakter_tidakdisukai = $_POST['karakter_tidakdisukai'];
    $kelebihan = $_POST['kelebihan'];
    $kekurangan = $_POST['kekurangan'];
    $motto = $_POST['motto'];

    // Perbarui data pada tabel portopolio_isi
    $query = "UPDATE portopolio_isi SET nama=?, tempat_lahir=?, tanggal_lahir=?, alamat=?, kelas=?, asrama=?, pembina=?, muhafizh=?, sekolah_asal=?, cita=?, alamat_medsos=?, riwayat_penyakit=?, alergi=?, anakke=?, bersaudara=?, disenangi=?, tidak_disenangi=?, nama_ayah=?, pekerjaan_ayah=?, hp_ayah=?, nama_ibu=?, pekerjaan_ibu=?, hp_ibu=?, karakter_disukai=?, karakter_tidakdisukai=?, kelebihan=?, kekurangan=?, motto=? WHERE nis=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssssssssss', $nama, $tempat_lahir, $tanggal_lahir, $alamat, $kelas, $asrama, $pembina, $muhafizh, $sekolah_asal, $cita, $alamat_medsos, $riwayat_penyakit, $alergi, $anakke, $bersaudara, $disenangi, $tidak_disenangi, $nama_ayah, $pekerjaan_ayah, $hp_ayah, $nama_ibu, $pekerjaan_ibu, $hp_ibu, $karakter_disukai, $karakter_tidakdisukai, $kelebihan, $kekurangan, $motto, $nis);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data santri berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui data santri.";
    }

    mysqli_stmt_close($stmt);
}

// Dapatkan data santri berdasarkan NIS dari parameter URL
$nis = $_GET['nis'];
$query = "SELECT * FROM portopolio_isi WHERE nis=?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 's', $nis);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data_santri = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Tampilkan halaman edit data santri
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Santri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backgroundgedung.jpg');
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
                <a href="hometamu.php">Kembali</a>
            </div>
        <h2>Edit Data Santri</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Santri:</label>
                <input type="text" name="nama" value="<?php echo $row['nama']; ?>">
            </div>
            <div class="form-group">
                <label>Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']; ?>">
            </div>
            <div class="form-group">
                <label>NIS:</label>
                <input type="text" name="nis" value="<?php echo $row['nis']; ?>">
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>">
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="kelas" value="<?php echo $row['kelas']; ?>">
            </div>
            <div class="form-group">
                <label>Asrama:</label>
                <input type="text" name="asrama" value="<?php echo $row['asrama']; ?>">
            </div>
            <div class="form-group">
                <label>Pembina:</label>
                <input type="text" name="pembina" value="<?php echo $row['pembina']; ?>">
            </div>
            <div class="form-group">
                <label>Muhafizh:</label>
                <input type="text" name="muhafizh" value="<?php echo $row['muhafizh']; ?>">
            </div>
            <div class="form-group">
                <label>Sekolah Asal:</label>
                <input type="text" name="sekolah_asal" value="<?php echo $row['sekolah_asal']; ?>">
            </div>
            <div class="form-group">
                <label>Cita-cita:</label>
                <input type="text" name="cita" value="<?php echo $row['cita']; ?>">
            </div>
            <div class="form-group">
                <label>Alamat Medsos:</label>
                <input type="text" name="alamat_medsos" value="<?php echo $row['alamat_medsos']; ?>">
            </div>
            <div class="form-group">
                <label>Riwayat Penyakit:</label>
                <input type="text" name="riwayat_penyakit" value="<?php echo $row['riwayat_penyakit']; ?>">
            </div>
            <div class="form-group">
                <label>Alergi:</label>
                <input type="text" name="alergi" value="<?php echo $row['alergi']; ?>">
            </div>
            <div class="form-group">
                <label>Anak Ke-:</label>
                <input type="text" name="anakke" value="<?php echo $row['anakke']; ?>">
            </div>
            <div class="form-group">
                <label>Dari Bersaudara:</label>
                <input type="text" name="bersaudara" value="<?php echo $row['bersaudara']; ?>">
            </div>
            <div class="form-group">
                <label>Hal Yang Disenangi:</label>
                <input type="text" name="disenangi" value="<?php echo $row['disenangi']; ?>">
            </div>
            <div class="form-group">
                <label>Hal Yang Tidak Disenangi</label>
                <input type="text" name="tidak_disenangi" value="<?php echo $row['tidak_disenangi']; ?>">
            </div>
            <div class="form-group">
                <label>Nama Ayah:</label>
                <input type="text" name="nama_ayah" value="<?php echo $row['nama_ayah']; ?>">
            </div>
            <div class="form-group">
                <label>Pekerjaan Ayah:</label>
                <input type="text" name="pekerjaan_ayah" value="<?php echo $row['pekerjaan_ayah']; ?>">
            </div>
            <div class="form-group">
                <label>No. Hp Ayah:</label>
                <input type="text" name="hp_ayah" value="<?php echo $row['hp_ayah']; ?>">
            </div>
            <div class="form-group">
                <label>Nama Ibu:</label>
                <input type="text" name="nama_ibu" value="<?php echo $row['nama_ibu']; ?>">
            </div>
            <div class="form-group">
                <label>Pekerjaan Ibu:</label>
                <input type="text" name="pekerjaan_ibu" value="<?php echo $row['pekerjaan_ibu']; ?>">
            </div>
            <div class="form-group">
                <label>No. Hp Ibu:</label>
                <input type="text" name="hp_ibu" value="<?php echo $row['hp_ibu']; ?>">
            </div>
            <div class="form-group">
                <label>Karakter Yang Disukai:</label>
                <input type="text" name="karakter_disukai" value="<?php echo $row['karakter_disukai']; ?>">
            </div>
            <div class="form-group">
                <label>Karakter Yang Tidak Disukai</label>
                <input type="text" name="karakter_tidakdisukai" value="<?php echo $row['karakter_tidakdisukai']; ?>">
            </div>
            <div class="form-group">
                <label>Kelebihan Saya:</label>
                <input type="text" name="kelebihan" value="<?php echo $row['kelebihan']; ?>">
            </div>
            <div class="form-group">
                <label>Kekurangan yang akan saya perbaiki:</label>
                <input type="text" name="kekurangan" value="<?php echo $row['kekurangan']; ?>">
            </div>
            <div class="form-group">
                <label>Motto Hidup:</label>
                <input type="text" name="motto" value="<?php echo $row['motto']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan">
            </div>
        </form>
    </div>
</body>
</html>
