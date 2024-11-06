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
$nama_barang = $_POST['nama_barang'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$id_kategori = $_POST['id_kategori'];

//get gambar
$nama_foto = $_FILES['gambar']['name']; 
$file_tmp = $_FILES['gambar']['tmp_name'];
$lokasi = '../image/';
$pindah = move_uploaded_file($file_tmp, $lokasi.$nama_foto);

//memasukkan data ke database
$sql = "insert into barang (nama_barang,harga,stok,gambar,id_kategori) values ('$nama_barang','$harga','$stok','$nama_foto','$id_kategori')";
$query = mysqli_query($connect, $sql);

//cek apakah proses menyimpan data ke database berhasil atau tidak
if($query){
	echo "<script> window.location.href='barang.php' </script>";
}else{
	echo "<script> alert('Terjadi Kesalahan Saat Menyimpan Barang, Silahkan Ulangi'); window.location.href='barang.php' </script>";
}