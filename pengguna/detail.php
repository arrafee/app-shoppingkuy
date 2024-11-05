<?php session_start();
if(empty($_SESSION['nama'])){ ?>
    <script> window.location.href='../index.php' </script>
<?php }
$nama = $_SESSION['nama'];
$id = $_SESSION['id'];
if($_SESSION['hak'] == 'pengguna'){}else{ ?> <script> alert('Anda Bukan Pengguna!'); window.location.href='logout.php' </script> <?php }
include "../koneksi/config.php";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ShoppingKuy </title>
    <link href="../assets/img/barley.jpeg" rel="shorcut icon">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <style>         

    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Let's Shopping</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="home.php"> Home </a></li>
                    <li><a href="keranjang.php" title="Keranjang Belanja"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                    <li><a href="pengiriman.php" title="Pengiriman"><span class="glyphicon glyphicon-send"></span></a></li>
                    <li><a href="riwayat_transaksi.php" title="Riwayat Transaksi"><span class="glyphicon glyphicon-list-alt"></span></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="user.php"><?php echo ucwords("$nama"); ?></a></li>
                    <li><a href="logout.php">Logout</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <br><br>
<div class="container">
<?php
    $id_transaksi = $_GET['id_transaksi'];
    //get waktu transaksi
    $a = "select * from transaksi where id_transaksi='$id_transaksi'";
    $b = mysqli_query($connect, $a);
    $c = mysqli_fetch_array($b);
    $waktu_transaksi = $c['waktu_transaksi'];
    $subtotal = $c['subtotal'];
?>
    <div class="page-header">
        <h1>Daftar Barang Yang Dikirim<small> <?php echo "$waktu_transaksi"; ?></small></h1>
    </div>
    <div class="row">
        <?php 
            //tampilkan barang
            $sql = "select * from barang inner join keranjang on barang.id_barang = keranjang.id_barang 
            where keranjang.id_pengguna='$id' and keranjang.waktu='$waktu_transaksi' and keranjang.status like '%kirim%'";
            $query = mysqli_query($connect, $sql);
            $cek = mysqli_num_rows($query);
            if($cek > 0){
                while($data = mysqli_fetch_array($query)){ ?>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail">
                        <img src="../image/<?php echo "$data[gambar]"; ?>" width="50%" height="30%">
                        <div class="caption">
                            <h4 align="center"><?php echo ucwords("$data[nama_barang]"); ?></h4><hr>
                            <p>Jumlah Barang : <?php echo "$data[jumlah_beli]"; ?></p>
                            <p>Harga Barang : Rp. <?php echo "$data[harga_barang]"; ?></p>
                            <p>Total : Rp. <?php echo "$data[total]"; ?></p>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            <?php } ?>
    </div>
    <center><h2>Total Keseluruhan : Rp. <?php echo $subtotal; ?></h2></center>
        <?php }else{ ?>
            <center><img src="../assets/img/kosong.png"><h2>Barang Sudah Dihapus</center>
        <?php } ?>
</div>
    <!--Footer -->
   
    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>