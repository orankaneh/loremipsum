<div id="element_to_pop_up">

</div>
<header class="cni-header clearfix">


    <div class="cni-shapes">

<div class="cni-object1467606720" data-left="1.57%">
<img src="<?=$addLink?>images/object1467606720.png">
</div>

            </div>
            <div class="flag">
            <img src="<?=$addLink?>images/icon/indo.jpg" />
            <img src="<?=$addLink?>images/icon/en.jpg" />
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
    <li><a href="<?=$addLink?>" class="home active"><?=$arrTeks['home']?></a></li>    
    <li><a href="#" class="fasilitas"><?=$arrTeks['facilities']?></a>
    	<ul>
        <? foreach($fasilitas as $itemfasilitas){
			$fasilitascrypt=saveid($itemfasilitas['id']);	
		?>
        	<li><a href="<?=app_base_url?>facilities/<?=$_SESSION['bahasa']?>/<?=$fasilitascrypt?>/detail/<?=cleanurllho($itemfasilitas[nama.$temp])?>.html"><?=$itemfasilitas[nama.$temp]?></a></li>
         <? } ?>   
        </ul>
    </li>
      <li><a href="<?=$addLink?>" class="berita">NEWS AND EVENTS</a>
          <ul>
        	<li><a href="fasilitas/loremimsum.html">NEWS</a></li>
            <li><a href="fasilitas/aaaa.html">EVENTS</a></li>
            <li><a href="fasilitas/loremimsum.html">PROMOS</a></li>
            <li><a href="fasilitas/aaaa.html">TICKET</a></li>
        </ul>
        </li>
      <li><a href="<?=$addLink?>">ARTICLE</a>
    <ul>
        	<li><a href="fasilitas/loremimsum.html">NEWS</a></li>
            <li><a href="fasilitas/aaaa.html">EVENTS</a></li>
            <li><a href="fasilitas/loremimsum.html">PROMOS</a></li>
            <li><a href="fasilitas/aaaa.html">TICKET</a></li>
        </ul>
    </li>
     <li><a href="#">GALLERY</a>
    	<ul>
        	<li><a href="fasilitas/loremimsum.html">PHOTO</a></li>
            <li><a href="fasilitas/aaaa.html">VIDEO</a></li>
        </ul>
    </li>
     <li><a href="<?=$addLink?>form/contact-us.html" class="contact">Contact Us</a></li>
     <li><a href="<?=$addLink?>form/contact-us.html">Reservation</a></li>
    </ul> 
     </div>
</nav>