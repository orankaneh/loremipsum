<?php
function menuAdmin() {
	if (!isset($_SESSION["admSession"])) return "&nbsp;";
	$unreadtesti=count(unread_testi());
	$testi="";
	if($unreadtesti!="0"){
	$testi="(".$unreadtesti.")";
	}
	$hasil =
		'<td align="left" valign="top" width="196px">
		 <ul class="menu-hori">
				<li><a href="#" class="haschild"><b><img src="../images/icon/gray_18/abacus.png" class="iconadmin">Fasilitas</b></a>
					<ul>
						<li><a href="fasilitasUpdate.php" class="nochild"><b>Tambah Fasilitas</b></a></li>
						<li><a href="fasilitasList.php" class="nochild"><b>Daftar Fasilitas</b></a></li>
					</ul>
				</li>
				
				<li><a href="#" class="haschild"><b><img src="../images/icon/gray_18/diary.png" class="iconadmin">Berita</b></a>
					<ul>
						<li><a href="beritaUpdate.php" class="nochild"><b>Tambah Berita</b></a></li>
						<li><a href="beritaList.php" class="nochild"><b>Daftar Berita</b></a></li>
						<li><a href="beritaKategoriUpdate.php" class="nochild"><b>Tambah Kategori Berita</b></a></li>
						<li><a href="beritaKategoriList.php" class="nochild"><b>Daftar Kategori Berita</b></a></li>
					</ul>
				</li>
				<li><a href="#" class="haschild"><b><img src="../images/icon/gray_18/clipboard.png" class="iconadmin">Agenda</b></a>
					<ul>
						<li><a href="eventUpdate.php" class="nochild"><b>Tambah Agenda</b></a></li>
						<li><a href="eventList.php" class="nochild"><b>Daftar Agenda</b></a></li>
						<li><a href="eventKategoriUpdate.php" class="nochild"><b>Tambah Kategori Agenda</b></a></li>
						<li><a href="eventKategoriList.php" class="nochild"><b>Daftar Kategori Agenda</b></a></li>
					</ul>
				</li>
				<li><a href="#" class="haschild"><b><img src="../images/icon/gray_18/camera.png" class="iconadmin">Galeri Foto</b></a>
					<ul>
						<li><a href="galeriUpdate.php" class="nochild"><b>Tambah Foto</b></a></li>
						<li><a href="galeriList.php" class="nochild"><b>Daftar Foto</b></a></li>
						<li><a href="galeriKategoriUpdate.php" class="nochild"><b>Tambah Kategori Foto</b></a></li>
						<li><a href="galeriKategoriList.php" class="nochild"><b>Daftar Kategori Foto</b></a></li>
					</ul>
				</li>
				<li><a href="#" class="haschild"><b><img src="../images/icon/gray_18/burn_blu-ray.png" class="iconadmin">Galeri Video</b></a>
					<ul>
						<li><a href="videoUpdate.php" class="nochild"><b>Tambah Video</b></a></li>
						<li><a href="videoList.php" class="nochild"><b>Daftar Video</b></a></li>
   			            <li><a href="videoKategoriUpdate.php" class="nochild"><b>Tambah Kategori Video</b></a></li>
						<li><a href="videoKategoriList.php" class="nochild"><b>Daftar Kategori Video</b></a></li>
					</ul>
				</li>
				<li><a href="#" class="haschild"><b><img src="../images/icon/gray_18/pictures_folder.png" class="iconadmin">Banner</b></a>
					<ul>
						<li><a href="bannerUpdate.php" class="nochild"><b>Tambah Banner</b></a></li>
						<li><a href="bannerList.php" class="nochild"><b>Daftar Banner</b></a></li>
					</ul>
				</li>
				<li><a href="#" class="haschild"><b><img src="../images/icon/gray_18/abacus.png" class="iconadmin">File download</b></a>
					<ul>
						<li><a href="fileUpdate.php" class="nochild"><b>Tambah Download</b></a></li>
						<li><a href="fileList.php" class="nochild"><b>Daftar Download</b></a></li>
					</ul>
				</li>
				<li><a href="paypalaccount.php" class="nochild"><b><img src="../images/icon/gray_18/user_woman.png" class="iconadmin">Paypal Account</b></a></li>
				<li><a href="norek.php" class="nochild"><b><img src="../images/icon/gray_18/money_bag.png" class="iconadmin">No Rekening</b></a></li>
				<li><a href="ym.php" class="nochild"><b><img src="../images/icon/gray_18/emoticon_grin.png" class="iconadmin">YM Account</b></a></li>
				<li><a href="visitorcounter.php" class="nochild"><b><img src="../images/icon/gray_18/group.png" class="iconadmin">Visitor Counter</b></a></li>
                
				<li><a href="headerList.php" class="nochild"><b><img src="../images/icon/gray_18/photo_album.png" class="iconadmin">Header Slide Show</b></a></li>
				
				<li><a href="guestList.php" class="nochild"><b><img src="../images/icon/gray_18/book.png" class="iconadmin">Buku Tamu '.$testi.'</b></a></li>
				
				<li><a href="pesan.php" class="nochild"><b><img src="../images/icon/gray_18/mail.png" class="iconadmin">Pesan Masuk</b></a></li>
				
				<li><a href="halamanList.php" class="nochild"><b><img src="../images/icon/gray_18/list.png" class="iconadmin">Halaman Dinasmis</b></a></li>
				
				<li><a href="gantiPassword.php" class="nochild"><b><img src="../images/icon/gray_18/password.png" class="iconadmin">Ganti Password</b></a></li>
				
				<li><a href="logout.php" class="nochild"><b><img src="../images/icon/gray_18/disconnect.png" class="iconadmin">Logout</b></a></li>
			</ul>
			<br class="clear"/>
			<div style="margin:12px 0;">&nbsp;</div>
		 </td>';
	
	return $hasil;
}

