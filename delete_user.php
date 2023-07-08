<?php
// Mengecek apakah parameter 'username' diterima
if (isset($_GET['username'])) {
    // Menghubungkan dengan database
    $koneksi = mysqli_connect("localhost", "root", "", "db_santri");

    // Mengecek koneksi
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_error();
        exit;
    }

    // Mengamankan nilai username dari serangan SQL Injection
    $username = mysqli_real_escape_string($koneksi, $_GET['username']);

    // Mengeksekusi perintah SQL untuk menghapus data
    $query = "DELETE FROM register WHERE username = '$username'";
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil menghapus data
        echo "Data user dengan username $username telah dihapus.";
    } else {
        // Jika terjadi kesalahan dalam menghapus data
        echo "Gagal menghapus data user dengan username $username.";
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
} else {
    echo "Parameter username tidak ditemukan.";
}
