<?php
ob_start();
session_start();
$judulnya = "Login";
include_once("header.php");
include_once("../plugins/captcha/securimage.php");

if ($_POST && $_POST['Submit'] == 1) {
	$strError = "";
	$user = encodeHTML($_POST["userMasuk"]);
	$user = strtolower($user);
	$pass = encodeHTML($_POST["passMasuk"]);
	$pass = strtolower($pass);
	$code = $_POST['code'];
	
	if (empty($user)) $strError .= "X1";
	if (empty($pass)) $strError .= "X2";
	$simg = new Securimage();
	$valid = $simg->check($code);
	if (!$valid) $strError .= "X3";

	if (empty($strError)) {
		$sql = "select * from ".tabel_user." where user_name='".$user."' and status='1'";
		$res = mysql_query($sql,$baca);
		$row = mysql_fetch_object($res);
		$id = $row->id_user;
		$id_level = $row->id_level;
		$id_aplikasi = $row->id_aplikasi;
		$db_pass = $row->user_pass;
		
		$crypt = new MD5Crypt;
		if($crypt->Decrypt($db_pass,key_generator)!=$pass) {
			header("location:".$_SERVER['PHP_SELF']);
			exit;
		} else {
			$sqlU = "update ".tabel_user." set last_login=now(), last_ip='".$_SERVER['REMOTE_ADDR']."', status_online='1' where id_user='".$id."'";
			mysql_query($sqlU,$tulis);
			
			$arrApp = explode(",",$id_aplikasi);
			$arrApp = array_filter($arrApp);				
			$_SESSION['admSession']['id_aplikasi'] = $arrApp;
			$_SESSION['admSession']['id'] = $id;
			$_SESSION['admSession']['id_level'] = $id_level;
			
			header("location:utama.php");
			exit;
		}
	}
}

?>
<div>
	<table cellspacing="0" cellpadding="5" border="0" width="100%">
	<tr>
	<td align="center" valign="middle">
		<form method="POST" action="index.php">
		<table cellspacing="0" cellpadding="5" border="0">
			<tr>
			      <td align="left">Username</td>
				  <td align="left"><input type="text" name="userMasuk" size="30" class="inputpesan"></td>
			</tr>
			<tr>
			      <td align="left">Password</td>
				  <td align="left"><input type="password" name="passMasuk" size="30" class="inputpesan"></td>
			</tr>		
			<tr>
			      <td align="center" colspan="2">
					<img id="image" src="../plugins/captcha/securimage_show.php?sid=<?=md5(uniqid(time()))?>">
					<a href="#" onclick="document.getElementById('image').src = '../plugins/captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="../plugins/captcha/refresh.gif" border="0" alt="refresh image" title="refresh image"/></a><br/>
					Silahkan isi kode diatas<br/>
					<input type="text" name="code" size="12" class="inputpesan"/>
				  </td>
			</tr>
			<tr>
			<td align="center" valign="top" colspan="2">
				<input type="submit" name="Submit" value="LOGIN" class="tombol" />
				<input type="hidden" name="Submit" value="1" />
			</td>
			</tr>		
		</table>
		</form>
	</td>
	</tr>
	</table>
</div>
<?
include_once("footer.php");
?>