<?php
ob_start();
session_start();
include_once("header.php");

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];
$link = $_SERVER['PHP_SELF']."?id=".$_GET[id];
if (!empty($PageNo)) $link .= "&PageNo=".$PageNo;

$judul = "Download Area";
$isi = "";
$sql ='select * from '.tabel_download.' where status="1" order by id desc';
$arrH = barHalaman($sql, $PageNo, 10, $link, "images/search_left.gif", "images/search_left_off.gif", "images/search_right.gif", "images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$isi .=
		'<a href="images/file/'.$row->id.'.'.$row->ekstensi.'">'.$row->nama.'</a>
		 <br/>';	
}
  
if($num<1) {
	$isi = 'Data not available';
}
?>

<?=$judul?><br/>
<?=getSocialMediaUI()?><br/>
<br/><?=$isi?>
<br/><br/><?=$arrH['bar']?>
	
<?php
include_once("footer.php");
?>

