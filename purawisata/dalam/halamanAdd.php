<?
ob_start();
session_start();
$checkApp = false;
$minLevel = 0;
$hakAksesAplikasi = 0;
$judulnya = "Tambah Halaman";
include("header.php");

if(client_key!=md5("dynames")) {
	header("location:index.php");
	exit;
}

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
function getPreviewContent_e() {
	WPro.editors['pIsi_e'].updateValue();
	return WPro.editors['pIsi_e'].getValue();
}
function doPreview() {	
	var preWin = window.open('../preview.php','preWin');
}
function doPreview_e() {	
	var preWin = window.open('../preview_e.php','preWin');
}
</script>
<?

$aksi = "";

if ($_GET) {
	$topTU = $_GET['topTU'];
	$noAsliNya = $_GET['noAsliNya'];
}
if ($_POST) {
	$namaTU = $_POST['namaTU'];
	$namaTU_e = $_POST['namaTU_e'];
    $kategori = $_POST['kategori'];
    $includeNya = $_POST['includeNya'];
    $pIsi = $_POST['pIsi'];	
    $pIsi_e = $_POST['pIsi_e'];	
    $aksi = $_POST['aksi'];
    $katCode = $_POST['katCode'];
    $noAsliNya = $_POST['noAsliNya'];
    $topTU = $_POST['topTU'];
}
	
if($aksi=="1")
{	
	$strError="";
	$namaTU=stripslashes($namaTU);
	$namaTU_e=stripslashes($namaTU_e);
	$pIsi=cleanEditor("../",$pIsi);
	$pIsi_e=cleanEditor("../",$pIsi_e);
	
	if(strlen($namaTU) < 1) $strError=$strError."<li>Harap mengisi nama halaman (Indonesia).";
	if(strlen($namaTU_e) < 1) $strError=$strError."<li>Harap mengisi nama halaman (English).";
	
	if($kategori=="1")
	{
		if($includeNya=="")
		{
			$strError=$strError."<li>Silahkan mengisi file includenya.";
		}
		else
		{
			$pos=strpos($includeNya,'.php');
			if($pos < -1)
			{
				$strError=$strError."<li>Tipe file harus php.";
			}
			
		}
	}
	
	if(strlen($strError) < 1 and strlen($katCode) < 1)
	{
		
		$nomerAkhirNya=nomorHalamanPalingBawah($topTU);
		if($nomerAkhirNya != $noAsliNya || $noAsliNya==1 || $nomerAkhirNya == $noAsliNya)
			{
			$temp_noAsliNya=$noAsliNya;
			$sqlTNol = "SELECT * FROM ".tabel_halaman." where top_halaman='".$topTU."' and urut_halaman >= '".$noAsliNya."' ORDER BY urut_halaman asc";
			echo $sqlTNol."<br>";
			$resTNol = mysql_query($sqlTNol,$baca) or die(mysql_error());
			while($rs_TNol= mysql_fetch_array($resTNol)) {
				$temp_noAsliNya=$temp_noAsliNya+1;
				$sqlUpNol = "Update ".tabel_halaman." set urut_halaman='".$temp_noAsliNya."' where top_halaman='".$topTU."' and halaman_id='".$rs_TNol[halaman_id]."'";
				echo $sqlUpNol."==<br>";
				mysql_query($sqlUpNol,$tulis) or die("Error update idAkun:".mysql_error());
				}
			}
		else
			{
			$jmlTTU=1;
			}
		
		$statusTU=1;
		$queryATU = "INSERT INTO ".tabel_halaman."(top_halaman,urut_halaman,nama_halaman,isi_halaman,nama_halaman_e,isi_halaman_e,kategori_halaman,file_include,status_halaman,tgl_halaman,ip_halaman) VALUES('".$topTU."','".$noAsliNya."','" . addslashes($namaTU). "','" . addslashes($pIsi). "','" . addslashes($namaTU_e). "','" . addslashes($pIsi_e). "','"
		.$kategori."','".$includeNya."','". $statusTU . "','". time() ."','" . getenv("REMOTE_ADDR") . "')";
		//echo $queryATU;
		mysql_query($queryATU,$tulis) or die ("Error Add halaman:".mysql_error());
		Header("Location: halamanList.php");
	}
}
		  ?>
		  
		  <!--sisi kanan mulai-->
				<div class="judul_menu">Tambah Halaman</div>
				
				<?php
				if (strlen($strError) > 0)
					{
					echo kotakError($strError);
					}
				?>
		 		<form onSubmit="submit_form()" name="formAkun" method="post" action="<?echo $PHP_SELF;?>">
				<table width="100%" border="0" class="kotak_DFDFDF">
				<tr>
				<td align=left valign=top width="10%">Nama Halaman (Indonesa)</td><td align=left valign=top>:</td>
				<td align=left valign=top><INPUT TYPE=TEXT NAME="namaTU" value="<?echo $namaTU;?>" class="inputpesan" size="30" maxlength="100"></td>
				</tr>
				<tr>
				<td align=left valign=top width="10%">Nama Halaman (English)</td><td align=left valign=top>:</td>
				<td align=left valign=top><INPUT TYPE=TEXT NAME="namaTU_e" value="<?echo $namaTU_e;?>" class="inputpesan" size="30" maxlength="100"></td>
				</tr>
				<tr>
				<td align=left valign=top>Kategori</td><td align=left valign=top>:</td>
				<td align=left valign=top>
				<select disabled="disabled" class="inputpesan" name="kategori" onChange="disableTextField(this.form);" onLoad="disableTextField(this.form);">
				<option value="0" <? if($kategori=="0") { echo "selected";}?>>Non Aplikasi</option>
				<option value="1" <? if($kategori=="1") { echo "selected";}?>>Aplikasi</option>
				</select>, include file: <input type="text" name="includeNya" value="<?=$includeNya?>" size="30" maxlength="255" class="inputpesan" disabled="disabled" >
				</td>
				</tr>
				<tr>
				<td colspan="3" align=left valign=top>Isi Halaman (Indonesia)</td><td align=left valign=top>:</td>
				</tr>
				<tr>
				<td align=left valign=top colspan="3">
				<?php
					$editor = new wysiwygPro();
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
				<td colspan="3" align=left valign=top>Isi Halaman (English)</td><td align=left valign=top>:</td>
				</tr>
				<tr>
				<td align=left valign=top colspan="3">
				<?php
					$editor = new wysiwygPro();
					$editor->disableFeatures(array('print','spelling','dirltr','dirrtl','preview'));
					$editor->name = 'pIsi_e'; // nama editor
					$editor->value = $pIsi_e; // isi editor
					$editor->setupEditor(WPRO_DIR.'images/gambar/', site_img_dir, WPRO_DIR.'images/dokumen/', site_doc_dir);
					$editor->cssText = "body {color:#000;background:#FFF;}";
					$editor->display(600, 480);
				?>
				</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td><INPUT TYPE=hidden NAME="aksi" Value="1">
				<input type="hidden" name="katCode" value="">
				<INPUT TYPE="hidden" NAME="noAsliNya" Value="<?echo $noAsliNya?>">
				<INPUT TYPE="hidden" NAME="topTU" Value="<?echo $topTU?>">
				<td valign=top><INPUT TYPE=SUBMIT Value="Submit" class="tombol"></td>
				</tr>
				</table>
				</form>
           
<?
include ("footer.php");
?>

