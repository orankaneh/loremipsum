<? include "head.php";
$class=$access;
?>
<body>
<div id="cni-main">
<? include "header.php";
$kategorie=bukaurl($kategoriurl);
$idkategorie='';
if($kategorie!='all'){
$idkategorie=$kategorie;
}

if($jenisfile=='video'){
$gallerya=galler_video_muat_data($idkategorie,$page);
$fotokat=katagori_video_muat_data();
}
else{
$gallerya=galler_foto_muat_data($idkategorie,$page);
$fotokat=katagori_foto_muat_data();
}
//show_array($gallerya);
?>
<script>
$(document).ready(function(){
$(".<?=$class?>").addClass("active");
<? if($kategorie!='all'){?>
$(".aktiv").removeClass("aktivasi");
$(".<?=$idkategorie?>").addClass("aktivasi");
<? }?>
$(".home").removeClass("active");
$(".desktop-nav").removeClass("cni-nav");
$(".desktop-nav").addClass("cni-navwhite");
$(".cni-hmenu").addClass("spasi");
$(".triangle").removeClass("triangle");
$(".<?=$class?>").append("<div class='triangle'></div>");
  });
</script>
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

          <div class="gallerylho">
       				<div class="headgallery">
      					GALLERY
     				</div>
                  
                  
                    <div class="kategoryfoto">
                      <?  foreach($fotokat as $datakategori){?>
                      <div class="namakategory <?=$datakategori['id']?>">
                              <div class="ataskn">
                              <?
							   if($jenisfile=='video'){
							   ?>
                                <a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl($datakategori['id'])?>/gallery/video.html"><?=$datakategori['nama']?></a>
                               <?
							   }
							   else{
							  ?>
                              <a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl($datakategori['id'])?>/gallery/foto.html"><?=$datakategori['nama']?></a>
                              <? }?>
                              </div>
                              <div class="bawahkn">
                                  <?
                                  if($jenisfile=='video'){
                                       $hitung=jumlah_video_muat_data($datakategori['id']);
                                      $tampil=$hitung[0]." VIDEO";
                                  }
                                  else{
                                      $hitung=jumlah_foto_muat_data($datakategori['id']);
                                      $tampil=$hitung[0]." ".$arrTeks['fotoe'];
                                  }
                                  
                                  echo $tampil;
                                  ?>
                              </div>
                      </div>
                       <? }?>  
                    </div>
                    
                    <div class="isigallery">
                    <? foreach ($gallerya['list'] as $koleksifoto){ 
					
					
					 if($jenisfile=='video'){
					 
					 ?>
                      <iframe width="320" height="220" src="http://www.youtube.com/embed/<?=$koleksifoto['id_youtube']?>" frameborder="0" allowfullscreen></iframe>
                      
                     <?
					 }
					 else{
					?>
                     <a href="<?=app_base_url?>images/foto/<?=$koleksifoto['id']?>.jpg" class="fancybox-buttons" rel="gallery">  <img src="<?=app_base_url?>images/foto/thumb/<?=$koleksifoto['id']?>.jpg"> </a>
                     
                         <div id="description" style="display: none;">
						 <div>
                    		 <div class="inner">
                             
					 			<div class="fotointro">
								 <?=$koleksifoto['isi']?>
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
                     
                     <? } 
					 }?> 
                      
                    </div>
                 <div style="clear:both"></div>
                    <?= $gallerya['paging']?>
        </div>
   

</article>
  </div>
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