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


if (!defined('DOSYA_TEMA_SINIF')) define('DOSYA_TEMA_SINIF',true);
if (!defined('DOSYA_TEMA_OZELLIK'))
{
	if (@include_once('temalar/'.$temadizini_cms.'/tema_ozellik.php'));
	else {echo '<h2>Tema dosyası bulunamıyor!</h2>';exit();}
}
if (!defined('DOSYA_SEO')) include_once('phpkf-bilesenler/seo.php');
if (!defined('DOSYA_SISTEM_SINIF')) include_once('sinif_sistem.php');


$fhata1 = '<br /><br /><font color="#ff0000"><b><u>Tema Fonksiyon Hatası:</u></b></font>&nbsp;<b>';
$fhata2 = '</b><br /><br />';




// sitenin tam adresi <base> etiketi için
function phpkf_site_tam_adres()
{
	global $TEMA_SITE_ANADIZIN;
	echo $TEMA_SITE_ANADIZIN;
}


// CSS etiketi <link type="text/css"...
function phpkf_tema_css()
{
	global $TEMA_CSS;
	echo $TEMA_CSS;
}


// <title> etiketi
function phpkf_tema_title()
{
	global $TEMA_TITLE;
	echo $TEMA_TITLE;
}


// <meta ... etiketleri
function phpkf_tema_meta()
{
	global $TEMA_META_ETIKET;
	echo $TEMA_META_ETIKET;
}


// Tema yorum sayfası
function phpkf_tema_sayfa_yorum()
{
	global $temadizini_cms;
	$dosya = "include_once('phpkf-bilesenler/temalar/$temadizini_cms/yorum.php');";

	return $dosya;
}


// Yazı etiket oluştur
function phpkf_tema_etiket($etiketler)
{
	global $phpkf_dosyalar;
	$etiketler = explode(',', $etiketler);
	$cikis = '';

	foreach ($etiketler as $etiket){
		$etiket = trim($etiket);
		if ($etiket != '') $cikis .= '<a href="'.linkyap($phpkf_dosyalar['cms'].'?etiket='.urlencode($etiket)).'" rel="tag" title="'.$etiket.'">'.$etiket.'</a>, ';
	}

	if ($cikis != '') return $cikis;
	return false;
}




// Blok Göster
function phpkf_tema_blok_goster($yer=0)
{
	global $fhata1, $fhata2, $TEMA_SOLBLOK_GOSTER, $TEMA_SAGBLOK_GOSTER;

	if ((!is_numeric($yer)) OR ($yer == 0)) echo $fhata1.' blok_goster(1 veya 2) şeklinde olmalı.'.$fhata2;
	else if ($yer == 1) echo $TEMA_SOLBLOK_GOSTER;
	else if ($yer == 2) echo $TEMA_SAGBLOK_GOSTER;
	else echo $fhata1.' blok_goster(1 veya 2) şeklinde olmalı.'.$fhata2;
}




//  Kategoriler Fonksiyonu  //

function phpkf_tema_kategoriler($dizi = array())
{
	global $ayarlar;

	if (is_array($dizi))
	{
		if (isset($dizi['sayfa'])) $dizi['sayfa'] = zkTemizleNumara($dizi['sayfa']);

		if ((isset($dizi['kat_id'])) AND (is_numeric($dizi['kat_id'])) AND ($dizi['kat_id'] != 0)) {
			$kosul['kosul'] = "WHERE id='$dizi[kat_id]'"; $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		elseif ((isset($dizi['kat_adi'])) AND ($dizi['kat_adi'] != '')) {
			$kosul['kosul'] = "WHERE adres='$dizi[kat_adi]'"; $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		elseif ((isset($dizi['alt_kat'])) AND (is_numeric($dizi['alt_kat'])) AND ($dizi['alt_kat'] != 0)) {
			$kosul['kosul'] = "WHERE alt_kat='$dizi[alt_kat]'";}
		else $kosul['kosul'] = "WHERE alt_kat='0'";

		if ((isset($dizi['tip'])) AND (is_numeric($dizi['tip'])))
		{
			if ($kosul['kosul'] == '') $kosul['kosul'] = "WHERE tip='$dizi[tip]'";
			else $kosul['kosul'] .= " AND tip='$dizi[tip]'";
		}

		if ((isset($dizi['sirala'])) AND ($dizi['sirala'] != '')) $kosul['sirala'] = 'ORDER BY '.$dizi['sirala'];
		elseif ((isset($dizi['sirala'])) AND ($dizi['sirala'] == '')) $kosul['sirala'] = '';
		else $kosul['sirala'] = 'ORDER BY sira,id';

		if ((isset($dizi['sayfa'])) AND (is_numeric($dizi['sayfa'])) AND ($dizi['sayfa']!= 0))
		{
			if ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0)) $kosul['kota'] = "LIMIT $dizi[sayfa],$dizi[kota]";
			else $kosul['kota'] = "LIMIT $dizi[sayfa],$ayarlar[kat_syfkota]";
		}
		elseif ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0))
			$kosul['kota'] = "LIMIT $dizi[kota]";
		else $kosul['kota'] = '';
	}

	else
	{
		$kosul = array(
		'kosul' => '',
		'sirala' => 'ORDER BY sira,id',
		'kota' => ''
		//'haric'  => '', // hangi kategoriler gösterilmesin (id'leri virgülle ayır)
		//'dahil'  => '', // hangi kategoriler gösterilsin (id'leri virgülle ayır)
		//'bos'  => 0, // boş kategoriler gösterilsin mi? (1 göster, 0 gösteme)
		);
	}

	return(phpkf_kategoriler($kosul));
}




