<? include "head.php"; 
$video=video_muat_data(NULL,NULL,'1');
?>
<body id="page">
<div id="cni-main">
<? include "header.php";
if (!preg_match("/home/i", $_SERVER['REQUEST_URI'])) {
   header("location:".app_base_url."home/".$_SESSION['bahasa'].".html");
}
//header("location:".app_base_url."home/".$_SESSION['bahasa'].".html");
$slidegambar=slideshow_muat_data();
$newnews=newnews_muat_data();
$banneratas=banneratasmuatdata();
$bannerkanan=bannerkananmuatdata('1');
$gallery=galleryfotomuatdata('4');
//show_array($newnews);

 ?>
        <div class="slidercontainer">
          <div class="flexslider">
              <ul class="slides">
              <? foreach ($slidegambar as $data){ ?>
   					 <li><a href="<?=$data['ket']?>"><img src="<?=app_base_url?>images/header/<?=$data['id']?>.jpg"></a></li>
				<? } ?>
 			 </ul>
		</div><!--end slider container here -->
         
        <div class="hanoman">		</div>
        </div>
<div class="cni-sheet clearfix">
            <div class="cni-layout-wrapper clearfix">
                <div class="cni-content-layout">
                    <div class="cni-content-layout-row">
                        <div class="cni-layout-cell cni-content clearfix"><article class="cni-post cni-article">
                                
                                                
                <div class="cni-postcontent cni-postcontent-0 clearfix"><div class="cni-content-layout">
    <div class="cni-content-layout-row">
    <div class="cni-layout-cell layout-item-0" style="width: 100%" >
        <p class="bannerattasp">
          <? foreach ($banneratas as $iklana){ ?>
        <a href="<?=$iklana['url']?>"><img class="banneratas" width="<?=widhtnya_fasilitas?>" height="<?=height_fasilitas?>" src="<?=app_base_url?>images/banner/<?=$iklana['id']?>.jpg"></a>
        <? }?>
        </p>
        <p><br/></p>
    </div>
    </div>
      <div class="beritainindex">
		
         <div class="detailberita">
         <div class="beritakiri">
       		<div class="isikiri">
      			<?=$arrTeks['berita_terbaru']?>
      		 </div>
                <? foreach ($newnews as $news){ 
				$sessioncrypt=saveid($news['id']);	
				?>
             <div class="newnews">
             <img src="<?=app_base_url?>images/berita/<?=$news['id']?>.jpg">
             <h1><a href="<?=app_base_url?>news/<?=$_SESSION['bahasa']?>/<?=$sessioncrypt?>/read/<?=cleanurllho($news[$judulnews])?>.html"><?=$news[$judulnews]?></a></h1>
        	<?
         		  if($_SESSION['bahasa'] == 'id'){
						echo readmore(html_entity_decode($news['isi']),'255' ,app_base_url.'news/'.$_SESSION['bahasa'].'/'.$sessioncrypt.'/read/'.cleanurllho($news[$judulnews]).'.html',$arrTeks['selengkap']);
				  }
					else{
						echo readmore(html_entity_decode($news['isi_e']),'260',app_base_url.'news/'.$_SESSION['bahasa'].'/'.$sessioncrypt.'/read/'.cleanurllho($news[$judulnews]).'.html',$arrTeks['selengkap']);	  
				  }
			 ?>
             </div>
             <? }?>
             </div>   
    	  </div><!-- End Berita Kiri-->
           
          <div class="detailberita2">	 
         <? include "othernews.php";?>   
         </div>
     
            
            
        </div><!--End index berita-->
        
      
	</div>
</div>
 <? include "agendasocial.php";?>
</article></div>
                    </div>
                </div>
            </div>
    </div>

<footer class="cni-footer clearfix">
<!--Foto dan video content mulai di sini-->
   <div class="bedawarna">
    <div class="isibeda">
   		<div class="videolho">
       				<div class="headvideo">
      					<div class="textphoto">VIDEO <img src="<?=app_base_url?>images/pideokk.jpg"></div>
                      </div>
                        <script>
						$(document).ready(function() {
    $("iframe").each(function(){
        var ifr_source = $(this).attr('src');
        var wmode = "wmode=transparent";
        if(ifr_source.indexOf('?') != -1) {
            var getQString = ifr_source.split('?');
            var oldString = getQString[1];
            var newString = getQString[0];
            $(this).attr('src',newString+'?'+wmode+'&'+oldString);
        }
        else $(this).attr('src',ifr_source+'?'+wmode);
    });
});
						</script>
                    <iframe width="300" height="220" src="http://www.youtube.com/embed/<?=$video[0]['id_youtube']?>" frameborder="0" allowfullscreen></iframe>
                     <div class="buttonselengkapv">
                    SELENGKAPNYA                    </div>
        </div>
<div class="fotolho">
       				<div class="headfoto">
      					<div class="textphoto"><?=$arrTeks['fotoe']?><img src="<?=app_base_url?>images/fotoico.jpg"> </div>   				
                    </div>
                    <div class="galleryinfooter">
                    <? foreach ($gallery as $colection) {?>
                  <a href="<?=app_base_url?>images/foto/<?=$colection['id']?>.jpg" class="fancybox-buttons" rel="gallery">  <img src="<?=app_base_url?>images/foto/thumb/<?=$colection['id']?>.jpg"> </a>
                    
                     <div id="description" style="display: none;">
						 <div>
                    		 <div class="inner">
					 			<div class="fotointro">
								 <?=$colection['isi']?>
                    			</div>
                                <div class="commentbox">
                                <li><b>adhy:</b>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which</li>
                                <li>admin:Mantab gan</li></li>
                                </div>
                                <div class="textareacom">
                                     <label>Name:</label>
                                     <input type="text">
                                     <label>Comment:</label>
                                    <textarea rows="5"></textarea>
                                     <input type="button" value="submit">
                             </div>
                     	</div>
                    	 </div>
					</div>
                    <? }?>
                    </div>
                    
                    <div class="buttonselengkapfoto">
                    SELENGKAPNYA                    </div>
        </div>
      <div class="bannerdepan">
        <a href="<?=app_base_url."list/".$_SESSION['bahasa']."/download.html"?>"> <img src="<?=app_base_url?>images/downloadbutton.png" /></a>
  <a href="<?=$bannerkanan['0']['url']?>">
  <img src="<?=app_base_url?>images/banner/<?=$bannerkanan['0']['id']?>.jpg">
   </a>
   </div>
     </div> 
   </div>   
<!--Foto dan video content berakhir di sini-->   
<? include "footer.php"; ?>