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


if (!defined('PHPKF_ICINDEN')) exit();

if ((isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '')) $gadres = $_SERVER['REQUEST_URI'];
else $gadres = '';

if (@preg_match('/\/phpkf-bilesenler\//', $gadres)) @ini_set('error_log', 'log/php.log.php');
elseif ((@preg_match('/\/portal\//', $gadres)) OR (@preg_match('/\/mobil\//', $gadres)) OR (@preg_match('/\/mobil.php/', $gadres))) @ini_set('error_log', '../phpkf-bilesenler/log/php.log.php');
else @ini_set('error_log', 'phpkf-bilesenler/log/php.log.php');

@ini_set('magic_quotes_runtime', 0);
@ini_set('default_charset', 'UTF-8');



// hata tablosu
$vt_hata_tablo[0] = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Veritabanı Hatası</title></head><body><br><br><br><table border="0" cellspacing="1" cellpadding="7" width="530" bgcolor="#999999" align="center" class="xe-fatal-error"><tr><td bgcolor="#eeeeee" align="center"><font color="#ff0000"><b>';
$vt_hata_tablo[1] = '</b></font></td></tr><tr><td bgcolor="#fafafa"><table border="0" cellspacing="1" cellpadding="7" width="100%" bgcolor="#999999" align="center"><tr><td bgcolor="#eeeeee" align="left"><br>';
$vt_hata_tablo[2] = '<br></td></tr></table></td></tr></table></body></html>';
$vt_hata_tablo[3] = '<table border="0" class="xe-fatal-error"><tr><td></td></tr></table>';



if (!isset($vt))
{
	if (!@include_once('veritabani/'.$vtsecim.'.php'))
	{
		echo $vt_hata_tablo[0].'Veritabanı Dosyası Bulunamıyor!'.$vt_hata_tablo[1].'/phpkf-bilesenler/veritabani/'.$vtsecim.'.php dosyası bulunamıyor!<br /><br />phpkf-ayar.php dosyasında <b>$vtsecim</b> değişkeni ile yaptığınız veritabanı seçimi hatalı veya veritabanı dosyası silinmiş veya eksik.'.$vt_hata_tablo[2];
		exit();
	}

	// Veritabanı ile bağlantı kuruluyor
	$vt = new sinif_vt();
	$vt->baglan($vtadres, $vtkul, $vtsifre) or die($vt->hata_cikti);

	// veritabanı seçiliyor
	$veri_tabani = $vt->sec($vtisim) or die($vt->hata_ver());
}



// Ortak tablo adlarına önek ekleniyor
$tablo_ayarlar = $tablo_oneki.'ortak_ayarlar';
$tablo_baglantilar = $tablo_oneki.'ortak_baglantilar';
$tablo_bildirimler = $tablo_oneki.'ortak_bildirimler';
$tablo_eklentiler = $tablo_oneki.'ortak_eklentiler';
$tablo_kullanicilar = $tablo_oneki.'ortak_kullanicilar';
$tablo_oturumlar = $tablo_oneki.'ortak_oturumlar';
$tablo_yasaklar = $tablo_oneki.'ortak_yasaklar';

// CMS Tabloları
$tablo_bloklar = $tablo_oneki.'cms_bloklar';
$tablo_iletisim = $tablo_oneki.'cms_iletisim';
$tablo_kategoriler = $tablo_oneki.'cms_kategoriler';
$tablo_sablonlar = $tablo_oneki.'cms_sablonlar';
$tablo_yazilar = $tablo_oneki.'cms_yazilar';
$tablo_yorumlar = $tablo_oneki.'cms_yorumlar';

// Forum Tabloları
$tablo_cevaplar = $tablo_oneki.'forum_cevaplar';
$tablo_dallar = $tablo_oneki.'forum_dallar';
$tablo_duyurular = $tablo_oneki.'forum_duyurular';
$tablo_forumlar = $tablo_oneki.'forum_forumlar';
$tablo_gruplar = $tablo_oneki.'forum_gruplar';
$tablo_mesajlar = $tablo_oneki.'forum_mesajlar';
$tablo_ozel_ileti = $tablo_oneki.'forum_ozel_ileti';
$tablo_ozel_izinler = $tablo_oneki.'forum_ozel_izinler';
$tablo_tesekkur = $tablo_oneki.'forum_tesekkur';
$tablo_pyorumlar = $tablo_oneki.'forum_pyorumlar';
$tablo_yuklemeler = $tablo_oneki.'forum_yuklemeler';



// ayarlar tablosu kip seçimi
if (!isset($phpkf_ayarlar_kip)) $phpkf_ayarlar_kip = "WHERE kip='1'";


