<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun</title>
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
    --primary-color: #2E8B57;    /* Sea Green */
    --secondary-color: #3CB371;  /* Medium Sea Green */
    --text-color: #333;
    --background-color: #E8F5E9;         /* Light Green background */
}

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 600;
        }

        .button-container {
            display: grid;
            gap: 20px;
            margin-top: 30px;
        }

        .button {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 15px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .button:hover {
            background-color: var(--secondary-color);
            transform: scale(1.05);
        }

        .button i {
            margin-right: 10px;
            font-size: 18px;
        }

        .home-icon {
            text-align: center;
            margin-bottom: 20px;
        }

        .home-icon a {
            color: var(--primary-color);
            font-size: 36px;
            transition: color 0.3s ease;
        }

        .home-icon a:hover {
            color: var(--secondary-color);
        }

        @media (min-width: 390px) {
            .container {
                max-width: 390px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="home-icon">
                <a href="home_super_admin.php"><i class="fas fa-home"></i></a>
            </div>
            <h2>Akun</h2>
            <div class="button-container">
                <a href="form_register.php" class="button">
                    <i class="fas fa-user-plus"></i>Tambahkan User
                </a>
                <a href="lihat_user.php" class="button">
                    <i class="fas fa-users"></i>Lihat Seluruh User
                </a>
                <a href="ganti_passwordadmin.php" class="button">
                    <i class="fas fa-lock"></i>Ganti Password
                </a>
            </div>
        </div>
    </div>
</body>
</html>