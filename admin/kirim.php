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
//get waktu
date_default_timezone_set('Asia/Jakarta');
$waktu = date('Y-m-d H:i:s');


//tampilkan data transaksi
$sql_get_transaksi = "select * from transaksi where id_transaksi='$id_transaksi'";
$query_get_transaksi = mysqli_query($connect, $sql_get_transaksi);
$get_transaksi = mysqli_fetch_array($query_get_transaksi);
//ambil data id_pengguna dan waktu_transaksi
$id_pengguna = $get_transaksi['id_pengguna'];
$waktu_transaksi = $get_transaksi['waktu_transaksi'];

// update dtaa keranjang
$sql_update_keranjang = "update keranjang set waktu='$waktu',status='dikirim' where id_pengguna='$id_pengguna' and waktu='$waktu_transaksi'";
$query_update_keranjang = mysqli_query($connect, $sql_update_keranjang);
// update data transaksi
$sql_update_transaksi = "update transaksi set waktu_transaksi='$waktu',status_transaksi='dikirim' where id_transaksi='$id_transaksi'";
$query_update_transaksi = mysqli_query($connect, $sql_update_transaksi);

if($query_update_transaksi){
	echo "<script> alert('Barang Dikirim'); window.location.href='home.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan Saat Mengirim, Silahkan Uangi.'); window.location.href='home.php' </script>";
}
?>