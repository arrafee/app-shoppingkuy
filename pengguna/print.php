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
    <title>Medisku</title>
    
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
     <!-- custom CSS here -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <style>         

    </style>
</head>
<div class="container">
    <div class="row" style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-top: 4rem;">
        <?php 
            $sql = "select * from pengguna inner join transaksi on pengguna.id_pengguna = transaksi.id_pengguna
            where pengguna.id_pengguna='$id' and transaksi.status_transaksi='lunas'";
            $query = mysqli_query($connect, $sql);
            $cek = mysqli_num_rows($query);
            if($cek > 0){
                while($data = mysqli_fetch_array($query)){ ?>
                <div class="col-md-6 col-sm-6">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3><?php echo "$data[waktu_transaksi]"; ?></h3>
                            <h5><?php echo ucwords("$data[nama]"); ?></h5><hr>
                            <h4>Alamat : <?php echo ucwords("$data[alamat]"); ?></h4>
                            <h4>No Telepon : <?php echo ucwords("$data[no_hp]"); ?></h4>
                            <h4>Status : <?php echo ucwords("$data[status_transaksi]") ?></h4>
                            <h4>Total : Rp. <?php echo "$data[subtotal]"; ?></h4>
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
    <?php }else{ ?>
        <div style="text-align: center;">
            <img src="../assets/img/kosong.png">
            <h2>Belum ada barang yang dikirim</h2>
        </div>
    <?php } ?>
<script>
window.print(); 
</script>
</html>