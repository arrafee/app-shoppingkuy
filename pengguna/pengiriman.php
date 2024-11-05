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
                <a class="navbar-brand" href="#"> ShoppingKuy </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="home.php"> Home </a></li>
                    <li><a href="keranjang.php"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                    <li class="active"><a href="#"><span class="glyphicon glyphicon-send"></span></a></li>
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
    <div class="page-header">
        <h1>Barang Yang Dikirim <span class="glyphicon glyphicon-send"></span></h1>
    </div>
    <div>
        <h3>Lakukan Pembayaran ke Rekening Yang Telah di Sediakan</h3>
        <h3>Agar Pesanan Segera di Proses</h3>
        <a href="pembayaran.php" class="btn btn-success">Informasi Rekening Pembayaran</a>
    </div>
    <div class="row">
        <?php 
            $sql = "select * from pengguna inner join transaksi on pengguna.id_pengguna = transaksi.id_pengguna
            where pengguna.id_pengguna='$id' and transaksi.status_transaksi like '%kirim%'";
            $query = mysqli_query($connect, $sql);
            $cek = mysqli_num_rows($query);
            if($cek > 0){
                while($data = mysqli_fetch_array($query)){ ?>
                <div class="col-md-6 col-sm-6">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3><?php echo "$data[waktu_transaksi]"; ?></h3><hr>
                            <h4>Alamat : <?php echo ucwords("$data[alamat]"); ?></h4>
                            <h4>No Telepon : <?php echo ucwords("$data[no_hp]"); ?></h4>
                            <h4>No Rekening : <?php echo ucwords("$data[rekening]"); ?></h4>
                            <h4>Status : 
                                <?php
                                    $status = $data['status_transaksi'];
                                    if($status == "proses kirim"){
                                        echo "Menunggu Konfirmasi Admin";
                                    }else if($status == "dikirim"){
                                        echo "Barang Sudah Dikirim";
                                    }
                                 ?>
                            </h4>
                            <h4>Total : Rp. <?php echo "$data[subtotal]"; ?></h4>
                            <center>
                                <a href="detail.php?id_transaksi=<?php echo "$data[id_transaksi]"; ?>" class="btn btn-success">Lihat Detail Barang</a>
                            <?php if($status == "dikirim"){ ?>
                                <a href="terima_barang.php?id_transaksi=<?php echo "$data[id_transaksi]"; ?>" class="btn btn-primary">Barang Diterima</a>
                            <?php }else{ ?>
                                <a href="batal_beli.php?id_transaksi=<?php echo "$data[id_transaksi]"; ?>" class="btn btn-danger">Batal</a>
                            <?php } ?>
                            </center>
                            </div>
                    </div>
                </div>
                <!-- /.col -->
            <?php } ?>
    </div>
       <?php }else{ ?>
            <center><img src="../assets/img/kosong.png"><h2>Belum Ada Barang Yang Dikirim</center>
        <?php } ?>
</div>
<div class="register">
        <div class="container">
            <div class="register-home">
                <a href="home.php">Kembali</a>
            </div>
        </div>
    <!--Footer -->
   

    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>