function checkFile($vPhoto, $kat, $ket, $fileWajibAda) {
	$strError = "";
	$tmp_name = $vPhoto['tmp_name'];
	$filetype = $vPhoto['type'];
	$filesize = $vPhoto['size'];
	$filename = $vPhoto['name'];
	$path_parts = pathinfo($filename);
	if(is_uploaded_file($tmp_name)) {
		$size2 = @getimagesize($tmp_name);
		if($kat=="header") {
			if($size2[0] != header_w) $strError .= "<li>Lebar file ".$ket." harus ".header_w." pixels!</li>";
			if($size2[1] != header_h) $strError .= "<li>Tinggi file ".$ket." harus ".header_h." pixels!</li>";
			if ($filesize > header_size) $strError .= "<li>Ukuran file ".$ket." maksimal ".(header_size/1024)." KB! Ukuran file yg hendak diupload: ".round($filesize/1024)." KB.</li>";
			if ($size2[2]!=2) $strError .=  "<li>Tipe file ".$ket." harus JPG.</li>";
        } else if($kat=="thumbnail") {
	        if($size2[0] != thumb_size) $strError .= "<li>Lebar file ".$ket." harus ".thumb_size." pixels!</li>";
			if($size2[1] != thumb_size) $strError .= "<li>Tinggi file ".$ket." harus ".thumb_size." pixels!</li>"; 			
			if ($filesize > galeri_fsize) $strError .= "<li>Ukuran file ".$ket." maksimal ".(galeri_fsize/1024)." KB! Ukuran file yg hendak diupload: ".round($filesize/1024)." KB.</li>";
			if ($size2[2]!=2) $strError .=  "<li>Tipe file ".$ket." harus JPG.</li>";
		} else if($kat=="galeri") {
			/* if($size2[0] < galeri_w_min) $strError .= "<li>Lebar file ".$ket." minimal ".galeri_w_min." pixels!</li>";
			if($size2[0] > galeri_w_max) $strError .= "<li>Lebar file ".$ket." maksimal ".galeri_w_max." pixels!</li>";
			
			if($size2[1] < galeri_h_min) $strError .= "<li>Tinggi file ".$ket." minimal ".galeri_h_min." pixels!</li>";
			if($size2[1] > galeri_h_max) $strError .= "<li>Tinggi file ".$ket." maksimal ".galeri_h_max." pixels!</li>"; */
			
			if ($filesize > galeri_fsize) $strError .= "<li>Ukuran file ".$ket." maksimal ".(galeri_fsize/1024)." KB! Ukuran file yg hendak diupload: ".round($filesize/1024)." KB.</li>";
			if ($size2[2]!=2) $strError .=  "<li>Tipe file ".$ket." harus JPG.</li>";
		} else if($kat=="banner_standar") {
			if($size2[0] != banner_w1) $strError .= "<li>Lebar file ".$ket." harus ".banner_w1." pixels!</li>";
			if($size2[1] != banner_h1) $strError .= "<li>Tinggi file ".$ket." harus ".banner_h1." pixels!</li>";
			if ($filesize > banner_size) $strError .= "<li>Ukuran file ".$ket." maksimal ".(banner_size/1024)." KB! Ukuran file yg hendak diupload: ".round($filesize/1024)." KB.</li>";
			if (!array_key_exists($size2[2], getArrExtBanner())) $strError .=  "<li>Tipe file harus JPG/GIF/SWF.</li>"; 			
		} else if($kat=="banner_utama") {
			if($size2[0] != banner_w2) $strError .= "<li>Lebar file ".$ket." harus ".banner_w2." pixels!</li>";
			if($size2[1] != banner_h2) $strError .= "<li>Tinggi file ".$ket." harus ".banner_h2." pixels!</li>";
			if ($filesize > banner_size) $strError .= "<li>Ukuran file ".$ket." maksimal ".(banner_size/1024)." KB! Ukuran file yg hendak diupload: ".round($filesize/1024)." KB.</li>";
			if (!array_key_exists($size2[2], getArrExtBanner())) $strError .=  "<li>Tipe file harus JPG/GIF/SWF.</li>"; 			
		} else if($kat=="file") {
			if ($filesize > file_download_size) $strError .= "<li>Ukuran file ".$ket." maksimal ".(file_download_size/1024)." KB! Ukuran file yg hendak diupload: ".round($filesize/1024)." KB.</li>";
			if (!in_array($path_parts['extension'], getArrExtFile())) $strError .=  "<li> Tipe file harus PDF/ZIP.</li>";
		}
	} else {
		if($fileWajibAda==true) $strError .=  "<li>Silahkan memilih file ".$ket." yang akan diupload.</li>"; 
	}
	return $strError;
}

