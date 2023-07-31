<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil ID ujian dari parameter URL
$id_ujian = $_GET['id'];

// Query untuk mengambil data ujian tahfizh berdasarkan ID
$query = "SELECT * FROM putra_tahfizh_ujian WHERE id='$id_ujian'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);

// Proses update data ujian tahfizh
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $ujian = mysqli_real_escape_string($koneksi, $_POST['ujian']);
    $nilai = $_POST['nilai'];

    // Query untuk mengupdate data ujian tahfizh berdasarkan ID
    $update_query = "UPDATE putra_tahfizh_ujian SET tanggal='$tanggal', ujian='$ujian', nilai='$nilai' WHERE id='$id_ujian'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        // Redirect kembali ke halaman update_tahfizh.php setelah data berhasil diupdate
        header("Location: dt_tahfizh.php?nis=" . $_SESSION['nis'] . "&nama=" . $_SESSION['nama']);
        exit();
    } else {
        echo "Terjadi kesalahan saat mengupdate data ujian tahfizh.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Ujian Tahfizh</title>
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
        <h2>Edit Ujian Tahfizh</h2>
        <form method="POST">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>

            <label for="ujian">Nama Ujian:</label>
            <input type="text" id="ujian" name="ujian" value="<?php echo $data['ujian']; ?>" required>

            <label for="nilai">Nilai:</label>
            <select id="nilai" name="nilai" required>
                <option value="">Pilih Nilai</option>
                <option value="A" <?php if ($data['nilai'] == 'A') echo 'selected'; ?>>A</option>
                <option value="B" <?php if ($data['nilai'] == 'B') echo 'selected'; ?>>B</option>
                <option value="C" <?php if ($data['nilai'] == 'C') echo 'selected'; ?>>C</option>
                <option value="D" <?php if ($data['nilai'] == 'D') echo 'selected'; ?>>D</option>
            </select>

            <input type="submit" value="Simpan Perubahan">
        </form>
        <div class="add-button">
            <a href="dt_tahfizh.php?nis=<?php echo $_SESSION['nis']; ?>&nama=<?php echo $_SESSION['nama']; ?>">Kembali</a>
        </div>
    </div>
</body>

</html>
