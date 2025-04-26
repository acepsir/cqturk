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
if (!isset($sayfano)) $sayfano = 200;


if (@is_file('ayar.php'))
{
	if (!defined('DOSYA_AYAR')) include 'ayar.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_BASLIK_KOD')) include 'phpkf-bilesenler/oturum.php';
	if (!defined('DOSYA_DILAYAR')) include 'portal/diller/dil_ayarlari.php';
	if (!defined('DOSYA_TEMA_SINIF')) include 'phpkf-bilesenler/sinif_tema_forum.php';

	$dosyaw = 'portal/kurulum/index.php';
	$dizin_adi = 'portal/diller/';
	$ust_dizin ='portal/';
	$alt_dizin ='';
}

else
{
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_BASLIK_KOD')) include '../phpkf-bilesenler/oturum.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	$dosyaw = 'kurulum/index.php';
	$dizin_adi = 'diller/';
	$ust_dizin ='';
	$alt_dizin ='../';
}

define('DOSYA_BASLIK',true);


//  RSS BAĞLANTILARI  //

$rss_satiri = '<link rel="alternate" type="application/rss+xml" title="phpKF Anasayfa" href="'.$alt_dizin.'rss.php" />
<script src="'.$alt_dizin.'phpkf-bilesenler/diller/'.$site_dili.'/javascript.js"></script>
<script src="'.$alt_dizin.'phpkf-bilesenler/js/phpkf-jsk.js" type="text/javascript"></script>
<script src="'.$alt_dizin.'phpkf-bilesenler/js/islemler_forum.js" type="text/javascript"></script>';
$rssadres = 'rss.php';



//  META ETİKETLERİ  //

header("Content-type: text/html; charset=utf-8");

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

$meta_etiketler = '<link rel="canonical" href="'.$meta_canonical.'" />
<meta name="content-language" content="'.$site_dili.'" />
<meta name="generator" content="phpKF" />'."\r\n".$ayarlar['meta_diger']."\r\n";



if (isset($sayfa_adi)) $sayfa_adi = stripslashes($sayfa_adi);
else $sayfa_adi = '';

