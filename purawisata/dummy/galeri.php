<?php
ob_start();
session_start();
include_once("header.php");

$addSql = "";

$kat = (int) $_GET['kat']; // filter by kategori
if($kat>0) $addSql = " and parent_id='".$kat."' ";

$PageNo = $_GET['PageNo'];
$link = $_SERVER['PHP_SELF']."?id=".$_GET[id];
if (!empty($PageNo)) $link .= "&PageNo=".$PageNo;
if (!empty($kat)) $link .= "&kat=".$kat;

$judul = "Galeri";
$isi = "";
$sql ='select * from '.tabel_foto.' where status="1" and kategori="0" '.$addSql.' order by id desc';
$arrH = barHalaman($sql, $PageNo, 10, $link, "images/search_left.gif", "images/search_left_off.gif", "images/search_right.gif", "images/search_right_off.gif", "C", "id");
$res = mysql_query($arrH['sql'],$baca);
$num = mysql_num_rows($res);
$i = 0;
while ($row=mysql_fetch_object($res)){  
	$i++;
	$isi .=
		'<div style="float:left;width:100px;margin:3px 8px;">
			<a href="pic.php?tip=fo&id='.urlencode($row->id).'" title="'.$row->nama.'">
				<div style="width:100px;height:100px;position: relative;margin-bottom:6px;">
					<img height="100" width="100" style="border:1px solid #000;position:absolute;bottom:0;" border="0" src="pic.php?tip=ft&id='.$row->id.'" />
				</div>
				<div style="text-align:center;font-weight:bold;">'.$row->nama.'</div><br/>
			</a>			
		 </div>';
	if($i%5==0) {
		$isi .= '<br class="clear"/>';
		$i = 0;
	}
}
  
if($num<1) {
	$isi = 'Data not available';
} else {
	$isi = '<div id="gSlimbox">'.$isi.'<br class="clear"/></div>';
}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#gSlimbox a").slimbox({loop:true, counterText:"Gambar {x} dari {y}"});
		$("select[name=kat]").change(function(){ window.location.href = "?kat="+$(this).val(); });
	});
</script>

<?=$judul?><br/><br/>
<?=getSocialMediaUI()?><br/>
kategori: <?=katUI("galeri","kat",$kat,"inputpesan")?><br/><br/>
<?=$isi?>
<br/><br/><?=$arrH['bar']?>

<?php
include_once("footer.php");
?>