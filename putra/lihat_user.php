<!DOCTYPE html>
<html>
<head>
    <title>Lihat User</title>
    <link rel="shortcut icon" href="../logo.png">
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

        h2 {
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

        .action-column {
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
        <h2>Lihat User</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <form action="search_user.php" method="GET">
                <input type="text" name="search" placeholder="Cari berdasarkan username">
                <button type="submit">Cari</button>
            </form>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>No. Hp</th>
                    <th class="action-column">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menghubungkan dengan database
                $koneksi = mysqli_connect("localhost", "sant5315_db_santri", "payakumbuh123", "sant5315_db_santri");

                // Mengecek koneksi
                if (mysqli_connect_errno()) {
                    echo "Koneksi database gagal : " . mysqli_connect_error();
                }

                // Mendapatkan data dari tabel register
                $query = mysqli_query($koneksi, "SELECT * FROM register");

                while ($data = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>".$data['username']."</td>";
                    echo "<td>".$data['password']."</td>";
                    echo "<td>".$data['level']."</td>";
                    echo "<td>".$data['email']."</td>";
                    echo '<td><button class="delete-button" onclick="hapusUser(\''.$data['username'].'\')">Hapus</button></td>';
                    echo "</tr>";
                }

                // Menutup koneksi database
                mysqli_close($koneksi);
                ?>
            </tbody>
        </table>
    </div>

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
</body>
</html>
