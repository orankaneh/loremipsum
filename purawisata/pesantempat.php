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
$('.paypai').hide();
$('.antarbank').hide();
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

	$vNama = trim(htmlspecialchars($_POST['vNama'], ENT_QUOTES));
	$vAlamat = trim(htmlspecialchars($_POST['vAlamat'], ENT_QUOTES));
	$vEmail = trim(htmlspecialchars($_POST['vEmail'], ENT_QUOTES));
	$vPesan = trim(htmlspecialchars($_POST['vPesan'], ENT_QUOTES));
	$vMobile = trim(htmlspecialchars($_POST['vMobile'], ENT_QUOTES));
	$vTelp = trim(htmlspecialchars($_POST['vTelp'], ENT_QUOTES));
	$type = trim(htmlspecialchars($_POST['type'], ENT_QUOTES));
	$payment = trim(htmlspecialchars($_POST['payment'], ENT_QUOTES));
	
	$code = $_POST['code'];
	$booking = $_POST['kodebooking'];
	
	if (empty($vNama)) $strError .= "<li>".$arrTeks[kontak_erorr_nama]."</li>";
//	if (empty($vAlamat)) $strError .= "<li>".$StrErrAlamat."</li>";
    if (empty($vMobile)) $strError .= "<li>".$arrTeks[kontak_erorr_mobile]."</li>";
	if (empty($vEmail)) $strError .= "<li>".$arrTeks[kontak_erorr_email]."</li>";
	if (cekEmail($vEmail)!=1) $strError .= "<li>".$arrTeks[kontak_erorr_format]."</li>";
	//if (empty($vPesan)) $strError .= "<li>".$arrTeks[kontak_erorr_pesan]."</li>";
	if (empty($code)) $strError .= "<li>".$arrTeks[kontak_erorr_kode]."</li>";
	if (empty($type)) $strError .= "<li>".$arrTeks[type_erorr_kode]."</li>";
	if (empty($payment)) $strError .= "<li>".$arrTeks[payment_erorr_kode]."</li>";
	
	if($type=="fasilitas"){
	$fasilitas = trim(htmlspecialchars($_POST['fasilitas'], ENT_QUOTES));
	$tanggal = trim(htmlspecialchars($_POST['tanggal'], ENT_QUOTES));
	if (empty($tanggal)) $strError .= "<li>".$arrTeks[tanggal_erorr_kode]."</li>";
	$tikets = $_POST['tiket'];
	if (empty($fasilitas)) $strError .= "<li>Please Select Fasilitas </li>";
	$jmlhpaket=count($tikets);
	if ($jmlhpaket=="0") $strError .= "<li>Please Select Package </li>";
	$item=$fasilitas;
	}
	if($type=="event"){
	$event = trim(htmlspecialchars($_POST['event'], ENT_QUOTES));
	$jumlah = trim(htmlspecialchars($_POST['jumlahevent'], ENT_QUOTES));
	if (empty($event)) $strError .= "<li>Please Select Event </li>";
	if (empty($jumlah)) $strError .= "<li>Quantity is empty </li>";
	$item=$event;
	}
	$simg = new Securimage();
	$valid = $simg->check($code);
	if (!$valid && !empty($code)) $strError .= "<li>".$arrTeks[kontak_erorr_code_isi]."</li>";
	$include_email_tujuan='rizaldy@citra.web.id';
	//$include_email_tujuan='info@aryukahotel.com';
	if (empty($strError)) {
	    $ip=$_SERVER['REMOTE_ADDR'];	
		$include_email_dari=$vNama;
		$include_nama_dari=$vEmail;
		$include_subyek='New Invoice '.$booking.' @ '.client;
		

	
			
		

	_insert("insert into ".tabel_pemesanan." VALUES ('',now(),'$booking','$tanggal','$type','$item','$payment','$vNama','$vEmail','$vTelp','$vMobile','$vPesan','order','$ip')");
	$id_pesan=_last_id();
		if($type=="event"){
_insert("insert into detail_pemesanan VALUES ('','$id_pesan','$event','$jumlah')");
	}
	else{
	$totalall="0";
	//show_array($tikets);
		foreach($tikets as $datapaket){

		$totalall=$totalall+($datapaket['harga']*$datapaket['jumlah']);
		$tiketing=_insert("insert into detail_pemesanan values ('','$id_pesan','$datapaket[package]','$datapaket[jumlah]')");
		//mysql_query($tiketing,$tulis) or die(mysql_error() . "<hr>" . $tiketing);
		}
	}
$include_pesan .= "
".client." New Reservation
		
Reservation Date: " . datetimeid($tanggal) . "  \n
Nama    : " . $vNama . "  \n
Email   : " . $vEmail . " \n
Phone   : " . $vTelp . "  \n
Mobile  : " . $vMobile ." \n
Pesan   : " . $vPesan . " \n 
\n       
============================================ \n\r
IP Address	: " . getenv("REMOTE_ADDR") . " \n
Time		: " . tglIndo(time(),"l_e",$selisihJam)." \n
		
untuk detail reservation dapat dilihat pada  halaman administrator \n
		
terima kasih 
		";


$include_pesan_pengunjung= "	
Thank you for your order, please make payment and make payment confirmation to continue the booking process \n

Below is the copy of your invoice at ".client.": \n

		
		
Invoice No		: " . $booking ." \n
Reservation Date: " . datetime($tanggal) . "  \n
Total   : $" .$_POST['totaldolar']." \n
Name    : " . $vNama . "  \n  
Phone   : " . $vTelp . "  \n
Mobile  : " . $vMobile ." \n
Email   : " . $vEmail . " \n
Message : " . $vPesan . " \n
Payment Status  : Unpaid \n  
\n
       


PT. Ganesha Dwipaya Bhakti
Purawisata Yogyakarta
Jl. Brigjen Katamso 55152 - INDONESIA
Phone: +62-274-375705, +62-274-380643 (Hunting)
Ext.16 (Marketing Department)
Faximile: +62-274-417620
info@purawisatajogjakarta.com \n   
		
		
----------------------------------------------------------------------------------------------------------------------- \n\r
		
		
Terima kasih atas pesanan Anda, silahkan melakukan pembayaran dan melakukan konfirmasi pembayaran untuk melanjutkan proses pemesanan
		   
Berikut adalah detail pemesanan anda di ".client.":   
		
		
		
Invoice No		: " . $booking ." \n
Reservation Date: " . datetimeid($tanggal) . "  \n  
Total   : Rp" . $_POST['totalrupiah'] ." \n
Name    : " . $vNama . "  \n  
Phone   : " . $vTelp . "  \n
Mobile  : " . $vMobile ." \n
Email   : " . $vEmail . " \n
Message : " . $vPesan . " \n
Pembayaran		: Belum Dibayar \n 
\n

	


PT. Ganesha Dwipaya Bhakti
Purawisata Yogyakarta
Jl. Brigjen Katamso 55152 - INDONESIA
Phone: +62-274-375705, +62-274-380643 (Hunting)
Ext.16 (Marketing Department)
Faximile: +62-274-417620
info@purawisatajogjakarta.com\n  

";	
kirimEmail("", false, $include_email_tujuan, "info@purawisatajogjakarta.com", $vEmail, $vNama, $include_subyek, $include_pesan);	
kirimEmail("", false, $vEmail, client, "rizaldy@citra.web.id", client, $include_subyek, $include_pesan_pengunjung);	
//kirimEmail("", false, $include_email_tujuan, client, $vEmail, $vNama, $include_subyek, $include_pesan);		
		
	}
}
?>

