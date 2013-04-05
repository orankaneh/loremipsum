<? include "head.php"; ?>
<body>
<div id="cni-main">
<? include "header.php";
$indexnews=download_file_data();
$bannerkananlainay=bannerkananmuatdata('4');
//show_array($indexnews);
?>
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
      <div class="beritainindex">
	<div class="detailberita">	
         <div class="beritakiri">
       		<div class="isikiri">
      		DOWNLOAD INDEX
      		 </div>
        <div class="indexberita">
                      <? foreach($indexnews as $number => $file){
					?>
                    <div class="filedownload">
                      <a href="<?=app_base_url."images/file/".$file['id'].".".$file['ekstensi']?>"> <?=++$number.". <img src='".app_base_url."images/icon/".$file['ekstensi'].".png'>".$file['nama'].".".$file['ekstensi']?></a>
                     </div>
                     <div class="othernews">
                                        <div class="newstext">
                     
                    </div>
                    </div>
                    <? }?>
                   
        </div><!--aaaa-->
		</div>
    	  </div><!-- End Berita Kiri-->
           
         	
            <div class="bannerdetailconten">
   <img src="<?=app_base_url?>images/downloadbutton.png" />
     <? foreach($bannerkananlainay as $iklanx){
				   //show_array($iklanx);
				   ?>
       		<a href="<?=$iklanx['url']?>"><img src="<?=app_base_url?>images/banner/<?=$iklanx[0]?>.jpg"></a>
            <? }?>
        </div>
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
   <div class="bedawarnadetail">
    <div class="isibeda">
                <? include "agendasocial.php";?>
       </div> 
   </div>   
<!--Foto dan video content berakhir di sini-->   
<div class="detailfoot">
<? include "footerdetail.php"; ?>
</div>