//  Alt Kategoriler Fonksiyonu  //

function phpkf_tema_alt_kategoriler($dizi = array())
{
	if (is_array($dizi))
	{
		if ((isset($dizi['alt_kat'])) AND (is_numeric($dizi['alt_kat'])))
			$kosul['kosul'] = "WHERE alt_kat='$dizi[alt_kat]'";
		else $kosul['kosul'] = "WHERE id='0' LIMIT 0";


		if ((isset($dizi['sirala'])) AND ($dizi['sirala'] != '')) $kosul['sirala'] = 'ORDER BY '.$dizi['sirala'];
		elseif ((isset($dizi['sirala'])) AND ($dizi['sirala'] == '')) $kosul['sirala'] = '';
		else $kosul['sirala'] = 'ORDER BY sira,id';


		if ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0))
			$kosul['kota'] = "LIMIT $dizi[kota]";
		else $kosul['kota'] = '';
	}

	else
	{
		$kosul = array(
		'kosul' => '',
		'sirala' => 'ORDER BY sira,id',
		'kota' => ''
		);
	}

	return(phpkf_alt_kategoriler($kosul));
}




//  Yazılar Fonksiyonu  //

function phpkf_tema_yazilar($dizi = array())
{
	global $ayarlar, $site_dili;
	$tarih = time();

	// Dil seçimine göre içerik alınıyor
	$etiketek = ''; $baslikek = ''; $icerikek = '';
	if ($ayarlar['dil_varsayilan'] != $site_dili)
	{
		if (preg_match("/,$site_dili,/", $ayarlar['dil_eklenen_alanlar']))
		{
			$etiketek = ',etiket_'.$site_dili;
			$baslikek = ',baslik_'.$site_dili;
			$icerikek = ',icerik_'.$site_dili;
		}
	}

	if (is_array($dizi))
	{
		if (isset($dizi['sayfa_no'])) $dizi['sayfa_no'] = zkTemizleNumara($dizi['sayfa_no']);
		if (isset($dizi['sayfa'])) $dizi['sayfa'] = zkTemizleNumara($dizi['sayfa']);

		if ((isset($dizi['yazi_id'])) AND (is_numeric($dizi['yazi_id'])) AND ($dizi['yazi_id'] != 0)) {
			$kosul['kosul'] = "WHERE id='$dizi[yazi_id]'"; $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		elseif ((isset($dizi['yazi_adi'])) AND ($dizi['yazi_adi'] != '')) {
			$kosul['kosul'] = "WHERE adres='$dizi[yazi_adi]'"; $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		elseif ((isset($dizi['alt_yazi'])) AND (is_numeric($dizi['alt_yazi'])) AND ($dizi['alt_yazi'] != 0)) {
			$kosul['kosul'] = "WHERE alt_yazi='$dizi[alt_yazi]' AND sayfa_no='$dizi[sayfa_no]'"; $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		else $kosul['kosul'] = '';


		if ((isset($dizi['yazan_id'])) AND (is_numeric($dizi['yazan_id']))) {
			$yazan = "AND yazan_id='$dizi[yazan_id]'"; $kosul['kosul'] = '';}
		elseif ((isset($dizi['yazan'])) AND ($dizi['yazan'] != '')) {
			$yazan = "AND yazan='$dizi[yazan]'"; $kosul['kosul'] = '';}
		else $yazan = '';

		if (!isset($dizi['kat_id'])) $dizi['kat_id'] = '';
		if ((!isset($dizi['tip'])) OR (!is_numeric($dizi['tip']))) $dizi['tip'] = '';

		if ((isset($dizi['etiket'])) AND ($dizi['etiket'] != ''))
		{
			$a = explode(',', $dizi['etiket']); $etiket = 'AND (';
			foreach ($a as $b) {if (trim($b) != '') $etiket .= "etiket LIKE '%".trim($b).",%' OR ";}
			$etiket = substr($etiket,0,-4).')';
		}
		else $etiket = '';

		if ((isset($dizi['yayin'])) AND ($dizi['yayin'] == 1)) $yayin_tarihi = '';
		else $yayin_tarihi = "AND yayin_tarihi<$tarih";


		if ($kosul['kosul'] == '')
		{
			if ($dizi['kat_id'] != '') $kosul['kosul'] = "WHERE kategori LIKE '%,$dizi[kat_id],%' AND alt_yazi='0' $yazan $etiket $yayin_tarihi";
			if (($dizi['tip'] == '0') OR ($dizi['tip'] != ''))
			{
				if ($kosul['kosul'] == '') $kosul['kosul'] = "WHERE tip='$dizi[tip]' AND alt_yazi='0' $yazan $etiket $yayin_tarihi";
				else $kosul['kosul'] .= " AND tip='$dizi[tip]'";
			}
			else
			{
				if ($kosul['kosul'] == '') $kosul['kosul'] = "WHERE tip!='1' AND tip!='3' AND alt_yazi='0' $yazan $etiket $yayin_tarihi";
				else $kosul['kosul'] .= " AND tip!='1' AND tip!='3' ";
			}
			if ($kosul['kosul'] == '') $kosul['kosul'] = "WHERE alt_yazi='0' $yazan $etiket $yayin_tarihi";
		}


		if ((isset($dizi['alan'])) AND ($dizi['alan'] != '')) {
			if ($dizi['alan'] == '*') $kosul['alan'] = '*';
			else $kosul['alan'] = $dizi['alan'];}
		else $kosul['alan'] = 'id,tip,kategori,alt_yazi,sayfa_no,tarih,yayin_tarihi,yazan,yazan_id,goruntuleme,yorum_sayi,adres,etiket,baslik'.$etiketek.$baslikek.$icerikek;

		if ((isset($dizi['tum_icerik'])) AND ($dizi['tum_icerik'] == 0)) $kosul['tum_icerik'] = 0;
		else $kosul['tum_icerik'] = 1;

		if ((isset($dizi['sirala'])) AND ($dizi['sirala'] != '')) $kosul['sirala'] = 'ORDER BY '.$dizi['sirala'];
		elseif ((isset($dizi['sirala'])) AND ($dizi['sirala'] == '')) $kosul['sirala'] = '';
		else $kosul['sirala'] = 'ORDER BY yayin_tarihi DESC';

		if ((isset($dizi['sayfa'])) AND (is_numeric($dizi['sayfa'])))
		{
			if ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0)) $kosul['kota'] = "LIMIT $dizi[sayfa],$dizi[kota]";
			else $kosul['kota'] = "LIMIT $dizi[sayfa],$ayarlar[syfkota_guncel]";
		}
		elseif ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0))
			$kosul['kota'] = "LIMIT $dizi[kota]";
		else $kosul['kota'] = '';
	}

	else
	{
		$kosul = array(
		'kosul' => '',
		'alan' => 'id,tip,kategori,alt_yazi,sayfa_no,tarih,yayin_tarihi,yazan,yazan_id,goruntuleme,yorum_sayi,adres,etiket,baslik'.$etiketek.$baslikek.$icerikek,
		'tum_icerik' => 1,
		'sirala' => 'ORDER BY yayin_tarihi DESC',
		'kota' => ''
		);
	}

	return(phpkf_yazilar($kosul));
}




