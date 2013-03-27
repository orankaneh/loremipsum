<?php
ob_start();
session_start();

$checkApp = false;
$minLevel = 800;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Header";
include_once("header.php");

$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];
//utk membuat otomatis bar halaman sesuai setting
if (!empty($katakunci)) $link = $_SERVER['PHP_SELF']."?katakunci=".$katakunci;


$link = $_SERVER['PHP_SELF']."?z";
if (!empty($q)) $link .= "&q=".$q;
$i = 0;
$fromData=1;
$sql = "select id from ".tabel_header_slideshow." ".$addSql." order by id asc";
$arrH = barHalaman($sql, $PageNo, 10, $link, "../images/search_left.gif", "../images/search_left_off.gif", "../images/search_right.gif", "../images/search_right_off.gif", "C", "id");
$res = mysql_query($sql,$baca);
$arr = array();
while($row=mysql_fetch_object($res)) {
	$arr[$i]['no'] = $fromData++;
	$arr[$i]['id'] = $row->id;	
	$dFile = "../images/header/".$row->id.".jpg";
	$arr[$i]['teks_file'] = '<img alt="header '.$row->id.'" title="header '.$row->id.'" src="'.$dFile.'" border="0"/>';	
	$arr[$i]['teks_kategori'] = $arrK[$row->kategori_header_id];	
	$i++;
}


	if (count($arr)>0) { 
		for ($i=0;$i<count($arr);$i++) {
   $header.='<tr bgcolor="#EEEEEE" onMouseOver="this.style.background=\'#FFFFFF\'" onMouseOut="this.style.background=\'#EEEEEE\'">
	<td valign="middle" align="center">'.$arr[$i]['no'].'</td>
	<td valign="middle" align="center"><a href="headerUpdate.php?id='.$arr[$i]['id'].'">'.$arr[$i]['teks_file'].'</a></td>
</tr>';
 } } else {  
   $header = 'Data not available';
 }
?>

<!--sisi kanan mulai-->
<div class="judul_menu">Daftar Header</div>
<table width="100%" cellpadding="0" cellspacing="0" class="dtable">
			<tr class="dhead">
				<td align="center" valign="top" width="1%">No</td>
				<td align="center" valign="top" width="1%">Header</td>				
			</tr>
<?=$header?>
</table>
<br/>
<!--sisi kanan selesai-->

<b>Note</b>:<br/>
jika gambar belum berubah setelah proses upload, Tekan CTRL+F5

<?
include_once("footer.php");
?>