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


if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_OTURUM')) include_once('phpkf-bilesenler/oturum.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('phpkf-bilesenler/sinif_tema.php');


// Sayfa title ayarları
if (isset($sayfa_adi)) $sayfa_adi = stripslashes($sayfa_adi);
else $sayfa_adi = '';

if (isset($sayfa_numara))
{
	if ($sayfa_numara == 100) $site_baslik = str_replace('"', '', $ayarlar['title_anasyf']);
	else
	{
		$site_baslik = str_replace('"', '', $ayarlar['title']);
		if ($site_baslik != '') $site_baslik = $site_baslik.' - '.$sayfa_adi;
		else $site_baslik = $sayfa_adi;
	}
}
else
{
	$site_baslik = str_replace('"', '', $ayarlar['title']);
	if ($site_baslik != '') $site_baslik = $site_baslik.' - '.$sayfa_adi;
	else $site_baslik = $sayfa_adi;
}



// En geniş blok değeri alınıyor
if (!isset($engenis_solblok)) $engenis_solblok = '200px';
if (!isset($engenis_sagblok)) $engenis_sagblok = '200px';



// css, title ve logo kodları oluşturuluyor
$TEMA_CSS = '<link href="phpkf-bilesenler/sablon.php?engenis_sol='.$engenis_solblok.'&amp;engenis_sag='.$engenis_sagblok.'" rel="stylesheet" type="text/css">'."\r\n";
if (isset($sagdan_sola)) $TEMA_CSS .= '<style type="text/css">'.$sagdan_sola.'</style>'."\r\n";

$TEMA_TITLE = $site_baslik;
$TEMA_LOGO_UST = $ayarlar['tema_logo_ust'];
$TEMA_LOGO_UST2 = $ayarlar['tema_logo_ust2'];

if ($TEMA_LOGO_UST != '')
{
	if (@!preg_match('/\<img/', $TEMA_LOGO_UST))
	{
		if ((@!preg_match('/\<a/', $TEMA_LOGO_UST)) AND ($temadizini_cms == 'varsayilan')) $TEMA_LOGO_UST = '<a href="'.$anadizin.'">'.$TEMA_LOGO_UST.'</a>';
		$TEMA_LOGO_UST = '<span id="baslikyazi">'.$TEMA_LOGO_UST.'</span>';
	}
}
if ($TEMA_LOGO_UST2 != '')
{
	if (@!preg_match('/\<img/', $TEMA_LOGO_UST2))
	{
		if (@!preg_match('/\<a/', $TEMA_LOGO_UST2)) $TEMA_LOGO_UST2 = '<a href="'.$anadizin.'">'.$TEMA_LOGO_UST2.'</a>';
		$TEMA_LOGO_UST2 = '<span id="baslikyazi">'.$TEMA_LOGO_UST2.'</span>';
	}
}



//  META ETİKETLERİ - BAŞI  //

if ( (isset($yazi['baslik'])) AND ($yazi['baslik'] != '') AND ($sayfa_numara != 100) )
	$meta_description = $yazi['baslik'];
else $meta_description = $ayarlar['meta_description'];


if ( (isset($yazi['etiket'])) AND ($yazi['etiket'] != '') AND ($sayfa_numara != 100) )
	$meta_keywords = $yazi['etiket'];
else $meta_keywords = $ayarlar['meta_keywords'];


if (isset($_SERVER['REQUEST_URI']))
{
	if (!@preg_match('/"/', urldecode($_SERVER['REQUEST_URI']))) $meta_canonical = $_SERVER['REQUEST_URI'];
	else $meta_canonical = '';
	$meta_canonical = zkTemizle($meta_canonical);
	$meta_canonical = zkTemizle4($meta_canonical);
	$meta_canonical = $protocol.'://'.$ayarlar['alanadi'].$meta_canonical;
}
else $meta_canonical = $protocol.'://'.$ayarlar['alanadi'];


// Dil etiketleri
$TEMA_HTML_DIL = 'lang="'.$site_dili.'" dir="ltr"';
$TEMA_META_KARAKTER = 'utf-8';


if ($ayarlar['meta_sosyal'] != '')
{
	$bul = array('{URL}',
	'{TITLE}',
	'{TITLE_ANASAYFA}',
	'{META_DESCRIPTION}',
	'{META_KEYWORDS}');

	$degis = array($meta_canonical,
	$site_baslik,
	$ayarlar['title_anasyf'],
	$meta_description,
	$meta_keywords);

	$meta_sosyal = str_replace($bul, $degis, $ayarlar['meta_sosyal']);
}
else $meta_sosyal = '';


$TEMA_META_ETIKET = '<base href="'.$anadizin.'" />
<link rel="canonical" href="'.$meta_canonical.'" />
<meta name="content-language" content="'.$site_dili.'" />
<meta name="description" content="'.$meta_description.'" />
<meta name="keywords" content="'.$meta_keywords.'" />
<meta name="generator" content="phpKF" />
'.$ayarlar['meta_diger']."\r\n".$meta_sosyal."\r\n";

//  META ETİKETLERİ - SONU  //



// Arama ve etiket form kodları
$arama_adres = linkyap($phpkf_dosyalar['cms'].'?kip=arama', $ayarlar['dizin_arama']);
$etiket_adres = linkyap($phpkf_dosyalar['cms'].'?kip=etiket', $ayarlar['dizin_etiket']);
if ($ayarlar['seo'] == 0) $arama_seo = '0';
else $arama_seo = '1';



// Üyelik menüsü göster/gizle
if ($ayarlar['tema_uye_menusu'] == 1) $TEMA_UYELIK_MENU_GOSTER = true;
else
{
	if (isset($kullanici_kim['id'])) $TEMA_UYELIK_MENU_GOSTER = true;
	else $TEMA_UYELIK_MENU_GOSTER = false;
}



// forum ve portal durumu için ek sorgu
$drm_syf_ek = '';
if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel' AND ad!='yardim' AND ad!='mobil' AND ad!='rss'";
if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";

// üye giriş durumu için ek sorgu
if (isset($kullanici_kim['id']))
{
	if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
	else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
}
else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";



//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - BAŞI  //

$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='1' AND alt_menu='0' $drm_syf_ek ORDER BY sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$TEMA_MENU = '';


while ($menubag = $vt->fetch_array($vtsonuc))
{
	$TEMA_MENU .= phpkf_ust_menu($menubag, $tema_ozellik_genel_menu);
}

//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - SONU  //



header("Content-type: text/html; charset=utf-8");

// tema dosyası yükleniyor
include_once('phpkf-bilesenler/temalar/'.$temadizini_cms.'/baslik.php');

?>