<?php
    session_start();
    include "../koneksi/config.php";

    if(empty($_SESSION['nama'])){
        echo "<script> window.location.href='../index.php' </script>";
    }
    if($_SESSION['hak'] != 'admin'){
        echo "<script> alert('Anda Bukan Admin!'); window.location.href='logout.php' </script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medisku</title>
    
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!-- Datatables core CSS -->
    <link href="../assets/css/datatables.css" rel="stylesheet">
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
          <a class="navbar-brand" href="home.php"> Medisku </a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li><a href="home.php">Pesanan</a></li>
              <li><a href="pengguna.php">User</a></li>
              <li><a href="kategori.php">Kategori</a></li>
              <li class="active"><a href="barang.php">Produk</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li>
                  <a href="user.php"><?php echo ucwords($_SESSION['nama'] ) ?></a>
              </li>
              <li>
                  <a href="logout.php">Logout</a>
              </li>
          </ul>
      </div>
    </div>
  </nav>

  <div class="container">
   <br><br>
   <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
   	<h2> Data Barang </h2>
    <button class="btn btn-primary" data-toggle="modal" data-target="#TambahBarang">Tambah Barang</button>
   </div>
   <table id="tables" class="table table-responsive table-bordered table-striped">
   	<thead>
   		<tr>
        <th style="text-align: center;">Nama Barang</th>
        <th style="text-align: center;">Harga</th>
   			<th style="text-align: center;">Stok</th>
   			<th style="text-align: center;">Kategori</th>
        <th style="text-align: center;">Aksi</th>
   		</tr>
   	</thead>
   	<?php
   		$sql = "select * from kategori inner join barang on kategori.id_kategori = barang.id_kategori";
   		$query = mysqli_query($connect, $sql);
      $no = 1;
   		while ($data = mysqli_fetch_array($query)){ ?>
   			<tr>
          <td><?php echo ucwords("$data[nama_barang]"); ?></td>
          <td>Rp. <?php echo number_format($data['harga']); ?></td>
          <td><?php echo ucwords("$data[stok]"); ?></td>
   				<td><?php echo ucwords("$data[kategori]"); ?></td>
          <td><center><button class="btn btn-success" data-toggle="modal" data-target="#EditBarang<?php echo $no; ?>">Edit</button>
            <a href="hapus_barang.php?id_barang=<?php echo "$data[id_barang]"; ?>" onclick='return confirm("Anda Yakin?")' class="btn btn-danger">Hapus</a></center></td>
  			</tr>
           <!-- modal edit -->
          <div id="EditBarang<?php echo $no; ?>" class="modal fade" role="dialog">
             <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
              <!-- heading modal -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Barang</h4>
              </div>
              <!-- body modal -->
              <div class="modal-body">
                <form action="edit_barang.php" method="POST" enctype="multipart/form-data">
                  <input type="text" name="nama_barang" class="form-control" maxlength="35" placeholder="Masukkan Nama Barang.." value="<?php echo "$data[nama_barang]"; ?>" required/><br>
                  <input type="number" name="harga" class="form-control" maxlength="35" placeholder="Masukkan Harga Barang.." value="<?php echo "$data[harga]"; ?>" required/><br>
                  <input type="number" name="stok" class="form-control" maxlength="35" placeholder="Masukkan Stok Barang.." value="<?php echo "$data[stok]"; ?>" required/><br>
                  <select name="id_kategori" class="form-control">
                    <option value="<?php echo "$data[id_kategori]"; ?>"><?php echo "$data[kategori]"; ?></option>
                    <?php
                      $d = "select * from kategori where not id_kategori='".$data['id_kategori']."'";
                      $e = mysqli_query($connect, $d);
                      while ($f = mysqli_fetch_array($e)){ ?>
                        <option value="<?php echo "$f[id_kategori]"; ?>"><?php echo "$f[kategori]"; ?></option>
                      <?php }
                    ?>
                  </select><br>
                  <input type="hidden" name="id_barang" value="<?php echo "$data[id_barang]"; ?>">
                  <input type="hidden" name="img" value="<?php echo "$data[gambar]"; ?>">
                  <center><img src="../image/<?php echo "$data[gambar]"; ?>" width="20%" height="20%"><br></center>
                  <input type="file" name="foto" class="form-control">
              </div>
              <!-- footer modal -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value="OK">
              </form>
              </div>
            </div>
   		<?php $no++; }
   	?>
   </table>
  </div>

   <!-- modal tambah -->
    <div id="TambahBarang" class="modal fade" role="dialog">
       <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Barang</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <form action="tambah_barang.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nama_barang" class="form-control" maxlength="35" placeholder="Masukkan Nama Barang.." required/><br>
            <input type="number" name="harga" class="form-control" maxlength="35" placeholder="Masukkan Harga Barang.." required/><br>
            <input type="number" name="stok" class="form-control" maxlength="35" placeholder="Masukkan Stok Barang.." required/><br>
            <select name="id_kategori" class="form-control">
              <?php
                $a = "select * from kategori";
                $b = mysqli_query($connect, $a);
                while ($c = mysqli_fetch_array($b)){ ?>
                  <option value="<?php echo "$c[id_kategori]"; ?>"><?php echo "$c[kategori]"; ?></option>
                <?php }
              ?>
            </select><br>
            <input type="file" name="gambar" class="form-control" required/>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" class="btn btn-primary" value="OK">
        </form>
        </div>
      </div>
    </div>
  </div>

  <!--jQUERY FILES-->
  <script src="../assets/js/jquery-1.10.2.js"></script>
  <!--BOOTSTRAP  FILES-->
  <script src="../assets/js/bootstrap.min.js"></script>
  <!-- DATATABLES FILES -->
  <script src="../assets/js/datatables.js"></script>
  <script>
    $(document).ready(function () {
		  $('#tables').DataTable();
		  $('.dataTables_length').addClass('bs-select');
		});
	</script>
</body>
</html>