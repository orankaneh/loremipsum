<?
error_reporting(0);
ob_start();
session_start();?>

<div id="element_to_pop_up">

</div>
<header class="cni-header clearfix">


    <div class="cni-shapes">

<div class="cni-object1467606720" data-left="1.57%">
<img src="<?=app_base_url?>images/object1467606720.png">
</div>

            </div>
            <div class="flag">
            <?
			$urlid=gantibahasa($_SERVER['REQUEST_URI'],'id',$_SESSION['bahasa']);
			$urlen=gantibahasa($_SERVER['REQUEST_URI'],'en',$_SESSION['bahasa']);

		
			?>
           <a href="http://<?=$serverhost.$urlid?>"> <img src="<?=app_base_url?>images/icon/indo.jpg" /></a>
           <a href="http://<?=$serverhost.$urlen?>"> <img src="<?=app_base_url?>images/icon/en.jpg" /></a>
            </div>
<div class="cni-object227400126">
    <form class="cni-search" name="Search" action="javascript:void(0)">
    <input type="text" value="">
    <input type="submit" value="Search" name="search" class="cni-search-button">
</form>
</div>
                        
                    
</header>
<?
$fasilitas=menu_fasilitas_muat_data();
?>
<nav class="cni-nav clearfix">
    <div class="cni-nav-inner">
    <ul class="cni-hmenu">
    <li><a href="<?=app_base_url."home/".$_SESSION['bahasa']?>.html" class="home active"><?=$arrTeks['home']?></a></li>    
    <li><a href="#" class="fasilitas"><?=$arrTeks['facilities']?></a>
    	<ul>
        <? foreach($fasilitas as $itemfasilitas){
			$fasilitascrypt=saveid($itemfasilitas['id']);	
		?>
        	<li><a href="<?=app_base_url?>facilities/<?=$_SESSION['bahasa']?>/<?=$fasilitascrypt?>/detail/<?=cleanurllho($itemfasilitas[nama.$temp])?>.html"><?=$itemfasilitas[nama.$temp]?></a></li>
         <? } ?>   
        </ul>
    </li>
      <li><a href="#" class="berita">NEWS AND EVENTS</a>
          <ul>
        	<li><a href="<?=app_base_url."news/".$_SESSION['bahasa']."/list.html"?>">NEWS</a></li>
            <li><a href="<?=app_base_url."events/".$_SESSION['bahasa']."/list.html"?>">EVENTS</a></li>
            <li><a href="<?=app_base_url."promos/".$_SESSION['bahasa']."/list.html"?>">PROMOS</a></li>
            <li><a href="<?=app_base_url."list/".$_SESSION['bahasa']."/price.html"?>">TICKET</a></li>
        </ul>
        </li>
      <li><a href="<?=app_base_url?>">ARTICLE</a>
    <ul>
        	<li><a href="fasilitas/loremimsum.html">NEWS</a></li>
            <li><a href="fasilitas/aaaa.html">EVENTS</a></li>
            <li><a href="fasilitas/loremimsum.html">PROMOS</a></li>
            <li><a href="fasilitas/aaaa.html">TICKET</a></li>
        </ul>
    </li>
     <li><a href="#" class="gallery">GALLERY</a>
    	<ul>
        	<li><a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl('all')?>/gallery/foto.html">PHOTO</a></li>
            <li><a href="<?=app_base_url.$_SESSION['bahasa']."/".saveurl('all')?>/gallery/video.html">VIDEO</a></li>
        </ul>
    </li>
     <li><a href="<?=app_base_url?>form/contact-us.html" class="contact">Contact Us</a></li>
     <li><a href="<?=app_base_url?>form/contact-us.html">Reservation</a></li>
    </ul> 
     </div>
</nav>