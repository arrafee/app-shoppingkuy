<?php 
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'admin'){
    echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
}

//get data
$kategori = $_POST['kategori'];

//insert table kategori
$sql = "insert into kategori (kategori) values ('$kategori')";
$query = mysqli_query($connect, $sql);

if($query){
	echo "<script> window.location.href='kategori.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan Saat Menyimpan, Silahkan Ulangi.'); window.location.href='kategori.php' </script>";
}