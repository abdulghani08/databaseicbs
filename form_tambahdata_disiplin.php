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

// Proses simpan data setoran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis']; // Ambil NIS dari form
    $nama = $_POST['nama']; // Ambil Nama dari form

    $tanggal = $_POST['tanggal'];
    $pelanggaran = $_POST['pelanggaran'];
    $poin = $_POST['poin'];
    $hukuman = $_POST['hukuman'];
    $keterangan = $_POST['keterangan'];

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        die("Santri tidak ditemukan");
    }

    // Ambil poin pelanggaran dari tabel daftar_pelanggaran berdasarkan nama pelanggaran yang dipilih
    $query_poin = "SELECT poin FROM daftar_pelanggaran WHERE nama='$pelanggaran'";
    $result_poin = mysqli_query($koneksi, $query_poin);
    $data_poin = mysqli_fetch_array($result_poin);

    if (!$data_poin) {
        die("Pelanggaran tidak ditemukan");
    }

    $poin = $data_poin['poin']; // Mengisi poin pelanggaran dari tabel daftar_pelanggaran

    // Query untuk menyimpan data prestasi
    $query = "INSERT INTO disiplin_isi (nis, nama, tanggal, pelanggaran, poin, hukuman, keterangan) VALUES ('$nis', '$nama', '$tanggal', '$pelanggaran', '$poin', '$hukuman', '$keterangan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_disiplin.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data Kedisiplinan.";
    }
}

// Ambil data pelanggaran dari tabel daftar_pelanggaran
$query_pelanggaran = "SELECT nama, poin FROM daftar_pelanggaran";
$result_pelanggaran = mysqli_query($koneksi, $query_pelanggaran);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Pelanggaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label,
        input {
            display: block;
            margin-bottom: 15px;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <h4>Form Tambah Pelanggaran</h4>
        <form method="POST">
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">

            <label for="tanggal">Tanggal :</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <br>
            <label for="pelanggaran">Pelanggaran :</label>
            <select id="pelanggaran" name="pelanggaran" required style="width: 100%;">
                <?php
                while ($row_pelanggaran = mysqli_fetch_array($result_pelanggaran)) {
                    echo '<option value="' . $row_pelanggaran['nama'] . '" data-poin="' . $row_pelanggaran['poin'] . '">' . $row_pelanggaran['nama'] . '</option>';
                }
                ?>
            </select>

            <br> 
            <label for="poin">Poin Pelanggaran :</label>
            <input type="text" id="poin" name="poin" required readonly>

            <label for="hukuman">Hukuman :</label>
            <input type="text" id="hukuman" name="hukuman" required>

            <label for="keterangan">Keterangan :</label>
            <select id="keterangan" name="keterangan" required>
                <option value="Tuntas">Tuntas</option>
                <option value="Belum Tuntas">Belum Tuntas</option>
            </select>


            <input type="submit" value="Simpan">
        </form>
        <div class="add-button">
            <a href="dt_disiplin.php">Kembali</a>
        </div>
    </div>

    <script>
        // Ambil poin pelanggaran dari tabel daftar_pelanggaran berdasarkan nama pelanggaran yang dipilih
        const pelanggaranSelect = document.getElementById('pelanggaran');
        const poinInput = document.getElementById('poin');

        pelanggaranSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const poin = selectedOption.dataset.poin;
            poinInput.value = poin;
        });
    </script>
</body>

</html>
