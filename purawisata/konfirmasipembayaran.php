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
$('#reservasitgl').hide();
$('#eventjumlah').hide();
$('#bnames').hide();
$('#tbanks').hide();
$('#fbanks').hide();
$('#baNamas').hide();
$('#baNos').hide();
$('#payacounts').hide();
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
//show_array($_POST);
	$strError = "";

	$invoice = trim(htmlspecialchars($_POST['invoice'], ENT_QUOTES));
	$tanggal = trim(htmlspecialchars($_POST['tanggal'], ENT_QUOTES));
	$jmlhbayar = trim(htmlspecialchars($_POST['jmlhbayar'], ENT_QUOTES));
	$payment = trim(htmlspecialchars($_POST['payment'], ENT_QUOTES));
	$tbank = trim(htmlspecialchars($_POST['tbank'], ENT_QUOTES));
	$fbank = trim(htmlspecialchars($_POST['fbank'], ENT_QUOTES));
	$bname = trim(htmlspecialchars($_POST['bname'], ENT_QUOTES));
	$baNama = trim(htmlspecialchars($_POST['baNama'], ENT_QUOTES));
	$baNo = trim(htmlspecialchars($_POST['baNo'], ENT_QUOTES));
	$payacount = trim(htmlspecialchars($_POST['payacount'], ENT_QUOTES));
	
	
	if (empty($invoice)) $invoice .= "<li>".$arrTeks['noinvoicea']."</li>";
	if (empty($tanggal)) $strError .= "<li>".$arrTeks[tanggal_erorr_kode]."</li>";
	if (empty($payment)) $strError .= "<li>".$arrTeks[payment_erorr_kode]."</li>";
	if (empty($jmlhbayar)) $strError .= "<li>".$arrTeks['jmlhbayar']." can't empty </li>";
	
