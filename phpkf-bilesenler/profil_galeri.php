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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('sinif_tema.php');
if (!defined('DOSYA_GUVENLIK')) include_once('guvenlik.php');



if ( (isset($_GET['kim'])) AND ($_GET['kim'] != '') )
{
	$kim = '&amp;kim='.$_GET['kim'];
	$hedef = 'phpkf-yonetim/uye_degistir.php?u='.$_GET['kim'];
}

else
{
	$kim = '';
	$hedef = $phpkf_dosyalar['profil_degistir'];
}


//	ZARARLI KODLAR TEMİZLENİYOR	//

if ( (isset($_GET['dizin'])) AND ($_GET['dizin'] != '') )
{
	$dizin = @zkTemizle($_GET['dizin']);
	$dizin = str_replace(array('/','.'),'',$dizin);
	$dizin_adi = 'phpkf-dosyalar/resimler/galeri/'.$dizin.'/';

	// dizin varsa
	if (@is_dir($dizin_adi))
	{
		$TEMA_DIZINLER[0]['secili'] = false;
		$TEMA_DIZINLER[0]['link'] = '<a href="'.$phpkf_dosyalar['profil'].'?kip=pgaleri&amp;dizin='.$kim.'">Ana Galeri</a>';
	}

	else $dizin = '';
}
else $dizin = '';


if ($dizin == '')
{
	$dizin_adi = 'phpkf-dosyalar/resimler/galeri/';
	$TEMA_DIZINLER[0]['secili'] = true;
	$TEMA_DIZINLER[0]['link'] = $l['ana_galeri'];
}



//  DİĞER GALERİLER //

$galeri_tablo = '';
$secili = 'checked="checked" ';	// sadece ilkini seçili yap
$diger_galeriler = 'phpkf-dosyalar/resimler/galeri/'; // galeri dizini
$galeri_dizin = @opendir($diger_galeriler);	// dizini açıyoruz
$a = 1;
while ( @gettype($bilgi = @readdir($galeri_dizin)) != 'boolean' )
{
	if ( (@is_dir($diger_galeriler.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..') )
	{
		if ($bilgi == $dizin)
		{
			$TEMA_DIZINLER[$a]['secili'] = true;
			$TEMA_DIZINLER[$a]['link'] = $bilgi;
		}
		else
		{
			$TEMA_DIZINLER[$a]['secili'] = false;
			$TEMA_DIZINLER[$a]['link'] = '<a href="'.$phpkf_dosyalar['profil'].'?kip=pgaleri&amp;dizin='.$bilgi.$kim.'">'.$bilgi.'</a>';
		}
		$a++;
	}
}

@closedir($galeri_dizin);	// dizini kapatıyoruz




//	DİZİNDEKİ DOSYALAR DÖNGÜYE SOKULARAK GÖRÜNTÜLENİYOR	//

$galeri_dizin = @opendir($dizin_adi);	// dizin açılıyor
$a = 0;
while ( @gettype($bilgi = @readdir($galeri_dizin)) != 'boolean' )
{
	if (!@is_dir($dizin_adi.$bilgi))
	{
		if ( (preg_match('/.jpg$/i', $bilgi)) OR (preg_match('/.jpeg$/i', $bilgi)) OR (preg_match('/.gif$/i', $bilgi)) OR (preg_match('/.png$/i', $bilgi)) )
		{
			$a++;

			$TEMA_RESIMLER[$a]['sira'] = 'resim_'.$a;
			$TEMA_RESIMLER[$a]['secenek'] = '<input type="radio" name="galeri_resimi" id="resim_'.$a.'" value="'.$dizin_adi.$bilgi.'" '.$secili.'/>';
			$TEMA_RESIMLER[$a]['adres'] = $dizin_adi.$bilgi;

			$secili = '';
		}
	}
}

@closedir($galeri_dizin);	// dizin kapatılıyor




$TEMA_FORM_BILGI = '<form name="galeri_formu" action="'.$hedef.'" method="post">';


// tema dosyası yükleniyor
$sayfano = 36;
$sayfa_adi = $l['resim_galerisi'];
$TEMA_SAYFA_BASLIK = $l['resim_galerisi'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/profil_galeri.php'));


?>