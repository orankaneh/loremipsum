<?php
include_once("../inc/config.php");
include_once("../inc/fungsi.php");
include_once("../inc/fungsi_khusus.php");
include_once("../inc/fungsi_site.php");
include_once("../plugins/captcha/securimage.php");
    $username = $_GET['username'];
	$pass = strtolower($_GET['password']);
	$code = $_GET['code'];
	$valid= $_SESSION['securimage_code_value'];
	$simg = new Securimage();
	$valid = $simg->check($code);
	
    $sql = "select * from ".tabel_user." where user_name='".$username."' and status='1'";
	$res = mysql_query($sql,$baca);
	$usercek=mysql_num_rows($res);
	$row = mysql_fetch_object($res);
	$id = $row->id_user;
	$id_level = $row->id_level;
	$id_aplikasi = $row->id_aplikasi;
	$db_pass = $row->user_pass;
	$crypt = new MD5Crypt;
	$passvalid=$crypt->Decrypt($db_pass,key_generator);	
	if(!$valid){
	$data= array('error' => '1');
	}
	else if($usercek=='0'){
	$data= array('error' => '2');
	}
	else if($pass!=$passvalid){
	$data= array('error' => '3');
	}
	else{
	$sqlU = "update ".tabel_user." set last_login=now(), last_ip='".$_SERVER['REMOTE_ADDR']."', status_online='1' where id_user='".$id."'";
	mysql_query($sqlU,$tulis);
	$arrApp = explode(",",$id_aplikasi);
	$arrApp = array_filter($arrApp);				
	$_SESSION['admSession']['id_aplikasi'] = $arrApp;
	$_SESSION['admSession']['id'] = $id;
	$_SESSION['admSession']['id_level'] = $id_level;
	$_SESSION['username'] = $username;
	$data= array('error' => '0');
	}
	
die(json_encode($data));
exit;
?>
