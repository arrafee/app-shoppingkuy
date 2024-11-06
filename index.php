<?php 
	session_start();
	include "koneksi/config.php";

	if(isset($_SESSION['nama'])){
		$hak = $_SESSION['hak'];
		if($hak == "pengguna"){
			echo "<script> window.location.href='pengguna/home.php' </script>";
		} else if($hak == "admin"){
			echo "<script> window.location.href='admin/home.php' </script>";
		} 
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Medisku </title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
</head>
<body >
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Medisku</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="daftar.php">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container" style="padding-top: 8rem;">
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
                        if ($cek > 0) {
                            while ($row = mysqli_fetch_array($query1)){ ?>
                            <div class="col-md-3 text-center col-sm-6">
                                <div class="thumbnail">
                                    <img src="image/<?php echo $row['gambar'] ?>" style="width: max-content; height: 11rem; object-fit: cover; margin-bottom: 12px">
                                    <div><?php echo ucwords($row['nama_barang']); ?></div>
                                    <div>stok: <?php echo "$row[stok]"; ?></div>
                                    <p style="color: red;">Rp. <?php echo "$row[harga]" ?> </p>
                                </div>
                            </div>
                            <?php }
                        } else { ?>
                            <div style="text-align: center;">
                                <img src="assets/img/kosong.png">
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
                        <li<?php echo $link_active; ?>><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                        }
                    ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div>
                    <a class="list-group-item active ">Pencarian</a>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <form  action="search.php" method="POST">
                                <div class="col-md-9">
                                    <input type="text" name="cari" class="form-control" placeholder="Telusuri..">
                                </div>
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div>
                    <a class="list-group-item active">Kategori</a>
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
                    <a class="list-group-item active">Produk Baru</a>
                    <ul class="list-group">
                        <?php
                            $sql_barang = "select * from barang order by id_barang desc limit 2";
                            $query_barang = mysqli_query($connect,$sql_barang);
                            while ($row = mysqli_fetch_array($query_barang)){ ?>
                            <li class="list-group-item">
                                <div>
                                    <h4><?php echo "$row[nama_barang]"; ?>
                                    <div>stok: <?php echo "$row[stok]"; ?></div>
                                    <p>Rp. <?php echo "$row[harga]" ?> </p>
                                    <img src="<?php echo "image/$row[gambar]"; ?>" style="width: max-content; height: 16rem; object-fit: cover; margin-top: 12px"/>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
              
            </div>

            </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>