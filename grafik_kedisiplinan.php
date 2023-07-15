<!DOCTYPE html>
<html>
<head>
    <title>Grafik Kedisiplinan</title>
    <link rel="shortcut icon" href="logo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('backgroundgedung.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .chart-container {
            margin-top: 20px;
        }

        .action-links {
            display: flex;
            justify-content: center;
        }

        .action-links a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .action-links a.home img {
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="container">
    <center><div class="navigation">
            <a href="home.php"><img src="home_icon.png" alt="home"></a>
        </div></center>
        <center><h2>Grafik Kedisiplinan</h2></center>

        <!-- Table of Pelanggaran -->
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

        <!-- Chart -->
        <div class="chart-container">
            <canvas id="grafikPelanggaran"></canvas>
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
            echo "namaPelanggaran.push('".$row['pelanggaran']."');";
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
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
</body>
</html>
