<?php
include "connection.php";

$search = $_GET['search'];
$query = "SELECT nama, poin, klasifikasi FROM daftar_pelanggaran WHERE nama LIKE '%$search%'";
$result = mysqli_query($koneksi, $query);

$response = array();
while ($row = mysqli_fetch_assoc($result)) {
    $response[] = $row;
}

echo json_encode($response);
?>
