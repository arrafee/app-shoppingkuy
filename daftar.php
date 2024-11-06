<?php 
	session_start();
	include "koneksi/config.php";

	if(isset($_SESSION['nama'])){
		$hak = $_SESSION['hak'];
		if($hak == "pengguna"){
			echo "<script> window.location.href='pengguna/home.php' </script>";
		} else if($hak == "admin"){
			echo "<script> window.location.href='admin/home.php' </script>";
		} 
	}
?>

<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar </title>
	<link href="assets/img/keranjang.png" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #bae8e8;">
<div>
	<div class="row mt-4">
		<div class="d-flex justify-content-center align-items-center flex-column bg-white p-5" style="width: 40%; margin: 0 auto; border-radius: 1rem;">
			<h2 class="page-header">Daftar</h2>
			<form method="POST" style="width: 80%;"> 
				<div class="form-group">
					<div class="mb-2">
						<label>Nama</label>
						<input type="text"  class="form-control" name="nama" maxlength="20" placeholder="Nama" required title="nama harus berisi character">
					</div>
					<div class="mb-2">
						<label>Username</label>
						<input type="text" class="form-control" name="user" maxlength="20" placeholder="Username" required/>
					</div>
					<div class="mb-2">
						<label>Password</label>
						<input type="password" class="form-control" name="pass" maxlength="20" placeholder="Password" required/>
					</div>
					<div class="mb-2">
						<label>Jenis Kelamin</label>
						<select class="form-control" name="jenis_kelamin">
							<option> Laki - Laki </option>
							<option> Perempuan </option>
						</select>
					</div>
					<div class="mb-3">
						<label>Tanggal Lahir</label>
						<input type="date" class="form-control" name="tgl_lahir" maxlength="20" required/>
					</div>
					<div>
						<button class="btn btn-success" type="submit" name="daftar">Daftar</button>
						<a href="index.php" class="btn btn-danger text-white" style="cursor: pointer;"> Batal </a>
					</div>
				</div>	
			</form>
			<?php
				if(isset($_POST['daftar'])){
					$nama = $_POST['nama'];
					$jenis_kelamin = $_POST['jenis_kelamin'];
					$tgl_lahir = $_POST['tgl_lahir'];
					$user = $_POST['user'];
					$pass = $_POST['pass'];
					$sql = "insert into pengguna(nama,jenis_kelamin,tgl_lahir,username,password,hak) values ('$nama','$jenis_kelamin','$tgl_lahir','$user','$pass','pengguna')";
					$query = mysqli_query($connect, $sql);
					if($query){
						echo "<script> alert('Pendaftaran Berhasil. Silahkan Lakukan Login.'); window.location.href='login.php' </script>";
					}else{ ?>
						<div class="alert alert-danger"> Pendaftaran Gagal </div>
					<?php }
				}
			?>
		</div>
	</div>	
</div>
</body>
</html>