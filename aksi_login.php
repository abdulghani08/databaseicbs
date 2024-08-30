<?php
session_start();
include "connection.php";

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $sql = "SELECT * FROM register WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];

        switch($row['level']) {
            case "Super_Admin":
                header("Location: super_admin/home_super_admin.php?level=Super_Admin");
                break;
            case "Admin":
                header("Location: home.php?level=Admin");
                break;
            case "Pembina":
                header("Location: home.php?level=Pembina");
                break;
            case "Tamu":
                header("Location: hometamu.php?level=Tamu");
                break;
            case "Admin_pa":
                header("Location: putra/home.php?level=Admin_pa");
                break;
            case "Pembina_pa":
                header("Location: putra/home.php?level=Pembina_pa");
                break;
            case "Tamu_pa":
                header("Location: putra/hometamu.php?level=Tamu_pa");
                break;
            default:
                header("Location: login_salah.php?error=level_tidak_valid");
                exit();
        }
    } else {
        header("Location: aksi_login_salah.php?error=username_password_salah");
        exit();
    }
} else {
    header("Location: aksi_login_salah.php?error=username_password_kosong");
    exit();
}
?>