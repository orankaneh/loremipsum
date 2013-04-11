<?php
Function dataHalaman($strArg,$intMember)
	{		
	$sqlnama_kategori = "select * from ".tabel_halaman." WHERE halaman_id='".$intMember."'";
	$gonama_kategori = mysql_query($sqlnama_kategori);
	while($rs_nama_kategori = mysql_fetch_array($gonama_kategori)) {
		$top_kategori=$rs_nama_kategori[top_halaman];
		$nama_kategori=$rs_nama_kategori[nama_halaman];
		$kodeAkun=$rs_nama_kategori[urut_halaman];
		}
	if($kodeAkun=="0") $kodeAkun="";
	if($strArg=="top") return $top_kategori;
	if($strArg=="nama") return $nama_kategori;
	if($strArg=="urut") return $kodeAkun;
	}

Function array_dataHalaman($intMember)
	{		
	$sqlnama_kategori = "select * from ".tabel_halaman." WHERE halaman_id='".$intMember."'";
	$gonama_kategori = mysql_query($sqlnama_kategori);
	while($rs_nama_kategori = mysql_fetch_array($gonama_kategori)) {
		$top_kategori=$rs_nama_kategori[top_halaman];
		$nama_kategori=$rs_nama_kategori[nama_halaman];
		$kodeAkun=$rs_nama_kategori[urut_halaman];
		}
	
	if($kodeAkun=="0") $kodeAkun="";
	$array_dataHalaman["top"]=$top_kategori;
	$array_dataHalaman["nama"]=$nama_kategori;
	$array_dataHalaman["urut"]=$kodeAkun;
	return $array_dataHalaman;
	}

