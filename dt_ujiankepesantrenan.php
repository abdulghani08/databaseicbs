<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data dari tabel tahfizh_data
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'jenis';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

$query = "SELECT * FROM daftar_ujiankepesantrenan ORDER BY $sortColumn $sortOrder";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Ujian Kepesantrenan</title>
    <link rel="shortcut icon" href="logo.png">
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

        .action-links a.home img {
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
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
<script>
        // Fungsi JavaScript untuk menampilkan/menyembunyikan gambar
        function toggleImage(rowId) {
            var img = document.getElementById('img_' + rowId);
            if (img.style.display === 'none') {
                img.style.display = 'block';
            } else {
                img.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container">
    <div class="navigation">
            <a href="dt_kepesantrenan.php"><img src="../back_icon.png" alt="back"></a>
        </div>
        <h1>Daftar Ujian Kepesantrenan</h1>
        <table>
            <thead>
                <tr>
                    <th><a href="?sort=jenis&order=<?php echo ($sortColumn == 'jenis' && $sortOrder == 'asc') ? 'desc' : 'asc'; ?>">Nama Ujian</a></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td onclick="toggleImage('<?php echo $row['id']; ?>')" style="cursor: pointer;">
                            <?php echo $row['jenis']; ?>
                        </td>
                    </tr>
                    <tr style="display: none;" id="img_<?php echo $row['id']; ?>">
                        <td>
                            <?php
                            $gambarPath = 'gambar_ujian/' . $row['id'] . '.jpg'; // Path gambar
                            if (file_exists($gambarPath)) {
                                echo '<img src="' . $gambarPath . '" alt="Gambar Ujian" />';
                            } else {
                                echo 'Gambar tidak ditemukan';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>