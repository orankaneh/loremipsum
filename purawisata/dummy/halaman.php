<?php
ob_start();
session_start();
include_once("header.php");

$id = (int) $_GET['id'];
$sql = "select * from ".tabel_halaman." where status_halaman='1' and halaman_id='".$id."'";
$res = mysql_query($sql,$baca);
$num = mysql_num_rows($res);
$judul = "";
$isi = "";
if ($num<1) {
	$isi = "Data not available.";
} else {
	$row = mysql_fetch_object($res);
	if ($row->kategori_halaman=="1" && !empty($row->file_include)) {
		header("location:".$row->file_include);
		exit;
	}
	$judul = $row->nama_halaman;
	$isi = decodeHTML($row->isi_halaman);
}
?>

<?=$judul?><br/><br/>
<?=getSocialMediaUI()?><br/>
<?=$isi?>

<?php
include_once("footer.php");
?>