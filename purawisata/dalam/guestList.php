<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Tamu";
include_once("header.php");

$ui = '';
$addSql = '';

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];

$addJS = '';
$strError = '';
if($_POST) {
	$did = (int) $_POST['did'];
	$act = encodeHTML($_POST["act"]);
	$pesan = encodeHTML($_POST["pesan"]);
	
	$addJS = "$('#det".$did."').show();";
	if($act=="balas" && $did>0 && !empty($pesan)) {
		$sql = "select id from ".tabel_tamu." where id_parent='".$did."' and kategori='admin'";
		$res = mysql_query($sql,$baca);
		$row = mysql_fetch_object($res);
		$or_id = $row->id;
		if($or_id<1) {
			$sql = "insert into ".tabel_tamu." set id_parent='".$did."', kategori='admin', nama='admin', isi='".$pesan."', status='1', tgl_guest=now(), ip_guest='".$_SERVER['REMOTE_ADDR']."' ";
		} else {
			$sql = "update ".tabel_tamu." set isi='".$pesan."' where id='".$or_id."' ";
		}
		mysql_query($sql,$tulis);
		$strError = '<li>Pesan berhasil disimpan.</li>';
	} else {
		$strError = '<li>Pesan masih kosong.</li>';
	}
}

if($_GET) {	
	$id = (int) $_GET['id'];
	$q = $_GET["q"];
	
	if (!empty($q)) {
		$q = encodeHTML($q);
		$addSql .= " and (nama like '%".$q."%' or email like '%".$q."%' or url like '%".$q."%' or alamat like '%".$q."%' or isi like '%".$q."%') ";
	}
	
	if($_GET["m"]=="ubahstatus") {
		$sql = "update ".tabel_tamu." set status = IF(status='1','0','1') where id='".$id."' ";
		mysql_query($sql,$tulis);
		
		$link = str_replace("&m=ubahstatus","",$_SERVER['REQUEST_URI']);
		header("location:".$link);
		exit;
	}
}

$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;

$i = 0;
$sql = "select * from ".tabel_tamu." where 1 and id_parent='0' and kategori='pengunjung' ".$addSql." order by id desc ";
$arrH = barHalaman($sql, $PageNo, 10, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
while($row=mysql_fetch_object($res)) {
	$status = ($row->status=="1") ? "publish" : "unpublish";
	$status = '<a href="'.$link.'&id='.$row->id.'&m=ubahstatus"><img src="../images/status_'.$row->status.'.gif"/><br/>'.$status.'</a>';
	
	$pesanBalasan = '';
	$sql2 = "select isi from ".tabel_tamu." where id_parent='".$row->id."' and kategori='admin' and status='1' ";
	$res2 = mysql_query($sql2,$baca);
	$row2 = mysql_fetch_object($res2);
	$pesanBalasan = $row2->isi;
	
	$ui .=
		'<tr>
			<td align="center" valign="top">'.($arrH['idx']+$i).'.</td>
			<td align="left" valign="top"><a href="javascript:void(0)" onclick="tampilkan('.$row->id.')">'.$row->nama.'</a></td>
			<td align="center" valign="top">'.$row->email.'</td>
			<td align="center" valign="top">'.$row->url.'</td>
			<td align="center" valign="top">'.$status.'</td>
		 </tr>
		 <tr class="ddet" id="det'.$row->id.'">
			<td align="left" valign="top" colspan="5">
				<div>'.$row->isi.'.</div>
				<hr/>
				<div>
					<form action="" name="balas'.$row->id.'" method="post">
						<b>Balas pesan</b>:<br/>
						<textarea cols="50" rows="5" name="pesan">'.$pesanBalasan.'</textarea><br/>
						<input type="hidden" name="act" value="balas"/>
						<input type="hidden" name="dPageNo" value="'.$PageNo.'"/>
						<input type="hidden" name="did" value="'.$row->id.'"/>
						<input type="submit" value="balas" class="tombol" />
					</form>
				</div>
			</td>
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
				<td align="center" valign="top">Nama</td>
				<td align="center" valign="top">Email</td>
				<td align="center" valign="top">URL</td>
				<td align="center" valign="top" width="1%">Status</td>
			</tr>
			'.$ui.'
		 </table>';
}
?>

<style>
.ddet { display:none; }
</style>

<script>
function tampilkan(id) {
	$("#det"+id).toggle();
}
$(document).ready(function(){
	<?=$addJS?>
});
</script>

<div class="judul_menu">Daftar Tamu</div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
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