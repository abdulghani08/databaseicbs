<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Hapus data jika ada permintaan pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus'])) {
    $nis = $_POST['nis'];

    // Hapus data dari tabel tahfizh_data
    $query = "DELETE FROM perizinan_data WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data telah berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi);
    }
}

// Ambil data dari tabel tahfizh_data
$query = "SELECT * FROM perizinan_data";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Perizinan Santri</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #ccc;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #e0e0e0;
    }

    .add-button {
        text-align: center;
        margin-top: 20px;
    }

    .search-bar input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
</style>
</head>
<body>
    <center>Hapus Data Perizinan Santri?    
                            <form method="POST" action="">
                                <input type="hidden" name="nis" value="<?php echo $row['nis']; ?>">
                                <input type="submit" name="hapus" value="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            </form>
                            <div class="add-button">
            <a href="dt_perizinan.php">Kembali</a>
        </div>
    </center>          
</body>
</html>
