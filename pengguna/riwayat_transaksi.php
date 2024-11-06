<?php
session_start();
include "../koneksi/config.php";

if(empty($_SESSION['nama'])){
    echo "<script> window.location.href='../index.php' </script>";
}
if($_SESSION['hak'] != 'pengguna'){
    echo "<script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script>";
}

$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Medisku </title>
    
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <style>         

    </style>
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
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a class="navbar-brand" href="home.php">Medisku</a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="keranjang.php" title="Keranjang Belanja">Keranjang</a></li>                    
                    <li><a href="pengiriman.php" title="Pengiriman">Pengiriman</a></li>
                    <li class="active"><a href="riwayat_transaksi.php" title="Riwayat Transaksi">Riwayat</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="user.php"><?php echo ucwords($nama); ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
    <div class="container">
        <div>
            <a href="home.php"><br><br>< Kembali</a>
        </div>
        <div class="page-header">
            <h1>Riwayat Transaksi</h1>
        </div>
        <div class="row">
            <?php 
                $sql = "select * from pengguna inner join transaksi on pengguna.id_pengguna = transaksi.id_pengguna
                where pengguna.id_pengguna='$id' and transaksi.status_transaksi='lunas'";
                $query = mysqli_query($connect, $sql);
                $cek = mysqli_num_rows($query);
                if($cek > 0){
                    while($data = mysqli_fetch_array($query)){ ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3><?php echo "$data[waktu_transaksi]"; ?></h3>
                                <h5><?php echo ucwords("$data[nama]"); ?></h5><hr>
                                <h4>Alamat : <?php echo ucwords("$data[alamat]"); ?></h4>
                                <h4>No Telepon : <?php echo ucwords("$data[no_hp]"); ?></h4>
                                <h4>Status : <?php echo ucwords("$data[status_transaksi]") ?></h4>
                                <h4>Total : Rp. <?php echo "$data[subtotal]"; ?></h4>
                                <td align="center">
                                    <a href="detail_rt.php?id_transaksi=<?php echo "$data[id_transaksi]"; ?>" class="btn btn-success">Lihat Detail Barang</a>
                                    <a href="print.php" target="_BLANK" class="btn btn-info">Print</a> 
                                </td>
                                </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php } ?>
        </div>
        <?php }else{ ?>
                <div style="text-align: center;">
                    <img src="../assets/img/kosong.png">
                    <h2>Belum ada barang yang dikirim</h2>
                </div>
            <?php } ?>
    </div>

    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>