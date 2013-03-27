<? include "head.php"; 
$video=video_muat_data(NULL,NULL,'1');
?>
<body id="page">
<div id="cni-main">
<? include "header.php";
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
   					 <li><a href="<?=$data['ket']?>"><img src="images/header/<?=$data['id']?>.jpg"></a></li>
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
        <img class="banneratas" width="<?=widhtnya_fasilitas?>" height="<?=height_fasilitas?>" src="images/banner/<?=$iklana['id']?>.jpg">
        <? }?>
        </p>
        <p><br/></p>
    </div>
    </div>
      <div class="beritainindex">
		
         <div class="beritakiri">
       		<div class="isikiri">
      			BERITA TERBARU
      		 </div>
                <? foreach ($newnews as $news){ 
				$sessioncrypt=saveid($news['id']);	
				?>
             <div class="newnews">
             <img src="images/berita/<?=$news['id']?>.jpg">
             <h1><a href="news/<?=$_SESSION['bahasa']?>/<?=$sessioncrypt?>/read/<?=cleanurllho($news[$judulnews])?>.html"><?=$news[$judulnews]?></a></h1>
        	<?
         		  if($_SESSION['bahasa'] == 'id'){
						echo readmore(html_entity_decode($news['isi']),'170' ,'news/'.$_SESSION['bahasa'].'/'.$sessioncrypt.'/read/'.cleanurllho($news[$judulnews]).'.html');
				  }
					else{
						echo readmore(html_entity_decode($news['isi_e']),'170','news/'.$_SESSION['bahasa'].'/'.$sessioncrypt.'/read/'.cleanurllho($news[$judulnews]).'.html');	  
				  }
			 ?>
             </div>
             <? }?>
    	  </div><!-- End Berita Kiri-->
           
          
         <? include "beritalainya.php";?>   
         <? include "agendasocial.php";?>
            
            
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
   <div class="bedawarna">
    <div class="isibeda">
   		<div class="videolho">
       				<div class="headvideo">
      					VIDEO     				</div>
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
      					FOTO     				
                    </div>
                    <div class="galleryinfooter">
                    <? foreach ($gallery as $colection) {?>
                  <a href="images/foto/<?=$colection['id']?>.jpg" class="fancybox-buttons" rel="gallery">  <img src="images/foto/thumb/<?=$colection['id']?>.jpg"> </a>
                    
                     <div id="description" style="display: none;">
					 <div>
                     <div class="inner">
					 <?=$colection['isi']?>
                     <div class="commentbox">
                     <li>adhy:Isi Komen 1</li>
                     <li>admin:Isi Komen 2</li>
                     </div>
                     <div><textarea></textarea></div>
                     </div></div>
					</div>
                    <? }?>
                    </div>
                    
                    <div class="buttonselengkapfoto">
                    SELENGKAPNYA                    </div>
        </div>
      <div class="bannerdepan">
  <img src="images/img_03.jpg">
  <img src="images/banner/<?=$bannerkanan['0']['id']?>.jpg">        </div>
     </div> 
   </div>   
<!--Foto dan video content berakhir di sini-->   
<? include "footer.php"; ?>