function tataHalaman($argIDKey,$argJmlLevel)
	{
	global $global_jumlah_level;
	$sqlnama_halaman = "select * from ".tabel_halaman." WHERE halaman_id!=1 and halaman_id='".$argIDKey."'";
	$gonama_halaman = mysql_query($sqlnama_halaman);
	while($rs_nama_halaman = mysql_fetch_array($gonama_halaman)) {
		$top_halaman=$rs_nama_halaman[top_halaman];
		$nama_halaman=$rs_nama_halaman[nama_halaman];
		$kodeAkun=$rs_nama_halaman[urut_halaman];
		$idNya=$rs_nama_halaman[halaman_id];
		}
	
	$noUpNya=$kodeAkun - 1;
	$noDownNya=$kodeAkun + 1;
	
	$idUpNya=cekHalamanAtasBawah($top_halaman,$noUpNya);
	$idDownNya=cekHalamanAtasBawah($top_halaman,$noDownNya);
	$idRightNya=cekHalamanAtasBawah($top_halaman,$noUpNya);
	
	$namaUpNya=dataHalaman("nama",$idUpNya);
	$namaLeftNya=dataHalaman("nama",dataHalaman("top",$top_halaman));
	if($namaLeftNya=="Root") $namaLeftNya="halaman Utama";
	else $namaLeftNya="sub halaman ".$namaLeftNya;
	///Pengunaan menu
	$lock1 = false;
	$lock2 = true;
	if(client_key==md5("stratos")) { $lock1 = false; $lock2 = true; }
	else if(client_key==md5("dylandy")) { $lock1 = true; $lock2 = true; }
	else if(client_key==md5("dynames")) { $lock1 = true; $lock2 = false; }
	
	if($lock1==true) {
	     $strLeft='<img src="../images/dis_back.gif" border="0">';
	     $strRight='<img src="../images/dis_forward.gif" border="0">';
	     $strUp='<img src="../images/dis_up.gif" border="0">';
	     $strDown='<img src="../images/dis_down.gif" border="0">';
	     $strInUp='<img src="../images/bs_inup.gif" border="0">';
	     $strInDown='<img src="../images/bs_indown.gif" border="0">';
	    
		 if($idNya=="2"){
		$strLeft2="";
		$strInUp2="";
		 $strInDown2="";
		 $strRight2="";
		}
		
		else{
	     $strLeft2='<a href="halamanList.php?act=left&idLeftNya='.$top_halaman.'&noAsliNya='.$kodeAkun.'&idAsliNya='.$argIDKey.'"><img src="../images/bs_back.gif" border="0" alt="Merubah halaman '.$nama_halaman.' menjadi '.$namaLeftNya.'" title="Merubah halaman '.$nama_halaman.' menjadi '.$namaLeftNya.'"></a>';
		 
	     $strRight2='<a href="halamanList.php?act=right&idRightNya='.$idRightNya.'&topAsliNya='.$top_halaman.'&noAsliNya='.$kodeAkun.'&idAsliNya='.$argIDKey.'"><img src="../images/bs_forward.gif" border="0" alt="Merubah halaman '.$nama_halaman.' menjadi sub halaman '.$namaUpNya.'" title="Merubah halaman '.$nama_halaman.' menjadi sub halaman '.$namaUpNya.'"></a>';
	    
		 $strUp2='<a href="halamanList.php?act=up&noUpNya='.$noUpNya.'&idUpNya='.$idUpNya.'&noAsliNya='.$kodeAkun.'&idAsliNya='.$argIDKey.'"><img src="../images/bs_up.gif" border="0" alt="Menaikkan halaman '.$nama_halaman.' menjadi urutan ke '.$noUpNya.'" title="Menaikkan halaman '.$nama_halaman.' menjadi urutan ke '.$noUpNya.'"></a>';
	    
		 $strDown2='<a href="halamanList.php?act=down&noDownNya='.$noDownNya.'&idDownNya='.$idDownNya.'&noAsliNya='.$kodeAkun.'&idAsliNya='.$argIDKey.'"><img src="../images/bs_down.gif" border="0" alt="Menurunkan halaman '.$nama_halaman.' menjadi urutan ke '.$noDownNya.'" title="Menurunkan halaman '.$nama_halaman.' menjadi urutan ke '.$noDownNya.'"></a>';
	    
		
		
		 $strInUp2='<a href="halamanAdd.php?act=insertUP&topTU='.$top_halaman.'&noAsliNya='.$kodeAkun.'"><img src="../images/bs_inup.gif" border="0" alt="Tambah halaman diatas '.$nama_halaman.'" title="Tambah halaman diatas '.$nama_halaman.'"></a>';
	    
		 $strInDown2='<a href="halamanAdd.php?act=insertDown&topTU='.$top_halaman.'&noAsliNya='.($kodeAkun+1).'"><img src="../images/bs_indown.gif" border="0" alt="Tambah halaman dibawah '.$nama_halaman.'" title="Tambah halaman dibawah '.$nama_halaman.'"></a>';
		 }
		if($top_halaman=="1")
		{
			$strHapus='&nbsp;';
		}
		else
		{
			$strHapus='<a href="halamanDel.php?act=del&topTU='.$top_halaman.'&noAsliNya='.($kodeAkun+1).'&idNya='.$idNya.'"><img src="../images/delete.png" border="0" alt="Hapus Halaman '.$nama_halaman.'" title="Hapus Halaman '.$nama_halaman.'"></a>';
		}
	}
	
	if($top_halaman < 3) $strLeft2=$strLeft;
	if($idUpNya==0 or $noUpNya==0) $strUp2=$strUp;
	if($idDownNya==0 or $noDownNya==0) $strDown2=$strDown;
	if($kodeAkun == 1) $strRight2=$strRight;
	$jumlahTotalLevel=0;
	$jumlahTotalLevel=func_jumlahTotalLevel($idNya, 1, 0, 0);
	if(($argJmlLevel+$jumlahTotalLevel) >= $global_jumlah_level) $strRight2=$strRight;	
	
	if($lock2==true) {
		/* if($top_halaman=="1") {
			$strUp2 = '&nbsp;';
			$strDown2 = '&nbsp;';
		} */
		$strLeft2 = '&nbsp;';
		$strRight2 = '&nbsp;';
		$strInUp2 = '&nbsp;';
		$strInDown2 = '&nbsp;';
		$strHapus = '&nbsp;';
	}
	
	echo '<td align="center" valign="top">'.$strLeft2.'</td><td align="center" valign="top">'.$strRight2.'</td><td align="center" valign="top">'.$strUp2.'</td><td align="center" valign="top">'.$strDown2.'</td><td align="center" valign="top">'.$strInUp2.'</td><td align="center" valign="top">'.$strInDown2.'</td><td align="center" valign="top">'.$strHapus.'</td>';
	}

