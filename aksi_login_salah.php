<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login Gagal - Database Santri</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #c0392b;
            --background-color: rgba(255, 255, 255, 0.9);
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .error-container {
            width: 100%;
            max-width: 380px;
            background-color: var(--background-color);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon {
            font-size: 60px;
            color: var(--primary-color);
            margin-bottom: 20px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        h1 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            color: var(--text-color);
            margin-bottom: 25px;
        }

        .back-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        .back-button:hover {
            background-color: var(--secondary-color);
        }

        .back-button:active {
            transform: scale(0.98);
        }

        @media (max-width: 380px) {
            .error-container {
                padding: 20px;
            }

            .error-icon {
                font-size: 50px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }

            .back-button {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">❌</div>
        <h1>Login Gagal</h1>
        <?php
        $error = isset($_GET['error']) ? $_GET['error'] : '';
        switch($error) {
            case 'username_password_salah':
                echo "<p>Username atau password yang Anda masukkan salah.</p>";
                break;
            case 'username_password_kosong':
                echo "<p>Username atau password tidak boleh kosong.</p>";
                break;
            case 'level_tidak_valid':
                echo "<p>Level akses tidak valid.</p>";
                break;
            default:
                echo "<p>Terjadi kesalahan saat login.</p>";
        }
        ?>
        <a href="login.php" class="back-button">Coba Login Lagi</a>
    </div>
</body>
</html>