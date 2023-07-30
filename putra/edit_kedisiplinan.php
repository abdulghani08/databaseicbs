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
    $id_disiplin = $_GET['id'];

    // Query untuk mendapatkan data kedisiplinan berdasarkan ID
    $query = "SELECT * FROM putra_disiplin_isi WHERE id='$id_disiplin'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Proses update data kedisiplinan ke database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $_POST['tanggal'];
            $pelanggaran = $_POST['pelanggaran'];
            $poin = $_POST['poin'];
            $hukuman = $_POST['hukuman'];
            $keterangan = $_POST['keterangan'];

            // Query untuk mengupdate data kedisiplinan
            $query_update = "UPDATE putra_disiplin_isi SET tanggal='$tanggal', pelanggaran='$pelanggaran', poin='$poin', hukuman='$hukuman', keterangan='$keterangan' WHERE id='$id_disiplin'";
            $result_update = mysqli_query($koneksi, $query_update);

            if ($result_update) {
                // Redirect kembali ke halaman update_disiplin.php setelah data berhasil diupdate
                header("Location: dt_disiplin.php?nis=" . $_SESSION['nis'] . "&nama=" . $_SESSION['nama']);
                exit();
            } else {
                echo "Terjadi kesalahan saat mengupdate data kedisiplinan.";
            }
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID kedisiplinan tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Kedisiplinan</title>
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
        <h2>Edit Kedisiplinan</h2>
        <form method="POST">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>

            <label for="pelanggaran">Nama Pelanggaran:</label>
            <input type="text" id="pelanggaran" name="pelanggaran" value="<?php echo $data['pelanggaran']; ?>" required readonly>

            <label for="poin">Poin Pelanggaran:</label>
            <input type="number" id="poin" name="poin" step="1" min="0" value="<?php echo $data['poin']; ?>" required readonly>

            <label for="hukuman">Bentuk Hukuman:</label>
            <input type="text" id="hukuman" name="hukuman" value="<?php echo $data['hukuman']; ?>" required>

            <label for="keterangan">Keterangan :</label>
            <select id="keterangan" name="keterangan" required>
                <option value="Tuntas">Tuntas</option>
                <option value="Belum Tuntas">Belum Tuntas</option>
            </select>

            <input type="submit" value="Update Kedisiplinan">
        </form>
        <div class="add-button">
            <a href="dt_disiplin.php?nis=<?php echo $_SESSION['nis']; ?>&nama=<?php echo $_SESSION['nama']; ?>">Kembali</a>
        </div>
    </div>
</body>

</html>
