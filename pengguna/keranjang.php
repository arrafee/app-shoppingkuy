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
    <link href="../assets/img/keranjang.png" rel="shorcut icon">
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
                    <li class="active"><a href="keranjang.php"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
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
    <div class="page-header">
        <h1>Keranjang Belanja <img src="../assets/img/keranjang.png" width="5%" height="5%"></h1>
    </div>
    <div class="row">
    <form action="checkout.php" method="POST">
        <?php 
            $sql = "select * from barang inner join keranjang on barang.id_barang = keranjang.id_barang where keranjang.id_pengguna='$id' and status='belum bayar'";
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
                            <center><a href="hapus_barang_keranjang.php?id=<?php echo "$data[id_keranjang]" ?>" onclick="return confirm('Anda Yakin?')" class="btn btn-danger">Hapus Barang</a></center>
                            <input type="hidden" name="id_keranjang[]" value="<?php echo "$data[id_keranjang]"; ?>">
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            <?php } ?>
    </div>
        <?php
            $a = "select SUM(total) as subtotal from keranjang where id_pengguna='$id' and status='belum bayar'";
            $b = mysqli_query($connect, $a);
            $c = mysqli_fetch_array($b);
            $total_semua = $c['subtotal'];
         ?>
        <h3 align="center"> Total Keseluruhan : Rp. <?php echo $total_semua; ?> </h3>
        <center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Checkout</button></center>
        <div id="myModal" class="modal fade" role="dialog">
           <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                        <input type="hidden" name="sub" value="<?php echo $total_semua; ?>">
                        <input type="text" name="alamat" maxlength="40" class="form-control" placeholder="Masukkan Alamat Anda.." required/> <br>
                        <input type="text" name="no_hp" maxlength="15" class="form-control" placeholder="Masukkan No Telepon Anda.." required/><br>
                        <input type="text" name="rekening" maxlength="15" class="form-control" placeholder="Masukkan No Rekening Anda.." required/>
                        <H5> Bukti Transaksi / Pembayaran </H5>
                        <input type="file" name="gambar" required/>
                    </div>
                <!-- footer modal -->
                <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Batal</a>
                        <input type="submit" class="btn btn-primary" value="OK">
                    </form>
                </div>
            </div>
        </div>
    </div>
        <?php }else{ ?>
            <center><img src="../assets/img/kosong.png"><h2>Belum Ada Barang Di Keranjang</center>
        <?php } ?>
</div>
<div class="register">
        <div class="container">
            <div class="register-home">
                <a href="home.php"><br><br>Kembali</a>
            </div>
        </div><br>
    <!--Footer -->


    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>