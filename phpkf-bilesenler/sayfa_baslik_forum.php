<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
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
if (!defined('DOSYA_AYAR')) include 'ayar.php';
if (!defined('DOSYA_OTURUM')) include 'oturum.php';
if (!defined('PHPKF_SEO')) include_once('phpkf-bilesenler/seo.php');


// Sayfa title ayarları
if (isset($sayfa_adi)) $sayfa_adi = stripslashes($sayfa_adi);
else $sayfa_adi = '';

if (isset($sayfano))
{
	if ($sayfano == 1) $site_baslik = str_replace('"', '', $ayarlar['title_anasyf']);
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



//  KULLANICI TEMA SEÇİMİ UYGULANIYOR  //

if( (isset($kullanici_kim['temadizini'])) AND ($kullanici_kim['temadizini'] != '') )
	$temadizini = $kullanici_kim['temadizini'];




//  META ETİKETLERİ - BAŞI  //

if ( (isset($yazi['baslik'])) AND ($yazi['baslik'] != '') AND ($sayfano != 1) )
	$meta_description = $yazi['baslik'];
else $meta_description = $ayarlar['meta_description'];


if ( (isset($yazi['etiket'])) AND ($yazi['etiket'] != '') AND ($sayfano != 1) )
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


$meta_etiketler = '<link rel="canonical" href="'.$meta_canonical.'" />
<meta name="content-language" content="'.$site_dili.'" />
<meta name="description" content="'.$meta_description.'" />
<meta name="keywords" content="'.$meta_keywords.'" />
<meta name="generator" content="phpKF" />
'.$ayarlar['meta_diger']."\r\n".$meta_sosyal."\r\n";

//  META ETİKETLERİ - SONU  //




//  RSS BAĞLANTILARI  //

if ( (isset($_GET['f'])) AND ($_GET['f'] != '') AND (is_numeric($_GET['f']) == true) )
{
	$rss_satiri = '<link rel="alternate" type="application/rss+xml" title="Anasayfa - Forum '.$_GET['f'].'" href="'.$phpkf_dosyalar['rss'].'?f='.$_GET['f'].'" />';
	$rssadres = $phpkf_dosyalar['rss'].'?f='.$_GET['f'];
}

elseif (isset($mesaj_satir['hangi_forumdan']))
{
	$rss_satiri = '<link rel="alternate" type="application/rss+xml" title="Anasayfa - Forum '.$mesaj_satir['hangi_forumdan'].'" href="'.$phpkf_dosyalar['rss'].'?f='.$mesaj_satir['hangi_forumdan'].'" />';
	$rssadres = $phpkf_dosyalar['rss'].'?f='.$mesaj_satir['hangi_forumdan'];
}

else
{
	$rss_satiri = '<link rel="alternate" type="application/rss+xml" title="Anasayfa" href="'.$phpkf_dosyalar['rss'].'" />';
	$rssadres = $phpkf_dosyalar['rss'];
}
$rss_satiri .= "\r\n".'<script src="phpkf-bilesenler/diller/'.$site_dili_js.'/javascript.js"></script>
<script src="phpkf-bilesenler/js/phpkf-jsk.js" type="text/javascript"></script>
<script src="phpkf-bilesenler/js/islemler_forum.js" type="text/javascript"></script>'."\r\n";



// DUYURU BİLGİLERİ ÇEKİLİYOR //

$vtsorgu = "SELECT * FROM $tablo_duyurular WHERE fno!='por' AND fno!='ozel' ORDER BY fno='tum' desc";
$duyuru_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// DUYURU VARSA DÖNGÜYE GİRİLİYOR //

if ($vt->num_rows($duyuru_sonuc)) 
{
	while ($duyurular = $vt->fetch_assoc($duyuru_sonuc))
	{
		if ($duyurular['fno'] == 'tum') $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

		if (isset($kullanici_kim['id']))
		{
			if ($duyurular['fno'] == 'uye') $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

			if (($duyurular['fno'] == 'byar') AND ($kullanici_kim['yetki'] == '3')) $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

			if (($duyurular['fno'] == 'fyar') AND ($kullanici_kim['yetki'] == '2')) $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

			if (($duyurular['fno'] == 'yon') AND ($kullanici_kim['yetki'] == '1')) $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);
		}

		else {if ($duyurular['fno'] == 'mis') $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);}

		if ( (isset($_GET['f']) AND ($duyurular['fno'] == $_GET['f'])) OR (isset($mesaj_satir['hangi_forumdan']) AND ($duyurular['fno'] == $mesaj_satir['hangi_forumdan'])) )
			$tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);
	}
}



// Tema sınıfı yükleniyor
if (!defined('DOSYA_TEMA_SINIF')) include 'sinif_tema_forum.php';


// tema  tema.php  dosyası yükleniyor
include 'temalar/'.$temadizini.'/tema.php';
$TEMA_CSS = '<link href="'.$css_satiri.'" rel="stylesheet" type="text/css" />
<style type="text/css">
.genislik{width:'.$ayarlar['tema_genislik'].'; margin:0 auto}';
if (isset($sagdan_sola)) $TEMA_CSS .= $sagdan_sola."\r\n";
$TEMA_CSS .= '</style>';



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




//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - BAŞI  //
if (isset($tema_ozellik_genel_menu)):

// Sayfalar, kategoriler, forum, portal ve üye giriş durumu için ek sorgu
$drm_syf_ek = '';
if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";
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
	$TEMA_MENU .= phpkf_ust_menu($menubag, $tema_ozellik_genel_menu);
}

endif;
//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - SONU  //



// Temada başlık bölümünün en altına kod eklemek için
$baslik_en_alt = '';


// Tema dosyası yükleniyor
header("Content-type: text/html; charset=utf-8");

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/baslik.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



//  KULLANICI GİRİŞ YAPMIŞSA  //
if (isset($kullanici_kim['id']))
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

	if ($kullanici_kim['yetki'] != '1') $ornek1->kosul('YONETIM', array('' => ''), false);
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


//  DUYURU TABLOSU AYARLARI  //

// duyuru varsa koşul 5 alanı tekli döngüye sokuluyor ve koşul 6 alanı gizleniyor
if (isset($tekli1))
{
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->tekli_dongu('1',$tekli1);
	unset($tekli1);
}

// duyuru yoksa koşul 5 alanı gizleniyor
else $ornek1->kosul('5', array('' => ''), false);



// portal kullanılıyorsa portal bağlantısı ekleniyor
if ($portal_kullan == 1)
{
	$ornek1->kosul('7', array('' => ''), false);
	$ornek1->kosul('8', array('{FORUM_INDEX}' => $phpkf_dosyalar['forum'], '{PORTAL_INDEX}' => $phpkf_dosyalar['portal']), true);
}
else
{
	$ornek1->kosul('8', array('' => ''), false);
	$ornek1->kosul('7', array('{FORUM_INDEX}' => $phpkf_dosyalar['forum']), true);
}



// Tema değişkenleri
$dongusuz = array('{CSS_SATIRI}' => $TEMA_CSS,
'{SAYFA_BASLIK}' => $sayfa_baslik,
'{SITE_BASLIK}' => $site_baslik,
'{KULLANICI_ADI}' => $kullanici_adi,
'{RSS_SATIRI}' => $rss_satiri,
'{BASLIK_TABANI}' => $basliktabani,
'{BASLIK_EN_ALT}' => $baslik_en_alt);


// Tema uygulanıyor
$ornek1->dongusuz($dongusuz);
$ornek1->tema_uygula();

unset($dongusuz);
unset($tekli1);
unset($ornek1);

?>