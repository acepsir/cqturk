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
if (!defined('DOSYA_YONETIM_BASLIK_KOD')) include '../phpkf-bilesenler/oturum.php';
define('DOSYA_YONETIM_BASLIK',true);
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
include '../phpkf-bilesenler/seo.php';
header("Content-type: text/html; charset=utf-8");


if (isset($sayfa_adi)) $sayfa_adi = stripslashes($sayfa_adi);
else $sayfa_adi = '';
$sayfa_adi = str_replace('"', '', $sayfa_adi);
$sayfa_baslik = $sayfa_adi;
$site_baslik = $sayfa_adi;



// tema logo veya yazı
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



// Dil etiketleri
header("Content-type: text/html; charset=utf-8");
$TEMA_HTML_DIL = 'lang="'.$site_dili.'" dir="ltr"';
$TEMA_META_KARAKTER = 'utf-8';


if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';




//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - BAŞI  //

// Sayfalar, kategoriler, forum, portal ve üye giriş durumu için ek sorgu
$drm_syf_ek = '';
if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel'";
if ($cms_kullan != 1) $drm_syf_ek .= " AND ad!='cms' AND ad!='kategoriler' AND ad!='sayfalar' AND ad!='galeriler' AND ad!='videolar' AND ad!='etiket' AND ad!='iletisim'";


// üye giriş durumu için ek sorgu
if (isset($kullanici_kim['id']))
{
	if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
	else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
}
else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";


$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='1' AND alt_menu='0' $drm_syf_ek ORDER BY sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$TEMA_MENU = '';


while ($menubag = $vt->fetch_array($vtsonuc))
{
	$TEMA_MENU .= phpkf_ust_menu($menubag, $tema_ozellik_genel_menu, '../');
}

//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - SONU  //




// Tema uygulanıyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = $ust_dizin.'yonetim/temalar/'.$temadizini.'/baslik.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


//  KULLANICI GİRİŞ YAPMIŞSA    //

if ( isset($kullanici_kim['id']) )
{
	$kullanici_adi = $kullanici_kim['kullanici_adi'];
	$ornek1->kosul('9', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('{O}' => $o), true);

	if ($ayarlar['o_ileti'] == 1)
	{
		if ($kullanici_kim['okunmamis_oi'])
		{
			$ornek1->kosul('3', array('' => ''), false);
			$ornek1->kosul('4', array('{OKUNMAMIS_OI}' => $kullanici_kim['okunmamis_oi'],
			'{JAVASCRIPT_KODU}' => ''), true);
		}

		else
		{
			$ornek1->kosul('3', array('' => ''), true);
			$ornek1->kosul('4', array('' => ''), false);
		}
	}
	
	else
	{
		$ornek1->kosul('3', array('' => ''), false);
		$ornek1->kosul('4', array('' => ''), false);
	}
}


//  KULLANICI GİRİŞ YAPMAMIŞSA  //

else
{
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('3', array('' => ''), false);
	$kullanici_adi = '';
}

$css_satiri .= '<script src="../phpkf-bilesenler/js/phpkf-jsk.js" type="text/javascript"></script>
<script src="../phpkf-bilesenler/js/islemler_forum.js" type="text/javascript"></script>';


$dongusuz = array('{CIKIS_UYARISI}' => $kp_dil_523,
'{CSS_SATIRI}' => $css_satiri,
'{HIZLI_MENU}' => $kp_yonetim_366,
'{SAYFA_BASLIK}' => $sayfa_baslik,
'{SITE_BASLIK}' => $site_baslik,
'{KULLANICI_ADI}' => $kullanici_adi,
'{BASLIK_TABANI}' => $basliktabani,
'{PORTAL_INDEX}' => $phpkf_dosyalar['portal'],
'{FORUM_INDEX}' => $phpkf_dosyalar['forum'],
'{PORTAL}' => $kp_dil_3,
'{FORUM}' => $kp_dil_4,
'{YARDIM}' => $kp_dil_13,
'{UYELER}' => $kp_dil_14,
'{PROFIL_GORUNTULE}' => $kp_dil_15,
'{PROFIL_GORUNTULE2}' => $kp_yonetim_5,
'{DEGISTIR}' => $kp_dil__15,
'{OZEL_ILETI}' => $kp_dil_17,
'{ARAMA}' => $kp_dil_0,
'{CIKIS}' => $kp_dil_18,
'{GIRIS}' => $kp_dil_19,
'{KAYIT}' => $kp_dil_20);


$ornek1->dongusuz($dongusuz);
$ornek1->tema_uygula();
unset($dongusuz);
unset($ornek1);
?>