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
	$judulMenu = "Edit Berita";
} else {
	$mode = "add";
	$judulMenu = "Tambah Berita";
}
$judulnya = $judulMenu;

include_once("header.php");
include('../inc/SimpleImage.php');

$strError = "";
$image = new SimpleImage();
if($mode=="edit") {
	$sqlC = "select * from ".tabel_berita." where kategori ='0' and id='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	$nama = $rowC->nama;
	$namae = $rowC->nama_e;
	$parent_id = $rowC->parent_id;
	$isi = decodeHTML($rowC->isi);
	$isie = decodeHTML($rowC->isi_e);
}

if($_POST) {
	$nama = encodeHTML($_POST["nama"]);
	$namae = encodeHTML($_POST["namae"]);
	$parent_id = (int) $_POST['parent_id'];
	$isi =encodeHTML($_POST['isi']);
	$isie = encodeHTML($_POST['isi_e']);
	if(empty($nama)) $strError .= "<li>Judul masih kosong</li>";
	if(empty($namae)) $strError .= "<li>Judul bahas inggris masih kosong</li>";
	if(empty($isi)) $strError .= "<li>Konten kosong</li>";
	if(empty($isie)) $strError .= "<li>Konten bahas inggris masih kosong</li>";
	if($parent_id==0) $strError .= "<li>Kategori belum dipilih</li>";
	
	$vHeader = $_FILES['fileori']['tmp_name'];      
	$vHeader_type = $_FILES['fileori']['type'];
	$vHeader_size = $_FILES['fileori']['size']/1024;

	if(is_uploaded_file($vHeader)) {
		$size2 = @getimagesize($vHeader);         
		if($size2[0] != beritaw_size) $strError=$strError."<li>Lebar gambar harus ".beritaw_size." pixels!</li>";		
		if($size2[1] != beritah_size) $strError=$strError."<li>Tinggi gambar harus ".beritah_size." pixels!</li>";		
		//if ($vHeader_size > image_filesize) $strError=$strError."<li>Size maksimal gambar ".(image_filesize)." KB!</li>";
		if ($size2[2]!= IMAGETYPE_JPEG) $strError=$strError. "<li>Tipe gambar harus JPG.</li>"; 
        
	} 
	
	
	if(strlen($strError)<1) {		
		if($mode=="add") {
		
			$sql =
				"insert into ".tabel_berita."(parent_id,kategori,nama,nama_e,isi,isi_e,status,tgl_buat,tgl_update,ip_update) values
				 ('".$parent_id."','0','".$nama."','".$namae."','".$isi."','".$isie."','1',now(),now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis) or die(mysql_error() . "<hr>" . $sql);
			$id_s = mysql_insert_id();	
		} 
		else {
			$sql =
				"update ".tabel_berita." set
				 parent_id='".$parent_id."',
				 kategori='0',
				 nama='".$nama."',
				 nama_e='".$namae."',
				 isi='".$isi."',
				 isi_e='".$isie."',
				 tgl_update=now(),
				 ip_update='".$_SERVER['REMOTE_ADDR']."' where id='".$id."'";
			mysql_query($sql,$tulis);
			$id_s = $id;	
		}
		
		if(is_uploaded_file($_FILES['fileori']['tmp_name'])){
				if (file_exists("../images/berita/" . $id_s . ".jpg")) unlink("../images/berita/" . $id_s . ".jpg");
		
				$res = copy($_FILES['fileori']['tmp_name'], "../images/berita/" . $id_s. ".jpg");
				if (file_exists("../images/berita/thumb/" . $id_s . ".jpg")) unlink("../images/berita/thumb/" . $id_s . ".jpg");
				$image->load("../images/berita/" . $id_s . ".jpg");
				$image->resize(beritathw_size,beritathh_size);
				$image->save('../images/berita/thumb/'. $id_s .'.jpg');
				//echo 'abc';
		}
		

		
		header("location:beritaList.php");
		//exit;
	}
}

?>


<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>" ENCTYPE="multipart/form-data">
	
	<label class="tbless" for="nama">Judul</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless" for="nama">Judul bahasa Inggris</label>
	<input type="text" name="namae" size="60" value="<?=$namae?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless_norm" for="nama">Kategori</label>
	<?=katUI("berita","parent_id",$parent_id,"inputpesan tbless")?><br class="clear" />
	
	<label class="tbless2" for="nama">
		Konten Bahasa Indonesia
	</label>
	<?php
		$editor = new wysiwygPro();
		$editor->editorURL = editor_url;
		$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
		$editor->name = 'isi'; // nama editor
		$editor->value = $isi; // isi editor
		$editor->setupEditor("/".WPRO_DIR.'images/gambar/', site_img_dir, "/".WPRO_DIR.'images/dokumen/', site_doc_dir);
		$editor->cssText = "body {color:#000;background:#FFF;}";
		$editor->display(800, 480);
	?>
    <br/>
		<label class="tbless2" for="nama">
		Konten Bahasa Inggris
	</label>
	<?php
		$editor = new wysiwygPro();
		$editor->editorURL = editor_url;
		$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
		$editor->name = 'isi_e'; // nama editor
		$editor->value = $isie; // isi editor
		$editor->setupEditor("/".WPRO_DIR.'images/gambar/', site_img_dir, "/".WPRO_DIR.'images/dokumen/', site_doc_dir);
		$editor->cssText = "body {color:#000;background:#FFF;}";
		$editor->display(800, 480);
	?>
    <label class="tbless" for="nama">Gambar</label>
    <input type="file" name="fileori" size="40" value="<?=$fileOri?>" class="inputpesan sebelahkiri"><br/><br/>
    <label>&nbsp;</label>
    <fieldset style="background:#ffffff;">
    <legend> Info : </legend>
    Gambar harus JPG/JPEG<br/>
    Ukuran gambar harus <?=beritaw_size." X ".beritah_size?><br/>
    </fieldset>
	<label class="tbless" for="">&nbsp;</label><br/>
	<input type="submit" value="Simpan" class="tombol" /><br class="clear" />

	<br/><br/>
</form>

<?php
include_once("footer.php");
?>
