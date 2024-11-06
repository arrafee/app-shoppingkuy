<?php 
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'admin'){
    echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
}

$id = $_SESSION['id'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tgl_lahir = $_POST['tgl_lahir'];
$user = $_POST['user'];
$pass_lama = $_POST['pass_lama'];
$pass_baru = $_POST['pass_baru'];

//cek password lama benar atau tidak
$sql_get_user = "select * from pengguna where id_pengguna='$id' and password='$pass_lama'";
$query_get_user = mysqli_query($connect, $sql_get_user);
$get_user = mysqli_num_rows($query_get_user);

if($get_user > 0){
	//update data user
	$sql = "update pengguna set nama='$nama',jenis_kelamin='$jenis_kelamin',tgl_lahir='$tgl_lahir',username='$user',password='$pass_baru' where id_pengguna='$id'";
	$query = mysqli_query($connect, $sql);

	if($query){
		echo "<script> window.location.href='user.php' </script>";
	}else{
		echo "<script> alert('Gagal Memperbaharui, Terjadi Kesalahan.'); window.location.href='user.php' </script>";
	}

}else{
	echo "<script> alert('Pembaruan Akun Gagal, Password Yang Anda Masukkan Salah.'); window.location.href='user.php' </script>";
}