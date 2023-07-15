<!DOCTYPE html>
<html>
<head>
    <title>Akun</title>
    <link rel="shortcut icon" href="logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .button-container button:hover {
            background-color: #45a049;
        }

        .action-links {
            display: flex;
            justify-content: center;
        }

        .action-links a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .action-links a.home img {
            width: 25px; /* Ubah dengan lebar yang diinginkan */
            height: auto; /* Atau ubah dengan tinggi yang diinginkan */
        }
    </style>
</head>
<body>
    <div class="container">
    <center><div class="navigation">
            <a href="home.php"><img src="home_icon.png" alt="home"></a>
        </div></center>
        <center><h2>Akun</h2></center>
        <center><div class="button-container">
            <button onclick="location.href='form_register.php'">Tambahkan User</button>
            <button onclick="location.href='lihat_user.php'">Lihat Seluruh User</button>
            <button onclick="location.href='ganti_passwordadmin.php'">Ganti Password</button>
        </div></center>
    </div>
</body>
</html>
