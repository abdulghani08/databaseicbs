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

// Proses simpan data setoran ke database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $_POST['nis']; // Ambil NIS dari form
    $nama = $_POST['nama']; // Ambil Nama dari form

    $kelas = $_POST['kelas'];
    $asrama = $_POST['asrama'];
    $tanggal = $_POST['tanggal'];
    $pelanggaran = $_POST['pelanggaran'];
    $poin = $_POST['poin'];
    $klasifikasi = $_POST['klasifikasi'];
    $hukuman = $_POST['hukuman'];
    $hukumantambahan = $_POST['hukumantambahan'];
    $keterangan = $_POST['keterangan'];
    $penginput = $_POST['penginput'];

    // Ambil data santri berdasarkan NIS dari tabel dt_prestasi
    $query = "SELECT * FROM portopolio_isi WHERE nis='$nis'";
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
    $query = "INSERT INTO disiplin_isi (nis, nama, asrama, kelas, tanggal, pelanggaran, poin, klasifikasi, hukuman, hukumantambahan, keterangan, penginput) VALUES ('$nis', '$nama', '$asrama', '$kelas', '$tanggal', '$pelanggaran', '$poin', '$klasifikasi', '$hukuman', '$hukumantambahan', '$keterangan', '$penginput')";
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

// Ambil data pelanggaran dari tabel daftar_pelanggaran berdasarkan kriteria pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$query_pelanggaran = "SELECT nama, poin, klasifikasi FROM daftar_pelanggaran WHERE nama LIKE '%$search%'";
$result_pelanggaran = mysqli_query($koneksi, $query_pelanggaran);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Form Tambah Pelanggaran</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        :root {
            --primary-color: #FF8C00;
            --secondary-color: #FFA500;
            --background-color: #FFF5E6;
            --text-color: #333;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h4 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--primary-color);
        }

        input, select {
            margin-bottom: 20px;
            padding: 12px;
            border: 2px solid var(--secondary-color);
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(255, 140, 0, 0.2);
        }

        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
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
            text-decoration: none;
            background-color: var(--secondary-color);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .add-button a:hover {
            background-color: var(--primary-color);
        }

        @media (max-width: 428px) {
            .container {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Library -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JavaScript Library -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#search').on('input', function() {
        var searchText = $(this).val().toLowerCase();
        $.ajax({
            url: 'search_nama_pelanggaran.php',
            method: 'GET',
            data: {search: searchText},
            dataType: 'json',
            success: function(response) {
                var pelanggaranDropdown = $('#pelanggaran');
                pelanggaranDropdown.empty();
                
                // Tambahkan opsi "Silahkan pilih pelanggaran"
                pelanggaranDropdown.append('<option value="" selected disabled>Silahkan pilih pelanggaran</option>');

                // Tambahkan opsi pelanggaran hasil pencarian
                response.forEach(function(item) {
                    pelanggaranDropdown.append('<option value="' + item.nama + '" data-poin="' + item.poin + '" data-klasifikasi="' + item.klasifikasi + '">' + item.nama + '</option>');
                });
            }
        });
    });
});

</script>

</head>

<body>
    <div class="container">
        <h4>Form Tambah Pelanggaran</h4>
        <form method="POST">
            <!-- Form elements -->
            <input type="hidden" name="nis" value="<?php echo $nis; ?>">
            <input type="hidden" name="nama" value="<?php echo $nama; ?>">
            <label for="penginput">Penginput:</label>
            <input type="text" id="penginput" name="penginput" value="<?php echo $_SESSION['username']; ?>" readonly>
            <label for="asrama">Asrama:</label>
            <input type="text" id="asrama" name="asrama" value="<?php echo $asrama; ?>" readonly>
            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $kelas; ?>" readonly>

            <label for="tanggal">Tanggal :</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="search">Cari Pelanggaran:</label>
            <input type="text" id="search" name="search" onkeyup="searchPelanggaran()" placeholder="Masukkan nama pelanggaran...">

            <label for="pelanggaran">Pelanggaran :</label>
            <select id="pelanggaran" name="pelanggaran" required>
    <option value="" selected disabled>Silahkan pilih pelanggaran</option>
    <?php
    while ($row_pelanggaran = mysqli_fetch_array($result_pelanggaran)) {
        echo '<option value="' . $row_pelanggaran['nama'] . '" data-poin="' . $row_pelanggaran['poin'] . '" data-klasifikasi="' . $row_pelanggaran['klasifikasi'] . '">' . $row_pelanggaran['nama'] . '</option>';
    }
    ?>
</select>




