<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$id = (int) $_GET['id'];
$mode = "";
$judulMenu = "";
if($id>0) {
	$mode = "edit";
	$judulMenu = "Edit Video";
} else {
	$mode = "add";
	$judulMenu = "Tambah Video";
}
$judulnya = $judulMenu;

include_once("header.php");
$strError = "";	
if($mode=="edit") {
$sqlS = "select * from ".tabel_video." where id='".$id."'";
$resS = mysql_query($sqlS,$baca);
$rowS = mysql_fetch_object($resS);

$nama = $rowS->nama;
$url = $rowS->id_youtube;
$parent_id = $rowS->parent_id;
}

if ($_POST) {   
	$nama = encodeHTML($_POST["nama"]);
	$url = encodeHTML($_POST["url"]);
	$parent_id = (int) $_POST['parent_id'];

	if(empty($nama)) $strError .= "<li>Judul masih kosong</li>";
	if(empty($url)) $strError .= "<li>url masih kosong</li>";
	if($parent_id==0) $strError .= "<li>Kategori belum dipilih</li>";
    
	if (empty($strError)) {	   
		if($mode=="edit") {
			$upd='update '.tabel_video.' set nama="'.$nama.'",  id_youtube= "'.$url.'" , tgl_update=now(), ip_update="'.$_SERVER['REMOTE_ADDR'].'",parent_id="'.$parent_id.'" where id="'.$id.'"';
			mysql_query($upd,$tulis);
		} else {
			$sql ="insert into ".tabel_video."(parent_id,nama,id_youtube,status,tgl_update,ip_update) values ('".$parent_id."','".$nama."','".$url."','1',now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis);
		}
 	    header("location:videoList.php");
		exit;
	}
}	



?>
<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="" enctype="multipart/form-data">
<table border="0">

<tr>
	<td align="left" valign="top"><b>Nama</b></td>
	<td align="left" valign="top">:</td>
	<td align="left" valign="top">
		<input type="text" name="nama" size="60" value="<?=$nama;?>">
	</td>	
</tr>
<tr>
	<td align="left" valign="top"><b>Url</b></td>
	<td align="left" valign="top">:</td>
	<td align="left" valign="top">
    http://www.youtube.com/watch?v=
		<input type="text" name="url" size="24" value="<?=$url?>">&nbsp; 	
	</td>
</tr>
<tr>
	<td align="left" valign="top"><b>Kategori</b></td>
	<td align="left" valign="top">:</td>
	<td align="left" valign="top">
 	<?=katUI("video","parent_id",$parent_id,"inputpesan tbless")?><br class="clear" />	
	</td>
</tr>


<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td><input type="hidden" name="id" value="<?=$id?>"/>
	<td valign="top"><input type="submit" value="Simpan" class="tombol"/></td>
</tr>
</table>
</form>

<?
include_once("footer.php");
?>