<?
ob_start();
session_start();
$checkApp = false;
$minLevel = 0;
$hakAksesAplikasi = 0;
$judulnya = "Edit Halaman";
include("header.php");
?>
<script language="Javascript">
function disableTextField (x) 
{
	var x_nil = x.kategori.value;
	if (x_nil == 0) 
	{
		x.includeNya.disabled = true;
	}
	else 
	{
		x.includeNya.disabled = false;
		x.includeNya.oldOnFocus = x.includeNya.onfocus;
	}
}
function getPreviewContent() {
	WPro.editors['pIsi'].updateValue();
	return WPro.editors['pIsi'].getValue();
}
function doPreview() {	
	var preWin = window.open('../preview.php','preWin');
}

</script>
<?

$act = "";
$aksi = "";

if ($_GET) {
	$act = $_GET['act'];
	$idNya = $_GET['idNya'];
}
if ($_POST) {
	$act = "";
	$namaTU = $_POST['namaTU'];
	$kategori = $_POST['kategori'];
	$includeNya = $_POST['includeNya'];
	$pIsi = decodeHTML($_POST['pIsi']);
	$vStatus = $_POST['vStatus'];
	$aksi = $_POST['aksi'];
	$vStatusLama = $_POST['vStatusLama'];
	$topNya = $_POST['topNya'];
	$idNya = $_POST['idNya'];
}

if($act=="edit") {	
	$sqlview2 = "SELECT * FROM ".tabel_halaman." where halaman_id=".$idNya;
	$resultTU = mysql_query($sqlview2,$baca);
	while($rsTU2=mysql_fetch_array($resultTU)){
		$namaTU=$rsTU2['nama_halaman'];
		$kategori=$rsTU2['kategori_halaman'];
		$includeNya=$rsTU2['file_include'];
		$pIsi=decodeHTML($rsTU2['isi_halaman']);
		$vStatus=$rsTU2['status_halaman'];
		$vStatusLama=$vStatus;
	}	
}

if($aksi=="1") {	
	$strError="";
	$namaTU=encodeHTML($namaTU);
	$includeNya=encodeHTML($includeNya);
	$pIsi=$pIsi;
	
	if(strlen($namaTU) < 1) $strError=$strError."<li>Harap mengisi nama halaman.";
	
	if($kategori=="1")
	{
		if($includeNya=="")
		{
			$strError=$strError."<li>Silahkan mengisi file includenya.";
		}
		/* else
		{
			$pos=strpos($includeNya,'.php');
			if($pos < -1)
			{
				$strError=$strError."<li>Tipe file harus php.";
			}
			
		} */
	}
		
	if(strlen($strError) < 1 and strlen($katCode) < 1)
	{
		$queryATU = "UPDATE ".tabel_halaman." set nama_halaman='".$namaTU."',isi_halaman='".cleanEditor("../",$pIsi)."',kategori_halaman='".$kategori."', file_include='".$includeNya."', status_halaman='".$vStatus."',tgl_halaman='".time()."',ip_halaman='".getenv("REMOTE_ADDR")."' where halaman_id=".$idNya;
		// echo $queryATU;
		mysql_query($queryATU,$tulis) or die ("Error Edit halaman:".mysql_error());
		if($vStatusLama!=$vStatus) updateSubHalaman2($idNya,$vStatus);
		Header("Location: halamanList.php");
	}
}
		  ?>
		  		<div class="judul_menu">Edit Halaman</div>
				
				<?php
				if (strlen($strError) > 0)
					{
					echo kotakError($strError);
					}
				?>
		 		<form onSubmit="submit_form()" name="formAkun" method="post" action="<?echo $PHP_SELF;?>">
				<table width="100%" border="0" class="kotak_DFDFDF">
				<tr>
				<td align=left valign=top width="10%">Nama Halaman</td><td align=left valign=top>:</td>
				<td align=left valign=top><INPUT TYPE=TEXT NAME="namaTU" value="<?echo $namaTU;?>" class="inputpesan" size="30" maxlength="100"></td>
				</tr>
				<tr>
				<td align=left valign=top>Kategori</td><td align=left valign=top>:</td>
				<td align=left valign=top>
				<select class="inputpesan" name="kategori" onChange="disableTextField(this.form);" onLoad="disableTextField(this.form);">
				<option value="0" <? if($kategori=="0") { echo "selected";}?>>Non Aplikasi</option>
				<option value="1" <? if($kategori=="1") { echo "selected";}?>>Aplikasi</option>
				</select>, include file: <input type="text" name="includeNya" value="<?=$includeNya?>" size="30" maxlength="255" class="inputpesan">
				</td>
				</tr>
				<tr>
				<td align=left valign=top>Isi Halaman</td><td align=left valign=top>:</td>
				<td align=left valign=top><input type="button" name="Preview" value="Preview" class="tombol" onClick="doPreview()"/></td>
				</tr>
				<tr>
				<td align=left valign=top colspan="3">
				<?php
					$editor = new wysiwygPro();
					$editor->editorURL = editor_url;
					$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
					$editor->name = 'pIsi'; // nama editor
					$editor->value = $pIsi; // isi editor
					$editor->setupEditor(WPRO_DIR.'images/gambar/', site_img_dir, WPRO_DIR.'images/dokumen/', site_doc_dir);
					$editor->cssText = "body {color:#000;background:#FFF;}";
					$editor->display(600, 480);
				?>
				</td>
				</tr>
				<tr>
				<td align=left valign=top>Status</td><td align=left valign=top>:</td>
				<td align=left valign=top><INPUT TYPE=checkbox NAME="vStatus" value=1 <?if($vStatus==1) echo "Checked";?>></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td><INPUT TYPE=hidden NAME="aksi" Value="1">
				<input type="hidden" name="vStatusLama" value="<?=$vStatusLama?>">
				<INPUT TYPE=hidden NAME="topNya" Value="<?echo $topNya?>">
				<INPUT TYPE=hidden NAME="idNya" Value="<?echo $idNya?>">
				</td>
				<td valign=top><INPUT TYPE=SUBMIT Value="Submit" class="tombol"></td>
				</tr>
				</table>
				</FORM>
            
<?
include ("footer.php");
?>

