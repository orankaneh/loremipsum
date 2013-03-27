<?
ob_start();
session_start();
include("inc/config.php");
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// always modified
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

// HTTP/1.0
header("Pragma: no-cache");

$id  = (int) $_GET['id'];  // id picture
$tip = $_GET['tip']; // type picture

/* 
type picture:
	ha = header side a
	hb = header side b
	hc = header side c
*/	

if($tip == 'ft'){
	$foldernya = "images/foto/thumb/".$id.".jpg";
	$nopict = "images/foto/default.jpg";
}else if($tip == 'fo'){
	$foldernya = "images/foto/".$id.".jpg";
	$nopict = "images/foto/default.jpg";
}


if(file_exists($foldernya) and strlen(getenv("HTTP_REFERER")) > 0){
	$fp = fopen ($foldernya , "r");
	header("Content-Type: image/jpeg");
	fpassthru ($fp);
	fclose($fp);
}else{
	$fp = fopen ($nopict , "rb");
	header("Content-Type: image/jpeg");
	fpassthru ($fp);
	fclose($fp);
}	

?>
