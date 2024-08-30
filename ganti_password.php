<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ganti Password</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e88e5;
            --secondary-color: #64b5f6;
            --background-color: #f5f5f5;
            --text-color: #333;
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: var(--input-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            font-size: 28px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .back-button {
            text-align: center;
            margin-bottom: 20px;
        }

        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #42a5f5;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: 500;
            color: var(--primary-color);
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--secondary-color);
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="password"]:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .error {
            color: #f44336;
            font-size: 14px;
            margin-top: 5px;
        }

        button[type="submit"] {
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #1565c0;
        }

        @media (max-width: 390px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            input[type="password"],
            button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-button">
            <a href="hometamu.php">Kembali</a>
        </div>
        <h1>Ganti Password</h1>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div>
                <label for="password_lama">Password Lama:</label>
                <input type="password" id="password_lama" name="password_lama" required>
            </div>
            <div>
                <label for="password_baru">Password Baru:</label>
                <input type="password" id="password_baru" name="password_baru" required>
            </div>
            <div>
                <label for="konfirmasi_password">Konfirmasi Password:</label>
                <input type="password" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>
            <div>
                <button type="submit">Ganti Password</button>
            </div>
        </form>
    </div>
</body>
</html>