function katUI($kat,$tagName,$id,$className) {
	$uiKategori = '';
	if($kat=="berita") {
		$uiKategori .= getKatBerita(0,$id,0);
	}else if($kat=="video") {
		$uiKategori .= getKatVideo(0,$id,0);
	}else if($kat=="galeri") {
		$uiKategori .= getKatFoto(0,$id,0);
	}elseif($kat=="agenda"){
		$uiKategori .= getKatAgenda(0,$id,0);	
	}
	elseif($kat=="fasilitas"){
		$uiKategori .= getKatFasilitas(0,$id,0);	
	}
	elseif($kat=="event"){
		$uiKategori .= getKatEvent(0,$id,0);	
	}		
	$uiKategori =
		'<select class="'.$className.'" name="'.$tagName.'">'.
			'<option value="0">&nbsp;</option>'.
			$uiKategori.
		'</select>';
	return $uiKategori;
}

function katUI2($kat,$tagName,$id,$className, $pengantar) {
	if($kat=="banner") {
		$arr = getArrKatBanner($pengantar);
	}
	
	$ui = '';
	foreach($arr as $key => $value) {
		$seld = ($key==$id)? 'selected="selected"':'';
		$ui .= '<option '.$seld.' value="'.$key.'">'.$value.'</option>';
	}
	$ui = '<select name="'.$tagName.'" class="'.$className.'">'.$ui.'</select>';
	return $ui;
}

