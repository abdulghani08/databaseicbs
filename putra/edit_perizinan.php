<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek apakah ada data yang dikirim melalui parameter URL
if (isset($_GET['id'])) {
    $id_perizinan = $_GET['id'];

    // Query untuk mendapatkan data perizinan berdasarkan ID
    $query = "SELECT * FROM putra_perizinan_isi WHERE id='$id_perizinan'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Proses update data perizinan ke database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dari_tanggal = $_POST['dari_tanggal'];
            $sampai_tanggal = $_POST['sampai_tanggal'];
            $keperluan = $_POST['keperluan'];
            $durasi = $_POST['durasi'];

            // Query untuk mengupdate data perizinan
            $query_update = "UPDATE putra_perizinan_isi SET daritanggal='$dari_tanggal', sampaitanggal='$sampai_tanggal', keperluan='$keperluan', durasi='$durasi' WHERE id='$id_perizinan'";
            $result_update = mysqli_query($koneksi, $query_update);

            if ($result_update) {
                // Redirect kembali ke halaman update_perizinan.php setelah data berhasil diupdate
                header("Location: dt_perizinan.php?nis=" . $_SESSION['nis'] . "&nama=" . $_SESSION['nama']);
                exit();
            } else {
                echo "Terjadi kesalahan saat mengupdate data perizinan.";
            }
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID perizinan tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Perizinan</title>
    <link rel="shortcut icon" href="../logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../backgroundgedung.jpg');
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
        <h2>Edit Perizinan</h2>
        <form method="POST">
            <label for="dari_tanggal">Dari Tanggal:</label>
            <input type="date" id="dari_tanggal" name="dari_tanggal" value="<?php echo $data['daritanggal']; ?>" required>

            <label for="sampai_tanggal">Sampai Tanggal:</label>
            <input type="date" id="sampai_tanggal" name="sampai_tanggal" value="<?php echo $data['sampaitanggal']; ?>" required>

            <label for="keperluan">Keperluan:</label>
            <input type="text" id="keperluan" name="keperluan" value="<?php echo $data['keperluan']; ?>" required>

            <label for="durasi">Durasi (Hari):</label>
            <input type="number" id="durasi" name="durasi" value="<?php echo $data['durasi']; ?>" required>

            <input type="submit" value="Update Perizinan">
        </form>
        <div class="add-button">
            <a href="dt_perizinan.php?nis=<?php echo $_SESSION['nis']; ?>&nama=<?php echo $_SESSION['nama']; ?>">Kembali</a>
        </div>
    </div>
</body>

</html>
