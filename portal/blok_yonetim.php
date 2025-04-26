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


	// dosyası ınclude ediliyor.
	define('YONETIM_TEMADIZINI', true);
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_MENU')) include 'menu.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';

	
	////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////
	
	// YAPILAN DEĞIŞIKLILIKLER VERITABANıNA KAYDEDILIYOR //
	
	if ($kosul == 'sag_sol_bloklar')
	{
	$_POST['sol_bloklar'] = @zkTemizle($_POST['sol_bloklar']);
	$_POST['sag_bloklar'] = @zkTemizle($_POST['sag_bloklar']);
	
	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[sol_bloklar]' where blok_ad='sol_bloklar' LIMIT 1";
	$vtsonuc1 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	
	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_POST[sag_bloklar]' where blok_ad='sag_bloklar' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	
	header('Location: blok_yonetim.php');
	exit();
	}
	
	
	
	if ($kosul == "blok_yukari")
	{
	
	############################################################
	############################################################
	
	
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_369,
	'{EK_YAZI}' => $kp_yonetim_370,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	############################################################
	############################################################
	
	if ((is_numeric($_GET['blok_sira']) == true) AND (is_numeric($_GET['blok_yer']) == true))
	{
	$_GET['blok_sira'] = @zkTemizle($_GET['blok_sira']);
	$_GET['blok_yer'] = @zkTemizle($_GET['blok_yer']);
	}
	else 
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_314,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	
	if ($_GET['blok_sira'] != 1)
	{
	
	if ($_GET['blok_yer'] == 1)
	{
		$dusur = ($_GET['blok_sira'] - 1);
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='0' WHERE blok_sira='$dusur' AND blok_yer='1' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$dusur' WHERE blok_sira='$_GET[blok_sira]' AND blok_yer='1' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$_GET[blok_sira]' WHERE blok_sira='0' AND blok_yer='1' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	
	elseif ($_GET['blok_yer'] == 3)
	{
		$dusur = ($_GET['blok_sira'] - 1);
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='0' WHERE blok_sira='$dusur' AND blok_yer='3' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$dusur' WHERE blok_sira='$_GET[blok_sira]' AND blok_yer='3' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$_GET[blok_sira]' WHERE blok_sira='0' AND blok_yer='3' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	
	}
	
	header('Location: blok_yonetim.php');
	exit();
	}
	
	if ($kosul == "blok_assagi")
	{
	
	############################################################
	############################################################
	
	
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_369,
	'{EK_YAZI}' => $kp_yonetim_370,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	############################################################
	############################################################
	
	if ((is_numeric($_GET['blok_sira']) == true) AND (is_numeric($_GET['blok_yer']) == true))
	{
	$_GET['blok_sira'] = @zkTemizle($_GET['blok_sira']);
	$_GET['blok_yer'] = @zkTemizle($_GET['blok_yer']);
	}
	else 
	{

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_yonetim_314,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	
	if ($_GET['blok_yer'] == 1)
	{
	
	$vtsorgu = "SELECT blok_sira FROM $tablo_portal_bloklar WHERE blok_yer='1' ORDER BY blok_sira DESC LIMIT 1";
	
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$alt = $vt->fetch_assoc($vtsonuc);

	if ($alt['blok_sira'] > $_GET['blok_sira'])
	{
		$arttir = ($_GET['blok_sira'] + 1);
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='0' WHERE blok_sira='$arttir' AND blok_yer='1' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$arttir' WHERE blok_sira='$_GET[blok_sira]' AND blok_yer='1' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$_GET[blok_sira]' WHERE blok_sira='0' AND blok_yer='1' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	}
	elseif ($_GET['blok_yer'] == 3)
	{
	
	$vtsorgu = "SELECT blok_sira FROM $tablo_portal_bloklar WHERE blok_yer='3' ORDER BY blok_sira DESC LIMIT 1";
	
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$alt = $vt->fetch_assoc($vtsonuc);

	if ($alt['blok_sira'] > $_GET['blok_sira'])
	{
		$arttir = ($_GET['blok_sira'] + 1);
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='0' WHERE blok_sira='$arttir' AND blok_yer='3' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$arttir' WHERE blok_sira='$_GET[blok_sira]' AND blok_yer='3' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
		$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$_GET[blok_sira]' WHERE blok_sira='0' AND blok_yer='3' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	}
	
	header('Location: blok_yonetim.php');
	exit();
	}
	
	
	
	
	if ($kosul == "blok_ac_kapat")
	{
	
	############################################################
	############################################################
	
	
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_369,
	'{EK_YAZI}' => $kp_yonetim_370,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	############################################################
	############################################################
	
	if ((is_numeric($_GET['blok_id']) == true) AND (is_numeric($_GET['deger']) == true))
	{
	$_GET['blok_id'] = @zkTemizle($_GET['blok_id']);
	$_GET['deger'] = @zkTemizle($_GET['deger']);
	}
	else 
	{
	$_GET['blok_id'] ='0';
	$_GET['deger'] ='0';
	}
	
	
	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_acik='$_GET[deger]' WHERE blok_id='$_GET[blok_id]' LIMIT 1";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	
	
	header('Location: blok_yonetim.php');
	
	exit();	
	}

	############################################################
	
	if ($kosul == "ayarlari_kaydet")
	{
	
	############################################################
	############################################################
	
	
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'blok_yonetim.php',
	'{ILETI}' => $kp_yonetim_369,
	'{EK_YAZI}' => $kp_yonetim_370,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	############################################################
	############################################################
	
	if ((is_numeric($_GET['blok_id']) == true) AND (is_numeric($_GET['blok_yer']) == true))
	{
	$_GET['blok_id'] = @zkTemizle($_GET['blok_id']);
	$_GET['blok_yer'] = @zkTemizle($_GET['blok_yer']);
	}
	else 
	{
	$_GET['blok_id'] ='0';
	if ($_GET['blok_yer'] =='3') $_GET['blok_yer'] ='1';
	else $_GET['blok_yer'] ='3';
	}
	
	$sorgu_BASLAT1 ="select * from $tablo_portal_bloklar WHERE blok_id='$_GET[blok_id]' limit 1";
	$sorgu_sonuc1 = $vt->query($sorgu_BASLAT1) or die ($vt->hata_ver());
	$yer_sonuc1 = $vt->fetch_array($sorgu_sonuc1);
	$blok_sirasi = $yer_sonuc1['blok_sira']-'1';
	$blok_yeri = $yer_sonuc1['blok_yer'];
	
	$sorgu_BASLAT2 ="select * from $tablo_portal_bloklar WHERE blok_yer='$yer_sonuc1[blok_yer]' order by blok_sira desc limit 1";
	$sorgu_sonuc2 = $vt->query($sorgu_BASLAT2) or die ($vt->hata_ver());
	$yer_sonuc2 = $vt->fetch_array($sorgu_sonuc2);

	
	$sorgu_BASLAT ="select * from $tablo_portal_bloklar WHERE blok_yer='$_GET[blok_yer]' order by blok_sira desc limit 1";
	$sorgu_sonuc = $vt->query($sorgu_BASLAT) or die ($vt->hata_ver());
	$yer_sonuc = $vt->fetch_array($sorgu_sonuc);
	
	$gidecegi_yer = $yer_sonuc['blok_sira']+'1';
	

	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_yer='$_GET[blok_yer]', blok_sira='$gidecegi_yer' WHERE blok_id='$_GET[blok_id]' LIMIT 1";
	$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$sorgu_BASLAT1 ="select * from $tablo_portal_bloklar where blok_yer='$blok_yeri' AND blok_sira order by blok_sira limit $blok_sirasi,$yer_sonuc2[blok_sira]";
	$sorgu_sonuc22 = $vt->query($sorgu_BASLAT1) or die ($vt->hata_ver());
	
	while ($yer_sonuc3 = $vt->fetch_array($sorgu_sonuc22))
	{
	
	$sira_sudur = $yer_sonuc3['blok_sira']-'1';
	
	$vtsorgu = "UPDATE $tablo_portal_bloklar SET blok_sira='$sira_sudur' WHERE blok_id='$yer_sonuc3[blok_id]'";
	
	$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
	
	
	header('Location: blok_yonetim.php');
	
	exit();	
	}
	
	// YAPILAN DEĞIŞIKLILIKLER VERITABANıNA KAYDEDILIYOR - SONU //
	
	////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////
	
	
	$sayfa_adi = 'Blok Ayarlar Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();
	


	########################################################################
	########################################################################
	
	
	$sorgu_BASLAT ="select * from $tablo_portal_bloklar order by blok_sira";
	$sorgu_sonuc = $vt->query($sorgu_BASLAT) or die ($vt->hata_ver());
	
	$tablo ='';
	$tablo2 ='';
	
	while ($portal_bloklar = $vt->fetch_array($sorgu_sonuc)):
	
	######################################################################
	
	if ($portal_bloklar['blok_yer'] == '1')
	{
	
	$sil_duzelt ='';
	
	$tablo .='	
	<table cellspacing="1" width="150" cellpadding="0" border="0" align="center" bgcolor="#dddddd" style="margin: 5px">
	<tr>
	<td class="y_blok_baslik" align="center" colspan="2">';
	if ($portal_bloklar['blok_ad'] =='portal_menusu') $tablo .= $kp_yonetim_293;
	elseif ($portal_bloklar['blok_ad'] =='kullanici_masasi') $tablo .= $kp_yonetim_294;
	elseif ($portal_bloklar['blok_ad'] =='forumlar') $tablo .= $kp_yonetim_295;
	elseif ($portal_bloklar['blok_ad'] =='istatistikler') $tablo .= $kp_yonetim_296;
	elseif ($portal_bloklar['blok_ad'] =='dogum_gunleri') $tablo .= $kp_yonetim_297;
	elseif ($portal_bloklar['blok_ad'] =='takvim') $tablo .= $kp_yonetim_298;
	elseif ($portal_bloklar['blok_ad'] =='encok_mesaj_atanlar') $tablo .= $kp_yonetim_299;
	elseif ($portal_bloklar['blok_ad'] =='son_uyeler') $tablo .= $kp_yonetim_300.' '.$portal_ayarlar['son_uyeler'].' '.$kp_yonetim_385;
	elseif ($portal_bloklar['blok_ad'] =='resim_blok') $tablo .= $kp_yonetim_301;
	elseif ($portal_bloklar['blok_ad'] =='dosyalar_blok') $tablo .= $kp_yonetim_302;
	elseif ($portal_bloklar['blok_ad'] =='cevrimici_blok') $tablo .= $kp_yonetim_303;
	elseif ($portal_bloklar['blok_ad'] =='son_anket') $tablo .= $kp_yonetim_304;
	elseif ($portal_bloklar['blok_ad'] =='favori_siteler') $tablo .= $kp_yonetim_320;
	elseif ($portal_bloklar['blok_ad'] =='haber_kategori_blok') $tablo .= $kp_yonetim_328;
	elseif ($portal_bloklar['blok_ad'] =='galeri_kategori_blok') $tablo .= $kp_yonetim_329;
	else
	{
	
	
	$sqlSorgu = $vt->query("SELECT * FROM $tablo_portal_sayfa WHERE kosul_adi='$portal_bloklar[blok_ad]' limit 1") or die ($vt->hata_ver());
	while ($sql_Sonuc = $vt->fetch_assoc($sqlSorgu)){
	
	$sil_duzelt .='<tr><td width="30%" class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="center" nowrap="nowrap">
	<a href="ozel_blok_yonetim.php?kosul=sil&amp;sil='.$sql_Sonuc['sayfa_no'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'" onclick="return confirm(\''.$kp_yonetim_237.'\');"><img '.$sil_simge.' alt="'.$kp_yonetim_346.'" title="'.$kp_yonetim_346.'"></a>&nbsp;&nbsp;<a href="ozel_blok_yonetim.php?kosul=duzelt&amp;duzelt='.$sql_Sonuc['sayfa_no'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$duzlet_simge.' alt="'.$kp_yonetim_347.'" title="'.$kp_yonetim_347.'"></a></td></tr>';
	$tablo .= $sql_Sonuc['baslik'];
	
	}
	}
	
	$tablo .='
	</td>
	</tr>';
	
	###################################
	###################################

	$tablo .=$sil_duzelt;
	$tablo .='
	<tr>
	<td width="30%" class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="center" nowrap="nowrap">';
	
	$vtsorgu = "SELECT blok_sira FROM $tablo_portal_bloklar WHERE blok_yer='1' ORDER BY blok_sira DESC LIMIT 1";
	
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$alt = $vt->fetch_assoc($vtsonuc);

	if ($portal_bloklar['blok_sira'] == 1)
	{	
	$tablo .='<img '.$yukari_simge.' alt="'.$kp_yonetim_309.'" title="'.$kp_yonetim_309.'" style="opacity: 0.6; filter: alpha(opacity=60);"><br>';
	}
	else
	{	
	$tablo .='<a href="blok_yonetim.php?kosul=blok_yukari&amp;blok_yer='.$portal_bloklar['blok_yer'].'&amp;blok_sira='.$portal_bloklar['blok_sira'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$yukari_simge.' alt="'.$kp_yonetim_309.'" title="'.$kp_yonetim_309.'"></a><br>';
	}
	
	$tablo .='<img '.$sol_simge.' alt="'.$kp_yonetim_307.'" title="'.$kp_yonetim_307.'" style="opacity: 0.6; filter: alpha(opacity=60);">';
	
		
	if (($portal_bloklar['blok_acik'] == '0'))
	{
	$tablo .='<a href="blok_yonetim.php?kosul=blok_ac_kapat&amp;deger=1&amp;blok_id='.$portal_bloklar['blok_id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img style="opacity: 0.6; filter: alpha(opacity=60);" '.$ac_kapat_simge.' alt="'.$kp_yonetim_312.'" title="'.$kp_yonetim_312.'"></a>';
	}
	else
	{
	$tablo .='<a href="blok_yonetim.php?kosul=blok_ac_kapat&amp;deger=0&amp;blok_id='.$portal_bloklar['blok_id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$ac_kapat_simge.' alt="'.$kp_yonetim_313.'" title="'.$kp_yonetim_313.'"></a>';	
	}
	
	if ($portal_bloklar['blok_yer'] =='1')
	{
	$tablo .='<a href="blok_yonetim.php?kosul=ayarlari_kaydet&amp;blok_yer=3&amp;blok_id='.$portal_bloklar['blok_id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$sag_simge.' alt="'.$kp_yonetim_306.'" title="'.$kp_yonetim_306.'"></a><br>';
	}

	if ($alt['blok_sira'] == $portal_bloklar['blok_sira'])
	{	
	$tablo .='<img '.$assagi_simge.' alt="'.$kp_yonetim_310.'" title="'.$kp_yonetim_310.'" style="opacity: 0.6; filter: alpha(opacity=60);">';
	}
	else
	{
	$tablo .='<a href="blok_yonetim.php?kosul=blok_assagi&amp;blok_yer='.$portal_bloklar['blok_yer'].'&amp;blok_sira='.$portal_bloklar['blok_sira'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$assagi_simge.' alt="'.$kp_yonetim_310.'" title="'.$kp_yonetim_310.'"></a>';
	}
	
	
	$tablo .='	
	</td>
	</tr>
	</table>
	';
	
	
	
	}
	###################################
	###################################
	
	######################################################################
	
	if ($portal_bloklar['blok_yer'] == '3')
	{
	$tablo2 .='	
	<table cellspacing="1" width="150" cellpadding="0" border="0" align="center" bgcolor="#dddddd" style="margin: 5px">
	<tr>
	<td class="y_blok_baslik" align="center" colspan="2">';
	if ($portal_bloklar['blok_ad'] =='portal_menusu') $tablo2 .= $kp_yonetim_293;
	elseif ($portal_bloklar['blok_ad'] =='kullanici_masasi') $tablo2 .= $kp_yonetim_294;
	elseif ($portal_bloklar['blok_ad'] =='forumlar') $tablo2 .= $kp_yonetim_295;
	elseif ($portal_bloklar['blok_ad'] =='istatistikler') $tablo2 .= $kp_yonetim_296;
	elseif ($portal_bloklar['blok_ad'] =='dogum_gunleri') $tablo2 .= $kp_yonetim_297;
	elseif ($portal_bloklar['blok_ad'] =='takvim') $tablo2 .= $kp_yonetim_298;
	elseif ($portal_bloklar['blok_ad'] =='encok_mesaj_atanlar') $tablo2 .= $kp_yonetim_299;
	elseif ($portal_bloklar['blok_ad'] =='son_uyeler') $tablo2 .= $kp_yonetim_300.' '.$portal_ayarlar['son_uyeler'].' '.$kp_yonetim_385;
	elseif ($portal_bloklar['blok_ad'] =='resim_blok') $tablo2 .= $kp_yonetim_301;
	elseif ($portal_bloklar['blok_ad'] =='dosyalar_blok') $tablo2 .= $kp_yonetim_302;
	elseif ($portal_bloklar['blok_ad'] =='cevrimici_blok') $tablo2 .= $kp_yonetim_303;
	elseif ($portal_bloklar['blok_ad'] =='son_anket') $tablo2 .= $kp_yonetim_304;
	elseif ($portal_bloklar['blok_ad'] =='favori_siteler') $tablo2 .= $kp_yonetim_320;
	elseif ($portal_bloklar['blok_ad'] =='haber_kategori_blok') $tablo2 .= $kp_yonetim_328;
	elseif ($portal_bloklar['blok_ad'] =='galeri_kategori_blok') $tablo2 .= $kp_yonetim_329;
	
	$sil_duzelt ='';
	
	$sqlSorgu = $vt->query("SELECT * FROM $tablo_portal_sayfa WHERE yer='2'") or die ($vt->hata_ver());
	while ($sql_Sonuc = $vt->fetch_assoc($sqlSorgu)){
	if (($portal_bloklar['blok_ad'] == $sql_Sonuc['kosul_adi']))
	{ 
	$sil_duzelt ='<tr><td width="30%" class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="center" nowrap="nowrap">
	<a href="ozel_blok_yonetim.php?kosul=sil&amp;sil='.$sql_Sonuc['sayfa_no'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'" onclick="return confirm(\''.$kp_yonetim_237.'\');"><img '.$sil_simge.' alt="Sil" title="Sil"></a>&nbsp;&nbsp;<a href="ozel_blok_yonetim.php?kosul=duzelt&amp;duzelt='.$sql_Sonuc['sayfa_no'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$duzlet_simge.' alt="Düzelt" title="Düzelt"></a></td></tr>';
	$tablo2 .= $sql_Sonuc['baslik'];
	}
	}
	
	$tablo2 .='</td>
	</tr>';
	$tablo2 .=$sil_duzelt;
	$tablo2 .='<tr>
	<td width="30%" class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="center" nowrap="nowrap">';
	
	$vtsorgu = "SELECT blok_sira FROM $tablo_portal_bloklar WHERE blok_yer='3' ORDER BY blok_sira DESC LIMIT 1";
	
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$alt = $vt->fetch_assoc($vtsonuc);

	
	if ($portal_bloklar['blok_sira'] == 1)
	{	
	$tablo2 .='<img '.$yukari_simge.' alt="'.$kp_yonetim_309.'" title="'.$kp_yonetim_309.'" style="opacity: 0.6; filter: alpha(opacity=60);"><br>';
	}
	else
	{	
	$tablo2 .='<a href="blok_yonetim.php?kosul=blok_yukari&amp;blok_yer='.$portal_bloklar['blok_yer'].'&amp;blok_sira='.$portal_bloklar['blok_sira'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$yukari_simge.' alt="'.$kp_yonetim_309.'" title="'.$kp_yonetim_309.'"></a><br>';
	}
	
	
	if ($portal_bloklar['blok_yer'] =='3')
	{
	$tablo2 .='<a href="blok_yonetim.php?kosul=ayarlari_kaydet&amp;blok_yer=1&amp;blok_id='.$portal_bloklar['blok_id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$sol_simge.' alt="'.$kp_yonetim_307.'" title="'.$kp_yonetim_307.'"></a>';
	}
	
		
	if (($portal_bloklar['blok_acik'] == '0'))
	{
	$tablo2 .='<a href="blok_yonetim.php?kosul=blok_ac_kapat&amp;deger=1&amp;blok_id='.$portal_bloklar['blok_id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img  style="opacity: 0.6; filter: alpha(opacity=60);" '.$ac_kapat_simge.' alt="'.$kp_yonetim_312.'" title="'.$kp_yonetim_312.'"></a>';
	}
	else
	{
	$tablo2 .='<a href="blok_yonetim.php?kosul=blok_ac_kapat&amp;deger=0&amp;blok_id='.$portal_bloklar['blok_id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'"><img '.$ac_kapat_simge.' alt="'.$kp_yonetim_313.'" title="'.$kp_yonetim_313.'"></a>';	
	}
	
	

	$tablo2 .='<img '.$sag_simge.' alt="'.$kp_yonetim_306.'" title="'.$kp_yonetim_306.'" style="opacity: 0.6; filter: alpha(opacity=60);"><br>';
	
	if ($alt['blok_sira'] == $portal_bloklar['blok_sira'])
	{	
	$tablo2 .='<img '.$assagi_simge.' alt="'.$kp_yonetim_310.'" title="'.$kp_yonetim_310.'" style="opacity: 0.6; filter: alpha(opacity=60);">';
	}
	else
	{
	$tablo2 .='<a href="blok_yonetim.php?kosul=blok_assagi&amp;blok_yer='.$portal_bloklar['blok_yer'].'&amp;blok_sira='.$portal_bloklar['blok_sira'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'].'">
	<img '.$assagi_simge.' alt="'.$kp_yonetim_310.'" title="'.$kp_yonetim_310.'"></a>';
	}
	
	
	$tablo2 .='</td>
	</tr></table>
	
	';
	}
	
	###################################
	###################################
	
	endwhile;
	
	######################################################################
	######################################################################
	
	
	$sol_bloklar = '<label style="cursor: pointer;"><input type="radio" name="sol_bloklar" value="1"';

	if ($portal_bloklar_ayar['sol_bloklar'] == 1) 
	$sol_bloklar .= ' checked="checked"';

	$sol_bloklar .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$sol_bloklar .= '<label style="cursor: pointer;"><input type="radio" name="sol_bloklar" value="0"';

	if ($portal_bloklar_ayar['sol_bloklar'] == 0) 
	$sol_bloklar .= ' checked="checked"';

	$sol_bloklar .= '>'.$kp_yonetim_186.'</label>';
	
	########################	
	########################
	
	$sag_bloklar = '<label style="cursor: pointer;"><input type="radio" name="sag_bloklar" value="1"';

	if ($portal_bloklar_ayar['sag_bloklar'] == 1) 
	$sag_bloklar .= ' checked="checked"';

	$sag_bloklar .= '>'.$kp_yonetim_185.'</label>';
	
	/*************************/
	
	$sag_bloklar .= '<label style="cursor: pointer;"><input type="radio" name="sag_bloklar" value="0"';

	if ($portal_bloklar_ayar['sag_bloklar'] == 0) 
	$sag_bloklar .= ' checked="checked"';

	$sag_bloklar .= '>'.$kp_yonetim_186.'</label>';

	
	################################################
	################################################
	
	$dongusuz = array(
	'{SOL_BLOKLAR_SONUCU}' => $sol_bloklar,
	'{SAG_BLOKLAR_SONUCU}' => $sag_bloklar,
	'{SOL_BLOKLAR}' => $kp_yonetim_206,
	'{SAG_BLOKLAR}' => $kp_yonetim_207,
	'{GONDER}' => $kp_yonetim_26,
	'{AYARLARI_KAYDET_SAYFASI_1}' => 'blok_yonetim.php?kosul=sag_sol_bloklar',
	'{TEMIZLE}' => $kp_yonetim_27,
	'{SAYFA_AYARLARI2}' => $kp_yonetim_213,
	'{TABLO}' => $tablo,
	'{YENI_BLOK_EKLE}' => $kp_yonetim_332,
	'{SOL_BLOKLAR2}' => $kp_yonetim_348,
	'{SAG_BLOKLAR2}' => $kp_yonetim_349,
	'{TABLO2}' => $tablo2);

	

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/blok_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$ornek1->dongusuz($dongusuz);
	eval(TEMA_UYGULA);
	
?>
