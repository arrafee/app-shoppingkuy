<?php session_start();
if(isset($_SESSION['nama'])){
    $hak = $_SESSION['hak'];
        if($hak == "pengguna"){ ?>
            <script> window.location.href='pengguna/home.php' </script>
        <?php }else if($hak == "admin"){ ?>
            <script> window.location.href='admin/home.php' </script>
        <?php }
    ?>
<?php }
include "koneksi/config.php";
 ?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar </title>
	<link href="assets/img/keranjang.png" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
    	.flat{
    		border-radius: 0px;
    	}
	</style>
</head>
<body style="background: #bae8e8;">
<div class="container">
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
		<h2 class="page-header">Daftar</h2>
			<form method="POST">
				<div class="form-group">
					<label>Nama</label><br>
					<input type="text"  class="form-control flat" name="nama" maxlength="20" placeholder="Nama" required title="nama harus berisi character"><br>
					<label>Jenis Kelamin</label>
					<select class="form-control flat" name="jenis_kelamin">
						<option> Laki - Laki </option>
						<option> Perempuan </option>
					</select><br>
					<label>Tanggal Lahir</label><br>
					<input type="date" class="form-control flat" name="tgl_lahir" maxlength="20" required/><br>
					<label>Username</label><br>
					<input type="text" class="form-control flat" name="user" maxlength="20" placeholder="Username" required/><br>
					<label>Password</label><br>
					<input type="password" class="form-control flat" name="pass" maxlength="20" placeholder="Password" required/>
					<br>
					<button class="btn btn-success flat" type="submit" name="daftar">Daftar</button>
					<a onclick="window.location.href='index.php'" class="btn btn-danger flat"> Batal </a>
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
		<div class="col-sm-4">
		</div>		
	</div>	
</div>
</body>
</html>