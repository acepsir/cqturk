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


if (@is_file('ayar.php'))
{
if (!defined('DOSYA_GERECLER')) include 'phpkf-bilesenler/gerecler.php';
}
else 
{
if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
}
if (!defined('PHPKF_ICINDEN')) exit();
define('DOSYA_SEC',true);



if (isset($_GET['kosul'])) $kosul = $_GET['kosul'];
else $kosul = '';

if (isset($_GET['sayfa'])) $sayfa = $_GET['sayfa'];
else $sayfa = 0;

$zaman_asimi = $ayarlar['uye_cevrimici_sure'];

$tarih = time();

@ini_set('magic_quotes_runtime', 0);



	if (@is_file('ayar.php'))
	{
	$ust_dizin ='portal/';
	$alt_dizin ='';
	}
	else 
	{
	$ust_dizin ='';
	$alt_dizin ='../';
	}


//  FORUM TEMASINI DEĞİŞTİR //

if ( (isset($_GET['renk'])) AND ($_GET['renk'] != '') )
{
	switch($_GET['renk'])
	{
		case 'yesil';
		setcookie('forum_rengi', 'yesil', $tarih+$ayarlar['k_cerez_zaman'], $cerez_dizin, $cerez_alanadi);
		header('Location: '.$alt_dizin.$phpkf_dosyalar['portal']);
		exit();
		break;

		case 'kirmizi';
		setcookie('forum_rengi', 'kirmizi', $tarih+$ayarlar['k_cerez_zaman'], $cerez_dizin, $cerez_alanadi);
		header('Location: '.$alt_dizin.$phpkf_dosyalar['portal']);
		exit();
		break;

		case 'turuncu';
		setcookie('forum_rengi', 'turuncu', $tarih+$ayarlar['k_cerez_zaman'], $cerez_dizin, $cerez_alanadi);
		header('Location: '.$alt_dizin.$phpkf_dosyalar['portal']);
		exit();
		break;

		case 'mavi';
		setcookie('forum_rengi', 'mavi', $tarih+$ayarlar['k_cerez_zaman'], $cerez_dizin, $cerez_alanadi);
		header('Location: '.$alt_dizin.$phpkf_dosyalar['portal']);
		exit();
		break;

		default:
		setcookie('forum_rengi', 'siyah', $tarih+$ayarlar['k_cerez_zaman'], $cerez_dizin, $cerez_alanadi);
		header('Location: '.$alt_dizin.$phpkf_dosyalar['portal']);
		exit();
	}
}



if ( (isset($_GET['dil'])) AND ($_GET['dil'] != '') )
{
	$_GET['dil'] = @zkTemizle($_GET['dil']);
	$_GET['dil'] = @zkTemizle4($_GET['dil']);

	setcookie('portal_dili', $_GET['dil'], time()+$ayarlar['k_cerez_zaman'], $ayarlar['f_dizin']);
	header('Location: '.$alt_dizin.$phpkf_dosyalar['portal']);
	exit();
}
?>