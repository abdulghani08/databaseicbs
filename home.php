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
            background-color: #4CAF50;
        }

        .menu-link.prestasi {
            background-color: #2196F3;
        }

        .menu-link.disiplin {
            background-color: #F44336;
        }

        .menu-link.perizinan {
            background-color: #FFC107;
        }

        .menu-link.database {
            background-color: #8B0000;
            font-size: 18px;
            padding: 20px 40px;
            margin-bottom: 20px;
        }

        .menu-link i {
            margin-right: 5px;
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
                <i class="fas fa-database"></i>
                Kepesantrenan Santri
            </a>
            <a class="menu-link tahfizh" href='dt_tahfizh.php'>
                <i class="fas fa-database"></i>
                Tahfizh Santri
            </a>
            <a class="menu-link tahfizh" href='dt_prestasi.php'>
                <i class="fas fa-trophy"></i>
                Prestasi Santri
            </a>
            <a class="menu-link tahfizh" href='dt_disiplin.php'>
                <i class="fas fa-check-circle"></i>
                Kedisiplinan Santri
            </a>
            <a class="menu-link tahfizh" href='dt_perizinan.php'>
                <i class="fas fa-file-alt"></i>
                Perizinan Santri
            </a>
            <br><a class="menu-link database" href='dt_portopolio.php'>
                <i class="fas fa-database"></i>
                Portopolio Santri
            </a>
            <h2 class="welcome-msg">Grafik Santri</h2>
            <a class="menu-link perizinan" href='grafik_tahfizh.php'>
                <i class="fas fa-chart-bar"></i>
                Grafik Tahfizh Santri
            </a>
            <br>
            <a class="menu-link perizinan" href='grafik_kedisiplinan.php'>
                <i class="fas fa-chart-line"></i>
                Grafik Kedisiplinan Santri
            </a>
            <h2 class="welcome-msg">Akun Aplikasi</h2>
            <a class="menu-link tahfizh" href='akun.php'>
                <i class="fas fa-database"></i>
                Pengaturan Akun Aplikasi
            </a>
        <?php elseif($data['level']=='Pembina'): ?>
            <a class="menu-link tahfizh" href='dt_kepesantrenan.php'>
                <i class="fas fa-database"></i>
                Kepesantrenan Santri
            </a>
            <a class="menu-link tahfizh" href='dt_tahfizh.php'>
                <i class="fas fa-database"></i>
                Tahfizh Santri
            </a>
            <a class="menu-link tahfizh" href='dt_prestasi.php'>
                <i class="fas fa-trophy"></i>
                Prestasi Santri
            </a>
            <a class="menu-link tahfizh" href='dt_disiplin.php'>
                <i class="fas fa-check-circle"></i>
                Kedisiplinan Santri
            </a>
            <a class="menu-link tahfizh" href='dt_perizinan.php'>
                <i class="fas fa-file-alt"></i>
                Perizinan Santri
            </a>
            <a class="menu-link database" href='dt_portopoliopembina.php'>
                <i class="fas fa-database"></i>
                Portopolio Santri
            </a>
            <h2 class="welcome-msg">Grafik Santri</h2>
            <a class="menu-link perizinan" href='grafik_tahfizh.php'>
                <i class="fas fa-chart-bar"></i>
                Grafik Tahfizh Santri
            </a>
            <br>
            <a class="menu-link perizinan" href='grafik_kedisiplinan.php'>
                <i class="fas fa-chart-line"></i>
                Grafik Kedisiplinan Santri
            </a>
            <h2 class="welcome-msg">Pengaturan</h2>
            <a class="menu-link tahfizh" href='ganti_passwordpembina.php'>
                <i class="fas fa-database"></i>
                Ganti Password
            </a>
        <?php elseif($data['level']=='Tamu'): ?>
            <a class="menu-link tahfizh" href='form_jualbeli.php?jenis=Jual'>
                <i class="fas fa-database"></i>
                Data Tahfizh Santri
            </a>
            <a class="menu-link prestasi" href='form_jualbeli.php?jenis=Beli'>
                <i class="fas fa-trophy"></i>
                Data Prestasi Santri
            </a>
            <a class="menu-link disiplin" href='form_cari.php'>
                <i class="fas fa-search"></i>
                Data Kedisiplinan Santri
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
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a></p></center>
    </div>
</body>
</html>
