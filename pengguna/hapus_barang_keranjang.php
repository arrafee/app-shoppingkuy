<?php
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'pengguna'){
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script>";
}

$id_keranjang = $_GET['id'];

//tampilkan table keranjang
$sql_get_keranjang = "select * from keranjang where id_keranjang='$id_keranjang'";
$query_get_keranjang = mysqli_query($connect, $sql_get_keranjang);
$get_keranjang = mysqli_fetch_array($query_get_keranjang);
//mengambil data jumlah pembelian dan id_barang
$id_barang = $get_keranjang['id_barang'];
$jumlah = $get_keranjang['jumlah_beli'];

//menampilkan tabel barang
$sql_get_barang = "select * from barang where id_barang='$id_barang'";
$query_get_barang = mysqli_query($connect, $sql_get_barang);
$get_barang = mysqli_fetch_array($query_get_barang);
//mengambil data stok barang
$stok = $get_barang['stok'];

//menjumlahkan stok dan jumlah
$stok_akhir = $stok + $jumlah;

//update stok barang
$sql_update_barang = "update barang set stok='$stok_akhir' where id_barang='$id_barang'";
$query_update_barang = mysqli_query($connect, $sql_update_barang);

//menghapus data barang dikeranjang
$sql = "delete from keranjang where id_keranjang='$id_keranjang'";
$query = mysqli_query($connect, $sql);
if($query){
	echo "<script> window.location.href='keranjang.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan'); window.location.href='keranjang.php' </script>";
}
?>