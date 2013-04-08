<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 0;
$hakAksesAplikasi = 0;
$title_halaman = "Yahoo Messenger";
include_once("header.php");

if (isset($_POST['yahoo1'])) {
$upd=" update ".yahoo_mesangger." set account='$_POST[yahoo1]' where id='1'";
$upd2=" update ".yahoo_mesangger." set account='$_POST[yahoo2]'  where id='2'";
$exe = mysql_query($upd,$baca);
$exe2 = mysql_query($upd2,$baca);
}

?>

<div class="judul_menu">Yahoo Messenger</div>
<?php
$cmd="SELECT * FROM ".yahoo_mesangger;
$res = mysql_query($cmd,$baca);
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post">
  <? 
$no=1;  while($brs= mysql_fetch_array($res)){?>
	<label class="tbless" for="vPassLama">Yahoo Id<?=$no?></label>
	<input type="text" name="yahoo<?=$no?>" value="<?=$brs['account']?>" class="inputpesan tbless"><br class="clear" />
	     <? 
		 $no++;
		 }?>

	
	<label class="tbless" for="vPass2">&nbsp;</label>
	<input type="submit" value="ubah" class="tombol" /><br class="clear" />

	
</form>

<?
include_once("footer.php");
?>