<?php
session_start();
include "../connection.php";
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
    $klasifikasi = $_POST['klasifikasi'];
    $hukuman = $_POST['hukuman'];
    $hukumantambahan = $_POST['hukumantambahan'];
    $keterangan = $_POST['keterangan'];

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM putra_portopolio_isi WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);

    if (!$data) {
        die("Gagal menjalankan query: " . mysqli_error($koneksi));
    }
    $data = mysqli_fetch_array($result);

    // Ambil poin pelanggaran dari tabel daftar_pelanggaran berdasarkan nama pelanggaran yang dipilih
    $query_poin = "SELECT poin FROM daftar_pelanggaran WHERE nama='$pelanggaran'";
    $result_poin = mysqli_query($koneksi, $query_poin);
    $data_poin = mysqli_fetch_array($result_poin);

    if (!$data_poin) {
        die("Pelanggaran tidak ditemukan");
    }

    $poin = $data_poin['poin']; // Mengisi poin pelanggaran dari tabel daftar_pelanggaran

    // Ambil klasifikasi pelanggaran dari tabel daftar_pelanggaran berdasarkan nama pelanggaran yang dipilih
    $query_klasifikasi = "SELECT klasifikasi FROM daftar_pelanggaran WHERE nama='$pelanggaran'";
    $result_klasifikasi = mysqli_query($koneksi, $query_klasifikasi);
    $data_klasifikasi = mysqli_fetch_array($result_klasifikasi);

    if (!$data_klasifikasi) {
        die("Klasifikasi pelanggaran tidak ditemukan");
    }

    $klasifikasi = $data_klasifikasi['klasifikasi']; // Mengisi klasifikasi dari tabel daftar_pelanggaran


    // Query untuk menyimpan data prestasi
    $query = "INSERT INTO putra_disiplin_isi (nis, nama, tanggal, pelanggaran, poin, klasifikasi, hukuman, hukumantambahan, keterangan) VALUES ('$nis', '$nama', '$tanggal', '$pelanggaran', '$poin', '$klasifikasi', '$hukuman', '$hukumantambahan', '$keterangan')";
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
$query_pelanggaran = "SELECT nama, poin, klasifikasi FROM daftar_pelanggaran";
$result_pelanggaran = mysqli_query($koneksi, $query_pelanggaran);

