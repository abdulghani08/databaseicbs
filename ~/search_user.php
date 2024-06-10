<!DOCTYPE html>
<html>
<head>
    <title>Lihat User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-links {
            width: 100px;
        }

        .delete-button {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }

        .search-bar {
            margin-bottom: 10px;
        }

        .add-button {
            text-align: left;
            margin-top: 10px;
        }

        .add-button a {
            text-decoration: none;
            color: #333;
            background-color: #eee;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .add-button a:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="add-button">
            <a href="akun.php">Kembali</a>
        </div>
        <br>
        <h1>Lihat User</h1>

        <!-- Search Bar -->
        <div class="search-bar">
            <form action="search_user.php" method="GET">
                <input type="text" name="search" placeholder="Cari berdasarkan username">
                <input type="submit" value="Cari">
            </form>
        </div>

        <!-- Table of Users -->
        <table>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            // Database connection code here
            $koneksi = mysqli_connect("localhost", "sant5315_db_santri", "payakumbuh123", "sant5315_db_santri");

            // Mengecek koneksi
            if (mysqli_connect_errno()) {
                echo "Koneksi database gagal : " . mysqli_connect_error();
            }

            // Check if search query is submitted
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                // Query to fetch user data based on search query
                $query = "SELECT * FROM register WHERE username LIKE '%$search%'";
                $result = mysqli_query($koneksi, $query);
            } else {
                // Query to fetch all user data
                $query = "SELECT * FROM register";
                $result = mysqli_query($koneksi, $query);
            }

            // Execute the query and fetch data
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['level']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td class="action-links">
                        <button class="delete-button" onclick="hapusUser('<?php echo $row['username']; ?>')">Hapus</button>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <script>
            function hapusUser(username) {
                if (confirm("Anda yakin ingin menghapus user ini?")) {
                    // Mengirim permintaan penghapusan ke delete_user.php dengan parameter username
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "delete_user.php?username=" + username, true);
                    xhr.onload = function() {
                        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
                            alert(xhr.responseText); // Menampilkan pesan respons dari delete_user.php
                            window.location.reload(); // Me-refresh halaman setelah menghapus data
                        } else {
                            alert("Terjadi kesalahan saat menghapus user.");
                        }
                    };
                    xhr.send();
                }
            }
        </script>
    </div>
</body>
</html>
