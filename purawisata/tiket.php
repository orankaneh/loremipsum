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
$fasilitasnya=menu_fasilitas_muat_data();
$bannerkananlainay=bannerkananmuatdata('4');
//show_array($tiketbox);
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
      		<?=$arrTeks['tiket']?>
      		 </div>
        <div class="indexberita">
               <? foreach($fasilitasnya as $datafasilitas){
			   			$sessioncryptx3=saveid($datafasilitas['id']);	
			   			$tiketbox=tiket_package_muat_data($datafasilitas['id']);
			   ?>   
                   	<fieldset>
                    <legend><a href="<?=app_base_url?>facilities/<?=$_SESSION['bahasa']?>/<?=$sessioncryptx3?>/detail/<?=cleanurllho($datafasilitas[nama.$temp])?>.html"><?=$datafasilitas[$judulnews]?></a></legend>   
                    <h6>Package:</h6>                
                   <table class="tabelharga" cellpadding="0" cellspacing="0" border="0">
                   <tr>
                   <th>No</th>
                   <th>Package</th>
                   <th>Ticket</th>
                   <th>Deskripsi</th>
                   </tr>
                   <? 
				   if(count($tiketbox)=="0"){
				   echo "<tr><td colspan='4' class='center'>Data not found</td></tr>";
				   }
				   else{
				   foreach($tiketbox as $angka => $detailtiket){?>
                   <tr>
                   <td class="center"><?=++$angka?></td>
                   <td class="center"><?=$detailtiket['nama']?></td>
                   <td ><?=$arrTeks['simbolmata']." ".$detailtiket[$matauang]?></td>
                   <td><?=$detailtiket['deskripsi'.$temp2]?></td>
                   </tr>   
                   <? } 
				   }
				   ?>
                   </table>      
                    </fieldset>
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