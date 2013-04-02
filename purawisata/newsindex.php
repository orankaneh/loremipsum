<? include "head.php"; ?>
<body>
<script>
$(document).ready(function(){
$(".berita").addClass("active");
$(".home").removeClass("active");
$(".desktop-nav").removeClass("cni-nav");
$(".desktop-nav").addClass("cni-navwhite");
$(".cni-hmenu").addClass("spasi");
$(".triangle").removeClass("triangle");
$(".berita").append("<div class='triangle'></div>");
  });
</script>
<div id="cni-main">
<? include "header.php";
$max=maxidnews_muat_data();
$maxid=$max[0][0];
$idtampil=$maxid-1;
$indexnews=indexnews_muat_data(bukaid($id));
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
      		<?=$arrTeks['indexberita']?>
      		 </div>
        <div class="indexberita">
                      <? foreach($indexnews['list'] as $limitdikit){
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
                    <div class="newstext">
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
                    </div>
                    <? }?>
                   
        </div><!--aaaa-->
			 <?=$indexnews['paging']?>
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