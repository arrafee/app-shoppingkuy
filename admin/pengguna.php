<?php
    session_start();
    include "../koneksi/config.php";

    if(empty($_SESSION['nama'])){
        echo "<script> window.location.href='../index.php' </script>";
    }
    if($_SESSION['hak'] != 'admin'){
        echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ShoppingKuy</title>
    
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!-- Datatables core CSS -->
    <link href="../assets/css/datatables.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> Medisku </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="home.php">Pesanan</a></li>
                    <li class="active"><a href="pengguna.php">User</a></li>
                    <li><a href="kategori.php">Kategori</a></li>
                    <li><a href="barang.php">Produk</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="user.php"><?php echo ucwords($_SESSION['nama'] ) ?></a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br><br>
        <div class="page-header">
            <h2> Data Pengguna </h2>
        </div>
        <table id="tables" class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Username</th>
                    <th style="text-align: center;">Hak Akses</th>
                    <th style="text-align: center;">Jenis Kelamin</th>
                    <th style="text-align: center;">Tanggal Lahir</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <?php
                $sql = "select * from pengguna where not hak='admin'";
                $query = mysqli_query($connect, $sql);
                while ($data = mysqli_fetch_array($query)){ ?>
                    <tr>
                        <td><?php echo ucwords($data["nama"]); ?></td>
                        <td><?php echo ucwords($data["username"]); ?></td>
                        <td><?php echo ucwords($data["hak"]); ?></td>
                        <td><?php echo ucwords($data["jenis_kelamin"]); ?></td>
                        <td><?php echo ucwords($data["tgl_lahir"]); ?></td>
                        <td style="text-align: center;">
                            <a href="hapus_pengguna.php?id_pengguna=<?php echo $data["id_pengguna"]; ?>" onclick='return confirm("Anda Yakin?")' class="btn btn-danger">Hapus</a>
                        </td>
                    </td>
                    </tr>
                <?php }
            ?>
        </table>
    </div>

    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- DATATABLES FILES -->
    <script src="../assets/js/datatables.js"></script>
    <script>
    	$(document).ready(function () {
		  $('#tables').DataTable();
		  $('.dataTables_length').addClass('bs-select');
		});
	</script>
</body>
</html>