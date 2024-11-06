<?php
session_start();
include "../koneksi/config.php";
date_default_timezone_set("Asia/Jakarta");

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'pengguna'){
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script>";
}

$id = $_SESSION['id'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$id_barang = $_POST['id_barang'];
$stok = $_POST['stok'];
$total = $harga * $jumlah;
$total_stok = $stok - $jumlah;
$waktu = date("Y-m-d H:i:s");

if ($stok < $jumlah) {
	echo "<script> alert('Maaf Stok Tidak Mencukupi'); window.location.href='home.php' </script>";
} else {
	//update stok barang
	$sql_update_barang = "update barang set stok='$total_stok' where id_barang='$id_barang'";
	$query_update_barang = mysqli_query($connect, $sql_update_barang);
	$keranjang = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM keranjang WHERE id_barang = $id_barang AND id_pengguna = $id"));
	if ($keranjang) {
		//update keranjang
		$id_keranjang = $keranjang["id_keranjang"];
		$new_jumlah = $keranjang["jumlah_beli"] + $jumlah;
		$new_total = $keranjang["total"] + $total;
		$sql = "UPDATE keranjang SET jumlah_beli = $new_jumlah, total = $new_total, waktu = '$waktu' WHERE id_keranjang = $id_keranjang";
	} else {
		//insert keranjang
		$sql = "insert into keranjang (harga_barang,jumlah_beli,status,waktu,total,id_barang,id_pengguna) values ('$harga','$jumlah','belum bayar', '$waktu','$total','$id_barang','$id')";
	}
	$query = mysqli_query($connect, $sql);
	if ($query) {
		echo "<script> alert('Barang Sudah Dimasukkan Ke Keranjang'); window.location.href='home.php' </script>";
	} else {
		echo "<script> alert('Terjadi Kesalahan'); window.location.href='home.php' </script>";
	}
}