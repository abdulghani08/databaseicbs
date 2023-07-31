<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa apakah ada permintaan pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan data dari form
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $asrama = mysqli_real_escape_string($koneksi, $_POST['asrama']);
    $pembina = mysqli_real_escape_string($koneksi, $_POST['pembina']);
    $muhafizh = mysqli_real_escape_string($koneksi, $_POST['muhafizh']);
    $sekolah_asal = mysqli_real_escape_string($koneksi, $_POST['sekolah_asal']);
    $cita = mysqli_real_escape_string($koneksi, $_POST['cita']);
    $alamat_medsos = mysqli_real_escape_string($koneksi, $_POST['alamat_medsos']);
    $riwayat_penyakit = mysqli_real_escape_string($koneksi, $_POST['riwayat_penyakit']);
    $alergi = mysqli_real_escape_string($koneksi, $_POST['alergi']);
    $anakke = mysqli_real_escape_string($koneksi, $_POST['anakke']);
    $bersaudara = mysqli_real_escape_string($koneksi, $_POST['bersaudara']);
    $disenangi = mysqli_real_escape_string($koneksi, $_POST['disenangi']);
    $tidak_disenangi = mysqli_real_escape_string($koneksi, $_POST['tidak_disenangi']);
    $nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
    $pekerjaan_ayah = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ayah']);
    $hp_ayah = mysqli_real_escape_string($koneksi, $_POST['hp_ayah']);
    $nama_ibu = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
    $pekerjaan_ibu = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ibu']);
    $hp_ibu = mysqli_real_escape_string($koneksi, $_POST['hp_ibu']);
    $karakter_disukai = mysqli_real_escape_string($koneksi, $_POST['karakter_disukai']);
    $karakter_tidakdisukai = mysqli_real_escape_string($koneksi, $_POST['karakter_tidakdisukai']);
    $kelebihan = mysqli_real_escape_string($koneksi, $_POST['kelebihan']);
    $kekurangan = mysqli_real_escape_string($koneksi, $_POST['kekurangan']);
    $motto = mysqli_real_escape_string($koneksi, $_POST['motto']);

    // Perbarui data pada tabel tahfizh_data
    $query = "UPDATE putra_portopolio_isi SET nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', kelas='$kelas', asrama='$asrama', pembina='$pembina', muhafizh='$muhafizh', sekolah_asal='$sekolah_asal', cita='$cita', alamat_medsos='$alamat_medsos', riwayat_penyakit='$riwayat_penyakit', alergi='$alergi', anakke='$anakke', bersaudara='$bersaudara', disenangi='$disenangi', tidak_disenangi='$tidak_disenangi', nama_ayah='$nama_ayah', pekerjaan_ayah='$pekerjaan_ayah', hp_ayah='$hp_ayah', nama_ibu='$nama_ibu', pekerjaan_ibu='$pekerjaan_ibu', hp_ibu='$hp_ibu', karakter_disukai='$karakter_disukai', karakter_tidakdisukai='$karakter_tidakdisukai', kelebihan='$kelebihan', kekurangan='$kekurangan', motto='$motto' WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data telah berhasil diperbarui.";
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi);
    }
}

// Dapatkan data santri berdasarkan NIS yang diterima dari parameter URL
$nis = $_GET['nis'];
$query = "SELECT * FROM putra_portopolio_isi WHERE nis='$nis'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Santri</title>
    <link rel="shortcut icon" href="../logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../backgroundgedung.jpg');
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
                <a href="dt_portopolio.php">Kembali</a>
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
