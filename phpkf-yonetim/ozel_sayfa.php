<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v3.00                              |
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


$phpkf_ayarlar_kip = "";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


$ozel_sayfa_dosya = '';
$ozel_sayfa_ad = '';

if ((isset($_GET['s'])) AND ($_GET['s'] != '')) $ozel_sayfa_ad = zkTemizle($_GET['s']);



// Dosya adı veritabanından kontrol ediliyor
if ($ozel_sayfa_ad != '')
{
	$bul = array('.', '/');
	$degis = array('\.', '\/');
	$kontrol = @str_replace($bul, $degis, $ozel_sayfa_ad);

	if (@preg_match("/$kontrol/", $ayarlar['yonetim_menu'])) $ozel_sayfa_dosya = '../'.$ozel_sayfa_ad;
	else $ozel_sayfa_dosya = '';
}







// Özel dosya yoksa uyarı veriliyor

if ( ($ozel_sayfa_dosya == '') OR (!@is_file($ozel_sayfa_dosya)) )
{
	$sayfa_adi = $ly['dosya_bulunamiyor'];
	$tema_sayfa_baslik = $ly['dosya_bulunamiyor'];

	$tema_sayfa_icerik = 'Özel yönetim sayfası dosyası bulunamıyor !<br /><br />Yönetim sayfası ekleyen eklenti sorunlu olabilir;<br />Veya veritabanı phpkfcms_ayarlar tablosundaki yonetim_menu alanı silinmiş olabilir.';

	// tema dosyası yükleniyor
	eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));
}



// Özel dosya varsa yükleniyor

else include_once($ozel_sayfa_dosya);

?>