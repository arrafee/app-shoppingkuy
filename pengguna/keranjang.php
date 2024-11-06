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
                    <li class="active"><a href="keranjang.php" title="Keranjang Belanja">Keranjang</a></li>                    
                    <li><a href="pengiriman.php" title="Pengiriman">Pengiriman</a></li>
                    <li><a href="riwayat_transaksi.php" title="Riwayat Transaksi">Riwayat</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="user.php"><?php echo ucwords($nama); ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
    <div class="container" style="margin-bottom: 3rem;">
        <div>
            <a href="home.php"><br><br>< Kembali</a>
        </div>
        <div class="page-header">
            <h1>Keranjang Belanja</h1>
        </div>
        <?php 
            $sql = "select * from barang inner join keranjang on barang.id_barang = keranjang.id_barang where keranjang.id_pengguna='$id' and status='belum bayar'";
            $query = mysqli_query($connect, $sql);
            $cek = mysqli_num_rows($query);
            if($cek > 0){ ?>
                <div>
                    <h4>Lakukan Pembayaran ke Rekening Yang Telah di Sediakan</h4>
                    <h4>Agar Pesanan Segera di Proses</h4>
                    <a href="pembayaran.php" class="btn btn-success">Informasi Rekening Pembayaran</a>
                </div>
                <br>
                <div class="row">
                    <?php $data_id_keranjang = []; 
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
                                    <div style="text-align: center;">
                                        <a href="hapus_barang_keranjang.php?id=<?php echo $data["id_keranjang"] ?>" onclick="return confirm('Anda Yakin?')" class="btn btn-danger">Hapus Barang</a>
                                    </div>
                                    <?php $data_id_keranjang[] = $data['id_keranjang'] ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php
                $a = "select SUM(total) as subtotal from keranjang where id_pengguna='$id' and status='belum bayar'";
                $b = mysqli_query($connect, $a);
                $c = mysqli_fetch_array($b);
                $total_semua = $c['subtotal'];
            ?>
            <div>
                <h3 align="center"> Total Keseluruhan : Rp. <?php echo $total_semua; ?> </h3>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Checkout</button>
                </div>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- konten modal-->
                    <div class="modal-content">
                        <!-- heading modal -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- body modal -->
                        <form action="checkout.php" method="POST">
                            <input type="hidden" name="id_keranjang" value="<?php echo implode(" ", $data_id_keranjang) ?>">
                            <div class="modal-body">
                                <input type="hidden" name="sub" value="<?php echo $total_semua; ?>">
                                <input type="text" name="alamat" maxlength="40" class="form-control" placeholder="Masukkan Alamat Anda.." required/> <br>
                                <input type="number" name="no_hp" maxlength="15" class="form-control" placeholder="Masukkan No Telepon Anda.." required/><br>
                                <input type="number" name="rekening" maxlength="15" class="form-control" placeholder="Masukkan No Rekening Anda.." required/>
                                <H5> Bukti Transaksi / Pembayaran </H5>
                                <input type="file" name="gambar" required/>
                            </div>
                            <!-- footer modal -->
                            <div class="modal-footer">
                                <a class="btn btn-default" data-dismiss="modal">Batal</a>
                                <input type="submit" class="btn btn-primary" value="OK">
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
            <?php }else{ ?>
                <div style="text-align: center;">
                    <img src="../assets/img/kosong.png">
                    <h2>Belum Ada Barang Di Keranjang</h2>
                </div>
            <?php } ?>
    </div>

    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>