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
                <a class="navbar-brand" href="#"> Let's Shopping</a>
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
        <h1 align="center">Tata Cara Penggunaan Aplikasi</h1><br><br>

<form action="" method="post">
<div class="register">
    </div>
    <section class="section bg-grey" id="feature">

        <div class="container">
            <div class="row justy-content-center">
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                    <button><h4 class="mb-2"><br><a href="logout.php">Daftar atau Login</a></h4></button>
                        <p>Buat akun mu terlebih dahulu sebelum memesan produk dari kami</p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <h4 class="mb-2"><button><br><a href="home.php">Lihat dan Pilih Produk</a></button></h4>
                        <p>Lihat dan Pilih Produk yang ingin kamu beli kemudian jangan lupa tambahkan Keranjang Belanja Anda</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <h4 class="mb-2"><button><br><a href="keranjang.php">Hapus Produk Pada Keranjang</a></button></h4>
                        <p>Klik button Hapus Barang pada produk yang sudah anda pilih pada menu keranjang belanja anda</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <h4 class="mb-2"><button><br><a href="keranjang.php">Checkout dan Lakukan Pembayaran</a></button></h4>
                        <p>Setelah memilih barang dan melakukan checkout barang, segera Lakukan Pembayaran ke nomer rekening bank ShopingKuy yang tersedia pada Informasi Rekening Pembayaran </p>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                         <h4 class="mb-2"><button><br><a href="pengiriman.php">Cek Status Pengiriman</a></button></h4>
                         <p>Produk akan di Konfirmasi Oleh admin jika sudah pelakukan pembayaran. Cek Status pengiriman produk kamu Pada Menu Barang Yang Dikirim
                            <br> Jika Barang Sudah Diterima, Klik Button Barang Diterima
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6">
                    <div class="text-center feature-block">
                        <h4 class="mb-2"><button><br><a href="riwayat_transaksi.php">Cek dan Cetak Riwayat Transaksi</a></button></h4>
                        <p>Lihat Riwayat Transaksi Anda pada menu Riwayat Transaksi dan Dapat mencetak/print nota atau bukti transaksi anda</p>
                    </div>
            </div>
        </div> <!-- / .container -->
        <br><br><div class="register" align="center">
        <div class="container">
            <div class="register-home">
                <button><a href="home.php">Kembali</a></button>
            </div>
        </div>
    </section><br><Br><br>
    <!--Footer -->
   
    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>