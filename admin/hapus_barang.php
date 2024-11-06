<?php 
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'admin'){
    echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
}

//get id_barang
$id_barang = $_GET['id_barang'];

//hapus data barang dikeranjang
$sql_delete_keranjang = "delete from keranjang where id_barang='$id_barang'";
$query_delete_keranjang = mysqli_query($connect, $sql_delete_keranjang);

//get data gambar
$sql_get_barang = "select * from barang where id_barang='$id_barang'";
$query_get_barang = mysqli_query($connect, $sql_get_barang);
$row = mysqli_fetch_array($query_get_barang);
$img = $row['gambar'];
//lokasi gambar
$target = '../image/$img';
//hapus gambar di folder image
if(file_exists($target)){
	unlink($img);
}

//hapus data barang
$sql_delete_keranjang = "delete from barang where id_barang='$id_barang'";
$query_delete_keranjang = mysqli_query($connect, $sql_delete_keranjang);

//cek query
if($query_delete_keranjang){
	echo "<script> window.location.href='barang.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan Saat Menghapus Barang, Silahkan Ulangi'); window.location.href='barang.php' </script>";
}