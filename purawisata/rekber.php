<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
include_once("inc/array.php");
session_start();
ob_start();
$sqlrekber= _select_arr("select * from ".bank_account);
foreach($sqlrekber as $numrekber => $datarekber){
	?>
    <div class="field-groupis">
        <label><?=$datarekber['bank']?></label>
        <label>:<?=$datarekber['norek']?></label>
        (<?=$datarekber['nama']?>)
        
    </div>
    <? }
exit;	
	?>