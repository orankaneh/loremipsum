<?
//$othernews=othernews_muat_data();
$max=maxidnews_muat_data();
$maxid=$max[0][0];
$idtampil=$maxid-1;
$othernews=othernews_muat_data($maxid,$idtampil);
//show_array($othernews);
?>
 <div class="beritakananlho">
       				<div class="isikananlho">
      					<?=$arrTeks['berita_lainya']?>
     				</div>
                    <? foreach($othernews as $limitdikit){
					$sessioncryptx=saveid($limitdikit['id']);	
					?>                
                     <div class="othernews">
                     <?	if (file_exists("images/berita/thumb/" . $limitdikit['id'] . ".jpg")){?>
                       <img src="<?=app_base_url?>images/berita/thumb/<?=$limitdikit['id']?>.jpg">
                     <? }
					 else{
					 ?>  
                       <img src="<?=app_base_url?>images/berita/thumb/default.jpg">
                       <?
					   }
					   ?>
                    <div>
                     <h1><a href="<?=app_base_url?>news/<?=$_SESSION['bahasa']?>/<?=$sessioncryptx?>/read/<?=cleanurllho($news[$judulnews])?>.html"><?=$limitdikit[$judulnews]?></a></h1>
                      <?				  
					    if($_SESSION['bahasa'] == 'id'){
						echo datetimeid($limitdikit['tgl_buat']);
						echo readmore(html_entity_decode($limitdikit['isi']),'100' ,'news/'.$_SESSION['bahasa'].'/'.$sessioncryptx.'/read/'.cleanurllho($limitdikit[$judulnews]).'.html',$arrTeks['selengkap']);
				  }
					else{
						echo datetime($limitdikit['tgl_buat']);
						echo readmore(html_entity_decode($limitdikit['isi_e']),'100','news/'.$_SESSION['bahasa'].'/'.$sessioncryptx.'/read/'.cleanurllho($limitdikit[$judulnews]).'.html',$arrTeks['selengkap']);	  
				  }
					  ?>
                 
                    </div>
                    </div><!--en isi kanan-->
                    <? }?>
<div class="garisbawahpow">
&nbsp;
</div>                 
                       <div class="buttonselengkapothernews">
                    SELENGKAPNYA
                    </div>
      		</div>
          