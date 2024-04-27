<?php
// Proses penyimpanan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lakukan proses penyimpanan data di sini

    // Contoh: Simpan data ke database
    $success = simpanData($_POST);

    if ($success) {
        // Redirect ke halaman dt_portopolio.php dengan pesan notifikasi
        header("Location: dt_portopolio.php?pesan=Data berhasil disimpan");
        exit();
    } else {
        // Redirect ke halaman dt_portopolio.php dengan pesan notifikasi
        header("Location: dt_portopolio.php?pesan=Terjadi kesalahan saat menyimpan data");
        exit();
    }
}

// Fungsi simulasi penyimpanan data
function simpanData($data) {
    // Simulasikan penyimpanan data ke database atau sumber data lainnya
    // Ganti dengan logika penyimpanan data sesuai kebutuhan Anda

    // Contoh: Selalu mengembalikan nilai true
    return true;
}
?>
