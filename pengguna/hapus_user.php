<?php
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'pengguna'){
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script>";
}

$id = $_SESSION['id'];
$pass = $_POST['pass'];

//cek password lama benar atau tidak
$sql_get_user = "select * from pengguna where id_pengguna='$id' and password='$pass'";
$query_get_user = mysqli_query($connect, $sql_get_user);
$get_user = mysqli_num_rows($query_get_user);

if($get_user > 0){
	//delete data keranjang
	$sql_delete_keranjang = "delete from keranjang where id_pengguna='$id'";
	$query_delete_keranjang = mysqli_query($connect, $sql_delete_keranjang);

	//delete data transaksi
	$sql_delete_transaksi = "delete from transaksi where id_pengguna='$id'";
	$query_delete_transaksi = mysqli_query($connect, $sql_delete_transaksi);
		
	//delete data user
	$sql = "delete from pengguna where id_pengguna='$id'";
	$query = mysqli_query($connect, $sql);

	if($query){
		echo "<script> alert('Terimakasih Sudah Menggunakan Online Shop.'); window.location.href='logout.php' </script>";
	}else{
		echo "<script> alert('Gagal Memperbaharui, Terjadi Kesalahan.'); window.location.href='user.php' </script>";
	}

}else{
	echo "<script> alert('Pembaruan Akun Gagal, Password Yang Anda Masukkan Salah.'); window.location.href='user.php' </script>";
}