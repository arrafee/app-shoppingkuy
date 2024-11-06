<?php
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'pengguna'){
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script>";
}

//mendapatkan id_pengguna yang dikirim melalui session
$id_pengguna = $_SESSION['id'];
//mendapatkan id_transaksi yang dikirim melalui link
$id_transaksi = $_GET['id_transaksi'];

//menampilkan data transaksi berdasarkan id_transaksi
$sql_get_transaksi = "select * from transaksi where id_transaksi='$id_transaksi'";
$query_get_transaksi = mysqli_query($connect, $sql_get_transaksi);
$row = mysqli_fetch_array($query_get_transaksi);
//get waktu_transaksi
$waktu_transaksi = $row['waktu_transaksi'];

//hapus data keranjang berdasarkan waktu_transaksi dan id_pengguna
$sql_delete_keranjang = "delete from keranjang where id_pengguna='$id_pengguna' and waktu='$waktu_transaksi'";
$query_delete_keranjang = mysqli_query($connect, $sql_delete_keranjang);

//hapus data transaksi berdasarkan id_transaksi
$sql_delete_transaksi = "delete from transaksi where id_transaksi='$id_transaksi'";
$query_delete_keranjang = mysqli_query($connect, $sql_delete_transaksi);

if($query_delete_keranjang){
	echo "<script> window.location.href='pengiriman.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan Saat Menghapus, Silahkan Ulangi.'); window.location.href='pengiriman.php' </script>";
}

?>