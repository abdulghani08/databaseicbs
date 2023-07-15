<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Hapus data jika ada permintaan pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus'])) {
    $nis = $_POST['nis'];

    // Hapus data dari tabel tahfizh_data
    $query = "DELETE FROM portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data telah berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi);
    }
}

// Ambil data dari tabel tahfizh_data
$query = "SELECT * FROM portopolio_isi";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Santri</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backgroundgedung.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        .data-table td:last-child {
            text-align: center;
        }

        .data-table form {
            display: inline-block;
            margin-right: 5px;
        }

        .data-table form input[type="submit"] {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .data-table form input[type="submit"]:hover {
            background-color: #c82333;
        }

        .add-button {
            text-align: left;
            margin-top: 20px;
        }

        .add-button a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
        }

        .add-button a:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="add-button">
            <a href="dt_portopolio.php">Kembali</a>
        </div>
        <h1>Data Santri</h1>

        <table class="data-table">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Periksa apakah ada data yang diambil
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['nis'] . '</td>';
                        echo '<td>' . $row['nama'] . '</td>';
                        echo '<td>';
                        echo '<form method="POST" action="">';
                        echo '<input type="hidden" name="nis" value="' . $row['nis'] . '">';
                        echo '<input type="submit" name="hapus" value="Hapus" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">Tidak ada data santri.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
