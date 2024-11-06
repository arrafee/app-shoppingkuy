<?php 
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'admin'){
    echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
}

//get id_kategori
$id_kategori = $_GET['id_kategori'];

//menampilkan tabel barang berdasarkan id_kategori
$sql = "select * from barang where id_kategori='$id_kategori'";
$query = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)){
	$gambar = "../image/$row[gambar]";
	//hapus gambar
	unlink($gambar);
	//hapus data keranjang berdasarkan id_barang
	$sql_delete_keranjang = "delete from keranjang where id_barang='$row[id_barang]'";
	$query_delete_keranjang = mysqli_query($connect, $sql_delete);
}

//hapus data barang berdasarkan id_kategori
$sql_delete_barang = "delete from barang where id_kategori='$id_kategori'";
$query_delete_barang = mysqli_query($connect, $sql_delete_barang);

//hapus data kategori berdasarkan id_kategori
$sql_delete_kategori = "delete from kategori where id_kategori='$id_kategori'";
$query_delete_kategori = mysqli_query($connect, $sql_delete_kategori);

if($query_delete_kategori){
	echo "<script> alert('Kategori Sudah Dihapus'); window.location.href='kategori.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan Saat Menghapus, Silahkan Uangi.'); window.location.href='kategori.php' </script>";
}