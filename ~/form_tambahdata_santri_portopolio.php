<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    
    // Query untuk menyimpan data santri ke tabel prestasi_data
    $query = "INSERT INTO portopolio_isi (nama, tempat_lahir, tanggal_lahir, nis, alamat, kelas, asrama, pembina, muhafizh, sekolah_asal, cita, alamat_medsos, riwayat_penyakit, alergi, anakke, bersaudara, disenangi, tidak_disenangi, nama_ayah, pekerjaan_ayah, hp_ayah, nama_ibu, pekerjaan_ibu, hp_ibu, karakter_disukai, karakter_tidakdisukai, kelebihan, kekurangan, motto) VALUES ('$nama', '$tempat_lahir', '$tanggal_lahir', '$nis', '$alamat', '$kelas', '$asrama', '$pembina', '$muhafizh', '$sekolah_asal', '$cita', '$alamat_medsos', '$riwayat_penyakit', '$alergi', '$anakke', '$bersaudara', '$disenangi', '$tidak_disenangi', '$nama_ayah', '$pekerjaan_ayah', '$hp_ayah', '$nama_ibu', '$pekerjaan_ibu', '$hp_ibu', '$karakter_disukai', '$karakter_tidakdisukai', '$kelebihan', '$kekurangan', '$motto')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data santri berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data santri.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Data Santri</title>
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
    max-width: 600px;
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
    margin-bottom: 10px;
}

label {
    display: inline-block;
    width: 100px;
}

input[type="text"] {
    width: 300px;
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #ccc;
}

.submit-button {
    text-align: center;
    margin-top: 20px;
}

.add-button {
    text-align: left;
    margin-top: 10px;
}

.add-button a {
    text-decoration: none;
    color: #333;
    background-color: #eee;
    padding: 5px 10px;
    border-radius: 3px;
}

.add-button a:hover {
    background-color: #ccc;
}

    </style>
</head>

<body>
    <div class="container">
    <div class="add-button">
            <a href="dt_portopolio.php">Kembali</a>
        </div>
        <h2>Form Tambah Data Santri</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Santri:</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label>Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label>NIS:</label>
                <input type="text" name="nis" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" name="alamat" required>
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="kelas" required>
            </div>
            <div class="form-group">
                <label>Asrama:</label>
                <input type="text" name="asrama" required>
            </div>
            <div class="form-group">
                <label>Pembina:</label>
                <input type="text" name="pembina" required>
            </div>
            <div class="form-group">
                <label>Muhafizh:</label>
                <input type="text" name="muhafizh" required>
            </div>
            <div class="form-group">
                <label>Sekolah Asal:</label>
                <input type="text" name="sekolah_asal" required>
            </div>
            <div class="form-group">
                <label>Cita-cita:</label>
                <input type="text" name="cita" required>
            </div>
            <div class="form-group">
                <label>Alamat Medsos:</label>
                <input type="text" name="alamat_medsos" required>
            </div>
            <div class="form-group">
                <label>Riwayat Penyakit:</label>
                <input type="text" name="riwayat_penyakit" required>
            </div>
            <div class="form-group">
                <label>Alergi:</label>
                <input type="text" name="alergi" required>
            </div>
            <div class="form-group">
                <label>Anak Ke-:</label>
                <input type="text" name="anakke" required>
            </div>
            <div class="form-group">
                <label>Dari Bersaudara:</label>
                <input type="text" name="bersaudara" required>
            </div>
            <div class="form-group">
                <label>Hal Yang Disenangi:</label>
                <input type="text" name="disenangi" required>
            </div>
            <div class="form-group">
                <label>Hal Yang Tidak Disenangi:</label>
                <input type="text" name="tidak_disenangi" required>
            </div>
            <div class="form-group">
                <label>Nama Ayah:</label>
                <input type="text" name="nama_ayah" required>
            </div>
            <div class="form-group">
                <label>Pekerjaan Ayah:</label>
                <input type="text" name="pekerjaan_ayah" required>
            </div>
            <div class="form-group">
                <label>No. Hp Ayah:</label>
                <input type="text" name="hp_ayah" required>
            </div>
            <div class="form-group">
                <label>Nama Ibu:</label>
                <input type="text" name="nama_ibu" required>
            </div>
            <div class="form-group">
                <label>Pekerjaan Ibu:</label>
                <input type="text" name="pekerjaan_ibu" required>
            </div>
            <div class="form-group">
                <label>No. Hp Ibu:</label>
                <input type="text" name="hp_ibu" required>
            </div>
            <div class="form-group">
                <label>Karakter Yang Disukai:</label>
                <input type="text" name="karakter_disukai" required>
            </div>
            <div class="form-group">
                <label>Karakter Yang Tidak Disukai:</label>
                <input type="text" name="karakter_tidakdisukai" required>
            </div>
            <div class="form-group">
                <label>Kelebihan Saya:</label>
                <input type="text" name="kelebihan" required>
            </div>
            <div class="form-group">
                <label>Kekurangan yang akan saya perbaiki:</label>
                <input type="text" name="kekurangan" required>
            </div>
            <div class="form-group">
                <label>Motto Hidup:</label>
                <input type="text" name="motto" required>
            </div>
            <div class="submit-button">
                <input type="submit" value="Tambah Data">
            </div>
            
        </form>
    </div>
</body>

</html>
