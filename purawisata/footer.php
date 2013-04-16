  <div class="cni-footer-inner">
     <div class="isifooterlho">
   		<div class="hotline">
         	<div class="hotlinenumber">
        		<h4><b>HOTLINE SERVICE</b></h4>
        		<h6>CALL CENTER</h6>
        		<b>+62 274 - 380643</b><br/>
                
               <h6> WEDDING PACKAGE</h6>
        		<b>+62 856 2969 677</b>
                <div style="margin-top:20px;">
				<?
                $scripte=script_cni('1');
                echo $scripte[0];
                ?>
                </div>
                <div style="display:none">
             <a href="http://info.flagcounter.com/sXiU"><img src="http://s03.flagcounter.com/count/sXiU/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_3/labels_0/pageviews_1/flags_0/" alt="Flag Counter" border="0"></a>
                </div>
            </div>
        </div>
        <div class="costumerservice">
         	<div class="isics">
          ONLINE SUPPORT
           		 <div class="yahoomassanger">
                 <?
                 $ym=yahoo_account();
				 foreach ($ym as $accountym){
				 ?>
            		<a href="ymsgr:sendIM?<?=$accountym['account']?>"><img src="http://opi.yahoo.com/online?u=<?=$accountym['account']?>&amp;m=g&amp;t=1" border="0"></a>
                    <? }?>
           		 </div>
                 <div class="metodepembayaran">
                 PAYMENT METHOD
                 <img src="<?=app_base_url?>images/paypall_03.jpg">
                 </div>
            </div>
           
        </div><!--End Costumer Service-->
           <div class="purawisatacontak">
        
		<b>PT. Ganesha Dwipaya Bhakti</b><br/>
		<b>Purawisata Yogyakarta</b><br/>
		Jl. Brigjen Katamso 55152 - INDONESIA<br/>
		Phone: +62-274-375705, +62-274-380643 (Hunting)<br/>
        Ext.16 (Marketing Department)<br/>
		Faximile: +62-274-417620<br/>
		Email   : info@purawisatajogja.com<br/>
        <div class="footercontak">
       <div class="hubungikami pointer">
       <a href="<?=app_base_url.$_SESSION['bahasa']?>/form/contact-us.html"><img src="<?=app_base_url?>images/purawisata_depan_b_rev_03.jpg"/><?=$arrTeks['kontaklho']?></a> &nbsp;|
       </div> 
        <div class="lokasikami pointer" onclick="loadmap()"><img src="<?=app_base_url?>images/purawisata_depan_b_rev_05.jpg"/> <?=$arrTeks['lakasilho']?></div>
       </div>
        </div>
      </div>
      
  </div>
</footer>

</div>
 <div class="bedawarna2">
  <div class="copyright">
 Copyright &copy; 2013 <?=client?>. All rights reserved. Developed by <a href="http://www.citra.web.id/">Citraweb Nusa Infomedia</a> </div>
</div>   

</body></html>