<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Produk";
include_once("header.php");

$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if($_GET) {	
	$id = (int) $_GET['id'];
	$q = $_GET["q"];
	
	/* $parent_id = (int) $_GET['parent_id'];
	
	if($parent_id>0) {
		$addSql .= " and parent_id='".$parent_id."' ";
	} */
	
	if (!empty($q)) {
		$q = encodeHTML($q);
		$addSql .= " and (nama_produk like '%".$q."%') or (detail like '%".$q."%') or (generalinfo like '%".$q."%') ";
	}
	
	if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_produk." set status = IF(status='1','0','1') where id_produk='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
	if($_GET["m"]=="hapusdata" && $id > 0){
		$sqlU="delete from ".tabel_produk." where id_produk='".$id."'";
		//echo $sqlU;
		mysql_query($sqlU,$tulis);
		
		if(file_exists('../images/produk/'.$id.'_zoom.jpg'))  unlink('../images/produk/'.$id.'_zoom.jpg');
		if(file_exists('../images/produk/'.$id.'.jpg'))  unlink('../images/produk/'.$id.'.jpg');
		if(file_exists('../images/produk/thumb/'.$id.'.jpg'))  unlink('../images/produk/thumb/'.$id.'.jpg');
		if(file_exists('../images/produk/thumb/'.$id.'_dalam.jpg'))  unlink('../images/produk/thumb/'.$id.'_dalam.jpg');
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$sql = "select * from ".tabel_produk." where 1 ".$addSql." order by id_produk desc ";
//$sql = "select * from ".tabel_produk." where 1 order by ";
$arrH = barHalaman($sql, $PageNo, 20, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id_produk");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$status = '<a href="'.$link.'&id='.$row->id_produk.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
	$hapus = '<a href="'.$link.'&id='.$row->id_produk.'&m=hapusdata" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><img src="../images/delete.png"/></a>';
	$harga= formatrp($row->harga);
	$harga_diskon= formatrp($row->harga_diskon);
	$new_arrival = ($row->new_arrival=="1") ? "<img src='../images/Checklist.jpg' />":"";
	$best_seller = ($row->best_seller=="1") ? "<img src='../images/Checklist.jpg' />":"";
	$sale = ($row->sale=="1") ? "<img src='../images/Checklist.jpg' />":"";
	
	
	$nama_kategori ="";
	$sqlp = "select nama_kategori from ".tabel_kategori." where id_kategori = '".$row->id_kategori."' ";
	$resp = mysql_query($sqlp,$baca);
	$rowp = mysql_fetch_object($resp);
	$nama_kategori = $rowp->nama_kategori;
	if($i%2)
	{
	$class="odd";
	}
	else{
	$class="";
	}
	$ui .=
		'<tr class="'.$class.'">
			<td align="center" valign="center">'.($arrH['idx']+$i).'.</td>
			<td align="left" valign="center"><a href="produkUpdate.php?id='.$row->id_produk.'">'.$row->nama_produk.'</a></td>
			<td align="center" valign="center">'.$nama_kategori.'</td>
			<td align="center" valign="center">'.$harga.'</td>
			<td align="center" valign="center">'.$harga_diskon.'</td>
			<td align="center" valign="center">'.$new_arrival.'</td>
			<td align="center" valign="center">'.$best_seller.'</td>
			<td align="center" valign="center">'.$sale.'</td>
			<td align="center" valign="center"><img src="../images/produk/thumb/'.$row->id_produk.'_dalam.jpg"></td>
			<td align="center" valign="center">'.$status.'</td>
			<td align="center" valign="center">'.$hapus.'</td>
		 </tr>';
	
	$i++;
}

if($num<1) {
	$ui = 'Data not available';
} else {
	$ui =
		'<br/>'.
		'<table width="100%" cellpadding="0" cellspacing="0" class="dtable">
			<tr class="dhead">
				<td align="center" valign="top" width="1%">No</td>
				<td align="center" valign="top">Nama Produk</td>
				<td align="center" valign="top" >Kategori Produk</td>
				<td align="center" valign="top">Harga</td>
				<td align="center" valign="top">Harga Diskon</td>
				<td align="center" valign="top" width="2%">New</td>
				<td align="center" valign="top" width="2%">Best Seller</td>
				<td align="center" valign="top" width="2%">Iklan</td>
				<td align="center" valign="top" width="2%">Gambar</td>
				<td align="center" valign="top" width="1%">Status</td>
				<td align="center" valign="top" width="1%">Hapus</td>
			</tr>
			'.$ui.'
		</table> <br/>'.$arrH['bar'].'';
}
?>

<H3 style="position:absolute">Daftar Produk</H3>


<div style="float:right">
<form name="cari" action="" method="get">
<label>Cari Produk:</label>
	<input type="text" name="q" size="35" value="<?=$q?>" class="inputpesan tbless">
	<input type="submit" value="Cari" class="tombol2" />
</form>
</div>

<?=$ui?>

<?php
include_once("footer.php");
?>