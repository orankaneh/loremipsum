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
	$vEmail = trim(htmlspecialchars($_POST['vEmail'], ENT_QUOTES));
	$vPesan = trim(htmlspecialchars($_POST['vPesan'], ENT_QUOTES));
	$code = $_POST['code'];
	
	if (empty($vNama)) $strError .= "<li>".$arrTeks[kontak_erorr_nama]."</li>";
//	if (empty($vAlamat)) $strError .= "<li>".$StrErrAlamat."</li>";
   // if (empty($vMobile)) $strError .= "<li>".$arrTeks[kontak_erorr_mobile]."</li>";
	if (empty($vEmail)) $strError .= "<li>".$arrTeks[kontak_erorr_email]."</li>";
	if (cekEmail($vEmail)!=1) $strError .= "<li>".$arrTeks[kontak_erorr_format]."</li>";
	if (empty($vPesan)) $strError .= "<li>".$arrTeks[kontak_erorr_pesan]."</li>";
//	if (empty($code)) $strError .= "<li>".$arrTeks[kontak_erorr_kode]."</li>";
	$simg = new Securimage();
	$valid = $simg->check($code);
	if (!$valid && !empty($code)) $strError .= "<li>".$arrTeks[kontak_erorr_code_isi]."</li>";
	//$include_email_tujuan='rizaldy@citra.web.id';
	//$include_email_tujuan='info@aryukahotel.com';
	if (empty($strError)) {
	$today=date("Y-m-d H:i:s");
	_insert("insert into ".tabel_tamu." VALUES ('','0','pengunjung','$vNama','$vEmail','','','$vPesan','0','$today','".getenv("REMOTE_ADDR")."')");
	//kirimEmail("", false, "", client, $include_email_tujuan, $vNama, $include_subyek, $include_pesan);		
		
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
   		 	window.location = "<?=app_base_url?>/form/guest-book.html";
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
$bukutamu=buku_tamu_muat_data();
?>
</div>
<div class="isibuku">

<?  foreach ($bukutamu as $datague){?>
<div class="bubble">
<h6><?=$datague['nama']?>:</h6>
 <p><?=$datague['isi']?></p>
</div>
<?
$quickcount="0";
$respone=respon_admin($datague['id']);
$quickcount=count($respone);
if($quickcount!="0"){
foreach($respone as $tanggapan){
?>
<div class="bubbleadmin">
<h6><?=$tanggapan['nama']?>:</h6>
<p><?=$tanggapan['isi']?></p>
</div>
<?
	}
  } 
} ?>
</div>
<? if ($hideform=='0'){ ?>
    <div class="field-group">
        <label><?=$arrTeks['kontak_nama']?>* </label>
        :&nbsp;<input class="inputpesan" type="text" name="vNama" value="<?=$vNama?>"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_email']?>* </label>
        :&nbsp;<input class="inputpesan" type="text" name="vEmail" value="<?=$vEmail?>"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_pesan']?>* </label>
        :&nbsp;<textarea name="vPesan" rows="8" class="inputpesan"><?=$vPesan?></textarea>
    </div>
    <div class="field-group">
    <label>&nbsp;</label>
       <div id="capcay">
       <img id="image" src="<?=app_base_url?>plugins/captcha/capcay.php?sid=<?=md5(uniqid(time()))?>" class="capcaycontact">
       <a href="#" onClick="refreshcapcay('<?=app_base_url?>')"><img src="<?=app_base_url?>plugins/captcha/refresh.png" border="0" alt="refresh image" title="refresh image" class="refreshcapcay"/></a>  
        </div>     
    </div>
    
     <div class="field-group">
    <label>Verification* </label>
		:&nbsp;<input type="text" name="code" id="code" size="12" title="Secure Code" class="secure" maxlength="5"/>
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