function cekHalamanAtasBawah($argTop,$argID)
	{
	$sqlAB="SELECT * FROM ".tabel_halaman." WHERE top_halaman='".$argTop."' and urut_halaman='" .$argID."' ORDER BY urut_halaman";
	$res_AB=mysql_query($sqlAB) or die(mysql_error());
	$cekHalamanAtasBawah=0;
	while($rs_AB=mysql_fetch_array($res_AB)){
		$cekHalamanAtasBawah=$rs_AB[halaman_id];
		}
	return $cekHalamanAtasBawah;
	}


function nomorHalamanPalingBawah($argTop)
	{
	$sqlAB="SELECT * FROM ".tabel_halaman." WHERE top_halaman='".$argTop."' ORDER BY urut_halaman";
	$res_AB=mysql_query($sqlAB) or die(mysql_error());
	$nomorHalamanPalingBawah=0;
	while($rs_AB=mysql_fetch_array($res_AB)){
		$nomorHalamanPalingBawah=$rs_AB[urut_halaman];
		}
	return $nomorHalamanPalingBawah;
	}

function cekPunyaSubHalaman($argID)
	{
	$sqlAB="SELECT * FROM ".tabel_halaman." WHERE top_halaman='" .$argID."' ORDER BY urut_halaman";
	$res_AB=mysql_query($sqlAB) or die(mysql_error());
	$cekPunyaSubHalaman=0;
	while($rs_AB=mysql_fetch_array($res_AB)){
		$cekPunyaSubHalaman=$cekPunyaSubHalaman+1;
		}
	return $cekPunyaSubHalaman;
	}

function func_ambilHalaman($idParentCategory2, $idPreviousParentCategory, $tabs, $jmlKolom)
   	{

   global $globalTypeAkun,$global_jumlah_level;
   	
   $mySql2="SELECT * FROM ".tabel_halaman." WHERE top_halaman=" .$idParentCategory2." ORDER BY urut_halaman";
   $res_mySQL2=mysql_query($mySql2);
   while($rstemp2= mysql_fetch_array($res_mySQL2)) {
     $pIdCategory2	=$rstemp2[halaman_id];
     $pCategoryDesc2	=$rstemp2[nama_halaman];
     $purut_halaman2	=$rstemp2[urut_halaman];
     $pStatus2	=$rstemp2[status_halaman];
     $warnaTulisan='';
	$warnaTulisan2='';
	if($pStatus2!=1) 
		{
		$warnaTulisan='<font color="red">';
		$warnaTulisan2='</font>';
		}
	   
    if($idPreviousParentCategory!=$idParentCategory2)
    	{
      
	      if($idPreviousParentCategory > $idParentCategory2)
	      	{
	       $tabs  = $tabs - 1;
	       	}
	      else
	      	{
	        $tabs = $tabs+1;
		}
	      
	      $idPreviousParentCategory = $idParentCategory2;
     	}

      echo '<tr bgcolor="#FBFDEE" onMouseOver="this.style.background=\'#EDF1A5\'" onMouseOut="this.style.background=\'#FBFDEE\'">';
	 for($f=1; $f <= $tabs; $f++)
	 	{
	 	echo '<td align="left" valign="top" bgcolor="#FBFDEE" width="1%">&nbsp;</td>';
    }

	echo '<td align="left" valign="top" colspan="'.(($jmlKolom - $f)+1).'"><a href=halamanEdit.php?act=edit&idNya=' .$pIdCategory2. '>'.$warnaTulisan.' '.$pCategoryDesc2.$warnaTulisan2.'</a> ';
	echo '</td>';
	echo tataHalaman($pIdCategory2,$f).'</tr>';
	if($f < $global_jumlah_level) func_ambilHalaman($pIdCategory2, $idPreviousParentCategory, $tabs, $jmlKolom);
		}
	}


