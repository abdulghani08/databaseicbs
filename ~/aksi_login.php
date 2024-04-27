<?php
session_start();
include "connection.php";

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM register WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];

        if($row['level'] == "Admin"){
            header("Location: home.php?level=Admin");
        } elseif($row['level'] == "Pembina"){
            header("Location: home.php?level=Pembina");
        } elseif($row['level'] == "Tamu"){
            header("Location: hometamu.php?level=Tamu");
        } else {
            die("Level tidak valid");
        }
    } else {
        die("Username atau password salah <a href=\"javascript:history.back()\">Kembali</a>");
    }
} else {
    die("Username atau password kosong <a href=\"javascript:history.back()\">Kembali</a>");
}
?>
