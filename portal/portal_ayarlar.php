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


#####################PORTAL AYARLARI####################
########################################################

	if (@is_file('ayar.php'))
	{
	if (!isset($tablo_oneki)) include 'ayar.php';
	}
	else
	{
	if (!isset($tablo_oneki)) include '../ayar.php';
	}
	
	define('DOSYA_PORTAL_AYARLAR',true);

	$version = "3.00";
	$version_forum = "3.00";

########################################################
########################################################

//  TABLO ADLARINA ÖNEK EKLENİYOR - BAŞI //

	$tablo_portal_ayarlar = $tablo_oneki.'portal_ayarlar';
	$tablo_portal_blok = $tablo_oneki.'portal_blok';
	$tablo_portal_bloklar = $tablo_oneki.'portal_bloklar';
	$tablo_portal_indir = $tablo_oneki.'portal_indir';
	$tablo_portal_indirkategori = $tablo_oneki.'portal_indirkategori';
	$tablo_portal_indiryorum = $tablo_oneki.'portal_indiryorum';
	$tablo_portal_anketsoru = $tablo_oneki.'portal_anketsoru';
	$tablo_portal_anketsecenek = $tablo_oneki.'portal_anketsecenek';
	$tablo_portal_galeri = $tablo_oneki.'portal_galeri';
	$tablo_portal_galeridal = $tablo_oneki.'portal_galeridal';
	$tablo_portal_haberler = $tablo_oneki.'portal_haberler';
	$tablo_portal_videolar = $tablo_oneki.'portal_videolar';
	$tablo_portal_haberyorum = $tablo_oneki.'portal_haberyorum';
	$tablo_portal_anketyorum = $tablo_oneki.'portal_anketyorum';
	$tablo_portal_sayfa = $tablo_oneki.'portal_sayfa';
	$tablo_portal_siteekle = $tablo_oneki.'portal_siteekle';
	$tablo_portal_siteekledal = $tablo_oneki.'portal_siteekledal';
	$tablo_portal_haberdal = $tablo_oneki.'portal_haberdal';
	$tablo_portal_video = $tablo_oneki.'portal_video';
	$tablo_portal_videodal = $tablo_oneki.'portal_videodal';

//  TABLO ADLARINA ÖNEK EKLENİYOR - SONU //
	
########################################################
########################################################

// AYARLAR VE BLOKLAR TABLOSU HAZIRLANIYOR - BAŞI //


	$vtsorgu = "SELECT * FROM $tablo_portal_ayarlar";

	$portal_ayarlar_sonucu = @$vt->query($vtsorgu);

	if (isset($portal_ayarlar_sonucu))
	{
	while (@$ayar1 = $vt->fetch_array($portal_ayarlar_sonucu))
	{
		$isim = $ayar1['0'];
		$portal_ayarlar[$isim] = $ayar1['1'];
	}
	}
	
	
	$vtsorgu = "SELECT * FROM $tablo_portal_bloklar";

	$portal_bloklar_sonucu = @$vt->query($vtsorgu);

	if (isset($portal_bloklar_sonucu))
	{
	while (@$bloklar_ayar = $vt->fetch_array($portal_bloklar_sonucu))
	{
		$blok_isim = $bloklar_ayar['1'];
		$portal_bloklar_ayar[$blok_isim] = $bloklar_ayar['4'];
	}
	}

// AYARLAR VE BLOKLAR TABLOSU HAZIRLANIYOR - SONU //

########################################################
########################################################

// KURULUM SAYFASINA YÖLENDİRİLİYOR - BAŞI //

if ( (!isset($portal_ayarlar['anket_izni'])) OR ($portal_ayarlar['portal_surum'] < $version) )
{
	header('Location: ./kurulum/index.php');
	exit();
}

// KURULUM SAYFASINA YÖLENDİRİLİYOR - SONU //

########################################################
########################################################

// GET VERİSİ HAZIRLANIYOR - BAŞI //

	if (empty($_GET['ps'])) $_GET['ps'] = 0;
	else $_GET['ps'] = zkTemizle($_GET['ps']);

	if (empty($_GET['p'])) $_GET['p'] = 0;
	else $_GET['p'] = zkTemizle($_GET['p']);

	if ($_GET['ps'] == 0) $ps = '';
	else $ps = '&ps='.$_GET['ps'];

	if (isset($_GET['psayfa'])) $_GET['ps'] = $_GET['psayfa'];
	if (isset($_GET['pno'])) $_GET['p'] = $_GET['pno'];
	
// GET VERİSİ HAZIRLANIYOR - SONU //

########################################################
########################################################

// TEMA DİZİNİ HAZIRLANIYOR - BAŞI //

if (@is_file('ayar.php'))
{
	if (!defined('DOSYA_GERECLER')) include 'phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_TEMA_SECILIYOR')) include 'portal/tema_seciliyor.php';
}
else
{
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_TEMA_SECILIYOR')) include 'tema_seciliyor.php';
}


// TEMA DİZİNİ HAZIRLANIYOR - SONU //

########################################################
########################################################

// VERİ SİLME ANAHTARI OLUŞTURULUYOR - BAŞI //

$sil_anahtar = mb_substr(sha1(md5(uniqid(rand(111111111111,999999999999)))),0,12, 'utf-8');

// VERİ SİLME ANAHTARI OLUŞTURULUYOR - SONU //

########################################################
########################################################


?>