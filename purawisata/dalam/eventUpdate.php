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
	$judulMenu = "Edit event";
} else {
	$mode = "add";
	$judulMenu = "Tambah event";
}
$judulnya = $judulMenu;

include_once("header.php");
include('../inc/SimpleImage.php');

$strError = "";
$image = new SimpleImage();
if($mode=="edit") {
	$sqlC = "select * from ".tabel_event." where kategori ='0' and id='".$id."'";
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
	$venue = $rowC->venue;
	$isi = decodeHTML($rowC->isi);
	$isie = decodeHTML($rowC->isi_e);
	$dolar = $rowC->dollar;
	$rupiah = $rowC->rupiah;
	$tanggal_mulai = dateaja($rowC->tanggal_mulai);
}

if($_POST) {
	$nama = encodeHTML($_POST["nama"]);
	$namae = encodeHTML($_POST["namae"]);
	$parent_id = (int) $_POST['parent_id'];
	$venue = (int) $_POST['venue'];
	$isi =encodeHTML($_POST['isi']);
	$isie = encodeHTML($_POST['isi_e']);
	$tanggal_mulai = $_POST["tanggal_mulai"];
	$rupiah = $_POST["rupiah"];
	$dolar = $_POST["dolar"];
	if(empty($nama)) $strError .= "<li>Judul masih kosong</li>";
	if(empty($namae)) $strError .= "<li>Judul bahas inggris masih kosong</li>";
	if(empty($isi)) $strError .= "<li>Konten kosong</li>";
	if(empty($rupiah)) $strError .= "<li>Harga Rupiah Masih Kosong</li>";
	if(empty($dolar)) $strError .= "<li>Harga Dollar Masih Kosong</li>";
	if(empty($isie)) $strError .= "<li>Konten bahas inggris masih kosong</li>";
	if(empty($tanggal_mulai)) $strError .= "<li>Tanggal Masih Kosong</li>";
	if($parent_id==0) $strError .= "<li>Kategori belum dipilih</li>";
	if($venue==0) $strError .= "<li>Venue belum dipilih</li>";
	
	
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
				"insert into ".tabel_event."(parent_id,venue,kategori,tanggal_mulai,nama,nama_e,rupiah,dollar,isi,isi_e,status,tgl_buat,tgl_update,ip_update) values
				 ('".$parent_id."','".$venue."','0','".date2mysql($tanggal_mulai)."','".$nama."','".$namae."','$rupiah','$dolar','".$isi."','".$isie."','1',now(),now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis) or die(mysql_error() . "<hr>" . $sql);
			$id_s = mysql_insert_id();	
		} 
		else {
			$sql =
				"update ".tabel_event." set
				 parent_id='".$parent_id."',
				 venue='".$venue."',
				 kategori='0',
				 tanggal_mulai='".date2mysql($tanggal_mulai)."',
				 nama='".$nama."',
				 nama_e='".$namae."',
				 rupiah='$rupiah',
				 dollar='$dolar',
				 isi='".$isi."',
				 isi_e='".$isie."',
				 tgl_update=now(),
				 ip_update='".$_SERVER['REMOTE_ADDR']."' where id='".$id."'";
			mysql_query($sql,$tulis);
			$id_s = $id;	
		}
		
		if(is_uploaded_file($_FILES['fileori']['tmp_name'])){
				if (file_exists("../images/event/" . $id_s . ".jpg")) unlink("../images/event/" . $id_s . ".jpg");
		
				$res = copy($_FILES['fileori']['tmp_name'], "../images/event/" . $id_s. ".jpg");
				if (file_exists("../images/event/thumb/" . $id_s . ".jpg")) unlink("../images/event/thumb/" . $id_s . ".jpg");
				$image->load("../images/event/" . $id_s . ".jpg");
				$image->resize(eventthw_size,eventthh_size);
				$image->save('../images/event/thumb/'. $id_s .'.jpg');
				//echo 'abc';
		}
		

		
		header("location:eventList.php");
		//exit;
	}
}

?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".datepicker").datepicker({
			showOn: 'both',
			changeMonth: true,
			changeYear: true,
			gotoCurrent: true,
			buttonImage: '../images/calendar.gif',
			buttonImageOnly: true,
			dateFormat: "dd-mm-yy"
		});
	});
</script>


<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>" ENCTYPE="multipart/form-data">
	
	<label class="tbless" for="nama">Judul</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless" for="nama">Judul bahasa Inggris</label>
	<input type="text" name="namae" size="60" value="<?=$namae?>" class="inputpesan tbless"><br class="clear" />
    <label class="tbless" for="nama">Harga Rp:</label>
	<input type="text" name="rupiah" onkeyup="Angka(this)" size="60" value="<?=$rupiah?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless" for="nama">Harga Dollar($):</label>
	<input type="text" name="dolar" size="60" onkeyup="Desimal(this)" value="<?=$dolar?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless" for="nama">Kategori</label>
	<?=katUI("event","parent_id",$parent_id,"inputpesan tbless")?><br class="clear" />
	<label class="tbless" for="nama">Venue</label>
	<?=katUI("fasilitas","venue",$venue,"inputpesan tbless")?><br class="clear" />
    <label class="tbless" for="tanggal">Tanggal</label>
	<input class="datepicker inputpesan tbless" readonly="readonly" type="text" name="tanggal_mulai" value="<?=$tanggal_mulai?>" size="10" /> 
    
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
