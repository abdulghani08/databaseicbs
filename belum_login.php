<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anda Belum Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
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
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            max-width: 90%;
            width: 400px;
        }

        h1 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }
        
        .header img {
            max-width: 150px;
        }

        @media (max-width: 767px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
    <header class="header">
            <img src="img/rilisan.png" alt="logo">
        </header>
        <h1>ANDA BELUM LOGIN</h1>
        <p>Maaf, waktu akses anda telah habis. Silahkan login kembali.</p>
        <a href="login.php" class="btn">Login Sekarang</a>
    </div>
</body>
</html>