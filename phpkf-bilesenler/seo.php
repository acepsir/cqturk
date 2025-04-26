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
if (!defined('DOSYA_SEO')) define('DOSYA_SEO',true);
if ( ($ayarlar['seo'] != 0) AND (!defined('PHPKF_SEO')) ) define('PHPKF_SEO',true);


// CMS için
function sefyap($metin)
{
	$metin = mb_strtolower($metin, 'utf8');

	$ara = array (' ', ',', '.', 'ğ', 'ü', 'ş', 'ı', 'ö', 'ç');
	$degistir = array ('-', '-', '-', 'g', 'u', 's', 'i', 'o', 'c');
	$metin = str_replace($ara,$degistir,$metin);

	$ara = array(' ', '(', ')', '\'', '?' , '&nbsp', '&#34;', '&amp', '&', '\r\n', '\n', '/', '\\', '+');
	$metin = str_replace($ara, '-', $metin);

	$ara = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$degistir = array('', '-', '');
	$metin = @preg_replace($ara, $degistir, $metin);

	return $metin;
}


// CMS için
function linkyap($link, $url='', $ek='', $ek2='')
{
	global $ayarlar, $phpkf_dosyalar;

	//  KategoriAdı-k1/SayfaAdı-y1.html adres yapısı için
	if ($ayarlar['seo'] == 1)
	{
		$giren = array(	'/'.$phpkf_dosyalar['cms'].'\?k=([0-9]+)&y=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat&k=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=sayfa/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=galeri/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=video/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=etiket/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=arama/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=iletisim/',
		'/'.$phpkf_dosyalar['cms'].'\?etiket=(.*)/',
		'/'.$phpkf_dosyalar['cms'].'\?arama=(.*)/',
		'/'.$phpkf_dosyalar['profil'].'\?u=([0-9]+)&kim=(.*)/');


		$cikan = array(	sefyap($url).'-k\\1/'.sefyap($ek).'-y\\2.html',
		sefyap($url).'-k\\1/',
		$ayarlar['dizin_kat'].'/',
		$ayarlar['dizin_sayfa'].'/',
		$ayarlar['dizin_galeri'].'/',
		$ayarlar['dizin_video'].'/',
		$ayarlar['dizin_etiket'].'/',
		$ayarlar['dizin_arama'].'/',
		'iletisim.html',
		sefyap($url).$ayarlar['dizin_etiket'].'/\\1/',
		sefyap($url).$ayarlar['dizin_arama'].'/\\1/',
		'\\1-uye-'.sefyap($url).'.html');
	}


	//  KategoriAdı/SayfaAdı.html adres yapısı için
	elseif ($ayarlar['seo'] == 2)
	{
		$giren = array(	'/'.$phpkf_dosyalar['cms'].'\?k=([0-9]+)&y=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat&k=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=sayfa/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=galeri/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=video/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=etiket/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=arama/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=iletisim/',
		'/'.$phpkf_dosyalar['cms'].'\?etiket=(.*)/',
		'/'.$phpkf_dosyalar['cms'].'\?arama=(.*)/',
		'/'.$phpkf_dosyalar['profil'].'\?u=([0-9]+)&kim=(.*)/');


		$cikan = array(	sefyap($url).'/'.sefyap($ek).'.html',
		sefyap($url).'/',
		$ayarlar['dizin_kat'].'/',
		$ayarlar['dizin_sayfa'].'/',
		$ayarlar['dizin_galeri'].'/',
		$ayarlar['dizin_video'].'/',
		$ayarlar['dizin_etiket'].'/',
		$ayarlar['dizin_arama'].'/',
		'iletisim.html',
		sefyap($url).$ayarlar['dizin_etiket'].'/\\1/',
		sefyap($url).$ayarlar['dizin_arama'].'/\\1/',
		'uye-'.sefyap($url).'.html');
	}


	//  SayfaAdı-y1.html adres yapısı için
	elseif ($ayarlar['seo'] == 3)
	{
		$giren = array(	'/'.$phpkf_dosyalar['cms'].'\?k=([0-9]+)&y=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat&k=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=sayfa/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=galeri/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=video/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=etiket/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=arama/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=iletisim/',
		'/'.$phpkf_dosyalar['cms'].'\?etiket=(.*)/',
		'/'.$phpkf_dosyalar['cms'].'\?arama=(.*)/',
		'/'.$phpkf_dosyalar['profil'].'\?u=([0-9]+)&kim=(.*)/');


		$cikan = array(	sefyap($ek).'-y\\2.html',
		sefyap($url).'-k\\1/',
		$ayarlar['dizin_kat'].'/',
		$ayarlar['dizin_sayfa'].'/',
		$ayarlar['dizin_galeri'].'/',
		$ayarlar['dizin_video'].'/',
		$ayarlar['dizin_etiket'].'/',
		$ayarlar['dizin_arama'].'/',
		'iletisim.html',
		sefyap($url).$ayarlar['dizin_etiket'].'/\\1/',
		sefyap($url).$ayarlar['dizin_arama'].'/\\1/',
		'\\1-uye-'.sefyap($url).'.html');
	}



	//  SayfaAdı.html adres yapısı için
	elseif ($ayarlar['seo'] == 4)
	{
		$giren = array(	'/'.$phpkf_dosyalar['cms'].'\?k=([0-9]+)&y=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat&k=([0-9]+)/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=kat/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=sayfa/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=galeri/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=video/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=etiket/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=arama/',
		'/'.$phpkf_dosyalar['cms'].'\?kip=iletisim/',
		'/'.$phpkf_dosyalar['cms'].'\?etiket=(.*)/',
		'/'.$phpkf_dosyalar['cms'].'\?arama=(.*)/',
		'/'.$phpkf_dosyalar['profil'].'\?u=([0-9]+)&kim=(.*)/');


		$cikan = array(	sefyap($ek).'.html',
		sefyap($url).'/',
		$ayarlar['dizin_kat'].'/',
		$ayarlar['dizin_sayfa'].'/',
		$ayarlar['dizin_galeri'].'/',
		$ayarlar['dizin_video'].'/',
		$ayarlar['dizin_etiket'].'/',
		$ayarlar['dizin_arama'].'/',
		'iletisim.html',
		sefyap($url).$ayarlar['dizin_etiket'].'/\\1/',
		sefyap($url).$ayarlar['dizin_arama'].'/\\1/',
		'uye-'.sefyap($url).'.html');
	}



	if (defined('PHPKF_SEO'))
	{
		$link = @preg_replace($giren, $cikan, $link);
		if ($ek2 != '') $link .= '?'.$ek2;
	}

	else
	{
		$link = preg_replace('/\?k=([0-9]+)&y=/', '?y=', $link);
		$link = @str_replace('&', '&amp;', $link);
		if ($ek2 != '') $link .= '&amp;'.$ek2;
	}

	return $link;
}





