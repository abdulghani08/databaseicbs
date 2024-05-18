<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ex Santri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo {
            max-width: 300px;
            margin-bottom: 20px;
        }
        h1 {
            margin: 20px 0;
            font-size: 24px;
            color: #333;
        }
        .button-group {
            display: flex;
            flex-direction: column;
        }
        .button-group button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .button-group button:hover {
            background: #45a049;
        }
        @media (min-width: 600px) {
            .button-group {
                flex-direction: row;
                justify-content: space-around;
            }
            .button-group button {
                margin: 10px;
            }
        }

        .button-row .back-button {
            background-color: #FF0000;
            color: white;
            position: absolute;
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            flex-direction: column;
            align-items: left;
        }
    </style>
</head>
<body>

<div class="container">
<div>
    <a href="dt_portopolio.php"><img src="back_icon.png" alt="home" style="width: 30px;"></a>
</div>
    <img src="logo.png" alt="Logo" class="logo">
    <h1>DATA EX SANTRI</h1>
    <div class="button-group">
        <button onclick="window.location.href='dt_santri_pindah.php'">Santri Pindah</button>
        <button onclick="window.location.href='dt_santri_lulus_sma.php'">Santri Lulusan SMA</button>
        <button onclick="window.location.href='dt_santri_lulus_smp.php'">Santri Lulusan SMP</button>
    </div>
</div>

</body>
</html>
