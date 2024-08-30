<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa apakah ada permintaan pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan data dari form
    $nama_peminatan = mysqli_real_escape_string($koneksi, $_POST['nama_peminatan']);
    $jenis_peminatan = mysqli_real_escape_string($koneksi, $_POST['jenis_peminatan']);

    // Masukkan data ke tabel minat_bakat
    $query = "INSERT INTO minat_bakat (bakat, jenis) VALUES ('$nama_peminatan', '$jenis_peminatan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data peminatan telah berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan saat menambahkan data peminatan: " . mysqli_error($koneksi);
    }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Peminatan</title>
    <link rel="shortcut icon" href="../logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
    --primary-color: #2E8B57;    /* Sea Green */
    --secondary-color: #3CB371;  /* Medium Sea Green */
    --text-color: #333;
    --background-color: #E8F5E9;         /* Light Green background */
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 100%;
            width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--secondary-color);
        }

        input {
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            background-color: #f0f0f0;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--primary-color);
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        .add-button {
            text-align: center;
            margin-top: 20px;
        }

        .add-button a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .add-button a:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <center>
        <h2>Tambah Data Peminatan</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama Peminatan:</label>
                <input type="text" name="nama_peminatan" required>
            </div>
            <div class="form-group">
                <label>Jenis Peminatan:</label>
                <input type="text" name="jenis_peminatan" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Tambah">
            </div>
            <div class="add-button">
            <a href="daftar_minatbakat.php">Kembali</a>
    </center>
        </div>
        </form>
    </div>
</body>
</html>
