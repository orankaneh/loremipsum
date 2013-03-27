<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Banner";
include_once("header.php");

$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET) {	
	$id = (int) $_GET['id'];
	$q = $_GET["q"];
	$id_kategori = (int) $_GET['id_kategori'];
	
	if($id_kategori>0) {
		$addSql .= " and id_kategori='".$id_kategori."' ";
	}
	
	if (!empty($q)) {
		$q = encodeHTML($q);
		$addSql .= " and (nama like '%".$q."%') ";
	}
	
	if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_banner." set status = IF(status='1','0','1') where id='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	} else if($_GET["m"]=="hapus") {
		// hapus banner
		$sqlF = "select id, ekstensi from ".tabel_banner." where id='".$id."' ";
		$resF = mysql_query($sqlF,$baca);
		$rowF = mysql_fetch_object($resF);
		@unlink("../images/banner/".$rowF->id.".".$rowF->ekstensi);
		
		$sql = "delete from ".tabel_banner." where id='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=hapus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$arrK = getArrKatBanner();
$sql = "select * from ".tabel_banner." where 1 ".$addSql." order by id desc ";
$arrH = barHalaman($sql, $PageNo, 10, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$status = '<a href="'.$link.'&id='.$row->id.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
	
	$kategori = $arrK[$row->id_kategori];
	
	$file = "../images/banner/".$row->id.".".$row->ekstensi;
	$arrSize = @getimagesize($file);
	$txt_file = ($row->ekstensi =="swf") ? '<embed name="flashfile" src="'.$file.'" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'.$arrSize[0].'" height="'.$arrSize[1].'"></embed>' : '<img border="0" style="border:1px solid #000;" src="'.$file.'" title="'.$row->nama.'" alt="'.$row->nama.'"/>';
	
	$ui .=
		'<tr>
			<td align="center" valign="top">'.($arrH['idx']+$i).'.</td>
			<td align="center" valign="top">'.$kategori.'</td>
			<td align="left" valign="top"><a href="bannerUpdate.php?id='.$row->id.'">'.$row->nama.'</a></td>
			<td align="center" valign="top">'.$txt_file.'</td>
			<td align="center" valign="top">'.$status.'</td>
			<td align="center" valign="top"><a onClick="return confirm(\'Anda yakin menghapus data ini?\');" href="'.$link.'&id='.$row->id.'&m=hapus"><img src="../images/delete.png"/><br/>hapus</a></td>
		 </tr>';
	
	$i++;
}

if($num<1) {
	$ui = 'Data not available';
} else {
	$ui =
		$arrH['bar'].'<br/>'.
		'<table width="100%" cellpadding="0" cellspacing="0" class="dtable">
			<tr class="dhead">
				<td align="center" valign="top" width="1%">No</td>
				<td align="center" valign="top" width="1%">Kategori</td>
				<td align="center" valign="top">Nama</td>
				<td align="center" valign="top">Banner</td>
				<td align="center" valign="top" width="1%">Status</td>
				<td align="center" valign="top" width="1%">Hapus</td>
			</tr>
			'.$ui.'
		 </table>';
}
?>

<div class="judul_menu">Daftar Banner</div>

<div style="margin:10px;">
<form name="cari" action="" method="get">
	<label class="tbless" for="q">kata kunci</label>
	<input type="text" name="q" size="35" value="<?=$q?>" class="inputpesan tbless">
	<?=katUI2("banner","id_kategori",$id_kategori,"inputpesan tbless",true)?>
	<input type="submit" value="cari" class="tombol" />
	<br class="clear" />
</form>
</div>

<?=$ui?>

<?php
include_once("footer.php");
?>