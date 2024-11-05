<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php } 
if($_SESSION['hak'] == 'pengguna'){}else{ ?> <script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script> <?php }
	include "../koneksi/config.php";
	//mendapatkan id_pengguna yang dikirim melalui session
	$id_pengguna = $_SESSION['id'];
	//mendapatkan id_transaksi yang dikirim melalui link
	$id_transaksi = $_GET['id_transaksi'];

	//menampilkan data transaksi berdasarkan id_transaksi
	$a = "select * from transaksi where id_transaksi='$id_transaksi'";
	$b = mysqli_query($connect, $a);
	$c = mysqli_fetch_array($b);
	//get waktu_transaksi
	$waktu_transaksi = $c['waktu_transaksi'];

	//hapus data keranjang berdasarkan waktu_transaksi dan id_pengguna
	$d = "delete from keranjang where id_pengguna='$id_pengguna' and waktu='$waktu_transaksi'";
	$e = mysqli_query($connect, $d);

	//hapus data transaksi berdasarkan id_transaksi
	$f = "delete from transaksi where id_transaksi='$id_transaksi'";
	$g = mysqli_query($connect, $f);

	if($g){
		echo "<script> window.location.href='pengiriman.php' </script>";
	}else{
		echo "<script> alert('Terjadi Kesalahan Saat Menghapus, Silahkan Ulangi.'); window.location.href='pengiriman.php' </script>";
	}

?>