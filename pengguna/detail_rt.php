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
    <title>DISTRO UTM</title>
    
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
        <?php
            $id_transaksi = $_GET['id_transaksi'];
            //get waktu transaksi
            $a = "select * from transaksi where id_transaksi='$id_transaksi'";
            $b = mysqli_query($connect, $a);
            $c = mysqli_fetch_array($b);
            $waktu_transaksi = $c['waktu_transaksi'];
            $subtotal = $c['subtotal'];
        ?>
        <div>
            <a href="riwayat_transaksi.php"><br><br>< Kembali</a>
        </div>
        <div class="page-header">
            <h1>Barang Sudah Sampai</h1>
            <div><?php echo "$waktu_transaksi"; ?></div>
        </div>
        <div class="row">
            <?php 
                //tampilkan barang
                $sql = "select * from barang inner join keranjang on barang.id_barang = keranjang.id_barang 
                where keranjang.id_pengguna='$id' and keranjang.waktu='$waktu_transaksi' and keranjang.status='lunas'";
                $query = mysqli_query($connect, $sql);
                $cek = mysqli_num_rows($query);
                if($cek > 0){
                    while($data = mysqli_fetch_array($query)){ ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                            <div class="text-center">
                                <img src="../image/<?php echo $data["gambar"]; ?>" style="width: max-content; height: 11rem; object-fit: cover; margin-bottom: 12px;">
                            </div>
                            <div class="caption">
                                <h4 align="center"><?php echo ucwords($data["nama_barang"]); ?></h4><hr>
                                <p>Jumlah Barang : <?php echo $data["jumlah_beli"]; ?></p>
                                <p>Harga Barang : Rp. <?php echo $data["harga_barang"]; ?></p>
                                <p>Total : Rp. <?php echo $data["total"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php } ?>
        </div>
        <h3 align="center"> Total Keseluruhan : Rp. <?php echo $subtotal; ?> </h3>
        <?php }else{ ?>
            <div style="text-align: center;">
                <img src="../assets/img/kosong.png">
                <h2>Belum Ada Barang</h2>
            </div>
        <?php } ?>
    </div>

    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>