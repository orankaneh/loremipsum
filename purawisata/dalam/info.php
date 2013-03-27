<?php

$pesan="";
$id = $_GET['id'];
if($id=="1") $pesan = "Data tidak ditemukan.";
else if($id=="2") $pesan = "Password berhasil diubah.";
include_once("header.php");
?>

<div class="judul_menu">Informasi</div>
<?=$pesan?>
<?php
include_once("footer.php");
?>