<?php 
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'admin'){
    echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
}

//get id_transaksi
$id_transaksi = $_GET['id_transaksi'];
//tampilkan data transaksi
$sql_get_transaksi = "select * from transaksi where id_transaksi='$id_transaksi'";
$query_get_transaksi = mysqli_query($connect, $sql_get_transaksi);
$get_transaksi = mysqli_fetch_array($query_get_transaksi);
//ambil data id_pengguna dan waktu_transaksi
$id_pengguna = $get_transaksi['id_pengguna'];
$waktu_transaksi = $get_transaksi['waktu_transaksi'];

//Hapus data kerajang berdasarkan id_pengguna dan waktu_transaksi
$sql_delete_keranjang = "delete from keranjang where id_pengguna='$id_pengguna' and waktu='$waktu_transaksi'";
$query_delete_keranjang = mysqli_query($connect, $sql_delete_keranjang);

//hapus data transaksi
$sql_delete_transaksi = "delete from transaksi where id_transaksi='$id_transaksi'";
$query_delete_transaksi = mysqli_query($connect, $sql_delete_transaksi);

if($query_delete_transaksi){
	echo "<script> alert('Riwayat Transaksi Sudah Dihapus'); window.location.href='home.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan Saat Menghapus, Silahkan Uangi.'); window.location.href='home.php' </script>";
}
?>