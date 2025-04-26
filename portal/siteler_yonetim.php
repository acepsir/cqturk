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
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
	
	// portal yonetim taban rengi nilgisi.
	$arka_tablo = "yonetim_bg2";


	// ONAYLAMA SIL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './siteler_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./siteler_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_318,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	// ONAYLAMA SIL UYARISI - SONU //
	
	// ONAYLA UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi2'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './siteler_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./siteler_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_319,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	// ONAYLA UYARISI - SONU //
	
	
	// YENI DAL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi3'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './siteler_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./siteler_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_270,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	//  YENI DAL UYARISI - SONU //
	
	
	// DAL SIL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi4'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './siteler_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./siteler_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_271,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	//  DAL SIL UYARISI - SONU //



	if ($kosul == 'onaylama_sil')
	{
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'siteler_yonetim.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
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
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //
	
	
	if (is_numeric($_GET['site_id']) == true) $_GET['site_id'] = @zkTemizle($_GET['site_id']);
	else $_GET['site_id'] = 0;
	
	$sil_sorgu = "DELETE FROM $tablo_portal_siteekle WHERE site_id='$_GET[site_id]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());

	header ('Location: siteler_yonetim.php?bilgi=iletisi');
	
	exit();
	}
	
	if ($kosul == 'onayla')
	{
	
	
	if (is_numeric($_GET['site_id']) == true) $_GET['site_id'] = @zkTemizle($_GET['site_id']);
	else $_GET['site_id'] = 0;
	
	$vtsorgu = "UPDATE $tablo_portal_siteekle SET site_onay='1' where site_id='$_GET[site_id]' LIMIT 1";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
			
	header ('Location: siteler_yonetim.php?bilgi=iletisi2');
	
	exit();
	}

	if ($kosul == 'yeni_dal')
	{

	$tarih = time();
	
	$_POST['baslik'] = @zkTemizle($_POST['baslik']);
	
	$vtsorgu = "INSERT INTO $tablo_portal_siteekledal (tarih, baslik)";

	$vtsorgu .= "VALUES ('$tarih','$_POST[baslik]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	header ('Location: siteler_yonetim.php?bilgi=iletisi3');
	
	exit();
	}
	
	if ($kosul == 'dal_sil')
	{
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'siteler_yonetim.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
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
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //
	
	if (is_numeric($_POST['dal_no']) == true) $_POST['dal_no'] = zkTemizle($_POST['dal_no']);
	else $_POST['dal_no'] = 0;
	
	$sil_sorgu = "DELETE FROM $tablo_portal_siteekledal WHERE dal_no='$_POST[dal_no]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());
			
	$sorgu = "SELECT * FROM $tablo_portal_siteekle WHERE dal_no='$_POST[dal_no]'";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	while ($vtsonuc = $vt->fetch_assoc($sorgu_sonuc)):
	
	$sil_sorgu = "DELETE FROM $tablo_portal_siteekle WHERE dal_no='$_POST[dal_no]'";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());
	
	endwhile;
	
	
	header ('Location: siteler_yonetim.php?bilgi=iletisi4');
	
	
	exit();
	}
	
	$sayfa_adi = 'Favori Siteler Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	$Sorgu = "SELECT * FROM $tablo_portal_siteekledal order by tarih desc";
	$dal_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	$dongule1 = '';
	
	while ($dallar = $vt->fetch_array($dal_sonuc))
	{
	$dongule1 .='<option value="'.$dallar['dal_no'].'">'.$dallar['baslik'].'</option>';
	}

	unset($Sorgu); 

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = '5'; 
	$kosullar = "where site_onay='0' order by tarih desc"; 
	$tabloadi = $tablo_portal_siteekle; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	} 
	
	
	$Sorgu22 = $vt->query("SELECT * FROM $tabloadi $kosullar LIMIT $baslangic,$limit");

	
	while ($siteler = $vt->fetch_array($Sorgu22))
	{
	$dongule2[] = array(
	'{ONAYLA}' => $yonetim_galerisimge_onayla, 
	'{ONAYLAMA}' => $yonetim_galerisimge_onaylama,
	'{SITE_ID}' => $siteler['site_id'],
	'{ONAYLA_SAYFASI}' => 'siteler_yonetim.php?kosul=onayla&amp;site_id='.$siteler['site_id'],
	'{ONAYLAMA_SIL_SAYFASI}' => 'siteler_yonetim.php?kosul=onaylama_sil&amp;site_id='.$siteler['site_id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{DAL_NO}' => $siteler['dal_no'],
	'{SITE_RESIM}' => $siteler['site_resim'],
	'{ADRES2}' => $siteler['adres'],
	'{TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $siteler['tarih']),
	'{ISIM}' => $siteler['site_title'],
	'{ACIKLAMA}' => $siteler['aciklama'],
	'{EKLEYEN}' => $siteler['ekleyen'],
	'{SITE_ONAY}' => $siteler['site_onay']);
	}
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'siteler_yonetim.php?','',$adresdeger='');
	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/siteler_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));

	if ($dongule1 !='') 
	{
	$ornek1->dongusuz(array('{SECENEKLER}' => $dongule1));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEKLER}' => ''));
	}
	
	if (isset($dongule2))
	{
	$ornek1->tekli_dongu('2',$dongule2);
	}
	
	if (($dongule1 !='') AND (isset($dongule2)) )
	{
	$ornek1->kosul('1',array('' => ''), true);
	$ornek1->kosul('2',array('' => ''), false);
	}	
	else
	{
	$ornek1->kosul('2',array('' => ''), true);
	$ornek1->kosul('1',array('' => ''), false);
	}
	
	
	$dongu_yok = array(
	'{SAYFALAMA}' => $tablo,
	'{ONAY_BEKLEYEN}' => $kp_yonetim_321, 
	'{BEKLEYEN_YOK}' => $kp_yonetim_322, 
	'{SITE_ADI}' => $kp_yonetim_323, 
	'{EKLEME_TARIHI}' => $kp_yonetim_324, 
	'{EKLEYEN1}' => $kp_yonetim_326, 
	'{ADRES}' => $kp_yonetim_325, 
	'{ACIKLAMA1}' => $kp_yonetim_327,  
	'{KATEGORI_EKLE}' => $kp_yonetim_81, 
	'{SILINECEK_KATEGORI}' => $kp_yonetim_77, 
	'{KATEGORIYI_SIL}' => $kp_yonetim_80, 
	'{SIL_UYARISI}' => $kp_dil_151,
	'{YENI_DAL_EKLE_SAYFASI}' => 'siteler_yonetim.php?kosul=yeni_dal',
	'{DAL_SIL_SAYFASI}' => 'siteler_yonetim.php?kosul=dal_sil&amp;anahtar='.$portal_ayarlar['sil_anahtar']);
				


$ornek1->dongusuz($dongu_yok);


eval(TEMA_UYGULA);


?>