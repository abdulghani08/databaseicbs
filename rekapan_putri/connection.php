<?php
    // Sambungkan ke database
$servername = "localhost";
$username = "sant5315_db_santri";
$password = "payakumbuh123";
$dbname = "sant5315_db_santri";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>