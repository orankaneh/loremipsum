<?
$indexevent=indexlistevent_muat_data('6');
?>
   <div class="agendalho">
       				<div class="headagenda">
      					<?=$arrTeks['agenda']?>
     				</div>
                       <ul>
						<hr/>
                         <? foreach($indexevent['list'] as $agenda){
						 $sessioncryptx7=saveid($agenda['id']);	
						 ?>
                       <li><a href="<?=app_base_url.'event/'.$_SESSION['bahasa'].'/'.$sessioncryptx7.'/read/'.cleanurllho($agenda[$judulnews]).'.html'?>"><?=$agenda[$judulnews]?></a></li>
                       <hr/>
                       <? }?>
                        <div class="buttonselengkapagenda">
                   <a href="<?=app_base_url."events/".$_SESSION['bahasa']."/list.html"?>"> SELENGKAPNYA</a>
                    </div>
                       </ul>
      		</div><!--End Agenda-->
          
          
           <div class="sociallho">
       				<div class="headsocial">
      					FOLLOW <?=$arrTeks['kami']?>
     				</div>     
                    <div class="twitter">
                     <div class="logotw"></div><div class="twittertext"><b>Twitter</b></div>
                     <hr/>
                     <script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({

  version: 2,

  type: 'profile',

  rpp: 4,

  interval: 6000,

  width: 270,

  height: 370,

  theme: {

    shell: {
 background: 'transparent',
      color: '#ffffff'

    },

    tweets: {

 background: 'transparent',
      color: '#ffffff',
      links: '#44a7d2'

    }

  },

  features: {
 scrollbar: true,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    toptweets: true,
    behavior: 'default'

  }

}).render().setUser('pura_wisata').start();

</script>
                     </div><!--End Twitter Here-->
                       <div class="facebook">
                      <div class="logofb"></div><div class="twittertext"><b>Facebook</b></div>
                     <hr/>
                 <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpurawisata&amp;width=270&amp;height=370&amp;show_faces=true&amp;colorscheme=dark&amp;stream=true&amp;border_color=0&amp;header=true&amp;appId=107896825918002" scrolling="no" frameborder="0" style="  background: #333333;border:none; overflow:hidden; width:270px; height:370px;" allowTransparency="true"></iframe>
                     </div><!--End facebook Here--> 
      		</div>