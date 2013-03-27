<?php
ob_start();
session_start();
include_once("header.php");

$id = (int) $_GET['id'];
$PageNo = $_GET['PageNo'];

$sql = "select * from ".tabel_berita." where status='1' and kategori='0' and id='".$id."'";
$res = mysql_query($sql,$baca);
$num = mysql_num_rows($res);
$judul = "";
$isi = "";
if ($num<1) {
	$isi = "Data not available.";
} else {
	$row = mysql_fetch_object($res);
	$judul = $row->nama;
	$isi = decodeHTML($row->isi);
}
?>

<div align="right"><a href="berita_index.php?PageNo=<?=$PageNo?>"><img border="0" src="images/buttonback.gif"/></a></div>
 <?=$judul?>  <br/><br/>
<?=getSocialMediaUI()?><br/>
 <?=$isi?>

<?php
include_once("footer.php");
?>