<?php
$isPesanOk = false;
//$ket = $catatan;

//echo "<br /><br />";
?>

<?php if (!$isPesanOk) { 
		if($payment=="paypal"){
?>
<script>
$(document).ready(function(){
 $(function() {
   setTimeout(function() {
   	$('.pesanerror').hide();
	$('.contactusform').hide();
	$('.paypai').show();
    }, 1000);
    })
});
</script>
 
<?
		echo '<div class="paypai">';
        $sqlp= _select_unique_result("select account from ".tabel_paypal." where id='1'");
		//$paypal_url="https://www.paypal.com/cgi-bin/webscr"; // Test Paypal API URL
		$paypal_id=$sqlp['account'];
?>   
	 <div class="field-group">
        <label><u>Invoice Info</u></label>
    </div>
	 <div class="field-group">
        <label>No Invoice</label>
        :&nbsp;<?=$booking?>
    </div>
	<div class="field-group">
        <label>Total (Rp)</label>
        :&nbsp;$<?=$_POST['totaldolar']?>
    </div>


        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="form7">
        <input type="hidden" name="business" value="<?=$paypal_id?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" value="Payment No Invoice <?=$booking?>">
        <input type="hidden" name="amount" value="<?=$_POST['totaldolar']?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="cancel_return" value="<?=app_base_url.$_SESSION['bahasa']?>/form/reservation.html">
        <input type="hidden" name="return" value="<?=app_base_url.$_SESSION['bahasa']?>/form/payment-confirm.html">
        <input type="hidden" name="address_override" value="Jl. Brigjen Katamso 55152 - INDONESIA">
        <input type="hidden" name="invoice" value="<?=$booking?>">
        
        <input type="hidden" name="image_url" value="http://purawisatajogjakarta.com/images/logo/logo_login.png">
        
        <input type="image" src="<?=app_base_url?>/images/paynow.jpg" name="submit" class="paypaibutton">
        
        </form> 
        <div class="bannerpaypal">
     <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_SbyPP_mc_vs_dc_ae.jpg" class="gambarpaypal">
      </div>
      </div>
      <? } 
	  else if($payment=="bank"){
	  ?>
      <script>
$(document).ready(function(){
 $(function() {
   setTimeout(function() {
   	$('.pesanerror').hide();
	$('.contactusform').hide();
	$('.antarbank').show();
    }, 1000);
    })
});
</script>
      <div class="antarbank">
      <div class="field-group">
        <label><u>Invoice Info</u></label>
    </div>
	 <div class="field-group">
        <label>No Invoice</label>
        :&nbsp;<?=$booking?>
    </div>
	<div class="field-group">
        <label>Total USD</label>
        :&nbsp;$<?=$_POST['totaldolar']?>
    </div>
    <div class="field-group">
        <label>Total IDR</label>
        :&nbsp;Rp<?=$_POST['totalrupiah']?>
    </div>
    <br/>
    <div class="field-groupgede">
        <label>  List of bank accounts:</label>
    </div>
    <?
	  $sqlrek= _select_arr("select * from ".bank_account);
	  foreach($sqlrek as $numrek => $datarek){
	?>
    <div class="field-group">
        <label><?=$datarek['bank']?></label>
        <label>:<?=$datarek['norek']?></label>
        (<?=$datarek['nama']?>)
        
    </div>
    <? }?>
    </div>
      <?
	  }?>       
<form method="post" id="form1">
<div class="contactusform">
<fieldset>
<legend>&nbsp;Online Reservation &nbsp;</legend>

<div class="pesanerror">
<?
if(strlen($strError)>0) {
	echo $strError;
}
else {
if (isset($_POST['submit'])) {
		echo $arrTeks['reservasi_pesan'];
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
	hourMax: 22,minuteGrid: 10,stepMinute: 10,showAnim: "fold",dateFormat: "yy-mm-dd",timeFormat: 'HH:mm:ss'});
	  });

  </script>
  
	 <div class="field-group">
