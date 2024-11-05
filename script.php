<?php
session_start();
if (isset($_POST['submit']))

{include "config.php";
$tanggal;
$nama=$_POST['nama'];
$email=$_POST['email'];
$komentar=$_POST['komentar'];
$kode=$_POST['kode'];
$ka=$_SESSION['captcha_session'];

if($nama != "")
{
if($email != "")
{
if($komentar != "")
{
if($kode != "")
{
if($kode == $ka)
{ $query=mysql_query("insert into komentar values('','$nama','$email','$komentar')");
if ($query)
{ echo "<b><font color=blue>Komentar Anda telah disimpan. TERIMA KASIH</font></b>"; }
}
else echo "<b><font color=red>KODE yang anda masukkan SALAH</font></b>";
}
else echo "<b><font color=red>Anda belum memasukkan KODE</font></b>";
}
else echo "<b><font color=red>Anda belum memasukkan KOMENTAR</font></b>";
}
else echo "<b><font color=red>Anda belum memasukkan EMAIL</font></b>";
}
else echo "<b><font color=red>Anda belum memasukkan NAMA</font></b>";
}
else{unset($_POST['submit']); }
?>