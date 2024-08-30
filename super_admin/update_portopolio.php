<?php
// session_start();
include "../connection.php";
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// if (empty($_SESSION['username'])) {
//     die("Anda belum login");
// }

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data dari tabel tahfizh_data berdasarkan NIS dan Nama yang dikirim melalui parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];
$query = "SELECT * FROM portopolio_isi WHERE nis='$nis' AND nama='$nama'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Update Portopolio</title>
    <link rel="shortcut icon" href="../logo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2E8B57;    /* Sea Green */
    --secondary-color: #3CB371;  /* Medium Sea Green */
    --text-color: #333;
    --background-color: #E8F5E9;         /* Light Green background */
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
            padding: 10px;
        }

        .container {
            max-width: 100%;
            background-color: var(--input-bg);
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            overflow: hidden;
        }

        h2, h3 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
        }

        h3 {
            font-size: 20px;
            margin-top: 30px;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-button img {
            width: 30px;
            transition: transform 0.3s ease;
        }

        .back-button img:hover {
            transform: scale(1.1);
        }

        .add-button {
            text-align: center;
            margin: 20px 0;
        }

        .add-button input[type="button"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-button input[type="button"]:hover {
            background-color: #1565c0;
        }
        .table-wrapper {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

        table {
            min-width: 100%;
            width: auto;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: var(--input-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .kurang-lancar td {
            color: #f44336;
            font-weight: 500;
        }

        .total-hafalan {
            margin-top: 20px;
            text-align: center;
            font-weight: 500;
            color: var(--primary-color);
        }

        .chart-container {
            max-width: 100%;
            margin-top: 30px;
        }

        @media (max-width: 390px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            h2 {
                font-size: 22px;
            }

            h3 {
                font-size: 18px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }
        }
        @media (max-width: 767px) {
    .table-wrapper {
        margin: 0 -15px;
        padding: 0 15px;
    }

    table {
        font-size: 14px;
    }

    th, td {
        padding: 8px 10px;
    }
}
    </style>
</head>

<body>
    <div class="container">
    <div>
    <a href="dt_portopolio_superadmin.php"><img src="../back_icon.png" alt="home" style="width: 30px;"></a>
</div>

<?php
// Ambil data foto santri dari database
$query_foto = "SELECT pas_poto FROM portopolio_isi WHERE nis='$nis'";
$result_foto = mysqli_query($koneksi, $query_foto);
$row_foto = mysqli_fetch_assoc($result_foto);
$pas_poto = $row_foto['pas_poto'];
?>

<h2 style="text-align: center; margin-bottom: 10px; font-size: 24px;">BIODATA SANTRI</h2>

<div class="add-button" style="text-align: center;">
<input type="button" value="Download PDF" onclick="window.open('../generate_pdf.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>', '_blank')">
</div>


        <!-- <div class="add-button">
            <a href="form_tambahdata_setoran.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" style="background-color: #4CAF50;">Tambah Hafalan</a>
        </div> -->
        <div class="details">
        <table>
            <!-- <tr>
            <th>Pas Foto Santri</th>
            <td>
            <div style="text-align: center; margin-bottom: 20px;">
        <img src="<?php echo $pas_poto; ?>" alt="Pas Foto Santri" style="width: 200px; height: 200px; border-radius: 50%;">
    </div>
            </td>
            </tr> -->
            <tr>
            <th>Nama Santri</th>
            <td><?php echo $data['nama']; ?></td>
            </tr>
            <tr>
            <th>Tempat Lahir</th>
            <td><?php echo $data['tempat_lahir']; ?></td>
            </tr>
            <tr>
            <th>Tanggal Lahir</th>
            <td><?php echo $data['tanggal_lahir']; ?></td>
            </tr>
            <tr>
            <th>NIS</th>
            <td><?php echo $data['nis']; ?></td>
            </tr>
            <tr>
            <th>Alamat</th>
            <td><?php echo $data['alamat']; ?></td>
            </tr>
            <tr>
            <th>Kab./Kota</th>
            <td><?php echo $data['kabkota']; ?></td>
            </tr>
            <tr>
            <th>Provinsi</th>
            <td><?php echo $data['provinsi']; ?></td>
            </tr>
            <tr>
            <th>Kelas</th>
            <td><?php echo $data['kelas']; ?></td>
            </tr>
            <tr>
            <th>Asrama</th>
            <td><?php echo $data['asrama']; ?></td>
            </tr>
            <tr>
            <th>Pembina</th>
            <td><?php echo $data['pembina']; ?></td>
            </tr>
            <tr>
            <th>Muhafizh</th>
            <td><?php echo $data['muhafizh']; ?></td>
            </tr>
            <tr>
            <th>Sekolah Asal</th>
            <td><?php echo $data['sekolah_asal']; ?></td>
            </tr>
            <tr>
            <th>Cita-cita</th>
            <td><?php echo $data['cita']; ?></td>
            </tr>
            <tr>
            <th>Alamat Medsos</th>
            <td><?php echo $data['alamat_medsos']; ?></td>
            </tr>
            <tr>
            <th>Riwayat Penyakit</th>
            <td><?php echo $data['riwayat_penyakit']; ?></td>
            </tr>
            <tr>
            <th>Alergi</th>
            <td><?php echo $data['alergi']; ?></td>
            </tr>
            <tr>
            <th>Anake Ke-</th>
            <td><?php echo $data['anakke']; ?></td>
            </tr>
            <tr>
            <th>Dari Bersaudara</th>
            <td><?php echo $data['bersaudara']; ?></td>
            </tr>
            <tr>
            <th>Hal Yang disenangi</th>
            <td><?php echo $data['disenangi']; ?></td>
            </tr>
            <tr>
            <th>Hal Yang Tidak Disenangi</th>
            <td><?php echo $data['tidak_disenangi']; ?></td>
            </tr>
            <tr>
            <th>Nama Ayah</th>
            <td><?php echo $data['nama_ayah']; ?></td>
            </tr>
            <tr>
            <th>Pekerjaan Ayah</th>
            <td><?php echo $data['pekerjaan_ayah']; ?></td>
            </tr>
            <tr>
            <th>No Hp Ayah</th>
            <td><?php echo $data['hp_ayah']; ?></td>
            </tr>
            <tr>
            <th>Nama Ibu</th>
            <td><?php echo $data['nama_ibu']; ?></td>
            </tr>
            <tr>
            <th>Pekerjaan Ibu</th>
            <td><?php echo $data['pekerjaan_ibu']; ?></td>
            </tr>
            <tr>
            <th>No Hp Ibu</th>
            <td><?php echo $data['hp_ibu']; ?></td>
            </tr>
            <tr>
            <th>Karakter Yang Disukai</th>
            <td><?php echo $data['karakter_disukai']; ?></td>
            </tr>
            <tr>
            <th>Karakter Yang Tidak Disukai</th>
            <td><?php echo $data['karakter_tidakdisukai']; ?></td>
            </tr>
            <tr>
            <th>Kelebihan Saya</th>
            <td><?php echo $data['kelebihan']; ?></td>
            </tr>
            <tr>
            <th>Kekurangan Yang Akan Saya Perbaiki</th>
            <td><?php echo $data['kekurangan']; ?></td>
            </tr>
            <tr>
            <th>Motto Hidup</th>
            <td><?php echo $data['motto']; ?></td>
            </tr>
        </table>
        </div>
        <center><h3>Minat Bakat</h3></center>
        <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminatan</th>
                    <th>Jenis Peminatan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM minat_bakat_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['bakat']; ?></td>
                        <td><?php echo $setoran_data['jenis']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>

        <h3><center>Pengalaman Organisasi</center></h3>
        <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Organisasi</th>
                    <th>Jabatan</th>
                    <th>Periode</th>
                    <th>Tingkat</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM pengalaman_organisasi_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['nama_organisasi']; ?></td>
                        <td><?php echo $setoran_data['jabatan']; ?></td>
                        <td><?php echo $setoran_data['periode']; ?></td>
                        <td><?php echo $setoran_data['tingkat']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>

        <br>
        <h3><center>Pengalaman Kegiatan Tersertifikasi</center></h3>
        <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Waktu Kegiatan</th>
                    <th>Penyelenggara</th>
                    <th>Tingkat</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM kegiatan_tersertifikasi_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['nama_kegiatan']; ?></td>
                        <td><?php echo $setoran_data['waktu_kegiatan']; ?></td>
                        <td><?php echo $setoran_data['penyelenggara']; ?></td>
                        <td><?php echo $setoran_data['tingkat']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>
        <center><h3>Rekapan Ujian Kepesantrenan</h3></center>
        <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Ujian</th>
                    <th>Jenis Ujian</th>
                    <th>Nilai</th>
                    <th>Penguji</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM kepesantrenan_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    $nilai = $setoran_data['nilai'];
                    $keterangan = '';
                    if ($nilai == 'A') {
                        $keterangan = 'Sangat Baik';
                    } elseif ($nilai == 'B') {
                        $keterangan = 'Baik';
                    } elseif ($nilai == 'C') {
                        $keterangan = 'Kurang Lancar';
                    } elseif ($nilai == 'D') {
                        $keterangan = 'Tidak Lancar';
                    }
                    
                    ?>
                    <tr <?php if ($nilai == 'D') echo 'class="kurang-lancar"'; ?>>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['tanggal']; ?></td>
                        <td><?php echo $setoran_data['jenis']; ?></td>
                        <td><?php echo $nilai; ?></td>
                        <td><?php echo $setoran_data['penguji']; ?></td>
                        <td><?php echo $keterangan; ?></td>
                        <td><?php echo $setoran_data['keterangan']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>
        <center><h3>Rekapan Ujian Tasmi'</h3></center>
        <div class="table-wrapper">
        <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Ujian</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $setoran_query = "SELECT * FROM tahfizh_ujian WHERE nis='$nis'";
            $setoran_result = mysqli_query($koneksi, $setoran_query);
            $no = 1;
            while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                $nilai = $setoran_data['nilai'];
                $keterangan = '';
                if ($nilai == 'A') {
                    $keterangan = 'Sangat Baik';
                } elseif ($nilai == 'B') {
                    $keterangan = 'Baik';
                } elseif ($nilai == 'C') {
                    $keterangan = 'Kurang Lancar';
                } elseif ($nilai == 'D') {
                    $keterangan = 'Tidak Lancar(Mengulang)';
                }
                ?>
                <!-- Tambahkan kelas "kurang-lancar" pada baris yang memiliki keterangan "Kurang Lancar" (C) -->
                <tr <?php if ($nilai == 'D') echo 'class="kurang-lancar"'; ?>>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $setoran_data['tanggal']; ?></td>
                    <td><?php echo $setoran_data['ujian']; ?></td>
                    <td><?php echo $nilai; ?></td>
                    <td><?php echo $keterangan; ?></td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
        </table>
        </div>
    <center><h3>Rekapan Hafalan</h3></center>
    <div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Hafalan</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Total Hafalan (Halaman)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $setoran_query = "SELECT * FROM tahfizh_hafalan WHERE nis='$nis'";
            $setoran_result = mysqli_query($koneksi, $setoran_query);
            $no = 1;
            while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                $nilai = $setoran_data['nilai'];
                $keterangan = '';
                if ($nilai == 'A') {
                    $keterangan = 'Sangat Baik';
                } elseif ($nilai == 'B') {
                    $keterangan = 'Baik';
                } elseif ($nilai == 'C') {
                    $keterangan = 'Kurang Lancar';
                } elseif ($nilai == 'D') {
                    $keterangan = 'Tidak Lancar';
                }
                ?>
                <!-- Tambahkan kelas "kurang-lancar" pada baris yang memiliki keterangan "Kurang Lancar" (C) -->
                <tr <?php if ($nilai == 'D') echo 'class="kurang-lancar"'; ?>>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $setoran_data['tanggal']; ?></td>
                    <td><?php echo $setoran_data['hafalan']; ?></td>
                    <td><?php echo $nilai; ?></td>
                    <td><?php echo $keterangan; ?></td>
                    <td><?php echo $setoran_data['total_hafalan']; ?></td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    </div>

    <center><h3>Rekapan Ujian Tahfizh</h3></center>
    <div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Hafalan</th>
            <th>Nilai</th>
            <th>Keterangan</th>
            <!-- <th>Total Hafalan (Halaman)</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $setoran_query = "SELECT * FROM tasmik_isi WHERE nis='$nis'";
        $setoran_result = mysqli_query($koneksi, $setoran_query);
        $no = 1;
        while ($setoran_data = mysqli_fetch_array($setoran_result)) {
            $nilai = $setoran_data['nilai'];
            $keterangan = '';
            if ($nilai == 'A') {
                $keterangan = 'Sangat Baik';
            } elseif ($nilai == 'B') {
                $keterangan = 'Baik';
            } elseif ($nilai == 'C') {
                $keterangan = 'Kurang Lancar';
            } elseif ($nilai == 'D') {
                $keterangan = 'Tidak Lancar';
            }
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $setoran_data['tanggal']; ?></td>
                <td><?php echo $setoran_data['ujian']; ?></td>
                <td><?php echo $nilai; ?></td>
                <td><?php echo $keterangan; ?></td>
                <!-- <td><?php echo $setoran_data['total_hafalan']; ?></td> -->
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>
</div>
    <div class="total-hafalan">
    <?php
    // Menghitung jumlah total hafalan
    $total_hafalan_query = "SELECT SUM(total_hafalan) AS total FROM tahfizh_hafalan WHERE nis='$nis'";
    $total_hafalan_result = mysqli_query($koneksi, $total_hafalan_query);
    $total_hafalan_data = mysqli_fetch_assoc($total_hafalan_result);
    $total_hafalan = $total_hafalan_data['total'];

    // Menghitung jumlah total hafalan per juz
    $total_hafalan_per_juz = 20; // Ubah sesuai dengan jumlah total hafalan per juz
    $jumlah_total_hafalan_per_juz = $total_hafalan / $total_hafalan_per_juz;
    ?>
    <p>Jumlah Total Hafalan: <?php echo $total_hafalan; ?> Halaman</p>
    <p>Jumlah Total Hafalan per Juz: <?php echo $jumlah_total_hafalan_per_juz; ?></p>
    </div>
    <center><h3>Grafik Kualitas Hafalan</h3></center>

    <canvas id="chart" style="max-width: 100%;"></canvas>


        <script>
            // Mendapatkan data nilai dari PHP
            <?php
            $nilai_a_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='A'";
            $nilai_a_result = mysqli_query($koneksi, $nilai_a_query);
            $nilai_a_data = mysqli_fetch_assoc($nilai_a_result);
            $nilai_a_total = $nilai_a_data['total'];

            $nilai_b_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='B'";
            $nilai_b_result = mysqli_query($koneksi, $nilai_b_query);
            $nilai_b_data = mysqli_fetch_assoc($nilai_b_result);
            $nilai_b_total = $nilai_b_data['total'];

            $nilai_c_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='C'";
            $nilai_c_result = mysqli_query($koneksi, $nilai_c_query);
            $nilai_c_data = mysqli_fetch_assoc($nilai_c_result);
            $nilai_c_total = $nilai_c_data['total'];

            $nilai_d_query = "SELECT COUNT(*) AS total FROM tahfizh_hafalan WHERE nis='$nis' AND nilai='D'";
            $nilai_d_result = mysqli_query($koneksi, $nilai_d_query);
            $nilai_d_data = mysqli_fetch_assoc($nilai_d_result);
            $nilai_d_total = $nilai_d_data['total'];
            ?>

                // Menampilkan diagram
                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['A (Sangat Baik)', 'B (Baik)', 'C (Kurang Lancar)', 'D (Tidak Lancar)'],
                        datasets: [{
                            label: 'Grafik',
                            data: [<?php echo $nilai_a_total; ?>, <?php echo $nilai_b_total; ?>, <?php echo $nilai_c_total; ?>, <?php echo $nilai_d_total; ?>],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
        </script>

        <center><h3>Rekapan Prestasi</h3></center>
        <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Prestasi</th>
                    <th>Penyelenggara</th>
                    <th>Tahun Diselenggarakan</th>
                    <th>Tingkat</th>
                    <th>Juara</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM prestasi_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['nama_prestasi']; ?></td>
                        <td><?php echo $setoran_data['penyelenggara']; ?></td>
                        <td><?php echo $setoran_data['waktu']; ?></td>
                        <td><?php echo $setoran_data['tingkat']; ?></td>
                        <td><?php echo $setoran_data['juara']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>

        <center><h3>Rekapan Kedisiplinan</h3></center>
        <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggaran</th>
                    <th>Poin Pelanggaran</th>
                    <th>Bentuk Hukuman</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM disiplin_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['pelanggaran']; ?></td>
                        <td><?php echo $setoran_data['poin']; ?></td>
                        <td><?php echo $setoran_data['hukuman']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>

        <div class="total-hafalan">
        <?php
        // Menghitung jumlah total POIN
        $total_hafalan_query = "SELECT SUM(poin) AS total FROM disiplin_isi WHERE nis='$nis'";
        $total_hafalan_result = mysqli_query($koneksi, $total_hafalan_query);
        $total_hafalan_data = mysqli_fetch_assoc($total_hafalan_result);
        $total_hafalan = $total_hafalan_data['total'];

        // Menghitung jumlah total hafalan per juz
        $total_hafalan_per_juz = 20; // Ubah sesuai dengan jumlah total hafalan per juz
        $jumlah_total_hafalan_per_juz = $total_hafalan / $total_hafalan_per_juz;
        ?>
        <p>Total Poin: <?php echo $total_hafalan; ?> POIN</p>
        </div>

        <center><h3>Rekapan Perizinan</h3></center>
        <div class="table-wrapper">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>Keperluan</th>
                    <th>Durasi (Hari)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data dari tabel prestasi_isi berdasarkan NIS -->
                <?php
                $setoran_query = "SELECT * FROM perizinan_isi WHERE nis='$nis'";
                $setoran_result = mysqli_query($koneksi, $setoran_query);
                $no = 1;
                while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $setoran_data['daritanggal']; ?></td>
                        <td><?php echo $setoran_data['sampaitanggal']; ?></td>
                        <td><?php echo $setoran_data['keperluan']; ?></td>
                        <td><?php echo $setoran_data['durasi']; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>


        

    </div>
</body>

</html>
