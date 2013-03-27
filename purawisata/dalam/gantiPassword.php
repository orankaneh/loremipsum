<?php
ob_start();
session_start();
$checkApp = false;
$minLevel = 0;
$hakAksesAplikasi = 0;
$title_halaman = "Ganti Password";
include_once("header.php");

if ($_POST) {
	$crypt = new MD5Crypt;
	$vPassLama = encodeHTML($_POST["vPassLama"]);
	$vPassLama = strtolower($vPassLama);
	$vPass1 = encodeHTML($_POST["vPass1"]);
	$vPass1 = strtolower($vPass1);
	$vPass2 = encodeHTML($_POST["vPass2"]);
	$vPass2 = strtolower($vPass2);
	$strError = "";
	$id = $_SESSION['admSession']['id'];
	
	if (empty($vPassLama)) {
		$strError .= "<li>Password lama masih kosong</li>";
	} else {
		$sql = "select user_pass from ".tabel_user." where id_user='".$id."'";
		$res = mysql_query($sql,$baca);
		$row = mysql_fetch_object($res);
		$passDB = $row->user_pass;
		if($vPassLama != $crypt->Decrypt($passDB,key_generator)) $strError .= "<li>Password lama salah.</li>";
	}
	if (empty($vPass1)) $strError .= "<li>Password baru masih kosong.</li>";
	if (empty($vPass2)) $strError .= "<li>Konfirmasi password baru masih kosong.</li>";
	if (!empty($vPass1) && strlen($vPass1)<password_min_kar) $strError .= "<li>Jumlah karakter min. untuk password baru adalah ".password_min_kar." karakter.</li>";
	if (!empty($vPass2) && strlen($vPass2)<password_min_kar) $strError .= "<li>Jumlah karakter min. untuk konfirmasi password baru adalah ".password_min_kar." karakter.</li>";
	if ($vPass1 != $vPass2) $strError .= "<li>Password baru dan konfirmasi password baru tidak cocok.</li>";
	if (!empty($vPassLama) && ($vPassLama == $vPass1)) $strError .= "<li>Password baru tidak boleh sama dengan password lama.</li>";
	
	if (empty($strError)) {
		$sqlU = "update ".tabel_user." set user_pass='".$crypt->Encrypt($vPass1,key_generator)."' where id_user='".$id."'";
		mysql_query($sqlU,$tulis);
		header("location:info.php?id=2");
		exit;
	}
	
}

?>

<div class="judul_menu">Ganti Password</div>
<?php
	if (strlen($strError)>0) { echo kotakError("<ul>".$strError."</ul>"); }
?>
<form method="post">
	
	<label class="tbless" for="vPassLama">Password Lama</label>
	<input type="password" name="vPassLama" value="" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="vPass1">Password Baru</label>
	<input type="password" name="vPass1" value="" class="inputpesan tbless"> (min. <?=password_min_kar?> karakter)<br class="clear" />
	
	<label class="tbless" for="vPass2">Password Baru (Konfirmasi)</label>
	<input type="password" name="vPass2" value="" class="inputpesan tbless"> (min. <?=password_min_kar?> karakter)<br class="clear" />
	
	<label class="tbless" for="vPass2">&nbsp;</label>
	<input type="submit" value="ubah" class="tombol" /><br class="clear" />

	
</form>

<?
include_once("footer.php");
?>