<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);
$user = $_SESSION['username'];

// Fetch nama from register table
$sql = "SELECT nama FROM register WHERE username='$user'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$nama_pembina = $row['nama'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];
    $tanggal = date("Y-m-d");
    $jumlah_santri = $_POST['jumlah_santri'];
    $jumlah_santri_sakit = $_POST['jumlah_santri_sakit'];
    $jumlah_santri_izin = $_POST['jumlah_santri_izin'];
    $membangunkan_santri = $_POST['membangunkan_santri'];
    $shalat_tahajjud_santri = $_POST['shalat_tahajjud_santri'];
    $santri_ke_masjid = $_POST['santri_ke_masjid'];
    $shalat_shubuh_santri = $_POST['shalat_shubuh_santri'];
    $tahfizh_santri = $_POST['tahfizh_santri'];
    $setoran_shubuh = $_POST['setoran_shubuh'];
    $sarapan = $_POST['sarapan'];
    $piket = $_POST['piket'];
    $sarana_prasarana = $_POST['sarana_prasarana'];
    $merapikan_kamar = $_POST['merapikan_kamar'];
    $berangkat_sekolah = $_POST['berangkat_sekolah'];
    $berpakaian_rapi = $_POST['berpakaian_rapi'];
    $tutor_bahasa = $_POST['tutor_bahasa'];
    $shalat_dzuhur_santri = $_POST['shalat_dzuhur_santri'];
    $makan_siang = $_POST['makan_siang'];
    $makan_siang_bersama = $_POST['makan_siang_bersama'];
    $shalat_ashar_santri = $_POST['shalat_ashar_santri'];
    $membaca_almatsurat_santri = $_POST['membaca_almatsurat_santri'];
    $makan_malam = $_POST['makan_malam'];
    $makan_malam_bersama = $_POST['makan_malam_bersama'];
    $shalat_maghrib_santri = $_POST['shalat_maghrib_santri'];
    $halaqah_tahfizh = $_POST['halaqah_tahfizh'];
    $shalat_isya_santri = $_POST['shalat_isya_santri'];
    $kegiatan_bakda_isya = $_POST['kegiatan_bakda_isya'];
    $evaluasi_asrama = $_POST['evaluasi_asrama'];
    $penyetoran_bahasa_malam = $_POST['penyetoran_bahasa_malam'];
    $berwudhu_sebelum_tidur = $_POST['berwudhu_sebelum_tidur'];
    $memastikan_santri_diasrama = $_POST['memastikan_santri_diasrama'];
    $sop_sandal = $_POST['sop_sandal'];
    $komunikasi_orangtua = $_POST['komunikasi_orangtua'];
    $dokumen_santri = $_POST['dokumen_santri'];
    $pemanggilan_santri = $_POST['pemanggilan_santri'];
    $mengisi_database_santri = $_POST['mengisi_database_santri'];
    $mengontrol_laundry = $_POST['mengontrol_laundry'];
    $kebersihan_malam = $_POST['kebersihan_malam'];
    $menjaga_sarana_prasarana = $_POST['menjaga_sarana_prasarana'];
    $bangun_sebelum_shubuh = $_POST['bangun_sebelum_shubuh'];
    $shalat_tahajjud_pembina = $_POST['shalat_tahajjud_pembina'];
    $shalat_shubuh_pembina = $_POST['shalat_shubuh_pembina'];
    $shalat_dhuha_pembina = $_POST['shalat_dhuha_pembina'];
    $shalat_dzuhur_pembina = $_POST['shalat_dzuhur_pembina'];
    $shalat_ashar_pembina = $_POST['shalat_ashar_pembina'];
    $membaca_almatsurat_pembina = $_POST['membaca_almatsurat_pembina'];
    $shalat_maghrib_pembina = $_POST['shalat_maghrib_pembina'];
    $shalat_isya_pembina = $_POST['shalat_isya_pembina'];
    $tilawah = $_POST['tilawah'];
    $puasa_sunnah = $_POST['puasa_sunnah'];

    // Validasi semua field telah diisi
    // $fields = [$jumlah_santri, $membangunkan_santri, $santri_ke_masjid, $shalat_shubuh_santri, $setoran_shubuh, $sarapan, $piket, $sarana_prasarana, $merapikan_kamar, $berangkat_sekolah, $berpakaian_rapi, $tutor_bahasa, $shalat_dzuhur_santri, $makan_siang, $makan_siang_bersama, $shalat_ashar_santri, $membaca_almatsurat_santri, $makan_malam, $makan_malam_bersama, $shalat_maghrib_santri, $halaqah_tahfizh, $shalat_isya_santri, $kegiatan_bakda_isya, $evaluasi_asrama, $penyetoran_bahasa_malam, $berwudhu_sebelum_tidur, $memastikan_santri_diasrama, $sop_sandal, $komunikasi_orangtua, $dokumen_santri, $pemanggilan_santri, $mengisi_database_santri, $mengontrol_laundry, $kebersihan_malam, $menjaga_sarana_prasarana, $bangun_sebelum_shubuh, $shalat_tahajjud_pembina, $shalat_shubuh_pembina, $shalat_dhuha_pembina, $shalat_dzuhur_pembina, $shalat_ashar_pembina, $membaca_almatsurat_pembina, $shalat_maghrib_pembina, $shalat_isya_pembina, $tilawah, $puasa_sunnah];
    
    // if (in_array("", $fields) || in_array("Pilih", $fields)) {
    //     echo "<script>alert('Semua field harus diisi!'); window.location.href='pembina_form_jurnal.php';</script>";
    //     exit();
    // }

    $sql = "INSERT INTO jurnal_pembina (username, nama, nis, tanggal, jumlah_santri, jumlah_santri_sakit, jumlah_santri_izin, membangunkan_santri, shalat_tahajjud_santri, santri_ke_masjid, shalat_shubuh_santri, tahfizh_santri, setoran_shubuh, sarapan, piket, sarana_prasarana, merapikan_kamar, berangkat_sekolah, berpakaian_rapi, tutor_bahasa, shalat_dzuhur_santri, makan_siang, makan_siang_bersama, shalat_ashar_santri, membaca_almatsurat_santri, makan_malam, makan_malam_bersama, shalat_maghrib_santri, halaqah_tahfizh, shalat_isya_santri, kegiatan_bakda_isya, evaluasi_asrama, penyetoran_bahasa_malam, berwudhu_sebelum_tidur, memastikan_santri_diasrama, sop_sandal, komunikasi_orangtua, dokumen_santri, pemanggilan_santri, mengisi_database_santri, mengontrol_laundry, kebersihan_malam, menjaga_sarana_prasarana, bangun_sebelum_shubuh, shalat_tahajjud_pembina, shalat_shubuh_pembina, shalat_dhuha_pembina, shalat_dzuhur_pembina, shalat_ashar_pembina, membaca_almatsurat_pembina, shalat_maghrib_pembina, shalat_isya_pembina, tilawah, puasa_sunnah) 
            VALUES ('$user', '$nama_pembina', '$nis', '$tanggal', '$jumlah_santri', '$jumlah_santri_sakit', '$jumlah_santri_izin', '$membangunkan_santri', '$shalat_tahajjud_santri', '$santri_ke_masjid', '$shalat_shubuh_santri', '$tahfizh_santri', '$setoran_shubuh', '$sarapan', '$piket', '$sarana_prasarana', '$merapikan_kamar', '$berangkat_sekolah', '$berpakaian_rapi', '$tutor_bahasa', '$shalat_dzuhur_santri', '$makan_siang', '$makan_siang_bersama', '$shalat_ashar_santri', '$membaca_almatsurat_santri', '$makan_malam', '$makan_malam_bersama', '$shalat_maghrib_santri', '$halaqah_tahfizh', '$shalat_isya_santri', '$kegiatan_bakda_isya', '$evaluasi_asrama', '$penyetoran_bahasa_malam', '$berwudhu_sebelum_tidur', '$memastikan_santri_diasrama', '$sop_sandal', '$komunikasi_orangtua', '$dokumen_santri', '$pemanggilan_santri', '$mengisi_database_santri', '$mengontrol_laundry', '$kebersihan_malam', '$menjaga_sarana_prasarana', '$bangun_sebelum_shubuh', '$shalat_tahajjud_pembina', '$shalat_shubuh_pembina', '$shalat_dhuha_pembina', '$shalat_dzuhur_pembina', '$shalat_ashar_pembina', '$membaca_almatsurat_pembina', '$shalat_maghrib_pembina', '$shalat_isya_pembina', '$tilawah', '$puasa_sunnah')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Jurnal berhasil disimpan!'); window.location.href='pembina_jurnal.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Jurnal Pembina</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF8C00;
            --secondary-color: #FFA500;
            --text-color: #333;
            --bg-color: #FFF5E6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background: linear-gradient(135deg, var(--bg-color), var(--secondary-color));
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            animation: fadeIn 0.5s ease-out;
        }
        
        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
            animation: slideIn 0.5s ease-out;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        input[readonly] {
            background-color: #f0f0f0;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }
        
        .btn-submit:hover {
            background-color: var(--secondary-color);
        }
        
        .icon {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            
            input, select, .btn-submit {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-book icon"></i>FORM JURNAL PEMBINA</h1>
        <form method="POST">
            <div class="form-group">
                <label for="username"><i class="fas fa-user icon"></i>Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nama"><i class="fas fa-id-card icon"></i>Nama Pembina:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama_pembina; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nis"><i class="fas fa-id-card icon"></i>Kode Pembina:</label>
                <input type="text" id="nis" name="nis" value="<?php echo $nis; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="tanggal"><i class="fas fa-calendar-alt icon"></i>Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_santri"><i class="fas fa-id-card icon"></i>Jumlah Santri:</label>
                <input type="jumlah_santri" id="jumlah_santri" name="jumlah_santri" placeholder="Masukkan Angka" require>
            </div>
            <div class="form-group">
                <label for="jumlah_santri_sakit"><i class="fas fa-id-card icon"></i>Jumlah Santri Sakit:</label>
                <input type="jumlah_santri_sakit" id="jumlah_santri_sakit" name="jumlah_santri_sakit" placeholder="Masukkan Angka" require>
            </div>
            <div class="form-group">
                <label for="jumlah_santri_izin"><i class="fas fa-id-card icon"></i>Jumlah Santri Izin:</label>
                <input type="jumlah_santri_izin" id="jumlah_santri_izin" name="jumlah_santri_izin" placeholder="Masukkan Angka" require>
            </div>
            <br><br>
            <h2><i class="fas fa-pray icon"></i>Pembinaan Santri</h2>
            <br>
            <?php
            $shalat = ['membangunkan_santri', 'shalat_tahajjud_santri', 'santri_ke_masjid', 'shalat_shubuh_santri', 'tahfizh_santri', 'setoran_shubuh', 'sarapan', 'piket', 'sarana_prasarana', 'merapikan_kamar', 'berangkat_sekolah', 'berpakaian_rapi', 'tutor_bahasa', 'shalat_dzuhur_santri', 'makan_siang', 'makan_siang_bersama', 'shalat_ashar_santri', 'membaca_almatsurat_santri', 'makan_malam', 'makan_malam_bersama', 'shalat_maghrib_santri', 'halaqah_tahfizh', 'shalat_isya_santri', 'kegiatan_bakda_isya', 'evaluasi_asrama', 'penyetoran_bahasa_malam', 'berwudhu_sebelum_tidur', 'memastikan_santri_diasrama', 'sop_sandal', 'komunikasi_orangtua', 'dokumen_santri', 'pemanggilan_santri', 'mengisi_database_santri', 'mengontrol_laundry', 'kebersihan_malam', 'menjaga_sarana_prasarana'];
            $shalat_labels = ['Membangunkan Santri', 'Mengontrol santri untuk shalat tahajjud', 'Mengontrol santri dalam persiapan ke masjid', 'Mengontrol santri untuk shalat subuh berjamaah di mushalla', 'Mengontrol santri dalam kegiatan tahfizh', 'Menerima setoran santri shubuh', 'Mengontrol dan atau membersamai sarapan pagi santri', 'Pengontrolan piket santri', 'Pengecekan sarana prasarana santri', 'Memastikan santri telah merapikan tempat tidur', 'Mengontrol santri untuk berangkat ke sekolah', 'Memastikan santri telah berpakaian rapi dan lengkap', 'Mengontrol santri untuk kegiatan tutor bahasa', 'Mengontrol sholat dzuhur santri', 'Mengontrol makan siang santri', 'Membersamai makan siang santri', 'Mengontrol shalat ashar santri', 'Mengontrol santri membaca Almatsurat', 'Mengontrol makan malam santri', 'Membersamai makan malam santri', 'Mengontrol sholat maghrib santri', 'Mendampingi halaqah tahfizh dan menerima setoran hafalan santri', 'Mengontrol sholat isya berjamaah', 'Mengontrol santri disaat kegiatan kajian/bimbel/merajud ukhuwah/kegiatan bakda isya', 'Melakukan evaluasi asrama', 'Mendampingi santri dalam penyetoran bahasa malam', 'Mengontrol santri untuk berwudhu, menyikat gigi dan berdoa sebelum tidur', 'Memastikan santri telah berada di asrama dan di tempat tidur masing-masing sebelum jam 22.00', 'Memastikan SOP sendal sebelum tidur', 'Komunikasi dengan orang tua', 'Mengirim dokumentasi santri di grup asrama', 'pemanggilan santri (pembinaan ataupun apresiasi)', 'Mengisi dan melengkapi database santri', 'Mengontrol laundry', 'Mengontrol kebersihan malam hari', 'Menjaga dan merawat sarana prasarana pondok'];
            
            foreach ($shalat as $index => $s) {
                echo '<div class="form-group">';
                echo '<label for="'.$s.'"><i class="fas fa-mosque icon"></i>'.$shalat_labels[$index].':</label>';
                echo '<select id="'.$s.'" name="'.$s.'" required>';
                echo '<option value="">Pilih</option>';
                echo '<option value="Ada">Ada</option>';
                echo '<option value="Tidak">Tidak Ada</option>';
                echo '<option value="Izin">Izin</option>';
                echo '</select>';
                echo '</div>';
            }
            ?>
            
            <h2><i class="fas fa-star icon"></i>Amalan Yaumiah Pembina</h2>
            <br>
            <?php
            $amalan = ['bangun_sebelum_shubuh', 'shalat_tahajjud_pembina', 'shalat_shubuh_pembina', 'shalat_dhuha_pembina', 'shalat_dzuhur_pembina', 'shalat_ashar_pembina', 'membaca_almatsurat_pembina', 'shalat_maghrib_pembina', 'shalat_isya_pembina', 'tilawah', 'puasa_sunnah'];
            $amalan_labels = ['Bangun Sebelum Shubuh', 'Shalat Tahajjud', 'Shalat shubuh berjamaah', 'Sholat sunnah dhuha', 'Sholat dzuhur berjamaah', 'Sholat ashar berjamaah', 'Membaca Almatsurat', 'Sholat maghrib berjamaah', 'Sholat isya berjamaah', 'Tilawah/ menghafal/ murajaah Al Quran', 'Puasa sunnah'];
            
            foreach ($amalan as $index => $a) {
                echo '<div class="form-group">';
                echo '<label for="'.$a.'"><i class="fas fa-check-circle icon"></i>'.$amalan_labels[$index].':</label>';
                echo '<select id="'.$a.'" name="'.$a.'" required>';
                echo '<option value="">Pilih</option>';
                echo '<option value="Ada">Ada</option>';
                echo '<option value="Tidak">Tidak Ada</option>';
                echo '<option value="Izin">Izin</option>';
                echo '<option value="Haid">Haid</option>';
                echo '</select>';
                echo '</div>';
            }
            ?>
            
            <div class="btn-group">
                <a href="pembina_jurnal.php" class="btn btn-back"><i class="fas fa-arrow-left icon"></i>Kembali</a>
                <button type="submit" class="btn btn-submit"><i class="fas fa-save icon"></i>Simpan Jurnal</button>
            </div>
        </form>
    </div>
</body>
</html>