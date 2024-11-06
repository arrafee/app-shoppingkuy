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
        <div class="page-header">
            <h2> Detail Barang Dibeli</h2>
        </div>
        <table id="tables" class="table table-responsive table-bordered table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;">Nama Barang</th>
                    <th style="text-align: center;">Tanggal</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: center;">Total</th>
                </tr>
            </thead>
            <?php
            //get id_transaksi
            $id_transaksi = $_GET['id_transaksi'];
            //tampilkan data transaksi
            $a = "select * from transaksi where id_transaksi='$id_transaksi'";
            $b = mysqli_query($connect, $a);
            $c = mysqli_fetch_array($b);
            //ambil data id_pengguna,waktu_transaksi,status dan subtotal
            $id_pengguna = $c['id_pengguna'];
            $waktu_transaksi = $c['waktu_transaksi'];
            $status = $c['status_transaksi'];
            $subtotal = $c['subtotal'];

            $sql = "select * from barang inner join keranjang on barang.id_barang = keranjang.id_barang where keranjang.id_pengguna='$id_pengguna' and keranjang.waktu='$waktu_transaksi'";
            $query = mysqli_query($connect, $sql);
            $cek = mysqli_num_rows($query);
            if($cek > 0){
                    while ($data = mysqli_fetch_array($query)){ ?>
                        <tr>
                            <td><?php echo ucwords($data["nama_barang"]); ?></td>
                            <td><?php echo ucwords($data["waktu"]); ?></td>
                            <td><?php echo ucwords($data["jumlah_beli"]); ?></td>
                            <td>Rp. <?php echo number_format($data["total"]); ?></td>
                        </tr>
                    <?php }
                ?>
                <tr>
                <td colspan="4" style="text-align: right;padding-right: 50px;"><b>Subtotal : Rp. <?php echo number_format($subtotal); ?></b></td>
                </tr>
            </table>
            <div class="text-center">
                <?php if($status == 'proses kirim'){ ?>
                    <a href="kirim.php?id_transaksi=<?php echo "$id_transaksi"; ?>" class="btn btn-primary">Kirim</a>
                <?php }else if($status == 'lunas'){ ?> 
                    <a href="hapus_riwayat_transaksi.php?id_transaksi=<?php echo "$id_transaksi"; ?>" onclick="return confirm('Anda Yakin?');" class="btn btn-danger">Hapus Riwayat Transaksi</a>
                <?php } ?>
            </div>
            <?php }else{ ?>
                <tr>
                    <td colspan="4">
                        <h3 align="center"> Transaksi Sudah Hangus </h3>
                        <div class="text-center">
                            <a href="hapus_riwayat_transaksi.php?id_transaksi=<?php echo "$id_transaksi"; ?>" class="btn btn-danger">Hapus Riwayat Transaksi</a>
                        </div>
                    </td>
                </tr>
            <?php }?>
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