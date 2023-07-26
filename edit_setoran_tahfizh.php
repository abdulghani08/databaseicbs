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
    $id_setoran = $_GET['id'];

    // Query untuk mendapatkan data rekapan hafalan berdasarkan ID
    $query = "SELECT * FROM tahfizh_hafalan WHERE id='$id_setoran'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Proses update data setoran ke database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $_POST['tanggal'];
            $hafalan = $_POST['hafalan'];
            $nilai = $_POST['nilai'];
            $totalHafalan = $_POST['total_hafalan'];

            // Query untuk mengupdate data setoran
            $query_update = "UPDATE tahfizh_hafalan SET tanggal='$tanggal', hafalan='$hafalan', nilai='$nilai', total_hafalan='$totalHafalan' WHERE id='$id_setoran'";
            $result_update = mysqli_query($koneksi, $query_update);

            if ($result_update) {
                // Redirect kembali ke halaman update_tahfizh.php setelah data berhasil diupdate
                header("Location: dt_tahfizh.php?nis=" . $_SESSION['nis'] . "&nama=" . $_SESSION['nama']);
                exit();
            } else {
                echo "Terjadi kesalahan saat mengupdate data setoran.";
            }
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID setoran tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Setoran</title>
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
        <h2>Edit Setoran</h2>
        <form method="POST">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>

            <label for="hafalan">Hafalan:</label>
            <input type="text" id="hafalan" name="hafalan" value="<?php echo $data['hafalan']; ?>" required>

            <label for="nilai">Nilai:</label>
            <select id="nilai" name="nilai" required>
                <option value="">Pilih Nilai</option>
                <option value="A" <?php if ($data['nilai'] == 'A') echo 'selected'; ?>>A</option>
                <option value="B" <?php if ($data['nilai'] == 'B') echo 'selected'; ?>>B</option>
                <option value="C" <?php if ($data['nilai'] == 'C') echo 'selected'; ?>>C</option>
                <option value="D" <?php if ($data['nilai'] == 'D') echo 'selected'; ?>>D</option>
            </select>

            <label for="total_hafalan">Total Hafalan (Per halaman):</label>
            <input type="number" id="total_hafalan" name="total_hafalan" step="0.1" min="0" max="604" value="<?php echo $data['total_hafalan']; ?>" required>

            <input type="submit" value="Update Setoran">
        </form>
        <div class="add-button">
            <a href="dt_tahfizh.php?nis=<?php echo $_SESSION['nis']; ?>&nama=<?php echo $_SESSION['nama']; ?>">Kembali</a>
        </div>
    </div>
</body>

</html>
