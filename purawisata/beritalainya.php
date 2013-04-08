<?
//$othernews=othernews_muat_data();
$max=maxidnews_muat_data();
$maxid=$max[0][0];
$idtampil=$maxid-1;
$othernews=othernews_muat_data(bukaid($id));
$bannerkananlainay=bannerkananmuatdata('4');
?>

 <div class="beritakananlho">
       				<div class="isikananlho">
      					<?=$arrTeks['berita_lainya']?>
     				</div>
                       <? foreach($othernews as $limitdikit){
					$sessioncryptx2=saveid($limitdikit['id']);	
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
                     <h1><a href="<?=app_base_url.'news/'.$_SESSION['bahasa'].'/'.$sessioncryptx2.'/read/'.cleanurllho($limitdikit[$judulnews]).'.html'?>"><?=$limitdikit[$judulnews]?></a></h1>
                      <?				  
					    if($_SESSION['bahasa'] == 'id'){
						echo datetimeid($limitdikit['tgl_buat']);
						echo readmore(html_entity_decode($limitdikit['isi']),'100' ,app_base_url.'news/'.$_SESSION['bahasa'].'/'.$sessioncryptx2.'/read/'.cleanurllho($limitdikit[$judulnews]).'.html',$arrTeks['selengkap']);
				  }
					else{
						echo datetime($limitdikit['tgl_buat']);
						echo readmore(html_entity_decode($limitdikit['isi_e']),'100',app_base_url.'news/'.$_SESSION['bahasa'].'/'.$sessioncryptx2.'/read/'.cleanurllho($limitdikit[$judulnews]).'.html',$arrTeks['selengkap']);	  
				  }
					  ?>
                    </div>
                    </div><!--en isi kanan-->
                    <? }?>
                    <div class="garisbawahpow">
&nbsp;
</div> 
                       <div class="buttonselengkapothernews">
                   <a href="<?=app_base_url?>news/<?=$_SESSION['bahasa']?>/list.html"> SELENGKAPNYA</a>
                    </div>
                   <div class="bannerdetaildepan">
                  <a href="<?=app_base_url."list/".$_SESSION['bahasa']."/download.html"?>"> <img src="<?=app_base_url?>images/downloadbutton.png" /></a>
                   <? foreach($bannerkananlainay as $iklanx){
				   //show_array($iklanx);
				   ?>
       		<a href="<?=$iklanx['url']?>"><img src="<?=app_base_url?>images/banner/<?=$iklanx[0]?>.jpg"></a>
            <? }?>
        </div> 
      		</div>
            