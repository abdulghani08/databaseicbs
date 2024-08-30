<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: home.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Cek apakah password konfirmasi sama dengan password baru
    if ($password_baru !== $konfirmasi_password) {
        $error = 'Password konfirmasi tidak sama.';
    } else {
        // Periksa apakah password lama yang dimasukkan benar
        $conn = mysqli_connect('localhost', 'sant5315_db_santri', 'payakumbuh123', 'sant5315_db_santri');
        if (!$conn) {
            die('Koneksi database gagal: ' . mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM register WHERE username = '$username' AND password = '$password_lama'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Update password baru
            $sql = "UPDATE register SET password = '$password_baru' WHERE username = '$username'";
            if (mysqli_query($conn, $sql)) {
                header('Location: logout.php');
                exit;
            } else {
                $error = 'Terjadi kesalahan dalam memperbarui password.';
            }
        } else {
            $error = 'Password lama yang dimasukkan salah.';
        }
        
        mysqli_close($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        :root {
            --primary-color: #FF8C00;
            --secondary-color: #FFA500;
            --background-color: #FFF5E6;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            transition: background-color 0.3s ease;
        }

        .container {
            width: 90%;
            max-width: 400px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .back-button {
            position: absolute;
            top: 1rem;
            left: 1rem;
        }

        .back-button a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            border-radius: 50%;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .back-button a:hover {
            background-color: var(--secondary-color);
            transform: scale(1.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-group {
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .input-group i {
            position: absolute;
            left: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .error {
            color: #ff3333;
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        button[type="submit"] {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.8rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        @media (max-width: 767px) {
            .container {
                width: 95%;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="back-button">
        <a href="home.php"><i class="fas fa-home"></i></a>
    </div>
    <div class="container">
        <h1>Ganti Password</h1>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password_lama" name="password_lama" placeholder="Password Lama" required>
            </div>
            <div class="input-group">
                <i class="fas fa-key"></i>
                <input type="password" id="password_baru" name="password_baru" placeholder="Password Baru" required>
            </div>
            <div class="input-group">
                <i class="fas fa-check-circle"></i>
                <input type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit"><i class="fas fa-sync-alt"></i> Ganti Password</button>
        </form>
    </div>
</body>
</html>