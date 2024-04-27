<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan host database Anda
$username = "sant5315_db_santri"; // Ganti dengan username database Anda
$password = "payakumbuh123"; // Ganti dengan password database Anda
$dbname = "sant5315_db_santri"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Memeriksa apakah data POST tersedia
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Mengambil nilai dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Melindungi dari SQL injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Mengecek kecocokan username dan password di database
    $sql = "SELECT * FROM register WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Jika hasil query menghasilkan 1 baris, login berhasil
    if ($result->num_rows == 1) {
        // Redirect ke link berikut jika login berhasil
        header("Location: https://docs.google.com/spreadsheets/d/14a2Bw3vRR390u48QT6U2KjEQ8vYfzV1k9cLdZtTEt3Q/edit?usp=sharing");
        exit();
    } else {
        // Jika login gagal, tampilkan pesan kesalahan
        echo "<script>alert('Username atau password salah, coba lagi!');window.location.href='index.html';</script>";
    }
} else {
    // Jika data POST tidak tersedia, tampilkan pesan kesalahan
    echo "<script>alert('Data tidak lengkap');window.location.href='index.html';</script>";
}

// Menutup koneksi database
$conn->close();
?>
