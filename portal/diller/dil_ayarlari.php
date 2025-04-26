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


if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_DILAYAR')) define('DOSYA_DILAYAR',true);


// EKLENMİŞ OLAN DİLLER - BAŞI //

if (@is_file('ayar.php')) $dizin_adi = 'portal/diller/';
else $dizin_adi = 'diller/';

$ayarlar_dil_eklenen = ',';

$dizin = @opendir($dizin_adi);
while (@gettype($bilgi = @readdir($dizin)) != 'boolean')
{
	if ((@is_dir($dizin_adi.$bilgi)) AND (!preg_match('/^[a-z_]+$/', $bilgi) == 0) AND (!preg_match('/turkce/', $bilgi))) $ayarlar_dil_eklenen .= $bilgi.',';
}
@closedir($dizin);

// EKLENMİŞ OLAN DİLLER - SONU //



// PORTAL DİL AYARLARI YAPILIYOR //


// COOKIE ile dil seçimi
if (isset($_COOKIE['dil']))
{
	$bul = array('x','-','.',',');
	$dil = htmlspecialchars(urldecode(trim($_COOKIE['dil'])), ENT_QUOTES);
	$dil = str_replace($bul, '', $dil);

	if (($dil != '') AND (preg_match("/,$dil,/is", $ayarlar_dil_eklenen))) $site_dili = $_COOKIE['dil'];
	else $site_dili = $portal_ayarlar['portal_dili'];
}
else
{
	if (isset($portal_ayarlar['portal_dili'])) $site_dili = $portal_ayarlar['portal_dili'];
	else $site_dili = 'tr';
}



// Dil dosyaları yükleniyor
if (@is_file('ayar.php'))
{
	if (!@include_once('portal/diller/'.$site_dili.'/portal_dil.php')) include_once('portal/diller/tr/portal_dil.php');
	if (!@include_once('portal/diller/'.$site_dili.'/yonetim_dil.php')) include_once('portal/diller/tr/yonetim_dil.php');
}
else
{
	if (!@include_once('diller/'.$site_dili.'/portal_dil.php')) include_once('diller/tr/portal_dil.php');
	if (!@include_once('diller/'.$site_dili.'/yonetim_dil.php')) include_once('diller/tr/yonetim_dil.php');
}


if (@is_file('ayar.php')) include 'portal/diller/dil_grafik.php';
else include 'diller/dil_grafik.php';

?>