// Forum için
function seoyap($metin)
{
	$metin = mb_strtolower($metin, 'utf8');

	$ara = array (' ', ',', '.', 'ğ', 'ü', 'ş', 'ı', 'ö', 'ç');
	$degistir = array ('-', '-', '-', 'g', 'u', 's', 'i', 'o', 'c');
	$metin = str_replace($ara,$degistir,$metin);

	$ara = array(' ', '(', ')', '\'', '?' , '&nbsp', '&#34;', '&amp', '&', '\r\n', '\n', '/', '\\', '+');
	$metin = str_replace($ara, '-', $metin);

	$ara = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$degistir = array('', '-', '');
	$metin = @preg_replace($ara, $degistir, $metin);

	return $metin;
}


// Forum için
function linkver($link, $url='', $ek='', $ek2='')
{
	global $phpkf_dosyalar;

	$giren = array('/forum.php\?f=([0-9]+)&fs=([0-9]+)/',
	'/forum.php\?f=([0-9]+)/',
	'/konu.php\?k=([0-9]+)&fs=([0-9]+)&ks=([0-9]+)/',
	'/konu.php\?k=([0-9]+)&fs=([0-9]+)/',
	'/konu.php\?k=([0-9]+)&ks=([0-9]+)/',
	'/konu.php\?k=([0-9]+)/',
	'/'.$phpkf_dosyalar['profil'].'\?kim=(.*)/',
	'/'.$phpkf_dosyalar['profil'].'\?u=([0-9]+)&kim=(.*)/');

	$cikan = array('f\\1fs\\2-'.seoyap($url).'.html',
	'f\\1-'.seoyap($url).'.html',
	'k\\1fs\\2ks\\3-'.seoyap($url).'.html',
	'k\\1fs\\2-'.seoyap($url).'.html',
	'k\\1ks\\2-'.seoyap($url).'.html',
	'k\\1-'.seoyap($url).'.html',
	'uye-'.$url.'.html',
	'\\1-uye-'.seoyap($url).'.html');

	if (defined('PHPKF_SEO')) $link = @preg_replace($giren, $cikan, $link);
	else $link = @str_replace('&', '&amp;', $link);

	$link .= $ek;
	return $link; 
}

?>