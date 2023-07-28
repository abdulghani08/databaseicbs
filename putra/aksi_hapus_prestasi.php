<?php
session_start();
include "../connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Query untuk menghapus data berdasarkan ID
$query = "DELETE FROM putra_prestasi_isi WHERE id='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Redirect ke halaman sebelumnya setelah data berhasil dihapus
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data Perizinan.";
}
?>
