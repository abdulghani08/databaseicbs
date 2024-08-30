<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data dari tabel tahfizh_data berdasarkan NIS dan Nama yang dikirim melalui parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];
$query = "SELECT * FROM portopolio_isi WHERE nis='$nis' AND nama='$nama'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Prestasi</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF8C00;
            --secondary-color: #FFA500;
            --background-color: #FFF5E6;
            --text-color: #333;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
        }

        .container {
    width: 95%;
    max-width: 1000px;
    margin: 20px auto;
    background-color: #fff;
    background-image: url('backgroundgedung.jpg');
    background-size: cover;
    background-position: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.details, .prestasi-table-container {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
}

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 24px;
        }

        h3 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 24px;
        }

        .add-button {
            margin-bottom: 20px;
            text-align: center;
        }

        .add-button a {
            display: inline-block;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .add-button a:hover {
            background-color: var(--secondary-color);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-link img {
            width: 30px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .back-link img:hover {
            transform: scale(1.1);
        }

        .details {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow-x: auto;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .details th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 500;
        }

        .prestasi-table-container {
            overflow-x: auto;
        }

        .prestasi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .prestasi-table th,
        .prestasi-table td {
            padding: 10px;
            border: 1px solid #eee;
            text-align: left;
        }

        .prestasi-table th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 500;
        }

        .prestasi-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .prestasi-table tbody tr:hover {
            background-color: #fff5e6;
        }

        .action-links a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            margin-right: 5px;
            font-weight: 500;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .action-links a.delete {
            background-color: #ff4136;
        }

        .action-links a.delete:hover {
            background-color: #ff1a1a;
        }

        .action-links a img {
            width: 20px;
            height: auto;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
                margin: 10px auto;
            }

            h2 {
                font-size: 18px;
            }

            h3 {
                font-size: 16px;
            }

            .add-button a {
                padding: 8px 16px;
                font-size: 8px;
            }

            .details th,
            .details td,
            .prestasi-table th,
            .prestasi-table td {
                padding: 5px;
                font-size: 8px;
            }

            .action-links a {
                padding: 4px 8px;
                font-size: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="dt_prestasi.php" class="back-link"><img src="back_icon.png" alt="back"></a>
        
        <div class="details">
        <h2>REKAPAN PRESTASI</h2>
        <div class="add-button">
            <a href="form_tambahdata_prestasi.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>">
                <i class="fas fa-plus-circle"></i> Tambah Prestasi
            </a>
        </div>
            <table>
                <tr>
                    <th>Nama</th>
                    <td><?php echo $data['nama']; ?></td>
                </tr>
                <tr>
                    <th>NIS</th>
                    <td><?php echo $data['nis']; ?></td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td><?php echo $data['kelas']; ?></td>
                </tr>
                <tr>
                    <th>Asrama</th>
                    <td><?php echo $data['asrama']; ?></td>
                </tr>
                <tr>
                    <th>Pembina</th>
                    <td><?php echo $data['pembina']; ?></td>
                </tr>
            </table>
        </div>
        <div class="prestasi-table-container">
        <h3>Data Tersimpan</h3>
            <table class="prestasi-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Prestasi</th>
                        <th>Penyelenggara</th>
                        <th>Tahun</th>
                        <th>Tingkat</th>
                        <th>Juara</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $setoran_query = "SELECT * FROM prestasi_isi WHERE nis='$nis'";
                    $setoran_result = mysqli_query($koneksi, $setoran_query);
                    $no = 1;
                    while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $setoran_data['nama_prestasi']; ?></td>
                            <td><?php echo $setoran_data['penyelenggara']; ?></td>
                            <td><?php echo $setoran_data['waktu']; ?></td>
                            <td><?php echo $setoran_data['tingkat']; ?></td>
                            <td><?php echo $setoran_data['juara']; ?></td>
                            <td class="action-links">
                                <a class="delete" href="aksi_hapus_prestasi.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>