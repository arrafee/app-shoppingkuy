<?php 
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'admin'){
    echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
}

$id_pengguna = $_GET['id_pengguna'];

$sql = "DELETE FROM pengguna WHERE id_pengguna='$id_pengguna'";
$query = mysqli_query($connect, $sql);

if($query){
    echo "<script> alert('Data Sudah Dihapus'); window.location.href='pengguna.php' </script>";
}else{
    echo "<script> alert('Terjadi Kesalahan Saat Menghapus, Silahkan Uangi.'); window.location.href='pengguna.php' </script>";
}