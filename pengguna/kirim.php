<?php
$penerima=$_POST['penerima'];
$subyek=$_POST['subyek'];
$pesan=$_POST['pesan'];
$pesan=wordwrap($pesan,70);
     
$header="From: no-reply@saidalfaruq.net\r\n";
$header.="MIME-Version: 1.0\r\n";
$header.="Content-Type: text/html; charset=ISO-8859-1\r\n";
    
$kirim=mail($penerima,$subyek,$pesan,$header);
if($kirim==true){
echo "Pesan email berhasil dikirim.";
}else{
echo "Pesan email gagal dikirim.";
}
?>