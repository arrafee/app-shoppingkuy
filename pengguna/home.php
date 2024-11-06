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
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="keranjang.php" title="Keranjang Belanja">Keranjang</a></li>                    
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
    <br><br><br><br>
    <div class="container">      
        <div class="row">
            <div class="col-md-9">
                <div class="jumbotron">
                    <h1>Medisku</h1>
                    <p>Temukan kebutuhan kesehatan anda disini!</p>
                </div>
                <hr>
                <div class="row">
                    <?php
                        $page = (isset($_GET['page']))? $_GET['page'] : 1;
                        $limit = 9;
                        $limit_start = ($page - 1) * $limit;
                        $sql1 = "select * from barang LIMIT $limit_start, $limit";
                        $query1 = mysqli_query($connect,$sql1);
                        $cek = mysqli_num_rows($query1);
                        $no = 1;
                    if($cek > 0){
                        while ($row = mysqli_fetch_array($query1)){ ?>
                        <div class="col-md-3 text-center col-sm-6">
                            <div class="thumbnail">
                                <img src="../image/<?php echo $row["gambar"]; ?>" style="width: max-content; height: 11rem; object-fit: cover; margin-bottom: 12px">
                                <h4><?php echo ucwords($row["nama_barang"]); ?></h4>
                                <div>stok: <?php echo $row["stok"]; ?></div>
                                <p style="color: red;">Rp. <?php echo $row["harga"] ?> </p>
                                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModal<?php echo $no; ?>">Beli</button>
                            </div>
                        </div>
                        <!-- modal beli -->
                        <div id="myModal<?php echo "$no"; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- konten modal-->
                                <div class="modal-content">
                                    <!-- heading modal -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?php echo ucwords("$row[nama_barang]"); ?></h4>
                                    </div>
                                    <!-- body modal -->
                                    <div class="modal-body">
                                        <form method="POST" action="simpan_keranjang.php">
                                            <input type="number" class="form-control" name="jumlah" maxlength="2" value="1" placeholder="Masukkan Jumlah Pembelian.." required/>
                                            <input type="hidden" name="harga" value="<?php echo $row["harga"]; ?>">
                                            <input type="hidden" name="id_barang" value="<?php echo "$row[id_barang]"; ?>">
                                            <input type="hidden" name="stok" value="<?php echo $row["stok"]; ?>">
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
                    <?php $no++; }
                    }else{ ?>
                        <div style="text-align: center;">
                            <img src="../assets/img/kosong.png">
                            <h2>Barang Tidak Tersedia!!</h2>
                        </div>
                    <?php } ?>
                </div>

                <div class="row" style="text-align: center;">
                    <ul class="pagination">
                    <!-- LINK NUMBER -->
                    <?php
                    // Buat query untuk menghitung semua jumlah data
                    $q2 = "select * from barang";
                    $sql2 = mysqli_query($connect, $q2); // Eksekusi querynya
                    $get_jumlah = mysqli_num_rows($sql2);
                    
                    $jumlah_page = ceil($get_jumlah / $limit); // Hitung jumlah halamannya
                    $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                    $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                    $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
                    
                    for($i = $start_number; $i <= $end_number; $i++){
                      $link_active = ($page == $i)? ' class="active"' : '';
                    ?>
                      <li<?php echo $link_active; ?>><a href="home.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                   ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div>
                    <a class="list-group-item active ">Pencarian
                    </a>
                    <ul class="list-group">

                        <li class="list-group-item">
                            <form  action="search.php" method="POST">
                                <div class="col-md-9">
                                <input type="text" name="cari" class="form-control" placeholder="Telusuri.."><br>
                                </div>
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a class="list-group-item active">Kategori
                    </a>
                    <ul class="list-group">
                        <?php
                        $sql = "select * from kategori";
                        $query = mysqli_query($connect,$sql);
                        while ($data = mysqli_fetch_array($query)){ ?>
                            <li class="list-group-item"><a href="kategori.php?kategori=<?php echo "$data[id_kategori]"; ?>"><?php echo "$data[kategori]"; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div>
                    <a class="list-group-item active">Produk Baru
                    </a>
                    <ul class="list-group">
                        <?php
                            $a = "select * from barang order by id_barang desc limit 2";
                            $b = mysqli_query($connect,$a);
                            $modal = 1;
                            while ($c = mysqli_fetch_array($b)){ ?>
                            <li class="list-group-item">
                                <div class="thumbnaill">
                                    <div class="captionn">
                                        <h4><?php echo "$c[nama_barang]"; ?> <span class="badge"><?php echo "$c[stok]"; ?></span></h4>
                                        <p>Rp. <?php echo "$c[harga]" ?> </p>
                                        <p><button type="button" class="btn btn-success"  data-toggle="modal" data-target="#Modal<?php echo"$modal"; ?>">Beli</button></p>
                                    </div>
                                    <center><img src="<?php echo "../image/$c[gambar]"; ?>" width="70%" height="40%"/></center>
                                </div>
                            </li>
                        <div id="Modal<?php echo "$modal"; ?>" class="modal fade" role="dialog">
                           <div class="modal-dialog">
                            <!-- konten modal-->
                            <div class="modal-content">
                                <!-- heading modal -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo ucwords("$c[nama_barang]"); ?></h4>
                                </div>
                                <!-- body modal -->
                                <div class="modal-body">
                                    <form method="POST" action="simpan_keranjang.php">
                                    <input type="number" class="form-control" name="jumlah" maxlength="2" value="1" placeholder="Masukkan Jumlah Pembelian.." required/>
                                    <input type="hidden" name="harga" value="<?php echo "$c[harga]"; ?>">
                                    <input type="hidden" name="id_barang" value="<?php echo "$c[id_barang]"; ?>">
                                    <input type="hidden" name="stok" value="<?php echo "$c[stok]"; ?>">
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
                        <?php $modal++; } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- ANIMATE SCROLL -->
    <script src="../assets/js/animatescroll.js"></script>
    <!-- HOVER IMAGE EFFECT -->
    <script src="../assets/js/hover.image.effect.js"></script>
</body>
</html>
