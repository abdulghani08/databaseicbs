<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil NIS dan Nama dari parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];

// Query untuk mendapatkan data bakat dari tabel minat_bakat
$query_bakat = "SELECT * FROM minat_bakat";
$result_bakat = mysqli_query($koneksi, $query_bakat);

// Proses simpan data minat bakat ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $bakat = $_POST['bakat'];

    // Query untuk mendapatkan jenis berdasarkan foreign key dari bakat
    $query_jenis = "SELECT jenis FROM minat_bakat WHERE bakat='$bakat'";
    $result_jenis = mysqli_query($koneksi, $query_jenis);
    $row_jenis = mysqli_fetch_assoc($result_jenis);
    $jenis = $row_jenis['jenis'];

    // Query untuk menyimpan data minat bakat
    $query = "INSERT INTO minat_bakat_isi (nis, nama, bakat, jenis) VALUES ('$nis', '$nama', '$bakat', '$jenis')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_minatbakat.php setelah data berhasil disimpan
        header("Location: update_minatbakat.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data minat bakat.: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Data Minat Bakat</title>
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
        <h2>Form Tambah Data Minat Bakat</h2>
        <form method="POST">
            <label for="nis">NIS:</label>
            <input type="text" id="nis" name="nis" value="<?php echo $nis; ?>" required readonly>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required readonly>

            <label for="bakat">Bakat:</label>
            <select id="bakat" name="bakat" required>
                <option value="">Pilih Bakat</option>
                <?php while ($row_bakat = mysqli_fetch_assoc($result_bakat)) : ?>
                    <option value="<?php echo $row_bakat['bakat']; ?>"><?php echo $row_bakat['bakat']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="jenis">Jenis:</label>
            <input type="text" id="jenis" name="jenis" value="" required readonly>

            <input type="submit" value="Tambah Data Minat Bakat">
        </form>
        <div class="add-button">
            <a href="update_minatbakat.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>">Kembali</a>
        </div>
    </div>

    <script>
        // Mendapatkan nilai jenis berdasarkan bakat yang dipilih
        var bakatDropdown = document.getElementById('bakat');
        var jenisInput = document.getElementById('jenis');

        bakatDropdown.addEventListener('change', function() {
            jenisInput.value = bakatDropdown.value;
        });
    </script>
</body>

</html>
