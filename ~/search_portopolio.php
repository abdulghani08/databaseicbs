<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data pencarian dari form
$search = $_GET['search'];

// Query pencarian data berdasarkan NIS atau Nama
$query = "SELECT * FROM portopolio_isi WHERE nis LIKE '%$search%' OR nama LIKE '%$search%' OR asrama LIKE '%$search%' OR kelas LIKE '%$search%'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian</title>
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

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color:#000066;
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

        .navigation {
            text-align: left;
            margin-bottom: 10px;
        }

        .navigation a {
            text-decoration: none;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            margin-right: 5px;
            font-weight: bold;
        }

        .navigation a.home {
            background-color: #4CAF50;
        }

        .navigation a.logout {
            background-color: #F44336;
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

        .action-links a.update img {
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }

        .action-links a.edit img{
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }

        .action-links a.delete img{
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }

        .add-santri-button {
            text-align: center;
            margin-top: 20px;
        }

        .add-santri-button a {
            display: inline-block;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <a class="home" href="home.php">Home</a>
            <a class="logout" href="logout.php">Logout</a>
        </div>
        <h1>Hasil Pencarian</h1>
        <!-- <div class="add-santri-button">
            <a href="form_tambahdata_santri_portopolio.php">Tambah Data Santri</a>
        </div> -->
        <div class="search-bar">
            <form method="GET" action="search_portopolio.php">
                <input type="text" name="search" placeholder="Cari NIS, Nama, kelas atau Asrama">
                <input type="submit" value="Cari">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th><a href="?sort=nis&order=<?php echo ($sortColumn == 'nis' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">NIS</a></th>
                    <th><a href="?sort=nama&order=<?php echo ($sortColumn == 'nama' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Nama</a></th>
                    <th><a href="?sort=kelas&order=<?php echo ($sortColumn == 'kelas' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Kelas</a></th>
                    <th><a href="?sort=asrama&order=<?php echo ($sortColumn == 'asrama' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Asrama</a></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['nis']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td><?php echo $row['asrama']; ?></td>
                         <td class="action-links">
                            <a class="update" href="update_portopolio.php?nis=<?php echo $row['nis']; ?>&nama=<?php echo $row['nama']; ?>"><img src="update_icon.png" alt="Update"></a>
                            <a class="edit" href="edit_datasantri_portopolio.php?nis=<?php echo $row['nis']; ?>&nama=<?php echo $row['nama']; ?>"><img src="edit_icon.png" alt="Edit"></a>
                            <!-- <a class="delete" href="hapus_datasantri_portopolio.php?nis=<?php echo $row['nis']; ?>&nama=<?php echo $row['nama']; ?>"><img src="delete_icon.png" alt="Delete"></a> -->
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="add-button">
            <a href="dt_portopolio.php">Kembali</a>
        </div>
    </div>
</body>
</html>
