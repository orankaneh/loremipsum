<?php
ob_start();
session_start();


$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Video";
include_once("header.php");

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

if ($_GET) {
	$id = (int) $_GET['id'];
	$q = $_GET["q"];
	$parent_id = (int) $_GET['parent_id'];
	$PageNo = $_GET['PageNo'];
	$act = $_GET['act'];
    
	if($parent_id>0) {
		$addSql .= " and parent_id='".$parent_id."' ";
	}
	
	if (!empty($q)) {
		$q = encodeHTML($q);
		$addSql .= " and (nama like '%".$q."%') ";
	}
	

	if (!empty($id) && (!is_numeric($id) || $id<1)) {
		header("location:".$_SERVER['PHP_SELF']);
		exit;
	}
	
	if ($act == "hapus") {
		$status = $_GET['status'];
		if ($status!="1") { $status = "0"; }
 	    $sql="delete from ".tabel_video." where id='".$id."'";
		mysql_query($sql,$tulis);
	}
	
    if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_video." set status = IF(status='1','0','1') where id='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
	
}


//utk membuat otomatis bar halaman sesuai setting

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;
$i = 0;
$sql = "select * from ".tabel_video." where  1 and kategori='0' ".$addSql."  order by id desc"; 
$arrH = barHalaman($sql, $PageNo, 10, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
$arr = array();
while($row=mysql_fetch_object($res)) {
	$arr[$i]['no'] = ($arrH['idx']+$i);
	$arr[$i]['id'] = $row->id;
	$arr[$i]['nama'] = $row->nama;
	$arr[$i]['teks_file'] = $row->id_youtube;	
	$arr[$i]['teks_kategori'] = $arrK[$row->kategori_header_id];
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$arr[$i]['status'] = '<a href="'.$link.'&id='.$row->id.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
           
	$i++;
}

	if (count($arr)>0) { 
	for ($i=0;$i<count($arr);$i++) {
    $video.='<tr bgcolor="#EEEEEE" onMouseOver="this.style.background=\'#FFFFFF\'" onMouseOut="this.style.background=\'#EEEEEE\'">
    	<td valign="middle" align="center">'.$arr[$i]['no'].'</td>
    	<td valign="middle" align="center">'.$arr[$i]['nama'].'</td>
    	<td valign="middle" align="center"><a href="videoUpdate.php?id='.$arr[$i]['id'].'">'.$arr[$i]['teks_file'].'</a></td>
    	<td valign="middle" align="center">'.$arr[$i]['status'].'</td>
        <td valign="middle" align="center"><a href="videoList.php?act=hapus&id='.$arr[$i]['id'].'&PageNo='.$PageNo.'" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini ?\')"><img src="../images/delete.png" name="delete buku" border="0"></a></td>
    </tr>';
 } } 

if($num<1) {
	$ui = 'Data not available';
} else {
	$ui =
		$arrH['bar'].'<br/>'.
		'<table width="100%" cellpadding="0" cellspacing="0" class="dtable">
			<tr class="dhead">
				<td align="center" valign="top" width="1%">No</td>
				<td align="center" valign="top" width="1%">Nama</td>
				<td align="center" valign="top">Link</td>
				<td align="center" valign="top" width="1%">Status</td>
                <td align="center" valign="top" width="1%">Hapus</td>
			</tr>
			'.$video.'
		 </table>';
}


?>

<!--sisi kanan mulai-->
<div class="judul_menu">Daftar Video</div>

<div style="margin:10px;">
<form name="cari" action="" method="get">
	<label class="tbless" for="q">kata kunci</label>
	<input type="text" name="q" size="35" value="<?=$q?>" class="inputpesan tbless">
	<?=katUI("video","parent_id",$parent_id,"inputpesan tbless")?>
	<input type="submit" value="cari" class="tombol" />
	<br class="clear" />
</form>
</div>
<?=$ui?>
</table>
<br/>
<!--sisi kanan selesai-->



<?
include_once("footer.php");
?>