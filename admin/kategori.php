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
    <title> Medisku</title>
    
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
                  <li class="active"><a href="kategori.php">Kategori</a></li>
                  <li><a href="barang.php">Produk</a></li>
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
      <h2> Data Kategori </h2>
      <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah Kategori</button>
    </div>
    <table id="tables" class="table table-responsive table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center;">Kategori</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <?php
        $sql = "select * from kategori";
        $query = mysqli_query($connect, $sql);
        $no = 1;
        while ($data = mysqli_fetch_array($query)){ ?>
          <tr>
            <td><?php echo ucwords("$data[kategori]"); ?></td>
            <td>
              <button class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $no; ?>">Edit</button> 
              <a href="hapus_kategori.php?id_kategori=<?php echo "$data[id_kategori]"; ?>" onclick='return confirm("Anda Yakin?")' class="btn btn-danger">Hapus</a>
            </td>
          </tr>
          <!-- modal edit -->
          <div id="edit<?php echo $no; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- konten modal-->
              <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Kategori</h4>
                </div>
                <!-- body modal -->
                <form action="edit_kategori.php" method="POST">
                  <div class="modal-body">
                      <input type="hidden" name="id_kategori" value="<?php echo "$data[id_kategori]"; ?>">
                      <input type="text" name="kategori" class="form-control" maxlength="35" placeholder="Masukkan Kategori.." value="<?php echo "$data[kategori]"; ?>" required/>
                  </div>
                  <!-- footer modal -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="OK">
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php $no++; }
      ?>
    </table>

    <!-- modal tambah -->
    <div id="tambah" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- konten modal-->
        <div class="modal-content">
          <!-- heading modal -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Kategori</h4>
          </div>
          <!-- body modal -->
          <form action="tambah_kategori.php" method="POST">
            <div class="modal-body">
                <input type="text" name="kategori" class="form-control" maxlength="35" placeholder="Masukkan Kategori.." required/>
            </div>
            <!-- footer modal -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="OK">
            </div>
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