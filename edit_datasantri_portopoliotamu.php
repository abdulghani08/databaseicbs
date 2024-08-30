<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Tentukan ukuran maksimal file (dalam byte) - 10 MB
$maxFileSize = 10 * 1024 * 1024; // 10 MB dalam byte

// Periksa apakah ada permintaan pengiriman form
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
//     $upload_dir = '/home/sant5315/public_html/uploads/';

//     // Periksa apakah ada file yang diunggah
//     if (isset($_FILES['pas_poto']) && $_FILES['pas_poto']['error'] === UPLOAD_ERR_OK) {
//         // Buat nama unik untuk file foto
//         $filename = $_FILES['pas_poto']['name'];
//         $foto_name = $nis . '_' . $filename;
//         $foto_path = $upload_dir . $foto_name;

//         // Periksa ukuran file
//         if ($_FILES['pas_poto']['size'] > $maxFileSize) {
//             echo "Ukuran file terlalu besar. Maksimal 10 MB.";
//             exit();  // Hentikan proses jika ukuran melebihi batas
//         }

//         // Pindahkan file foto ke direktori yang ditentukan
//         if (move_uploaded_file($_FILES['pas_poto']['tmp_name'], $foto_path)) {
//             // Perbarui path foto santri di database
//             $query_update_foto = "UPDATE portopolio_isi SET pas_poto='$foto_path' WHERE nis='$nis'";
//             $result_update_foto = mysqli_query($koneksi, $query_update_foto);

//             if ($result_update_foto) {
//                 echo "File berhasil dipindahkan ke " . $foto_path . ". Data telah berhasil diperbarui.";
//             } else {
//                 echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi);
//             }
//         } else {
//             echo "Terjadi kesalahan saat memindahkan file foto.";
//         }
//     } else {
//         echo "Tidak ada file foto yang diunggah atau terjadi kesalahan dalam unggah file.";
//     }
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan data dari form
    // $pas_poto = mysqli_real_escape_string($koneksi, $_POST['pas_poto']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $kabkota = mysqli_real_escape_string($koneksi, $_POST['kabkota']);
    $provinsi = mysqli_real_escape_string($koneksi, $_POST['provinsi']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $asrama = mysqli_real_escape_string($koneksi, $_POST['asrama']);
    $pembina = mysqli_real_escape_string($koneksi, $_POST['pembina']);
    $muhafizh = mysqli_real_escape_string($koneksi, $_POST['muhafizh']);
    $sekolah_asal = mysqli_real_escape_string($koneksi, $_POST['sekolah_asal']);
    $cita = mysqli_real_escape_string($koneksi, $_POST['cita']);
    $alamat_medsos = mysqli_real_escape_string($koneksi, $_POST['alamat_medsos']);
    $riwayat_penyakit = mysqli_real_escape_string($koneksi, $_POST['riwayat_penyakit']);
    $alergi = mysqli_real_escape_string($koneksi, $_POST['alergi']);
    $anakke = mysqli_real_escape_string($koneksi, $_POST['anakke']);
    $bersaudara = mysqli_real_escape_string($koneksi, $_POST['bersaudara']);
    $disenangi = mysqli_real_escape_string($koneksi, $_POST['disenangi']);
    $tidak_disenangi = mysqli_real_escape_string($koneksi, $_POST['tidak_disenangi']);
    $nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
    $pekerjaan_ayah = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ayah']);
    $hp_ayah = mysqli_real_escape_string($koneksi, $_POST['hp_ayah']);
    $nama_ibu = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
    $pekerjaan_ibu = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ibu']);
    $hp_ibu = mysqli_real_escape_string($koneksi, $_POST['hp_ibu']);
    $karakter_disukai = mysqli_real_escape_string($koneksi, $_POST['karakter_disukai']);
    $karakter_tidakdisukai = mysqli_real_escape_string($koneksi, $_POST['karakter_tidakdisukai']);
    $kelebihan = mysqli_real_escape_string($koneksi, $_POST['kelebihan']);
    $kekurangan = mysqli_real_escape_string($koneksi, $_POST['kekurangan']);
    $motto = mysqli_real_escape_string($koneksi, $_POST['motto']);

    // Perbarui data pada tabel tahfizh_data
    $query = "UPDATE portopolio_isi SET pas_poto='$pas_poto', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', kabkota='$kabkota', provinsi='$provinsi', kelas='$kelas', asrama='$asrama', pembina='$pembina', muhafizh='$muhafizh', sekolah_asal='$sekolah_asal', cita='$cita', alamat_medsos='$alamat_medsos', riwayat_penyakit='$riwayat_penyakit', alergi='$alergi', anakke='$anakke', bersaudara='$bersaudara', disenangi='$disenangi', tidak_disenangi='$tidak_disenangi', nama_ayah='$nama_ayah', pekerjaan_ayah='$pekerjaan_ayah', hp_ayah='$hp_ayah', nama_ibu='$nama_ibu', pekerjaan_ibu='$pekerjaan_ibu', hp_ibu='$hp_ibu', karakter_disukai='$karakter_disukai', karakter_tidakdisukai='$karakter_tidakdisukai', kelebihan='$kelebihan', kekurangan='$kekurangan', motto='$motto' WHERE nis='$nis'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data telah berhasil diperbarui.";
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi);
    }
}

