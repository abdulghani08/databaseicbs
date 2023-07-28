<?php
require_once('../tcpdf/tcpdf.php');
$nis = $_GET['nis'];
$nama = $_GET['nama'];
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); // Buat objek TCPDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nama Anda');
$pdf->SetTitle('Cetak Portopolio');
$pdf->SetMargins(15, 15, 15);// Set margin halaman
$pdf->AddPage(); // Tambahkan halaman baru
$koneksi = mysqli_connect("localhost", "sant5315_db_santri", "payakumbuh123", "sant5315_db_santri");// Koneksi ke database
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
$query = "SELECT * FROM putra_portopolio_isi WHERE nis = '$nis' AND nama = '$nama'";// Query untuk mengambil data dari tabel portopolio_isi berdasarkan NIS dan nama
$result = mysqli_query($koneksi, $query);
if ($result) {
    $data = mysqli_fetch_assoc($result);
    $html = '
        <center><h1>Biodata Santri</h1></center>
        <table style="border-collapse: collapse; background-color: #ffffff;">
            <tr>
                <td style="border: none;">Nama Santri</td>
                <td style="border: none;">:' . $nama . '</td>
            </tr>
            <tr>
                <td style="border: none;">Tempat Lahir</td>
                <td style="border: none;">:' . $data['tempat_lahir'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Tanggal Lahir</td>
                <td style="border: none;">:' . $data['tanggal_lahir'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">NIS</td>
                <td style="border: none;">:' . $nis . '</td>
            </tr>
            <tr>
                <td style="border: none;">Alamat</td>
                <td style="border: none;">:' . $data['alamat'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Kelas</td>
                <td style="border: none;">:' . $data['kelas'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Asrama</td>
                <td style="border: none;">:' . $data['asrama'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Pembina</td>
                <td style="border: none;">:' . $data['pembina'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Muhafizh</td>
                <td style="border: none;">:' . $data['muhafizh'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Sekolah Asal</td>
                <td style="border: none;">:' . $data['sekolah_asal'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Cita-cita</td>
                <td style="border: none;">:' . $data['cita'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Alamat Media Sosial</td>
                <td style="border: none;">:' . $data['alamat_medsos'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Riwayat Penyakit</td>
                <td style="border: none;">:' . $data['riwayat_penyakit'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Alergi</td>
                <td style="border: none;">:' . $data['alergi'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Anakke</td>
                <td style="border: none;">:' . $data['anakke'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Dari Bersaudara</td>
                <td style="border: none;">:' . $data['bersaudara'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Hal Yang Disenangi</td>
                <td style="border: none;">:' . $data['disenangi'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Hal Yang Tidak Disenangi</td>
                <td style="border: none;">:' . $data['tidak_disenangi'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Nama Ayah</td>
                <td style="border: none;">:' . $data['nama_ayah'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Pekerjaan Ayah</td>
                <td style="border: none;">:' . $data['pekerjaan_ayah'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">No. Hp Ayah</td>
                <td style="border: none;">:' . $data['hp_ayah'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Nama Ibu</td>
                <td style="border: none;">:' . $data['nama_ibu'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Pekerjaan Ibu</td>
                <td style="border: none;">:' . $data['pekerjaan_ibu'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">No. Hp Ibu</td>
                <td style="border: none;">:' . $data['hp_ibu'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Karakter Yang Disukai</td>
                <td style="border: none;">:' . $data['karakter_disukai'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Karakter Yang Tidak Disukai</td>
                <td style="border: none;">:' . $data['karakter_tidakdisukai'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Kelebihan Saya</td>
                <td style="border: none;">:' . $data['kelebihan'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Kekurangan yang akan saya perbaiki</td>
                <td style="border: none;">:' . $data['kekurangan'] . '</td>
            </tr>
            <tr>
                <td style="border: none;">Motto Hidup</td>
                <td style="border: none;">:' . $data['motto'] . '</td>
            </tr>
        </table>
    ';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage(); // Tambahkan halaman kedua
    $html = ' 
        <center><h3>Rekapan Hafalan</h3></center>
        <table style="background-color: white;">
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
    ';
    $setoran_query = "SELECT * FROM putra_tahfizh_hafalan WHERE nis='$nis'";
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
        // Tambahkan kelas "kurang-lancar" pada baris yang memiliki keterangan "Kurang Lancar" (C)
        $html .= '<tr' . ($nilai == 'D' ? ' class="kurang-lancar"' : '') . '>
            <td>' . $no . '</td>
            <td>' . $setoran_data['tanggal'] . '</td>
            <td>' . $setoran_data['hafalan'] . '</td>
            <td>' . $nilai . '</td>
            <td>' . $keterangan . '</td>
            <td>' . $setoran_data['total_hafalan'] . '</td>
        </tr>';
        $no++;
    }
    $html .= '
            </tbody>
        </table>
        <center><h3>Rekapan Prestasi</h3></center>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Prestasi</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>
                    <th>Tingkat</th>
                    <th>Juara</th>
                </tr>
            </thead>
            <tbody>
    ';
    $setoran_query = "SELECT * FROM putra_prestasi_isi WHERE nis='$nis'";
