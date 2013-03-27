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
	$judulMenu = "Edit Header";
} else {
	$mode = "add";
	$judulMenu = "Tambah Header";
}
$judulnya = $judulMenu;

include_once("header.php");
include('../inc/SimpleImage.php');
$image = new SimpleImage();


$sqlS = "select * from ".tabel_header_slideshow." where id='".$id."'";

$resS = mysql_query($sqlS,$baca);
$rowS = mysql_fetch_object($resS);

$vKet=decodeHTML($rowS->ket);
$kategori=$rowS->kategori;
$url=$rowS->url;

if (mysql_num_rows($resS)<1) {
	header("location:headerList.php");
	exit;
}

$dir = "../images/header/";
$headerLama = $id;

if ($_POST) {
    
	$strError = "";	
	$vHeader = $_FILES['vHeader']['tmp_name'];      
	$vHeader_type = $_FILES['vHeader']['type'];
	$vHeader_size = $_FILES['vHeader']['size']/1024;
	$vHeader_name = $_FILES['vHeader']['name'];
	$vKet = encodeHTML($_POST["vKet"]);
	if(is_uploaded_file($vHeader)) {
		$size2 = @getimagesize($vHeader);         
		if($size2[0] != header_w) $strError=$strError."<li>Lebar header harus ".header_w." pixels!</li>";		
		if($size2[1] != header_h) $strError=$strError."<li>Tinggi header harus ".header_h." pixels!</li>";		
		if ($vHeader_size > image_filesize) $strError=$strError."<li>Ukuran header maksimal ".(image_filesize)." KB!</li>";
		if ($size2[2]!= IMAGETYPE_JPEG) $strError=$strError. "<li>Tipe header photo harus JPG.</li>"; 
        
	} 
	
	if (empty($strError)) {	   
	   if($mode=="edit") {
	    $upd='update '.tabel_header_slideshow.' set ket="'.$vKet.'"        				
		where id="'.$headerLama.'"';
		mysql_query($upd,$tulis);
		if(is_uploaded_file($vHeader)) {		
       	$namaHeader = $id;
			if (file_exists($dir.$headerLama.".jpg")) @unlink($dir.$headerLama.".jpg");		
			move_uploaded_file($vHeader,$dir.$namaHeader.".jpg");
			$headerLama = $namaHeader;
			$image->load($dir.$namaHeader.".jpg");	
			$image->save($dir.$headerLama.'.jpg');		
			
		}
        
		}
		header("location:headerList.php");
		exit;
	}	
}

$headerLamaUI = '<img src="'.$dir.$headerLama.'.jpg"/ width="200px" height="100px">';
?>
<div class="judul_menu">Edit Header</div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post" action="" enctype="multipart/form-data">
<table border="0">

<tr>
	<td align="left" valign="top"><b>link</b></td>
	<td align="left" valign="top">:</td>
	<td align="left" valign="top">
      <input name="vKet" type="text" value="<?=$vKet?>" size="120" />	
	</td>
</tr>

<tr>
	<td align="left" valign="top"><b>File</b></td>
	<td align="left" valign="top">:</td>
	<td align="left" valign="top">
		<?=$headerLamaUI?><br />
		<input type="file" name="vHeader" class="inputpesan"/>
		<br/>
		<span class="konten_kecil">
		Tipe file harus JPG.<br/>
		Dimensi header adalah <?=header_w?> X <?=header_h?> pixel.<br/>
		Ukuran maksimal file adalah  <?=image_filesize?> KB.<br/><br/>
		</span>
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