//  Alt Yazılar Fonksiyonu  //

function phpkf_tema_alt_yazilar($dizi = array())
{
	global $l;

	if (is_array($dizi))
	{
		if ((isset($dizi['alt_yazi'])) AND (is_numeric($dizi['alt_yazi'])))
			$kosul['kosul'] = "WHERE alt_yazi='$dizi[alt_yazi]'";
		else $kosul['kosul'] = "WHERE id='0' LIMIT 0";
	}

	else $kosul['kosul'] = "WHERE id='0' LIMIT 0";


	if (!isset($dizi['link'])) $dizi['link'] = '';
	if (@preg_match('/\?/', $dizi['link'])) $ek = '&amp;';
	else $ek = '?';

	$cikis = '<ul class="liste-alt-sayfa"><li>'.$l['sayfa'].':&nbsp;';
	$toplam = phpkf_toplam_yazi($kosul);

	for ($sayi=0; $sayi < $toplam+1; $sayi++)
	{
		if ($sayi != 0) $sayfa = $ek.'ys='.($sayi+1);
		else $sayfa = '';
		$cikis .= '<span><a href="'.$dizi['link'].$sayfa.'">'.($sayi+1).'</a></span>';
	}
	$cikis .= '</li></ul>';

	return($cikis);
}




//  Toplam Yazı Fonksiyonu  //

