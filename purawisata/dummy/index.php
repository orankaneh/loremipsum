<?php
ob_start();
session_start();
include_once("header.php");


// header
$sqlH = "select * from ".tabel_header_slideshow." where status='1' order by id desc";
$resH = mysql_query($sqlH,$baca);
$numH = mysql_num_rows($resH);
$slideJS = '';
$i = 0;
while($rowH = mysql_fetch_object($resH)) {
	$i++;
	$slideJS .='{ url:"images/header/'.$rowH->id.'.jpg", link:"#", description:"'.str_replace(array("\r\n", "\r", "\n"), ' ', $rowH->ket).'" }';
	if($i<$numH) $slideJS .= ',';	
}
?>

<script>
$(document).ready(function(){
	// jquery slider - start
	$("#contentslider").showcase({
		animation: { interval: 3200, speed: 500,stopOnHover: true, easefunction: "swing", type: "vertical-slider" },
		images: [<?=$slideJS?>],
		navigator:{
			orientation : "vertical",
			autoHide: false, showNumber: true, position:"top-right",
			css: { padding:"0px", margin: "29px -2px 0 0", "font-weight": "bold" },
			showNumber: true,
			item: {
				css: {  color:"#000000",
						height:"22px",
						"line-height":"22px",
						width:"22px",
						"-moz-border-radius": "4px",
						"-webkit-border-radius": "4px",
						backgroundColor: "#FFFFFF",
						borderColor:"#FFFFFF",
						margin: "0 0 2px 0",
						"text-align": "center",
						"vertical-align": "middle" },
				cssHover: {
					color:"#FFFFFF",
					backgroundColor: "#FF0000",
					borderColor: "#FF0000" },
				cssSelected: {
					color:"#FFFFFF",
					backgroundColor: "#FF0000",
					borderColor: "#FF0000" }
			}
		},
		titleBar: {
			enabled: true,
			autoHide: false,
			css: {
				height: "46px" }
		}
	});
	// jquery slider - end
});
</script>

<div id="contentslider"></div>

<?
include_once("footer.php");
?>