<?
ob_start();
session_start();
$_SESSION["bahasa"]=$_GET["bahasa"];
$urlB=str_replace("~","&",$_GET["urlB"]);
echo $urlB;
header("location:$urlB");
?>
