<?
include_once("../../inc/config.php");
?>
<img id="image" src="<?=app_base_url?>plugins/captcha/capcay.php?sid=<?=md5(uniqid(time()))?>" class="capcaycontact">
<a href="#" onclick="refreshcapcay('<?=app_base_url?>')"><img src="<?=app_base_url?>plugins/captcha/refresh.png" border="0" alt="refresh image" title="refresh image" class="refreshcapcay"/></a>