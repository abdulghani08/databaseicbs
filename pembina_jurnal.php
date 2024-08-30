<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);
$user = $_SESSION['username'];

// Periksa apakah jurnal hari ini sudah diisi
$today = date("Y-m-d");
$check_today = mysqli_query($koneksi, "SELECT * FROM jurnal_pembina WHERE username='$user' AND tanggal='$today'");
$jurnal_hari_ini = mysqli_num_rows($check_today) > 0;

$sql = "SELECT * FROM jurnal_pembina WHERE username='$user' ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Pembina</title>
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
            color: var(--text-color);
            background: url('backgroundgedung.jpg') repeat, linear-gradient(135deg, var(--bg-color), var(--secondary-color));
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            width: 100%;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            animation: fadeIn 0.5s ease-out, floatIn 0.5s ease-out;
        }
        
        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
        }
        
        .btn i {
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 20px;
            animation: slideIn 0.5s ease-out;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: none;
        }
        
        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 10px 10px 0 0;
        }
        
        tr {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }
        
        tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }
        
        .btn-lihat {
            background-color: var(--secondary-color);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9em;
        }
        
        .btn-lihat:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-disabled {
            background-color: #888;
            cursor: not-allowed;
        }
        
        .btn-disabled:hover {
            background-color: #888;
            transform: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes floatIn {
            from { transform: translateY(20px); }
            to { transform: translateY(0); }
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                border-radius: 15px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            table {
                font-size: 14px;
            }
            
            .btn, .btn-lihat {
                font-size: 12px;
                padding: 10px 20px;
            }
            
            .btn-group {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>JURNAL PEMBINA</h1>
        <div class="btn-group">
            <a href="home.php" class="btn"><i class="fas fa-home"></i>Home</a>
            <?php if ($jurnal_hari_ini): ?>
                <span class="btn btn-disabled"><i class="fas fa-check"></i>Jurnal Hari Ini Selesai</span>
            <?php else: ?>
                <a href="pembina_form_jurnal.php" class="btn"><i class="fas fa-edit"></i>Isi Jurnal Hari Ini</a>
            <?php endif; ?>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    // echo "<td><a href='lihat_jurnal_pembina.php?id=" . $row['id'] . "' class='btn-lihat'>Lihat Hasil</a></td>";
                    echo "<td>" .  "Selesai</td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>