<label><?=$arrTeks['type']?>* </label>
:&nbsp;<select name="type" id="type" class="eventasolole">
 <option value="">-<?=$arrTeks['pilihtype']?>-</option>
<option value="fasilitas"><?=$arrTeks['fasilitas']?></option>
<option value="event"><?=$arrTeks['agend']?></option>
</select>
    </div>
    <div id="ajaxdata"></div>
    <div id="ajaxdata2"></div>
    <div class="field-group" id="reservasitgl">
        <label><?=$arrTeks['tanggalresev']?>* </label>
        :&nbsp;<input class="inputpesan" type="text" id="tanggal" name="tanggal"/>
    </div>
     <div class="field-group">
        <label>Total </label>
        :&nbsp;<?=$arrTeks['simbolmata']?>
        <input class="inputpesan" type="text" id="total" name="total" value="<?=$vTotal?>" readonly/>
        <input class="inputpesan" type="hidden" id="totalrupiah" name="totalrupiah" readonly/>
        <input class="inputpesan" type="hidden" id="totaldolar" name="totaldolar" readonly/>
    </div>

     <div class="field-group">
    <label><?=$arrTeks['pembayaran']?>* </label>
    :&nbsp;<select name="payment" id="payment" class="eventasolole">
    <option value="">-<?=$arrTeks['pilihpem']?>-</option>
    <option value="bank">Bank Trasnfer</option>
    <option value="paypal">Paypal</option>
    </select>
    </div>

    <div class="field-group">
    <label><?=$arrTeks['kontak_nama']?>* </label>
    :&nbsp;<input class="inputpesan" type="text" name="vNama" value="<?=$vNama?>"/>
    </div>
    <div class="field-group">
    <label><?=$arrTeks['kontak_email']?>* </label>
    :&nbsp;<input class="inputpesan" type="text" name="vEmail" value="<?=$vEmail?>"/>
    </div>
    <div class="field-group">
    <label><?=$arrTeks['kontak_telp']?>&nbsp;</label>
    :&nbsp;<input class="inputpesan" type="text" name="vTelp" value="<?=$vTelp?>"/>
    </div>
    <div class="field-group">
    <label><?=$arrTeks['kontak_hp']?>* </label>
    :&nbsp;<input class="inputpesan" type="text" name="vMobile" value="<?=$vMobile?>"/>
    <input type="hidden" name="kodebooking" id="kodebooking" value="<?=invoice_huruf("6")?>">
    </div>
    <div class="field-group">
    <label><?=$arrTeks['kontak_pesan']?> </label>
    :&nbsp;<textarea name="vPesan" rows="4" class="inputpesan"><?=$vPesan?></textarea>
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