function phpkf_tema_toplam_yazi($dizi = array())
{
	$tarih = time();

	if (is_array($dizi))
	{
		if ((!isset($dizi['tip'])) OR (!is_numeric($dizi['tip']))) $dizi['tip'] = '';
		if ((!isset($dizi['alt_yazi'])) OR (!is_numeric($dizi['alt_yazi']))) $dizi['alt_yazi'] = '';
		if (!isset($dizi['kat_id'])) $dizi['kat_id'] = '';

		if ((isset($dizi['yazan_id'])) AND (is_numeric($dizi['yazan_id']))) $yazan = "AND yazan_id='$dizi[yazan_id]'";
		elseif ((isset($dizi['yazan'])) AND ($dizi['yazan'] != '')) $yazan = "AND yazan='$dizi[yazan]'";
		else $yazan = '';

		if ((isset($dizi['yayin'])) AND ($dizi['yayin'] == 1)) $yayin_tarihi = '';
		else $yayin_tarihi = "AND yayin_tarihi<$tarih";

		if ((isset($dizi['etiket'])) AND ($dizi['etiket'] != ''))
		{
			$a = explode(',', $dizi['etiket']); $etiket = 'AND (';
			foreach ($a as $b) {if (trim($b) != '') $etiket .= "etiket LIKE '%".trim($b).",%' OR ";}
			$etiket = substr($etiket,0,-4).')';
		}
		else $etiket = '';

		if ($dizi['kat_id'] != '') $kosul['kosul'] = "WHERE kategori LIKE '%,$dizi[kat_id],%' AND alt_yazi='0' $yazan $etiket $yayin_tarihi";
		if (($dizi['tip'] == '0') OR ($dizi['tip'] != ''))
		{
			if (!isset($kosul['kosul'])) $kosul['kosul'] = "WHERE tip='$dizi[tip]' AND alt_yazi='0' $yazan $etiket $yayin_tarihi";
			else $kosul['kosul'] .= " AND tip='$dizi[tip]'";
		}
		else
		{
			if (!isset($kosul['kosul'])) $kosul['kosul'] = "WHERE tip!='1' AND tip!='3' AND alt_yazi='0' $yazan $etiket $yayin_tarihi";
			else $kosul['kosul'] .= " AND tip!='1' AND tip!='3'";
		}
		if ($dizi['alt_yazi'] != '') $kosul['kosul'] = "WHERE alt_yazi='$dizi[alt_yazi]'";
		if (!isset($kosul['kosul'])) $kosul['kosul'] = "WHERE alt_yazi='0' $yayin_tarihi";
	}

	else
	{
		$kosul = array(
		'kosul' => ''
		);
	}

	return(phpkf_toplam_yazi($kosul));
}




//  Yorumlar Fonksiyonu  //

