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
        <h1>Pelayanan Pelanggan <img src="../assets/img/cs.png" width="5%" height="5%"></h1>
 <?php 
 // $nama = $_POST['nama'];
error_reporting(0);
  $simpan = $_POST ['simpan'];
  
  ?>
  <div class="container">
    <div class="row">
      <div class="offset-lg-2 col-lg-8 col-sm-6 col-12 main-section text-left">
        <div class="row">
          <div class="col-lg-20 col-sm-12 col-1 profile-header">
            <form method="post" action="costumerservice.php">
              <table border="0" width="800" height ="100" cellpadding="10" cellspacing="10" align="left-side">
                <tr>
                  <div class="mb-3"><BR>
                    <label for="formGroupExampleInput" class="form-label"> NAMA CUSTOMER </label>
                    <input type="text" class="form-control" id="formGroupExampleInput"
                      placeholder="Masukkan nama ..." name="nama"><br>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label"> EMAIL ADDRESS </label>
                    <input type="text" class="form-control" id="formGroupExampleInput2"
                      placeholder="Masukkan alamat email..."><br>
                  </div>
                  <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label"> KELUHAN YANG DIALAMI </label>
                    <input type="text" class="form-control" id="formGroupExampleInput2"
                      placeholder="Tuliskan Keluhan yang dialami ..."><br>
                  </div>
                  <div class="col-12">
                    <label for="formGroupExampleInput2" class="form-label"> NO HP YANG BISA DIHUBUNGI </label>
                    <input type="text" class="form-control" id="formGroupExampleInput2"
                      placeholder="Masukkan No.Hp ..."><br>
                  </div>
                  <div class="col-12">
                    <input type="submit" name="simpan" value="simpan">
                  </div>
                </tr>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

 
  <?php
  if ($simpan) {

    ?>

      <script type="text/javascript">
        
        alert ("Data Berhasil Disimpan, Terimakasih Telah Mengisi Form costumerservice ShoppingKuy.Kami akan mengirimkan respon ke alamat email yang telah dimasukkan");
        window.location.href="costumerservice.php";
      </script>

    <?php       
  }

 ?>
<div class="register">
        <div class="container">
            <div class="register-home">
                <a href="home.php">Kembali</a>
            </div>
        </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
    crossorigin="anonymous"></script>
            <br>    
          </div>
    <!--Footer -->
   
    
</footer>
    <!--jQUERY FILES-->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!--BOOTSTRAP  FILES-->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>