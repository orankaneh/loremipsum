<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Berita";
include_once("header.php");

$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET) {	
	$id = (int) $_GET['id'];
	$q = $_GET["q"];
	$parent_id = (int) $_GET['parent_id'];
	
	if($parent_id>0) {
		$addSql .= " and parent_id='".$parent_id."' ";
	}
	
	if (!empty($q)) {
		$q = encodeHTML($q);
		$addSql .= " and (nama like '%".$q."%' or isi like '%".$q."%') ";
	}
	
	if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_berita." set status = IF(status='1','0','1') where id='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$sql = "select * from ".tabel_berita." where 1 and kategori='0' ".$addSql." order by id desc ";
$arrH = barHalaman($sql, $PageNo, 20, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);

while($row=mysql_fetch_object($res)) {
if($i%2)
	{
	$class="odd";
	}
	else{
	$class="";
	}
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$status = '<a href="'.$link.'&id='.$row->id.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
	
	$sqlK = "select nama from ".tabel_berita." where kategori='1' and id='".$row->parent_id."' ";
	$resK = mysql_query($sqlK, $baca);
	$rowK = mysql_fetch_object($resK);
	
	$ui .=
		'<tr class="'.$class.'">
			<td align="center" valign="top">'.($arrH['idx']+$i).'.</td>
			<td align="center" valign="top">'.$rowK->nama.'</td>
			<td align="left" valign="top"><a href="beritaUpdate.php?id='.$row->id.'">'.$row->nama.'</a></td>
			<td align="center" valign="top">'.$status.'</td>
		 </tr>';
	
	$i++;
}

if($num<1) {
	$ui = '<br/><br/>Data not available';
} else {
	$ui =
		'<br/>'.
		'<table width="100%" cellpadding="0" cellspacing="0" class="dtable">
			<tr class="dhead">
				<td align="center" valign="top" width="1%">No</td>
				<td align="center" valign="top" width="1%">Kategori</td>
				<td align="center" valign="top">Nama</td>
				<td align="center" valign="top" width="1%">Status</td>
			</tr>
			'.$ui.'
		 </table><br/>'.$arrH['bar'];
}
?>

<H3 style="position:absolute">Daftar Berita</H3>

<div style="float:right">
<form name="cari" action="" method="get">
	<label>Cari Berita:</label>
	<input type="text" name="q" size="35" value="<?=$q?>" class="inputpesan tbless">
	<?=katUI("berita","parent_id",$parent_id,"inputpesan tbless")?>
	<input type="submit" value="cari" class="tombol" />
	<br class="clear" />
</form>
</div>

<?=$ui?>

<?php
include_once("footer.php");
?>