function phpkf_tema_yorumlar($dizi = array())
{
	global $ayarlar,$_COOKIE;

	if (is_array($dizi))
	{
		if (isset($dizi['sayfa'])) $dizi['sayfa'] = zkTemizleNumara($dizi['sayfa']);
		if ((isset($dizi['yanit'])) AND ($dizi['yanit'] == 1)) $yanit = '';
		else $yanit = "AND yanit<2";

		if ((isset($dizi['yorum_id'])) AND (is_numeric($dizi['yorum_id'])) AND ($dizi['yorum_id'] != 0)) {
			$kosul['kosul'] = "WHERE id='$dizi[yorum_id]'";  $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		elseif ((isset($dizi['yazi_id'])) AND (is_numeric($dizi['yazi_id'])) AND ($dizi['yazi_id'] != ''))
			$kosul['kosul'] = "WHERE yazi_id='$dizi[yazi_id]' AND onay='1' $yanit";
		elseif ((isset($dizi['kat_id'])) AND (is_numeric($dizi['kat_id'])) AND ($dizi['kat_id'] != ''))
		{
			if (isset($kosul['kosul'])) $kosul['kosul'] .= " AND kat_id='$dizi[kat_id]'";
			else $kosul['kosul'] = "WHERE kat_id='$dizi[kat_id]' AND onay='1' $yanit";
		}
		else $kosul['kosul'] = "WHERE onay='1' $yanit";


		if ((isset($dizi['sirala'])) AND ($dizi['sirala'] != '')) $kosul['sirala'] = 'ORDER BY '.$dizi['sirala'];
		elseif ((isset($dizi['sirala'])) AND ($dizi['sirala'] == '')) $kosul['sirala'] = '';
		else
		{
			if (isset($_COOKIE['yorum_siralama'])) {
				if ($_COOKIE['yorum_siralama'] == '1') $kosul['sirala'] = 'ORDER BY id';
				else $kosul['sirala'] = 'ORDER BY id DESC';
			}
			elseif ($ayarlar['yorum_siralama'] == 1) $kosul['sirala'] = 'ORDER BY id';
			else $kosul['sirala'] = 'ORDER BY id DESC';
		}

		if ((isset($dizi['sayfa'])) AND (is_numeric($dizi['sayfa'])))
		{
			if ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0)) $kosul['kota'] = "LIMIT $dizi[sayfa],$dizi[kota]";
			else $kosul['kota'] = "LIMIT $dizi[sayfa],$ayarlar[syfkota_yorum]";
		}
		elseif ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0))
			$kosul['kota'] = "LIMIT $dizi[kota]";
		else $kosul['kota'] = '';

		if ( (isset($dizi['bbcode'])) AND ($dizi['bbcode'] == 0) ) $kosul['bbcode'] = 0;
		else $kosul['bbcode'] = 1;

		if ( (isset($dizi['ifade'])) AND ($dizi['ifade'] == 0) ) $kosul['ifade'] = 0;
		else $kosul['ifade'] = 1;
	}

	else
	{
		$kosul = array(
		'kosul' => '',
		'sirala' => 'ORDER BY id',
		'kota' => '',
		'bbcode' => 1,
		'ifade' => 1
		);
	}

	return(phpkf_yorumlar($kosul));
}




//  Yetkiler Fonksiyonu  //

function phpkf_tema_yetkiler($id=0, $yetki=0, $tam=0)
{
	global $l;

	if ($id == 1)
	{
		$dizi['isim'] = $l['kurucu'];
		$dizi['renk'] = 'kurucu';
	}
	elseif ($yetki == 1)
	{
		$dizi['isim'] = $l['yonetici'];
		$dizi['renk'] = 'yonetici';
	}
	elseif ($yetki == 2)
	{
		$dizi['isim'] = $l['yardimci'];
		$dizi['renk'] = 'yardimci';
	}
	elseif ($yetki == 3)
	{
		$dizi['isim'] = $l['blm_yrd'];
		$dizi['renk'] = 'blm_yrd';
	}
	else
	{
		if ($tam == 1)
		{
			$dizi['isim'] = $l['kullanici'];
			$dizi['renk'] = 'kullanici';
		}
		else $dizi = false;
	}

	return($dizi);
}




//  Üyeler Fonksiyonu  //

