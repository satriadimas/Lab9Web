<?php 
include_once 'koneksi.php'; 
$id = $_GET['id']; 

$sql_gambar = "SELECT gambar FROM data_barang WHERE id_barang = $id"; 
$gambar = mysqli_query($conn, $sql_gambar);
$data = mysqli_fetch_array($gambar);

if(is_file("gambar/".$data['gambar']))
    unlink("gambar/".$data['gambar']);

$sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'"; 
$result = mysqli_query($conn, $sql);

header('location: index.php');
?>