function func_ambilMenu($idParentMenu2, $idPreviousParentMenu, $tabs)
   	{
   global $global_urut_pertama;
   $mySql2="SELECT * FROM ".tabel_halaman." WHERE top_halaman=" .$idParentMenu2." ORDER BY urut_halaman";
   $res_mySQL2=mysql_query($mySql2);
   while($rstemp2= mysql_fetch_array($res_mySQL2)) {
     $pIdMenu2	=$rstemp2[halaman_id];
     $pIdParentMenu2	= $rstemp2[top_halaman];
     $pMenuDesc2	=$rstemp2[nama_halaman];
     $purut_halaman2	=$rstemp2[urut_halaman];
    if($idPreviousParentMenu!=$idParentMenu2)
    	{
      
	      if($idPreviousParentMenu > $idParentMenu2)
	      	{
	       $tabs  = $tabs - 1;
	        }
	      else
	      	{
	        $tabs = $tabs+1;
	       	}
	      
	$idPreviousParentMenu = $idParentMenu2;
     	}
  	 $urutNya="";
	 for($f=2; $f <= $tabs; $f++)
	 	{
   		$urutNya=$urutNya.(dataHalaman("urut",$idPreviousParentMenu)-1)."_";
     		}
     	$urutNya=$urutNya.($purut_halaman2-1);
     	$dis_urut=$global_urut_pertama."_".$urutNya;
     	 echo "dqm__sub_menu_width".substr($dis_urut,0,-2)." = 120 \n";
     	 echo "dqm__subdesc".$dis_urut." = \"".$pMenuDesc2."\"\n";
	 echo "dqm__icon_index".$dis_urut." = 0 \n";
	 echo "dqm__url".$dis_urut." = \"index_static.php?top=".$pIdParentMenu2."&urut=".$purut_halaman2."\"\n";
	
	 func_ambilMenu($pIdMenu2, $idPreviousParentMenu, $tabs);      
	 	
		} 
	}


function func_jumlahTotalLevel($idParentCategory2, $idPreviousParentCategory, $tabs, $maktabs)
   	{  
   $mySql2="SELECT * FROM ".tabel_halaman." WHERE top_halaman=" .$idParentCategory2." ORDER BY urut_halaman";
   $res_mySQL2=mysql_query($mySql2);   
   while($rstemp2= mysql_fetch_array($res_mySQL2)) {
     $pIdCategory2	=$rstemp2[halaman_id];
    
    if($idPreviousParentCategory!=$idParentCategory2)
    	{
      
	      if($idPreviousParentCategory > $idParentCategory2)
	      	{
	       $tabs  = $tabs - 1;
	       	}
	      else
	      	{
	        $tabs = $tabs+1;	        
					}
	      
	      $idPreviousParentCategory = $idParentCategory2;     		
     	}
     
     $maktabs=$maktabs+1;
     
     //echo $maktabs."--".$tabs."-->".$pIdCategory2."<br>";               	 		     	
     
	   func_jumlahTotalLevel($pIdCategory2, $idPreviousParentCategory, $tabs, $maktabs);    
		}		
		return $maktabs;		
	}


function updateSubHalaman2($argID,$argStatus)
	{
	$jumlahLevel2=1;
	$mySQL="SELECT * FROM ".tabel_halaman." WHERE top_halaman=".$argID." AND halaman_id!=1 ORDER BY urut_halaman";
	$res_mySQL=mysql_query($mySQL);
	while($rstemp= mysql_fetch_array($res_mySQL)) {
		 $pIdCategory= $rstemp[halaman_id];
		 updateSubHalaman($pIdCategory,1,0,$argStatus);
		 $cmdFU="Update ".tabel_halaman." set status_halaman='".$argStatus."' where halaman_id='".$pIdCategory."'";
		 mysql_query($cmdFU) or die(mysql_error());  
		}
	return $jumlahLevel2;
	}

