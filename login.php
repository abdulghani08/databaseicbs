<!DOCTYPE html>
<html>
<head>
    <title>Database Santri - Login Form</title>
    <style>
        body {
            font-family: Cambria;
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
             padding: 0;
             margin: 0;
        }

        .form-container {
            width: 400px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
        }

        .logo {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 150px;
            background-image: url(logo.png);
            background-size: cover;
        }

        .logo img {
            width: 150px;
            height: auto;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container table {
            width: 100%;
        }

        .container table td {
            padding: 5px;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 3px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #4CAF50;
            text-decoration: none;
        }

        .container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="form-container">
        <!-- <h2>Login</h2> -->
        <center><h1>DATABASE SANTRI</h1></center>
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h2>ICBS PAYAKUMBUH</h2>
        <form action="aksi_login.php?op=in" method="POST">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="login" value="Login"></td>
                </tr>
            </table>
        </form>
        <p>
        <!-- <center>belum punya akun?</center>
        <a href="form_register.php">Register</a> -->
    </div>
</body>
</html>
