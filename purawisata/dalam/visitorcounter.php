<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 0;
$hakAksesAplikasi = 0;
$title_halaman = "Paypal";
include_once("header.php");

if (isset($_POST['script'])) {
$upd=" update ".tabel_script." set isi='$_POST[script]' where id='1'";
//$upd2=" update ".tabel_ym." set account='$_POST[yahoo2]'  where id='2'";
$exe = mysql_query($upd,$baca);
//$exe2 = mysql_query($upd2,$baca);
}

?>

<div class="judul_menu">Visitor Counter</div>
<?php
$cmd="SELECT * FROM ".tabel_script." where id ='1'";
$res = mysql_query($cmd,$baca);
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post">
  <? 
$no=1;  while($brs= mysql_fetch_array($res)){?>
<label class="tbless" for="vPassLama">Preview:</label>
<?=$brs['isi']?>
<br class="clear" />
	<label class="tbless" for="vPassLama">Script:</label>
	<textarea name="script" cols="60" rows="8" class="script"><?=$brs['isi']?>
	</textarea>
<br class="clear" />
	     <? 
		 $no++;
		 }?>

	
	<label class="tbless" for="vPass2">&nbsp;</label>
	<input type="submit" value="ubah" class="tombol" /><br class="clear" />

	
</form>

<?
include_once("footer.php");
?>