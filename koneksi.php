<?php 
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "db_lab8web"; 

$conn = mysqli_connect($host, $user, $pass, $db); 
if (!$conn) {     
	echo "Koneksi ke server gagal.";     
	die(); 
} else  #echo "Koneksi berhasil";
?> 