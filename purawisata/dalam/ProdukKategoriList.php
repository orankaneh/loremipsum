<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Kategori Produk";
include_once("header.php");

$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET) {	
	$id = $_GET['id'];
	$q = $_GET["q"];
	
	if (!empty($q)) {
		$q = encodeHTML($q);
		$addSql = " and (nama_kategori like '%".$q."%') ";
	}
	
	if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_kategori." set status = IF(status='1','0','1') where id_category='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$sql = "select * from ".tabel_kategori." where 1  ".$addSql." order by id_kategori desc ";
$arrH = barHalaman($sql, $PageNo, 10, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$status = '<a href="'.$link.'&id='.$row->id_kategori.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
	
	$induk = "";
	if($row->id_parent>0) {
		//$sqlK = "select nama from ".tabel_category." where id_category='1' and id='".$row->parent_id."' ";
		$sqlK = "select id_kategori,nama_kategori from ".tabel_kategori." where id_kategori='".$row->id_parent."' ";
		$resK = mysql_query($sqlK, $baca);
		$rowK = mysql_fetch_object($resK);
		$induk = $rowK->nama_kategori;
	}
	
	$ui .=
		'<tr>
			<td align="center" valign="top">'.($arrH['idx']+$i).'.</td>
			<td align="center" valign="top">'.$rowK->id_kategori.' - '.$induk.'</td>
			<td align="left" valign="top"><a href="ProdukKategoriUpdate.php?id='.$row->id_kategori.'">'.$row->id_kategori.' - '.$row->nama_kategori.'</a></td>
			<td align="center" valign="top">'.$status.'</td>
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
				<td align="center" valign="top">Induk</td>
				<td align="center" valign="top">Nama category</td>
				<td align="center" valign="top" width="1%">Status</td>
			</tr>
			'.$ui.'
		 </table>';
}
?>

<div class="judul_menu">Daftar Kategori Produk</div>

<div style="margin:10px;">
<form name="cari" action="" method="get">
	<label class="tbless" for="q">kata kunci</label>
	<input type="text" name="q" size="35" value="<?=$q?>" class="inputpesan tbless">
	<input type="submit" value="cari" class="tombol" />
	<br class="clear" />
</form>
</div>

<?=$ui?>

<?php
include_once("footer.php");
?>