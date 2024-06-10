<?php
$host 				= "localhost";
$username_database 	= "sant5315_school";
$password_database 	= "payakumbuh123";
$nama_database		= "sant5315_school";

$koneksi = mysqli_connect($host, $username_database, $password_database, $nama_database);

// mengecek koneksi
if (!$koneksi) 
{
	die("Koneksi gagal: " . mysqli_connect_error());
}
?>