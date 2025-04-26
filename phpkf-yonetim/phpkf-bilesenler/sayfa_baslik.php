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

if (isset($sayfa_adi)) $sayfa_adi = stripslashes($sayfa_adi);
else $sayfa_adi = '';
$sayfa_adi = str_replace('"', '', $sayfa_adi);
$site_baslik = $sayfa_adi;

if (!defined('DOSYA_YONETIM_OTURUM')) include_once('phpkf-bilesenler/oturum.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



// tema dizini ve css şablon kodları oluşturuluyor
$TEMA_CSS = '';
$temadizini_cms = 'varsayilan';
if ($secili_tema_cms == 'varsayilan') $sablon_kullan = true;

if ($cms_kullan == 1)
{
	if (isset($sablon_kullan)) $TEMA_CSS = '<link href="../phpkf-bilesenler/sablon.php" rel="stylesheet" type="text/css">'."\r\n";
}
else
{
	if ($secili_tema == 'varsayilan')
	{
		if ($ayarlar['tema_renk'] == 'mor') $TEMA_CSS = '<link href="../temalar/varsayilan/css/sablon_mor.css" rel="stylesheet" type="text/css" />';
		elseif ($ayarlar['tema_renk'] == 'gri') $TEMA_CSS = '<link href="../temalar/varsayilan/css/sablon_koyu.css" rel="stylesheet" type="text/css" />';
		elseif ($ayarlar['tema_renk'] == 'siyah') $TEMA_CSS = '<link href="../temalar/varsayilan/css/sablon_siyah.css" rel="stylesheet" type="text/css" />';
	}
}


// Dil etiketleri
$TEMA_HTML_DIL = 'lang="'.$site_dili.'" dir="ltr"';
$TEMA_META_KARAKTER = 'utf-8';


// title ve logo kodları oluşturuluyor
$TEMA_TITLE = $site_baslik;
$TEMA_LOGO_UST = $ayarlar['tema_logo_ust'];
$TEMA_LOGO_UST2 = $ayarlar['tema_logo_ust2'];

if ($TEMA_LOGO_UST != '')
{
	if (@!preg_match('/\<img/', $TEMA_LOGO_UST))
	{
		if (@!preg_match('/\<a/', $TEMA_LOGO_UST)) $TEMA_LOGO_UST = '<a href="'.$anadizin.'">'.$TEMA_LOGO_UST.'</a>';
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



// Arama ve etiket form kodları
$arama_adres = linkyap($phpkf_dosyalar['cms'].'?kip=arama', $ayarlar['dizin_arama']);
$etiket_adres = linkyap($phpkf_dosyalar['cms'].'?kip=etiket', $ayarlar['dizin_etiket']);
if ($ayarlar['seo'] == 0) $arama_seo = '0';
else $arama_seo = '1';


// forum ve portal durumu için ek sorgu
$drm_syf_ek = '';
if ($cms_kullan != 1) $drm_syf_ek .= " AND ad!='cms' AND ad!='kategoriler' AND ad!='sayfalar' AND ad!='galeriler' AND ad!='videolar' AND ad!='etiket' AND ad!='iletisim'";
if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel' AND ad!='yardim' AND ad!='mobil' AND ad!='rss'";
if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";

// üye giriş durumu için ek sorgu
if (isset($kullanici_kim['id']))
{
	if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
	else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
}
else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";



//  MENÜ BAĞLANTILARI OLUŞTURULUYOR

$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='1' AND alt_menu='0' $drm_syf_ek ORDER BY sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$TEMA_MENU = '';

while ($menubag = $vt->fetch_array($vtsonuc))
{
	$TEMA_MENU .= phpkf_ust_menu($menubag, $tema_ozellik_genel_menu, '../');
}



header("Content-type: text/html; charset=utf-8");

// tema dosyası yükleniyor
include_once('phpkf-bilesenler/temalar/'.$temadizini_cms.'/baslik.php');

?>