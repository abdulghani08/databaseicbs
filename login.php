<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Welcome - Database Santri - Login Form</title>
    <link rel="shortcut icon" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
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

        .form-container {
            width: 100%;
            max-width: 380px;
            background-color: var(--background-color);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            color: var(--text-color);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background-image: url(logo.png);
            background-size: cover;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-size: 20px;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-group input:focus,
        .input-group input:not(:placeholder-shown) {
            border-color: var(--primary-color);
            outline: none;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 12px;
            color: var(--primary-color);
            background-color: var(--background-color);
            padding: 0 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: var(--primary-color);
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        input[type="submit"]:hover {
            background-color: var(--secondary-color);
        }

        input[type="submit"]:active {
            transform: scale(0.98);
        }

        @media (max-width: 380px) {
            .form-container {
                padding: 20px;
            }

            .header h1 {
                font-size: 20px;
            }

            .logo {
                width: 100px;
                height: 100px;
            }

            h2 {
                font-size: 18px;
            }

            .input-group input {
                font-size: 14px;
            }

            input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- <center><h5>Aplikasi akan mulai maintenance mulai pukul 22.30 hingga 02.00 WIB 24/08/24<h5></center> -->
        <div class="header">
            <h1>DATABASE SANTRI</h1>
            <div class="logo"></div>
        </div>
        <h2>ICBS HARAU</h2>
        <form action="aksi_login.php?op=in" method="POST">
            <div class="input-group">
                <input type="text" name="username" id="username" placeholder=" " required>
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>