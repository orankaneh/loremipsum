<?
include_once("inc/config.php");
include_once("inc/fungsi.php");
include_once("inc/array.php");
include_once("inc/visitor.php");
session_start();
ob_start();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <?php include "inc/seo.php"; ?>


 
    <script type="text/javascript" charset="utf-8">
	  $(window).load(function() {
      	 $('.flexslider').flexslider({
      	 animation: "slide",              //String: Select your animation type, "fade" or "slide"
		 easing: "swing"  ,
		 controlNav: false,
        directionNav: true
    	});
  	 });

	$(document).ready(function() {
	$(function()
{
	$('.twtr-bd').jScrollPane();
});
	 $(".fancybox-buttons").fancybox({
        padding: 0,
		margin : [-20, 300, 100, 0],
		modal: true,
		helpers: {
		buttons: {},
		overlay: {
			opacity: 0,
			css: {'background': '#000'},
			css: {'background': 'rgba(0,0,0,0.9)'} 
			}
		},
		afterShow: function(){
			var description = "<div class='links'>"+$("#description > div").eq(this.index).html()+"</div>"
			$('#fancybox-overlay').html(description);
			$('#page').css("overflow","hidden");	
	},
	
		afterClose:function(){
		    $('#page').css("overflow","auto");	
		},
	
	nextEffect: 'fade',
 prevEffect: 'fade'
 }); // fancybox
}); // ready

</script>
<style>.cni-content .cni-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }

</style></head>