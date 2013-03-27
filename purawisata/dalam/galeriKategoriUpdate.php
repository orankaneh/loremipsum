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
	$judulMenu = "Edit Kategori Foto";
} else {
	$mode = "add";
	$judulMenu = "Tambah Kategori Foto";
}
$judulnya = $judulMenu;

include_once("header.php");

$strError = "";
if($mode=="edit") {
	$sqlC = "select * from ".tabel_foto." where kategori='1' and id='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	$nama = $rowC->nama;
	$parent_id = $rowC->parent_id;
}

if($_POST) {
	$nama = encodeHTML($_POST["nama"]);
	$parent_id = (int) $_POST['parent_id'];
	$isi = "";
	
	if(empty($nama)) $strError .= "<li>Judul masih kosong</li>";
	
	if(strlen($strError)<1) {		
		if($mode=="add") {
			$sql =
				"insert into ".tabel_foto."(parent_id,kategori,nama,isi,status,tgl_update,ip_update) values
				 ('".$parent_id."','1','".$nama."','','1',now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis);
		} else {
			$sql =
				"update ".tabel_foto." set
				 parent_id='".$parent_id."',
				 kategori='1',
				 nama='".$nama."',
				 isi='',
				 tgl_update=now(),
				 ip_update='".$_SERVER['REMOTE_ADDR']."' where id='".$id."'";
			mysql_query($sql,$tulis) or die ( mysql_error() );
		}
		//echo $sql;
		header("location:galeriKategoriList.php");
		exit;
	}
}

?>

<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>">
	
	<label class="tbless" for="nama">Judul</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless_norm" for="nama">Induk</label>
	<?=katUI("galeri","parent_id",$parent_id,"inputpesan tbless")?><br class="clear" />
	
	<label class="tbless" for="">&nbsp;</label>
	<input type="submit" value="Simpan" class="tombol" /><br class="clear" />

	
</form>

<?php
include_once("footer.php");
?>
