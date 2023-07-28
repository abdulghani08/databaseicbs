<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek apakah ada data yang dikirim melalui parameter URL
if (isset($_GET['id'])) {
    $id_minatbakat = $_GET['id'];

    // Query untuk mendapatkan data minat dan bakat berdasarkan ID
    $query = "SELECT * FROM putra_minat_bakat_isi WHERE id='$id_minatbakat'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Proses update data minat dan bakat ke database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_peminatan = $_POST['nama_peminatan'];
            $jenis_peminatan = $_POST['jenis_peminatan'];

            // Query untuk mengupdate data minat dan bakat
            $query_update = "UPDATE putra_minat_bakat_isi SET bakat='$nama_peminatan', jenis='$jenis_peminatan' WHERE id='$id_minatbakat'";
            $result_update = mysqli_query($koneksi, $query_update);

            if ($result_update) {
                // Redirect kembali ke halaman update_minatbakat.php setelah data berhasil diupdate
                header("Location: dt_minatbakat.php?nis=" . $_SESSION['nis'] . "&nama=" . $_SESSION['nama']);
                exit();
            } else {
                echo "Terjadi kesalahan saat mengupdate data minat dan bakat.";
            }
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID minat dan bakat tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Minat dan Bakat</title>
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

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label,
        input {
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Minat dan Bakat</h2>
        <form method="POST">
            <label for="nama_peminatan">Nama Peminatan:</label>
            <input type="text" id="nama_peminatan" name="nama_peminatan" value="<?php echo $data['bakat']; ?>" required>

            <label for="jenis_peminatan">Jenis Peminatan:</label>
            <input type="text" id="jenis_peminatan" name="jenis_peminatan" value="<?php echo $data['jenis']; ?>" required>

            <input type="submit" value="Update Minat dan Bakat">
        </form>
        <div class="add-button">
            <a href="dt_minatbakat.php?nis=<?php echo $_SESSION['nis']; ?>&nama=<?php echo $_SESSION['nama']; ?>">Kembali</a>
        </div>
    </div>
</body>

</html>
