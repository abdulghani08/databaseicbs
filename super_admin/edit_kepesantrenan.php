<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek apakah ada data yang dikirim melalui parameter URL
if (isset($_GET['id'])) {
    $id_kepesantrenan = $_GET['id'];

    // Query untuk mendapatkan data kepesantrenan berdasarkan ID
    $query = "SELECT * FROM kepesantrenan_isi WHERE id='$id_kepesantrenan'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Proses update data kepesantrenan ke database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $_POST['tanggal'];
            $jenis = $_POST['jenis'];
            $nilai = $_POST['nilai'];
            $penguji = $_POST['penguji'];
            $keterangan = $_POST['keterangan'];

            // Query untuk mengupdate data kepesantrenan
            $query_update = "UPDATE kepesantrenan_isi SET tanggal='$tanggal', jenis='$jenis', nilai='$nilai', penguji='$penguji', keterangan='$keterangan' WHERE id='$id_kepesantrenan'";
            $result_update = mysqli_query($koneksi, $query_update);

            if ($result_update) {
                // Redirect kembali ke halaman update_kepesantrenan.php setelah data berhasil diupdate
                header("Location: dt_kepesantrenan.php?nis=" . $_SESSION['nis'] . "&nama=" . $_SESSION['nama']);
                exit();
            } else {
                echo "Terjadi kesalahan saat mengupdate data kepesantrenan.";
            }
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID kepesantrenan tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Kepesantrenan</title>
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
        <h2>Edit Kepesantrenan</h2>
        <form method="POST">
            <label for="tanggal">Tanggal Ujian:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>

            <label for="jenis">Jenis Ujian:</label>
            <input type="text" id="jenis" name="jenis" value="<?php echo $data['jenis']; ?>" required readonly>

            <label for="nilai">Nilai:</label>
            <select id="nilai" name="nilai" required>
                <option value="">Pilih Nilai</option>
                <option value="A" <?php if ($data['nilai'] == 'A') echo 'selected'; ?>>A</option>
                <option value="B" <?php if ($data['nilai'] == 'B') echo 'selected'; ?>>B</option>
                <option value="C" <?php if ($data['nilai'] == 'C') echo 'selected'; ?>>C</option>
                <option value="D" <?php if ($data['nilai'] == 'D') echo 'selected'; ?>>D</option>
            </select>

            <label for="penguji">Penguji:</label>
            <input type="text" id="penguji" name="penguji" value="<?php echo $data['penguji']; ?>" required>

            <label for="keterangan">Keterangan:</label>
            <select id="keterangan" name="keterangan" required>
                <option value="">Pilih Keterangan</option>
                <option value="Tuntas">Tuntas</option>
                <option value="Belum Tuntas">Belum Tuntas</option>
            </select>

            <input type="submit" value="Update Kepesantrenan">
        </form>
        <div class="add-button">
            <a href="dt_kepesantrenan.php?nis=<?php echo $_SESSION['nis']; ?>&nama=<?php echo $_SESSION['nama']; ?>">Kembali</a>
        </div>
    </div>
</body>

</html>