//	if (empty($vAlamat)) $strError .= "<li>".$StrErrAlamat."</li>";
	
	if($payment=="paypal"){
	if (empty($payacount)) $strError .= "<li>Paypal Account can't empty </li>";
	}
	
	if($type=="bank"){
		if (empty($tbank)) $strError .= "<li>".$arrTeks['tobank']." can't empty </li>";
		if (empty($fbank)) $strError .= "<li>".$arrTeks['frombank']." can't empty </li>";
		if (empty($baNama)) $strError .= "<li>".$arrTeks['yourname']." can't empty </li>";
		if (empty($baNo)) $strError .= "<li>".$arrTeks['norek']." can't empty </li>";
	}
	
	$simg = new Securimage();
	$valid = $simg->check($code);
	if (!$valid && !empty($code)) $strError .= "<li>".$arrTeks[kontak_erorr_code_isi]."</li>";
	$include_email_tujuan='info@purawisatajogjakarta.com';
	//$include_email_tujuan='info@aryukahotel.com';
	if (empty($strError)) {
	    $ip=$_SERVER['REMOTE_ADDR'];	
	_insert("insert into ".tabel_pembayaran." VALUES ('',now(),'$tanggal','$payment','$jmlhbayar','$invoice','$payacount','$fbank','$tbank','$bname','$baNama','$baNo','$ip','0')");
	$id_pesan=_last_id();
	
$include_pesan = "
Anda baru menerima konfirmasi pembayaran dari pelanggan anda  \n
untuk detail konfirmasi pembayaran bisa di cek melalui menu admin \n

http://purawisatajogjakarta.com/dalam

terima kasih
";
	
	
	kirimEmail("", false, $include_email_tujuan, "info@purawisatajogjakarta.com", "noreply@purawisatajogjakarta.com", "noreply", "Konfirmasi Pembayaran baru", $include_pesan);	
		
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
<legend>&nbsp;Confirm Reservation &nbsp;</legend>

<div class="pesanerror">
<?
if(strlen($strError)>0) {
	echo $strError;
}
else {
if (isset($_POST['submit'])) {
		echo $arrTeks['terimakasihbayar'];
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
		$('#fbank').change(function(){
			if($('#fbank').val()=="0"){
				$('#bnames').show();
			}
			else{
			$('#bnames').hide();
			}
		});
	  });
	  $(function() {
		$('#payment').change(function(){
			if($('#payment').val()=="bank"){
				$('#tbanks').show();
				$('#fbanks').show();
				$('#baNamas').show();
				$('#baNos').show();
				$('#payacounts').hide();
			}
			else if($('#payment').val()=="paypal"){
			$('#tbanks').hide();
			$('#fbanks').hide();
			$('#baNamas').hide();
			$('#baNos').hide();
			$('#payacounts').show();
			}
		});
	  });
	   
	    $(function() {
		$('#invoice').blur(function(){
		var invoicevalue=$('#invoice').val();
		cek_invoice('<?=app_base_url?>',invoicevalue,'<?=$arrTeks['cekdata']?>');
			});
	  });
	   $(function() {
		$( "#tanggal" ).datepicker({ minDate: "+0D",showAnim: "fold",dateFormat: "yy-mm-dd"});
	  });

  </script>
  
	<div class="field-group">
        <label>No. Invoice* </label>
        :&nbsp;<input class="inputpesan" type="text" id="invoice" name="invoice" value="<?=$invoice?>"/>
    </div>

    <div class="field-group">
        <label><?=$arrTeks['tanggalbayar']?>* </label>
        :&nbsp;<input class="inputpesan" type="text" id="tanggal" name="tanggal" value="<?=$tanggal?>"/>
    </div>
     <div class="field-group">
        <label><?=$arrTeks['jmlhbayar']?>* </label>
        :&nbsp;<input class="inputpesan" type="text" id="jmlhbayar" name="jmlhbayar" value="<?=$jmlhbayar?>"/>
    </div>
     <div class="field-group">
    <label><?=$arrTeks['pembayaran']?>* </label>
    :&nbsp;<select name="payment" id="payment" class="eventasolole">
    <option value="">-<?=$arrTeks['pilihpem']?>-</option>
    <option value="bank">Bank Trasnfer</option>
    <option value="paypal">Paypal</option>
    </select>
    </div>
     <div class="field-group" id="tbanks">
        <label><?=$arrTeks['tobank']?>* </label>
        :&nbsp;<select name="tbank" id="tbank" class="eventasolole">
    <option value="">-Select Bank-</option>
    <?
	$sqlrek2= _select_arr("select * from ".bank_account);
	  foreach($sqlrek2 as $numrek2 => $datarek2){
	?>
    <option value="<?=$datarek2['id']?>"><?=$datarek2['bank']?></option>
	<? }?>
    </select>
    </div>
    
    <div class="field-group"  id="fbanks">
        <label><?=$arrTeks['frombank']?>* </label>
        :&nbsp;<select name="fbank" id="fbank" class="eventasolole">
    <option value="">-Select Bank-</option>
    <?
	$sqlrek= _select_arr("select * from ".bank_account);
	  foreach($sqlrek as $numrek => $datarek){
	?>
    <option value="<?=$datarek['id']?>"><?=$datarek['bank']?></option>
	<? }?>
     <option value="0">Other Banks</option>
    </select>
    </div>
    
    <div class="field-group" id="bnames">
        <label>Bank <?=$arrTeks['kontak_nama']?>* </label>
        :&nbsp;<input class="inputpesan" type="text" id="bname" name="bname"/>
    </div>
        
    <div class="field-group" id="baNamas">
    <label><?=$arrTeks['yourname']?>* </label>
    :&nbsp;<input class="inputpesan" type="text" name="baNama" id="baNama"/>
    </div>
    
    <div class="field-group" id="baNos">
    <label><?=$arrTeks['norek']?>* </label>
    :&nbsp;<input class="inputpesan" type="text" name="baNo" id="baNo"/>
    </div>
    
    <div class="field-group" id="payacounts">
    <label>Paypal Account* </label>
    :&nbsp;<input class="inputpesan" type="text" name="payacount" id="payacount"/>
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
		: &nbsp;<input type="text" name="code" id="code" size="12" title="Secure Code" class="secure" maxlength="5"/>
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