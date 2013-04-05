<? include "head.php"; ?>
<body>
<div id="cni-main">
<script>
$(document).ready(function(){
$(".contact").addClass("active");
$(".home").removeClass("active");
$(".desktop-nav").removeClass("cni-nav");
$(".desktop-nav").addClass("cni-navwhite");
$(".cni-hmenu").addClass("spasi");
$(".contact").append("<div class='triangle'></div>");
  });
</script>
<? include "header.php"; ?>
<div class="cni-sheet clearfix">
            <div class="cni-layout-wrapper clearfix">
                <div class="cni-content-layout">
                    <div class="cni-content-layout-row">
                        <div class="cni-layout-cell cni-content clearfix"><article class="cni-post cni-article">
                                
                                                
                <div class="cni-postcontent cni-postcontent-0 clearfix"><div class="cni-content-layout">
    <div class="cni-content-layout-row">
    <div class="cni-layout-cell layout-item-0" style="width: 100%" >
        <p><br/></p>
    </div>
    </div>
      <div class="beritainindex">
	<div class="detailberita">	
     <?php
ob_start();
session_start();
include_once("plugins/captcha/securimage.php");
$vPesan="";
$hideform='0';
if (isset($_POST['submit'])) {
	$strError = "";

	$vNama = trim(htmlspecialchars($_POST['vNama'], ENT_QUOTES));
	$vAlamat = trim(htmlspecialchars($_POST['vAlamat'], ENT_QUOTES));
	$vEmail = trim(htmlspecialchars($_POST['vEmail'], ENT_QUOTES));
	$vSitus = trim(htmlspecialchars($_POST['vSitus'], ENT_QUOTES));
	$vPesan = trim(htmlspecialchars($_POST['vPesan'], ENT_QUOTES));
	$vMobile = trim(htmlspecialchars($_POST['vMobile'], ENT_QUOTES));
	$vTelp = trim(htmlspecialchars($_POST['vTelp'], ENT_QUOTES));
	$code = $_POST['code'];
	
	if (empty($vNama)) $strError .= "<li>".$arrTeks[kontak_erorr_nama]."</li>";
//	if (empty($vAlamat)) $strError .= "<li>".$StrErrAlamat."</li>";
    if (empty($vMobile)) $strError .= "<li>".$arrTeks[kontak_erorr_mobile]."</li>";
	if (empty($vEmail)) $strError .= "<li>".$arrTeks[kontak_erorr_email]."</li>";
	if (cekEmail($vEmail)!=1) $strError .= "<li>".$arrTeks[kontak_erorr_format]."</li>";
	if (empty($vPesan)) $strError .= "<li>".$arrTeks[kontak_erorr_pesan]."</li>";
	if (empty($code)) $strError .= "<li>".$arrTeks[kontak_erorr_kode]."</li>";
	$simg = new Securimage();
	$valid = $simg->check($code);
	if (!$valid && !empty($code)) $strError .= "<li>".$arrTeks[kontak_erorr_code_isi]."</li>";
	$include_email_tujuan='rizaldy@citra.web.id';
	//$include_email_tujuan='info@aryukahotel.com';
	if (empty($strError)) {
	    $ip=$_SERVER['REMOTE_ADDR'];	        
		$include_email_dari=$vNama;
		$include_nama_dari=$vEmail;
		$include_subyek='Contact Us - '.client;
		$include_pesan .= "	
        
        Nama            : " . $vNama . "  \n
        Email           : " . $vEmail . "  \n
        Phone           : " . $vTelp . "  \n
        Mobile          : " . $vMobile . "\n
        Pesan           : " . $vPesan . " \n                                                                         
		============================================ \n\r
        IP Address	: " . getenv("REMOTE_ADDR") . " \n
        Time		: " . tglIndo(time(),"l_e",$selisihJam)." \n
		
		Thank You";
        
	_insert("insert into ".tabel_pesan." VALUES ('','$vNama','$vEmail','$vTelp','$vMobile','$vPesan','$ip')");
	kirimEmail("", false, $include_email_tujuan, client, $vEmail, $vNama, $include_subyek, $include_pesan);		
		
	}
}
?>

<?php
$isPesanOk = false;
//$ket = $catatan;

//echo "<br /><br />";
?>

