<?php
include "connection.php";

// Mengambil data kualitas hafalan dari tabel tahfizh_setoran
$query_kualitas_hafalan = "SELECT COUNT(*) AS total, nilai FROM tahfizh_hafalan GROUP BY nilai";
$result_kualitas_hafalan = mysqli_query($koneksi, $query_kualitas_hafalan);

// Menyimpan data kualitas hafalan dalam array
$labels_kualitas_hafalan = [];
$data_kualitas_hafalan = [];
while ($row = mysqli_fetch_assoc($result_kualitas_hafalan)) {
    $labels_kualitas_hafalan[] = $row['nilai'];
    $data_kualitas_hafalan[] = $row['total'];
}

// Mengambil data peringkat 10 orang dengan total hafalan terbanyak
$query_peringkat = "SELECT nis, SUM(total_hafalan) AS total_hafalan FROM tahfizh_hafalan GROUP BY nis ORDER BY total_hafalan DESC LIMIT 10";
$result_peringkat = mysqli_query($koneksi, $query_peringkat);

// Menyimpan data peringkat dalam array
$labels_peringkat = [];
$data_peringkat = [];
while ($row = mysqli_fetch_assoc($result_peringkat)) {
    $labels_peringkat[] = $row['nis'];
    $data_peringkat[] = $row['total_hafalan'];
}

// Menutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Tahfizh</title>
    <link rel="shortcut icon" href="logo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF8C00;
            --secondary-color: #FFA500;
            --background-color: #FFF5E6;
            --text-color: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
            padding-bottom: 50px;
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
            max-width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .navigation {
            text-align: center;
            margin-bottom: 20px;
        }

        .navigation a {
            display: inline-block;
            background-color: var(--primary-color);
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .navigation a:hover {
            background-color: var(--secondary-color);
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

        @media (max-width: 767px) {
            .container {
                padding: 10px;
            }

            h2 {
                font-size: 1.2rem;
            }

            .chart-container {
                height: 250px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- <div class="navigation">
            <a href="home.php">Kembali ke Beranda</a>
        </div> -->

        <div class="card">
            <h2>Grafik Rata-Rata Kualitas Hafalan Santri</h2>
            <div class="chart-container">
                <canvas id="chartKualitasHafalan"></canvas>
            </div>
        </div>

        <div class="card">
            <h2>Grafik Peringkat Santri 10 Teratas dengan Hafalan Terbanyak</h2>
            <div class="chart-container">
                <canvas id="chartPeringkat"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Membuat grafik kualitas hafalan
        var ctxKualitasHafalan = document.getElementById('chartKualitasHafalan').getContext('2d');
        var chartKualitasHafalan = new Chart(ctxKualitasHafalan, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels_kualitas_hafalan); ?>,
                datasets: [{
                    label: 'Kualitas Hafalan',
                    data: <?php echo json_encode($data_kualitas_hafalan); ?>,
                    backgroundColor: [
                        'rgba(255, 140, 0, 0.6)',
                        'rgba(255, 165, 0, 0.6)',
                        'rgba(255, 192, 203, 0.6)',
                        'rgba(255, 218, 185, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 140, 0, 1)',
                        'rgba(255, 165, 0, 1)',
                        'rgba(255, 192, 203, 1)',
                        'rgba(255, 218, 185, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Membuat grafik peringkat
        var ctxPeringkat = document.getElementById('chartPeringkat').getContext('2d');
        var chartPeringkat = new Chart(ctxPeringkat, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels_peringkat); ?>,
                datasets: [{
                    label: 'Total Hafalan',
                    data: <?php echo json_encode($data_peringkat); ?>,
                    backgroundColor: 'rgba(255, 140, 0, 0.6)',
                    borderColor: 'rgba(255, 140, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
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