if (isset($sayfano))
{
	if ($sayfano == 201) $site_baslik = str_replace('"', '', $ayarlar['title_anasyf']);
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
$sayfa_baslik = $site_baslik;





//  TEMA UYGULANIYOR  //

// css kodları
$TEMA_CSS = $css_satiri.'
<style type="text/css">
.genislik{width:'.$portal_ayarlar['portal_genislik'].'; margin:0 auto}
</style>';



// tema logo veya yazı
$TEMA_TITLE = $site_baslik;
$TEMA_LOGO_UST = $ayarlar['tema_logo_ust'];
$TEMA_LOGO_UST2 = $ayarlar['tema_logo_ust2'];

if ($TEMA_LOGO_UST != '')
{
	if (@!preg_match('/\<img/', $TEMA_LOGO_UST))
	{
		if ((@!preg_match('/\<a/', $TEMA_LOGO_UST)) AND ($temadizini == 'varsayilan')) $TEMA_LOGO_UST = '<a href="'.$anadizin.'">'.$TEMA_LOGO_UST.'</a>';
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



// Üyelik menüsü göster/gizle
if ($ayarlar['tema_uye_menusu'] == 1) $TEMA_UYELIK_MENU_GOSTER = true;
else
{
	if (isset($kullanici_kim['id'])) $TEMA_UYELIK_MENU_GOSTER = true;
	else $TEMA_UYELIK_MENU_GOSTER = false;
}



$dil_secenek = '';
if ($TEMA_DIL_SECIM)
{
$dil_secenek = '<div class="clear" style="height:10px"></div>
<div style="height:20px">
<form action="'.$alt_dizin.$phpkf_dosyalar['forum'].'" method="get" name="site_dili">
<select name="dil" class="formlar" style="padding:5px; width:auto; min-width:160px; text-align:center" onchange="if(this.options[this.selectedIndex].value!=\'0\'){document.forms[\'site_dili\'].submit()}">
'.$TEMA_DIL_SECIM.'
</select>
<input type="submit" value="'.$l['sec'].'" class="dugme dugme-mavi" style="padding:3px 8px" />
</form>
</div>';
}



if (($dosya_acw = @fopen($dosyaw,'r')) AND (!preg_match('/^[a-z_.]+$/', $dosyaw)) AND ($kullanici_kim['id'] == '1') )
	$kurulum_klasoru = '<font color="red">'.$kp_dil_521.'</font>';

else $kurulum_klasoru = '';
@fclose($dosya_acw);
$dizin_adi = '';



if ($ayarlar['f_dizin'] == '/') $af_dizin = '';
else $af_dizin = $ayarlar['f_dizin'];


$javascript_kodu2 = '<script type="text/javascript"><!-- //
var kp_dil_437 = "'.$kp_dil_437.'";
var kp_dil_525 = "'.$kp_dil_525.'";
var kp_dil_542 = "'.$kp_dil_542.'";
var kp_dil_543 = "'.$kp_dil_543.'";
var alanadi = "'.$TEMA_SITE_ANADIZIN.'portal/temalar/'.$temadizini.'/resimler/resimler/";
//  -->
</script>
<script type="text/javascript" src="'.$alt_dizin.'phpkf-bilesenler/js/betik_portal.js"></script>';




//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - BAŞI  //
if (isset($tema_ozellik_genel_menu)):

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
	$TEMA_MENU .= phpkf_ust_menu($menubag, $tema_ozellik_genel_menu, $alt_dizin);
}

endif;
//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - SONU  //



// Temada başlık bölümünün en altına kod eklemek için
$baslik_en_alt = '';


// Tema dosyası yükleniyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/baslik.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



//  KULLANICI GİRİŞ YAPMIŞSA    //
if ( isset($kullanici_kim['id']) )
{
	$kullanici_adi = $kullanici_kim['kullanici_adi'];
	$ornek1->kosul('9', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('{O}' => $o), true);
	$ornek1->kosul('10', array('{O}' => $o), true);

	if ($ayarlar['o_ileti'] == 1)
	{
		if ($kullanici_kim['okunmamis_oi'])
		{
			$ornek1->kosul('3', array('' => ''), false);
			$ornek1->kosul('4', array('{OKUNMAMIS_OI}' => $kullanici_kim['okunmamis_oi'],
			'{JAVASCRIPT_KODU}' => ''), true);
		}

		else $ornek1->kosul('4', array('' => ''), false);
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
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('9', array('' => ''), true);
	$ornek1->kosul('10', array('' => ''), false);
	$ornek1->kosul('YONETIM', array('' => ''), false);
	$kullanici_adi = '';
}


########################

if ($portal_bloklar_ayar['davetiye_sayfasi'] == 0) $ornek1->kosul('dv1', array('' => ''), false);
if ($portal_bloklar_ayar['anketler_sayfasi'] != 1) $ornek1->kosul('aa2', array('' => ''), false);
if ($portal_bloklar_ayar['dosyalar_sayfasi'] != 1) $ornek1->kosul('ad2', array('' => ''), false);
if ($portal_bloklar_ayar['galeri_sayfasi'] != 1) $ornek1->kosul('ag2', array('' => ''), false);
if ($portal_bloklar_ayar['haber_sayfasi'] != 1) $ornek1->kosul('ah2', array('' => ''), false);
if ($portal_bloklar_ayar['siteharitasi_sayfasi'] != 1) $ornek1->kosul('as2', array('' => ''), false);
if ($portal_bloklar_ayar['arama_sayfasi'] != 1) $ornek1->kosul('pas', array('' => ''), false);
if ($portal_bloklar_ayar['siteler_sayfasi'] != 1) $ornek1->kosul('pss', array('' => ''), false);
if ($portal_bloklar_ayar['takvim_sayfasi'] != 1) $ornek1->kosul('tkv', array('' => ''), false);

########################





$dongusuz = array(
'{DIL_SECENEK}' => $dil_secenek,
'{TEMA_DIZIN}' => $temadizini,
'{CIKIS_UYARISI}' => $kp_dil_523,
'{KURULUM_KLASORU}' => $kurulum_klasoru,
'{ALT_DIZIN}' => $alt_dizin,
'{UST_DIZIN}' => $ust_dizin,
'{PORTAL_INDEX}' => $phpkf_dosyalar['portal'],
'{FORUM_INDEX}' => $phpkf_dosyalar['portal'],
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
'{KAYIT}' => $kp_dil_20,
'{HIZLI_MENU}' => $kp_dil_490,
'{CSS_SATIRI}' => $TEMA_CSS,
'{SAYFA_BASLIK}' => $sayfa_baslik,
'{SITE_BASLIK}' => $site_baslik,
'{KULLANICI_ADI}' => $kullanici_adi,
'{RSS_SATIRI}' => $rss_satiri,
'{JAVASCRIPT_KODU2}' => $javascript_kodu2,
'{BASLIK_TABANI}' => $basliktabani,
'{ANASAYFA_BASLIK}' => $ayarlar['site_adi'],
'{GENISLIK}' => $portal_ayarlar['portal_genislik'],
'{FORUM_RENGINI_MAVI_YAP}' => $kp_dil_234,
'{FORUM_RENGINI_YESIL_YAP}' => $kp_dil_235,
'{FORUM_RENGINI_TURUNCU_YAP}' => $kp_dil_236,
'{FORUM_RENGINI_KIRMIZI_YAP}' => $kp_dil_237,
'{R_M_SAYFASI_1}' => $alt_dizin.$phpkf_dosyalar['portal'].'?renk=mavi',
'{R_Y_SAYFASI_1}' => $alt_dizin.$phpkf_dosyalar['portal'].'?renk=yesil',
'{R_T_SAYFASI_1}' => $alt_dizin.$phpkf_dosyalar['portal'].'?renk=turuncu',
'{R_K_SAYFASI_1}' => $alt_dizin.$phpkf_dosyalar['portal'].'?renk=kirmizi',
'{R_S_SAYFASI_1}' => $alt_dizin.$phpkf_dosyalar['portal'].'?renk=siyah',
'{FORUM_RENGINI_SIYAH_YAP}' => $kp_dil_238,
'{DAVETIYE}' => $kp_dil_212,
'{TAKVIM}' => $kp_dil_7,
'{ANKETLER}' => $kp_dil_164,
'{FAVORI_SITELER}' => $kp_dil_441,
'{DOSYALAR}' => $kp_dil_324,
'{HABERLER}' => $kp_dil_325,
'{PORTAL_ARAMA}' => $kp_dil_385,
'{SITEMAP}' => $kp_dil_124,
'{GALERI}' => $kp_dil_260,
'{RENK_SEC}' => $kp_dil_489,
'{TAKVIM_SAYFASI_1}' => $ust_dizin.'takvim.php',
'{ANKETLER_SAYFASI_1}' => $ust_dizin.'anket.php',
'{SITELER_SAYFASI_1}' => $ust_dizin.'site_ekle.php',
'{DOSYALAR_SAYFASI_1}' => $ust_dizin.'dosyalar.php',
'{SITEMAP_SAYFASI_1}' => $ust_dizin.'sitemap.php',
'{HABER_SAYFASI_1}' => $ust_dizin.'haberler.php',
'{DAVETIYE_SAYFASI_1}' => $ust_dizin.'davetiye.php',
'{GALERI_SAYFASI_1}' => $ust_dizin.'galeri.php',
'{PORTAL_ARAMA_SAYFASI_1}' => $ust_dizin.'portal_arama.php',
'{BASLIK_EN_ALT}' => $baslik_en_alt);

$arka_tablo = $portal_ayarlar['portal_arka_tablo'];



$ornek1->dongusuz($dongusuz);
$ornek1->tema_uygula();
unset($dongusuz);
unset($tekli1);
unset($ornek1);

?>