$setoran_result = mysqli_query($koneksi, $setoran_query);
$no = 1;
$html = ''; // Variabel untuk menyimpan elemen HTML
while ($setoran_data = mysqli_fetch_array($setoran_result)) {
    $html .= '<tr>';
    $html .= '<td>' . $no . '</td>';
    $html .= '<td>' . $setoran_data['nama_prestasi'] . '</td>';
    $html .= '<td>' . $setoran_data['penyelenggara'] . '</td>';
    $html .= '<td>' . $setoran_data['waktu'] . '</td>';
    $html .= '<td>' . $setoran_data['tingkat'] . '</td>';
    $html .= '<td>' . $setoran_data['juara'] . '</td>';
    $html .= '</tr>';
    $no++;
}
                $html .= '
                </tbody>
            </table>
            <center><h3>Rekapan Kedisiplinan</h3></center>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Iqob</th>
                </tr>
            </thead>
            <tbody>
    ';
    $setoran_query = "SELECT * FROM putra_disiplin_isi WHERE nis='$nis'";
$setoran_result = mysqli_query($koneksi, $setoran_query);
$no = 1;
$html = ''; // Variabel untuk menyimpan elemen HTML
while ($setoran_data = mysqli_fetch_array($setoran_result)) {
    $html .= '<tr>';
    $html .= '<td>' . $no . '</td>';
    $html .= '<td>' . $setoran_data['pelanggaran'] . '</td>';
    $html .= '<td>' . $setoran_data['poin'] . '</td>';
    $html .= '<td>' . $setoran_data['hukuman'] . '</td>';
    $html .= '</tr>';
    $no++;
}
                $html .= '
                </tbody>
            </table>

            <center><h3>Rekapan Perizinan</h3></center>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keperluan</th>
                    <th>Durasi (Hari)</th>
                </tr>
            </thead>
            <tbody>
    ';
    $setoran_query = "SELECT * FROM putra_perizinan_isi WHERE nis='$nis'";
$setoran_result = mysqli_query($koneksi, $setoran_query);
$no = 1;
$html = ''; // Variabel untuk menyimpan elemen HTML
while ($setoran_data = mysqli_fetch_array($setoran_result)) {
    $html .= '<tr>';
    $html .= '<td>' . $no . '</td>';
    $html .= '<td>' . $setoran_data['tanggal'] . '</td>';
    $html .= '<td>' . $setoran_data['keperluan'] . '</td>';
    $html .= '<td>' . $setoran_data['durasi'] . '</td>';
    $html .= '</tr>';
    $no++;
}
                $html .= '
                </tbody>
            </table>
            ';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('cetak_portopolio.pdf', 'D'); // Simpan file PDF
} else {
    echo "Query error: " . mysqli_error($koneksi);
}
mysqli_close($koneksi); // Tutup koneksi database
?>