<?php if (!$isPesanOk) { ?>

<form method="post" id="form1">
<div class="contactusform">
<fieldset>
<legend>&nbsp;Guest Book &nbsp;</legend>
<script>
$(document).ready(function(){
    $(function() {
        $('.pesanerror').fadeOut(10000);
    })
$(function()
{
	$('.isibuku').jScrollPane();
});
	
  });
</script>
<div class="pesanerror">
<?
if(strlen($strError)>0) {
	echo $strError;
}
else {
if (isset($_POST['submit'])) {
?>
    
<script>
$(document).ready(function(){
    $(function() {
   setTimeout(function() {
    window.location = "<?=app_base_url?>";
    }, 1500);
    })
  });
</script>    
<?
        echo "<li>Thank you</li>";
		echo "<li>Your message has been successfully sent. We will contact you very soon! </li>";
		$isPesanOk = true;
		$hideform='1';
	} else {
		echo "<span style='color:#333'>".$ket."</span>";
	}
}
?>
</div>
<div class="isibuku">
<fieldset class="textbuku">
 
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in ligula id sem tristique ultrices eget id neque. Duis enim turpis, tempus at accumsan vitae, lobortis id sapien. Pellentesque nec orci mi, in pharetra ligula. Nulla facilisi. Nulla facilisi. Mauris convallis venenatis massa, quis consectetur felis ornare quis. Sed aliquet nunc ac ante molestie ultricies. Nam pulvinar ultricies bibendum. Vivamus diam leo, faucibus et vehicula eu, molestie sit amet dui. Proin nec orci et elit semper ultrices. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed quis urna mi, ac dignissim mauris. Quisque mollis ornare mauris, sed laoreet diam malesuada quis. Proin vel elementum ante. Donec hendrerit arcu ac odio tincidunt posuere. Vestibulum nec risus eu lacus semper viverra.
</fieldset>
<p>
Vestibulum dictum consectetur magna eu egestas. Praesent molestie dapibus erat, sit amet sodales lectus congue ut. Nam adipiscing, tortor ac blandit egestas, lorem ligula posuere ipsum, nec faucibus nisl enim eu purus. Quisque bibendum diam quis nunc eleifend at molestie libero tincidunt. Quisque tincidunt sapien a sapien pellentesque consequat. Mauris adipiscing venenatis augue ut tempor. Donec auctor mattis quam quis aliquam. Nullam ultrices erat in dolor pharetra bibendum. Suspendisse eget odio ut libero imperdiet rhoncus. Curabitur aliquet, ipsum sit amet aliquet varius, est urna ullamcorper magna, sed eleifend libero nunc non erat. Vivamus semper turpis ac turpis volutpat non cursus velit aliquam. Fusce id tortor id sapien porta egestas. Nulla venenatis luctus libero et suscipit. Sed sed purus risus. Donec auctor, leo nec eleifend vehicula, lacus felis sollicitudin est, vitae lacinia lectus urna nec libero. Aliquam pellentesque, arcu condimentum pharetra vestibulum, lectus felis malesuada felis, vel fringilla dolor dui tempus nisi. In hac habitasse platea dictumst. Ut imperdiet mauris vitae eros varius eget accumsan lectus adipiscing.
</p>
<hr style="width: 100%; height: 1px">
<p>
Quisque et massa leo, sit amet adipiscing nisi. Mauris vel condimentum dolor. Duis quis ullamcorper eros. Proin metus dui, facilisis id bibendum sed, aliquet non ipsum. Aenean pulvinar risus eu nisi dictum eleifend. Maecenas mattis dolor eget lectus pretium eget molestie libero auctor. Praesent sit amet tellus sed nibh convallis semper. Curabitur nisl odio, feugiat non dapibus sed, tincidunt ut est. Nullam erat velit, suscipit aliquet commodo sit amet, mollis in mauris. Curabitur pharetra dictum interdum. In posuere pretium ultricies. Curabitur volutpat eros vehicula quam ultrices varius. Proin volutpat enim a massa tempor ornare. Sed ullamcorper fermentum nisl, ac hendrerit sem feugiat ac. Donec porttitor ullamcorper quam. Morbi pretium adipiscing quam, quis bibendum diam congue eget. Sed at lectus at est malesuada iaculis. Sed fermentum quam dui. Donec eget ipsum dolor, id mollis nisi. Donec fermentum vehicula porta.
</p>
<hr style="width: 100%; height: 1px">
<p>
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
</p>
<hr style="width: 100%; height: 1px">
<p>
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
</p> 
</div>
<? if ($hideform=='0'){ ?>
    <div class="field-group">
        <label><?=$arrTeks['kontak_nama']?>* :</label>
        <input class="inputpesan" type="text" name="vNama" value="<?=$vNama?>"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_email']?>* :</label>
        <input class="inputpesan" type="text" name="vEmail" value="<?=$vEmail?>"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_pesan']?>* :</label>
        <textarea name="vPesan" rows="8" class="inputpesan"><?=$vPesan?></textarea>
    </div>
    <div class="field-group">
    <label>&nbsp;</label>
       <div id="capcay">
       <img id="image" src="<?=app_base_url?>plugins/captcha/capcay.php?sid=<?=md5(uniqid(time()))?>" class="capcaycontact">
       <a href="#" onClick="refreshcapcay()"><img src="<?=app_base_url?>plugins/captcha/refresh.png" border="0" alt="refresh image" title="refresh image" class="refreshcapcay"/></a>  
        </div>     
    </div>
    
     <div class="field-group">
    <label>Verification* :</label>
		<input type="text" name="code" id="code" size="12" title="Secure Code" class="secure" maxlength="5"/>
	</div>

    <div class="field-group" align="center">
        <input type="hidden" name="hKode" value="<?=$hKode?>"/>
        <input class="tombol" type="Submit" name="submit" id="submit" value="<?=$arrTeks['kontak_kirim']?>"/>
    </div>
  <? }?>  
</fieldset>
</div>

</form>
<?php } ?>
    	  </div><!-- End Berita Kiri-->
           
         	<div class="detailberita2">	 
         <? include "beritalainya.php";?>   
            </div>
        </div><!--End index berita-->
        
      
	</div>
   
</div>
</article></div>
                    </div>
                </div>
            </div>
    </div>

<footer class="cni-footer clearfix">
<!--Foto dan video content mulai di sini-->
   <div class="bedawarnadetail">
    <div class="isibeda">
                <? include "agendasocial.php";?>
       </div> 
   </div>   
<!--Foto dan video content berakhir di sini-->   
<div class="detailfoot">
<? include "footerdetail.php"; ?>
</div>