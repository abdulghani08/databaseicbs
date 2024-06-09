<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFO GRAFIS PUTRI HARAU</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo {
            max-width: 300px;
            margin-bottom: 20px;
        }
        h1 {
            margin: 20px 0;
            font-size: 24px;
            color: #333;
        }
        .button-group {
            display: flex;
            flex-direction: column;
        }
        .button-group button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .button-group button:hover {
            background: #45a049;
        }
        @media (min-width: 600px) {
            .button-group {
                flex-direction: row;
                justify-content: space-around;
            }
            .button-group button {
                margin: 10px;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <img src="logo.png" alt="Logo" class="logo">
    <h1>INFO GRAFIS PUTRI HARAU</h1>
    <div class="button-group">
        <button onclick="window.location.href='https://drive.google.com/file/d/1hkUUMDzm3Mn1aGCXPn_6BTBnseZOFbaf/view?usp=sharing'">Maret 2024</button>
        <button onclick="window.location.href='https://drive.google.com/file/d/1MqKIYjX4v2_7oTPa_X_198FDCaLiL-Et/view?usp=sharing'">April 2024</button>
        <button onclick="window.location.href='https://drive.google.com/file/d/1yHquNIFBACqfB9LL5G7asMYRc1FktX5r/view?usp=sharing'">Mei 2024</button>
    </div>
</div>

</body>
</html>
