<?php
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'pengguna'){
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script>";
}

$id_pengguna = $_SESSION['id'];
$id_transaksi = $_GET['id_transaksi'];
//get waktu
	date_default_timezone_set('Asia/Jakarta');
	$waktu = date('Y-m-d H:i:s');

//tampilkan transaksi
$sql_get_transaksi = "select * from transaksi where id_transaksi='$id_transaksi'";
$query_get_transaksi = mysqli_query($connect, $sql_get_transaksi);
$get_transaksi = mysqli_fetch_array($query_get_transaksi);
//get waktu transaksi
$waktu_transaksi = $get_transaksi['waktu_transaksi'];

//update transaksi
$sql_update_transaksi = "update transaksi set status_transaksi='lunas',waktu_transaksi='$waktu' where id_transaksi='$id_transaksi'";
$query_get_transaksi = mysqli_query($connect, $sql_update_transaksi);

//update data tabel keranjang
$sql_update_keranjang = "update keranjang set status='lunas',waktu='$waktu' where waktu='$waktu_transaksi' and id_pengguna='$id_pengguna'";
$query_update_keranjang = mysqli_query($connect, $sql_update_keranjang);

if($query_update_keranjang){
	echo "<script> alert('Terimakasih Sudah Belanja Di Medisku'); window.location.href='home.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan'); window.location.href='home.php' </script>";
}