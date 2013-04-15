<?        
        $sqlp= _select_unique_result("select account from ".tabel_paypal." where id='1'");
		//$paypal_url="https://www.paypal.com/cgi-bin/webscr"; // Test Paypal API URL
		$paypal_id=$sqlp['account'];
?>

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="form7">
        <input type="hidden" name="business" value="<?=$paypal_id?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" value="Invoice <?=$booking?>">
        <input type="hidden" name="amount" value="<?=$_POST['totaldolar']?>">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="cancel_return" value="http://yoursite.com/cancel.php">
        <input type="hidden" name="return" value="http://yoursite.com/success.php">
        <input type="hidden" name="address_override" value="Jl. Brigjen Katamso 55152 - INDONESIA">
        <input type="hidden" name="invoice" value="ABCD11212">
        
        <input type="hidden" name="image_url" value="http://purawisatajogjakarta.com/images/logo/logo_login.png">
        
        <input type="image" src="http://www.pedsbasin.com/images/titles/btn_paynow_SM.gif" name="submit">
        </form> 
        
   