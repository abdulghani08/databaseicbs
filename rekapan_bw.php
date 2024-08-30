<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapan BW - Asrama</title>
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
            background: linear-gradient(135deg, var(--bg-color), var(--secondary-color));
            color: var(--text-color);
            min-height: 100vh;
            padding: 20px;
            padding-bottom: 90px;
        }
        body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('backgroundgedung.jpg') no-repeat center center/cover;
    opacity: 0.2;
    z-index: -1;
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
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        h1 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .asrama-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .asrama-item {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            text-decoration: none;
        }
        
        .asrama-item:hover {
            transform: translateY(-5px);
        }
        
        .asrama-item i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .asrama-item p {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-color);
        }
        .home-button {
    position: fixed;
    top: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.8);
    color: var(--primary-color);
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
    z-index: 1000;
}

.home-button:hover {
    background-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0,0,0,0.15);
}

.home-button i {
    font-size: 1.2rem;
    margin-right: 8px;
}

.home-button span {
    font-weight: 600;
    font-size: 0.9rem;
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
    .home-button {
        padding: 8px 12px;
    }

    .home-button i {
        font-size: 1rem;
    }

    .home-button span {
        font-size: 0.8rem;
    }
}
        
        @media (max-width: 768px) {
            .asrama-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .asrama-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <!-- <a href="home.php" class="home-button">
    <i class="fas fa-home"></i>
    <span>Home</span> -->
</a>
    <header class="header">
            <img src="img/rilisan.png" alt="logo">
            <h1>REKAPAN LAPORAN BW SANTRI</h1>
        </header>
        
        <div class="asrama-grid">
            <a href="laporan_bw_sevilla.php" class="asrama-item">
                <i class="fas fa-archway"></i>
                <p>Sevilla</p>
            </a>
            <a href="laporan_bw_madinah_1_2.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 1 & 2</p>
            </a>
            <a href="laporan_bw_madinah_3_4.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 3 & 4</p>
            </a>
            <a href="laporan_bw_madinah_5_6.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 5 & 6</p>
            </a>
            <a href="laporan_bw_madinah_7_8.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 7 & 8</p>
            </a>
            <a href="laporan_bw_madinah_9.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 9</p>
            </a>
            <a href="laporan_bw_madinah_10.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 10</p>
            </a>
            <a href="laporan_bw_madinah_11.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 11</p>
            </a>
            <a href="laporan_bw_madinah_12.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 12</p>
            </a>
            <a href="laporan_bw_madinah_13_14.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 13 & 14</p>
            </a>
            <a href="laporan_bw_madinah_15_16.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 15 & 16</p>
            </a>
            <a href="laporan_bw_madinah_17_18.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 17 & 18</p>
            </a>
            <a href="laporan_bw_madinah_19_20.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 19 & 20</p>
            </a>
            <a href="laporan_bw_madinah_21_22.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 21 & 22</p>
            </a>
            <a href="laporan_bw_madinah_23_24.php" class="asrama-item">
                <i class="fas fa-mosque"></i>
                <p>Madinah 23 & 24</p>
            </a>
            <a href="laporan_bw_istanbul.php" class="asrama-item">
                <i class="fas fa-landmark"></i>
                <p>Istanbul</p>
            </a>
            <a href="laporan_bw_kairo_1_2.php" class="asrama-item">
                <i class="fas fa-monument"></i>
                <p>Kairo 1 & 2</p>
            </a>
            <a href="laporan_bw_kairo_3_4_5.php" class="asrama-item">
                <i class="fas fa-monument"></i>
                <p>Kairo 3, 4, & 5</p>
            </a>
            <a href="laporan_bw_granada_1_2.php" class="asrama-item">
                <i class="fas fa-gopuram"></i>
                <p>Granada 1 & 2</p>
            </a>
            <a href="laporan_bw_granada_3.php" class="asrama-item">
                <i class="fas fa-gopuram"></i>
                <p>Granada 3</p>
            </a>
            <a href="laporan_bw_granada_4_5.php" class="asrama-item">
                <i class="fas fa-gopuram"></i>
                <p>Granada 4 & 5</p>
            </a>
            <a href="laporan_bw_riyadh_2_3.php" class="asrama-item">
                <i class="fas fa-kaaba"></i>
                <p>Riyadh 2 & 3</p>
            </a>
            <a href="laporan_bw_riyadh_4_5.php" class="asrama-item">
                <i class="fas fa-kaaba"></i>
                <p>Riyadh 4 & 5</p>
            </a>
            <a href="laporan_bw_iskandariyah_1_2.php" class="asrama-item">
                <i class="fas fa-university"></i>
                <p>Iskandariyah 1 & 2</p>
            </a>
            <a href="laporan_bw_iskandariyah_3.php" class="asrama-item">
                <i class="fas fa-university"></i>
                <p>Iskandariyah 3</p>
            </a>
            <a href="laporan_bw_iskandariyah_4_5.php" class="asrama-item">
                <i class="fas fa-university"></i>
                <p>Iskandariyah 4 & 5</p>
            </a>
            <a href="laporan_bw_maroko.php" class="asrama-item">
                <i class="fas fa-map-marked-alt"></i>
                <p>Maroko</p>
            </a>
            <a href="laporan_bw_multazam_1_2.php" class="asrama-item">
                <i class="fas fa-door-open"></i>
                <p>Multazam 1 & 2</p>
            </a>
            <a href="laporan_bw_multazam_3_4.php" class="asrama-item">
                <i class="fas fa-door-open"></i>
                <p>Multazam 3 & 4</p>
            </a>
            <a href="laporan_bw_multazam_5_6.php" class="asrama-item">
                <i class="fas fa-door-open"></i>
                <p>Multazam 5 & 6</p>
            </a>
            <a href="laporan_bw_multazam_7_8.php" class="asrama-item">
                <i class="fas fa-door-open"></i>
                <p>Multazam 7 & 8</p>
            </a>
        </div>
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
    <!-- <a href="logout.php" class="nav-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
    </a> -->
</nav>
</body>
</html>