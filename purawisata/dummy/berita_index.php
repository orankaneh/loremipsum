<?
ob_start();
session_start();
include_once("header.php"); 

$addSql = "";

$kat = (int) $_GET['kat']; // filter by kategori
if($kat>0) $addSql = " and parent_id='".$kat."' ";

$link = $_SERVER['PHP_SELF']."?z";
$PageNo = $_GET['PageNo'];
if($_POST) $PageNo = $_POST['dPageNo'];
if (!empty($kat)) $link .= "&kat=".$kat;

$sql = "select * from ".tabel_berita." where 1 and kategori='0' and status='1' ".$addSql." order by id desc ";
$arrH = barHalaman($sql, $PageNo, 10, $link, "images/search_left.gif", "images/search_left_off.gif", "images/search_right.gif", "images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
$ui = '';
while($row=mysql_fetch_object($res)) {
	// reformat isi content
	$isi = decodeHTML($row->isi);
    $bersihkan=strip_tags(trim($isi));
    $gambar=getFirstImage($isi,80,80,'style="border:1px solid #959595;padding:5px;margin: 0px 5px 0px 0px;" align="left"');
    $isi=str_replace("&nbsp;","",$bersihkan);
    if (strlen($gambar)>0) {
          $isi ='<div>'.$gambar.' '.putusKalimat($isi,200).'</div>' ;
    } else {
          $isi = putusKalimat($isi,300) ; 
    }
	
	// atur tampilannya
	$ui .=
		'<b>'.$row->nama.'</b><br/>
		'.$isi.'<br/>
		<a href="berita_detail.php?PageNo='.$PageNo.'&id='.$row->id.'">selengkapnya</a>
		<br class="clear"/>
		<hr/>';
}

// pasang bar halaman
$ui .= '<br/>'.$arrH['bar'];

?>

<script type="text/javascript">
$(document).ready(function() {
	$("select[name=kat]").change(function(){ window.location.href = "?kat="+$(this).val(); });
});
</script>

kategori: <?=katUI("berita","kat",$kat,"inputpesan")?><br/><br/>
<?=$ui?>

<?php
include_once("footer.php");
?>