// veritabanından ayarlar tablosu çekiliyor
$vtsorgu = "SELECT etiket,deger FROM $tablo_ayarlar $phpkf_ayarlar_kip";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


// ayarlar dizi değişkene aktarılıyor
while ($ayar = $vt->fetch_assoc($vtsonuc))
{
	$ayarlar[$ayar['etiket']] = $ayar['deger'];
}


// bölge ve tarih ayarları
date_default_timezone_set($ayarlar['tarih_bolge']);
setlocale(LC_ALL,$ayarlar['tarih_dil']);


// sistem dizinleri
if ($ayarlar['dizin'] == '/') {$anadizin = '/'; $cms_dizin = '/';}
else {$anadizin = $ayarlar['dizin'].'/'; $cms_dizin = $ayarlar['dizin'].'/';}
if ($ayarlar['f_dizin'] == '/') $forum_dizin = '/';
else $forum_dizin = $ayarlar['f_dizin'].'/';


// site alanadı ve dizini
$protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
$TEMA_SITE_ANADIZIN = $protocol.'://'.$ayarlar['alanadi'].$anadizin;


// çerez alanadı ve dizini
if ($ayarlar['alanadi'] == 'localhost') $cerez_alanadi = null;
else $cerez_alanadi = $ayarlar['alanadi'];
$cerez_dizin = $ayarlar['dizin'];


// Forum tema dizini bilgisi
if ($ayarlar['temadizini'] != '') $temadizini = $ayarlar['temadizini'];
else $temadizini = 'varsayilan';
$secili_tema = $temadizini;


// CMS tema dizini bilgisi
if ($ayarlar['temadizini_cms'] != '') $temadizini_cms = $ayarlar['temadizini_cms'];
else $temadizini_cms = 'varsayilan';
$secili_tema_cms = $temadizini_cms;


// CMS, forum, portal ayarları
$cms_kullan = @$ayarlar['cms_kullan'];
$forum_kullan = @$ayarlar['forum_kullan'];
$portal_kullan = @$ayarlar['portal_kullan'];
$ayarlar['forum_rengi'] = @$ayarlar['tema_renk'];


// Site index belirleniyor
if ($ayarlar['site_index'] == 1)
{
	$site_index = $phpkf_dosyalar['cms'];
	$phpkf_dosyalar['cms'] = $phpkf_dosyalar['index'];
}
elseif ($ayarlar['site_index'] == 2)
{
	$site_index = $phpkf_dosyalar['forum'];
	$phpkf_dosyalar['forum'] = $phpkf_dosyalar['index'];
}
elseif ($ayarlar['site_index'] == 3)
{
	$site_index = $phpkf_dosyalar['portal'];
	$phpkf_dosyalar['portal'] = $phpkf_dosyalar['index'];
}
else
{
	$site_index = $phpkf_dosyalar['cms'];
	$phpkf_dosyalar['cms'] = $phpkf_dosyalar['index'];
}


// Dil dosyası yükleniyor
if (!defined('DOSYA_DIL')) include_once('diller/index.php');



// Eski sürüm tema ve eklentiler için, eski dosya adı değişkenleri
$cms_index = $phpkf_dosyalar['cms'];
$forum_index = $phpkf_dosyalar['forum'];
$portal_index = $phpkf_dosyalar['portal'];
$dosya_index = $phpkf_dosyalar['index'];
$dosya_forum = $phpkf_dosyalar['forum'];
$dosya_portal = $phpkf_dosyalar['portal'];
$dosya_hata = $phpkf_dosyalar['hata'];
$dosya_giris = $phpkf_dosyalar['giris'];
$dosya_cikis = $phpkf_dosyalar['cikis'];
$dosya_kayit = $phpkf_dosyalar['kayit'];
$dosya_uyeler = $phpkf_dosyalar['uyeler'];
$dosya_cevrimici = $phpkf_dosyalar['cevrimici'];
$dosya_ozel_ileti = $phpkf_dosyalar['ozel_ileti'];
$dosya_oi_oku = $phpkf_dosyalar['oi_oku'];
$dosya_oi_yaz = $phpkf_dosyalar['oi_yaz'];
$dosya_arama = $phpkf_dosyalar['arama'];
$dosya_yardim = $phpkf_dosyalar['yardim'];
$dosya_rss = $phpkf_dosyalar['rss'];
$dosya_mobil = $phpkf_dosyalar['mobil'];
$dosya_profil = $phpkf_dosyalar['profil'];
$dosya_profil_degistir = $phpkf_dosyalar['profil_degistir'];
$dosya_sifre_degistir = $phpkf_dosyalar['sifre_degistir'];

?>