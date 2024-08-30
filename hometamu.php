<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!isset($_SESSION['username']) || $_SESSION['level'] !== 'Tamu') {
    header("Location: login.php");
    exit();
}

$nis = $_SESSION['username'];

$query = "SELECT * FROM portopolio_isi WHERE nis = '$nis'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $dataSantri = mysqli_fetch_assoc($result);
} else {
    $dataSantri = array(
        'nama' => 'Nama Santri',
        'tempat_lahir' => 'Tempat Lahir',
        'tanggal_lahir' => 'Tanggal Lahir',
        'nis' => $nis,
        'alamat' => 'Alamat Santri',
        'asrama' => 'Asrama',
        'kelas' => 'Kelas Santri',
    );
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Tamu</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-bottom: 50px;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('backgroundhome.jpg') no-repeat center center/cover;
            opacity: 0.1;
            z-index: -1;
        }
        .container {
            flex: 1;
            padding: 20px;
            padding-bottom: 80px;
        }
        .navbar-brand img {
            width: 30px;
            margin-right: 10px;
            transition: transform 0.3s ease;
        }
        .navbar-brand:hover img {
            transform: scale(1.1);
        }
        .navbar.fixed-top {
            background-color: #007bff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: 60px; /* Tetapkan tinggi navbar */
        }
        .navbar.fixed-bottom {
            background-color: #007bff;
            box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
        }
        .navbar.fixed-bottom.hidden {
            transform: translateY(100%);
        }
        .navbar-light .navbar-brand, .navbar-light .nav-link {
            color: #fff;
        }
        .navbar-light .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }
        .navbar-light .nav-link:hover {
            color: #f8f9fa;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            transform: translateY(-3px);
        }
        .nav-icon-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.3rem 0.5rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-icon-link i {
            font-size: 1.2rem;
            margin-bottom: 0.2rem;
            transition: transform 0.3s ease;
        }
        .nav-icon-link:hover i {
            transform: translateY(-3px);
        }
        .nav-icon-link span {
            font-size: 0.5rem;
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        .nav-icon-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }
        .nav-icon-link:hover span {
            opacity: 0.8;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 40px 20px;
            text-align: center;
            border-radius: 0 0 20px 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            animation: slideDown 0.5s ease;
            margin-top: 60px; /* Tambahkan margin-top sesuai tinggi navbar */
        }
        @keyframes slideDown {
            from { transform: translateY(-50%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
            padding: 15px 20px;
        }
        .card-body {
            padding: 20px;
        }
        .table {
            margin-bottom: 0;
        }
        .table th, .table td {
            padding: 12px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            transition: background-color 0.3s ease;
        }
        .table tr:hover {
            background-color: #f8f9fa;
        }
        @media (max-width: 767px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            .header {
                padding: 30px 15px;
                margin-top: 60px; /* Pastikan margin-top tetap ada di perangkat mobile */
            }
            .card-body {
                padding: 15px;
            }
            .table th, .table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo"> Database Santri
        </a>
    </nav>

    <div class="header">
        <h2>Selamat datang, <?php echo $dataSantri['nama']; ?></h2>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Data Santri
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Nama Santri</th>
                        <td><?php echo $dataSantri['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>NIS</th>
                        <td><?php echo $dataSantri['nis']; ?></td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td><?php echo $dataSantri['tempat_lahir']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?php echo $dataSantri['tanggal_lahir']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?php echo $dataSantri['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Asrama</th>
                        <td><?php echo $dataSantri['asrama']; ?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td><?php echo $dataSantri['kelas']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-light">
        <div class="container-fluid d-flex justify-content-around">
            <a class="nav-icon-link" href="tamu_laporan_bw.php">
                <i class="fas fa-file-alt"></i>
                <span>Laporan BW</span>
            </a>
            <a class="nav-icon-link" href="update_portopoliotamu.php?nis=<?php echo $nis; ?>">
                <i class="fas fa-briefcase"></i>
                <span>Portofolio</span>
            </a>
            <a class="nav-icon-link" href="ganti_password.php">
                <i class="fas fa-key"></i>
                <span>Ganti Sandi</span>
            </a>
            <a class="nav-icon-link" href="edit_datasantri_portopoliotamu.php?nis=<?php echo $nis; ?>&nama=<?php echo $dataSantri['nama']; ?>">
                <i class="fas fa-user-edit"></i>
                <span>Edit Biodata</span>
            </a>
            <a class="nav-icon-link" href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>