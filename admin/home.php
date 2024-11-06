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
    <title>Medisku</title>
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
                    <li class="active"><a href="#">Pesanan</a></li>
                    <li><a href="pengguna.php">User</a></li>
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
        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Daftar Pesanan</h2>
            <a href="cetak_order.php" class="btn btn-success" target="_BLANK">Print</a>
        </div>
        <table id="tables" class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Alamat Pengiriman</th>
                    <th style="text-align: center;">No Telepon</th>
                    <th style="text-align: center;">No Rekening</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <?php
                $sql = "select * from pengguna inner join transaksi on pengguna.id_pengguna = transaksi.id_pengguna";
                $query = mysqli_query($connect, $sql);
                while ($data = mysqli_fetch_array($query)){ 
                    $status = $data['status_transaksi']; ?>
                    <tr>
                        <td><?php echo ucwords($data["nama"]); ?></td>
                        <td><?php echo ucwords($data["waktu_transaksi"]); ?></td>
                        <td><?php echo ucwords($data["alamat"]); ?></td>
                        <td><?php echo ucwords($data["no_hp"]); ?></td>
                        <td><?php echo ucwords($data["rekening"]); ?></td>
                        <td>
                            <?php if($status == 'proses kirim'){ ?>
                                Menunggu Konfirmasi
                            <?php }else if($status == 'dikirim'){ ?> 
                                Barang Dikirim 
                            <?php }else if($status == 'lunas'){ ?> 
                                Lunas
                            <?php } ?>
                        </td>
                        <td style="text-align: center;">
                        <?php if($status == 'proses kirim'){ ?>
                            <a href="lihat_barang.php?id_transaksi=<?php echo $data["id_transaksi"]; ?>" class="btn btn-primary">Lihat Barang</a>
                        <?php }else if($status == 'dikirim'){ ?> 
                            <a href="lihat_barang.php?id_transaksi=<?php echo $data["id_transaksi"]; ?>" class="btn btn-success">Lihat Barang</a>
                        <?php }else if($status == 'lunas'){ ?> 
                            <a href="lihat_barang.php?id_transaksi=<?php echo $data["id_transaksi"]; ?>" class="btn btn-warning">Lihat Barang</a>
                        <?php } ?>
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