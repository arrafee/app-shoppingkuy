<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php } 
if($_SESSION['hak'] == 'admin'){}else{ ?> <script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script> <?php }
	include "../koneksi/config.php";
    $id_pengguna = $_GET['id_pengguna'];


		$sql = "DELETE FROM pengguna WHERE id_pengguna='$id_pengguna'";
		$query = mysqli_query($connect, $sql);
        
        if($query){
            echo "<script> alert('Data Sudah Dihapus'); window.location.href='pengguna.php' </script>";
        }else{
            echo "<script> alert('Terjadi Kesalahan Saat Menghapus, Silahkan Uangi.'); window.location.href='pengguna.php' </script>";
        }