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
	<title> Login </title>
	<link href="assets/img/keranjang.png" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #bae8e8;">
<div>
	<div class="row mt-5">
		<div class="d-flex justify-content-center align-items-center flex-column bg-white p-5" style="width: 40%; margin: 0 auto; border-radius: 1rem;">
			<h2 class="page-header">Login</h2>
			<form method="POST" style="width: 80%;">
				<div class="form-group">
					<div class="mb-2">
						<label>Username</label>
						<input type="text" class="form-control flat" name="user" placeholder="Username" maxlength="30" required/>
					</div>
					<div class="mb-3">
						<label>Password</label>
						<input type="password" class="form-control flat" name="pass" placeholder="Password" maxlength="20" required/>
					</div>
					<div class="d-flex align-items-center">
						<button class="btn btn-warning flat mr-2" type="submit" name="login">Login</button> 
						<span class="mr-2">Atau</span> 
						<a href="daftar.php" class="btn btn-secondary">Daftar</a>
					</div>
				</div>	
			</form>
			<?php
			if(isset($_POST['login'])){
				$user = $_POST['user'];
				$pass = $_POST['pass'];
				$sql = "select * from pengguna where username='$user' and password='$pass'";
				$query = mysqli_query($connect, $sql);
				$data = mysqli_fetch_array($query);
				$cek = mysqli_num_rows($query);
				$nama = $data['nama'];
				$hak = $data['hak'];
				$id = $data['id_pengguna'];
				if($cek > 0){ 
					if($hak == "pengguna"){ 
							$_SESSION['nama'] = $nama;
							$_SESSION['hak'] = $hak;
							$_SESSION['id'] = $id;
						?>
						<script> window.location.href='pengguna/home.php' </script>
				<?php }else if($hak == "admin"){ 
							$_SESSION['nama'] = $nama;
							$_SESSION['hak'] = $hak;
							$_SESSION['id'] = $id;
						?>
						<script> window.location.href='admin/home.php' </script>
				<?php }
				}else{ ?>
					<div class="alert alert-danger"> Login Gagal </div>
				<?php } 
			} ?>
		</div>		
	</div>	
</div>
</body>
</html>