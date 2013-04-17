<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
include_once("inc/array.php");
session_start();
ob_start();
$sqlrekber= _select_arr("select * from ".bank_account);
?>
<img src="<?=app_base_url?>images/logo/logo_login.png" /><br/>
<b>Bank Account Purawisata Jogjakarta</b><br/>
<?
foreach($sqlrekber as $numrekber => $datarekber){
	?>
    <br/>
    <div class="field-groupis" style=" font-family:'Courier New', Courier, monospace;">
        <label><b><?=$datarekber['bank']?>:</b></label><br/>
        <label><?=$datarekber['norek']?></label>
        (<?=$datarekber['nama']?>)
        
    </div>
    <? }
exit;	
	?>