<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

// Query untuk mengambil data Sevilla
$query = "SELECT * FROM tamu_laporan_bw WHERE asrama IN ('granada 4', 'granada 5') ORDER BY tanggal DESC, asrama ASC";
$result = mysqli_query($koneksi, $query);

// Query untuk mengambil top 3 peringkat
$rankQuery = "SELECT nis, nama, asrama, kelas, 
    SUM(
        (CASE WHEN shalat_shubuh > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN shalat_dzuhur > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN shalat_ashar > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN shalat_maghrib > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN shalat_isya > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN shalat_qiyamul_lail > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN shalat_dhuha > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN menghafal > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN murajaah > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN membaca_almatsurat > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN membangunkan_orangtua > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN merapikan_sandal > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN menghidangkan_makanan > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN menjemur > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN tadarus_keluarga > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN menghadiri_kajian > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN membersihkan_kamar > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN membersihkan_rumah > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN membersihkan_wc > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN mencuci_piring > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN mencuci_pakaian > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN membaca_buku_agama > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN riyadhoh > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN mengenalkan_icbs > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN silaturahmi > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN jumlah_rawatib > 0 THEN 1 ELSE 0 END) +
        (CASE WHEN jumlah_tilawah > 0 THEN 1 ELSE 0 END)
    ) AS total_poin
FROM tamu_laporan_bw
WHERE asrama IN ('granada 4', 'granada 5')
GROUP BY nis, nama, asrama, kelas
ORDER BY total_poin DESC
LIMIT 3";

$rankResult = mysqli_query($koneksi, $rankQuery);

// Fungsi untuk menghitung skor
function hitungSkor($row) {
    $skor = 0;
    $total_aktivitas = 27; // Total aktivitas yang dihitung
    $kolom_skor = [
        'shalat_shubuh', 'shalat_dzuhur', 'shalat_ashar', 'shalat_maghrib', 'shalat_isya',
        'shalat_qiyamul_lail', 'shalat_dhuha', 'menghafal', 'murajaah', 'membaca_almatsurat',
        'membangunkan_orangtua', 'merapikan_sandal', 'menghidangkan_makanan', 'menjemur',
        'tadarus_keluarga', 'menghadiri_kajian', 'membersihkan_kamar', 'membersihkan_rumah',
        'membersihkan_wc', 'mencuci_piring', 'mencuci_pakaian', 'membaca_buku_agama',
        'riyadhoh', 'mengenalkan_icbs', 'silaturahmi'
    ];

    foreach ($kolom_skor as $kolom) {
        $skor += ($row[$kolom] > 0) ? 1 : 0;
    }

    // Perhitungan khusus untuk jumlah_rawatib dan jumlah_tilawah
    $skor += ($row['jumlah_rawatib'] > 0) ? 1 : 0;
    $skor += ($row['jumlah_tilawah'] > 0) ? 1 : 0;

    return $skor . '/' . $total_aktivitas;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan BW - Asrama Granada 4 & 5</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF8C00;
            --secondary-color: #FFA500;
            --text-color: #333;
            --bg-color: #FFF5E6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .table-container {
            overflow-x: auto;
        }

        .button-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .ranking-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .ranking-button:hover {
            background-color: var(--secondary-color);
        }

        .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modal.show {
    opacity: 1;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 90%;
    max-width: 600px;
    border-radius: 10px;
    transform: scale(0.7);
    opacity: 0;
    transition: all 0.3s ease;
}

.modal.show .modal-content {
    transform: scale(1);
    opacity: 1;
}

