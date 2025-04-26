<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
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


if (!defined('DOSYA_AYAR')) include_once('../../phpkf-ayar.php');
$temadizini_cms = 'varsayilan';


// Gelinen adres
if (isset($_SERVER['REQUEST_URI']))
{
	$git = $_SERVER['REQUEST_URI'];
	if (!preg_match('/phpkf-yonetim\/index.php$/', $git))
	{
		$git = @str_replace('//', '', $git);
		$git = @str_replace('&', 'veisareti', $git);
		$git = '?git='.$git;
	}
	else $git = '';
}
else $git = '';



// ÇEREZ BİLGİLERİ YOKSA KULLANICI GİRİŞ SAYFASINA YÖNLENDİRİLİYOR

if ( (empty($_COOKIE['kullanici_kimlik'])) OR ($_COOKIE['kullanici_kimlik'] == '') OR
	(empty($_COOKIE['yonetim_kimlik'])) OR ($_COOKIE['yonetim_kimlik'] == '') )
{
	header('Location: giris.php'.$git);
	exit();
}


// ÇEREZ BİLGİSİ VARSA VERİTABANINDA İLE KARŞILAŞTIRILIYOR

elseif ((isset($_COOKIE['kullanici_kimlik'])) AND (isset($_COOKIE['yonetim_kimlik'])))
{
	if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');

	$_COOKIE['yonetim_kimlik'] = @zkTemizle4($_COOKIE['yonetim_kimlik']);
	$_COOKIE['yonetim_kimlik'] = @zkTemizle($_COOKIE['yonetim_kimlik']);
	$_COOKIE['kullanici_kimlik'] = @zkTemizle4($_COOKIE['kullanici_kimlik']);
	$_COOKIE['kullanici_kimlik'] = @zkTemizle($_COOKIE['kullanici_kimlik']);


	// çerez geçerlilik süresi
	if ($ayarlar['k_cerez_zaman'] > 86400) $k_cerez_zaman = 86400;
	else $k_cerez_zaman = $ayarlar['k_cerez_zaman'];


	$vtsorgu = "SELECT id,yonetim_kimlik,kullanici_kimlik,yetki,son_hareket,kul_ip FROM $tablo_kullanicilar WHERE yonetim_kimlik='$_COOKIE[yonetim_kimlik]' AND kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu);
	$yonetim_kimlik = $vt->fetch_array($vtsonuc);


	// KULLANICI VEYA YÖNETİM KİMLİK UYUŞMUYORSA VEYA IP ADRESİ DEĞİŞMİŞSE
	// VEYA ÇEREZ BİR GÜNDEN ESKİYSE ÇEREZ TEMİZLENİYOR
	// VE GİRİŞ SAYFASINA YÖNLENDİRİLİYOR

	if (!$vt->num_rows($vtsonuc))
	{
		setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
		header('Location: giris.php');
		exit();
	}

	elseif ( ($yonetim_kimlik['kullanici_kimlik'] != $_COOKIE['kullanici_kimlik']) OR
			($yonetim_kimlik['yonetim_kimlik'] != $_COOKIE['yonetim_kimlik']) OR
			(($yonetim_kimlik['son_hareket'] + $k_cerez_zaman) < time()) )
	{
		setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
		setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);

		header('Location: giris.php');
		exit();
	}

	elseif ($yonetim_kimlik['yetki'] != 1)
	{
		header('Location: hatalar.php?hata=144');
		exit();
	}
}


else
{
	header('Location: giris.php'.$git);
	exit();
}


// yönetim oturum kodu
if ($yonetim_kimlik != 0)
{
	$yo = $yonetim_kimlik['kullanici_kimlik'];
	$yo = $yo[3].$yo[6].$yo[8].$yo[10].$yo[13].$yo[17].$yo[19].$yo[25].$yo[30].$yo[33];
}

else $yo = 0;

define('DOSYA_YONETIM_GUVENLIK',true);


// Yönetim Dil dosyası yükleniyor
if (!defined('DOSYA_YONETIM_DIL')) include_once('diller/index.php');

?>