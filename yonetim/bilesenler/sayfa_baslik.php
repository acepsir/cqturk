<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_YONETIM_OTURUM')) include 'bilesenler/oturum.php';


// Varsayılan yönetim teması ayarlanıyor
$secili_tema = $ayarlar['temadizini'];
$ayarlar['temadizini'] = 'varsayilan';
$temadizini = $ayarlar['temadizini'];


// tema  tema.php  dosyası yükleniyor
include 'temalar/'.$temadizini.'/yonetim_tema.php';
$TEMA_CSS = $css_satiri;


// tema logo veya yazı
if (@!preg_match('/\<img/', $ayarlar['tema_logo_ust']))
{
	$TEMA_LOGO_UST = '<span id="baslikyazi">'.$ayarlar['tema_logo_ust'].'</span>';
}
else $TEMA_LOGO_UST = $ayarlar['tema_logo_ust'];


//	META ETİKETLERİ		//

header("Content-type: text/html; charset=utf-8");

$sayfa_baslik = $ayarlar['title'];
$site_baslik = str_replace('"', '', $ayarlar['title']);

if (isset($sayfa_adi)) $sayfa_baslik = $sayfa_adi;
else $sayfa_adi = '';




//	TEMA UYGULANIYOR	//

if (!defined('DOSYA_TEMA_SINIF')) include '../bilesenler/tema_sinif.php';

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/baslik.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


$javascript_kodu = '<script type="text/javascript"><!-- //
setInterval(\'ziplama()\',500);
//  -->
</script>';


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
			'{JAVASCRIPT_KODU}' => $javascript_kodu), true);
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


// portal kullanılıyorsa portal bağlantısı ekleniyor

if ($portal_kullan == 1)
{
	$ornek1->kosul('7', array('' => ''), false);
	$ornek1->kosul('8', array('{FORUM_INDEX}' => $forum_index, '{PORTAL_INDEX}' => $portal_index), true);
}

else
{
	$ornek1->kosul('8', array('' => ''), false);
	$ornek1->kosul('7', array('{FORUM_INDEX}' => $forum_index), true);
}


$dongusuz = array('{FORUM_INDEX}' => $forum_index,
'{CSS_SATIRI}' => $css_satiri,
'{SAYFA_BASLIK}' => $sayfa_baslik,
'{SITE_BASLIK}' => $site_baslik,
'{KULLANICI_ADI}' => $kullanici_adi,
'{BASLIK_TABANI}' => $basliktabani);

$ornek1->dongusuz($dongusuz);

$ornek1->tema_uygula();

unset($dongusuz);
unset($ornek1);

?>