<?php
session_start();
include "connection.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (empty($_SESSION['username'])) {
    die("Anda belum login");
}

$koneksi = mysqli_connect($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ambil ID ujian dari parameter URL
    $id_ujian = $_GET['id'];

    // Query untuk menghapus data ujian tahfizh berdasarkan ID
    $query = "DELETE FROM tahfizh_ujian WHERE id='$id_ujian'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect kembali ke halaman rekapan hafalan dengan parameter nis dan nama
        header("Location: dt_tahfizh.php?nis=" . $_SESSION['nis'] . "&nama=" . $_SESSION['nama']);
        exit();
    } else {
        error_log("Error saat menghapus data ujian tahfizh: " . mysqli_error($koneksi));
        echo "Terjadi kesalahan saat menghapus data ujian tahfizh.";
    }
}
?>
