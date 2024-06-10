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
<html>

<head>
    <title>Grafik Tahfizh</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backgroundgedung.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        canvas {
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
        <div class="navigation">
            <a href="home.php"><img src="home_icon.png" alt="home"></a>
        </div>
        <h2>Grafik Rata-Rata Kualitas Hafalan Santri</h2>

        <div>
            <canvas id="chartKualitasHafalan"></canvas>
        </div>
        <br><br><br>
        <h2>Grafik Peringkat Santri 10 Teratas dengan Hafalan Terbanyak</h2>
        <div>
            <canvas id="chartPeringkat"></canvas>
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
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
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
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    </div>
</body>

</html>