function getKatBerita($parent_id=0,$seldId=0,$depth=0) {
	global $baca;
	$spacer = "";
	for($i=0;$i<$depth;$i++) {
		$spacer .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	$depth++;
	
	$uiKategori = '';
	$sqlK = "select id, nama, parent_id from ".tabel_berita." where status='1' and parent_id='".$parent_id."' and kategori='1' order by nama asc";
	$resK = mysql_query($sqlK, $baca);
	while($rowK=mysql_fetch_object($resK)) {
		$seld = ($seldId==$rowK->id)? 'selected="selected"' : '';
		$uiKategori .= '<option '.$seld.' value="'.$rowK->id.'">'.$spacer.$rowK->nama.'</option>';
		$uiKategori .= getKatBerita($rowK->id,$seldId,$depth);
	}
	return $uiKategori;
}

function getKatEvent($parent_id=0,$seldId=0,$depth=0) {
	global $baca;
	$spacer = "";
	for($i=0;$i<$depth;$i++) {
		$spacer .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	$depth++;
	
	$uiKategori = '';
	$sqlK = "select id, nama, parent_id from ".tabel_event." where status='1' and parent_id='".$parent_id."' and kategori='1' order by nama asc";
	$resK = mysql_query($sqlK, $baca);
	while($rowK=mysql_fetch_object($resK)) {
		$seld = ($seldId==$rowK->id)? 'selected="selected"' : '';
		$uiKategori .= '<option '.$seld.' value="'.$rowK->id.'">'.$spacer.$rowK->nama.'</option>';
		$uiKategori .= getKatBerita($rowK->id,$seldId,$depth);
	}
	return $uiKategori;
}

function getKatFasilitas($parent_id='1',$seldId=0,$depth=0) {
	global $baca;
	$spacer = "";
	for($i=0;$i<$depth;$i++) {
		$spacer .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	$depth++;
	
	$uiKategori = '';
	$sqlK = "select id, nama, parent_id from ".tabel_fasilitas." where status='1' and parent_id='1' and kategori='0' order by nama asc";
	//echo $sqlK;
	$resK = mysql_query($sqlK, $baca);
	while($rowK=mysql_fetch_object($resK)) {
		$seld = ($seldId==$rowK->id)? 'selected="selected"' : '';
		$uiKategori .= '<option '.$seld.' value="'.$rowK->id.'">'.$spacer.$rowK->nama.'</option>';
		$uiKategori .= getKatBerita($rowK->id,$seldId,$depth);
	}
	return $uiKategori;
}
/*beta galeri video*/
function getKatVideo($parent_id=0,$seldId=0,$depth=0) {
	global $baca;
	$spacer = "";
	for($i=0;$i<$depth;$i++) {
		$spacer .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	$depth++;
	
	$uiKategori = '';
	$sqlK = "select id, nama, parent_id from ".tabel_video." where status='1' and parent_id='".$parent_id."' and kategori='1' order by nama asc";
	$resK = mysql_query($sqlK, $baca);
	while($rowK=mysql_fetch_object($resK)) {
		$seld = ($seldId==$rowK->id)? 'selected="selected"' : '';
		$uiKategori .= '<option '.$seld.' value="'.$rowK->id.'">'.$spacer.$rowK->nama.'</option>';
		$uiKategori .= getKatVideo($rowK->id,$seldId,$depth);
	}
	return $uiKategori;
}

function getKatAgenda($parent_id=0,$seldId=0,$depth=0) {
	global $baca;
	$spacer = "";
	for($i=0;$i<$depth;$i++) {
		$spacer .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	$depth++;
	
	$uiKategori = '';
	$sqlK = "select id, nama, parent_id from ".tabel_agenda." where status='1' and parent_id='".$parent_id."' and kategori='1' order by nama asc";
	$resK = mysql_query($sqlK, $baca);
	while($rowK=mysql_fetch_object($resK)) {
		$seld = ($seldId==$rowK->id)? 'selected="selected"' : '';
		$uiKategori .= '<option '.$seld.' value="'.$rowK->id.'">'.$spacer.$rowK->nama.'</option>';
		$uiKategori .= getKatAgenda($rowK->id,$seldId,$depth);
	}
	return $uiKategori;
}

function getArrExtFile() {
	$arr = array();
	$arr[1] = "pdf";
	$arr[2] = "zip";
	$arr[3] = "rar";
	return $arr;
}

function getArrExtBanner() {
	$arr = array();
	$arr[1] = "gif";
	$arr[2] = "jpg";
	$arr[4] = "swf";
	return $arr;
}

function getArrKatBanner($pengantar=true) {
	$arr = array();
	if($pengantar==true) $arr[0] = " ";
	$arr[1] = "Atas (".banner_w1."x".banner_h1.")";
	$arr[2] = "Kanan (".banner_w2."x".banner_h2.")";
	return $arr;
}

function getKatFoto($parent_id=0,$seldId=0,$depth=0) {
	global $baca;
	$spacer = "";
	for($i=0;$i<$depth;$i++) {
		$spacer .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	$depth++;
	
	$uiKategori = '';
	$sqlK = "select id, nama, parent_id from ".tabel_foto." where status='1' and parent_id='".$parent_id."' and kategori='1' order by nama asc";
	$resK = mysql_query($sqlK, $baca);
	while($rowK=mysql_fetch_object($resK)) {
		$seld = ($seldId==$rowK->id)? 'selected="selected"' : '';
		$uiKategori .= '<option '.$seld.' value="'.$rowK->id.'">'.$spacer.$rowK->nama.'</option>';
		$uiKategori .= getKatFoto($rowK->id,$seldId,$depth);
	}
	return $uiKategori;
}

?>