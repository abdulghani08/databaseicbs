<?php
session_start();
include "connection.php";
error_reporting(E_ALL^(E_NOTICE|E_WARNING));
if(empty($_SESSION['username'])){ 
    die("Anda belum login"); 
}

$koneksi = mysqli_connect($host, $username, $password, $database);
$user = $_SESSION['username'];
$sql="SELECT * from register where username='$user'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backgroundhome.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .welcome-msg {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .menu-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .menu-link.tahfizh {
            background-color: rgba(76, 175, 80, 0); /* Ubah alpha menjadi 0 untuk transparansi */
        }

        .menu-link.prestasi {
            background-color: rgba(76, 175, 80, 0); /* Ubah alpha menjadi 0 untuk transparansi */
        }

        .menu-link.disiplin {
            background-color: rgba(76, 175, 80, 0); /* Ubah alpha menjadi 0 untuk transparansi */
        }

        .menu-link.perizinan {
            background-color: rgba(76, 175, 80, 0); /* Ubah alpha menjadi 0 untuk transparansi */
        }

        .menu-link.database {
            background-color: rgba(76, 175, 80, 0);
            font-size: 18px;
            padding: 20px 40px;
            margin-bottom: 20px;
        }

        .menu-link i {
            margin-right: 5px;
            width: 20px;
            height: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .logo {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 150px;
            background-image: url(logo.png);
            background-size: cover;
        }
    </style>
    <script src="https://kit.fontawesome.com/90ffa3e064.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <h2>Welcome</h2>
    <div class="logo">
    </div>
        <p class="welcome-msg">Selamat Datang <?php echo $user; ?></p>
        <strong><p class="welcome-msg">Database Santri ICBS</p></strong>

        <center>
        <?php if ($data['level']=='Admin'): ?>
            <a class="menu-link tahfizh" href='dt_kepesantrenan.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_kepesantrenan.png" alt="Kepesantrenan Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_tahfizh.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_tahfizh.png" alt="Tahfizh Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_prestasi.php'>
                <!-- <i class="fas fa-trophy" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_prestasi.png" alt="Prestasi Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_disiplin.php'>
                <!-- <i class="fas fa-check-circle" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_disiplin.png" alt="Kedisiplinan Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_perizinan.php'>
                <!-- <i class="fas fa-file-alt" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_perizinan.png" alt="Perizinan Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_minatbakat.php'>
                <!-- <i class="fas fa-file-alt" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_minatbakat.png" alt="Minat Bakat Santri" style="width: 140px; height: 140px;">
            </a>
            <br><a class="menu-link database" href='dt_portopolio.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_portopolio.png" alt="Portopolio Santri" style="width: 200px; height: 200px;">
            </a>
            <h2 class="welcome-msg">Grafik Santri</h2>
            <a class="menu-link perizinan" href='grafik_tahfizh.php'>
                <!-- <i class="fas fa-chart-bar" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_grafiktahfizh.png" alt="Grafik Tahfizh Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link perizinan" href='grafik_kedisiplinan.php'>
                <!-- <i class="fas fa-chart-line" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_grafikdisiplin.png" alt="Grafik Kedisiplinan Santri" style="width: 140px; height: 140px;">
            </a>
            <h2 class="welcome-msg">Akun Aplikasi</h2>
            <a class="menu-link tahfizh" href='akun.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_pengaturanakun.png" alt="Pengaturan Akun Aplikasi" style="width: 140px; height: 140px;">
            </a>
        <?php elseif($data['level']=='Pembina'): ?>
            <a class="menu-link tahfizh" href='dt_kepesantrenan.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_kepesantrenan.png" alt="Kepesantrenan Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_tahfizh.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_tahfizh.png" alt="Tahfizh Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_prestasi.php'>
                <!-- <i class="fas fa-trophy" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_prestasi.png" alt="Prestasi Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_disiplin.php'>
                <!-- <i class="fas fa-check-circle" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_disiplin.png" alt="Kedisiplinan Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_perizinan.php'>
                <!-- <i class="fas fa-file-alt" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_perizinan.png" alt="Perizinan Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link tahfizh" href='dt_minatbakat.php'>
                <!-- <i class="fas fa-file-alt" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_minatbakat.png" alt="Minat Bakat Santri" style="width: 140px; height: 140px;">
            </a>
            <br><a class="menu-link database" href='dt_portopoliopembina.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_portopolio.png" alt="Portopolio Santri" style="width: 200px; height: 200px;">
            </a>
            <h2 class="welcome-msg">Grafik Santri</h2>
            <a class="menu-link perizinan" href='grafik_tahfizh.php'>
                <!-- <i class="fas fa-chart-bar" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_grafiktahfizh.png" alt="Grafik Tahfizh Santri" style="width: 140px; height: 140px;">
            </a>
            <br>
            <a class="menu-link perizinan" href='grafik_kedisiplinan.php'>
                <!-- <i class="fas fa-chart-line" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_grafikdisiplin.png" alt="Grafik Kedisiplinan Santri" style="width: 140px; height: 140px;">
            </a>
            <h2 class="welcome-msg">Pengaturan</h2>
            <a class="menu-link tahfizh" href='ganti_passwordpembina.php'>
                <!-- <i class="fas fa-database" style="width: 140px; height: 140px;"></i> -->
                <img src="icon_pengaturanakun.png" alt="Ganti Password" style="width: 140px; height: 140px;">
            </a>
        <?php elseif($data['level']=='Tamu'): ?>
            <a class="menu-link tahfizh" href='form_jualbeli.php?jenis=Jual'>
                <i class="fas fa-database" style="width: 140px; height: 140px;"></i>
                <img src="icon_tahfizh.png" alt="Data Tahfizh Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link prestasi" href='form_jualbeli.php?jenis=Beli'>
                <i class="fas fa-trophy" style="width: 140px; height: 140px;"></i>
                <img src="icon_prestasi.png" alt="Data Prestasi Santri" style="width: 140px; height: 140px;">
            </a>
            <a class="menu-link disiplin" href='form_cari.php'>
                <i class="fas fa-search" style="width: 140px; height: 140px;"></i>
                <img src="icon_disiplin.png" alt="Data Kedisiplinan Santri" style="width: 140px; height: 140px;">
            </a>
        <?php endif; ?>
        </center>
        <!-- <table>
            <tr>
                <th>Username</th>
                <td><?php echo $data['username']; ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo $data['password']; ?></td>
            </tr>
            <tr>
                <th>Level</th>
                <td><?php echo $data['level']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $data['email']; ?></td>
            </tr>
        </table> -->
        <center><p><a class="menu-link disiplin" href='logout.php'>
                    <!-- <i class="fas fa-sign-out-alt" style="width: 140px; height: 140px;"></i> -->
                    <img src="icon_logout.png" alt="Logout" style="width: 140px; height: 140px;">
                </a></p></center>
    </div>
</body>
</html>
