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

// Koneksi ke database dan query untuk memeriksa apakah pengguna sudah menginput laporan hari ini
$koneksi = mysqli_connect($host, $username, $password, $database);
$nis = $_SESSION['username'];
$tanggal = date('Y-m-d'); // Mendapatkan tanggal hari ini

$query = "SELECT * FROM tamu_laporan_bw WHERE nis = '$nis' AND tanggal = '$tanggal'";
$result = mysqli_query($koneksi, $query);
$sudahInput = mysqli_num_rows($result) > 0;

$nis = $_SESSION['username'];

// Ambil data diagram dari database
$query = "SELECT 
            SUM(CASE WHEN shalat_shubuh = 1 THEN 1 ELSE 0 END) AS shubuh,
            SUM(CASE WHEN shalat_dzuhur = 1 THEN 1 ELSE 0 END) AS dzuhur,
            SUM(CASE WHEN shalat_ashar = 1 THEN 1 ELSE 0 END) AS ashar,
            SUM(CASE WHEN shalat_maghrib = 1 THEN 1 ELSE 0 END) AS maghrib,
            SUM(CASE WHEN shalat_isya = 1 THEN 1 ELSE 0 END) AS isya,
            SUM(CASE WHEN shalat_qiyamul_lail = 1 THEN 1 ELSE 0 END) AS qiyamul_lail,
            SUM(CASE WHEN shalat_dhuha = 1 THEN 1 ELSE 0 END) AS dhuha,
            SUM(CASE WHEN menghafal = 1 THEN 1 ELSE 0 END) AS menghafal,
            SUM(CASE WHEN murajaah = 1 THEN 1 ELSE 0 END) AS murajaah,
            SUM(CASE WHEN membaca_almatsurat = 1 THEN 1 ELSE 0 END) AS membaca_almatsurat,
            SUM(CASE WHEN membangunkan_orangtua = 1 THEN 1 ELSE 0 END) AS membangunkan_orangtua,
            SUM(CASE WHEN merapikan_sandal = 1 THEN 1 ELSE 0 END) AS merapikan_sandal,
            SUM(CASE WHEN menghidangkan_makanan = 1 THEN 1 ELSE 0 END) AS menghidangkan_makanan,
            SUM(CASE WHEN menjemur = 1 THEN 1 ELSE 0 END) AS menjemur,
            SUM(CASE WHEN tadarus_keluarga = 1 THEN 1 ELSE 0 END) AS tadarus_keluarga,
            SUM(CASE WHEN menghadiri_kajian = 1 THEN 1 ELSE 0 END) AS menghadiri_kajian,
            SUM(CASE WHEN membersihkan_kamar = 1 THEN 1 ELSE 0 END) AS membersihkan_kamar,
            SUM(CASE WHEN membersihkan_rumah = 1 THEN 1 ELSE 0 END) AS membersihkan_rumah,
            SUM(CASE WHEN membersihkan_wc = 1 THEN 1 ELSE 0 END) AS membersihkan_wc,
            SUM(CASE WHEN mencuci_piring = 1 THEN 1 ELSE 0 END) AS mencuci_piring,
            SUM(CASE WHEN mencuci_pakaian = 1 THEN 1 ELSE 0 END) AS mencuci_pakaian,
            SUM(CASE WHEN membaca_buku_agama = 1 THEN 1 ELSE 0 END) AS membaca_buku_agama,
            SUM(CASE WHEN riyadhoh = 1 THEN 1 ELSE 0 END) AS riyadhoh,
            SUM(CASE WHEN mengenalkan_icbs = 1 THEN 1 ELSE 0 END) AS mengenalkan_icbs,
            SUM(CASE WHEN silaturahmi = 1 THEN 1 ELSE 0 END) AS silaturahmi
          FROM tamu_laporan_bw WHERE nis = '$nis'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Laporan BW</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --background-color: #ecf0f1;
            --text-color: #34495e;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .navbar {
            background-color: var(--primary-color);
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand img {
            width: 30px;
            margin-right: 10px;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: rotate(360deg);
        }
        
        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 600;
        }
        
        .header {
            background-color: var(--secondary-color);
            color: #fff;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 1s;
        }
        
        .header h2 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 1s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 1.5rem;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .diagram {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            padding: 1.5rem;
        }
        
        .diagram-item {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .diagram-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .diagram-item img {
            width: 40px;
            height: 40px;
            margin-bottom: 0.5rem;
            transition: transform 0.3s ease;
        }
        
        .diagram-item:hover img {
            transform: scale(1.1);
        }
        
        .diagram-item span {
            font-size: 0.8rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }
        
        .diagram-item .percentage {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-color);
        }
        
        .button-container {
            display: flex;
            justify-content: center;
            padding: 1.5rem 0;
            background-color: #ffffff;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .button-container a, .button-container button {
            margin: 0 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-success {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-success:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @media (max-width: 390px) {
            .header {
                padding: 1.5rem;
            }
            
            .header h2 {
                font-size: 1.5rem;
            }
            
            .diagram {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
            
            .diagram-item {
                padding: 0.8rem;
            }
            
            .diagram-item img {
                width: 30px;
                height: 30px;
            }
            
            .diagram-item span {
                font-size: 0.7rem;
            }
            
            .diagram-item .percentage {
                font-size: 1rem;
            }
            
            .button-container a, .button-container button {
                padding: 0.6rem 1rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
<!-- <nav class="navbar navbar-expand-lg navbar-dark animate__animated animate__fadeIn">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo" class="animate__animated animate__rotateIn"> Database Santri
        </a>
    </nav> -->

    <div class="header animate__animated animate__fadeInDown">
        <h2>Laporan BW</h2>
    </div>

    <div class="button-container animate__animated animate__fadeInUp">
        <?php if ($sudahInput): ?>
            <button class="btn btn-secondary" disabled>Anda Telah Input Laporan Hari Ini</button>
        <?php else: ?>
            <a href="tamu_input_laporan.php" class="btn btn-success">Input Laporan Harian</a>
        <?php endif; ?>
        <a href="hometamu.php" class="btn btn-danger">Kembali ke Home</a>
    </div>

    <div class="container">
        <div class="card animate__animated animate__fadeInUp">
            <div class="card-header">
                Diagram Laporan
            </div>
            <div class="card-body">
                <div class="diagram">
                    <?php
                    $items = [
                        ['name' => 'Sholat Shubuh', 'icon' => 'tamu_sajada.png', 'data' => 'shubuh'],
                        ['name' => 'Sholat Dzuhur', 'icon' => 'tamu_sajada.png', 'data' => 'dzuhur'],
                        ['name' => 'Sholat Ashar', 'icon' => 'tamu_sajada.png', 'data' => 'ashar'],
                        ['name' => 'Sholat Maghrib', 'icon' => 'tamu_sajada.png', 'data' => 'maghrib'],
                        ['name' => 'Sholat Isya', 'icon' => 'tamu_sajada.png', 'data' => 'isya'],
                        ['name' => 'Qiyamul Lail', 'icon' => 'tamu_sajada.png', 'data' => 'qiyamul_lail'],
                        ['name' => 'Sholat Dhuha', 'icon' => 'tamu_sajada.png', 'data' => 'dhuha'],
                        ['name' => 'Menghafal Quran', 'icon' => 'tamu_quran.png', 'data' => 'menghafal'],
                        ['name' => 'Murajaah Hafalan', 'icon' => 'tamu_quran.png', 'data' => 'murajaah'],
                        ['name' => 'Membaca Almatsurat', 'icon' => 'tamu_dzikir.png', 'data' => 'membaca_almatsurat'],
                        ['name' => 'Bangunkan orang tua tahajjud', 'icon' => 'tamu_membangunkanorangtua.png', 'data' => 'membangunkan_orangtua'],
                        ['name' => 'Meletakkan sepatu/sandal orang tua', 'icon' => 'tamu_sepatu.png', 'data' => 'merapikan_sandal'],
                        ['name' => 'Menghidangkan makanan untuk orang tua', 'icon' => 'tamu_menghidangkan.png', 'data' => 'menghidangkan_makanan'],
                        ['name' => 'Jemur/angkat jemuran', 'icon' => 'tamu_menjemur.png', 'data' => 'menjemur'],
                        ['name' => 'Tadarus bersama keluarga', 'icon' => 'tamu_quran.png', 'data' => 'tadarus_keluarga'],
                        ['name' => 'Menghadiri kajian', 'icon' => 'tamu_kajian.png', 'data' => 'menghadiri_kajian'],
                        ['name' => 'Merapikan kamar', 'icon' => 'tamu_kamar.png', 'data' => 'membersihkan_kamar'],
                        ['name' => 'Membersihkan rumah', 'icon' => 'tamu_rumah.png', 'data' => 'membersihkan_rumah'],
                        ['name' => 'Membersihkan kamar mandi', 'icon' => 'tamu_sajada.png', 'data' => 'membersihkan_wc'],
                        ['name' => 'Mencuci piring', 'icon' => 'tamu_sajada.png', 'data' => 'mencuci_piring'],
                        ['name' => 'Mencuci pakaian', 'icon' => 'tamu_sajada.png', 'data' => 'mencuci_pakaian'],
                        ['name' => 'Membaca buku-buku pendidikan/ buku islami', 'icon' => 'tamu_sajada.png', 'data' => 'membaca_buku_agama'],
                        ['name' => 'Riyadhoh', 'icon' => 'tamu_sajada.png', 'data' => 'riyadhoh'],
                        ['name' => 'Mengenalkan ICBS', 'icon' => 'tamu_sajada.png', 'data' => 'mengenalkan_icbs'],
                        ['name' => 'Silaturahmi', 'icon' => 'tamu_sajada.png', 'data' => 'silaturahmi']
                    ];

                    foreach ($items as $item):
                    ?>
                        <div class="diagram-item">
                            <img src="<?php echo $item['icon']; ?>" alt="<?php echo $item['name']; ?>">
                            <span><?php echo $item['name']; ?></span>
                            <span class="percentage"><?php echo $data[$item['data']]; ?>%</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>