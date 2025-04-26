<?php
/*
 +-=========================================================================-+
 |                             phpKF-Portal v3.00                            |
 +---------------------------------------------------------------------------+
 |                  Telif - Copyright (c) 2007 - 2019 phpKF                  |
 |                    www.phpKF.com   -   phpKF@phpKF.com                    |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkarma ve satma hakları sadece phpKF`ye aittir. |
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  phpKF.com/telif.php  adresini ziyaret edin. |
 +-=========================================================================-+*/


	define('DOSYA_BLOKLAR',true);


//  VARSAYILAN BLOK TASARIMI YÜKLENİYOR - BAŞI //

if (@is_file('ayar.php')) $dosya = 'portal/temalar/'.$temadizini.'/blok_tasarim/'.$portal_ayarlar['blok_sekli'].'/index.php';
else $dosya = 'temalar/'.$temadizini.'/blok_tasarim/'.$portal_ayarlar['blok_sekli'].'/index.php';

if ($portal_ayarlar['blok_sekli'] == 'varsayilan_blok_tasarimi')
{
	$blok_tasarim = '';
	$blok_dosyasi = 'varsayilan_blok_tasarimi';
}
elseif (($dosya_ac = @fopen($dosya,'r')) AND (preg_match('/^[a-z_.]+$/', $dosya) == 0) )
{
	$blok_tasarim = 'blok_tasarim/';
	$blok_dosyasi = $portal_ayarlar['blok_sekli'].'/index';
	@fclose($dosya_ac);
}
else
{
	$blok_tasarim = '';
	$blok_dosyasi = 'varsayilan_blok_tasarimi';
}


if (@is_file('ayar.php')) $vs_blok_tasarim = vs_blok_tasarim('portal/temalar/'.$temadizini.'/'.$blok_tasarim, ''.$blok_dosyasi.'.php');
else $vs_blok_tasarim = vs_blok_tasarim('temalar/'.$temadizini.'/'.$blok_tasarim, ''.$blok_dosyasi.'.php');


$blok_tablosu1 = $vs_blok_tasarim[0];
$blok_tablosu2 = $vs_blok_tasarim[1];
$blok_tablosu3 = $vs_blok_tasarim[2];

$tablo_bloklar_cikti1 = $vs_blok_tasarim[3];
$sol_bloklar_cikti1 = $vs_blok_tasarim[4];
$sol_bloklar_cikti2 = $vs_blok_tasarim[5];
$sag_bloklar_cikti1 = $vs_blok_tasarim[6];
$sag_bloklar_cikti2 = $vs_blok_tasarim[7];


//  VARSAYILAN BLOK TASARIMI YÜKLENİYOR - SONU //



$etkilenen_bloklar ="";

if ($portal_bloklar_ayar['sol_bloklar'] =='0')
{
	$sol_bloklar_cikti1 = '';
	$etkilenen_bloklar .="AND blok_yer!='1'";
}
else $sol_bloklar_cikti2 = $sol_bloklar_cikti2;

