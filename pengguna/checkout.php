<?php
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'pengguna'){
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Medisku</title>

	<link href="../assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>
	<?php
		$id_pengguna = $_SESSION['id'];
		$subtotal = $_POST['sub'];
		$alamat = $_POST['alamat'];
		$no_hp = $_POST['no_hp'];
		$rek = $_POST['rekening'];
		//get waktu
		date_default_timezone_set('Asia/Jakarta');
		$waktu = date('Y-m-d H:i:s');

		//update waktu dan status tabel keranjang
		$keranjang = explode(" ",$_POST['id_keranjang']);
		$count = count($keranjang);
		for($i=0; $i<$count; $i++){
			$a = "update keranjang set waktu='$waktu',status='proses kirim' where id_keranjang='".$keranjang[$i]."'";
			$b = mysqli_query($connect, $a);
		}

		//insert tabel transaksi
		$c = "insert into transaksi (waktu_transaksi,subtotal,status_transaksi,alamat,no_hp,rekening,id_pengguna) values ('$waktu','$subtotal','proses kirim','$alamat','$no_hp','$rek','$id_pengguna')";
		$d = mysqli_query($connect, $c);

		if($d){ ?>
			<div class="container">
				<br><br><center><h2>Barang Akan Dikirim Setelah Dikonfirmasi Oleh Admin</h2>
				<h4>Pilih menu pengiriman di navbar untuk melihat daftar barang yang sudah dikirim. <br><br>
				Lakukan pembayaran kepada kurir kami saat barang yang anda beli sudah sampai.<br><br>
				Tekan tombol <a class="btn btn-primary">Barang Diterima</a> di menu pengiriman jika anda sudah menerima barang yang anda beli</h4><br><br>
				<a href="pengiriman.php" class="btn btn-warning btn-lg">OK</a></center>
			</div>
		<?php }else{
			echo "<script> alert('Terjadi Kesalahan'); window.location.href='keranjang.php' </script>";
		}
	?>
</body>
</html>