<?php
error_reporting(0);
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
	$judulMenu = "Edit File";
} else {
	$mode = "add";
	$judulMenu = "Tambah File";
}
$judulnya = $judulMenu;

include_once("header.php");

$strError = "";
$fileUI = "";
$tanggal_mulai = date("d-m-Y");
$tanggal_selesai = date("d-m-Y");

if($mode=="edit") {
	$sqlC = "select * from ".tabel_download." where id='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	$nama = $rowC->nama;
	
	$file = "../images/file/".$rowC->id.".".$rowC->ekstensi;
	$arrSize = @getimagesize($file);
	$fileUI = '<a href="'.$file.'">'.$nama.'</a>';
}

if($_POST) {
	$nama = encodeHTML($_POST["nama"]);
	
	// cek semua
	$fileWajibAda = ($mode=="add")? true : false;
	
	$strError .= checkFile($_FILES['vFile'], "file", "", $fileWajibAda);
	if(empty($nama)) $strError .= "<li>Nama masih kosong</li>";
	
	if(strlen($strError)<1) {
		if($mode=="add") {
			$sql =
				"insert into ".tabel_download."(nama,ekstensi,status,tgl_update,ip_update) values
				 ('".$nama."','-','1',now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis);
			$id = mysql_insert_id();
		} else {
			$sql =
				"update ".tabel_download." set
				 nama='".$nama."',
				 tgl_update=now(),
				 ip_update='".$_SERVER['REMOTE_ADDR']."' where id='".$id."'";
			mysql_query($sql,$tulis);
		}
		
		// upload file
		$arrExtFile = getArrExtFile();
		
		$vFile = $_FILES['vFile']['tmp_name'];
		$vFile_name = $_FILES['vFile']['name'];
		$path_parts = pathinfo($vFile_name);
		$ekstensi = $path_parts['extension'];
		
		if(is_uploaded_file($vFile)) {
			if($mode=="edit") {
				// hapus file lama
				$sqlF = "select id, ekstensi from ".tabel_download." where id='".$id."' ";
				$resF = mysql_query($sqlF,$baca);
				$rowF = mysql_fetch_object($resF);
				@unlink("../images/file/".$rowF->id.".".$rowF->ekstensi);
			}
		
			$dir = "../images/file/";
			$vFile_name = "_".$vFile_name;
			
			$namaPhoto = $id;
			$res = copy($vFile, $dir.$vFile_name);
			unlink($vFile);
			$res = rename($dir.$vFile_name, $dir.$namaPhoto.".".$ekstensi);
			
			$sql = "update ".tabel_download." set ekstensi='".$ekstensi."' where id='".$id."' ";
			mysql_query($sql,$tulis);
		}
		
		header("location:fileList.php");
		exit;
	}
}

?>

<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>" enctype="multipart/form-data">
	<div style="margin:4px;"><?=$fileUI?></div>
	
	<label class="tbless" for="nama">File</label>
	<input type="file" name="vFile" class="inputpesan tbless"/><br class="clear" />
	<div class="pad_tbless">
		Tipe file yang diterima adalah PDF,ZIP, ATAU RAR.<br/>
		Ukuran maksimal file adalah <?=(file_download_size/1024)?> KB.
	</div>	
	
	<label class="tbless" for="nama">Nama</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="">&nbsp;</label>
	<input type="submit" value="Simpan" class="tombol" /><br class="clear" />

	
</form>

<?php
include_once("footer.php");
?>
