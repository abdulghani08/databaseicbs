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
<html>
<head>
    <title>Ganti Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-top: 0;
            position: relative;
        }

        .back-button {
            text-align: center;
            margin-bottom: 20px;
        }

        .back-button a {
            display: inline-block;
            padding: 5px;
            background: url('home_icon.png') no-repeat center center;
            background-size: 100%;
            width: 20px;
            height: 20px;
            text-indent: -9999px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
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

