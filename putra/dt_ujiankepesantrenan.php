<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    header("Location: belum_login.php");
    exit();
}

$koneksi = mysqli_connect($host, $username, $password, $database);

$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'jenis';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

$query = "SELECT * FROM daftar_ujiankepesantrenan ORDER BY $sortColumn $sortOrder";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ujian Kepesantrenan</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a237e; /* Biru dongker */
            --secondary-color: #283593; /* Biru dongker lebih terang */
            --background-color: #e8eaf6;
            --text-color: #333;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            margin: 0;
            padding: 20px;
            color: var(--text-color);
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
        }
        
        .navigation {
            text-align: left;
            margin-bottom: 20px;
        }
        
        .navigation a {
            text-decoration: none;
            color: #fff;
            background-color: var(--primary-color);
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .navigation a:hover {
            background-color: var(--secondary-color);
        }
        
        .download-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .download-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-color);
            background-color: #fff;
            border: 2px solid var(--primary-color);
            border-radius: 10px;
            padding: 15px;
            width: 120px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .download-btn:hover {
            background-color: var(--primary-color);
            color: #fff;
            transform: translateY(-5px);
        }

        .download-btn i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .download-btn span {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }
        th.download-header {
    background-color: transparent;
    color: var(--text-color);
}
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: var(--primary-color);
            color: white;
        }
        
        tbody tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }
        
        .hidden-row {
            display: none;
        }
        
        .hidden-row img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            table {
                font-size: 14px;
            }
            
            th, td {
                padding: 8px;
                text-align: center;
            }
            
            .download-btn {
                width: 100px;
                padding: 10px;
            }
            .download-btn i {
                font-size: 20px;
            }
            .download-btn span {
                font-size: 10px;
            }
        }
    </style>
    <script>
        function toggleImage(rowId) {
            var img = document.getElementById('img_' + rowId);
            img.style.display = img.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <a href="dt_kepesantrenan.php">Kembali</a>
        </div>
        <h1>DAFTAR UJIAN KEPESANTRENAN</h1>
<table>
    <thead>
        <tr>
            <th>Download Materi Ujian (PDF)</th>
    </tr>
    </thead>
    <tbody>
        <tr><th class="download-header">
        <div class="download-buttons">
        <a href="https://drive.google.com/file/d/1D_sEnzroZeRX-oKjVksSqeqot7RMP86O/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-language"></i>
            <span>Ujian Bahasa 1</span>
        </a>
        <a href="https://drive.google.com/file/d/1BF6ackhz1OQpXi7fqImKpelPLwkYMxYj/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-language"></i>
            <span>Ujian Bahasa 2</span>
        </a>
        <a href="https://drive.google.com/file/d/1ZxtOl3uq_RyyI3-zNPCIRj_k2_ACBsmw/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-language"></i>
            <span>Ujian Bahasa 3</span>
        </a>
        <a href="https://drive.google.com/file/d/125_k3JND8wgbFGmeQ2cUk5InzE4vAGvD/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-book-open"></i>
            <span>100 Hadist Pilihan</span>
        </a>
        <a href="https://drive.google.com/file/d/1StbUJnE8Xve-D1APNTYrbYBRc-mX4jNJ/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-microphone"></i>
            <span>Pidato Santri</span>
        </a>
        <a href="https://drive.google.com/file/d/1yD1wiZJaZIPlS9XWQEOqh9C0aL41S5c3/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-pray"></i>
            <span>Doa Ba'da Shalat</span>
        </a>
        <a href="https://drive.google.com/file/d/15n0IHIJjw3ZXNI8coxYbKMDaLf19BxIY/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-book"></i>
            <span>Bacaan Sholat & Dzikir</span>
        </a>
        <a href="https://drive.google.com/file/d/1u0zMUvtjk6rncoD9N3DEoWf9UmBWP1fx/view?usp=sharing" target="_blank" class="download-btn">
            <i class="fas fa-hands"></i>
            <span>Doa sehari-hari</span>
        </a>
    </div>
    </th></tr>
    </tbody>
    </table>
        <table>
            <thead>
                <tr>
                    <th>Nama Ujian <br>(klik tulisan untuk memunculkan gambar)</br></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr onclick="toggleImage('<?php echo $row['id']; ?>')">
                        <td><?php echo $row['jenis']; ?></td>
                    </tr>
                    <tr id="img_<?php echo $row['id']; ?>" class="hidden-row">
                        <td>
                            <?php
                            $gambarPath = 'gambar_ujian/' . $row['id'] . '.jpg';
                            if (file_exists($gambarPath)) {
                                echo '<img src="' . $gambarPath . '" alt="Gambar Ujian" />';
                            } else {
                                echo 'Gambar tidak ditemukan';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>