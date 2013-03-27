<?php
ob_start();
session_start();
include_once("header.php");

$addSql = "";

$kat = (int) $_GET['kat']; // filter by kategori
if($kat>0) $addSql = " and parent_id='".$kat."' ";

$link = $_SERVER['PHP_SELF']."?z";
$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];
if (!empty($kat)) $link .= "&kat=".$kat;

$judul = "Video";
$isi = "";
$sql = "select * from ".tabel_video." where 1 and kategori='0' and status='1' ".$addSql." order by id desc ";
$arrH = barHalaman($sql, $PageNo, 10, $link, "images/search_left.gif", "images/search_left_off.gif", "images/search_right.gif", "images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$isi .=
		'<a href="video_detail.php?PageNo='.$PageNo.'&id='.$row->id.'"><img border="0" src="http://img.youtube.com/vi/'.$row->id_youtube.'/2.jpg"/></a>
		 <br/>';	
}
  
if($num<1) {
	$isi = 'Data not available';
}
?>

<script type="text/javascript">
$(document).ready(function() {
	$("select[name=kat]").change(function(){ window.location.href = "?kat="+$(this).val(); });
});
</script>

kategori: <?=katUI("video","kat",$kat,"inputpesan")?><br/><br/>
<?=$judul?><br/><br/><?=$isi?>
<br/><br/><?=$arrH['bar']?>
	
<?php
include_once("footer.php");
?>