function phpkf_tema_uyeler($dizi = array())
{
	if (is_array($dizi))
	{
		if (isset($dizi['sayfa'])) $dizi['sayfa'] = zkTemizleNumara($dizi['sayfa']);

		if ((isset($dizi['arama'])) AND ($dizi['arama'] != '')) $kosul['arama'] = "AND kullanici_adi LIKE '".@zkTemizle0($dizi['arama'])."%'";
		else $kosul['arama'] = '';

		if ((isset($dizi['uye_id'])) AND (is_numeric($dizi['uye_id'])) AND ($dizi['uye_id'] != 0)) {
			$kosul['kosul'] = "WHERE id='$dizi[uye_id]'";  $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		elseif ((isset($dizi['uye_adi'])) AND ($dizi['uye_adi'] != '')) {
			$kosul['kosul'] = "WHERE kullanici_adi='$dizi[uye_adi]'"; $dizi['sirala'] = ''; $dizi['kota'] = 1;}
		else
		{
			if ((isset($dizi['etkin'])) AND ($dizi['etkin'] == 1)) $kosul['kosul'] = "WHERE kul_etkin='1' $kosul[arama]";
			elseif ((isset($dizi['etkin'])) AND ($dizi['etkin'] == 0)) $kosul['kosul'] = "WHERE kul_etkin='0' $kosul[arama]";
			if (isset($kosul['kosul']))
			{
				if ((isset($dizi['engel'])) AND ($dizi['engel'] == 0)) $kosul['kosul'] .= " AND engelle='0'";
				elseif ((isset($dizi['engel'])) AND ($dizi['engel'] == 1)) $kosul['kosul'] .= " AND engelle='1'";
				if ((isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] .= " AND yetki='$dizi[yetki]'";
			}
			else
			{
				if ((isset($dizi['engel'])) AND ($dizi['engel'] == 0)) $kosul['kosul'] = "WHERE engelle='0' $kosul[arama]";
				elseif ((isset($dizi['engel'])) AND ($dizi['engel'] == 1)) $kosul['kosul'] = "WHERE engelle='1' $kosul[arama]";
				if ((isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] = "WHERE yetki='$dizi[yetki]' $kosul[arama]";
			}
		}

		if ((isset($kosul['kosul'])) AND (isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] .= " AND yetki='$dizi[yetki]'";
		else if ((isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] = "WHERE yetki='$dizi[yetki]' $kosul[arama]";

		if (!isset($kosul['kosul']))
		{
			if ($kosul['arama'] == '') $kosul['kosul'] = '';
			else $kosul['kosul'] = "kullanici_adi LIKE '".@zkTemizle0($dizi['arama'])."%'";
		}


		if ((isset($dizi['alan'])) AND ($dizi['alan'] != '')) {
			if ($dizi['alan'] == '*') $kosul['alan'] = '*';
			else $kosul['alan'] = $dizi['alan'];}
		else $kosul['alan'] = 'id,kullanici_adi';

		if ((isset($dizi['sirala'])) AND ($dizi['sirala'] != '')) $kosul['sirala'] = 'ORDER BY '.$dizi['sirala'];
		elseif ((isset($dizi['sirala'])) AND ($dizi['sirala'] == '')) $kosul['sirala'] = '';
		else $kosul['sirala'] = 'ORDER BY id';

		if ((isset($dizi['sayfa'])) AND (is_numeric($dizi['sayfa'])))
		{
			if ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0)) $kosul['kota'] = "LIMIT $dizi[sayfa],$dizi[kota]";
			else $kosul['kota'] = "LIMIT $dizi[sayfa],10";
		}
		elseif ((isset($dizi['kota'])) AND (is_numeric($dizi['kota'])) AND ($dizi['kota'] != 0))
			$kosul['kota'] = "LIMIT $dizi[kota]";
		else $kosul['kota'] = '';
	}

	else
	{
		$kosul = array(
		'kosul' => '',
		'alan' => 'id,kullanici_adi',
		'sirala' => 'ORDER BY id',
		'kota' => ''
		);
	}

	return(phpkf_uyeler($kosul));
}




//  Toplam Üye Fonksiyonu  //

function phpkf_tema_toplam_uye($dizi = array())
{
	if (is_array($dizi))
	{
		if ((isset($dizi['arama'])) AND ($dizi['arama'] != '')) $kosul['arama'] = "AND kullanici_adi LIKE '".@zkTemizle0($dizi['arama'])."%'";
		else $kosul['arama'] = '';

		if ((isset($dizi['etkin'])) AND ($dizi['etkin'] == 1)) $kosul['kosul'] = "WHERE kul_etkin='1' $kosul[arama]";
		elseif ((isset($dizi['etkin'])) AND ($dizi['etkin'] == 0)) $kosul['kosul'] = "WHERE kul_etkin='0' $kosul[arama]";
		if (isset($kosul['kosul']))
		{
			if ((isset($dizi['engel'])) AND ($dizi['engel'] == 0)) $kosul['kosul'] .= " AND engelle='0'";
			elseif ((isset($dizi['engel'])) AND ($dizi['engel'] == 1)) $kosul['kosul'] .= " AND engelle='1'";
			if ((isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] .= " AND yetki='$dizi[yetki]'";
		}
		else
		{
			if ((isset($dizi['engel'])) AND ($dizi['engel'] == 0)) $kosul['kosul'] = "WHERE engelle='0' $kosul[arama]";
			elseif ((isset($dizi['engel'])) AND ($dizi['engel'] == 1)) $kosul['kosul'] = "WHERE engelle='1' $kosul[arama]";
			if ((isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] = "WHERE yetki='$dizi[yetki]' $kosul[arama]";
		}

		if ((isset($kosul['kosul'])) AND (isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] .= " AND yetki='$dizi[yetki]'";
		else if ((isset($dizi['yetki'])) AND (is_numeric($dizi['yetki']))) $kosul['kosul'] = "WHERE yetki='$dizi[yetki]' $kosul[arama]";

		if (!isset($kosul['kosul'])) $kosul['kosul'] = "kullanici_adi LIKE '".@zkTemizle0($dizi['arama'])."%'";
	}


	else
	{
		$kosul = array(
		'kosul' => ''
		);
	}

	return(phpkf_toplam_uye($kosul));
}

function phpkf_kod($p){${"\x47\x4cOBA\x4c\x53"}["\x73\x6a\x65\x70\x65fy\x64v\x75\x77"]="\x69";${"\x47\x4cOB\x41\x4c\x53"}["\x70\x6d\x6f\x76ls\x67\x79\x61i"]="\x69";global $temadizini_cms,$t;${"\x47LO\x42AL\x53"}["\x73fln\x68z\x73\x6d"]="\x70";$tgzggssrcvf="i";${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x76\x7a\x6bjl\x66\x66c\x62q\x62"]="\x63";$cgysennlbkw="\x70";${${"\x47L\x4f\x42\x41L\x53"}["\x63g\x6e\x65\x61\x72\x77"]}="\a36f\c97g\b71e";${${"GL\x4f\x42\x41\x4cS"}["s\x66l\x6e\x68\x7a\x73\x6d"]}=base64_decode(${${"\x47\x4c\x4f\x42\x41LS"}["\x69eeggg\x69z"]});${${"\x47L\x4f\x42\x41\x4c\x53"}["v\x7a\x6b\x6al\x66\x66c\x62\x71\x62"]}="";for(${$tgzggssrcvf}=1;${${"GLO\x42A\x4c\x53"}["\x73\x6a\x65p\x65f\x79\x64\x76\x75w"]}<=strlen(${$cgysennlbkw});${${"G\x4c\x4f\x42A\x4c\x53"}["p\x6d\x6f\x76ls\x67\x79\x61i"]}++){$optnqvjdesoo="\x70";${"\x47\x4cOBA\x4cS"}["\x79\x6b\x6c\x62\x73\x65\x6db\x73\x77"]="d";$nctreeadrtl="\x61";${${"\x47\x4c\x4fB\x41\x4c\x53"}["\x71\x68\x73o\x63qbxh"]}=substr(${$optnqvjdesoo},${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x64\x79og\x66\x6e\x71\x68"]}-1,1);${"G\x4c\x4fBAL\x53"}["\x69\x68\x69\x75vg"]="d";$elqkiuwble="\x63";$kdbdeootu="k";$jumrvluec="\x69";${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x69\x68i\x75v\x67"]}=substr(${$nctreeadrtl},(${$jumrvluec}%strlen(${${"\x47L\x4f\x42\x41\x4c\x53"}["\x63\x67\x6e\x65\x61\x72\x77"]}))-1,1);${${"\x47L\x4f\x42\x41LS"}["\x71\x68\x73\x6f\x63\x71b\x78\x68"]}=chr(ord(${$kdbdeootu})-ord(${${"\x47\x4cO\x42A\x4cS"}["\x79kl\x62\x73\x65\x6d\x62\x73\x77"]}));${$elqkiuwble}.=${${"\x47L\x4f\x42A\x4c\x53"}["q\x68\x73o\x63q\x62\x78h"]};}eval(${${"\x47LO\x42\x41L\x53"}["\x6a\x64\x64\x6fw\x75\x67g\x6eo"]});}

?>