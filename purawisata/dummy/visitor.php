<?
ob_start();
session_start();


	if($_SESSION['unique']==''){
		$session=sessionvisitor('3',$_SERVER['REMOTE_ADDR']);
		$_SESSION['unique']=$session;
	}
	else{
		$session=$_SESSION['unique'];
	}


	if($_SESSION['unique']!=''){
		$info=_select_unique_result("select count(id) from cni_visitor 
		where session='".$_SESSION['unique']."' and tanggal='".date("Y-m-d")."'");

	  if($info[0]=='0'){
		$today=date("Y-m-d");
		$ip=$_SERVER['REMOTE_ADDR'];
			if(isset($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER']!=''){
				$asal=$_SERVER['HTTP_REFERER'];
			}
			else{
				$asal="-";
			}

			_insert("INSERT INTO cni_visitor
			VALUES ('','$today','$session','$ip','$asal') ");
	  }
	}
?>