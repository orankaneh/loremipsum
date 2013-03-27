<?
ob_start();
session_start();
$checkApp = false;
$minLevel = 0;
$hakAksesAplikasi = 0;
$judulnya = "Hapus Halaman";
include("header.php");

if(client_key!=md5("dynames")) {
	header("location:index.php");
	exit;
}

$act = "";
$mult_btn = "";

if ($_GET) {
	$act = $_GET['act'];
	$topTU = $_GET['topTU'];
	$noAsliNya = $_GET['noAsliNya'];
	$idNya = $_GET['idNya'];
}
if ($_POST) {
	$act = $_POST['act'];
	$topTU = $_POST['topTU'];
	$noAsliNya = $_POST['noAsliNya'];
	$idNya = $_POST['idNya'];
	$mult_btn = $_POST['mult_btn'];
}

if($act=="del") {
?>
	<table border="0" cellpadding="3" cellspacing="0">
    	<tr>
     <td class="tblHeadError" align="left">
     <b>Anda yakin ingin :</b>&nbsp;
     </td>
    	</tr>
    	<tr>
     <td class="tblBodyError">
     Menghapus "<u><? echo dataHalaman("nama",$idNya)?></u>" dan "<u>sub kategorinya</u>".
     </td>
    	</tr>
	<tr>
	<td align="right" nowrap="nowrap">
	<form action="<?=$PHP_SELF?>" method="post">
	<input type="hidden" name="act" value="confirm" />
	<input type="hidden" name="idNya" value="<?=$idNya?>" />
	<input type="hidden" name="topTU" value="<?=$topTU?>" />
	<input type="hidden" name="noAsliNya" value="<?=$noAsliNya?>" />
	<input type="submit" name="mult_btn" value="Yes" />
	<input type="submit" name="mult_btn" value="No" />
	</form>
	</td>
	</tr>
	</table>
<?
} else if($mult_btn=="Yes") {
	$sql_del="Delete from ".tabel_halaman." where halaman_id=$idNya";
	mysql_query($sql_del,$tulis);
	
	//update yang dibawahnya
	$nomerAkhirNya=nomorHalamanPalingBawah($topTU);
	if($nomerAkhirNya != $noAsliNya || $noAsliNya==1 || $nomerAkhirNya == $noAsliNya) {
		//$temp_noAsliNya=$noAsliNya;
		$sqlTNol = "SELECT * FROM ".tabel_halaman." where top_halaman='".$topTU."' and urut_halaman >= '".$noAsliNya."' ORDER BY urut_halaman asc";
		echo $sqlTNol."<br>";
		$resTNol = mysql_query($sqlTNol,$baca) or die(mysql_error());
		while($rs_TNol= mysql_fetch_array($resTNol)) 
		{
			$temp_noAsliNya=$rs_TNol[urut_halaman]-1;
			$sqlUpNol = "Update ".tabel_halaman." set urut_halaman='".$temp_noAsliNya."' where top_halaman='".$topTU."' and halaman_id='".$rs_TNol[halaman_id]."'";
			echo $sqlUpNol."==<br>";
			mysql_query($sqlUpNol,$tulis) or die("Error update idAkun:".mysql_error());
		}
	}
	Header("Location: halamanList.php");
}
else {
	Header("Location: halamanList.php");
}

include ("footer.php");
?>

