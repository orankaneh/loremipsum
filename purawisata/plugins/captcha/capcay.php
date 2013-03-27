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
$img->charset = "ciyusmiapahenelancie89wxyz12345f456ghijklmno8wxyz1234wxyz12345trwxyz12345awewxyz1e89wxyz12345f456ghijklmno8wxyz1234alanpetung31abcde89wxyz12345f456ghijklmno8wxyz123459vwxyz1234567890";

//$img->show(); // alternate use:  $img->show('/path/to/background.jpg');
$img->show('captcha2.jpg');

?>
