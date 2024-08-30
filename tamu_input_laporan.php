<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'Tamu') {
    header("Location: login.php");
    exit();
}

$nis = $_SESSION['username'];

$query = "SELECT * FROM portopolio_isi WHERE nis = '$nis'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $dataSantri = mysqli_fetch_assoc($result);
} else {
    $dataSantri = array(
        'nama' => 'Nama Santri',
        'asrama' => 'Asrama Santri',
        'kelas' => 'Kelas Santri',
    );
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Laporan Harian</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script>
function setCurrentDate() {
  var today = new Date().toISOString().split('T')[0];
  document.getElementById('tanggal').value = today;
  document.getElementById('tanggal').min = today;
  document.getElementById('tanggal').max = today;
}
</script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('tamu_latar_input_laporan.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            transition: background-image 0.5s ease-in-out;
        }
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: -1;
            transition: background-color 0.5s ease-in-out;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 30px rgba(0,0,0,0.2);
        }
        .navbar-brand img {
            width: 30px;
            margin-right: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .navbar-brand:hover img {
            transform: rotate(360deg);
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: all 0.3s ease-in-out;
        }
        .header:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }
        .card {
            margin-top: 20px;
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s ease-in-out;
        }
        .card-header:hover {
            background-color: #0056b3;
        }
        .form-check-label {
            margin-right: 10px;
            transition: color 0.3s ease-in-out;
        }
        .form-check-label:hover {
            color: #007bff;
        }
        .form-check-input {
            width: 20px;
            height: 20px;
            opacity: 0.7;
            transition: all 0.3s ease-in-out;
        }
        .form-check-input:checked {
            opacity: 1;
            transform: scale(1.1);
        }
        .custom-control-label {
            font-weight: 500;
            cursor: pointer;
            padding-left: 2rem;
            transition: all 0.3s ease-in-out;
        }
        .custom-control-label:hover {
            color: #007bff;
        }
        .custom-control-custom-checkbox {
            margin-bottom: 0.5rem;
        }
        .btn {
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .animate__animated {
            animation-duration: 1s;
        }
    </style>
</head>
<body onload="setCurrentDate()">
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light animate__animated animate__fadeInDown">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo"> Database Santri
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav> -->

    <div class="header animate__animated animate__fadeInDown">
        <h2>Input Laporan Harian</h2>
    </div>

    <div class="container animate__animated animate__fadeIn">
        <div class="card">
            <div class="card-header">
                Data Santri
            </div>
            <div class="card-body">
                <form action="tamu_proses_input.php" method="post">
                    <div class="form-group">
                        <label for="nama">NIS Santri</label>
                        <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $dataSantri['nis']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Santri</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $dataSantri['nama']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="asrama">Asrama</label>
                        <input type="text" class="form-control" id="asrama" name="asrama" value="<?php echo $dataSantri['asrama']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $dataSantri['kelas']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" readonly>
                    </div>
                    <p>
                    <br><center><h5>Ceklis apabila melaksanakan</h5></center>
                    <br>
                    <div class="form-group">
                        <label><strong>Bidang Ibadah (Shalat)</strong></label>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="shalat_shubuh" name="shalat_shubuh" value="1">
                            <label class="custom-control-label" for="shalat_shubuh">Shalat Shubuh Berjamaah</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="shalat_dzuhur" name="shalat_dzuhur" value="1">
                            <label class="custom-control-label" for="shalat_dzuhur">Shalat Dzuhur Berjamaah</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="shalat_ashar" name="shalat_ashar" value="1">
                            <label class="custom-control-label" for="shalat_ashar">Shalat Ashar Berjamaah</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="shalat_maghrib" name="shalat_maghrib" value="1">
                            <label class="custom-control-label" for="shalat_maghrib">Shalat Maghrib Berjamaah</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="shalat_isya" name="shalat_isya" value="1">
                            <label class="custom-control-label" for="shalat_isya">Shalat Isya Berjamaah</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="shalat_qiyamul_lail" name="shalat_qiyamul_lail" value="1">
                            <label class="custom-control-label" for="shalat_qiyamul_lail">Shalat Qiyamul Lail</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="shalat_dhuha" name="shalat_dhuha" value="1">
                            <label class="custom-control-label" for="shalat_dhuha">Shalat Dhuha</label>
                        </div>
                        
                        <!-- Tambahkan checkbox lainnya untuk bidang ibadah -->
                    </div>
                    <div class="form-group">
                        <label><strong>Bidang Ibadah (Lainnya)</strong></label>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="menghafal" name="menghafal" value="1">
                            <label class="custom-control-label" for="menghafal">Menghafal Al Quran 3 baris</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="murajaah" name="murajaah" value="1">
                            <label class="custom-control-label" for="murajaah">Murajaah hafalan 5 halaman</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="membaca_almatsurat" name="membaca_almatsurat" value="1">
                            <label class="custom-control-label" for="membaca_almatsurat">Membaca Al Matsurat pagi atau sore</label>
                        </div>
                        <!-- Tambahkan checkbox lainnya untuk bidang akhlak dan ibadah -->
                    </div>
                    <div class="form-group">
                        <label><strong>Kegiatan Birrul Walidain</strong></label>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="membangunkan_orangtua" name="membangunkan_orangtua" value="1">
                            <label class="custom-control-label" for="membangunkan_orangtua">Membangunkan orang tua tahajjud</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="merapikan_sandal" name="merapikan_sandal" value="1">
                            <label class="custom-control-label" for="merapikan_sandal">Meletakkan sepatu/ sandal orang tua pada tempatnya</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="menghidangkan_makanan" name="menghidangkan_makanan" value="1">
                            <label class="custom-control-label" for="menghidangkan_makanan">Menghidangkan makanan / minuman untuk orang tua</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="menjemur" name="menjemur" value="1">
                            <label class="custom-control-label" for="menjemur">Mejemur atau mengangkat jemuran</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="tadarus_keluarga" name="tadarus_keluarga" value="1">
                            <label class="custom-control-label" for="tadarus_keluarga">Tadarus Al Quran bersama keluarga</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="menghadiri_kajian" name="menghadiri_kajian" value="1">
                            <label class="custom-control-label" for="menghadiri_kajian">Menghadiri kajian di Masjid/ Mushalla</label>
                        </div>
                        <!-- Tambahkan checkbox lainnya untuk bidang akhlak dan ibadah -->
                    </div>
                    <div class="form-group">
                        <label><strong>Bidang Kebersihan/ Kerapian</strong></label>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="membersihkan_kamar" name="membersihkan_kamar" value="1">
                            <label class="custom-control-label" for="membersihkan_kamar">Membersihkan dan merapikan kamar tidur</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="membersihkan_rumah" name="membersihkan_rumah" value="1">
                            <label class="custom-control-label" for="membersihkan_rumah">Membersihkan dan merapikan rumah</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="membersihkan_wc" name="membersihkan_wc" value="1">
                            <label class="custom-control-label" for="membersihkan_wc">Membersihkan kamar mandi</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="mencuci_piring" name="mencuci_piring" value="1">
                            <label class="custom-control-label" for="mencuci_piring">Mencuci piring</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="mencuci_pakaian" name="mencuci_pakaian" value="1">
                            <label class="custom-control-label" for="mencuci_pakaian">Mencuci pakaian</label>
                        </div>
                        <!-- Tambahkan checkbox lainnya untuk bidang akhlak dan ibadah -->
                    </div>
                    <div class="form-group">
                        <label><strong>Aktivitas Pribadi</strong></label>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="membaca_buku_agama" name="membaca_buku_agama" value="1">
                            <label class="custom-control-label" for="membaca_buku_agama">Membaca buku-buku pendidikan / buku islami</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="riyadhoh" name="riyadhoh" value="1">
                            <label class="custom-control-label" for="riyadhoh">Melaksanakan riyadhoh</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="mengenalkan_icbs" name="mengenalkan_icbs" value="1">
                            <label class="custom-control-label" for="mengenalkan_icbs">Mengenalkan ICBS ke kerabat/ tetangga/ lainnya</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="silaturahmi" name="silaturahmi" value="1">
                            <label class="custom-control-label" for="silaturahmi">Silaturahmi mengunjungi sanak famili</label>
                        </div>
                        <!-- Tambahkan checkbox lainnya untuk bidang akhlak dan ibadah -->
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for="jumlah_rawatib"><strong>Jumlah Pelaksanaan Shalat Sunnah Rawatib</strong></label>
                        <select class="form-control" id="jumlah_rawatib" name="jumlah_rawatib" required>
                            <option value="">Pilih</option>
                            <option value="0">Tidak ada</option>
                            <option value="2">2 Rakaat</option>
                            <option value="4">4 Rakaat</option>
                            <option value="6">6 Rakaat</option>
                            <option value="8">8 Rakaat</option>
                            <option value="10">10 Rakaat</option>
                            <option value="12">12 Rakaat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_tilawah"><strong>Jumlah Tilawah Al Quran</strong></label>
                        <select class="form-control" id="jumlah_tilawah" name="jumlah_tilawah" required>
                            <option value="">Pilih</option>
                            <option value="0">Tidak ada</option>
                            <option value="1">1 Lembar</option>
                            <option value="2">2 Lembar</option>
                            <option value="3">3 Lembar</option>
                            <option value="4">4 Lembar</option>
                            <option value="5">5 Lembar</option>
                            <option value="6">6 Lembar</option>
                            <option value="7">7 Lembar</option>
                            <option value="8">8 Lembar</option>
                            <option value="9">9 Lembar</option>
                            <option value="10">10 Lembar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan"><strong>Keterangan</strong></label>
                        <select class="form-control" id="keterangan" name="keterangan" required>
                            <option value="">Pilih</option>
                            <option value="0">Tidak ada</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Haid">Haid</option>
                        </select>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="keabsahan_data" name="keabsahan_data" required>
                        <label class="form-check-label" for="keabsahan_data">
                            <strong>Dengan ini saya menyatakan bahwa data yang saya masukkan benar adanya, dan jika ternyata dikemudian hari ditemukan kesalahan pada data ini baik yang disengaja ataupun tidak disengaja maka saya bersedia menerima sanksi dan resiko yang ditimbulkan karenanya.</strong>
                        </label>
                    </div>
                    <center>
                    <button type="submit" class="btn btn-primary animate__animated animate__pulse">Submit</button>
                    <a href="tamu_laporan_bw.php" class="btn btn-danger animate__animated animate__pulse">Kembali</a>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Add animation to form elements when they come into view
        function animateOnScroll() {
            $('.animate__animated').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                
                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animate__fadeInUp');
                }
            });
        }

        $(window).on('scroll', animateOnScroll);
        $(document).ready(animateOnScroll);

        // Add hover effect to checkboxes
        $('.custom-control-input').hover(
            function() { $(this).parent().find('.custom-control-label').addClass('text-primary'); },
            function() { $(this).parent().find('.custom-control-label').removeClass('text-primary'); }
        );
    </script>
</body>
</html>