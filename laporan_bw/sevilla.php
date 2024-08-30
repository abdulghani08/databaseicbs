<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

// Query untuk mengambil data Sevilla
$query = "SELECT * FROM tamu_laporan_bw WHERE asrama = 'Sevilla' ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan BW - Asrama Sevilla</title>
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
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: var(--secondary-color);
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        @media screen and (max-width: 1200px) {
            body {
                font-size: 14px;
            }

            .container {
                width: 100%;
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                width: 1200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="rekapan_bw.php" class="back-button"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h1>Laporan BW - Asrama Sevilla</h1>
        
        <div class="table-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Pelanggaran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                <td><?php echo htmlspecialchars($row['pelanggaran']); ?></td>
                                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">Tidak ada data untuk ditampilkan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>