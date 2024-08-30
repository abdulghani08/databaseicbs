<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Kedisiplinan</title>
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
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
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
            margin: 0 auto;
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
            color: var(--primary-color);
            text-align: center;
            margin-top: 0;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
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

            th, td {
                padding: 8px;
                font-size: 0.9rem;
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
            <h2>GRAFIK KEDISIPLINAN</h2>

            <table>
                <tr>
                    <th>Nama Pelanggaran</th>
                    <th>Jumlah Pelanggar</th>
                </tr>
                <?php
                // Database connection code here
                $koneksi = mysqli_connect("localhost", "sant5315_db_santri", "payakumbuh123", "sant5315_db_santri");

                // Mengecek koneksi
                if (mysqli_connect_errno()) {
                    echo "Koneksi database gagal : " . mysqli_connect_error();
                }

                // Query untuk mengambil data pelanggaran dan jumlah pelanggar
                $query = "SELECT pelanggaran, COUNT(*) AS jumlah_pelanggar FROM disiplin_isi GROUP BY pelanggaran ORDER BY jumlah_pelanggar DESC LIMIT 7";
                $result = mysqli_query($koneksi, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['pelanggaran']."</td>";
                    echo "<td>".$row['jumlah_pelanggar']."</td>";
                    echo "</tr>";
                }

                // Menutup koneksi database
                mysqli_close($koneksi);
                ?>
            </table>

            <div class="chart-container">
                <canvas id="grafikPelanggaran"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Mengambil data dari tabel untuk grafik
        var namaPelanggaran = [];
        var jumlahPelanggar = [];

        <?php
        // Database connection code here
        $koneksi = mysqli_connect("localhost", "sant5315_db_santri", "payakumbuh123", "sant5315_db_santri");

        // Mengecek koneksi
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }

        // Query untuk mengambil data pelanggaran dan jumlah pelanggar
        $query = "SELECT pelanggaran, COUNT(*) AS jumlah_pelanggar FROM disiplin_isi GROUP BY pelanggaran ORDER BY jumlah_pelanggar DESC LIMIT 7";
        $result = mysqli_query($koneksi, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "namaPelanggaran.push('".addslashes($row['pelanggaran'])."');";
            echo "jumlahPelanggar.push(".$row['jumlah_pelanggar'].");";
        }

        // Menutup koneksi database
        mysqli_close($koneksi);
        ?>

        // Membuat grafik menggunakan Chart.js
        var ctx = document.getElementById('grafikPelanggaran').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: namaPelanggaran,
                datasets: [{
                    label: 'Jumlah Pelanggar',
                    data: jumlahPelanggar,
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
                        beginAtZero: true,
                        stepSize: 1
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