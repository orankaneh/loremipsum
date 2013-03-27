<?
ob_start();
session_start();
$checkApp = false;
$minLevel = 0;
$hakAksesAplikasi = 0;
$judulnya = "Daftar Halaman";
include("header.php");
?>
<script language="Javascript">
function disableTextField() {
	var x_nil = document.formAkun.kategori.value;
	if (x_nil == 0) 
	{
		document.formAkun.includeNya.disabled = true;
	}
	else 
	{
		document.formAkun.includeNya.disabled = false;
		document.formAkun.includeNya.oldOnFocus = x.includeNya.onfocus;
	}
}
</script>
<?
$act = $_GET['act'];
$idLeftNya = $_GET['idLeftNya'];
$idRightNya = $_GET['idRightNya'];
$topAsliNya = $_GET['topAsliNya'];
$noAsliNya = $_GET['noAsliNya'];
$idAsliNya = $_GET['idAsliNya'];
$noUpNya = $_GET['noUpNya'];
$idUpNya = $_GET['idUpNya'];
$noDownNya = $_GET['noDownNya'];
$idDownNya = $_GET['idDownNya'];

// $act = "";

   if(strlen($act) > 0)
			{
			if($act=="up" and $noUpNya > 0 and $idUpNya > 1 and $noAsliNya > 0 and $idAsliNya > 1)
				{    
						$cmd="Update ".tabel_halaman." set urut_halaman='".$noUpNya."' where halaman_id='".$idAsliNya."'";
						$cmd2="Update ".tabel_halaman." set urut_halaman='".$noAsliNya."' where halaman_id='".$idUpNya."'";
						echo $cmd."<br>".$cmd2;
						mysql_query($cmd,$tulis) or die(mysql_error());
						mysql_query($cmd2,$tulis) or die(mysql_error());
						Header("Location: halamanList.php");			
				}
			if($act=="down" and $noDownNya > 0 and $idDownNya > 1 and $noAsliNya > 0 and $idAsliNya > 1)
				{
						$cmd="Update ".tabel_halaman." set urut_halaman='".$noDownNya."' where halaman_id='".$idAsliNya."'";
						$cmd2="Update ".tabel_halaman." set urut_halaman='".$noAsliNya."' where halaman_id='".$idDownNya."'";
						echo $cmd."<br>".$cmd2;
						mysql_query($cmd,$tulis) or die(mysql_error());
						mysql_query($cmd2,$tulis) or die(mysql_error());
						Header("Location: halamanList.php");			
				}
			if($act=="left" and $idLeftNya > 1 and $noAsliNya > 0 and $idAsliNya > 1)
				{
						$topL=dataHalaman("top",$idLeftNya);
						$kodeAkunL=nomorHalamanPalingBawah($topL);
						
						//cek apakah data yg dipindah merupakan no akhir
						//jika bukan no akhir maka nomer dibawahnya diupdate
						if(nomorHalamanPalingBawah($idLeftNya) != $noAsliNya)
							{
								$temp_noAslinya=$noAsliNya;
								$cmdS="Select * from ".tabel_halaman." where top_halaman='".$idLeftNya."' and urut_halaman > ".$noAsliNya." order by urut_halaman";
								$res_cmdS=mysql_query($cmdS,$baca);
								while($rs_cmdS=mysql_fetch_array($res_cmdS)){
									$cmdU="Update ".tabel_halaman." set urut_halaman='".$temp_noAslinya."' where halaman_id='".$rs_cmdS[halaman_id]."'";
									echo $cmdU."<br>";
									mysql_query($cmdU,$tulis) or die(mysql_error());
									$temp_noAslinya=$temp_noAslinya+1;
								}
							}
						
						$urutanTopL=dataHalaman("urut",$idLeftNya);
						$urutanTopL2=$urutanTopL+1;
						//cek apakah top akun merupakan no akhir 
						//jika bukan no akhir maka nomer dibawahnya diupdate
						if($urutanTopL != $kodeAkunL)
							{
								$temp_urutanTopL=$urutanTopL2+1;
								$cmdS="Select * from ".tabel_halaman." where top_halaman='".$topL."' and urut_halaman > ".$urutanTopL." order by urut_halaman";
								$res_cmdS=mysql_query($cmdS,$baca);
								while($rs_cmdS=mysql_fetch_array($res_cmdS)){
									$cmdU="Update ".tabel_halaman." set urut_halaman='".$temp_urutanTopL."' where halaman_id='".$rs_cmdS[halaman_id]."'";
									echo $cmdU."<br>";
									mysql_query($cmdU,$tulis) or die(mysql_error());
									$temp_urutanTopL=$temp_urutanTopL+1;
								}
							}
						
						
						$cmd="Update ".tabel_halaman." set top_halaman='".$topL."',urut_halaman='".$urutanTopL2."' where halaman_id='".$idAsliNya."'";
						echo $cmd."<br>";
						mysql_query($cmd,$tulis) or die(mysql_error());
						Header("Location: halamanList.php");
				}
			if($act=="right" and $idRightNya > 1 and $topAsliNya > 0 and $noAsliNya > 0 and $idAsliNya > 1)
				{
						$kodeAkunL=nomorHalamanPalingBawah($topAsliNya);
						
						//cek apakah data yg dipindah merupakan no akhir
						//jika bukan no akhir maka nomer dibawahnya diupdate
						echo $kodeAkunL."---".$noAsliNya."<br>";
						if($kodeAkunL != $noAsliNya)
							{
								$temp_noAslinya=$noAsliNya;
								$cmdS="Select * from ".tabel_halaman." where top_halaman='".$topAsliNya."' and urut_halaman > ".$noAsliNya." order by urut_halaman";
								$res_cmdS=mysql_query($cmdS,$baca) or die(mysql_error());
								while($rs_cmdS=mysql_fetch_array($res_cmdS)){
									$cmdU="Update ".tabel_halaman." set urut_halaman='".$temp_noAslinya."' where halaman_id='".$rs_cmdS[halaman_id]."'";
									echo $cmdU."<br>";
									mysql_query($cmdU,$tulis) or die(mysql_error());
									$temp_noAslinya=$temp_noAslinya+1;
								}
							}
						
						$noAkunBaru=nomorHalamanPalingBawah($idRightNya)+1;
						echo $noAkunBaru."<br>";
						
						$cmd="Update ".tabel_halaman." set top_halaman='".$idRightNya."',urut_halaman='".$noAkunBaru."' where halaman_id='".$idAsliNya."'";
						echo $cmd."<br>";
						mysql_query($cmd,$tulis) or die(mysql_error());
						Header("Location: halamanList.php");
				}
			}
		
		//$panjangMax=func_jumlahLevel2()+ 1;
		//---Membuat Bar Halaman Mulai ---
		$global_jumlah_level=5;
		$panjangMax=$global_jumlah_level;
		  ?>
		  <div class="judul_menu">Daftar Halaman</div>
		  
		 		<table border=0 cellspacing=0 cellpadding=0><td bgcolor=#CCCCCC>
				<table cellpadding="5" cellspacing="1" border="0">
				<tr>
					<td align="center" valign="top" bgcolor="#FFFFFF" colspan="<?=$panjangMax?>"><b>Nama Halaman</b></td>
					<!--<td align="center" valign="top" bgcolor="#FFFFFF" width=10></td>
					<td align="center" valign="top" bgcolor="#FFFFFF" width=10></td>
					<td align="center" valign="top" bgcolor="#FFFFFF" width=10></td>
					<td align="center" valign="top" bgcolor="#FFFFFF" width=10></td>
					<td align="center" valign="top" bgcolor="#FFFFFF" width=10></td>
					<td align="center" valign="top" bgcolor="#FFFFFF" width=10></td>
					<td align="center" valign="top" bgcolor="#FFFFFF" width=10></td>-->
				</tr>
				<?
				$mySQL="SELECT * FROM ".tabel_halaman." WHERE top_halaman=1 AND halaman_id!=1 ORDER BY urut_halaman";
				//echo $mySQL."========";
				$res_mySQL=mysql_query($mySQL,$baca);
				while($rstemp= mysql_fetch_array($res_mySQL)) {
				
				   $pIdCategory		= $rstemp[halaman_id];
				   $pIdParentCategory	= $rstemp[top_halaman];
				   $pCategoryDesc	= $rstemp[nama_halaman];  
				   $pIdgol_halaman	= $rstemp[gol_halaman];
				   $purut_halaman	=$rstemp[urut_halaman];
				   $pStatus	= $rstemp[status_halaman];
				   if($pIdgol_halaman=='0') $strgol_halaman='General';
				   else $strgol_halaman='Detail';
				   if($pBagianAkun==0) $pBagianAkun="";
				   $warnaTulisan='';		
				   $warnaTulisan2='';
				   if($pStatus!=1) 
					{
					$warnaTulisan='<font color="red">';
					$warnaTulisan2='</font>';
					}
				   
				   echo '<tr bgcolor="#FFFFFF" onMouseOver="this.style.background=\'#DFDFDF\'" onMouseOut="this.style.background=\'#FFFFFF\'"><td align="left" valign="top" colspan='.$panjangMax.'>';
					  
				   echo '<a name="'.$pIdCategory.'"><a href="halamanEdit.php?act=edit&idNya=' .$pIdCategory. '">'.$warnaTulisan." ".$pCategoryDesc.$warnaTulisan2.'</a>';
				   echo '</td>';
				   echo tataHalaman($pIdCategory,1).'</tr>';
				   
				   	func_ambilHalaman($pIdCategory,1,0,$panjangMax);
				}
				if(!mysql_num_rows($res_mySQL))
				{
				?>
				<tr><td align="left" valign="top" bgcolor="#FFFFFF" colspan="<?=$panjangMax+6?>">
					<a href="halamanAdd.php?act=firstInsert&topTU=1&noAsliNya=1">Tambah halaman</a>
				</td></tr>
				<?
				}
				?>
				</table>
				</td></table>
<?
include("footer.php");
?>        