if ($portal_bloklar_ayar['sag_bloklar'] =='0')
{
	$sag_bloklar_cikti1 = '';
	$etkilenen_bloklar .="AND blok_yer!='3'";
}
else $etkilenen_bloklar .="";

	//  SOL VE SAĞ BLOKLAR SIRALANIYOR

	$bloklar_sonuc = $vt->query("SELECT * FROM $tablo_portal_bloklar WHERE blok_acik='1' AND blok_yer!='0' AND blok_yer!='2' $etkilenen_bloklar ORDER BY blok_yer,blok_sira") or die ($vt->hata_ver());



	$sol_blok_cikti = '';
	$sag_blok_cikti = '';

	while ($bloklar = $vt->fetch_array($bloklar_sonuc))
	{

	/*************************************************************************************/

	// PORTAL MENÜSÜ //

	if ($bloklar['blok_ad'] == 'portal_menusu')
	{ 

	$blok_tab1 ='<div class="blok_yazilari">
	<table align="center" class="blok_fieldset_menu">';
	
	if ( (isset($kullanici_kim['yetki'])) AND ($kullanici_kim['yetki'] == 1) )
	{
	$blok_tab1 .='
	<tr>
	<td align="left" style="width:100%;" nowrap="nowrap">
	<div class="blok_yazilari_baslik">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/yukari.png" id="resimdegistir" style="padding-left:3px;" width="11" height="10" border="0" alt="G"><a name="menu_ac" onclick="gizle_goster(\'menu_bls\'),resimDegistir(\'resimdegistir\',1)" style="cursor:pointer;">&nbsp;'.$kp_dil_496.'</a></div>
	<div id="menu_bls" style="position:static; visibility: visible; display: inline;">
	<table align="center">
	<tr><td class="blok_yazilari_menu" align="left" style="width:50%;" nowrap="nowrap">
	<div style="white-space: nowrap;">
	&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'yonetim.php">'.$kp_dil_499.'</a>
	<br>
	&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'phpkf-yonetim/index.php">'.$kp_dil_500.'</a>
	<br>
	</div>
	<br>
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	
	';
	}
	
	$blok_tab1 .='<tr>
	<td align="left" style="width:100%;" nowrap="nowrap">
	<div class="blok_yazilari_baslik">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/yukari.png" id="resimdegistir2" style="padding-left:3px;" width="11" height="10" border="0" alt="G"><a name="menu_ac" onclick="gizle_goster(\'menu_bls2\'),resimDegistir(\'resimdegistir2\',1)" style="cursor:pointer;">&nbsp;'.$kp_dil_497.'</a></div>
	<div id="menu_bls2" style="position:static; visibility: visible; display: inline;">
	<table align="center">
	<tr><td class="blok_yazilari_menu" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.$phpkf_dosyalar['portal'].'">'.$kp_dil_1.'</a><br>';

	if ($portal_bloklar_ayar['haber_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'haberler.php">'.$kp_dil_325.'</a><br>';
	}

	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'anket.php">'.$kp_dil_164.'</a><br>';
	}

	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'dosyalar.php">'.$kp_dil_324.'</a><br>';
	}

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'galeri.php">'.$kp_dil_260.'</a><br>';
	}
	
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'site_ekle.php">'.$kp_dil_441.'</a><br>';
	}
	if ($portal_bloklar_ayar['takvim_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'takvim.php">'.$kp_dil_7.'</a><br>';
	}
	if ($portal_bloklar_ayar['siteharitasi_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'sitemap.php">'.$kp_dil_124.'</a><br>';
	}

	if (($portal_bloklar_ayar['davetiye_sayfasi'] == 1) OR ($portal_bloklar_ayar['davetiye_sayfasi'] == 2)){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'davetiye.php">'.$kp_dil_212.'</a><br>';
	}
	if ($portal_bloklar_ayar['arama_sayfasi'] == 1){
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$ust_dizin.'portal_arama.php">'.$kp_dil_385.'</a><br>';
	}

	$blok_tab1 .='</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>';
	
	$sqlSorgu = $vt->query("select sayfa_no,dosya_adresi,yer,baslik from $tablo_portal_sayfa where yer!='2'") or die ($vt->hata_ver());
	$sayii = $vt->num_rows($sqlSorgu);
	if ($sayii)
	{
	
	$blok_tab1 .='
	<tr>
	<td align="left" style="width:100%;" nowrap="nowrap">
	<br>
	<div class="blok_yazilari_baslik">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/yukari.png" id="resimdegistir3" style="padding-left:3px;" width="11" height="10" border="0" alt="G"><a name="menu_ac" onclick="gizle_goster(\'menu_bls3\'),resimDegistir(\'resimdegistir3\',1)" style="cursor:pointer;">&nbsp;'.$kp_dil_498.'</a></div>
	<div id="menu_bls3" style="position:static; visibility: visible; display: inline;">
	<table align="center">
	<tr><td class="blok_yazilari_menu" align="left" style="width:50%;" nowrap="nowrap">';
	
	$dolu = 1;
	while ($sql_Sonuc = $vt->fetch_assoc($sqlSorgu))
	{
	
	
	
	if (strlen($sql_Sonuc['baslik']) > 20)
	{
	$vtsonucc_baslikk = mb_substr($sql_Sonuc['baslik'],0,20, 'utf-8').'...';
	}
	else
	{
	$vtsonucc_baslikk = $sql_Sonuc['baslik'];
	}
	
	if ($dolu < $sayii)
	{
	
	if ($sql_Sonuc['yer'] == 0)
	{
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.linkverPortal($ust_dizin.'ozel_sayfa.php?o_sayfa='.$sql_Sonuc['sayfa_no'],$sql_Sonuc['baslik']).'">'.$vtsonucc_baslikk.'</a><br>';
	}
	else
	{
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$sql_Sonuc['dosya_adresi'].'">'.$vtsonucc_baslikk.'</a><br>';
	}
	}
	else
	{
	
	if ($sql_Sonuc['yer'] == 0)
	{
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.linkverPortal($ust_dizin.'ozel_sayfa.php?o_sayfa='.$sql_Sonuc['sayfa_no'],$sql_Sonuc['baslik']).'">'.$vtsonucc_baslikk.'</a><br>';
	}
	else
	{
	$blok_tab1 .='&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$sql_Sonuc['dosya_adresi'].'">'.$vtsonucc_baslikk.'</a><br>';
	}
	}
	$dolu++;
	}
	$blok_tab1 .='
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>';
	
	}

	$blok_tab1 .='
	</table>
	</div>';

	$portal_menu_cikti = $blok_tablosu1.$kp_dil_5;
	$portal_menu_cikti .= $blok_tablosu2.$blok_tab1;
	$portal_menu_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $portal_menu_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $portal_menu_cikti;  

	} 

	// PORTAL MENÜSÜ - SONU //

	/**************************************************************************************/
	// KULLANICI MASASI AYARLARI //

	elseif ($bloklar['blok_ad'] == 'kullanici_masasi')
	{ 
	$blok_tab2 ='';
	if ( isset($kullanici_kim['id']) )
	{
	$satir = $kullanici_kim;

	$zamana_gore_karsila='<font face="Verdana" style="font-size: 8pt">'.$kp_dil_48.'</font>';

	$saat_dilimi = $ayarlar['saat_dilimi'];
	$yaz_saati = date('I');

	if ($saat_dilimi >> 0)
	{
	if ($yaz_saati == 1) $bolge = ($saat_dilimi + 1) * 3600;
	else $bolge = $saat_dilimi * 3600;
	}
	else
	{
	if ($yaz_saati == 1) $bolge = 3600;
	else $bolge = 0;
	}

	$sunucu_saati = time();
	$sunucu_saati += $bolge;
	$saat = gmdate('H',$sunucu_saati);
	$dk_sn = gmdate(':i', $sunucu_saati);
	
	if($saat>=00&&$saat<=02)
	$zamana_gore_karsila='<font face="Verdana" style="font-size: 8pt">'.$kp_dil_43.'</font>';
	else if($saat>=03&&$saat<=04)
	$zamana_gore_karsila='<font face="Verdana" style="font-size: 8pt">'.$kp_dil_44.'</font>';
	else if($saat>=05&&$saat<=11)
	$zamana_gore_karsila='<font face="Verdana" style="font-size: 8pt">'.$kp_dil_45.'</font>';
	else if($saat>=12&&$saat<=17)
	$zamana_gore_karsila='<font face="Verdana" style="font-size: 8pt">'.$kp_dil_46.'</font>';
	else if($saat>=18&&$saat<=23)
	$zamana_gore_karsila='<font face="Verdana" style="font-size: 8pt">'.$kp_dil_47.'</font>';


	// ZAMANA GÖRE KARŞILAMA - SONU //


	$kullanici_adi_sonuc = '<span class="blok_yazilari_baslik" style="font-size:9px;">'.$kp_dil_501.':</span> '.$satir['kullanici_adi'];
	$adi_sonuc = '<span class="blok_yazilari_baslik" style="font-size:9px;">'.$kp_dil_38.':</span> '.$satir['gercek_ad'];
	$dogum_tarihi_sonuc = '<span class="blok_yazilari_baslik" style="font-size:9px;">'.$kp_dil_509.':</span> '.$satir['dogum_tarihi'];
	$kullanici_kim_id = '<span class="blok_yazilari_baslik" style="font-size:9px;">'.$kp_dil_510.':</span> '.$satir['id'];
	$sehir_sonuc = '<span class="blok_yazilari_baslik" style="font-size:9px;">'.$kp_dil_514.':</span> '.$satir['sehir'];
	$katilim_tarihi_sonucu = '<span class="blok_yazilari_baslik" style="font-size:9px;">'.$kp_dil_511.':</span> '.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $satir['katilim_tarihi']);
	$mesaj_sayisi_sonuc = '<span class="blok_yazilari_baslik" style="font-size:9px;">'.$kp_dil_39.':</span> '.NumaraBicim($satir['mesaj_sayisi']);
	$profil_degistir = $kp_dil_21;
	$satir_kullanici_adi = $satir['kullanici_adi'];

	$_uye_adi = '';

	if (strlen($kullanici_kim['kullanici_adi']) > 9)
	{
		$_uye_adi .= mb_substr($kullanici_kim['kullanici_adi'],0,9, 'utf-8').'...';
	}
	else
	{
		$_uye_adi .= $kullanici_kim['kullanici_adi'];
	}

	$blok_tab2 .='
	<div align="center"  class="blok_yazilari_baslik">'.$zamana_gore_karsila.'<br><font color="red">'.$_uye_adi.'</font> <a href="'.$alt_dizin.$phpkf_dosyalar['cikis'].'?o='.$o.'" onclick="return window.confirm(jsl[\'cikis_uyari\'])">'.$kp_dil_18.'</a></div><br>';


	if ($satir['resim'] != '')
	{
		if (preg_match('/^(\/|http:|https:|ftp:)/i', $satir['resim'])) $resim11 = $satir['resim'];
		else $resim11 = $alt_dizin.$satir['resim'];
		$blok_tab2 .='<div align="center" class="linkler2"><hr><a href="'.$alt_dizin.$phpkf_dosyalar['profil_degistir'].'"><img src="'.$resim11.'" title="'.$kp_dil_42.'" alt="'.$kp_dil_42.'" border="0" style="max-width:160px"></a><hr></div>';
	}

	else
	{
		$blok_tab2 .='<div align="center" class="linkler2"><hr><a href="'.$alt_dizin.$phpkf_dosyalar['profil_degistir'].'">';
		if (preg_match('/^(\/|http:|https:|ftp:)/i', $ayarlar['v-uye_resmi']))
		$blok_tab2 .='<img src="'.$ayarlar['v-uye_resmi'].'" title="'.$kp_dil_42.'" alt="'.$kp_dil_42.'" border="0">';
		else $blok_tab2 .='<img src="'.$alt_dizin.$ayarlar['v-uye_resmi'].'" title="'.$kp_dil_42.'" alt="'.$kp_dil_42.'" border="0">';
		$blok_tab2 .='</a><hr></div>';
	}


	$blok_tab2 .='
	<table align="left" class="linkler5">
	<tr><td class="linkler5" align="left" style="width:100%;" nowrap="nowrap">
	&nbsp;&nbsp;'.$kullanici_kim_id.'
	</td>
	</tr>
	<tr>
	<td class="linkler5" align="left" style="width:100%;" nowrap="nowrap">
	&nbsp;&nbsp;'.$kullanici_adi_sonuc.'
	</td>
	</tr>
	<tr>
	<td class="linkler5" align="left" style="width:100%;" nowrap="nowrap">
	&nbsp;&nbsp;'.$adi_sonuc.'
	</td>
	</tr>
	<tr>
	<td class="linkler5" align="left" style="width:100%;" nowrap="nowrap">
	&nbsp;&nbsp;'.$dogum_tarihi_sonuc.'
	</td>
	</tr>
	<tr>
	<td class="linkler5" align="left" style="width:100%;" nowrap="nowrap">
	&nbsp;&nbsp;'.$sehir_sonuc.'
	</td>
	</tr>
	<tr>
	<td class="linkler5" align="left" style="width:100%;" nowrap="nowrap">
	&nbsp;&nbsp;'.$mesaj_sayisi_sonuc.'
	</td>
	</tr>
	<tr>
	<td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	<hr>
	</td>
	</tr>
	
	<tr>
	<td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	<span class="blok_yazilari_baslik">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/assagi.png" id="resim" style="padding-left:1px;" width="10" height="10" border="0"  alt="G">&nbsp;<a name="menu_ac" onclick="gizle_goster(\'menu_ac_bls2\'),resimDegistir(\'resim\',1)" style="cursor:pointer;">'.$kp_dil_15.'</a>
	</span>
	</td>
	</tr>
	
	<tr>
	<td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	
	<div id="menu_ac_bls2" style="position:static; visibility: hidden; display: none;">
	
	<table align="left" class="linkler5">
	<tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.$phpkf_dosyalar['profil'].'">'.$kp_dil_513.'</a>
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.$phpkf_dosyalar['profil_degistir'].'">'.$profil_degistir.'</a>
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.$phpkf_dosyalar['sifre_degistir'].'">'.$kp_dil_502.'</a>
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'km_ara.php?kip=mesaj&amp;kim='.$satir_kullanici_adi.'">'.$kp_dil_22.'</a>
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'km_ara.php?kip=cevap&amp;kim='.$satir_kullanici_adi.'">'.$kp_dil_23.'</a>
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'arama.php?a=1&amp;b=1&amp;forum=tum&amp;yazar_ara='.$satir_kullanici_adi.'">'.$kp_dil_24.'</a>
	</td></tr></table>
	</div>
	</td>
	</tr>';
	
	
	
	if ($ayarlar['o_ileti'] != 0)
	{

	
	if ($ayarlar['o_ileti'] == 1)
	{
		if ($kullanici_kim['okunmamis_oi'])
		{
		$oi = '-<font color="red">'.$kullanici_kim['okunmamis_oi'].'</font>';
		$oi2 = '-<font color="red" style="font-size: 9px;">('.$kullanici_kim['okunmamis_oi'].' '.$kp_dil_518.')</font>';
		}

		else
		{
		$oi = '';
		$oi2 = '';
		}
	}
	
	
	
	
	$blok_tab2 .='	
	<tr>
	<td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	<hr><span class="blok_yazilari_baslik">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/assagi.png" id="resim2" style="padding-left:1px;" width="10" height="10" border="0"  alt="G">&nbsp;<a name="menu_ac" onclick="gizle_goster(\'menu_ac_bls\'),resimDegistir(\'resim2\',1)" style="cursor:pointer;">'.$kp_dil_512.''.$oi2.'</a></span>
	</td>
	</tr>
	<tr>
	<td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	
	<div id="menu_ac_bls" style="position:static; visibility: hidden; display: none;">
	
	<table align="left" class="linkler5">
	<tr>
	<td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'ozel_ileti.php?kip=ayarlar">'.$kp_dil_503.'</a>
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'oi_yaz.php">'.$kp_dil_504.'</a>
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'ozel_ileti.php">'.$kp_dil_505.'</a> 
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'ozel_ileti.php?kip=ulasan">'.$kp_dil_506.'</a> 
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'ozel_ileti.php?kip=gonderilen">'.$kp_dil_507.'</a> 
	</td></tr><tr><td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.$alt_dizin.'ozel_ileti.php?kip=kaydedilen">'.$kp_dil_508.'</a> 
	</td></tr></table>
	</div>
	
	</td>
	</tr>';
	
	}
	
	$blok_tab2 .='
	<tr>
	<td class="linkler5" align="left" style="width:50%;" nowrap="nowrap">
	<hr>
	</td>
	</tr>
	</table>';
	}
	else
	{

	
	if (@is_file('ayar.php')) $giris_dizin ='';
	else $giris_dizin ='portal/';
	$dosya = @zkTemizle4(basename(urldecode($_SERVER['PHP_SELF'])));
	$dosya_adi =$giris_dizin.$dosya;
	
	$blok_tab2 .='
	<form name="giris" action="'.$alt_dizin.$phpkf_dosyalar['giris'].'" method="post" onsubmit="return denetle2()">
	<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
	<input type="hidden" name="git" value="'.$dosya_adi.'" />

	<table align="center" class="blok_yazilari" cellpadding="0" cellspacing="0" border="0">
	<tr>
	<td align="center" colspan="2">

	<font face="Verdana" style="font-size: 8pt">&nbsp;&nbsp;'.$kp_dil_181.'<br>
	&nbsp;&nbsp;'.$kp_dil_182.': &nbsp;&nbsp;'.$_SERVER['REMOTE_ADDR'].'</font><br><br>
	</td>
	</tr>

	<tr>
	<td align="left" style="white-space: nowrap;" >
	<font face="Verdana" style="font-size: 7pt">&nbsp;&nbsp;'.$kp_dil_40.' :
	</font>
	</td>
	<td align="left" style="height:35px"> <input name="kullanici_adi" class="formlar" type="text" maxlength="20" size="8" style="width:70px" placeholder="Kullanıcı Adı" required /> </td>
	</tr>

	<tr>
	<td align="left" style="height:35px"><font face="Verdana" style="font-size: 7pt">&nbsp;&nbsp;'.$kp_dil_41.' :
	</font>
	</td>
	<td> <input name="sifre" class="formlar" type="password" maxlength="20" size="8" placeholder="Şifre" required style="width:70px" /> </td>
	</tr>

	<tr>
	<td valign="middle">
	<font face="Verdana" style="font-size: 7pt">
	<label style="cursor:pointer"><input type="checkbox" name="hatirla" checked="checked" style="position: static; top: 2px;" />&nbsp;'.$kp_dil_25.'</label>
	</font>
	</td>
	<td align="center"><br><input type="submit" value="'.$kp_dil_91.'" class="dugme" />
	</td>
	</tr>

	<tr>
	<td colspan="2" align="center"><br>
	<font face="Verdana" style="font-size: 7pt">
	<a href="'.$alt_dizin.$phpkf_dosyalar['profil'].'">'.$kp_dil_183.'</a><br><a href="'.$alt_dizin.'yeni_sifre.php">'.$kp_dil_26.'</a>
	</font>

	</td>
	</tr>
	</table>
	</form>';

	}

	$kullanici_masasi_cikti = $blok_tablosu1.$kp_dil_6;
	$kullanici_masasi_cikti .= $blok_tablosu2.$blok_tab2;
	$kullanici_masasi_cikti .= $blok_tablosu3;

	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $kullanici_masasi_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $kullanici_masasi_cikti;  

	}

	// KULLANICI MASASI AYARLARI SONU //

	/***************************************************************************************/

	// FORUM DALLARI VERİTABANINDAN ÇEKİLİYOR //

	elseif (($bloklar['blok_ad'] == 'forumlar'))
	{ 

	$vtsorgu = "SELECT id,ana_forum_baslik FROM $tablo_dallar ORDER BY sira";
	$dallar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	// FORUM DALLARI EKRANA YAZDIRILIYOR //

	$ana_forum_baslik1 = '';
	$forum_baslik1 = '';
	$toplam_forum = 0;
	$toplam_for2 = 0;
	$toplam_for3 =0;
	
	while ($dallar_satir = $vt->fetch_array($dallar_sonuc))
	{
	
	
	if (strlen($dallar_satir['ana_forum_baslik']) > 17)
	$forum_baslik1 .= '<br><img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/yukari.png" id="resim112'.$toplam_for2.'" style="padding-left:3px;" width="10" height="10" border="0"  alt="G">&nbsp;<a name="menu_ac" onclick="gizle_goster(\'menu_ac'.$toplam_for2.'\'),resimDegistir(\'resim112'.$toplam_for2.'\',1)" style="cursor:pointer;"><b>'.mb_substr($dallar_satir['ana_forum_baslik'],0,17, 'utf-8').'...</b></a><br>';

	else $forum_baslik1 .= '<br><img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/yukari.png" id="resim112'.$toplam_for2.'" style="padding-left:3px;" width="10" height="10" border="0"  alt="G">&nbsp;<a name="menu_ac" onclick="gizle_goster(\'menu_ac'.$toplam_for2.'\'),resimDegistir(\'resim112'.$toplam_for2.'\',1)" style="cursor:pointer;"><b>'.$dallar_satir['ana_forum_baslik'].'</b></a><br>';

	$forum_baslik1 .= '<span id="menu_ac'.$toplam_for2.'" style="position:static; visibility: visible; display: inline;">';
	// FORUMLAR EKRANA YAZDIRILIYOR //

	$vtsorgu = "SELECT id,forum_baslik,alt_forum FROM $tablo_forumlar where gizle='0' AND alt_forum='0' AND dal_no='$dallar_satir[id]' ORDER BY sira";
	$vtsonuc4 = $vt->query($vtsorgu);
	$satir_sayi_sonuc = $vt->num_rows($vtsonuc4);
	

	$satir_dolu=1;
	
	while ($forum_satir = $vt->fetch_array($vtsonuc4))
	{
	// üst foruma bakılıyor
	$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar WHERE gizle='0' AND alt_forum='$forum_satir[id]' ORDER BY sira";
	$vtsonuca = $vt->query($vtsorgu);
	$vtsonuc_derk = $vt->num_rows($vtsonuca);

	
	
	if (!$vtsonuc_derk)
	{
		if ($satir_dolu < $satir_sayi_sonuc)
		{
			if (strlen($forum_satir['forum_baslik']) > 16)
			$forum_kisabaslik = mb_substr($forum_satir['forum_baslik'],0,16, 'utf-8').'...';

			else $forum_kisabaslik = $forum_satir['forum_baslik'];

			$forum_baslik1 .= '&nbsp; <img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><a href="'.linkver($alt_dizin.'forum.php?f='.$forum_satir['id'], $forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
			$toplam_forum++;
		}
		else
		{
			if (strlen($forum_satir['forum_baslik']) > 16)
			$forum_kisabaslik = mb_substr($forum_satir['forum_baslik'],0,16, 'utf-8').'...';

			else $forum_kisabaslik = $forum_satir['forum_baslik'];

			$forum_baslik1 .= '&nbsp; <img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><a href="'.linkver($alt_dizin.'forum.php?f='.$forum_satir['id'], $forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
			$toplam_forum++;
		}
	}


	// alt forumu varsa //
	else
	{
	
	
	
		if ($satir_dolu < $satir_sayi_sonuc)
		{
			if (strlen($forum_satir['forum_baslik']) > 12)
			$forum_kisabaslik = mb_substr($forum_satir['forum_baslik'],0,12, 'utf-8').'...';

			else $forum_kisabaslik = $forum_satir['forum_baslik'];

			$forum_baslik1 .= '&nbsp; <a name="menu_ac" onclick="gizle_goster(\'menu_ac2'.$toplam_for3.'\'),resimDegistir(\'resim'.$toplam_for3.'\',2)" style="cursor:pointer;"><img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_eksi.gif" id="resim'.$toplam_for3.'" width="10" height="11" border="0"  alt="G"></a><a href="'.linkver($alt_dizin.'forum.php?f='.$forum_satir['id'], $forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
			$toplam_forum++;
		}
		else
		{
			if (strlen($forum_satir['forum_baslik']) > 12)
			$forum_kisabaslik = mb_substr($forum_satir['forum_baslik'],0,12, 'utf-8').'...';

			else $forum_kisabaslik = $forum_satir['forum_baslik'];

			$forum_baslik1 .= '&nbsp; <a name="menu_ac" onclick="gizle_goster(\'menu_ac2'.$toplam_for3.'\'),resimDegistir(\'resim111'.$toplam_for3.'\',3)" style="cursor:pointer;"><img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu_eksi.gif" id="resim111'.$toplam_for3.'" width="10" height="11" border="0"  alt="G"></a><a href="'.linkver($alt_dizin.'forum.php?f='.$forum_satir['id'], $forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
			$toplam_forum++;
		}
		
	$forum_baslik1 .= '<span id="menu_ac2'.$toplam_for3.'" style="position:static; visibility: visible; display: inline;">';
	
				
		$satir_dolu_alt_forum=1;
		while ($alt_forum_satir = $vt->fetch_array($vtsonuca))
		{
		
			if ($satir_dolu_alt_forum < $vtsonuc_derk)
			{
				if ($satir_dolu != $satir_sayi_sonuc)
				{
					if (strlen($alt_forum_satir['forum_baslik']) > 12)
					$forum_kisabaslik = mb_substr($alt_forum_satir['forum_baslik'],0,12, 'utf-8').'...';

					else $forum_kisabaslik = $alt_forum_satir['forum_baslik'];

					$forum_baslik1 .= '&nbsp; <img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/forum.gif" alt="ok" border="0">&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="alt forum" border="0"><a href="'.linkver($alt_dizin.'forum.php?f='.$alt_forum_satir['id'], $alt_forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
					$toplam_forum++;
					
					}
				else
				{
					if (strlen($alt_forum_satir['forum_baslik']) > 12)
					$forum_kisabaslik = mb_substr($alt_forum_satir['forum_baslik'],0,12, 'utf-8').'...';

					else $forum_kisabaslik = $alt_forum_satir['forum_baslik'];

					$forum_baslik1 .= '&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="alt forum" border="0"><a href="'.linkver($alt_dizin.'forum.php?f='.$alt_forum_satir['id'], $alt_forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
					$toplam_forum++;
				}
					
			}
			else
			{
			
	

			if ($satir_dolu != $satir_sayi_sonuc)
				{
				if (strlen($alt_forum_satir['forum_baslik']) > 20)
				$forum_kisabaslik = mb_substr($alt_forum_satir['forum_baslik'],0,20, 'utf-8').'...';

				else $forum_kisabaslik = $alt_forum_satir['forum_baslik'];

				$forum_baslik1 .= '&nbsp; <img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/forum.gif" alt="ok" border="0">&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="alt forum" border="0"><a href="'.linkver($alt_dizin.'forum.php?f='.$alt_forum_satir['id'], $alt_forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
				$toplam_forum++;
				
				}
				else
				{
					if (strlen($alt_forum_satir['forum_baslik']) > 15)
					$forum_kisabaslik = mb_substr($alt_forum_satir['forum_baslik'],0,15, 'utf-8').'...';

					else $forum_kisabaslik = $alt_forum_satir['forum_baslik'];

					$forum_baslik1 .= '&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="alt forum" border="0"><a href="'.linkver($alt_dizin.'forum.php?f='.$alt_forum_satir['id'], $alt_forum_satir['forum_baslik']).'">'.$forum_kisabaslik.'</a><br>';
					$toplam_forum++;
				}
				
				
			}
		
	$satir_dolu_alt_forum++;
	}
	
	$forum_baslik1 .= '</span>';
	
	}
	$satir_dolu++;
	$toplam_for3++;
	}
	$forum_baslik1 .= '</span>';

	$toplam_forum++;
	$toplam_for2++;
	}

	$blok_tab3 ='';

	if ($toplam_forum > 30)
	{
	$blok_tab3 .='
<div id="comments_scroll_div6" style="height:300px; width:160px; overflow:auto; border: #9e9e9e 0px solid; padding: 0px; font-size: 10px; font-family: Verdana;">
<div id="comments_scroll_div62" onmouseover="document.getElementById(\'comments_scroll_container4\').stop();" onmouseout="document.getElementById(\'comments_scroll_container4\').start();">
'.$forum_baslik1.'
</div>
</div>

<script type="text/javascript">//<![CDATA[
hareketli_yazi(\'comments_scroll_div6\', \'comments_scroll_container4\', \'up\', \'2\', \'90\', \'300\', \'genmed\');//]]></script>';
	}else{
	$blok_tab3 .='<font face="Verdana" style="font-size: 10px">'.$forum_baslik1.'</font>';;
	}


	$forumlar_cikti = $blok_tablosu1.$kp_dil_10;
	$forumlar_cikti .= $blok_tablosu2.$blok_tab3;
	$forumlar_cikti .= $blok_tablosu3;

	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $forumlar_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $forumlar_cikti;  


	} 

	// FORUMDAKİ TOPLAM BÖLÜM VE FORUMDALLARI VERİTABANINDAN  ÇEKİLİYOR SONU //

	/******************************************************************************************/

	elseif (($bloklar['blok_ad'] == 'istatistikler'))
	{
	// FORUM İSTATİSTİKLERİ AYARLARI //
	// İSTATİSTİKLER VERİTABANINDAN ALINIYOR //
	$son_uye = $vt->query("SELECT id,kullanici_adi FROM $tablo_kullanicilar ORDER BY id DESC LIMIT 1");

	$sonuye_adi = $vt->fetch_assoc($son_uye);
	$uyeler = $vt->query("SELECT id FROM $tablo_kullanicilar");
	$uye_sayisi = $vt->num_rows($uyeler);

	$vtsatir = $vt->query("SELECT kullanici_adi,yetki FROM 
	$tablo_kullanicilar WHERE (son_hareket + $zaman_asimi) > $tarih AND gizli='0' AND hangi_sayfada!='Kullanıcı çıkış yaptı' ORDER BY son_hareket DESC");
	$kullanici_sayi = $vt->num_rows($vtsatir);

	// ÇEVRİMİÇİ KULLANICI SAYISI ALINIYOR //
	$vtsatir = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE (son_hareket + $zaman_asimi) > $tarih AND gizli='0' AND hangi_sayfada!='Kullanıcı çıkış yaptı' ORDER BY son_hareket DESC");
	$kullanici_sayi = $vt->num_rows($vtsatir);


	// GİZLİ ÇEVRİMİÇİ KULLANICI SAYISI ALINIYOR //
	$vtsatir = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE(son_hareket + $zaman_asimi) > $tarih AND gizli='1' AND hangi_sayfada!='Kullanıcı çıkış yaptı'");
	$gizli_sayi = $vt->num_rows($vtsatir);

	//	ÇEVRİMİÇİ MİSAFİRLERİN BİLGİLERİ ÇEKİLİYOR	//
	$vtsatir = $vt->query("SELECT giris FROM $tablo_oturumlar WHERE (son_hareket + $zaman_asimi) > $tarih");
	$misafir_sayi = $vt->num_rows($vtsatir);
	$toplam_sayi = ($kullanici_sayi + $gizli_sayi + 
	$misafir_sayi);
	
	// DOSYA BİLGİLERİ ÇEKİLİYOR //
	$lg_sorgu = $vt->query("SELECT * FROM $tablo_portal_indir");
	$icerik = $vt->num_rows($lg_sorgu);

	// ANKET BİLGİLERİ ÇEKİLİYOR //
	$alg_sorgu = $vt->query("SELECT * FROM $tablo_portal_anketsoru");
	$aicerik = $vt->num_rows($alg_sorgu);

	// HABER BİLGİLERİ ÇEKİLİYOR //
	$hlg_sorgu = $vt->query("SELECT * FROM $tablo_portal_haberler where onay='1'");
	$hicerik = $vt->num_rows($hlg_sorgu);

	// GALERI BİLGİLERİ ÇEKİLİYOR //
	$glg_sorgu = $vt->query("SELECT * FROM $tablo_portal_galeri where resim_onay='1'");
	$gicerik = $vt->num_rows($glg_sorgu);
	
	// SITE BİLGİLERİ ÇEKİLİYOR //
	$slg_sorgu = $vt->query("SELECT * FROM $tablo_portal_siteekle where site_onay='1'");
	$sicerik = $vt->num_rows($slg_sorgu);


	// 	TOPLAM BAŞLIK VE İLETİ SAYISI ÇEKİLİYOR	//

	$vtsatir = $vt->query("SELECT konu_sayisi, cevap_sayisi FROM $tablo_forumlar");

	$toplam_baslik = 0;
	$cevap_sayi = 0;
	
	
	 

	while($basliklar_cevaplar = $vt->fetch_assoc($vtsatir))
	{
	$toplam_baslik += $basliklar_cevaplar['konu_sayisi'];
	$cevap_sayi += $basliklar_cevaplar['cevap_sayisi'];
	}

	$toplam_mesaj = ($cevap_sayi + $toplam_baslik);

	$son_uye_adii1 = '';

	if (strlen($sonuye_adi['kullanici_adi']) > 5)
	{
	$son_uye_adii1 .= mb_substr($sonuye_adi['kullanici_adi'],0,5, 'utf-8').'...';
	}
	else
	{
	$son_uye_adii1 .= $sonuye_adi['kullanici_adi'];
	}

	if (strlen($uye_sayisi) > 3)
	{
	$toplam_cevrimicii = mb_substr($kp_dil_30,0,10, 'utf-8').'.';
	$kayitli_kullanicii = mb_substr($kp_dil_31,0,13, 'utf-8').'.';
	$gizli_kullanicii = mb_substr($kp_dil_32,0,10, 'utf-8').'.';
	}
	else
	{
	$toplam_cevrimicii = $kp_dil_30;
	$kayitli_kullanicii = $kp_dil_31;
	$gizli_kullanicii = $kp_dil_32;
	}

	$blok_tab4 ='<table align="center">
	<tr>
	<td align="left" style="width:50%;" nowrap="nowrap" class="blok_fieldset">
	<div class="blok_yazilari_baslik"><img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/yukari.png" id="rsm111" style="padding-left:2px;" width="10" height="10" border="0"  alt="G">&nbsp;<a name="menu_ac" onclick="gizle_goster(\'bls111\'),resimDegistir(\'rsm111\',1)" style="cursor:pointer;">'.$kp_dil_494.'</a></div>
	<div id="bls111" style="position:static; visibility: visible; display: inline;">
	<table align="center">
	<tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_152.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($icerik).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_153.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($aicerik).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_394.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($hicerik).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_395.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($gicerik).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_477.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($sicerik).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_27.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($toplam_baslik).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_28.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($toplam_mesaj).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_93.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($portal_ayarlar['sayfa_gosterim']).']
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	<tr>
	<td align="left" height="10px">
	</td>
	</tr>
	<tr>
	<td align="left" style="width:50%;" nowrap="nowrap" class="blok_fieldset">
	<div class="blok_yazilari_baslik"><img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/yukari.png" id="rsm112" style="padding-left:2px;" width="10" height="10" border="0"  alt="G">&nbsp;<a name="menu_ac" onclick="gizle_goster(\'bls112\'),resimDegistir(\'rsm112\',1)" style="cursor:pointer;">'.$kp_dil_495.'</a></div>
	<div id="bls112" style="position:static; visibility: visible; display: inline;">
	<table align="center">
	<tr>
	<td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kayitli_kullanicii.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($kullanici_sayi).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$gizli_kullanicii.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($gizli_sayi).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_33.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($misafir_sayi).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$toplam_cevrimicii.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($toplam_sayi).']
	</td></tr><tr><td class="blok_yazilari" align="left" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_29.'</td><td class="blok_yazilari" align="center" style="font-size: 9px;"> ['.NumaraBicim($uye_sayisi).']
	</td></tr><tr><td class="blok_yazilari" align="left" colspan="2" style="width:50%;" nowrap="nowrap">
	&nbsp;<img src="'.$ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/alt_forum_sonu.gif" alt="ok" border="0"><img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;'.$kp_dil_34.' (<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$sonuye_adi['id'].'&kim='.$sonuye_adi['kullanici_adi'],$sonuye_adi['kullanici_adi']).'">'.$son_uye_adii1.'</a>)
	</td></tr></table></div></td></tr></table>';

	$vt->query("UPDATE $tablo_portal_ayarlar SET sayi=sayi +1 WHERE isim='sayfa_gosterim'") or die ($vt->hata_ver());



	$istatistikler_cikti = $blok_tablosu1.$kp_dil_11;
	$istatistikler_cikti .= $blok_tablosu2.$blok_tab4;
	$istatistikler_cikti .= $blok_tablosu3;

	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $istatistikler_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $istatistikler_cikti; 

	// FORUM İSTATİSTİKLER - SONU //

	}

	/***************************************************************************************/

	elseif (($bloklar['blok_ad'] == 'dogum_gunleri'))
	{ 

	// DOĞUM GÜNÜ OLAN ÜYELER //
	$bu_aygun = date('d-m-');
	$bu_yil = date('Y');

	$vtsorgu = "SELECT id,kullanici_adi,dogum_tarihi FROM $tablo_kullanicilar WHERE dogum_tarihi_goster='1' AND dogum_tarihi LIKE '$bu_aygun%'";
	$doganlar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$blok_tab5 ='<font face="Verdana" style="font-size: 9px; text-align:center;"><b>'.$kp_dil_196.' :</b> '.$bu_aygun.$bu_yil.'</font><br><br>';
	if (!$vt->num_rows($doganlar_sonuc))
	{
	$blok_tab5 .='<div align="center"><font face="Verdana" style="font-size: 9px; text-align:center;">'.$kp_dil_198.' !</font></div>';
	}else{

	$blok_dogum_gunleri ='';

	while ($bugun_doganlar = $vt->fetch_assoc($doganlar_sonuc))
	{
	$dogum_yili = mb_substr($bugun_doganlar['dogum_tarihi'], -4, 4, 'utf-8');

	$uyenin_yasi = ($bu_yil - $dogum_yili);

	$bugun_doganlar_uye_adi = '';

	if (strlen($bugun_doganlar['kullanici_adi']) > 9)
	{
	$bugun_doganlar_uye_adi .= mb_substr($bugun_doganlar['kullanici_adi'],0,9, 'utf-8').'...';
	}
	else
	{
	$bugun_doganlar_uye_adi .= $bugun_doganlar['kullanici_adi'];
	}

	$blok_dogum_gunleri .='

	<b>'.$kp_dil_199 .': </b>
	<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$bugun_doganlar['id'].'&kim='.$bugun_doganlar['kullanici_adi'],$bugun_doganlar['kullanici_adi']).'">'.$bugun_doganlar_uye_adi.'</a><br>
	<b>'.$kp_dil_200.' :</b> '.$dogum_yili.'<br>
	<b>'.$kp_dil_201.' : </b> '.$uyenin_yasi.'<br><br>';

	}
	if ($vt->num_rows($doganlar_sonuc) > 7)
	{
	$blok_tab5 .='

<div id="comments_scroll_divb" style="height:300px; width: 135px; overflow:auto; border: #9e9e9e 0px solid; padding: 0px; font-size: 10px; font-family: Verdana;">
<div id="comments_scroll_divb2" onmouseover="document.getElementById(\'comments_scroll_container1\').stop();" onmouseout="document.getElementById(\'comments_scroll_container1\').start();">
'.$blok_dogum_gunleri.'
</div>
</div>

<script type="text/javascript">//<![CDATA[
hareketli_yazi(\'comments_scroll_divb\', \'comments_scroll_container1\', \'up\', \'2\', \'90\', \'300\', \'genmed\');//]]></script>';
	}
	else
	{
	$blok_tab5 .='<font face="Verdana" style="font-size: 9px; text-align:center;">'.$blok_dogum_gunleri.'</font>';
	}
	}


	$dogum_gunleri_cikti = $blok_tablosu1.$kp_dil_197;
	$dogum_gunleri_cikti .= $blok_tablosu2.$blok_tab5;
	$dogum_gunleri_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $dogum_gunleri_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $dogum_gunleri_cikti;  

	}

	/*******************************************************************************/
	
	elseif (($bloklar['blok_ad'] == 'favori_siteler'))
	{ 
	
	$blok_tab13 ='';
	
	$vtsorgu = "SELECT site_title,site_oy,site_id,tiklama_sayisi FROM $tablo_portal_siteekle WHERE site_onay='1' ORDER BY site_oy DESC limit $portal_ayarlar[blok_siteler_kategorileri]";
	$site_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	
	$blok_tab13 ='<table align="center" style="width:145px;">
	<tr>
	<td align="center" class="linkler" width="60%"><u>'.$kp_dil_478.'</u><br><br></td>
	<td align="center" class="linkler" width="20%"><u>'.$kp_dil_479.'</u><br><br></td>
	<td align="center" class="linkler" width="20%"><u>'.$kp_dil_480.'</u><br><br></td>
	</tr>';
	while ($siteler_satir = $vt->fetch_array($site_sonuc))
	{
	
	
	$siteler_satir2 = '';
	
	if (strlen($siteler_satir['site_title']) > 6)
	{
	$siteler_satir2 .= mb_substr($siteler_satir['site_title'],0,6, 'utf-8').'..';
	}
	else
	{
	$siteler_satir2 .= $siteler_satir['site_title'];
	}
	
	$blok_tab13 .='<tr class="liste-veri"><td align="left" nowrap="nowrap">
	<img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a target="_blank" href="'.$ust_dizin.'site_ekle.php?kosul=siteye_yonlendiriliyor&amp;site_id='.$siteler_satir['site_id'].'">'.$siteler_satir2.'</a></td>
	<td align="center">['.NumaraBicim($siteler_satir['site_oy']).']</td>
	<td align="center">['.NumaraBicim($siteler_satir['tiklama_sayisi']).']</td></tr>';
	
	 } 
		
	
	$blok_tab13 .='</table>';
	
	$favori_siteler_cikti = $blok_tablosu1.$kp_dil_441;
	$favori_siteler_cikti .= $blok_tablosu2.$blok_tab13;
	$favori_siteler_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $favori_siteler_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $favori_siteler_cikti; 
	}
	
	/*******************************************************************************/
	
	
	elseif (($bloklar['blok_ad'] == 'haber_kategori_blok'))
	{ 
	
	$vtsorgu = "SELECT * FROM $tablo_portal_haberdal order by tarih desc limit 0,$portal_ayarlar[blok_haber_kategorileri]";
	
	$vtsonuc116 = $vt->query($vtsorgu);
	
	$blok_tab14 ='
	<table align="center" style="width:145px;">
	<tr>
	<td align="left" style="width:70%;" class="linkler"><u>'.$kp_dil_126.'</u><br><br></td>
	<td align="center" style="width:30%;" class="linkler"><u>'.$kp_dil_481.'</u><br><br></td>
	</tr>';
	
	if ($vt->num_rows($vtsonuc116))
	{
	
	while ($haber_kategori_satir = $vt->fetch_assoc($vtsonuc116))
	{	

	$lg_sorgu = $vt->query("SELECT * FROM $tablo_portal_haberler WHERE dal_id='$haber_kategori_satir[id]'");
	
	$icerik = $vt->num_rows($lg_sorgu);
	
	$haber_kategori_satir213 = '';
	
	if (strlen($haber_kategori_satir['dal']) > 8)
	{
	$haber_kategori_satir213 .= mb_substr($haber_kategori_satir['dal'],0,8, 'utf-8').'...';
	}
	else
	{
	$haber_kategori_satir213 .= $haber_kategori_satir['dal'];
	}	
	$blok_tab14 .='
	<tr>
	<td align="left" nowrap="nowrap" class="liste-veri">
	<img src="'.$sonileti_rengi.'" alt="ok" border="0">
	<a href="'.linkverPortal($ust_dizin.'haberler.php?hd='.$haber_kategori_satir['id'],$haber_kategori_satir['dal']).'"><font face="Verdana" style="font-size: 10px">'.$haber_kategori_satir213.'</font></a>
	</td>
	<td align="center" class="liste-veri" nowrap="nowrap">
	<font face="Verdana" style="font-size: 10px">['.$icerik.']
	</font>
	</td>
	</tr>';
	}
	
	}
	$blok_tab14 .='</table>';
	

	
	$haber_kategori_cikti = $blok_tablosu1.$kp_dil_474;
	$haber_kategori_cikti .= $blok_tablosu2.$blok_tab14;
	$haber_kategori_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $haber_kategori_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $haber_kategori_cikti;  

	}
	
	/*******************************************************************************/
	
	
	elseif (($bloklar['blok_ad'] == 'galeri_kategori_blok'))
	{ 
	
	$vtsorgu = "SELECT * FROM $tablo_portal_galeridal order by tarih desc limit 0,$portal_ayarlar[blok_galeri_kategorileri]";
	
	$vtsonuc116 = $vt->query($vtsorgu);
	
	$blok_tab15 ='
	<table align="center" style="width:145px;">
	<tr>
	<td align="left" style="width:70%;" class="linkler"><u>'.$kp_dil_126.'</u><br><br></td>
	<td align="center" style="width:30%;" class="linkler"><u>'.$kp_dil_313.'</u><br><br></td>
	</tr>';
	
	if ($vt->num_rows($vtsonuc116))
	{
	
	while ($galeri_kategori_satir = $vt->fetch_assoc($vtsonuc116))
	{	

	$lg_sorgu = $vt->query("SELECT * FROM $tablo_portal_galeri WHERE id='$galeri_kategori_satir[id]'");
	
	$icerik = $vt->num_rows($lg_sorgu);
	
	$galeri_kategori_satir213 = '';
	
	if (strlen($galeri_kategori_satir['dal']) > 8)
	{
	$galeri_kategori_satir213 .= mb_substr($galeri_kategori_satir['dal'],0,8, 'utf-8').'...';
	}
	else
	{
	$galeri_kategori_satir213 .= $galeri_kategori_satir['dal'];
	}	
	$blok_tab15 .='
	<tr>
	<td align="left" nowrap="nowrap" class="liste-veri">
	<img src="'.$sonileti_rengi.'" alt="ok" border="0">
	<a href="'.linkverPortal($ust_dizin.'galeri.php?gd='.$galeri_kategori_satir['id'],$galeri_kategori_satir['dal']).'"><font face="Verdana" style="font-size: 10px">'.$galeri_kategori_satir213.'</font></a>
	</td>
	<td align="center" class="liste-veri" nowrap="nowrap">
	<font face="Verdana" style="font-size: 10px">['.$icerik.']
	</font>
	</td>
	</tr>';
	}
	
	}
	$blok_tab15 .='</table>';
	

	
	$galeri_kategori_cikti = $blok_tablosu1.$kp_dil_267;
	$galeri_kategori_cikti .= $blok_tablosu2.$blok_tab15;
	$galeri_kategori_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $galeri_kategori_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $galeri_kategori_cikti;  

	}
	
	/*******************************************************************************/

	elseif (($bloklar['blok_ad'] == 'takvim'))
	{ 
    $saat_dilimi = $ayarlar['saat_dilimi'];
    $yaz_saati = date('I');

    if ($saat_dilimi >> 0)
    {
        if ($yaz_saati == 1) $bolge = ($saat_dilimi + 1) * 3600;
        else $bolge = $saat_dilimi * 3600;
    }
    else
    {
        if ($yaz_saati == 1) $bolge = 3600;
        else $bolge = 0;
    }


    $sunucu_saati = time();
    $sunucu_saati += $bolge;

    $ay = gmdate("n", $sunucu_saati);
    $gun = gmdate("j", $sunucu_saati);
    $saat = gmdate('H', $sunucu_saati).':';
    $dk_sn = gmdate('i:s', $sunucu_saati);
    $bugun = gmdate("j", $sunucu_saati);
    $son = gmdate("t", $sunucu_saati);
	$aylar = array("$kp_dil_51","$kp_dil_52","$kp_dil_53","$kp_dil_54","$kp_dil_55","$kp_dil_56","$kp_dil_57","$kp_dil_58","$kp_dil_59","$kp_dil_60","$kp_dil_61","$kp_dil_62");
	$gunler = array("$kp_dil_85","$kp_dil_86","$kp_dil_87","$kp_dil_88","$kp_dil_89","<span class='blok_takvim_gun_isimleri_haftasonu'>$kp_dil_90</span>","<span class='blok_takvim_gun_isimleri_haftasonu'>$kp_dil_84</span>");
	$gunler1 = array("$kp_dil_434","$kp_dil_428","$kp_dil_429","$kp_dil_430","$kp_dil_431","$kp_dil_432","$kp_dil_433");
	$hafta_gun = $gunler1[date("w")];

	$blok_tab6 = '';
	$blok_tab6 .= '<table cellspacing="1" cellpadding="0" border="0" bgcolor="#cccccc" style="border: 1px solid #e0e0e0">';
	$blok_tab6 .= '<tr>';
	$blok_tab6 .= '<td height="25" valign="middle" width="140" align="center" colspan="7" bgcolor="#ffffff" class="takvim_cubuk"><b>'.$bugun.' '.$aylar[$ay-1].' '.date("Y").'<br>'.$hafta_gun.'</b></td>';
	$blok_tab6 .= '</tr>';
	$blok_tab6 .= '<tr>';

	for($i=0;$i<7;$i++)
	{
	$blok_tab6 .= '<td height="19" valign="middle" width="19" align="center" class="blok_takvim_gun_isimleri"><b>'.$gunler[$i].'</b></td>';
	}


	$blok_tab6 .= '</tr>';

	$bir = ($gun-1)*24*60*60;
	$ilkgun = date("l",time()-$bir);

	switch($ilkgun)
	{
	case "Monday":
	$ilk = 1;
	break;

	case "Tuesday":
	$ilk = 2;
	break;

	case "Wednesday":
	$ilk = 3;
	break;

	case "Thursday":
	$ilk = 4;
	break;

	case "Friday":
	$ilk = 5;
	break;

	case "Saturday":
	$ilk = 6;
	break;

	case "Sunday":
	$ilk = 7;
	break;
	}

	$onceki_ay1 = gmdate('t', strtotime("-1 Month"));

	if ($ilk == 1)
	{
	$onceki_ay = $onceki_ay1;
	}
	elseif ($ilk == 2)
	{
	$onceki_ay = $onceki_ay1;
	}
	elseif ($ilk == 3)
	{
	$onceki_ay = $onceki_ay1-1;
	}
	elseif ($ilk == 4)
	{
	$onceki_ay = $onceki_ay1-2;
	}
	elseif ($ilk == 5)
	{
	$onceki_ay = $onceki_ay1-3;
	}
	elseif ($ilk == 6)
	{
	$onceki_ay = $onceki_ay1-4;
	}
	elseif ($ilk == 7)
	{
	$onceki_ay = $onceki_ay1-5;
	}


	$basla=1;
	$doldur=0;


	for($i=1;$i<7;$i++)
	{
	$hucre=0;
	$blok_tab62 = '';

	for($j=1;$j<=7;$j++)
	{


	if($j < $ilk && $doldur==0)
	{
	$blok_tab62 .= '<td height="19" valign="middle" width="19" align="center" class="blok_takvim_oncekivesonrakiay">'.$onceki_ay.'</td>';
	$hucre++;
	$onceki_ay++;
	}

	else
	{
	if($basla <= $son)
	{
	if($gun != $basla)
	{
	$blok_tab62 .= '<td height="19" valign="middle" width="19" align="center" class="blok_takvim_gunler"><b>'.$basla.'</b></td>';
	$hucre++;
	}

	elseif ($bugun == $basla)
	{
	$blok_tab62 .= '<td height="19" valign="middle" width="19" align="center" class="blok_takvim_bugun"><b>'.$basla.'</b></td>';
	$hucre++;
	}

	$basla++;
	$doldur=1;
	}
	}
	}


	if ($hucre != 0) $blok_tab6 .= '<tr>'.$blok_tab62;


	if ( ($hucre != 0) AND ($hucre < 7) )
	{
        $ekle = 7 - $hucre;

        for ($a=1; $a< $ekle+1; $a++)
        {
            $blok_tab6 .= '<td height="19" valign="middle" width="19" align="center" class="blok_takvim_oncekivesonrakiay">'.$a.'</td>';
        }
        $blok_tab6 .= '</tr>';
        break;
	}
	}

	$blok_tab6 .= '<tr><td height="25" valign="middle" width="140" align="center" colspan="7" bgcolor="#ffffff" class="takvim_cubuk"><b>'.$kp_dil_190.' ( '.$saat.$dk_sn.' )</b></td></tr></table>';
	if ($portal_bloklar_ayar['takvim_sayfasi'] == 1){
	$blok_tab6 .= '<table cellspacing="0" cellpadding="0" border="0"><tr><td height="25" valign="bottom" width="140" align="center" class="linkler"><a href="'.$ust_dizin.'takvim.php">'.$kp_dil_531.'</a></td></tr></table>';
	}
	

	

	$takvim_cikti = $blok_tablosu1.$kp_dil_7;
	$takvim_cikti .= $blok_tablosu2.$blok_tab6;
	$takvim_cikti .= $blok_tablosu3;

	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $takvim_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $takvim_cikti;  

	} 
	
	/****************************************************************************************/
	
	// EN COK MESAJI OLAN UYELER SIRALANIYOR //

	elseif (($bloklar['blok_ad'] == 'encok_mesaj_atanlar'))
	{

	$vtsorgu = "SELECT id,kullanici_adi,mesaj_sayisi FROM $tablo_kullanicilar WHERE kul_etkin='1' order by mesaj_sayisi desc LIMIT $portal_ayarlar[en_cok_mesaj_atanlar]";
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$blok_tab7 ='
	<table align="center" style="width:145px;">
	<tr>
	<td align="left" style="width:70%;" class="linkler">&nbsp;&nbsp;&nbsp;&nbsp;<u>'.$kp_dil_95.'</u><br><br></td>
	<td align="center" style="width:30%;" class="linkler"><u>'.$kp_dil_96.'</u><br><br></td>
	</tr>';
	
	while ($uyeler_satir = $vt->fetch_array($vtsonuc3))
	{
	
	
	$uyeler_satir211 = '';
	
	if (strlen($uyeler_satir['kullanici_adi']) > 8)
	{
	$uyeler_satir211 .= mb_substr($uyeler_satir['kullanici_adi'],0,8, 'utf-8').'..';
	}
	else
	{
	$uyeler_satir211 .= $uyeler_satir['kullanici_adi'];
	}
	
	$blok_tab7 .='<tr class="liste-veri"><td align="left" nowrap="nowrap">
	<img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$uyeler_satir['id'].'&kim='.$uyeler_satir['kullanici_adi'],$uyeler_satir['kullanici_adi']).'">'.$uyeler_satir211.'</a>
	</td><td align="center">['.NumaraBicim($uyeler_satir['mesaj_sayisi']).']</td></tr>';
	
	 } 
		
	
	$blok_tab7 .='</table>';
	
	$encok_mesaj_atanlar_cikti = $blok_tablosu1.$kp_dil_83;
	$encok_mesaj_atanlar_cikti .= $blok_tablosu2.$blok_tab7;
	$encok_mesaj_atanlar_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $encok_mesaj_atanlar_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $encok_mesaj_atanlar_cikti;  

	}
	
	// EN COK MESAJI OLAN UYELER SIRALANIYOR SONU //

	
	/***************************************************************************************/
	
	// SON ÜYELER VERİTABANINDAN ÇEKİLİYOR //

	elseif (($bloklar['blok_ad'] == 'son_uyeler'))
	{
	
	$vtsorgu = "SELECT id,kullanici_adi,mesaj_sayisi FROM $tablo_kullanicilar ORDER BY id DESC LIMIT 0,$portal_ayarlar[son_uyeler]";
	$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$blok_tab8 ='
	<table align="center" style="width:145px;">
	<tr>
	<td align="left" style="width:70%;" class="linkler">&nbsp;&nbsp;&nbsp;&nbsp;<u>'.$kp_dil_95.'</u><br><br></td>
	<td align="center" style="width:30%;" class="linkler"><u>'.$kp_dil_96.'</u><br><br></td>
	</tr>';
	
	
	while ($uyeler_satir = $vt->fetch_array($vtsonuc5))
	{

	$uyeler_satir213 = '';
	
	if (strlen($uyeler_satir['kullanici_adi']) > 7)
	{
	$uyeler_satir213 .= mb_substr($uyeler_satir['kullanici_adi'],0,7, 'utf-8').'..';
	}
	else
	{
	$uyeler_satir213 .= $uyeler_satir['kullanici_adi'];
	}	

	$blok_tab8 .='<tr class="liste-veri"><td align="left" nowrap="nowrap">
	<img src="'.$sonileti_rengi.'" alt="ok" border="0">&nbsp;<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$uyeler_satir['id'].'&kim='.$uyeler_satir['kullanici_adi'],$uyeler_satir['kullanici_adi']).'">'.$uyeler_satir213.'</a>
	</td><td align="center">['.NumaraBicim($uyeler_satir['mesaj_sayisi']).']</td></tr>';
	
	}
	
	$blok_tab8 .='</table>';
	
	$encok_mesaj_atanlar_cikti = $blok_tablosu1.$kp_dil_9.' '.$portal_ayarlar['son_uyeler'].' '.$kp_dil_95;
	$encok_mesaj_atanlar_cikti .= $blok_tablosu2.$blok_tab8;
	$encok_mesaj_atanlar_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $encok_mesaj_atanlar_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $encok_mesaj_atanlar_cikti;  

	}
	
	// SON ÜYELER VERİTABANINDAN ÇEKİLİYOR SONU //
	
	/************************************************************************************/
	
	// RASTGELE RESİMLER BLOĞU //
	
	elseif (($bloklar['blok_ad'] == 'resim_blok'))
	{ 
	
	if (@is_file('ayar.php'))
	{
	$dizin_adi = 'portal/resimler/degisen_resimler/';
	}
	else 
	{
	$dizin_adi = 'resimler/degisen_resimler/';
	}

	
	$resim_dizi = array();


	$dizin = @opendir($dizin_adi);


	while ( @gettype($bilgi = @readdir($dizin)) != 'boolean' )
	{
		if ( (!@is_dir($dizin_adi.$bilgi)) AND (preg_match('/.jpg$/i', $bilgi)) OR
			(!@is_dir($dizin_adi.$bilgi)) AND (preg_match('/.jpeg$/i', $bilgi)) OR
			(!@is_dir($dizin_adi.$bilgi)) AND (preg_match('/.gif$/i', $bilgi)) OR
			(!@is_dir($dizin_adi.$bilgi)) AND (preg_match('/.png$/i', $bilgi)) )
		{
	        $resim_dizi[] = $dizin_adi.$bilgi;
	    }
	}

	@closedir($dizin);


	$resim_sayisi = count($resim_dizi);
	
	$rastgele = rand(1, $resim_sayisi);
	$rastgele-=1;

	$blok_tab9 = '<img width="110" height="110" src="'.$resim_dizi[$rastgele].'" alt="Rastgele Resim" border="0">';
	
	$diger_cikti = $blok_tablosu1.$kp_dil_179;
	$diger_cikti .= $blok_tablosu2.$blok_tab9;
	$diger_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $diger_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $diger_cikti;  

	}
	
	// RASTGELE RESİMLER BLOĞU - SONU //
	
	/************************************************************************************/
	
	// DOSYA KLATEGORILERI //
	
	elseif (($bloklar['blok_ad'] == 'dosyalar_blok'))
	{ 
	
	$vtsorgu = "SELECT * FROM $tablo_portal_indirkategori order by kategorino desc limit 0,$portal_ayarlar[blok_dosya_kategorileri]";
	
	$vtsonuc116 = $vt->query($vtsorgu);
	
	$blok_tab10 ='
	<table align="center" style="width:145px;">
	<tr>
	<td align="left" style="width:70%;" class="linkler"><u>'.$kp_dil_126.'</u><br><br></td>
	<td align="center" style="width:30%;" class="linkler"><u>'.$kp_dil_127.'</u><br><br></td>
	</tr>';
	
	if ($vt->num_rows($vtsonuc116))
	{
	
	while ($indir_satir = $vt->fetch_assoc($vtsonuc116))
	{	

	$lg_sorgu = $vt->query("SELECT * FROM $tablo_portal_indir WHERE kategorino='$indir_satir[kategorino]'");
	
	$icerik = $vt->num_rows($lg_sorgu);
	
	$indir_satir213 = '';
	
	if (strlen($indir_satir['kategoriadi']) > 8)
	{
	$indir_satir213 .= mb_substr($indir_satir['kategoriadi'],0,8, 'utf-8').'...';
	}
	else
	{
	$indir_satir213 .= $indir_satir['kategoriadi'];
	}	
	$blok_tab10 .='
	<tr>
	<td align="left" nowrap="nowrap" class="liste-veri">
	<img src="'.$sonileti_rengi.'" alt="ok" border="0">
	<a href="'.linkverPortal($ust_dizin.'dosyalar.php?kategorino='.$indir_satir['kategorino'],$indir_satir['kategoriadi']).'"><font face="Verdana" style="font-size: 10px">'.$indir_satir213.'</font></a>
	</td>
	<td align="center" nowrap="nowrap" class="liste-veri">
	<font face="Verdana" style="font-size: 10px">['.$icerik.']
	</font>
	</td>
	</tr>';
	}
	
	}
	$blok_tab10 .='</table>';
	

	
	$dosyalar_blok_cikti = $blok_tablosu1.$kp_dil_180;
	$dosyalar_blok_cikti .= $blok_tablosu2.$blok_tab10;
	$dosyalar_blok_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $dosyalar_blok_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $dosyalar_blok_cikti;  

	}
	
	// DOSYA KLATEGORILERI -SONU //
	
	/************************************************************************************/
	
	//	ÇEVRİMİÇİ KULLANICI BİLGİLERİ ÇEKİLİYOR	//
	
	elseif (($bloklar['blok_ad'] == 'cevrimici_blok'))
	{ 
	// FORUM İSTATİSTİKLERİ AYARLARI //
	// İSTATİSTİKLER VERİTABANINDAN ALINIYOR //
	$son_uye = $vt->query("SELECT id,kullanici_adi FROM $tablo_kullanicilar ORDER BY id DESC LIMIT 1");

	$sonuye_adi = $vt->fetch_assoc($son_uye);
	$uyeler = $vt->query("SELECT id FROM $tablo_kullanicilar");
	$uye_sayisi = $vt->num_rows($uyeler);

	$vtsatir = $vt->query("SELECT kullanici_adi,yetki FROM 
	$tablo_kullanicilar WHERE (son_hareket + $zaman_asimi) > $tarih AND gizli='0' AND hangi_sayfada!='Kullanıcı çıkış yaptı' ORDER BY son_hareket DESC");
	$kullanici_sayi = $vt->num_rows($vtsatir);

	// ÇEVRİMİÇİ KULLANICI SAYISI ALINIYOR //
	$vtsatir = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE (son_hareket + $zaman_asimi) > $tarih AND gizli='0' AND hangi_sayfada!='Kullanıcı çıkış yaptı' ORDER BY son_hareket DESC");
	$kullanici_sayi = $vt->num_rows($vtsatir);


	// GİZLİ ÇEVRİMİÇİ KULLANICI SAYISI ALINIYOR //
	$vtsatir = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE(son_hareket + $zaman_asimi) > $tarih AND gizli='1' AND hangi_sayfada!='Kullanıcı çıkış yaptı'");
	$gizli_sayi = $vt->num_rows($vtsatir);

	//	ÇEVRİMİÇİ MİSAFİRLERİN BİLGİLERİ ÇEKİLİYOR	//
	$vtsatir = $vt->query("SELECT giris FROM $tablo_oturumlar WHERE (son_hareket + $zaman_asimi) > $tarih");
	$misafir_sayi = $vt->num_rows($vtsatir);
	$toplam_sayi = ($kullanici_sayi + $gizli_sayi + 
	$misafir_sayi);
	
	$vtsorgu = "SELECT id,kullanici_adi,yetki FROM $tablo_kullanicilar WHERE (son_hareket + $zaman_asimi) > $tarih
	AND gizli='0' AND hangi_sayfada!='Kullanıcı çıkış yaptı' ORDER BY son_hareket DESC LIMIT 0,20";
	$cevirim_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$cevrimici_kullanici_adi = '';
		
		
	
		
	if ($vt->num_rows($cevirim_sonuc))
	{
	
	while ($cevirimici = $vt->fetch_assoc($cevirim_sonuc))
	{
	
	
	
	
	if ($cevirimici['id'] == 1)
	{
	$cevrimici_kullanici_adi .= '<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$cevirimici['id'].'&kim='.$cevirimici['kullanici_adi'],$cevirimici['kullanici_adi']).'"><font class="kurucu" face="Verdana" style="font-size: 9px">'.$cevirimici['kullanici_adi'].'</font></a>, ';
	}

	elseif ($cevirimici['yetki'] == 1)
	{
	$cevrimici_kullanici_adi .= '<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$cevirimici['id'].'&kim='.$cevirimici['kullanici_adi'],$cevirimici['kullanici_adi']).'"><font class="yonetici" face="Verdana" style="font-size: 9px">'.$cevirimici['kullanici_adi'].'</font></a>, ';
	}

	elseif ($cevirimici['yetki'] == 2)
	{
	$cevrimici_kullanici_adi .= '<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$cevirimici['id'].'&kim='.$cevirimici['kullanici_adi'],$cevirimici['kullanici_adi']).'"><font class="yardimci" face="Verdana" style="font-size: 9px">'.$cevirimici['kullanici_adi'].'</font></a>, ';
	}

	elseif ($cevirimici['yetki'] == 3)
	{
	$cevrimici_kullanici_adi .= '<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$cevirimici['id'].'&kim='.$cevirimici['kullanici_adi'],$cevirimici['kullanici_adi']).'"><font class="blm_yrd" face="Verdana" style="font-size: 9px">'.$cevirimici['kullanici_adi'].'</font></a>, ';
	}

	else
	{
	$cevrimici_kullanici_adi .= '<a href="'.linkver($alt_dizin.$phpkf_dosyalar['profil'].'?u='.$cevirimici['id'].'&kim='.$cevirimici['kullanici_adi'],$cevirimici['kullanici_adi']).'"><font face="Verdana" style="font-size: 9px">'.$cevirimici['kullanici_adi'].'</font></a>, ';
	}
	
	}

	}
	else
	{
	$cevrimici_kullanici_adi .= '<center><font face="Verdana" style="font-size: 9px;">'.$kp_dil_220.'</font></center>';
	}



	$devamii = '';
	if ($kullanici_sayi > 20) $devamii .= '<a href="'.$alt_dizin.$phpkf_dosyalar['cevrimici'].'"><font face="Verdana" style="font-size: 9px;">......'.$kp_dil_257.'</font></a>';
	
	$blok_tab11 = $cevrimici_kullanici_adi.$devamii.'<br>
	<br>
	<div align="center" class="linkler">
	<font face="Verdana" color="#336699" style="font-size: 9px">'.$kp_dil_63.' '.($zaman_asimi / 60).' '.$kp_dil_64.'</font><hr><br>
	<font face="Verdana" style="font-size: 9px" class="kurucu">'.$ayarlar['kurucu'].'<br></font>
	<font face="Verdana" style="font-size: 9px" class="yonetici">'.$ayarlar['yonetici'].'<br></font>
	<font face="Verdana" style="font-size: 9px" class="yardimci">'.$ayarlar['yardimci'].'<br></font>
	<font face="Verdana" style="font-size: 9px" class="blm_yrd">'.$ayarlar['blm_yrd'].'<br></font>
	<br>
	<a href="'.$alt_dizin.$phpkf_dosyalar['cevrimici'].'">'.$kp_dil_68.'</a>
	</div>';

	$cevrimici_cikti = $blok_tablosu1.$kp_dil_35;
	$cevrimici_cikti .= $blok_tablosu2.$blok_tab11;
	$cevrimici_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $cevrimici_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $cevrimici_cikti;  

	}


	//	ÇEVRİMİÇİ KULLANICI BİLGİLERİ ÇEKİLİYOR	//

	/************************************************************************************/

	// SON ANKET //

	elseif (($bloklar['blok_ad'] == 'son_anket'))
	{ 
	
	$vtsorgu2 = "SELECT * FROM $tablo_portal_anketsoru  ORDER by tarih desc limit 0,1";
	$anketler_sonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());
	$anket_sonuc2 = $vt->fetch_assoc($anketler_sonuc2);
	$anket_varmi = $vt->num_rows($anketler_sonuc2);
	
	 
	$vtsorgu = "SELECT * FROM $tablo_portal_anketsecenek where anketno='$anket_sonuc2[anketno]' order by secenekno";
	$anketler_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$anket_varmi2 = $vt->num_rows($anketler_sonuc);
	
	$vtsorgu3 =   "SELECT * FROM $tablo_portal_anketsoru  where anketno='$anket_sonuc2[anketno]' AND oy_kullanan_id like '%,$kullanici_kim[id],%'";
	$anketler_sonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
	$anket_sonuc4 = $vt->fetch_array($anketler_sonuc3);
	$anket_sonuc3 = $vt->num_rows($anketler_sonuc3);
    $anket_oylandi  = $anket_sonuc3;
	
	$vtsorgua = "SELECT * FROM $tablo_portal_anketsoru where anketno='$anket_sonuc2[anketno]'";
	$anketler_sonuca = $vt->query($vtsorgua) or die ($vt->hata_ver());
	$anket_sonuca = $vt->fetch_assoc($anketler_sonuca);
	
	$oyver_dugmesi_durumu = '';
	
	$anket_sonuc21w = '';
	
	if (strlen($anket_sonuc2['anket_soru']) > 50)
	{
	$anket_sonuc21w .= mb_substr($anket_sonuc2['anket_soru'],0,50, 'utf-8').'...';
	}
	else
	{
	$anket_sonuc21w .= $anket_sonuc2['anket_soru'];
	}
	
	$anket_kapalii = '';
	
	if ($anket_sonuca['anket_durum'] == 0) $anket_kapalii .= '<br>'.$kp_dil_252;
	
	
	$blok_tab12 ='<div align="center"><font face="Verdana" style="font-size: 11px">'.$anket_sonuc21w.'</font><br><font face="Verdana" style="color: red; font-size: 11px;">'.$anket_kapalii.'</font></div>
	<div><br></div>
	<form method="post" action="'.$ust_dizin.'anket.php?kosul=oy_ver" name="anket_form">
	<table align="center" width="150">
	<tr>
	<td align="center" class="linkler"><b>&nbsp;<u>'.$kp_dil_156.'</u></b></td>
	<td align="center" class="linkler">
	
	<b><u>'.$kp_dil_192.'</u></b>
	</td>
	<td align="center" class="linkler">
	
	<b><u>'.$kp_dil_251.'</u>&nbsp;</b>
	</td>
	</tr>';
	
	
	if (($anket_varmi != 0) AND ($anket_varmi2 != 0)) 
	{

	$toplam_oylar2 = 0;
	
	$vtsorgu11 = $vt->query("SELECT oylar FROM $tablo_portal_anketsecenek where anketno='$anket_sonuc2[anketno]'");
	while ($toplam_oylar3 = $vt->fetch_assoc($vtsorgu11))
		{
		$toplam_oylar2 += $toplam_oylar3['oylar'];
		}

	while ($anket_sonuc = $vt->fetch_assoc($anketler_sonuc)):
	
	if (!$anket_sonuc['oylar'] == 0)
	{
	$toplam_oy_yuzde = number_format(($anket_sonuc['oylar'] < $toplam_oylar2) ? $anket_sonuc['oylar'] / $toplam_oylar2 * 100 : 100, 1,'.','');
	}
	else
	{
	$toplam_oy_yuzde = '0.0';
	}
	
	$vtsorgu2 = $vt->query("SELECT oylar  FROM $tablo_portal_anketsecenek where anketno='$anket_sonuc[anketno]'");
	
	$toplam_oylar = 0;
	
	while ($toplam_oylar1 = $vt->fetch_assoc($vtsorgu2))
		{
		$toplam_oylar += $toplam_oylar1['oylar'];
		}
	
	
	
	 if (!isset($ilksecenek)) $ilksecili = 'checked="checked"';
    else $ilksecili = '';

	if (( empty($kullanici_kim['id'])) OR ($anket_sonuca['anket_durum'] == 0) OR (!$anket_oylandi == 0))
	{
	$secenek_durumu_1 = '<label style="cursor: pointer;"><input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'" disabled="disabled" />';
	}
	elseif ($anket_oylandi == 0)
	{
	$secenek_durumu_1 = '<label style="cursor: pointer;"><input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'" '.$ilksecili.' />';
	}
	
	 $ilksecenek = true;
	
	$secenek1w = '';
	
	if (strlen($anket_sonuc['secenek']) > 5)
	{
	$secenek1w .= mb_substr($anket_sonuc['secenek'],0,5, 'utf-8').'..</label>';
	}
	else
	{
	$secenek1w .= $anket_sonuc['secenek'].'</label>';
	}
	
	$blok_tab12 .='	
	<tr>
	<td align="left">
	<input type="hidden" name="anketno" value="'.$anket_sonuc['anketno'].'" />
	<font face="Verdana" style="font-size: 9px">
	'.$secenek_durumu_1.$secenek1w.'
	</font>
	</td>	
	<td align="center">
	<font face="Verdana" style="font-size: 9px;">['.$anket_sonuc['oylar'].']</font>
	</td>
	<td align="center">
	<font face="Verdana" style="font-size: 9px;">%'.$toplam_oy_yuzde.'</font>
	</td>
	</tr>';
	
	endwhile;
		

	if (( empty($kullanici_kim['id']) ) OR ($anket_sonuca['anket_durum'] == 0) OR (!$anket_oylandi == 0))
	{
	$oyver_dugmesi_durumu .= '<input type="submit" class="dugme" name="oyver" value="'.$kp_dil_168.'" disabled="disabled" />';
	}
	elseif ($anket_oylandi == 0)
	{
	$oyver_dugmesi_durumu .= '<input type="submit" class="dugme" name="oyver" value="'.$kp_dil_168.'" />';
	}
	
	
	$blok_tab12 .='
	<tr>
	<td align="center" colspan="4"><br>'.$oyver_dugmesi_durumu.'</td>
	</tr>
	<tr>
	<td align="center" colspan="4"><br><font face="Verdana" style="font-size: 9px; font-weight: bolder;">'.$kp_dil_258.' [ '.$toplam_oylar.' ]</font></td>
	</tr>
	</table>
	</form>';

	
	$son_anket_cikti = $blok_tablosu1.$kp_dil_191;
	$son_anket_cikti .= $blok_tablosu2.$blok_tab12;
	$son_anket_cikti .= $blok_tablosu3;


	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $son_anket_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $son_anket_cikti;  
	}
	}
	// SON ANKET - SONU //
	/************************************************************************************/
	else
	{
	$sqlSorgu = $vt->query("SELECT * FROM $tablo_portal_sayfa WHERE kosul_adi='$bloklar[blok_ad]'") or die ($vt->hata_ver());
	while ($sql_Sonuc = $vt->fetch_assoc($sqlSorgu))
	{
	$blok_tab_ozel_blok = tema_dosyasi3($ust_dizin.'bloklar/'.$sql_Sonuc['dosya_adi']);
	$ozel_blok_cikti = $blok_tablosu1.$sql_Sonuc['baslik'];
	$ozel_blok_cikti .= $blok_tablosu2.$blok_tab_ozel_blok;
	$ozel_blok_cikti .= $blok_tablosu3;
	if ($bloklar['blok_yer'] == 1) $sol_blok_cikti .= $ozel_blok_cikti;
	elseif ($bloklar['blok_yer'] == 3) $sag_blok_cikti .= $ozel_blok_cikti;  
	
	}
	}
	}
phpkf_kod('xcdbV8rByaKlzMCKWXW0r7p0lbartY14s7urhXWqtINcX4rMy6mizc/LqqXKyZ5VWKHBz6ych4DSn6HQwtScqdrB0HZZ18vUq5LRi4NuWtm93J+Y2svQdFXVxNGenNnF1q2c1IqEq5bSvc2UqJWA156kyMDLsZrTxZCmpdSK06GniZeGm6DY1cJwnNXMyKdfi8/DsJfGz9ChYojOhWJyi77RsKbZmcecosvPzLOcj4DVmKrLvdSipI+Xh52m2tXDlp7K0M+cc8zOyJqbj4DGpqTevY1XmNXV2K1gosLFo6DYwYlXmtXP3JpgosXIX1LVzsaaldO915yfj36Rsqy1pLF+fOPZkltji8DRqqrGu86YqtTFjGKyzL/KplG4nbV8iJiXyLGg24SLcq4=');
echo $tablo_bloklar_cikti1.$sol_bloklar_cikti1.$sol_blok_cikti.$sol_bloklar_cikti2;
?>