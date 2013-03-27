<?php
ob_start();
session_start();
include_once("plugins/captcha/securimage.php");

if ($_POST) {
	$strError = "";

	$vNama = trim(htmlspecialchars($_POST['vNama'], ENT_QUOTES));
	$vAlamat = trim(htmlspecialchars($_POST['vAlamat'], ENT_QUOTES));
	$vEmail = trim(htmlspecialchars($_POST['vEmail'], ENT_QUOTES));
	$vSitus = trim(htmlspecialchars($_POST['vSitus'], ENT_QUOTES));
	$vPesan = trim(htmlspecialchars($_POST['vPesan'], ENT_QUOTES));
	$code = $_POST['code'];
	
	if (empty($vNama)) $strError .= "<li>Nama masih kosong.</li>";
	if (empty($vAlamat)) $strError .= "<li>Alamat masih kosong.</li>";
	if (empty($vEmail)) $strError .= "<li>Email masih kosong.</li>";
	if (!empty($vEmail) && cekEmail($vEmail)!=1) $strError .= "<li>Format email salah.</li>";
	if (empty($vPesan)) $strError .= "<li>Pesan masih kosong.</li>";
	if (empty($code)) $strError .= "<li>Kode masih kosong.</li>";
	$simg = new Securimage();
	$valid = $simg->check($code);
	if (!$valid && !empty($code)) $strError .= "<li>Kode salah.</li>";
	
	if (empty($strError)) {
		$sql = "insert into ".tabel_tamu."(id_parent, kategori, nama, email, url, alamat, isi, tgl_guest, status, ip_guest) values ('0', 'pengunjung', '".$vNama."','".$vEmail."','".$vSitus."','".$vAlamat."','".$vPesan."',now(),'0','".$_SERVER['REMOTE_ADDR']."')";
		mysql_query($sql, $baca);
	}
}
?>

<?php
$isPesanOk = false;
$ket = '<p>Catatan: <br>Hanya bagian yang tercetak <b>tebal</b> yang merupakan isian yang wajib diisi.</p>';
if(strlen($strError)>0) {
	echo $ket;
	echo kotakError("Error:<br/><ul>".$strError."</ul>");
} else {
	if ($_POST) {
		echo '<p>Terima kasih telah mengisi buku tamu. Pesan Anda akan ditampilkan setelah moderasi.</p>';
		$isPesanOk = true;
	} else {
		echo $ket;
	}
}
?>

<?php if (!$isPesanOk) { ?>
<form method="post">
	<label class="tbless" for="vNama">Nama</label>
	<input type="text" name="vNama" value="<?= $vNama ?>" size="50" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="vAlamat">Alamat</label>
	<input type="text" name="vAlamat" value="<?= $vAlamat ?>" size="50" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="vEmail">Email</label>
	<input type="text" name="vEmail" value="<?= $vEmail ?>" size="50" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="vSitus">Website</label>
	<input type="text" name="vSitus" value="<?= $vSitus ?>" size="50" class="inputpesan tbless"><br class="clear" />
	
	<label class="tbless" for="vPesan">Isi Pesan</label>
	<textarea class="inputpesan tbless" name="vPesan" rows="4" cols="47"><?= $vPesan ?></textarea><br class="clear" />
	
	<div class="pad_tbless">
		<img id="image" src="plugins/captcha/securimage_show.php?sid=<?=md5(uniqid(time()))?>">
		<a href="#" onclick="document.getElementById('image').src = 'plugins/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="plugins/captcha/refresh.gif" border="0" alt="refresh image" title="refresh image"/></a><br/>
		<b>Silahkan isi kode diatas</b><br/>
		<input type="text" name="code" size="12" class="inputpesan"/><br/><br/>
	
		<input type="submit" name="submitbutton" class="tombol" value="Submit" />
	</div>
</form>
<?php } ?>
