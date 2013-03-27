<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Update Foto";
include_once("header.php");
include('../inc/SimpleImage.php');

$id = (int) $_GET['id'];
$mode = "";
$judulMenu = "";

$image = new SimpleImage();

if($id>0) {
	$mode = "edit";
	$judulMenu = "Edit Foto";
} else {
	$mode = "add";
	$judulMenu = "Tambah Foto";
}
$strError = "";

if($mode=="edit") {
	$sqlC = "select * from ".tabel_foto." where id='".$id."'";
	$resC = mysql_query($sqlC,$baca);
	$numC = mysql_num_rows($resC);
	if($numC<1) {
		header("location:info.php?id=1");
		exit;
	}
	$rowC = mysql_fetch_object($resC);
	$nama = $rowC->nama;
	$isi = $rowC->isi;
	$parent_id = $rowC->parent_id;
}

if($_POST) {
	$nama = encodeHTML($_POST["nama"]);
	$isResize = $_POST['isResize'];
	$parent_id = $_POST['parent_id'];
	$isi = encodeHTML($_POST['isi']);
	$fileThumb = $_POST['thumbnail'];
	$jenis = 'galeri';
	$wajibAda = true;
	if($mode=="add") {
		$wajibAda = true; 
	}else{		
		$wajibAda = false; 
	}
	
	if(empty($parent_id)) $strError .= "<li>Kategori belum dipilih</li>";
	if(empty($nama)) $strError .= "<li>Nama masih kosong</li>";
	if(empty($isi)) $strError .= "<li>Keterangan masih kosong</li>";
	if($isResize =='') 
    {
        $strError .= checkFile($_FILES['thumbnail'],"thumbnail","thumbnail",$wajibAda);}
    else
    {        
   	    $strError .= checkFile($_FILES['fileori'],$jenis,"gambar",$wajibAda);    
    }
	
	if(strlen($strError)<1) {		
		if($mode=="add") {
			$sql =
				"insert into ".tabel_foto."(parent_id,nama,kategori,isi,status,tgl_update,ip_update) values
				 (".$parent_id.",'".$nama."','0','".$isi."','1',now(),'".$_SERVER['REMOTE_ADDR']."') ";
			mysql_query($sql,$tulis);
						
			$id_s = mysql_insert_id();	
		} else {
			$sql =
				"update ".tabel_foto." set
				 parent_id='".$parent_id."',
				 kategori='0',
				 nama='".$nama."',
				 isi='".$isi."',
				 tgl_update=now(),
				 ip_update='".$_SERVER['REMOTE_ADDR']."' where id='".$id."'";
			mysql_query($sql,$tulis) or die ( mysql_error() );
			
			$id_s = $id;		
		}
				
		if(is_uploaded_file($_FILES['fileori']['tmp_name'])){
				if (file_exists("../images/foto/" . $id_s . ".jpg")) unlink("../images/foto/" . $id_s . ".jpg");
		
				$res = copy($_FILES['fileori']['tmp_name'], "../images/foto/" . $id_s . ".jpg");		
				//echo 'abc';
		}
		
		if($isResize=='1'){
			if(is_uploaded_file($_FILES['fileori']['tmp_name'])){
				if (file_exists("../images/foto/thumb/" . $id_s . ".jpg")) unlink("../images/foto/thumb/" . $id_s . ".jpg");
				$image->load("../images/foto/" . $id_s . ".jpg");
				$image->resize(gallery_w_thumb_size,gallery_h_thumb_size);
				$image->save('../images/foto/thumb/'. $id_s .'.jpg');
			}
		}else{
			if(is_uploaded_file($_FILES['thumbnail']['tmp_name'])){
				if (file_exists("../images/foto/thumb/" . $id_s . ".jpg")) unlink("../images/foto/thumb/" . $id_s . ".jpg");
		
				$res = copy($_FILES['thumbnail']['tmp_name'], "../images/foto/thumb/" . $id_s . ".jpg");		
				//echo 'abc';
			}
		}
		
		header("location:galeriList.php");
		exit;
	}
}
/* set input gambar thumbnail */
		$hideTn= "
		<script>
			$('#setThumbnail').hide();
		</script>
		";
?>

<script type="text/javascript" language="JavaScript">
function toggleThumbnail(){
	$("#setThumbnail").toggle();
}
</script> 

<div class="judul_menu"><?=$judulMenu?></div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="?id=<?=$id?>" ENCTYPE="multipart/form-data">
	
	<label class="tbless_norm" for="nama">Kategori</label>
	<?=katUI("galeri","parent_id",$parent_id,"inputpesan tbless")?><br class="clear" />
	
	<label class="tbless" for="nama">Nama</label>
	<input type="text" name="nama" size="60" value="<?=$nama?>" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="nama">Keterangan</label>
	<textarea name="isi" cols="60" rows="4"  class="inputpesan tbless"><?=$isi?></textarea><br class="clear" />
	
	<label class="tbless" for="nama">File Gambar</label>
	<?if(file_exists("../images/foto/thumb/" . $id . ".jpg")){?> <img src="../images/foto/thumb/<?=$id?>.jpg" border="0" /><br class="clear" /> 
	<label class="tbless" for="nama">&nbsp;</label><?}?>	<input type="file" name="fileori" size="40" value="<?=$fileOri?>" class="inputpesan tbless"><br class="clear" />
	<label class="tbless" for="nama">&nbsp;</label>File Format JPG<br class="clear" />
	<label class="tbless" for="nama">&nbsp;</label>File size maksimal <?=(galeri_fsize/1024)?> KB<br class="clear" />
	
	<label class="tbless" for="nama">&nbsp;</label>
	<input type="checkbox" name="isResize" value="1" <?if($isResize == '1') echo "checked";?> class="inputpesan tbless" onclick="javascript:toggleThumbnail();" > Resize Otomatis<br class="clear" />
	<div id="setThumbnail"><label class="tbless" for="nama">Thumbnail</label>
	<input type="file" name="thumbnail" size="40" value="<?=$thumbnail?>" class="inputpesan tbless"> File Format JPG dengan ukuran <?=gallery_w_thumb_size?>x<?=gallery_h_thumb_size?> pixel<br class="clear" /></div>
	<label class="tbless" for="">&nbsp;</label>
	<input type="submit" value="Simpan" class="tombol" /><br class="clear" />
	
</form>
<?php
if($isResize == '1'){ echo $hideTn; }
include_once("footer.php");
?>
