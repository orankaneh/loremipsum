<?
ob_start();
session_start();
include_once("../plugins/captcha/securimage.php");
include_once("../inc/config.php");
?>
<!DOCTYPE html>
<html>
    
<head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<title>Login Page</title>
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<link href="../css/login.css" rel="stylesheet" type="text/css" />
<link href="../css/icon.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../plugins/tipsy/tipsy.css" media="all"/>
<style type="text/css">
html {
	background-image: none;
}
label.iPhoneCheckLabelOn span {
	padding-left:0px
}
#versionBar {
	background-color:#161616;
	position:fixed;
	width:100%;
	height:30px;
	bottom:0;
	left:0;
	text-align:center;
	line-height:35px;
	z-index:11;
	-webkit-box-shadow: black 0px 10px 10px -10px inset;
	-moz-box-shadow: black 0px 10px 10px -10px inset;
	box-shadow: black 0px 10px 10px -10px inset;
}
.copyright{
	text-align:center; font-size:10px; color:#FFFFFF;
}
.copyright a{
	color:#FFFFFF; text-decoration:none
}    
</style>
</head>
<body >
         
<div id="alertMessage"></div>
<div id="successLogin"></div>
<div class="text_success"><img src="../images/loadder/loader_green.gif"  alt="Citraweb" /><span>Please wait</span></div>
<div id="login" >
  <div class="ribbon"></div>
  <div class="inner">
  <div class="logo"><img src="../images/logo/logocitra.png" alt="ziceAdmin" /></div>
  <div class="formLogin">
   <form name="formLogin"  id="formLogin" action="#">

          <div class="tip">
				<input name="username" type="text"  id="username_id"  title="Username"/>
          </div>
          <div class="tip">
				<input name="password" type="password" id="password"   title="Password"  />
          </div>
           <div id="capcay">
                 <img id="image" src="<?=$urlNya?>plugins/captcha/securimage_show.php?sid=<?=md5(uniqid(time()))?>">
				<a href="#" onClick="refreshcapcay()"><img src="<?=$urlNya?>plugins/captcha/refresh.png" border="0" alt="refresh image" title="refresh image"/></a></div><br/>
					Silahkan isi kode diatas<br/>
                      <div class="tip">
					<input type="text" name="code" id="code" size="12" title="Secure Code"/>
                    </div>
          <div class="loginButton">
			<div style="float:right; padding:3px 0; margin-right:-12px;">
              <div> 
                <ul class="uibutton-group">
                   <li><a class="uibutton normal" href="#" id="but_login" >Login</a></li>
	            </ul>
              </div>
			  
            </div>
			<div class="clear"></div>
		  </div>

    </form>
  </div>
</div>
  <div class="clear"></div>
  <div class="shadow"></div>
</div>

<!--Login div-->
<div class="clear"></div>
<div id="versionBar" >
  <div class="copyright" > &copy; Copyright 2013  All Rights Reserved <span class="tip"><a  href="http://www.citra.web.id/" title="Citraweb Nusa Infomedia" >Developed by Citraweb Nusa Infomedia </a> </span> </div>
  <!-- // copyright-->
</div>
<!-- Link JScript-->
<script type="text/javascript" src="../plugins/login/jquery.min.js"></script>
<script type="text/javascript" src="../plugins/login/jquery-jrumble.js"></script>
<script type="text/javascript" src="../plugins/login/jquery.ui.min.js"></script>     
<script type="text/javascript" src="../plugins/tipsy/jquery.tipsy.js"></script>
<script type="text/javascript" src="../plugins/login/iphone.check.js"></script>
<script type="text/javascript" src="../plugins/login/login.js"></script>
</body>
</html>