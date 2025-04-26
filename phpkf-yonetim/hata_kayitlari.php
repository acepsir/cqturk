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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
else $gyo = '';

// yönetim oturum kodu kontrol ediliyor
if (isset($_GET['sil']))
{
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}
}



// Log dosyaları
$dosya_vt = '../phpkf-bilesenler/log/veritabani.log.php';
$dosya_vty = 'phpkf-bilesenler/log/veritabani.log.php';
$dosya_php = '../phpkf-bilesenler/log/php.log.php';
$dosya_phpy = 'phpkf-bilesenler/log/php.log.php';



// Dosya Okuma Fonksiyonu
function DosyaOku($dosya)
{
	if (!($dosya_ac = @fopen($dosya, 'r')))
		return('Dosyası Açılamıyor: '.$dosya.'');

	else
	{
		$boyut = @filesize($dosya);
		$dosya_metni = @fread($dosya_ac, $boyut);
		@fclose($dosya_ac);
		$dosya_metni = @str_replace("<?php if (!defined('PHPKF_ICINDEN')) exit(); ?>", '', $dosya_metni);
		return $dosya_metni;
	}
}



// Dosya Silme Fonksiyonu
function DosyaSil($dosya)
{
	if (!($dosya_ac = @fopen($dosya, 'w'))) return false;

	else
	{
		$yolla = "<?php if (!defined('PHPKF_ICINDEN')) exit(); ?>\r\n";
		@flock($dosya_ac, 2);
		@fwrite($dosya_ac, $yolla);
		@flock($dosya_ac, 3);
		@fclose($dosya_ac);
		return true;
	}
}



// Dosya Silme İşlemleri
if ( (isset($_GET['sil'])) AND ($_GET['sil'] != '') )
{
	$sil = $_GET['sil'];

	if ($sil == 'vt')
	{
		if (!DosyaSil($dosya_vt))
		{
			echo 'Dosya Silinemedi: '.$dosya_vt;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=vt');
	}
	elseif ($sil == 'vty')
	{
		if (!DosyaSil($dosya_vty))
		{
			echo 'Dosya Silinemedi: '.$dosya_vty;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=vty');
	}
	elseif ($sil == 'php')
	{
		if (!DosyaSil($dosya_php))
		{
			echo 'Dosya Silinemedi: '.$dosya_php;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=php');
	}
	elseif ($sil == 'phpy')
	{
		if (!DosyaSil($dosya_phpy))
		{
			echo 'Dosya Silinemedi: '.$dosya_phpy;
			exit();
		}
		else header('Location: hata_kayitlari.php?kip=phpy');
	}

	else header('Location: hata_kayitlari.php');

	exit();
}




//  SAYFA GÖSTERİMİ - BAŞI  //

$tema_sayfa_icerik = '<ul style="padding-top:10px; padding-bottom:10px">';


$tema_sayfa_icerik .= '<li style="margin-bottom:10px">
<div style="float:left; width:225px"><a href="hata_kayitlari.php?kip=vt">'.$ly['veritabani_hatalari'].'</a></div>
<div style="float:left"><a href="hata_kayitlari.php?sil=vt&amp;yo='.$yo.'">['.$l['sil'].']</a></div></li>

<li style="margin-bottom:10px">
<div style="float:left; width:225px"><a href="hata_kayitlari.php?kip=vty">'.$ly['veritabani_hatalari'].' ('.$ly['yonetim'].')</a></div>
<div style="float:left"><a href="hata_kayitlari.php?sil=vty&amp;yo='.$yo.'">['.$l['sil'].']</a></div></li>

<div class="clear" style="height:10px"></div>

<li style="margin-bottom:10px">
<div style="float:left; width:225px"><a href="hata_kayitlari.php?kip=php">'.$ly['php_hatalari'].'</a></div>
<div style="float:left"><a href="hata_kayitlari.php?sil=php&amp;yo='.$yo.'">['.$l['sil'].']</a></div></li>

<li style="margin-bottom:10px">
<div style="float:left; width:225px"><a href="hata_kayitlari.php?kip=phpy">'.$ly['php_hatalari'].' ('.$ly['yonetim'].')</a></div>
<div style="float:left"><a href="hata_kayitlari.php?sil=phpy&amp;yo='.$yo.'">['.$l['sil'].']</a></div></li>

</ul>';



if ( (isset($_GET['kip'])) AND ($_GET['kip'] != '') )
{
	$kip = $_GET['kip'];
	$tema_sayfa_icerik .= '<br><b style="color:#666666;">';
	$hata_cikti = '<textarea class="textarea" wrap="off" style="width:97%; height:400px;margin-top:3px;overflow:auto" placeholder="'.$ly['hicbir_hata_yok'].'" readonly="readonly">';


	if ($kip == 'vt')
	{
		$tema_sayfa_icerik .= $ly['veritabani_hatalari'];
		$hata_cikti .= DosyaOku($dosya_vt);
	}
	elseif ($kip == 'vty')
	{
		$tema_sayfa_icerik .= $ly['veritabani_hatalari'].' ('.$ly['yonetim'].')';
		$hata_cikti .= DosyaOku($dosya_vty);
	}
	elseif ($kip == 'php')
	{
		$tema_sayfa_icerik .= $ly['php_hatalari'];
		$hata_cikti .= DosyaOku($dosya_php);
	}
	elseif ($kip == 'phpy')
	{
		$tema_sayfa_icerik .= $ly['php_hatalari'].' ('.$ly['yonetim'].')';
		$hata_cikti .= DosyaOku($dosya_phpy);
	}
	else
	{
		$hata_cikti = '';
	}

	$tema_sayfa_icerik .= '</b><br>';
	$hata_cikti .= '</textarea>';
}
else
{
	$hata_cikti = '';
}



$tema_sayfa_icerik .= $hata_cikti;



// tema dosyası yükleniyor
$sayfa_adi = $ly['hata_kayitlari'];
$tema_sayfa_baslik = $ly['hata_kayitlari'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>