<script>
        $(document).ready(function() {
            $('#pelanggaran').select2({
                theme: 'classic',
                placeholder: 'Pilih pelanggaran',
                allowClear: true
            });

            $('form').on('submit', function() {
                $('input[type="submit"]').addClass('loading');
            });

            // Add more JavaScript for animations and interactions
        });
    </script>

            <label for="klasifikasi">Klasifikasi :</label>
            <input type="text" id="klasifikasi" name="klasifikasi" required readonly>

            <label for="poin">Poin Pelanggaran :</label>
            <input type="text" id="poin" name="poin" required readonly>

            <label for="hukuman">Hukuman :</label>
            <select id="hukuman" name="hukuman" required></select>

            <label for="hukumantambahan">Hukuman Tambahan (Opsional)</label>
            <input type="text" id="hukumantambahan" name="hukumantambahan">

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
                    'Lari lima putaran lapangan basket',
                    'Membersihkan selokan',
                    'Rukuk dengan membaca istiqfar 5 menit',
                    // Tambahkan opsi hukuman lainnya untuk klasifikasi 'Ringan'
                ],
                'Sedang': [
                    'Menulis dan membaca istighfar 100 kali/ 1 buku isi 40',
                    'Membersihkan Jemuran',
                    'Membersihkan WC umum/ mushalla/ masjid',
                    'Membersihkan kamar mandi/WC selama 1 pekan',
                    'Tidak keluar pesantren selama 2 bulan',
                    'Meminta nasihat dan tanda tangan pada ustadz/ustadzah dan atau Kepala Asrama',
                    'Mentasmikan ayat Al-Quran atau hadits yang ditentukan',
                    'Memakai baju tertentu bagi santriwati',
                    'Memberikan tadzkiroh yang ditujukan untuk dirinya maupun orang lain di hadapan santri',
                    'Shalat di shaf pertama selama 2 Pekan',
                    'Itikaf',
                    'Menghafal QS As Sajadah',
                    'Menghafal QS Al- Mulk',
                    'Mencuci Tong Sampah',
                    'Lari sepuluh putaran lapangan',
                    // Tambahkan opsi hukuman lainnya untuk klasifikasi 'Sedang'
                ],
                'Berat': [
                    'Pemanggilan Orang tua sebagai peringatan terakhir',
                    'Direkomendasikan untuk pindah',
                    'Skorsing dan pembinaan bersama orang tua',
                    'Menghafal Quran Surah Yasin',
                    'Membuat makalah dengan tema pelanggaran yang dilanggar serta mempresentasikannya',
                    'Pemanggilan Orang tua',
                    'Skorsing minumal 2 pekan atau sampai penyelesaikan target',
                    'Menulis dan menghafal QS Alkahfi',
                    'Pemberitahuan Kepada Orang Tua',
                    'Menulis dan menghafal QS Ar Rahman',
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

<script>
  function searchPelanggaran() {
    const input = document.getElementById('search').value.toLowerCase();
    const pelanggaranDropdown = document.getElementById('pelanggaran');
    const options = pelanggaranDropdown.options;

    // Simpan daftar pelanggaran sebelum pencarian dilakukan
    let pelanggaranList = [];
    for (let i = 0; i < options.length; i++) {
        pelanggaranList.push(options[i]);
    }

    // Hapus semua opsi di dropdown pelanggaran
    pelanggaranDropdown.innerHTML = '';

    // Tambahkan opsi "Silahkan pilih pelanggaran" ke dropdown
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.text = 'Silahkan pilih pelanggaran';
    pelanggaranDropdown.appendChild(defaultOption);

    // Tampilkan kembali daftar pelanggaran yang disimpan sebelumnya
    for (let i = 0; i < pelanggaranList.length; i++) {
        pelanggaranDropdown.appendChild(pelanggaranList[i].cloneNode(true));
    }

    // Saring daftar pelanggaran berdasarkan input pengguna
    for (let i = 0; i < options.length; i++) {
        const option = options[i];
        const text = option.text.toLowerCase();
        const contains = text.includes(input);

        if (contains || input === '') {
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }
    }
}













    $(document).ready(function() {
    // Simpan semua opsi pelanggaran ke dalam sebuah variabel saat halaman dimuat
    var pelanggaranOptions = $('#pelanggaran').html();

    // Fungsi untuk menampilkan kembali opsi-opsi pelanggaran saat pencarian dilakukan
    $('#search').on('input', function() {
        var input = $(this).val().toLowerCase();
        var pelanggaranDropdown = $('#pelanggaran');

        // Kosongkan dropdown pelanggaran
        pelanggaranDropdown.empty();

        // Tambahkan kembali semua opsi pelanggaran
        pelanggaranDropdown.append(pelanggaranOptions);

        // Saring opsi pelanggaran berdasarkan input pengguna
        pelanggaranDropdown.find('option').each(function() {
            var optionText = $(this).text().toLowerCase();
            var contains = optionText.includes(input);

            if (contains || input === '') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Reset pilihan pelanggaran saat kotak pencarian dikosongkan
    $('#search').on('keyup', function(event) {
        if (event.key === "Backspace" || event.key === "Delete") {
            $('#pelanggaran').val('').trigger('change');
        }
    });
});

</script>


</body>
</html>