.ranking-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
}
.ranking-table th,
.ranking-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .ranking-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .ranking-table th,
        .ranking-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .ranking-table th {
            background-color: var(--primary-color);
            color: white;
        }

        .ranking-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: var(--secondary-color);
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        @media screen and (max-width: 1200px) {
            body {
                font-size: 14px;
            }

            .container {
                width: 100%;
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            .ranking-table {
        font-size: 12px;
    }

    .ranking-table th,
    .ranking-table td {
        padding: 6px;
    }
}

.table-container {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

            th, td {
                padding: 8px;
            }

            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
            @media screen and (max-width: 767px) {
    table {
        font-size: 12px;
    }

    th, td {
        padding: 6px;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <a href="rekapan_bw.php" class="back-button"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h1>Laporan BW - Asrama Granada 4 & 5</h1>

        <div class="button-container">
            <button id="rankingButton" class="ranking-button">Lihat Perankingan BW</button>
        </div>

        <div id="rankingModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Perankingan BW</h2>
                <table class="ranking-table">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Total Skor</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Asrama</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ranking = 1;
                        while ($row = mysqli_fetch_assoc($rankResult)) {
                            echo "<tr>";
                            echo "<td>{$ranking}</td>";
                            echo "<td>{$row['total_poin']}</td>";
                            echo "<td>{$row['nis']}</td>";
                            echo "<td>{$row['nama']}</td>";
                            echo "<td>{$row['asrama']}</td>";
                            echo "<td>{$row['kelas']}</td>";
                            echo "</tr>";
                            $ranking++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="table-container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>SKOR</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Asrama</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Shalat Shubuh</th>
                            <th>Shalat Dzuhur</th>
                            <th>Shalat Ashar</th>
                            <th>Shalat Maghrib</th>
                            <th>Shalat Isya</th>
                            <th>Qiyamul Lail</th>
                            <th>Shalat Dhuha</th>
                            <th>Menghafal Quran</th>
                            <th>Murajaah Hafalan</th>
                            <th>Baca Almatsurat</th>
                            <th>Bangunkan Orangtua Tahajjud</th>
                            <th>Merapikan Sandal</th>
                            <th>Menghidangkan Makanan</th>
                            <th>Menjemur/angkat Pakaian</th>
                            <th>Tadarus Keluarga</th>
                            <th>Menghadiri Kajian</th>
                            <th>Membersihkan Kamar</th>
                            <th>Membersihkan Rumah</th>
                            <th>Membersihkan Kamar Mandi</th>
                            <th>Mencuci Piring</th>
                            <th>Mencuci Pakaian</th>
                            <th>Membaca Buku Agama</th>
                            <th>Riyadhoh</th>
                            <th>Mengenalkan ICBS</th>
                            <th>Silaturahmi</th>
                            <th>Jumlah Rawatib (Rakaat)</th>
                            <th>Jumlah Tilawah (Lembar)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)): 
                            $skor = hitungSkor($row);
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $skor; ?></td>
                                <td><?php echo htmlspecialchars($row['nis']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['asrama']); ?></td>
                                <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                <td><?php echo htmlspecialchars($row['shalat_shubuh']); ?></td>
                                <td><?php echo htmlspecialchars($row['shalat_dzuhur']); ?></td>
                                <td><?php echo htmlspecialchars($row['shalat_ashar']); ?></td>
                                <td><?php echo htmlspecialchars($row['shalat_maghrib']); ?></td>
                                <td><?php echo htmlspecialchars($row['shalat_isya']); ?></td>
                                <td><?php echo htmlspecialchars($row['shalat_qiyamul_lail']); ?></td>
                                <td><?php echo htmlspecialchars($row['shalat_dhuha']); ?></td>
                                <td><?php echo htmlspecialchars($row['menghafal']); ?></td>
                                <td><?php echo htmlspecialchars($row['murajaah']); ?></td>
                                <td><?php echo htmlspecialchars($row['membaca_almatsurat']); ?></td>
                                <td><?php echo htmlspecialchars($row['membangunkan_orangtua']); ?></td>
                                <td><?php echo htmlspecialchars($row['merapikan_sandal']); ?></td>
                                <td><?php echo htmlspecialchars($row['menghidangkan_makanan']); ?></td>
                                <td><?php echo htmlspecialchars($row['menjemur']); ?></td>
                                <td><?php echo htmlspecialchars($row['tadarus_keluarga']); ?></td>
                                <td><?php echo htmlspecialchars($row['menghadiri_kajian']); ?></td>
                                <td><?php echo htmlspecialchars($row['membersihkan_kamar']); ?></td>
                                <td><?php echo htmlspecialchars($row['membersihkan_rumah']); ?></td>
                                <td><?php echo htmlspecialchars($row['membersihkan_wc']); ?></td>
                                <td><?php echo htmlspecialchars($row['mencuci_piring']); ?></td>
                                <td><?php echo htmlspecialchars($row['mencuci_pakaian']); ?></td>
                                <td><?php echo htmlspecialchars($row['membaca_buku_agama']); ?></td>
                                <td><?php echo htmlspecialchars($row['riyadhoh']); ?></td>
                                <td><?php echo htmlspecialchars($row['mengenalkan_icbs']); ?></td>
                                <td><?php echo htmlspecialchars($row['silaturahmi']); ?></td>
                                <td><?php echo htmlspecialchars($row['jumlah_rawatib']); ?></td>
                                <td><?php echo htmlspecialchars($row['jumlah_tilawah']); ?></td>
                                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">Tidak ada data untuk ditampilkan.</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
        var modal = document.getElementById("rankingModal");
var btn = document.getElementById("rankingButton");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
    setTimeout(() => {
        modal.classList.add("show");
    }, 10);
}

span.onclick = function() {
    closeModal();
}

window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}

function closeModal() {
    modal.classList.remove("show");
    setTimeout(() => {
        modal.style.display = "none";
    }, 300);
}
    </script>
</body>
</html>