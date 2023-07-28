<?php
require_once('connection.php');

// Ambil data NIS dan nama dari parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];

// Query untuk mengambil data disiplin berdasarkan NIS dan nama
$query = "SELECT * FROM putra_disiplin_isi WHERE nis = '$nis' AND nama = '$nama'";
$result = mysqli_query($koneksi, $query);

// Mengecek apakah query berhasil dieksekusi
if ($result) {
    $data = mysqli_fetch_assoc($result);
} else {
    die("Query error: " . mysqli_error($koneksi));
}

// Jika tombol "Update" ditekan
if (isset($_POST['update'])) {
    // Ambil data dari form
    $tanggal = $_POST['tanggal'];
    $pelanggaran = $_POST['pelanggaran'];
    $poin = $_POST['poin'];
    $hukuman = $_POST['hukuman'];
    $keterangan = $_POST['keterangan'];

    // Query untuk mengupdate data disiplin
    $update_query = "UPDATE putra_disiplin_isi SET tanggal='$tanggal', pelanggaran='$pelanggaran', poin='$poin', hukuman='$hukuman', keterangan='$keterangan' WHERE nis='$nis' AND nama='$nama'";
    $update_result = mysqli_query($koneksi, $update_query);

    // Mengecek apakah query update berhasil dieksekusi
    if ($update_result) {
        echo "Data berhasil diperbarui.";
        // Redirect ke halaman lain setelah mengupdate data
        header("Location: update_disiplin.php?nis=$nis&nama=$nama");
        exit();
    } else {
        die("Query error: " . mysqli_error($koneksi));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Disiplin</title>
    <link rel="shortcut icon" href="logo.png">
    <!-- Tambahkan link CSS dan tag <style> di sini untuk mengatur tampilan form -->
    <style>
        /* Contoh styling form */
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Edit Data Disiplin</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>">
        </div>
        <div class="form-group">
            <label>Nama Pelanggaran</label>
            <input type="text" name="pelanggaran" value="<?php echo $data['pelanggaran']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Poin Pelanggaran</label>
            <input type="text" name="poin" value="<?php echo $data['poin']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Bentuk Hukuman</label>
            <input type="text" name="hukuman" value="<?php echo $data['hukuman']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <select id="keterangan" name="keterangan" required>
                <option value="Tuntas" <?php if ($data['keterangan'] == 'Tuntas') echo 'selected'; ?>>Tuntas</option>
                <option value="Belum Tuntas" <?php if ($data['keterangan'] == 'Belum Tuntas') echo 'selected'; ?>>Belum Tuntas</option>
            </select>
        </div>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

