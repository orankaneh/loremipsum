<? include "head.php"; ?>
<body>
<div id="cni-main">
<script>
$(document).ready(function(){
$(".booking").addClass("active");
$(".home").removeClass("active");
$(".desktop-nav").removeClass("cni-nav");
$(".desktop-nav").addClass("cni-navwhite");
$(".cni-hmenu").addClass("spasi");
$(".booking").append("<div class='triangle'></div>");
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
<legend>&nbsp;Reservation &nbsp;</legend>
<script>
$(document).ready(function(){
    $(function() {
        $('.pesanerror').fadeOut(10000);
    })
  });
</script>
<div class="pesanerror">
<?
if(strlen($strError)>0) {
	echo $strError;
}
else {
if (isset($_POST['submit'])) {
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
<? if ($hideform=='0'){ ?>
  <script type="text/javascript">
	  $(function() {
		$('#type').change(function(){
		var type=$('#type').val();
		formtype(type,'<?=app_base_url?>');
		});
	  });
	  $(function() {
		$('#fasilitas').change(function(){
		var fasilitas=$('#fasilitas').val();
		package(fasilitas,'<?=app_base_url?>');
		});
	  });
	   $(function() {
		$( "#tanggal" ).datetimepicker({ minDate: "+2D",hourMin: 9,
	hourMax: 22,minuteGrid: 10,stepMinute: 10});
		  $( "#tanggal" ).datepicker( "option", "showAnim", "bounce" );
	  });
  </script>
	 <div class="field-group">
        <label><?=$arrTeks['type']?>* :</label>
        <select name="type" id="type" class="eventasolole">
         <option value="">-<?=$arrTeks['pilihtype']?>-</option>
        <option value="fasilitas"><?=$arrTeks['fasilitas']?></option>
        <option value="event"><?=$arrTeks['agend']?></option>
        </select>
    </div>
    <div id="ajaxdata"></div>
    <div id="ajaxdata2"></div>
    
    <div class="field-group">
        <label><?=$arrTeks['tanggalresev']?>* :</label>
        <input class="inputpesan" type="text" id="tanggal"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_nama']?>* :</label>
        <input class="inputpesan" type="text" name="vNama" value="<?=$vNama?>"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_email']?>* :</label>
        <input class="inputpesan" type="text" name="vEmail" value="<?=$vEmail?>"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_telp']?>&nbsp; :</label>
        <input class="inputpesan" type="text" name="vTelp" value="<?=$vTelp?>"/>
    </div>
    <div class="field-group">
        <label><?=$arrTeks['kontak_hp']?>* :</label>
        <input class="inputpesan" type="text" name="vMobile" value="<?=$vMobile?>"/>
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
        <input class="tombol" type="Submit" name="submit" id="submit" value="Submit"/>
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