function updateSubHalaman($idParentCategory2, $idPreviousParentCategory,$tabs,$argStatus)
   	{
     	$mySql2="SELECT * FROM ".tabel_halaman." WHERE top_halaman=" .$idParentCategory2." ORDER BY urut_halaman";
   	$res_mySQL2=mysql_query($mySql2) or die(mysql_error());
	while($rstemp2= mysql_fetch_array($res_mySQL2)) {
	     	$pIdCategory2	=$rstemp2[halaman_id];
	    	if($idPreviousParentCategory!=$idParentCategory2)
		    	{	      
			      if($idPreviousParentCategory > $idParentCategory2)
			      	{
			       $tabs  = $tabs - 1;
			       	}
			      else
			      	{
			        $tabs = $tabs+1;
				}		      
			      $idPreviousParentCategory = $idParentCategory2;
		     	}
		$cmdFU="Update ".tabel_halaman." set status_halaman='".$argStatus."' where halaman_id='".$pIdCategory2."'";
		mysql_query($cmdFU) or die(mysql_error());
		updateSubHalaman($pIdCategory2, $idPreviousParentCategory,$tabs,$argStatus);    
		}
	return $updateSubHalaman;
	}

function tataMenu($argID,$argTop)
	{
	$mySql="SELECT * FROM ".tabel_halaman." WHERE halaman_id!=1 and status_halaman=1 and top_halaman='" .$argTop."'";
	$res_mySQL=mysql_query($mySql) or die(mysql_error());
	$tataMenu='| <a href="index.php">HOME</a> | ';
	if($argTop!=1) $tataMenu='| <a href=index_static.php?top='.dataHalaman("top",$argTop).'&urut='.dataHalaman("urut",$argTop).'>'.dataHalaman("nama",$argTop).'</a> | <br>| ';
	while($rs_mySql=mysql_fetch_array($res_mySQL)){
		$temp='<a href=index_static.php?top='.$rs_mySql[top_halaman].'&urut='.$rs_mySql[urut_halaman].'>'.$rs_mySql[nama_halaman].'</a> | ';
		if($argID==$rs_mySql[halaman_id]) $temp='<b>'.$rs_mySql[nama_halaman].'</b> | ';
		$tataMenu=$tataMenu.$temp;
		}
	echo $tataMenu;
	if(cekPunyaSubHalaman($argID) > 0) echo tataSubMenu($argID);
	}

function tataSubMenu($argTop)
	{
	$mySql="SELECT * FROM ".tabel_halaman." WHERE halaman_id!=1 and status_halaman=1 and top_halaman='" .$argTop."'";
	$res_mySQL=mysql_query($mySql) or die(mysql_error());
	$tataSubMenu='<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| ';
	while($rs_mySql=mysql_fetch_array($res_mySQL)){
		$temp='<a href=index_static.php?top='.$rs_mySql[top_halaman].'&urut='.$rs_mySql[urut_halaman].'>'.$rs_mySql[nama_halaman].'</a> | ';
		if($argID==$rs_mySql[halaman_id]) $temp='<b>'.$rs_mySql[nama_halaman].'</b> | ';
		$tataSubMenu=$tataSubMenu.$temp;
		}
	return $tataSubMenu;
	}

function topHalaman($idParentCategory2)
   	{	
	   $mySql2="SELECT * FROM ".tabel_halaman." WHERE halaman_id!=1 and halaman_id=" .$idParentCategory2." ORDER BY urut_halaman";
	   //echo $mySql2."<br>";
	   $res_mySQL2=mysql_query($mySql2);
	   while($rstemp2= mysql_fetch_array($res_mySQL2)) {
           $topHalaman=$rstemp2[top_halaman];
	    if($idParentCategory2!=1)
	    	{	      
		   topHalaman($topHalaman);    
	     	}
       		} 
	return $topHalaman;
	}

function dataMember($strArgID)
	{		
	$sqlnama_kategori = "select * from ".tabel_user_detail." WHERE user_id='".$strArgID."' limit 1";
	$gonama_kategori = mysql_query($sqlnama_kategori);
	while($rs_nama_kategori = mysql_fetch_array($gonama_kategori)) {
		$ar_DM['nama']=$rs_nama_kategori[nama];
		$ar_DM['alamat']=$rs_nama_kategori[alamat];
		$ar_DM['kota']=$rs_nama_kategori[kota];
		$ar_DM['email']=$rs_nama_kategori[email];
		}
	return $ar_DM;
	}

?>