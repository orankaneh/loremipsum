<?
include_once("plugins/captcha/securimage.php");

$errmsg="";

if($_POST) {
	$fname = stripslashes($_POST['fname']);
	$email = stripslashes($_POST['email']);
	$address = stripslashes($_POST['address']);
	$phone = stripslashes($_POST['phone']);
	$fax = stripslashes($_POST['fax']);
	$comments = stripslashes($_POST['comments']);
	$code = $_POST['code'];

	if(strlen($fname) < 1) $errmsg .= "<li>Anda harus mengisi nama Anda</li>";
	if(strlen($email)< 1) {
		$errmsg .= "<li>Anda harus mengisi alamat email</li>";
	} else {
		if(cekEmail($email) == 0) $errmsg .= "<li>Format alamat email Anda invalid</li>";
	}
	if(strlen($comments)<1) $errmsg .= "<li>Anda harus mengisi pesan Anda</li>";
	$simg = new Securimage();
	$valid = $simg->check($code);
	if (!$valid) $errmsg .= "<li>Penulisan kode tidak sesuai</li>";

	if(strlen($errmsg)<1) {
		$include_pesan = $include_pesan . 	"Nama		: " . $fname . "\r\n";
		$include_pesan = $include_pesan . 	"Email		: " . $email . "\r\n";
		$include_pesan = $include_pesan . 	"Alamat		: " . $address . "\r\n";
		$include_pesan = $include_pesan . 	"No Telepon : " . $phone . "\r\n";
		$include_pesan = $include_pesan . 	"No Fax		: " . $fax . "\r\n";
		$include_pesan = $include_pesan . 	"Pesan		: " . $comments . "\r\n";
		$include_pesan = $include_pesan . 	"============================================\r\n";
		$include_pesan = $include_pesan . 	"IP Address	: " . $_SERVER["REMOTE_ADDR"] . "\r\n";
		$include_pesan = $include_pesan . 	"Waktu		: " . tglIndo(time(),"l",0);
		
		$errmsg .= kirimEmail("", false, client_email, "", $email, $fname, "Contact Us", $include_pesan);
	}
}
?>

<?php
$isPesanOk = false;
$ket = '<p>Catatan: <br>Hanya bagian yang tercetak <b>tebal</b> yang merupakan isian yang wajib diisi.</p>';
if(strlen($errmsg)>0) {
	echo $ket;
	echo kotakError("<ul>".$errmsg."</ul>");
} else {
	if ($_POST) {
		echo '<p>Terima kasih. Pesan Anda telah kami terima.<br/>Kami akan merespon pesan Anda sesegera mungkin.</p>';
		$isPesanOk = true;
	} else {
		echo $ket;
	}
}
?>

<?php if (!$isPesanOk) { ?>
<table width="100%" class="whiteTable">
<tr>
	<td align="left" valign="top" width="100%">
		<form method="post">
			<label class="tbless" for="fname">Nama</label>
			<input type="text" name="fname" value="<?= $fname ?>" size="50" class="inputpesan tbless"><br class="clear" />
			
			<label class="tbless_norm" for="email">Email</label>
			<input type="text" name="email" value="<?= $email ?>" size="50" class="inputpesan tbless"><br class="clear" />
			
			<label class="tbless" for="address">Alamat</label>
			<textarea class="inputpesan tbless" name="address" rows="4" cols="47"><?= $address ?></textarea><br class="clear" />
			
			<label class="tbless_norm" for="phone">No Telepon</label>
			<input type="text" name="phone" value="<?= $phone ?>" size="50" class="inputpesan tbless"><br class="clear" />
			
			<label class="tbless_norm" for="fax">No Fax</label>
			<input type="text" name="fax" value="<?= $fax ?>" size="50" class="inputpesan tbless"><br class="clear" />
			
			<label class="tbless" for="comments">Isi Pesan</label>
			<textarea class="inputpesan tbless" name="comments" rows="4" cols="47"><?= $comments ?></textarea><br class="clear" />
			
			<div class="pad_tbless">
				<img id="image" src="plugins/captcha/securimage_show.php?sid=<?=md5(uniqid(time()))?>">
				<a href="#" onclick="document.getElementById('image').src = 'plugins/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="plugins/captcha/refresh.gif" border="0" alt="refresh image" title="refresh image"/></a><br/>
				<b>Silahkan isi kode diatas</b><br/>
				<input type="text" name="code" size="12" class="inputpesan"/><br/><br/>
			
				<input type="submit" name="submitbutton" class="tombol" value="Submit" />
			</div>
		</form>
	</td>
</tr>
</table>
<?php } ?>