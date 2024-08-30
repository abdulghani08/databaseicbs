<?php
require_once __DIR__ . '/vendor/autoload.php'; // Ubah path sesuai dengan kebutuhan Anda

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('chroot', '/public_html/harau.santriicbs.com');
$dompdf = new Dompdf($options);

// Ambil data dari database atau sesuai dengan kebutuhan Anda
$nis = $_GET['nis'];
$nama = $_GET['nama'];

// Buat koneksi ke database
include "connection.php";
$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data biodata santri dari tabel portopolio_isi
$query = "SELECT * FROM portopolio_isi WHERE nis='$nis' AND nama='$nama'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);

// Ambil data Minat Bakat dari tabel minat_bakat_isi
$minat_bakat_html = '';
$minat_bakat_query = "SELECT * FROM minat_bakat_isi WHERE nis='$nis'";
$minat_bakat_result = mysqli_query($koneksi, $minat_bakat_query);
if (mysqli_num_rows($minat_bakat_result) > 0) {
    $minat_bakat_html = '
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminatan</th>
                    <th>Jenis Peminatan</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1;
    while ($minat_bakat_data = mysqli_fetch_array($minat_bakat_result)) {
        $minat_bakat_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $minat_bakat_data['bakat'] . '</td>
                        <td>' . $minat_bakat_data['jenis'] . '</td>
                    </tr>';
        $no++;
    }
    $minat_bakat_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel pengalaman_organisasi_isi
$pengalaman_organisasi_html = '';
$pengalaman_organisasi_query = "SELECT * FROM pengalaman_organisasi_isi WHERE nis='$nis'";
$pengalaman_organisasi_result = mysqli_query($koneksi, $pengalaman_organisasi_query);
if (mysqli_num_rows($pengalaman_organisasi_result) > 0) {
    $pengalaman_organisasi_html = '
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
            <tbody>';
    $no = 1;
    while ($pengalaman_organisasi_data = mysqli_fetch_array($pengalaman_organisasi_result)) {
        $pengalaman_organisasi_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $pengalaman_organisasi_data['nama_organisasi'] . '</td>
                        <td>' . $pengalaman_organisasi_data['jabatan'] . '</td>
                        <td>' . $pengalaman_organisasi_data['periode'] . '</td>
                        <td>' . $pengalaman_organisasi_data['tingkat'] . '</td>
                    </tr>';
        $no++;
    }
    $pengalaman_organisasi_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel kegiatan_tersertifikasi_isi
$kegiatan_tersertifikasi_html = '';
$kegiatan_tersertifikasi_query = "SELECT * FROM kegiatan_tersertifikasi_isi WHERE nis='$nis'";
$kegiatan_tersertifikasi_result = mysqli_query($koneksi, $kegiatan_tersertifikasi_query);
if (mysqli_num_rows($kegiatan_tersertifikasi_result) > 0) {
    $kegiatan_tersertifikasi_html = '
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
            <tbody>';
    $no = 1;
    while ($kegiatan_tersertifikasi_data = mysqli_fetch_array($kegiatan_tersertifikasi_result)) {
        $kegiatan_tersertifikasi_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $kegiatan_tersertifikasi_data['nama_kegiatan'] . '</td>
                        <td>' . $kegiatan_tersertifikasi_data['waktu_kegiatan'] . '</td>
                        <td>' . $kegiatan_tersertifikasi_data['penyelenggara'] . '</td>
                        <td>' . $kegiatan_tersertifikasi_data['tingkat'] . '</td>
                    </tr>';
        $no++;
    }
    $kegiatan_tersertifikasi_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel kepesantrenan_isi
$kepesantrenan_html = '';
$kepesantrenan_query = "SELECT * FROM kepesantrenan_isi WHERE nis='$nis'";
$kepesantrenan_result = mysqli_query($koneksi, $kepesantrenan_query);
if (mysqli_num_rows($kepesantrenan_result) > 0) {
    $kepesantrenan_html = '
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Ujian</th>
                    <th>Nilai</th>
                    <th>Penguji</th>
                    <th>Keterangan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1;
    while ($kepesantrenan_data = mysqli_fetch_array($kepesantrenan_result)) {
        $kepesantrenan_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $kepesantrenan_data['tanggal'] . '</td>
                        <td>' . $kepesantrenan_data['jenis'] . '</td>
                        <td>' . $kepesantrenan_data['nilai'] . '</td>
                        <td>' . $kepesantrenan_data['penguji'] . '</td>
                        <td>' . $kepesantrenan_data['keterangan'] . '</td>
                        <td>' . $kepesantrenan_data['catatan'] . '</td>
                    </tr>';
        $no++;
    }
    $kepesantrenan_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel tasmik_isi
$tasmik_html = '';
$tasmik_query = "SELECT * FROM tahfizh_ujian WHERE nis='$nis'";
$tasmik_result = mysqli_query($koneksi, $tasmik_query);
if (mysqli_num_rows($tasmik_result) > 0) {
    $tasmik_html = '
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nilai</th>
                    <th>keterangan</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1;
    while ($tasmik_data = mysqli_fetch_array($tasmik_result)) {
        $tasmik_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $tasmik_data['tanggal'] . '</td>
                        <td>' . $tasmik_data['ujian'] . '</td>
                        <td>' . $tasmik_data['nilai'] . '</td>
                    </tr>';
        $no++;
    }
    $tasmik_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel hafalan_tahfizh_isi
$hafalan_tahfizh_html = '';
$hafalan_tahfizh_query = "SELECT * FROM tahfizh_hafalan WHERE nis='$nis'";
$hafalan_tahfizh_result = mysqli_query($koneksi, $hafalan_tahfizh_query);
if (mysqli_num_rows($hafalan_tahfizh_result) > 0) {
    $hafalan_tahfizh_html = '
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Hafalan</th>
                    <th>Nilai</th>
                    <th>Total Hafalan (Halaman)</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1;
    while ($hafalan_tahfizh_data = mysqli_fetch_array($hafalan_tahfizh_result)) {
        $hafalan_tahfizh_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $hafalan_tahfizh_data['tanggal'] . '</td>
                        <td>' . $hafalan_tahfizh_data['hafalan'] . '</td>
                        <td>' . $hafalan_tahfizh_data['nilai'] . '</td>
                        <td>' . $hafalan_tahfizh_data['total_hafalan'] . '</td>
                    </tr>';
        $no++;
    }
    $hafalan_tahfizh_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel ujian_tahfizh_isi
$ujian_tahfizh_html = '';
$ujian_tahfizh_query = "SELECT * FROM tasmik_isi WHERE nis='$nis'";
$ujian_tahfizh_result = mysqli_query($koneksi, $ujian_tahfizh_query);
if (mysqli_num_rows($ujian_tahfizh_result) > 0) {
    $ujian_tahfizh_html = '
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Hafalan</th>
                    <th>Nilai</th>
                    <th>Total Halaman</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1;
    while ($ujian_tahfizh_data = mysqli_fetch_array($ujian_tahfizh_result)) {
        $ujian_tahfizh_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $ujian_tahfizh_data['tanggal'] . '</td>
                        <td>' . $ujian_tahfizh_data['ujian'] . '</td>
                        <td>' . $ujian_tahfizh_data['nilai'] . '</td>
                        <td>' . $ujian_tahfizh_data['total_halaman'] . '</td>
                    </tr>';
        $no++;
    }
    $ujian_tahfizh_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel prestasi_isi
$prestasi_html = '';
$prestasi_query = "SELECT * FROM prestasi_isi WHERE nis='$nis'";
$prestasi_result = mysqli_query($koneksi, $prestasi_query);
if (mysqli_num_rows($prestasi_result) > 0) {
    $prestasi_html = '
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
            <tbody>';
    $no = 1;
    while ($prestasi_data = mysqli_fetch_array($prestasi_result)) {
        $prestasi_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $prestasi_data['nama_prestasi'] . '</td>
                        <td>' . $prestasi_data['penyelenggara'] . '</td>
                        <td>' . $prestasi_data['waktu'] . '</td>
                        <td>' . $prestasi_data['tingkat'] . '</td>
                        <td>' . $prestasi_data['juara'] . '</td>
                    </tr>';
        $no++;
    }
    $prestasi_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel kedisiplinan_isi
$kedisiplinan_html = '';
$kedisiplinan_query = "SELECT * FROM disiplin_isi WHERE nis='$nis'";
$kedisiplinan_result = mysqli_query($koneksi, $kedisiplinan_query);
if (mysqli_num_rows($kedisiplinan_result) > 0) {
    $kedisiplinan_html = '
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggaran</th>
                    <th>Poin Pelanggaran</th>
                    <th>Bentuk Hukuman</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1;
    while ($kedisiplinan_data = mysqli_fetch_array($kedisiplinan_result)) {
        $kedisiplinan_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $kedisiplinan_data['pelanggaran'] . '</td>
                        <td>' . $kedisiplinan_data['poin'] . '</td>
                        <td>' . $kedisiplinan_data['hukuman'] . '</td>
                    </tr>';
        $no++;
    }
    $kedisiplinan_html .= '</tbody>
        </table>';
}

// Ambil data Minat Bakat dari tabel perizinan_isi
$perizinan_html = '';
$perizinan_query = "SELECT * FROM perizinan_isi WHERE nis='$nis'";
$perizinan_result = mysqli_query($koneksi, $perizinan_query);
if (mysqli_num_rows($perizinan_result) > 0) {
    $perizinan_html = '
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
            <tbody>';
    $no = 1;
    while ($perizinan_data = mysqli_fetch_array($perizinan_result)) {
        $perizinan_html .= '<tr>
                        <td>' . $no . '</td>
                        <td>' . $perizinan_data['daritanggal'] . '</td>
                        <td>' . $perizinan_data['sampaitanggal'] . '</td>
                        <td>' . $perizinan_data['keperluan'] . '</td>
                        <td>' . $perizinan_data['durasi'] . '</td>
                    </tr>';
        $no++;
    }
    $perizinan_html .= '</tbody>
        </table>';
}

// Mulai proses pembuatan PDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);
$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Santri</title>
    <style>
        @page {
            margin: 2cm;
            border: 2px solid #333;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        h2 {
            color: #1a5f7a;
            margin: 0;
            padding: 10px 0;
            border-bottom: 2px solid #1a5f7a;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
            width: 30%;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .section-title {
            background-color: #1a5f7a;
            color: white;
            padding: 10px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>BIODATA SANTRI</h2>
    </div>
    <table>
        <tr>
            <th>Nama Santri</th>
            <td>' . $data['nama'] . '</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>' . $data['tempat_lahir'] . '</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>' . $data['tanggal_lahir'] . '</td>
        </tr>
        <tr>
            <th>NIS</th>
            <td>' . $data['nis'] . '</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>' . $data['alamat'] . '</td>
        </tr>
        <tr>
            <th>Kab./Kota</th>
            <td>' . $data['kabkota'] . '</td>
        </tr>
        <tr>
            <th>Provinsi</th>
            <td>' . $data['provinsi'] . '</td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>' . $data['kelas'] . '</td>
        </tr>
        <tr>
            <th>Asrama</th>
            <td>' . $data['asrama'] . '</td>
        </tr>
        <tr>
            <th>Pembina</th>
            <td>' . $data['pembina'] . '</td>
        </tr>
        <tr>
            <th>Muhafizh</th>
            <td>' . $data['muhafizh'] . '</td>
        </tr>
        <tr>
            <th>Sekolah Asal</th>
            <td>' . $data['sekolah_asal'] . '</td>
        </tr>
        <tr>
            <th>Cita-cita</th>
            <td>' . $data['cita'] . '</td>
        </tr>
        <tr>
            <th>Alamat Medsos</th>
            <td>' . $data['alamat_medsos'] . '</td>
        </tr>
        <tr>
            <th>Riwayat Penyakit</th>
            <td>' . $data['riwayat_penyakit'] . '</td>
        </tr>
        <tr>
            <th>Alergi</th>
            <td>' . $data['alergi'] . '</td>
        </tr>
        <tr>
            <th>Anak Ke-</th>
            <td>' . $data['anakke'] . '</td>
        </tr>
        <tr>
            <th>Dari Bersaudara</th>
            <td>' . $data['bersaudara'] . '</td>
        </tr>
        <tr>
            <th>Hal Yang Disenangi</th>
            <td>' . $data['disenangi'] . '</td>
        </tr>
        <tr>
            <th>Hal Yang Tidak Disenangi</th>
            <td>' . $data['tidak_disenangi'] . '</td>
        </tr>
        <tr>
            <th>Nama Ayah</th>
            <td>' . $data['nama_ayah'] . '</td>
        </tr>
        <tr>
            <th>Pekerjaan Ayah</th>
            <td>' . $data['pekerjaan_ayah'] . '</td>
        </tr>
        <tr>
            <th>No Hp Ayah</th>
            <td>' . $data['hp_ayah'] . '</td>
        </tr>
        <tr>
            <th>Nama Ibu</th>
            <td>' . $data['nama_ibu'] . '</td>
        </tr>
        <tr>
            <th>Pekerjaan Ibu</th>
            <td>' . $data['pekerjaan_ibu'] . '</td>
        </tr>
        <tr>
            <th>No Hp Ibu</th>
            <td>' . $data['hp_ibu'] . '</td>
        </tr>
        <tr>
            <th>Karakter Yang Disukai</th>
            <td>' . $data['karakter_disukai'] . '</td>
        </tr>
        <tr>
            <th>Karakter Yang Tidak Disukai</th>
            <td>' . $data['karakter_tidakdisukai'] . '</td>
        </tr>
        <tr>
            <th>Kelebihan Saya</th>
            <td>' . $data['kelebihan'] . '</td>
        </tr>
        <tr>
            <th>Kekurangan Yang Akan Saya Perbaiki</th>
            <td>' . $data['kekurangan'] . '</td>
        </tr>
        <tr>
            <th>Motto Hidup</th>
            <td>' . $data['motto'] . '</td>
        </tr>
        <!-- Tambahkan informasi biodata lainnya sesuai kebutuhan -->
    </table>
    <div class="section-title"><center>MINAT BAKAT</center></div>
    ' . $minat_bakat_html . '

    <div class="section-title"><center>PENGALAMAN ORGANISASI</center></div>
    ' . $pengalaman_organisasi_html . '

    <div class="section-title"><center>KEGIATAN TERSERTIFIKASI</center></div>
    ' . $kegiatan_tersertifikasi_html . '

    <div class="section-title"><center>UJIAN KEPESANTRENAN</center></div>
    ' . $kepesantrenan_html . '

    <div class="section-title"><center>UJIAN TASMIK</center></div>
    ' . $tasmik_html . '

    <div class="section-title"><center>HAFALAN TAHFIZH</center></div>
    ' . $hafalan_tahfizh_html . '

    <div class="section-title"><center>UJIAN TAHFIZH</center></div>
    ' . $ujian_tahfizh_html . '

    <div class="section-title"><center>PRESTASI</center></div>
    ' . $prestasi_html . '

    <div class="section-title"><center>KEDISIPLINAN</center></div>
    ' . $kedisiplinan_html . '

    <div class="section-title"><center>PERIZINAN</center></div>
    ' . $perizinan_html . '
</body>

</html>';

$dompdf->loadHtml($html);

// Atur ukuran dan orientasi halaman
$dompdf->setPaper('A4', 'portrait');

// Render HTML sebagai PDF
$dompdf->render();

// Tampilkan PDF dalam browser atau simpan ke file
$dompdf->stream('biodata_santri.pdf', array('Attachment' => 0));
?>
