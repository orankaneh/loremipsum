<?
include_once("../../inc/config.php");
?>
<img id="image" src="<?=$urlNya?>plugins/captcha/securimage_show.php?sid=<?=md5(uniqid(time()))?>">
<a href="#" onclick="refreshcapcay()"><img src="<?=$urlNya?>plugins/captcha/refresh.png" border="0" alt="refresh image" title="refresh image"/></a>