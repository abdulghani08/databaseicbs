<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil data dari tabel tahfizh_data berdasarkan NIS dan Nama yang dikirim melalui parameter URL
$nis = $_GET['nis'];
$nama = $_GET['nama'];
$query = "SELECT * FROM daftar_pembina WHERE nis='$nis' AND nama='$nama'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Jurnal Pembina</title>
    <link rel="shortcut icon" href="../logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
    --primary-color: #2E8B57;    /* Sea Green */
    --secondary-color: #3CB371;  /* Medium Sea Green */
    --text-color: #333;
    --background-color: #E8F5E9;         /* Light Green background */
}

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
            color: var(--text-color);
        }

        .container {
    width: 95%;
    max-width: 1000px;
    margin: 20px auto;
    background-color: #fff;
    background-image: url('../backgroundgedung.jpg');
    background-size: cover;
    background-position: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.details, .prestasi-table-container {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
}
.action-links a.view {
            background-color: #3498db;
        }

        .action-links a.view:hover {
            background-color: #2980b9;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
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

        h2 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 24px;
        }

        h3 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 24px;
        }

        .add-button {
            margin-bottom: 20px;
            text-align: center;
        }

        .add-button a {
            display: inline-block;
            text-decoration: none;
            background-color: var(--primary-color);
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .add-button a:hover {
            background-color: var(--secondary-color);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-link img {
            width: 30px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .back-link img:hover {
            transform: scale(1.1);
        }

        .details {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow-x: auto;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .details th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 500;
        }

        .prestasi-table-container {
            overflow-x: auto;
        }

        .prestasi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .prestasi-table th,
        .prestasi-table td {
            padding: 10px;
            border: 1px solid #eee;
            text-align: left;
        }

        .prestasi-table th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 500;
        }

        .prestasi-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .prestasi-table tbody tr:hover {
            background-color: #fff5e6;
        }

        .action-links a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            margin-right: 5px;
            font-weight: 500;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .action-links a.delete {
            background-color: #ff4136;
        }

        .action-links a.delete:hover {
            background-color: #ff1a1a;
        }

        .action-links a img {
            width: 20px;
            height: auto;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
                margin: 10px auto;
            }

            h2 {
                font-size: 18px;
            }

            h3 {
                font-size: 16px;
            }

            .add-button a {
                padding: 8px 16px;
                font-size: 8px;
            }

            .details th,
            .details td,
            .prestasi-table th,
            .prestasi-table td {
                padding: 5px;
                font-size: 8px;
            }

            .action-links a {
                padding: 4px 8px;
                font-size: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="dt_jurnal_pembina.php" class="back-link"><img src="../back_icon.png" alt="back"></a>
        
        <div class="details">
        <h2>REKAPAN JURNAL PEMBINA</h2>
            <table>
                <tr>
                    <th>Nama</th>
                    <td><?php echo $data['nama']; ?></td>
                </tr>
                <tr>
                    <th>Kode Pembina</th>
                    <td><?php echo $data['nis']; ?></td>
                </tr>
                <tr>
                    <th>Asrama</th>
                    <td><?php echo $data['asrama']; ?></td>
                </tr>
            </table>
        </div>
        <div class="prestasi-table-container">
        <h3>Data Tersimpan</h3>
            <table class="prestasi-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah Santri</th>
                        <th>Jumlah Santri Sakit</th>
                        <th>Jumlah Santri Izin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $setoran_query = "SELECT * FROM jurnal_pembina WHERE nis='$nis'";
                    $setoran_result = mysqli_query($koneksi, $setoran_query);
                    $no = 1;
                    while ($setoran_data = mysqli_fetch_array($setoran_result)) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $setoran_data['tanggal']; ?></td>
                            <td><?php echo $setoran_data['jumlah_santri']; ?></td>
                            <td><?php echo $setoran_data['jumlah_santri_sakit']; ?></td>
                            <td><?php echo $setoran_data['jumlah_santri_izin']; ?></td>
                            <td class="action-links">
                            <a class="view" href="#" onclick="viewData(<?php echo $setoran_data['id']; ?>)">
                                <i class="fas fa-eye"></i>
                            </a>
                                <!-- <a class="delete" href="aksi_hapus_kesehatan.php?id=<?php echo $setoran_data['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapusnya?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a> -->
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Modal for viewing data -->
    <div id="dataModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="dataContent"></div>
        </div>
    </div>

    <script>
        function viewData(id) {
            $.ajax({
                url: 'get_jurnal_data.php',
                type: 'GET',
                data: {id: id},
                success: function(response) {
                    $('#dataContent').html(response);
                    $('#dataModal').css('display', 'block');
                },
                error: function() {
                    alert('Error fetching data');
                }
            });
        }

        // Close the modal
        $('.close').click(function() {
            $('#dataModal').css('display', 'none');
        });

        // Close the modal if clicked outside of it
        $(window).click(function(event) {
            if (event.target == $('#dataModal')[0]) {
                $('#dataModal').css('display', 'none');
            }
        });
    </script>
</body>

</html>