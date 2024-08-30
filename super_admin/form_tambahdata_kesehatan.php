<?php
session_start();
include "../connection.php";
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

// Proses simpan data setoran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis']; // Ambil NIS dari form
    $nama = $_POST['nama']; // Ambil Nama dari form

    $kelas = $_POST['kelas'];
    $asrama = $_POST['asrama'];
    $tanggal = $_POST['tanggal'];
    $nakes = $_POST['nakes'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];
    $rujukan = $_POST['rujukan'];
    $penginput = $_POST['penginput'];

    $diagnosa = $_POST['diagnosa'];
    if ($diagnosa === 'DLL') {
        $diagnosa = $_POST['diagnosa_lain'];
    }

    $rujukan = $_POST['rujukan'];
    if ($rujukan === 'DLL') {
        $rujukan = $_POST['rujukan_lain'];
    }

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        die("Santri tidak ditemukan");
    }

    // Query untuk menyimpan data prestasi
    $query = "INSERT INTO kesehatan_isi (nis, nama, asrama, kelas, tanggal, nakes, diagnosa, tindakan, rujukan, penginput) VALUES ('$nis', '$nama', '$asrama', '$kelas', '$tanggal', '$nakes', '$diagnosa', '$tindakan', '$rujukan', '$penginput')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman update_tahfizh.php setelah data berhasil disimpan
        header("Location: update_kesehatan.php?nis=$nis&nama=$nama");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data Prestasi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Diagnosa Kesehatan</title>
    <link rel="shortcut icon" href="../logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
    --primary-color: #2E8B57;    /* Sea Green */
    --secondary-color: #3CB371;  /* Medium Sea Green */
    --text-color: #333;
    --background-color: #E8F5E9;         /* Light Green background */
}

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 100%;
            width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--secondary-color);
        }

        input, select {
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 8px;
            background-color: #f0f0f0;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--primary-color);
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        .add-button {
            text-align: center;
            margin-top: 20px;
        }

        .add-button a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .add-button a:hover {
            color: var(--secondary-color);
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
    <script>
    function showDiagnosaLain() {
        var diagnosa = document.getElementById("diagnosa");
        var diagnosaLainDiv = document.getElementById("diagnosaLainDiv");
        if (diagnosa.value === "DLL") {
            diagnosaLainDiv.style.display = "block";
        } else {
            diagnosaLainDiv.style.display = "none";
        }
    }

    function showRujukanLain() {
        var rujukan = document.getElementById("rujukan");
        var rujukanLainDiv = document.getElementById("rujukanLainDiv");
        if (rujukan.value === "DLL") {
            rujukanLainDiv.style.display = "block";
        } else {
            rujukanLainDiv.style.display = "none";
        }
    }
    </script>
</head>
<body>
    <div class="container">
        <h2>Form Tambah Diagnosa Santri</h2>
        <form method="POST">
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
            
            <label for="penginput">Penginput:</label>
            <input type="text" id="penginput" name="penginput" value="<?php echo $_SESSION['username']; ?>" readonly>
            
            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="nakes">Tenaga Kesehatan:</label>
            <select id="nakes" name="nakes" required>
                <option value="">Pilih Tenaga Kesehatan</option>
                <option value="Ranti Dwi Muslimah,A.Md.Keb">Ranti Dwi Muslimah,A.Md.Keb</option>
                <option value="Deyana Septi Tamara A.Md.Keb">Deyana Septi Tamara A.Md.Keb</option>
                <option value="Adinda gustiyan A.Md.Keb">Adinda gustiyan A.Md.Keb</option>
            </select>
            
            <label for="diagnosa">Diagnosa Kesehatan Santri:</label>
            <select id="diagnosa" name="diagnosa" required onchange="showDiagnosaLain()">
                <option value="">Pilih Diagnosa</option>
                <option value="Demam">Demam</option>
                <option value="Sakit Kepala">Sakit Kepala</option>
                <option value="Diare">Diare</option>
                <option value="Flu dan Batuk">Flu dan Batuk</option>
                <option value="Magh">Magh</option>
                <option value="Asma">Asma</option>
                <option value="Cacar">Cacar</option>
                <option value="Scebies">Scebies</option>
                <option value="Gondongan">Gondongan</option>
                <option value="Sakit Mata">Sakit Mata</option>
                <option value="Keseleo">Keseleo</option>
                <option value="Amandel">Amandel</option>
                <option value="Alergi">Alergi</option>
                <option value="Kutu Air">Kutu Air</option>
                <option value="Radang Telinga">Radang Telinga</option>
                <option value="Sakit Gigi">Sakit Gigi</option>
                <option value="Luka">Luka</option>
                <option value="Bisul">Bisul</option>
                <option value="DLL">DLL</option>
            </select>
            <div id="diagnosaLainDiv" style="display: none;">
                <label for="diagnosa_lain">Diagnosa Lainnya:</label>
                <input type="text" id="diagnosa_lain" name="diagnosa_lain">
            </div>

            <label for="tindakan">Tindakan Awal di UKS:</label>
            <select id="tindakan" name="tindakan" required>
                <option value="">Pilih Tindakan</option>
                <option value="Pemberian obat oral dan edukasi">Pemberian obat oral dan edukasi</option>
                <option value="Pemberian obat salaf dan edukasi">Pemberian obat salaf dan edukasi</option>
                <option value="Pemberian obat tetes mata dan edukasi">Pemberian obat tetes mata dan edukasi</option>
                <option value="Pemberian obat kumur">Pemberian obat kumur</option>
                <option value="Pemberian perawatan luka">Pemberian perawatan luka</option>
                <option value="Perlu Rujukan">Perlu Rujukan</option>
            </select>

            <label for="rujukan">Tindakan Rujuk Santri:</label>
            <select id="rujukan" name="rujukan" required onchange="showRujukanLain()">
                <option value="">Pilih Rujukan</option>
                <option value="Tidak Ada">Tidak Ada</option>
                <option value="Puskesmas/Klinik latina medika">Puskesmas/Klinik latina medika</option>
                <option value="SSDC">SSDC</option>
                <option value="Eye Center">Eye Center</option>
                <option value="Dr Spesialis Kulit">Dr Spesialis Kulit</option>
                <option value="Dr Spesialis THT">Dr Spesialis THT</option>
                <option value="Rumah Sakit (ronsent, dll)">Rumah Sakit (ronsent, dll)</option>
                <option value="Tukang Urut">Tukang Urut</option>
                <option value="DLL">DLL</option>
            </select>
            <div id="rujukanLainDiv" style="display: none;">
                <label for="rujukan_lain">Rujukan Lainnya:</label>
                <input type="text" id="rujukan_lain" name="rujukan_lain">
            </div>

            <input type="submit" value="Tambah Diagnosa">
        </form>
        <div class="add-button">
            <a href="dt_kesehatan.php">Kembali</a>
        </div>
    </div>
</body>
</html>