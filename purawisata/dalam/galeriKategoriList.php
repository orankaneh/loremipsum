<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Kategori Foto";
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
		$addSql = " and (nama like '%".$q."%' or isi like '%".$q."%') ";
	}
	
	if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_foto." set status = IF(status='1','0','1') where id='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
	if($_GET["m"]=="hapusdata" && $id > 0){
		$sqlU="delete from ".tabel_foto." where id='".$id."'";
		//echo $sqlU;
		mysql_query($sqlU,$tulis);
		
		if(file_exists('../images/foto/'.$id.'.jpg'))  unlink('../images/foto/'.$id.'.jpg');
		if(file_exists('../images/foto/thumb/'.$id.'.jpg'))  unlink('../images/foto/thumb/'.$id.'.jpg');
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$sql = "select * from ".tabel_foto." where 1 and kategori='1' ".$addSql." order by id desc ";
$arrH = barHalaman($sql, $PageNo, 10, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$status = '<a href="'.$link.'&id='.$row->id.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
		$hapus = '<a href="'.$link.'&id='.$row->id.'&m=hapusdata" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><img src="../images/delete.png"/></a>';
	$induk = "";
	if($row->parent_id>0) {
		$sqlK = "select nama from ".tabel_foto." where kategori='1' and id='".$row->parent_id."' ";
		$resK = mysql_query($sqlK, $baca);
		$rowK = mysql_fetch_object($resK);
		$induk = $rowK->nama;
	}
	
	$ui .=
		'<tr>
			<td align="center" valign="top">'.($arrH['idx']+$i).'.</td>
			<td align="center" valign="top">'.$induk.'</td>
			<td align="left" valign="top"><a href="galeriKategoriUpdate.php?id='.$row->id.'">'.$row->nama.'</a></td>
			<td align="center" valign="top">'.$status.'</td>
			<td align="center" valign="top">'.$hapus.'</td>
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
				<td align="center" valign="top">Nama</td>
				<td align="center" valign="top" width="1%">Status</td>
				<td align="center" valign="top" width="1%">Hapus</td>
			</tr>
			'.$ui.'
		 </table>';
}
?>

<div class="judul_menu">Daftar Kategori Foto</div>

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