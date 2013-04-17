<?php

include 'securimage.php';

$img = new securimage();

//$img->ttf_file = "./gdfonts/LetterGothicStd.otf";
//$img->image_bg_color = "";
$img->use_gd_font = true;
$img->gd_font_file = "./gdfonts/gothic.gdf";
$img->image_width = 130;
$img->font_size = 30;
$img->text_color = "#FFFFFF";
$img->draw_lines = false;
$img->arc_linethrough = false;
$img->arc_line_colors = "#386FCF";
$img->use_multi_text = true;
// $img->charset = "ABCDEFGHKLMNPRSTUWY23456789";
$img->charset = "ABCABCDEFGHJKMNPQRSTUVWXYZ23456789DEFGHJKMNPQRSTUVWXYZ23456789";

//$img->show(); // alternate use:  $img->show('/path/to/background.jpg');
$img->show('captcha2.jpg');

?>
