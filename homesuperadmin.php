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
$sql="SELECT * from register where username='$user'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santri Putri Harau</title>
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
    min-height: 100vh;
    padding-bottom: 60px;
    position: relative;
    background: linear-gradient(135deg, var(--bg-color), var(--secondary-color));
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('backgroundhome.jpg') no-repeat center center/cover;
    opacity: 0.2;
    z-index: -1;
}
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            padding: 20px 0;
        }
        
        .header img {
            max-width: 150px;
        }
        
        .header h1 {
            margin-top: 10px;
            font-size: 1.5rem;
            color: #ffffff; /* Mengubah warna teks menjadi putih */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 1);
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .menu-item {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .menu-item:hover {
            transform: translateY(-5px);
        }
        
        .menu-item img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }
        
        .menu-item p {
            text-decoration: none;
            font-size: 0.6rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        .menu-item i {
    font-size: 2rem;
    margin-bottom: 10px;
    color: var(--primary-color);
    text-decoration: none;
}
a {
    text-decoration: none;
}
        
        .bottom-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: var(--primary-color);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
        
        .nav-item {
            color: white;
            text-decoration: none;
            font-size: 0.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .nav-item i {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <img src="img/rilisan.png" alt="logo">
            <h1>DATABASE SANTRI ICBS PUTRI HARAU</h1>
        </header>
        
        <main class="menu-grid">
    <a href="dt_kepesantrenan.php" class="menu-item">
        <i class="fas fa-mosque"></i>
        <p>Kepesantrenan</p>
    </a>
    <a href="dt_tahfizh.php" class="menu-item">
        <i class="fas fa-quran"></i>
        <p>Tahfizh</p>
    </a>
    <a href="dt_prestasi.php" class="menu-item">
        <i class="fas fa-trophy"></i>
        <p>Prestasi</p>
    </a>
    <a href="dt_disiplin.php" class="menu-item">
        <i class="fas fa-user-clock"></i>
        <p>Disiplin</p>
    </a>
    <a href="dt_perizinan.php" class="menu-item">
        <i class="fas fa-clipboard-check"></i>
        <p>Perizinan</p>
    </a>
    <a href="dt_minatbakat.php" class="menu-item">
        <i class="fas fa-star"></i>
        <p>Minat Bakat</p>
    </a>
    <a href="dt_portopolio_superadmin.php" class="menu-item">
        <i class="fas fa-folder-open"></i>
        <p>Portopolio</p>
    </a>
    <a href="dt_kesehatan.php" class="menu-item">
        <i class="fas fa-heartbeat"></i>
        <p>Kesehatan</p>
    </a>
    <a href="pembina_jurnal.php" class="menu-item">
        <i class="fas fa-book"></i>
        <p>Jurnal Pembina</p>
    </a>
    <a href="akun.php" class="menu-item">
        <i class="fas fa-user-circle"></i>
        <p>Akun</p>
    </a>
</main>
    </div>
    
    <nav class="bottom-navbar">
    <a href="home.php" class="nav-item">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="https://docs.google.com/spreadsheets/d/1tk2WSZRG7kOvDaAO9vaQ7MV3ywBgAb2LZjYS1RjLD6c/edit?gid=1630597597#gid=1630597597" target="_blank" class="nav-item">
        <i class="fas fa-file-alt"></i>
        <span>Rekapan Santri</span>
    </a>
    <a href="rekapan_bw.php" class="nav-item">
        <i class="fas fa-clipboard-list"></i>
        <span>Rekapan BW</span>
    </a>
    <a href="grafik_tahfizh.php" class="nav-item">
        <i class="fas fa-quran"></i>
        <span>Grafik Tahfizh</span>
    </a>
    <a href="grafik_kedisiplinan.php" class="nav-item">
        <i class="fas fa-user-clock"></i>
        <span>Grafik Disiplin</span>
    </a>
    <a href="logout.php" class="nav-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
    </a>
</nav>
</body>
</html>