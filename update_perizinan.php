<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data dari tabel tahfizh_data berdasarkan NIS dan Nama yang dikirim melalui parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];
$query = "SELECT * FROM portopolio_isi WHERE nis='$nis' AND nama='$nama'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REKAPAN PERIZINAN</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF9800;
            --secondary-color: #FFA726;
            --background-color: #FFF3E0;
            --text-color: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 20px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .action-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            width: 150px;
            text-align: center;
        }

        .action-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-button i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .action-button span {
            font-size: 14px;
            font-weight: 600;
        }

        .details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .details table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .details th, .details td {
            padding: 15px;
            text-align: left;
            border: none;
        }

        .details th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
        }

        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: none;
        }

        th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
        }

        tbody tr {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-links a {
            display: inline-block;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .action-links a:hover {
            background-color: var(--secondary-color);
        }

        .action-links img {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 767px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .action-button {
                width: 80%;
                max-width: 200px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px 4px;
            }

            .hide-mobile {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <a href="dt_perizinan.php"><img src="back_icon.png" alt="back" style="width: 30px; height: auto;"></a>
        </div>
        <h2>REKAPAN PERIZINAN</h2>
        
        <div class="action-buttons">
            <a href="form_tambahdata_perizinan.php?nis=<?php echo $nis; ?>&nama=<?php echo $nama; ?>" class="action-button">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Perizinan</span>
            </a>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>Nama</th>
                    <td><?php echo $data['nama']; ?></td>
                </tr>
                <tr>
                    <th>NIS</th>
                    <td><?php echo $data['nis']; ?></td>
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
            </table>
        </div>

        <div class="table-container">
        <h2>Data Tersimpan</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th>Keperluan</th>
                        <th>Durasi (Hari)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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
                            <td class="action-links">
                                <a class="edit" href="edit_perizinan.php?id=<?php echo $setoran_data['id']; ?>"><img src="edit_icon.png" alt="Edit"></a>
                                <a class="delete" href="aksi_hapus_perizinan.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')"><img src="delete_icon.png" alt="Delete"></a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add fade-in animation to elements as they enter the viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        });

        document.querySelectorAll('table, .details').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>