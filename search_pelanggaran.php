<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data pencarian dari form
$search = $_GET['search'];

// Query pencarian data berdasarkan NIS atau Nama
$query = "SELECT * FROM daftar_pelanggaran WHERE nama LIKE '%$search%' OR jenis LIKE '%$search%' OR klasifikasi LIKE '%$search%' OR poin LIKE '%$search%'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggaran</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
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
            padding: 20px;
            color: var(--text-color);
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
        }
        
        .navigation {
            text-align: left;
            margin-bottom: 20px;
        }
        
        .navigation a {
            text-decoration: none;
            color: #fff;
            background-color: var(--primary-color);
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .navigation a:hover {
            background-color: var(--secondary-color);
        }
        
        .add-santri-button {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .add-santri-button a {
            display: inline-block;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .add-santri-button a:hover {
            background-color: var(--secondary-color);
        }
        
        .search-bar {
            margin-bottom: 20px;
        }
        
        .search-bar input[type="text"] {
            width: calc(100% - 100px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .search-bar input[type="submit"] {
            width: 70px;
            padding: 10px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .search-bar input[type="submit"]:hover {
            background-color: var(--secondary-color);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        
        th a {
    text-decoration: none;
    color: inherit;
}

th a:hover {
    text-decoration: underline;
}

        tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        .action-links a {
            display: inline-block;
            margin: 0 5px;
        }
        
        .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
        
.pagination a {
    color: #fff;
    background-color: var(--primary-color);
    padding: 10px 20px;
    text-decoration: none;
    transition: background-color 0.3s;
    border-radius: 5px;
    margin: 0 10px;
    font-weight: bold;
}
        
        .pagination a.active {
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }
        .pagination a:hover {
    background-color: var(--secondary-color);
}
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            table {
                font-size: 8px;
            }
            
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="navigation">
            <a class="home" href="home.php">Home</a>
            <a class="logout" href="logout.php">Logout</a>
        </div>
        <h1>Hasil Pencarian Daftar Pelanggaran</h1>
        <div class="search-bar">
            <form method="GET" action="search_pelanggaran.php">
                <input type="text" name="search" placeholder="Cari Nama, Jenis, Klasifikasi atau Poin">
                <input type="submit" value="Cari">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                <th><a href="?sort=nama&order=<?php echo ($sortColumn == 'nama' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Nama Pelanggaran</a></th>
                    <th><a href="?sort=jenis&order=<?php echo ($sortColumn == 'jenis' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Jenis Pelanggaran</a></th>
                    <th><a href="?sort=klasifikasi&order=<?php echo ($sortColumn == 'klasifikasi' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Klasifikasi</a></th>
                    <th><a href="?sort=poin&order=<?php echo ($sortColumn == 'poin' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Poin</a></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jenis']; ?></td>
                        <td><?php echo $row['kelasifikasi']; ?></td>
                        <td><?php echo $row['poin']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="add-button">
            <a href="dt_pelanggaran.php">Kembali</a>
        </div>
    </div>
</body>
</html>