// Ambil data hukuman dari tabel disiplin_sanksi
$query_hukuman = "SELECT ringan, sedang, berat FROM disiplin_sanksi";
$result_hukuman = mysqli_query($koneksi, $query_hukuman);
$data_hukuman = mysqli_fetch_array($result_hukuman);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Pelanggaran</title>
    <link rel="shortcut icon" href="../logo.png">
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
            <!-- Form elements -->
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
            
            <label for="tanggal">Tanggal :</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="pelanggaran">Pelanggaran :</label>
            <select id="pelanggaran" name="pelanggaran" required style="width: 100%;">
                <?php
                while ($row_pelanggaran = mysqli_fetch_array($result_pelanggaran)) {
                    echo '<option value="' . $row_pelanggaran['nama'] . '" data-poin="' . $row_pelanggaran['poin'] . '" data-klasifikasi="' . $row_pelanggaran['klasifikasi'] . '">' . $row_pelanggaran['nama'] . '</option>';
                }
                ?>
            </select>

            <br>
            <br>
            <label for="klasifikasi">Klasifikasi :</label>
            <input type="text" id="klasifikasi" name="klasifikasi" required readonly>

            <label for="poin">Poin Pelanggaran :</label>
            <input type="text" id="poin" name="poin" required readonly>

            <label for="hukuman">Hukuman :</label>
            <select id="hukuman" name="hukuman" required style="width: 100%;"></select>

            <br><br>
            <label for="hukumantambahan">Hukuman Tambahan (Opsional)</label>
            <input type="text" id="hukumantambahan" name="hukumantambahan">

            <br>
            <br>
            <label for="keterangan">Keterangan :</label>
            <select id="keterangan" name="keterangan" required>
                <option value="Tuntas">Tuntas</option>
                <option value="Belum Tuntas">Belum Tuntas</option>
            </select>

            <br>
            <br>
            <center><input type="submit" value="Simpan"></center>
        </form>
        <div class="add-button">
            <a href="dt_disiplin.php">Kembali</a>
        </div>
    </div>

    <script>
        // Ambil poin pelanggaran dan klasifikasi dari tabel daftar_pelanggaran berdasarkan nama pelanggaran yang dipilih
        const pelanggaranSelect = document.getElementById('pelanggaran');
        const poinInput = document.getElementById('poin');
        const klasifikasiInput = document.getElementById('klasifikasi');
        const hukumanSelect = document.getElementById('hukuman');

        pelanggaranSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const poin = selectedOption.dataset.poin;
            const klasifikasi = selectedOption.dataset.klasifikasi;

            poinInput.value = poin;
            klasifikasiInput.value = klasifikasi;

            // Kosongkan dropdown hukuman
            hukumanSelect.innerHTML = '';

            // Tambahkan opsi hukuman berdasarkan klasifikasi yang dipilih
            const opsiHukuman = {
                'Ringan': [
                    'Menulis dan membaca istighfar 70 kali',
                    'Menginformasikan kepada Orangtua/Wali Santri',
                    'Diberikan teguran atau peringatan',
                    'Menghafal mufradat',
                    'Menghafal ayat Alquran dan atau Hadits',
                    'Merangkum pelajaran yang ditentukan',
                    'Membangunkan santri waktu subuh',
                    'Menyapu dan membuang sampah',
                    'Mengepel',
                    'Meminta nasihat dan tanda tangan',
                    'Menulis Al-Quran atau hadits sesuai dengan pelanggaran',
                    'Membaca Al-Quran pada waktu dan tempat yang telah ditentukan',
                    'Merapikan sandal di masjid atau di asrama',
                    'Shalat di shaf pertama selama 3 hari',
                    'Push up maksimal 20 kali dalam waktu 3 menit',
                    'Lari lima putaran lapangan basket',
                    'Membersihkan selokan',
                    'Skorsing dari kegiatan sekolah selama sepekan dan menjalani program yang ditentukan oleh asrama',
                    // Tambahkan opsi hukuman lainnya untuk klasifikasi 'Ringan'
                ],
                'Sedang': [
                    'Menulis dan membaca istighfar 100 kali/ 1 buku isi 40',
                    'Pemanggilan Orangtua/Wali Santri ke sekolah',
                    'Diberikan teguran atau peringatan',
                    'Dikembalikan kepada Orangtua/Wali santri sementara selama 2 pekan tergantung kadar pelanggaran',
                    'Membersihkan kamar mandi/WC Selama 1 Pekan',
                    'Tidak keluar Pesantren selama 2 bulan',
                    'Meminta nasihat dan tanda tangan pada ustadz/ustadzah dan atau Kepala Asrama',
                    'Mentasmikan ayat Al-Quran atau hadits yang ditentukan',
                    'Memakai baju tertentu bagi santriwati',
                    'Diumumkan di depan seluruh santri di masjid',
                    'Memberikan tadzkiroh yang ditujukan untuk dirinya maupun orang lain di hadapan santri',
                    'Shalat di shaf pertama selama 2 Pekan',
                    'Itikaf',
                    'Menghafal QS As Sajadah',
                    'Menghafal QS Al- Mulk',
                    // Tambahkan opsi hukuman lainnya untuk klasifikasi 'Sedang'
                ],
                'Berat': [
                    'Menulis dan membaca istighfar 200 kali/ hari',
                    'Diberikan teguran atau peringatan',
                    'Diumumkan dan dijemur di lapangan',
                    'Skorsing',
                    'Tidak naik kelas atau tidak lulus',
                    'Dikembalikan kepada orang tua/wali',
                    // Tambahkan opsi hukuman lainnya untuk klasifikasi 'Berat'
                ],
            };

            const hukumanOptions = opsiHukuman[klasifikasi];
            for (const hukuman of hukumanOptions) {
                const option = document.createElement('option');
                option.value = hukuman;
                option.text = hukuman;
                hukumanSelect.add(option);
            }
        });
    </script>
</body>
</html>