// Dapatkan data santri berdasarkan NIS yang diterima dari parameter URL
$nis = $_GET['nis'];
$query = "SELECT * FROM portopolio_isi WHERE nis='$nis'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Edit Data Santri</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e88e5;
            --secondary-color: #64b5f6;
            --background-color: #f5f5f5;
            --text-color: #333;
            --input-bg: #fff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: var(--input-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 28px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--primary-color);
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--secondary-color);
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="date"]:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #1565c0;
        }

        .button {
            text-align: center;
            margin-bottom: 20px;
        }

        .button a {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .button a:hover {
            background-color: #42a5f5;
        }

        @media (max-width: 390px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .form-group input[type="text"],
            .form-group input[type="date"],
            .form-group input[type="file"] {
                font-size: 14px;
            }

            .form-group input[type="submit"] {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="button">
                <a href="hometamu.php">Kembali</a>
            </div>
        <h2>Edit Data Santri</h2>
        <form action="edit_datasantri_portopoliotamu.php" method="post" enctype="multipart/form-data">
            <!-- <div class="form-group">
                <label>Foto Santri:</label>
                <input type="file" name="pas_poto" accept=".jpg, .jpeg, .png">
            </div> -->
            <div class="form-group">
                <label>Nama Santri:</label>
                <input type="text" name="nama" value="<?php echo $row['nama']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>"readonly>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']; ?>"readonly>
            </div>
            <div class="form-group">
                <label>NIS:</label>
                <input type="text" name="nis" value="<?php echo $row['nis']; ?>"readonly>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>">
            </div>
            <div class="form-group">
                <label>Kab./Kota:</label>
                <input type="text" name="kabkota" value="<?php echo $row['kabkota']; ?>">
            </div>
            <div class="form-group">
                <label>Provinsi:</label>
                <input type="text" name="provinsi" value="<?php echo $row['provinsi']; ?>">
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="kelas" value="<?php echo $row['kelas']; ?>"readonly>
            </div>
            <div class="form-group">
                <label>Asrama:</label>
                <input type="text" name="asrama" value="<?php echo $row['asrama']; ?>"readonly>
            </div>
            <div class="form-group">
                <label>Pembina:</label>
                <input type="text" name="pembina" value="<?php echo $row['pembina']; ?>"readonly>
            </div>
            <div class="form-group">
                <label>Muhafizh:</label>
                <input type="text" name="muhafizh" value="<?php echo $row['muhafizh']; ?>"readonly>
            </div>
            <div class="form-group">
                <label>Sekolah Asal:</label>
                <input type="text" name="sekolah_asal" value="<?php echo $row['sekolah_asal']; ?>">
            </div>
            <div class="form-group">
                <label>Cita-cita:</label>
                <input type="text" name="cita" value="<?php echo $row['cita']; ?>">
            </div>
            <div class="form-group">
                <label>Alamat Medsos:</label>
                <input type="text" name="alamat_medsos" value="<?php echo $row['alamat_medsos']; ?>">
            </div>
            <div class="form-group">
                <label>Riwayat Penyakit:</label>
                <input type="text" name="riwayat_penyakit" value="<?php echo $row['riwayat_penyakit']; ?>">
            </div>
            <div class="form-group">
                <label>Alergi:</label>
                <input type="text" name="alergi" value="<?php echo $row['alergi']; ?>">
            </div>
            <div class="form-group">
                <label>Anak Ke-:</label>
                <input type="text" name="anakke" value="<?php echo $row['anakke']; ?>">
            </div>
            <div class="form-group">
                <label>Dari Bersaudara:</label>
                <input type="text" name="bersaudara" value="<?php echo $row['bersaudara']; ?>">
            </div>
            <div class="form-group">
                <label>Hal Yang Disenangi:</label>
                <input type="text" name="disenangi" value="<?php echo $row['disenangi']; ?>">
            </div>
            <div class="form-group">
                <label>Hal Yang Tidak Disenangi</label>
                <input type="text" name="tidak_disenangi" value="<?php echo $row['tidak_disenangi']; ?>">
            </div>
            <div class="form-group">
                <label>Nama Ayah:</label>
                <input type="text" name="nama_ayah" value="<?php echo $row['nama_ayah']; ?>">
            </div>
            <div class="form-group">
                <label>Pekerjaan Ayah:</label>
                <input type="text" name="pekerjaan_ayah" value="<?php echo $row['pekerjaan_ayah']; ?>">
            </div>
            <div class="form-group">
                <label>No. Hp Ayah:</label>
                <input type="text" name="hp_ayah" value="<?php echo $row['hp_ayah']; ?>">
            </div>
            <div class="form-group">
                <label>Nama Ibu:</label>
                <input type="text" name="nama_ibu" value="<?php echo $row['nama_ibu']; ?>">
            </div>
            <div class="form-group">
                <label>Pekerjaan Ibu:</label>
                <input type="text" name="pekerjaan_ibu" value="<?php echo $row['pekerjaan_ibu']; ?>">
            </div>
            <div class="form-group">
                <label>No. Hp Ibu:</label>
                <input type="text" name="hp_ibu" value="<?php echo $row['hp_ibu']; ?>">
            </div>
            <div class="form-group">
                <label>Karakter Yang Disukai:</label>
                <input type="text" name="karakter_disukai" value="<?php echo $row['karakter_disukai']; ?>">
            </div>
            <div class="form-group">
                <label>Karakter Yang Tidak Disukai</label>
                <input type="text" name="karakter_tidakdisukai" value="<?php echo $row['karakter_tidakdisukai']; ?>">
            </div>
            <div class="form-group">
                <label>Kelebihan Saya:</label>
                <input type="text" name="kelebihan" value="<?php echo $row['kelebihan']; ?>">
            </div>
            <div class="form-group">
                <label>Kekurangan yang akan saya perbaiki:</label>
                <input type="text" name="kekurangan" value="<?php echo $row['kekurangan']; ?>">
            </div>
            <div class="form-group">
                <label>Motto Hidup:</label>
                <input type="text" name="motto" value="<?php echo $row['motto']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan">
            </div>
        </form>
    </div>
</body>
</html>
