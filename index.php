<?php 
session_start();
if(isset($_SESSION['nama'])){
    $hak = $_SESSION['hak'];
        if($hak == "pengguna"){ ?>
            <script> window.location.href='pengguna/home.php' </script>
        <?php }else if($hak == "admin"){ ?>
            <script> window.location.href='admin/home.php' </script>
        <?php }
    ?>
<?php }
include "koneksi/config.php";
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ShoppingKuy </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>         
    body {
      ;
    }
    </style>

</head>
<body >
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                </button>
                <a class="navbar-brand" href="#">ShoppingKuy<span class="glyphicon glyphicon-shopping-cart"></span></a>
                
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="daftar.php">Daftar</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<br><br><br><br>
    <div class="container">
      
        <div class="row">

            <div class="col-md-9">
                    
              <div class="jumbotron">
                  <h1>ShoppingKuy <width="15%" height="15%"></h1>
                  <p>
                    Find your outfit in here!
                  </p><br><br><br>
                  <p>
                    <a href="#" onclick="$('#get').animatescroll({scrollSpeed:2000,easing:'easeOutBack'});" class="btn btn-primary btn-lg"> Belanja</a>
                  </p>
                  <div id="get"></div>
                </div><hr>
              <div class="row">
                <?php
                    $page = (isset($_GET['page']))? $_GET['page'] : 1;
                    $limit = 9;
                    $limit_start = ($page - 1) * $limit;
                    $sql1 = "select * from barang LIMIT $limit_start, $limit";
                    $query1 = mysqli_query($connect,$sql1);
                    $cek = mysqli_num_rows($query1);
                    if($cek > 0){
                    while ($row = mysqli_fetch_array($query1)){ ?>
                    <div class="col-md-3 text-center col-sm-6">
                        <div class="thumbnail">
                            <img src="<?php echo "image/$row[gambar]"; ?>" width="50%" height="30%">
                            <div class="caption">
                                <h4><?php echo ucwords("$row[nama_barang]"); ?> <span class="badge"><?php echo "$row[stok]"; ?></span></h4>
                                <p style="color: red;">Rp. <?php echo "$row[harga]" ?> </p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                <?php }
                }else{ ?>
                    <center><img src="assets/img/kosong.png"><h2>Barang Tidak Tersedia!!</h2></center>
                <?php } ?>
                </div>

            <center>
                <!-- /.row -->
                <div class="row">
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
                      <li<?php echo $link_active; ?>><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                   ?>
                    </ul>
                </div>
                <!-- /.row -->
            </center>
            <!-- /.col -->
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
                        include "koneksi/config.php";
                        $sql = "select * from kategori";
                        $query = mysqli_query($connect,$sql);
                        while ($data = mysqli_fetch_array($query)){ ?>
                            <li class="list-group-item"><a href="kategori.php?kategori=<?php echo "$data[id_kategori]"; ?>"><?php echo "$data[kategori]"; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.div -->
                <div>
                    <a class="list-group-item active">Produk Baru
                    </a>
                    <ul class="list-group">
                        <?php
                            $a = "select * from barang order by id_barang desc limit 2";
                            $b = mysqli_query($connect,$a);
                            while ($c = mysqli_fetch_array($b)){ ?>
                            <li class="list-group-item">
                                <div class="thumbnaill">
                                    <div class="captionn">
                                        <h4><?php echo "$c[nama_barang]"; ?> <span class="badge"><?php echo "$c[stok]"; ?></span></h4>
                                        <p>Rp. <?php echo "$c[harga]" ?> </p>
                                    </div>
                                    <center><img src="<?php echo "image/$c[gambar]"; ?>" width="70%" height="40%"/></center>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.div -->
              
            </div>
            <!-- /.col -->

            </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    
    <!--Footer -->
    <footer>
     <link rel="stylesheet" href="style1.css">
    <div class="footer-content">
        <div class="content-pesan">
            <h2>Contact Person</h2>
            <ul>
                <li><a href=""><img src="email.png" width="40px" height="40px">shoppingkuy@xxxx.com </li><br>
                <li><a href="#"><img src="wa.png" width="40px" height="40px"> 08xxxx</a></li>
            </ul>
        </div>
         <div class="content-social">
            <h2>Social Media</h2>
            <ul>
                <li><a href=""><img src="ig.png" width="40px" height="40px">@XXX </li><br>
                <li><a href="#"><img src="tt.png" width="40px" height="40px"> @XXX</a></li>
            </ul>
        </div>
    </div>
</footer>

    <!-- /.col -->
    <!--Footer end -->
    <!--jQUERY FILES-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- ANIMATE SCROLL -->
    <script src="assets/js/animatescroll.js"></script>
    <!-- HOVER IMAGE EFFECT -->
    <script src="assets/js/hover.image.effect.js"></script>
</body>
</html>