<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil NIS dan Nama dari parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];

// Ambil informasi asrama berdasarkan NIS dan Nama
$query_asrama = "SELECT asrama FROM portopolio_isi WHERE nis = '$nis' AND nama = '$nama'";
$result_asrama = mysqli_query($koneksi, $query_asrama);

if ($result_asrama) {
    $row_asrama = mysqli_fetch_assoc($result_asrama);
    $asrama = $row_asrama['asrama'];
} else {
    // Handle jika terjadi kesalahan dalam mengambil data asrama
    $asrama = ""; // Atur menjadi nilai default jika tidak ada data
}

// Ambil informasi asrama berdasarkan NIS dan Nama
$query_kelas = "SELECT kelas FROM portopolio_isi WHERE nis = '$nis' AND nama = '$nama'";
$result_kelas = mysqli_query($koneksi, $query_kelas);

if ($result_kelas) {
    $row_kelas = mysqli_fetch_assoc($result_kelas);
    $kelas = $row_kelas['kelas'];
} else {
    // Handle jika terjadi kesalahan dalam mengambil data asrama
    $kelas = ""; // Atur menjadi nilai default jika tidak ada data
}

// Query untuk mendapatkan data bakat dari tabel minat_bakat
$query_bakat = "SELECT * FROM minat_bakat";
$result_bakat = mysqli_query($koneksi, $query_bakat);

// Proses simpan data minat bakat ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $asrama = $_POST['asrama'];
    $kelas = $_POST['kelas'];
    $bakat = mysqli_real_escape_string($koneksi, $_POST['bakat']);
    $penginput = $_POST['penginput'];

    // Query untuk mendapatkan jenis berdasarkan foreign key dari bakat
    $query_jenis = "SELECT jenis FROM minat_bakat WHERE bakat='$bakat'";
    $result_jenis = mysqli_query($koneksi, $query_jenis);
    $row_jenis = mysqli_fetch_assoc($result_jenis);
    $jenis = $row_jenis['jenis'];

    // Query untuk menyimpan data minat bakat
    $query = "INSERT INTO minat_bakat_isi (nis, nama, asrama, kelas, bakat, jenis, penginput) VALUES ('$nis', '$nama', '$asrama', '$kelas', '$bakat', '$jenis', '$penginput')";
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
        <h2>Form Tambah Data Minat Bakat</h2>
        <form method="POST">
            <label for="penginput">Penginput:</label>
            <input type="text" id="penginput" name="penginput" value="<?php echo $_SESSION['username']; ?>" readonly>
        
            <label for="nis">NIS:</label>
            <input type="text" id="nis" name="nis" value="<?php echo $nis; ?>" required readonly>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required readonly>

            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>

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
