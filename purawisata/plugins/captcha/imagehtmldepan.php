<?
include_once("../../inc/config.php");
?>
<img id="image" src="<?=$urlNya?>plugins/captcha/capcay.php?sid=<?=md5(uniqid(time()))?>" class="capcaycontact">
<a href="#" onclick="refreshcapcay()"><img src="<?=$urlNya?>plugins/captcha/refresh.png" border="0" alt="refresh image" title="refresh image" class="refreshcapcay"/></a>